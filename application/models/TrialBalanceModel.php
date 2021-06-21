
<?php
// $image_path = realpath(BASEPATH . '../uploads');
if (!defined('BASEPATH')) exit('No direct script access allowed');

class TrialBalanceModel extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function trial_balance($fy, $ty)
    {
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
                        group by ACGroups.GroupTitle
                        having (Debit > 0 or Credit > 0)
                        order by ACGroups.GroupTitle, ACMaster.ACTitle 




                ";

        $query = $this->db->query($sql);

        // $delimiter = ",";
        // $newline = "\r\n";
        // $filename = 'APMC-TrialBalance.csv';
        // $data = $this->array($result);
        // force_download($filename, $data);
        $result = $query->result_array();
        return $result;
    }



    function Item_stock()
    {

        $sql = "
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
                        order by ItemMaster.ItemName
                        


                ";

        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
}
