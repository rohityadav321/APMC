<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TBReportController extends CI_Controller
{
        public $id1;

        public function __construct()
        {
                parent::__construct();
                $this->load->library('session');
                $this->load->helper('form');
                $this->load->helper('url');
                $this->load->database();
                $this->load->helper('html');
                $this->load->library('form_validation');
                //load date helper
                $this->load->helper('date');
        }

        public function show()
        {


                $this->load->dbutil();
                $this->load->helper('file');
                $this->load->helper('download');

                $query = "

                        SELECT FinalLedger.ACCode, ACMaster.ACTitle,
                                0 AS OpeningDr, 
                                0 AS OpeningCr, 
                                sum(IF(FinalLedger.ACCAmount > 0, FinalLedger.ACCAmount, 0)) Debit, 
                                sum(IF(FinalLedger.ACCAmount < 0, FinalLedger.ACCAmount*-1, 0)) Credit,         
        
                                IF(
                                        (
                                        sum(IF(FinalLedger.ACCAmount > 0, FinalLedger.ACCAmount, 0)) - 
                                        sum(IF(FinalLedger.ACCAmount < 0, FinalLedger.ACCAmount*-1, 0))
                                        )
                                 > 0, 
            
                                        (
                                        sum(IF(FinalLedger.ACCAmount > 0, FinalLedger.ACCAmount, 0)) - 
                                        sum(IF(FinalLedger.ACCAmount < 0, FinalLedger.ACCAmount*-1, 0))
                                        ), 0) AS ClosingDr,
                
                                IF(
                                        (
                                        sum(IF(FinalLedger.ACCAmount > 0, FinalLedger.ACCAmount, 0)) - 
                                        sum(IF(FinalLedger.ACCAmount < 0, FinalLedger.ACCAmount*-1, 0))
                                        )
                                 < 0, 
            
                                        (
                                        sum(IF(FinalLedger.ACCAmount > 0, FinalLedger.ACCAmount, 0)) - 
                                        sum(IF(FinalLedger.ACCAmount < 0, FinalLedger.ACCAmount*-1, 0))*-1
                                        ), 0) AS ClosingCr

        
                        from FinalLedger, ACMaster 
                        where FinalLedger.CoID = ACMaster.CoID 
                        and FinalLedger.WorkYear = ACMaster.WorkYear 
                        and FinalLedger.ACCode = ACMaster.ACCode 
                        group by FinalLedger.ACCode 
                        having (Debit > 0 or Credit > 0) 




                ";

                $result = $this->db->query($query);

                $delimiter = ",";
                $newline = "\r\n";
                $filename = 'APMC-TrialBalance.csv';
                $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
                force_download($filename, $data);
        }

        public function showgrouptb()
        {
                $fromYear = $this->input->post('fromYear');
                $toYear = $this->input->post('toYear');

                // $this->load->model('TrialBalanceModel');
                // $data['trial'] = $this->TrialBalanceModel->trial_balance($fromYear, $toYear);

                $sql = "

                        SELECT ACGroups.GroupTitle, FinalLedger.ACCode, ACMaster.ACTitle,
                                0 AS OpeningDr, 
                                0 AS OpeningCr, 
                                sum(IF(FinalLedger.ACCAmount > 0, FinalLedger.ACCAmount, 0)) Debit, 
                                sum(IF(FinalLedger.ACCAmount < 0, FinalLedger.ACCAmount*-1, 0)) Credit,         
        
                                IF(
                                        (
                                        sum(IF(FinalLedger.ACCAmount > 0, FinalLedger.ACCAmount, 0)) - 
                                        sum(IF(FinalLedger.ACCAmount < 0, FinalLedger.ACCAmount*-1, 0))
                                        )
                                 > 0, 
            
                                        (
                                        sum(IF(FinalLedger.ACCAmount > 0, FinalLedger.ACCAmount, 0)) - 
                                        sum(IF(FinalLedger.ACCAmount < 0, FinalLedger.ACCAmount*-1, 0))
                                        ), 0) AS ClosingDr,
                
                                IF(
                                        (
                                        sum(IF(FinalLedger.ACCAmount > 0, FinalLedger.ACCAmount, 0)) - 
                                        sum(IF(FinalLedger.ACCAmount < 0, FinalLedger.ACCAmount*-1, 0))
                                        )
                                 < 0, 
            
                                        (
                                        sum(IF(FinalLedger.ACCAmount > 0, FinalLedger.ACCAmount, 0)) - 
                                        sum(IF(FinalLedger.ACCAmount < 0, FinalLedger.ACCAmount*-1, 0))*-1
                                        ), 0) AS ClosingCr

        
                        from FinalLedger, ACMaster, ACGroups 
                        where FinalLedger.CoID = ACMaster.CoID 
                        and FinalLedger.WorkYear = ACMaster.WorkYear 
                        and FinalLedger.ACCode = ACMaster.ACCode 
                        and ACMaster.GroupCode = ACGroups.GroupCode
                        group by ACGroups.GroupTitle, ACMaster.ACTitle 
                        having (Debit > 0 or Credit > 0)
                        order by ACGroups.GroupTitle, ACMaster.ACTitle 

                ";

                $query = $this->db->query($sql);
                $data['trial'] = $query->result_array();

                $this->load->view('menu_1.php');
                $this->load->view('TBGroup_view', $data);
        }

        public function stockshow()
        {


                $this->load->dbutil();
                $this->load->helper('file');
                $this->load->helper('download');

                $query = "
                        SELECT LotNo, PurDetails.ItemCode, ItemMaster.ItemName, Mark,

                                (select IFNULL( sum(op.Qty),   0) 
                                        FROM PurDetails op
                                        where GoodsRcptDate < '2021-04-01'
                                        and op.LotNo = PurDetails.LotNo
                                        and op.ItemCode = PurDetails.ItemCode) as Opening, 

                                (select  IFNULL( sum(Inw.Qty),   0) 
                                        FROM PurDetails Inw
                                        where GoodsRcptDate >= '2021-04-01'
                                        and Inw.LotNo = PurDetails.LotNo
                                        and Inw.ItemCode = PurDetails.ItemCode) as Inward, 

                                (SELECT IFNULL( sum(outward.Qty),   0)  
                                        from SaleDetails outward
                                        where outward.BillDate >= '2021-04-01'
                                        and outward.LotNo = PurDetails.LotNo
                                        and outward.ItemCode = PurDetails.ItemCode) as Outward, 

                                (
                                                (select IFNULL( sum(op.Qty),   0) 
                                                        FROM PurDetails op
                                                        where GoodsRcptDate < '2021-04-01'
                                                                and op.LotNo = PurDetails.LotNo
                                                                and op.ItemCode = PurDetails.ItemCode)                         
                                +
                                                (select IFNULL( sum(Inw.Qty),   0) 
                                                        FROM PurDetails Inw
                                                        where GoodsRcptDate >= '2021-04-01'
                                                                and Inw.LotNo = PurDetails.LotNo
                                                                and Inw.ItemCode = PurDetails.ItemCode) 
                                -
                                                (SELECT IFNULL( sum(outward.Qty),   0)  
                                                                from SaleDetails outward
                                                        where outward.BillDate >= '2021-04-01'
                                                                and outward.LotNo = PurDetails.LotNo
                                                                and outward.ItemCode = PurDetails.ItemCode)
                                ) as Closing

                        FROM PurDetails, ItemMaster
                        where PurDetails.ItemCode = ItemMaster.ItemCode
                        and PurDetails.CoID = ItemMaster.CoID
                        and PurDetails.WorkYear = ItemMaster.WorkYear


                ";

                $result = $this->db->query($query);

                $delimiter = ",";
                $newline = "\r\n";
                $filename = 'APMC-StockSummary.csv';
                $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
                force_download($filename, $data);
        }

        public function Itemwise_Stockshow()
        {
                $CoID = $this->session->userdata('CoID');
                $WorkYear = $this->session->userdata('WorkYear');

                if ($this->input->post('submit') != NULL) {
                        $postData = $this->input->post();
                        // Read POST data
                        $fromYear = $postData['fromYear'];
                        $toYear = $postData['toYear'];
                        // $fromYear = $this->input->post('fromYear');
                        // $toYear = $this->input->post('toYear');
                } else {
                        $fromYear = date('Y-m-01');
                        $month_end = strtotime('last day of this month', time());
                        // echo 'end date ' . date('D, M jS Y', $month_end).'<br/>';
                        $toYear = date('Y-m-d', $month_end);
                }

                $data['fromYear'] = $fromYear;
                $data['toYear'] = $toYear;
                $sql = "SELECT LotNo, Mark, PurDetails.ItemCode, ItemMaster.ItemName, 

                                (select IFNULL( sum(op.Qty),   0) 
                                        FROM PurDetails op
                                        where GoodsRcptDate < '$fromYear'
                                        and op.LotNo = PurDetails.LotNo
                                        and op.Mark = PurDetails.Mark
                                        and op.ItemCode = PurDetails.ItemCode) as Opening, 

                                (select  IFNULL( sum(Inw.Qty),   0) 
                                        FROM PurDetails Inw
                                        where GoodsRcptDate between '$fromYear' and '$toYear'
                                        and Inw.LotNo = PurDetails.LotNo
                                        and Inw.Mark = PurDetails.Mark
                                        and Inw.ItemCode = PurDetails.ItemCode) as Inward, 

                                (SELECT IFNULL( sum(outward.Qty),   0)  
                                        from SaleDetails outward
                                        where outward.BillDate between '$fromYear' and '$toYear'
                                        and outward.LotNo = PurDetails.LotNo
                                        and outward.ItemMark = PurDetails.Mark
                                        and outward.ItemCode = PurDetails.ItemCode) as Outward, 

                                (
                                                (select IFNULL( sum(op.Qty),   0) 
                                                        FROM PurDetails op
                                                        where GoodsRcptDate < '$fromYear'
                                                                and op.LotNo = PurDetails.LotNo
                                                                and op.Mark = PurDetails.Mark
                                                                and op.ItemCode = PurDetails.ItemCode)                         
                                +
                                                (select IFNULL( sum(Inw.Qty),   0) 
                                                        FROM PurDetails Inw
                                                        where GoodsRcptDate between '$fromYear' and '$toYear'
                                                                and Inw.LotNo = PurDetails.LotNo
                                                                and Inw.Mark = PurDetails.Mark
                                                                and Inw.ItemCode = PurDetails.ItemCode) 
                                -
                                                (SELECT IFNULL( sum(outward.Qty),   0)  
                                                                from SaleDetails outward
                                                        where outward.BillDate between '$fromYear' and '$toYear'
                                                                and outward.LotNo = PurDetails.LotNo
                                                                and outward.ItemMark = PurDetails.Mark
                                                                and outward.ItemCode = PurDetails.ItemCode)
                                ) as Closing,
                                IDNumber as 'Entry#', 
                                DATE_FORMAT(GoodsRcptDate,'%d-%m-%Y') as 'Date'
                                
                        FROM PurDetails, ItemMaster
                        where PurDetails.ItemCode = ItemMaster.ItemCode
                        and PurDetails.CoID = ItemMaster.CoID
                        and PurDetails.WorkYear = ItemMaster.WorkYear
                        and PurDetails.CoID = '$CoID'
                        and PurDetails.WorkYear = '$WorkYear'
                        order by ItemMaster.ItemName, 
                        CAST(LotNo AS Integer), Mark                        
                ";

                $query = $this->db->query($sql);
                $data['stock'] = $query->result_array();

                $this->load->view('menu_1.php');
                $this->load->view('Itemwise_Stock_view', $data);
        }

        public function Lotwise_Stockshow()
        {
                $CoID = $this->session->userdata('CoID');
                $WorkYear = $this->session->userdata('WorkYear');

                if ($this->input->post('submit') != NULL) {
                        $postData = $this->input->post();
                        // Read POST data
                        $fromYear = $postData['fromYear'];
                        $toYear = $postData['toYear'];
                        // $fromYear = $this->input->post('fromYear');
                        // $toYear = $this->input->post('toYear');
                } else {
                        $fromYear = date('Y-m-01');
                        $month_end = strtotime('last day of this month', time());
                        // echo 'end date ' . date('D, M jS Y', $month_end).'<br/>';
                        $toYear = date('Y-m-d', $month_end);
                }

                $data['fromYear'] = $fromYear;
                $data['toYear'] = $toYear;

                // ' ' as Area,
                // CONCAT(PartyMaster.PartyArea, ' ', AreaMaster.AreaName) AS Area,

                $sql = "
                SELECT * 
                FROM (
                       SELECT 
                                CONCAT(PurDetails.ItemCode,' ',
                                PurDetails.LotNo, ' ' ,
                                PurDetails.Mark) as ItemName,
                                PurDetails.Units as Unit,
        
                                PurDetails.IDNumber as 'Doc No',
                                DATE_FORMAT(PurDetails.GoodsRcptDate,'%d-%m-%Y') as DocDate,
                                PurDetails.GoodsRcptDate as DT,
                                ACMaster.ACTitle as PartyName,
                                ' ' as Area,
                                PurDetails.Qty  as Inward,
                                PurDetails.Weight as Weight,
        
                                ' ' as OutQty, 
                                ' ' as 'Gross Weight', 
                                ' ' as 'Net Weight', 
                                ' ' as Rate, 
                                ' ' as 'Item Amt',
                                ' ' as 'Cont Chg', 
                                ' ' as 'Gross Amt'                        
                        FROM
                                PurDetails, ACMaster
                        WHERE
                                PurDetails.CoID = ACMaster.CoID
                                and PurDetails.WorkYear = ACMaster.WorkYear
                                and PurDetails.PartyCode = ACMaster.ACCode
                                and PurDetails.CoID = ACMaster.CoID
                                and PurDetails.WorkYear = ACMaster.WorkYear
                                and PurDetails.PartyCode = ACMaster.ACCode                    
                                and PurDetails.CoID = '$CoID'
                                AND PurDetails.WorkYear = '$WorkYear'
                                AND PurDetails.GoodsRcptDate between '$fromYear' and '$toYear'
        
                    union 
        
                        SELECT 
                                CONCAT(SaleDetails.ItemCode, ' ',
                                SaleDetails.LotNo, ' ',
                                SaleDetails.ItemMark) as ItemName,
                                ' '  as Unit,
        
                                SaleMast.BillNo as 'Doc No', 
                                DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as DocDate,
                                SaleMast.BillDate as DT,
                                PartyMaster.PartyName, 
                                SaleMast.Area,
                                    
                                ' ' as InQty,
                                ' ' as InwWeight,
        
                                SaleDetails.Qty as OutQty, 
                                SaleDetails.GrossWt as 'Gross Weight', 
                                SaleDetails.NetWt as 'Net Weight', 
                                SaleDetails.Rate as Rate, 
                                SaleDetails.GrAmt as 'Item Amt',
                                SaleDetails.ContChrg as 'Cont Chg', 
                                SaleDetails.NetAmt as 'Gross Amt'
                        FROM
                                SaleDetails,
                                SaleMast, 
                                PartyMaster
                        WHERE
                                SaleMast.CoID = PartyMaster.CoID
                                and SaleMast.WorkYear = PartyMaster.WorkYear
                                and SaleMast.PartyCode = PartyMaster.PartyCode
                                and SaleDetails.CoID = SaleMast.CoID
                                AND SaleDetails.WorkYear = SaleMast.WorkYear
                                AND SaleDetails.BillNo = SaleMast.BillNo
                                AND SaleDetails.CoID = '$CoID'
                                AND SaleDetails.WorkYear = '$WorkYear'
                                AND SaleMast.BillDate between '$fromYear' and '$toYear'
                
                    Order by ItemName, DT
                ) AS T 
                ";

                $query = $this->db->query($sql);
                $data['stock'] = $query->result_array();

                // print_r($data);
                // die;
                $this->load->view('menu_1.php');
                $this->load->view('Lotwise_Stock_view', $data);
        }


        public function BrokeragePayable()
        {
                $CoID = $this->session->userdata('CoID');
                $WorkYear = $this->session->userdata('WorkYear');

                if ($this->input->post('submit') != NULL) {
                        $postData = $this->input->post();
                        // Read POST data
                        $fromYear = $postData['fromYear'];
                        $toYear = $postData['toYear'];
                        // $fromYear = $this->input->post('fromYear');
                        // $toYear = $this->input->post('toYear');
                } else {
                        $fromYear = date('Y-m-01');
                        $month_end = strtotime('last day of this month', time());
                        // echo 'end date ' . date('D, M jS Y', $month_end).'<br/>';
                        $toYear = date('Y-m-d', $month_end);
                }

                $data['fromYear'] = $fromYear;
                $data['toYear'] = $toYear;

                $sql = "
                                SELECT 
                                concat(
                                        SaleMast.BrokerID, ' ',
                                        (SELECT 
                                                ACTitle
                                        FROM
                                                ACMaster
                                        WHERE
                                                SaleMast.CoID = ACMaster.CoID
                                                AND SaleMast.WorkYear = ACMaster.WorkYear
                                                AND SaleMast.BrokerID = ACMaster.ACCode) 
                                ) AS BrokerName,
                                SaleMast.BillNo,
                                SaleMast.BillDate,
                                CONCAT(SaleMast.PartyCode,
                                        ' ',
                                        IFNULL((SELECT 
                                                        PartyName
                                                FROM
                                                        PartyMaster
                                                WHERE
                                                        SaleMast.CoID = PartyMaster.CoID
                                                        AND SaleMast.WorkYear = PartyMaster.WorkYear
                                                        AND SaleMast.PartyCode = PartyMaster.PartyCode),
                                                ' ')) AS PartyName,
                                (SUM(SaleDetails.TaxableAmt) + SUM(SaleDetails.TaxAmt) + SUM(SaleDetails.TCSAmount)) AS IBillAmt,
                                SUM(SaleDetails.GrAmt) IItemAmt,
                                SUM(SaleDetails.Brokamt) BrokAmt,
                                (SELECT 
                                        SUM(Collection.BrokAmt)
                                FROM
                                        Collection
                                WHERE
                                        Collection.CoID = SaleMast.CoID
                                        AND Collection.WorkYear = SaleMast.WorkYear
                                        AND Collection.BrokerCode = SaleMast.BrokerID
                                        AND Collection.BillNo = SaleMast.BillNo
                                        AND Collection.BrokAmt > 0
                                ) BrokPaid, 
                                (
                                        SUM(SaleDetails.Brokamt) -
                                        ifnull( 
                                        (SELECT 
                                                SUM(Collection.BrokAmt)
                                        FROM
                                                Collection
                                        WHERE
                                                Collection.CoID = SaleMast.CoID
                                                AND Collection.WorkYear = SaleMast.WorkYear
                                                AND Collection.BrokerCode = SaleMast.BrokerID
                                                AND Collection.BillNo = SaleMast.BillNo
                                                AND Collection.BrokAmt > 0
                                        ),0)
                                ) BrokPayable
                        FROM
                                SaleMast,
                                SaleDetails
                        WHERE
                                SaleMast.CoID = '$CoID'
                                AND SaleMast.WorkYear = '$WorkYear'
                                AND SaleMast.BillDate BETWEEN '$fromYear' AND '$toYear'
                                AND SaleMast.CoID = SaleDetails.CoID
                                AND SaleMast.WorkYear = SaleDetails.WorkYear
                                AND SaleMast.BillNo = SaleDetails.BillNo
                        GROUP BY SaleMast.BrokerID , SaleMast.BillNo
                        order by  BrokerName, cast(SaleMast.BillNo as Integer)
                ";

                $query = $this->db->query($sql);
                $data['stock'] = $query->result_array();

                // print_r($data);
                // die;
                $this->load->view('menu_1.php');
                $this->load->view('BrokeragePayable_view', $data);
        }
}
