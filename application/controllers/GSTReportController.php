<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class GSTReportController extends CI_Controller
{
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

    function GSTR3B_show()
    {
        if($this->input->post('newMonth') != null)
        {
            $month = $this->input->post('newMonth');
        }
        else
        {
            $month = date('F');
        }

        $WorkYear = $this->session->userdata('WorkYear');
        $SpiltWorkYear = explode("-", $WorkYear);
        $finalWorkYear = $SpiltWorkYear[0];

        //$currentMonth = date('F');
        // $getMonthNumber = date_parse($currentMonth);
        // $monthNumber = $getMonthNumber['month'];

        $first_date = date('Y-m-d',strtotime('first day of ' . $month . ' ' . $finalWorkYear));
        $last_date = date('Y-m-d',strtotime('last day of ' .$month . ' ' . $finalWorkYear));

        $this->load->view('menu_1.php');
        $this->load->model('GSTReportModel');
        $data['month'] = $month;
        $data['ModalList'] = $this->GSTReportModel->getModalData($first_date,$last_date);
        $data['List31'] = $this->GSTReportModel->get31($first_date,$last_date);
        $data['List32'] = $this->GSTReportModel->get32($first_date,$last_date);
        $data['List4Main'] = $this->GSTReportModel->getFourMainData($first_date,$last_date);
        $data['List5Main'] = $this->GSTReportModel->getFiveMainData($first_date,$last_date);

        $data['List6Main'] = $this->GSTReportModel->getSix1Data($first_date,$last_date);

        $this->load->view('GSTR3B_view.php',$data);   
    }

    function getStateWise32($state,$first_date,$last_date) //3.2 on tr click call model
    {
        $this->load->model('GSTReportModel');
        $data['StateData'] = $this->GSTReportModel->getStateWise32Modal($state,$first_date,$last_date);
        $this->load->view('StateTableView.php',$data);
    }

    function getList5($first_date,$last_date) 
    {
        $this->load->model('GSTReportModel');
        $data['List5'] = $this->GSTReportModel->getFiveData($first_date,$last_date);
        $this->load->view('Table5View.php',$data);
    }

    function get4Data($first_date,$last_date) //3.2 on tr click call model
    {
        $this->load->model('GSTReportModel');
        $data['List4'] = $this->GSTReportModel->getFourData($first_date,$last_date);
        $this->load->view('FourReportView.php',$data);
    }

    function GSTR3B31_show() //3.1 main screen
    {

        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;         

        // $this->load->model('GSTModel');
        // $data['result'] = $this->GSTModel->get_GSTR3B31();
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        // SUM(SaleDetails.TaxCode) as , 
        $query = "
                        SELECT
                                YEAR(SaleDetails.BillDate) AS y, MONTH(SaleDetails.BillDate) AS m, 
                                SUM(SaleDetails.TaxableAmt) As TotalTaxableValue, 
                                SUM(SaleDetails.IGSTAmt) as IntegratedTax,
                                SUM(SaleDetails.CGSTAmt) as CentralTax, 
                                SUM(SaleDetails.SGSTAmt) as StateUITax
                        FROM
                                SaleMast,
                                SaleDetails,
                                PartyMaster,
                                ACMaster
                        WHERE
                                SaleMast.PartyCode = PartyMaster.PartyCode
                                AND SaleMast.CoID = PartyMaster.CoID
                                AND SaleMast.WorkYear = PartyMaster.WorkYear
                                AND SaleMast.CoID = ACMaster.CoID
                                AND SaleMast.WorkYear = ACMaster.WorkYear
                                AND SaleMast.BrokerID = ACMaster.ACCode
                                AND SaleMast.CoID = SaleDetails.CoID
                                AND SaleMast.WorkYear = SaleDetails.WorkYear
                                AND SaleMast.BillNo = SaleDetails.BillNo            
                                AND SaleMast.BillDate between '2021-04-01' and '2021-04-30'
                                and SaleMast.CoID = '$CoID'
                                and SaleMast.WorkYear = '$WorkYear'


                ";

                $result = $this->db->query($query);

                $delimiter = ",";
                $newline = "\r\n";
                $filename='APMC-GSTR3B31.csv';
                $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
                force_download( $filename, $data);
    }

    function GSTR3B31a_show() //3.1 on click tr
    {
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;         

        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');

        $query = "
                        SELECT 
                            SaleDetails.BillNo,
                            DATE_FORMAT(SaleDetails.BillDate,'%d-%m-%Y') as BillDate,
                            SaleDetails.NetAmt As Value,
                            TaxMaster.TaxRate As Rate, 
                            SaleDetails.TaxableAmt as TaxableValue,
                            SaleDetails.IGSTAmt as IntegratedTax,
                            SaleDetails.CGSTAmt as CentralTax,
                            SaleDetails.SGSTAmt  as StateUITax,
                            0 AS Cess,
                            PartyMaster.PartyState as PlaceOfSupplyNameOfState
                        FROM
                            SaleMast,
                            SaleDetails,
                            PartyMaster,
                            TaxMaster
                        WHERE
                            SaleMast.PartyCode = PartyMaster.PartyCode
                                AND SaleMast.CoID = PartyMaster.CoID
                                AND SaleMast.WorkYear = PartyMaster.WorkYear
                                        
                                AND SaleMast.CoID = SaleDetails.CoID
                                AND SaleMast.WorkYear = SaleDetails.WorkYear
                                AND SaleMast.BillNo = SaleDetails.BillNo
                                
                                AND SaleDetails.TaxCode = TaxMaster.TaxCode

                                AND SaleMast.BillDate between '2021-04-01' and '2021-04-30'
                                and SaleMast.CoID = '$CoID'
                                and SaleMast.WorkYear = '$WorkYear'
                ";

                $result = $this->db->query($query);

                $delimiter = ",";
                $newline = "\r\n";
                $filename='APMC-GSTR3B31a.csv';
                $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
                force_download( $filename, $data);    
    }

    function xgetStateWise32($state) //3.2 on tr click call model
    {
        $this->load->model('GSTReportModel');
        $data['StateData'] = $this->GSTReportModel->getStateWise32Modal($state);
        $this->load->view('StateTableView.php',$data);
    }

    function GSTR3B32a_show() //not used yet
    {
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;         

        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');

        $query = "
                        SELECT 
                            SaleDetails.BillNo,
                            DATE_FORMAT(SaleDetails.BillDate,'%d-%m-%Y') as BillDate,
                            SaleDetails.NetAmt As Value,
                            TaxMaster.TaxRate As Rate, 
                            SaleDetails.TaxableAmt as TaxableValue,
                            SaleDetails.IGSTAmt as IntegratedTax,
                            PartyMaster.PartyState as PlaceOfSupplyNameOfState
                        FROM
                            SaleMast,
                            SaleDetails,
                            PartyMaster,
                            TaxMaster
                        WHERE
                            SaleMast.PartyCode = PartyMaster.PartyCode
                                AND SaleMast.CoID = PartyMaster.CoID
                                AND SaleMast.WorkYear = PartyMaster.WorkYear
                                AND PartyMaster.StateCode <> '27'
                                AND SaleDetails.IGSTAmt > 0
                                        
                                AND SaleMast.CoID = SaleDetails.CoID
                                AND SaleMast.WorkYear = SaleDetails.WorkYear
                                AND SaleMast.BillNo = SaleDetails.BillNo
                                
                                AND SaleDetails.TaxCode = TaxMaster.TaxCode
                                AND SaleMast.BillDate between '2021-04-01' and '2021-04-30'
                                and SaleMast.CoID = '$CoID'
                                and SaleMast.WorkYear = '$WorkYear'

                ";

                $result = $this->db->query($query);

                $delimiter = ",";
                $newline = "\r\n";
                $filename='APMC-GSTR3B32a.csv';
                $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
                force_download( $filename, $data);    
    }

    function GSTR3B4A5a_show() //combined with 3.2 in model query
    {
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;         

        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');

        $query = "
                    SELECT 
                        PurDetails.IDNumber,
                        DATE_FORMAT(PurDetails.GoodsRcptDate,'%d-%m-%Y') as BillDate,
                        PurDetails.GrossAmount As Value,
                        PurDetails.TaxRate As Rate, 
                        PurDetails.TaxableAmt as TaxableValue,
                        PurDetails.IGSTAmt as IntegratedTax,
                        PurDetails.CGSTAmt as CentralTax,
                        PurDetails.SGSTAmt  as StateUITax,
                        0 AS Cess, 
                        ACMastDets.StateName as PlaceOfSupplyNameOfState
                    FROM
                        PurDetails,
                        ACMastDets
                    WHERE
                        PurDetails.PartyCode = ACMastDets.ACCode
                            AND PurDetails.CoID = ACMastDets.CoID
                            AND PurDetails.WorkYear = ACMastDets.WorkYear         
                            AND PurDetails.TaxRate > 0
                            AND PurDetails.GoodsRcptDate between '2021-04-01' and '2021-04-30'
                            and PurDetails.CoID = '$CoID'
                            and PurDetails.WorkYear = '$WorkYear'

                            ";

                $result = $this->db->query($query);

                $delimiter = ",";
                $newline = "\r\n";
                $filename='APMC-GSTR3B4A5a.csv';
                $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
                force_download( $filename, $data);    
    }

    function xget4Data() //3.2 on tr click call model
    {
        $this->load->model('GSTReportModel');
        $data['List4'] = $this->GSTReportModel->getFourData();        
        $this->load->view('FourReportView.php',$data);
    }

    function xgetList5() 
    {
        $this->load->model('GSTReportModel');
        $data['List5'] = $this->GSTReportModel->getFiveData();
        $this->load->view('Table5View.php',$data);
    }

    function GSTR3B5a_show()
    {
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;         

        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');

        $query = "
                    SELECT 
                        PurDetails.IDNumber,
                        DATE_FORMAT(PurDetails.GoodsRcptDate,'%d-%m-%Y') as BillDate,
                        PurDetails.GrossAmount As Value,
                        PurDetails.TaxRate As Rate, 
                        PurDetails.TaxableAmt as TaxableValue,
                        PurDetails.IGSTAmt as IntegratedTax,
                        PurDetails.CGSTAmt as CentralTax,
                        PurDetails.SGSTAmt  as StateUITax,
                        0 AS Cess,
                        ACMastDets.StateName as PlaceOfSupplyNameOfState
                    FROM
                        PurDetails,
                        ACMastDets
                    WHERE
                        PurDetails.PartyCode = ACMastDets.ACCode
                            AND PurDetails.CoID = ACMastDets.CoID
                            AND PurDetails.WorkYear = ACMastDets.WorkYear         
                            AND PurDetails.TaxRate = 0
                            AND PurDetails.GoodsRcptDate between '2021-04-01' and '2021-04-30'

                            and PurDetails.CoID = '$CoID'
                            and PurDetails.WorkYear = '$WorkYear'
            ";

                $result = $this->db->query($query);

                $delimiter = ",";
                $newline = "\r\n";
                $filename='APMC-GSTR3B5a.csv';
                $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
                force_download( $filename, $data);    
    }


    function xGSTR3B5_show()
    {
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;         

        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');

        $query = "
                    Select 
                            (
                                select
                                    sum(PurDetails.TaxableAmt + PurDetails.TaxCharges) 
                                FROM
                                    PurDetails, ACMastDets
                                WHERE
                                        PurDetails.TaxRate = 0
                                and ACMastDets.StateCode = 27

                                and PurDetails.GoodsRcptDate between '2021-04-01' and '2021-04-30'
                                and PurDetails.CoID = 'PRT'
                                and PurDetails.WorkYear = '2021-22'
                                
                                and PurDetails.PartyCode = ACMastDets.ACCode
                                and PurDetails.CoID = ACMastDets.CoID
                                and PurDetails.WorkYear = ACMastDets.WorkYear
                            ) as 'InterStateSupply', 
                            (
                                select
                                    sum(PurDetails.TaxableAmt + PurDetails.TaxCharges) 
                                FROM
                                    PurDetails, ACMastDets
                                WHERE
                                        PurDetails.TaxRate = 0
                                and ACMastDets.StateCode <> 27

                                and PurDetails.GoodsRcptDate between '2021-04-01' and '2021-04-30'
                                and PurDetails.CoID = '$CoID'
                                and PurDetails.WorkYear = '$WorkYear'
                                
                                and PurDetails.PartyCode = ACMastDets.ACCode
                                and PurDetails.CoID = ACMastDets.CoID
                                and PurDetails.WorkYear = ACMastDets.WorkYear) as 'IntraStateSupply'
                    from DUAL 
                ";

                $result = $this->db->query($query);

                $delimiter = ",";
                $newline = "\r\n";
                $filename='APMC-GSTR3B5a.csv';
                $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
                force_download( $filename, $data);    
    }

    function xGSTR3B61_show()
    {
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;         

        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');

        $query = "
                        SELECT
                                'Integrated Tax' as Description,
                                (
                                    SELECT
                                            SUM(SaleDetails.IGSTAmt) 
                                    FROM
                                            SaleMast,
                                            SaleDetails,
                                            PartyMaster,
                                            ACMaster
                                    WHERE
                                            SaleMast.PartyCode = PartyMaster.PartyCode
                                            AND SaleMast.CoID = PartyMaster.CoID
                                            AND SaleMast.WorkYear = PartyMaster.WorkYear
                                            AND SaleMast.CoID = ACMaster.CoID
                                            AND SaleMast.WorkYear = ACMaster.WorkYear
                                            AND SaleMast.BrokerID = ACMaster.ACCode
                                            AND SaleMast.CoID = SaleDetails.CoID
                                            AND SaleMast.WorkYear = SaleDetails.WorkYear
                                            AND SaleMast.BillNo = SaleDetails.BillNo            
                                            AND SaleMast.BillDate between '2021-04-01' and '2021-04-30'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.WorkYear = '$WorkYear'
            
                                ) as TaxPayable, 
                                (
                                    SELECT 
                                        sum(PurDetails.IGSTAmt) 
                                    FROM
                                        PurDetails,
                                        ACMastDets
                                    WHERE
                                        PurDetails.PartyCode = ACMastDets.ACCode
                                            AND PurDetails.CoID = ACMastDets.CoID
                                            AND PurDetails.WorkYear = ACMastDets.WorkYear         
                                            AND PurDetails.TaxRate > 0
                                            AND PurDetails.GoodsRcptDate between '2021-04-01' and '2021-04-30'
                                            and PurDetails.CoID = '$CoID'
                                            and PurDetails.WorkYear = '$WorkYear'
                                            ) as 'PaidThroughITC_IGST', 
                                '0' as 'PaidThroughITC_CGST',
                                '0' as 'PaidThroughITC_SGST'
                        from DUAL

                        UNION 

                        SELECT
                                'Central Tax' as Description,
                                (
                                    SELECT
                                            SUM(SaleDetails.CGSTAmt) 
                                    FROM
                                            SaleMast,
                                            SaleDetails,
                                            PartyMaster,
                                            ACMaster
                                    WHERE
                                            SaleMast.PartyCode = PartyMaster.PartyCode
                                            AND SaleMast.CoID = PartyMaster.CoID
                                            AND SaleMast.WorkYear = PartyMaster.WorkYear
                                            AND SaleMast.CoID = ACMaster.CoID
                                            AND SaleMast.WorkYear = ACMaster.WorkYear
                                            AND SaleMast.BrokerID = ACMaster.ACCode
                                            AND SaleMast.CoID = SaleDetails.CoID
                                            AND SaleMast.WorkYear = SaleDetails.WorkYear
                                            AND SaleMast.BillNo = SaleDetails.BillNo            
                                            AND SaleMast.BillDate between '2021-04-01' and '2021-04-30'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.WorkYear = '$WorkYear'            
                                ) as TaxPayable, 
                                '0' as 'PaidThroughITC_IGST', 
                                (
                                    SELECT 
                                        sum(PurDetails.CGSTAmt) 
                                    FROM
                                        PurDetails,
                                        ACMastDets
                                    WHERE
                                        PurDetails.PartyCode = ACMastDets.ACCode
                                            AND PurDetails.CoID = ACMastDets.CoID
                                            AND PurDetails.WorkYear = ACMastDets.WorkYear         
                                            AND PurDetails.TaxRate > 0
                                            AND PurDetails.GoodsRcptDate between '2021-04-01' and '2021-04-30'
                                            and PurDetails.CoID = '$CoID'
                                            and PurDetails.WorkYear = '$WorkYear'
                                            ) as 'PaidThroughITC_CGST',
                                '0' as 'PaidThroughITC_SGST'
                        from DUAL

                        UNION 

                        SELECT
                                'State/UT Tax' as Description,
                                (
                                    SELECT
                                            SUM(SaleDetails.SGSTAmt)
                                    FROM
                                            SaleMast,
                                            SaleDetails,
                                            PartyMaster,
                                            ACMaster
                                    WHERE
                                            SaleMast.PartyCode = PartyMaster.PartyCode
                                            AND SaleMast.CoID = PartyMaster.CoID
                                            AND SaleMast.WorkYear = PartyMaster.WorkYear
                                            AND SaleMast.CoID = ACMaster.CoID
                                            AND SaleMast.WorkYear = ACMaster.WorkYear
                                            AND SaleMast.BrokerID = ACMaster.ACCode
                                            AND SaleMast.CoID = SaleDetails.CoID
                                            AND SaleMast.WorkYear = SaleDetails.WorkYear
                                            AND SaleMast.BillNo = SaleDetails.BillNo            
                                            AND SaleMast.BillDate between '2021-04-01' and '2021-04-30'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.WorkYear = '$WorkYear'
                                            ) as TaxPayable, 
                                '0' as 'PaidThroughITC_IGST', 
                                '0' as 'PaidThroughITC_CGST', 
                                (
                                    SELECT 
                                        sum(PurDetails.SGSTAmt) 
                                    FROM
                                        PurDetails,
                                        ACMastDets
                                    WHERE
                                        PurDetails.PartyCode = ACMastDets.ACCode
                                            AND PurDetails.CoID = ACMastDets.CoID
                                            AND PurDetails.WorkYear = ACMastDets.WorkYear         
                                            AND PurDetails.TaxRate > 0
                                            AND PurDetails.GoodsRcptDate between '2021-04-01' and '2021-04-30'
                                            and PurDetails.CoID = '$CoID'
                                            and PurDetails.WorkYear = '$WorkYear'
                                            ) as 'PaidThroughITC_SGST'
                        from DUAL

                ";

                $result = $this->db->query($query);

                $delimiter = ",";
                $newline = "\r\n";
                $filename='APMC-GSTR3B61.csv';
                $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
                force_download( $filename, $data);    
    }

    function xGSTR3B_show()
    {
        $this->load->view('menu_1.php');
        $this->load->model('GSTReportModel');
        $data['ModalList'] = $this->GSTReportModel->getModalData();
        $data['List31'] = $this->GSTReportModel->get31();
        $data['List32'] = $this->GSTReportModel->get32();
        $data['List4Main'] = $this->GSTReportModel->getFourMainData();
        $data['List5Main'] = $this->GSTReportModel->getFiveMainData();

        $data['List6Main'] = $this->GSTReportModel->getSix1Data();
        $this->load->view('GSTR3B_view.php',$data);
    }


}
