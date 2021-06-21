<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReportModel extends CI_Model
{
    function __construct(){
          // Call the Model constructor
        parent::__construct();
    }

    function get_brokerWiseDetails($fromYear,$toYear){

        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;
        $sql="
                  SELECT 
                    BillNo,
                    BillDate,
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                    Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                    and CoID = '$CoID'
                    and BillDate between '$fromYear' AND '$toYear'
                order by BrokerID;
              ";
            
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;       
    }

    function get_areaWiseDetails($fromYear,$toYear){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;
        $sql="
                  SELECT 
                    BillNo,
                    BillDate,
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                    Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                    and CoID = '$CoID'
                    and BillDate between '$fromYear' AND '$toYear'
                order by Area;
              ";
            
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;       
    }

    function get_partyWiseDetails($fromYear,$toYear){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;
        $sql="
                  SELECT 
                    BillNo,
                    BillDate,
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                    Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                    and CoID = '$CoID'
                    and BillDate between '$fromYear' AND '$toYear'
                order by PartyCode;
              ";
            
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;       
    }

    function get_OSReceivablesB($f,$t){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ; 


        // $sql="";$f="";$t="";
        // $dt=date("d-m-yy");
        // $current_month = date("m");
        // $current_year = date("yy");
        // $w=explode("-",$WorkYear);
        // $WY = '20'.$w[1];

        // if((int)$WY > (int)$current_year){
        //   $f = date("$current_year-$current_month-01", strtotime($dt));
        //   $t = date("$current_year-$current_month-t", strtotime($dt));
        // }
        // else{
        //   $f = date("$WY-03-01", strtotime($dt));
        //   $t = date("$WY-03-t", strtotime($dt));
        // }
        // echo $f .' === ' . $t ;
        // echo "<br>";
        $sql = "        
                  SELECT 
                      (Select ACTitle 
                        from ACMaster 
                            where SaleMast.BrokerID = ACMaster.ACCode 
                                and SaleMast.CoID = ACMaster.CoID
                                and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillNo,
                    DATE_FORMAT(BillDate,'%d-%m-%Y') as 'BillDt',
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                    Area,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                    and CoID = '$CoID'
                    and BillDate BETWEEN '$f' AND '$t'
                    and (BillAmt-RcptAmt) > 0 
                    order by BrokerName, BillDate 
                 ";
        // echo $sql;         
        $query = $this->db->query($sql)->result_array();

        // print_r ( $query);
        // die ; 

        if(empty($query)){
          $sql = "      
                    SELECT 
                    BillNo,
                    BillDate,
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                    Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                  and CoID = '$CoID' limit 1
                ";
                $query = $this->db->query($sql);
                $ea=array("empty");

                foreach ($query->list_fields() as $field){
                    array_push($ea, $field);
                }        
                return array($ea,$f,$t);
        }
        return array($query,$f,$t);
    }

    function get_OSReceivablesA($f, $t){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ; 

        // $sql="";$f="";$t="";
        // $dt=date("d-m-yy");
        // $current_month = date("m");
        // $current_year = date("yy");
        // $w=explode("-",$WorkYear);
        // $WY = '20'.$w[1];

        // if((int)$WY > (int)$current_year){
        //   $f = date("$current_year-$current_month-01", strtotime($dt));
        //   $t = date("$current_year-$current_month-t", strtotime($dt));
        // }
        // else{
        //   $f = date("$WY-03-01", strtotime($dt));
        //   $t = date("$WY-03-t", strtotime($dt));
        // }
        $sql = "        
                  SELECT 
                    Area,
                    BillNo,
                    DATE_FORMAT(BillDate,'%d-%m-%Y') as 'BillDt',
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                    and CoID = '$CoID'
                    and BillDate BETWEEN '$f' AND '$t'
                    and (BillAmt-RcptAmt) > 0 
                    order by Area, BillDate 
                 ";
        $query = $this->db->query($sql)->result_array();

        if(empty($query)){
          $sql = "      
                    SELECT 
                    BillNo,
                    BillDate,
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                    Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                  and CoID = '$CoID' limit 1
                ";
                $query = $this->db->query($sql);
                $ea=array("empty");

                foreach ($query->list_fields() as $field){
                    array_push($ea, $field);
                }        
                return array($ea,$f,$t);
        }
        return array($query,$f,$t);
    }

    function get_OSReceivablesP($f, $t){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ; 

        // $sql="";$f="";$t="";
        // $dt=date("d-m-yy");
        // $current_month = date("m");
        // $current_year = date("yy");
        // $w=explode("-",$WorkYear);
        // $WY = '20'.$w[1];

        // if((int)$WY > (int)$current_year){
        //   $f = date("$current_year-$current_month-01", strtotime($dt));
        //   $t = date("$current_year-$current_month-t", strtotime($dt));
        // }
        // else{
        //   $f = date("$WY-03-01", strtotime($dt));
        //   $t = date("$WY-03-t", strtotime($dt));
        // }
        $sql = "        
                  SELECT 
                      (Select PartyName 
                        from PartyMaster 
                            where SaleMast.PartyCode = PartyMaster.PartyCode
                    ) as PartyName,
                    BillNo,
                    DATE_FORMAT(BillDate,'%d-%m-%Y') as 'BillDt',
                        Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                    and CoID = '$CoID'
                    and BillDate BETWEEN '$f' AND '$t'
                    and (BillAmt-RcptAmt) > 0 
                    order by Area, BillDate 
                 ";
        $query = $this->db->query($sql)->result_array();

        if(empty($query)){
          $sql = "      
                    SELECT 
                    BillNo,
                    BillDate,
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                    Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                  and CoID = '$CoID' limit 1
                ";
                $query = $this->db->query($sql);
                $ea=array("empty");

                foreach ($query->list_fields() as $field){
                    array_push($ea, $field);
                }        
                return array($ea,$f,$t);
        }
        return array($query,$f,$t);
    }

    //updated 13-02-21
    function get_OSReceivablesFilter($fromYear,$toYear){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ; 
        $sql = "        
                  select
                            ph.IDNumber,
                            DATE_FORMAT(IF(ph.GoodsRcptDate != '0000-00-00',ph.GoodsRcptDate,ph.InvoiceDate),'%d-%m-%Y') as 'GDN Date',
                            ph.InvoiceNo as 'BillNo',
                            DATE_FORMAT(ph.InvoiceDate,'%d-%m-%Y') as 'BillDate',
                            ph.PartyCode as 'Party Code',
                            ac.ACTitle as 'Party Name',
                            ph.BrokerCode as 'Broker Code',
                            ac1.ACTitle as 'Broker Name',
                            pd.LotNo,
                            pd.ItemCode,
                            im.ItemName,
                            pd.Mark as 'Item Mark',
                            pd.Qty,
                            pd.Weight as 'Net Wgt',
                            pd.Rate,
                            pd.Amount as 'Item Amt',
                            pd.ContChg,
                            pd.APMCChg as 'APMC Amt',
                            pd.AddAmt,
                            pd.LessAmt,
                            ph.TaxableAmt,
                            ph.TaxCharges,
                            ph.AddAmt,
                            ph.LessAmt,
                            ph.NetPayable as 'Net Amt',
                            ph.Commission,
                            ph.GdnRent,
                            ph.Majuri,
                            ph.Laga,
                            ph.InsuAmt,
                            ph.Brokerage,
                            ph.Transport,
                            ph.SalesProm,
                            ph.TotalExpenses,
                            ph.Insurance,
                            ph.FreightAmt,
                            ph.CustomAmt,
                            ph.CFAmt,
                            ph.CFAmt,
                            ph.DEPBAmt,
                            ph.SADAmt
                  from
                            PurHeader ph join PurDetails pd
                            on ph.CoID =pd.CoID
                            AND ph.WorkYear=pd.WorkYear
                            AND ph.IDNumber=pd.IDNumber
                            left join ACMaster ac
                            on ph.WorkYear=ac.WorkYear
                            AND ph.CoID= ac.CoID
                            AND ph.PartyCode=ac.ACCode
                            left join ACMaster ac1
                            on ph.WorkYear=ac1.WorkYear
                            AND ph.CoID= ac1.CoID
                            AND ph.BrokerCode=ac1.ACCode
                            left join ItemMaster im
                            on pd.WorkYear=im.WorkYear
                            AND pd.CoID= im.CoID
                            AND pd.ItemCode=im.ItemCode
                  where ph.WorkYear='$WorkYear'
                  and ph.CoID='$CoID'
                  and  InvoiceDate BETWEEN '$fromYear' AND '$toYear'
                  order by ph.InvoiceDate desc, im.ItemName asc
            ";
        $query = $this->db->query($sql)->result_array();
        if(empty($query)){
            $sql = "      
                      select
                            ph.IDNumber,
                            DATE_FORMAT(IF(ph.GoodsRcptDate != '0000-00-00',ph.GoodsRcptDate,ph.InvoiceDate),'%d-%m-%Y') as 'GDN Date',
                            ph.InvoiceNo as 'BillNo',
                            DATE_FORMAT(ph.InvoiceDate,'%d-%m-%Y') as 'BillDate',
                            ph.PartyCode as 'Party Code',
                            ac.ACTitle as 'Party Name',
                            ph.BrokerCode as 'Broker Code',
                            ac1.ACTitle as 'Broker Name',
                            pd.LotNo,
                            pd.ItemCode,
                            im.ItemName,
                            pd.Mark as 'Item Mark',
                            pd.Qty,
                            pd.Weight as 'Net Wgt',
                            pd.Rate,
                            pd.Amount as 'Item Amt',
                            pd.ContChg,
                            pd.APMCChg as 'APMC Amt',
                            pd.AddAmt,
                            pd.LessAmt,
                            ph.TaxableAmt,
                            ph.TaxCharges,
                            ph.AddAmt,
                            ph.LessAmt,
                            ph.NetPayable as 'Net Amt',
                            ph.Commission,
                            ph.GdnRent,
                            ph.Majuri,
                            ph.Laga,
                            ph.InsuAmt,
                            ph.Brokerage,
                            ph.Transport,
                            ph.SalesProm,
                            ph.TotalExpenses,
                            ph.Insurance,
                            ph.FreightAmt,
                            ph.CustomAmt,
                            ph.CFAmt,
                            ph.CFAmt,
                            ph.DEPBAmt,
                            ph.SADAmt
                      from
                            PurHeader ph join PurDetails pd
                            on ph.CoID =pd.CoID
                            AND ph.WorkYear=pd.WorkYear
                            AND ph.IDNumber=pd.IDNumber
                            left join ACMaster ac
                            on ph.WorkYear=ac.WorkYear
                            AND ph.CoID= ac.CoID
                            AND ph.PartyCode=ac.ACCode
                            left join ACMaster ac1
                            on ph.WorkYear=ac1.WorkYear
                            AND ph.CoID= ac1.CoID
                            AND ph.BrokerCode=ac1.ACCode
                            left join ItemMaster im
                            on pd.WorkYear=im.WorkYear
                            AND pd.CoID= im.CoID
                            AND pd.ItemCode=im.ItemCode 
                            AND ph.WorkYear = '$WorkYear'
                            and ph.CoID = '$CoID' limit 1
                    ";
        $query = $this->db->query($sql);
        $ea=array("empty");
        foreach ($query->list_fields() as $field){
              array_push($ea, $field);
        }
        return array($ea,$fromYear,$toYear);
      }
      return  array($query,$fromYear,$toYear); 
    }


    // 31-03-21 Broker Detail Wise
    function get_RateDiffBD($f,$t){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ; 

        $sql = "        
                    Select 
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code1 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            Area,
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff WeightDiff, 
                            RateDiff RateDiff, 
                            DiffAmt1 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code1 <> ''
                                             
                    union all
                    
                    Select 
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code2 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            Area,
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff1 WeightDiff, 
                            RateDiff1 RateDiff, 
                            DiffAmt2 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code2 <> ''
                                        
                    union all
                    
                    Select 
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code3 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            Area,
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff2 WeightDiff, 
                            RateDiff2 RateDiff, 
                            DiffAmt3 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code3 <> ''
                    
                    union all
                    
                    Select 
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code4 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            Area,
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff3 WeightDiff, 
                            RateDiff3 RateDiff, 
                            DiffAmt4 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code4 <> ''
                                            
                    
                    union all
                    
                    Select 
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code5 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            Area,
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff4 WeightDiff, 
                            RateDiff4 RateDiff, 
                            DiffAmt5 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code5 <> ''
                    order by BrokerName, BillDt 
                    
                ";        
        $query = $this->db->query($sql)->result_array();

        if(empty($query)){
          $sql = "      
                    Select 
                        (Select ACTitle 
                            from ACMaster 
                                where SaleDetails.Code1 = ACMaster.ACCode 
                                    and SaleDetails.CoID = ACMaster.CoID
                                    and SaleDetails.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName, 
                        SaleMast.BillNo,
                        DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        Area,
                        SaleMast.GodownID,
                        LotNo,
                        ItemCode,
                        (Select ItemName 
                            from ItemMaster 
                                where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                    and SaleDetails.CoID = ItemMaster.CoID
                                    and SaleDetails.WorkYear = ItemMaster.WorkYear 
                        ) as ItemName,
                        ItemMark as Mark,
                        Qty,
                        GrossWt,
                        NetWt,
                        Rate,
                        WgtDiff WeightDiff, 
                        RateDiff RateDiff, 
                        DiffAmt1 Amount
                    FROM SaleMast,SaleDetails
                                    where SaleMast.CoID = SaleDetails.CoID
                                        and SaleMast.WorkYear = SaleDetails.WorkYear
                                        and SaleMast.BillNo = SaleDetails.BillNo
                                        and SaleMast.WorkYear = '$WorkYear'
                                        and SaleMast.CoID = '$CoID'
                                        and SaleDetails.Code1 <> ''
                    
                    union all
                    
                    Select 
                        (Select ACTitle 
                            from ACMaster 
                                where SaleDetails.Code2 = ACMaster.ACCode 
                                    and SaleDetails.CoID = ACMaster.CoID
                                    and SaleDetails.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName, 
                        SaleMast.BillNo,
                        DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        Area,
                        SaleMast.GodownID,
                        LotNo,
                        ItemCode,
                        (Select ItemName 
                            from ItemMaster 
                                where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                    and SaleDetails.CoID = ItemMaster.CoID
                                    and SaleDetails.WorkYear = ItemMaster.WorkYear 
                        ) as ItemName,
                        ItemMark as Mark,
                        Qty,
                        GrossWt,
                        NetWt,
                        Rate,
                        WgtDiff1 WeightDiff, 
                        RateDiff1 RateDiff, 
                        DiffAmt2 Amount
                    FROM SaleMast,SaleDetails
                                    where SaleMast.CoID = SaleDetails.CoID
                                        and SaleMast.WorkYear = SaleDetails.WorkYear
                                        and SaleMast.BillNo = SaleDetails.BillNo
                                        and SaleMast.WorkYear = '$WorkYear'
                                        and SaleMast.CoID = '$CoID'
                                        and SaleDetails.Code2 <> ''
                                        
                    union all
                    
                    Select 
                        (Select ACTitle 
                            from ACMaster 
                                where SaleDetails.Code3 = ACMaster.ACCode 
                                    and SaleDetails.CoID = ACMaster.CoID
                                    and SaleDetails.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName, 
                        SaleMast.BillNo,
                        DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        Area,
                        SaleMast.GodownID,
                        LotNo,
                        ItemCode,
                        (Select ItemName 
                            from ItemMaster 
                                where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                    and SaleDetails.CoID = ItemMaster.CoID
                                    and SaleDetails.WorkYear = ItemMaster.WorkYear 
                        ) as ItemName,
                        ItemMark as Mark,
                        Qty,
                        GrossWt,
                        NetWt,
                        Rate,
                        WgtDiff2 WeightDiff, 
                        RateDiff2 RateDiff, 
                        DiffAmt3 Amount
                    FROM SaleMast,SaleDetails
                                    where SaleMast.CoID = SaleDetails.CoID
                                        and SaleMast.WorkYear = SaleDetails.WorkYear
                                        and SaleMast.BillNo = SaleDetails.BillNo
                                        and SaleMast.WorkYear = '$WorkYear'
                                        and SaleMast.CoID = '$CoID'
                                        and SaleDetails.Code3 <> ''
                    union all
                    
                    Select 
                        (Select ACTitle 
                            from ACMaster 
                                where SaleDetails.Code4 = ACMaster.ACCode 
                                    and SaleDetails.CoID = ACMaster.CoID
                                    and SaleDetails.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName, 
                        SaleMast.BillNo,
                        DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        Area,
                        SaleMast.GodownID,
                        LotNo,
                        ItemCode,
                        (Select ItemName 
                            from ItemMaster 
                                where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                    and SaleDetails.CoID = ItemMaster.CoID
                                    and SaleDetails.WorkYear = ItemMaster.WorkYear 
                        ) as ItemName,
                        ItemMark as Mark,
                        Qty,
                        GrossWt,
                        NetWt,
                        Rate,
                        WgtDiff3 WeightDiff, 
                        RateDiff3 RateDiff, 
                        DiffAmt4 Amount
                    FROM SaleMast,SaleDetails
                                    where SaleMast.CoID = SaleDetails.CoID
                                        and SaleMast.WorkYear = SaleDetails.WorkYear
                                        and SaleMast.BillNo = SaleDetails.BillNo
                                        and SaleMast.WorkYear = '$WorkYear'
                                        and SaleMast.CoID = '$CoID'
                                        and SaleDetails.Code4 <> ''
                    
                    union all
                    
                    Select 
                        (Select ACTitle 
                            from ACMaster 
                                where SaleDetails.Code5 = ACMaster.ACCode 
                                    and SaleDetails.CoID = ACMaster.CoID
                                    and SaleDetails.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName, 
                        SaleMast.BillNo,
                        DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        Area,
                        SaleMast.GodownID,
                        LotNo,
                        ItemCode,
                        (Select ItemName 
                            from ItemMaster 
                                where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                    and SaleDetails.CoID = ItemMaster.CoID
                                    and SaleDetails.WorkYear = ItemMaster.WorkYear 
                        ) as ItemName,
                        ItemMark as Mark,
                        Qty,
                        GrossWt,
                        NetWt,
                        Rate,
                        WgtDiff4 WeightDiff, 
                        RateDiff4 RateDiff, 
                        DiffAmt5 Amount
                    FROM SaleMast,SaleDetails
                                    where SaleMast.CoID = SaleDetails.CoID
                                        and SaleMast.WorkYear = SaleDetails.WorkYear
                                        and SaleMast.BillNo = SaleDetails.BillNo
                                        and SaleMast.WorkYear = '$WorkYear'
                                        and SaleMast.CoID = '$CoID'
                                        and Code5 <> ''
                    limit 1
    
                ";
                $query = $this->db->query($sql);
                $ea=array("empty");

                foreach ($query->list_fields() as $field){
                    array_push($ea, $field);
                }        
                return array($ea,$f,$t);
        }
        return array($query,$f,$t);
    }

    // 31-03-21 Area Detail Wise
    function get_RateDiffAD($f,$t){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ; 

        $sql = "        
                    Select 
                            Area,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code1 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff WeightDiff, 
                            RateDiff RateDiff, 
                            DiffAmt1 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code1 <> ''
                    
                    union all
                    
                    Select 
                            Area,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code2 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff1 WeightDiff, 
                            RateDiff1 RateDiff, 
                            DiffAmt2 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code2 <> ''
                                        
                    union all
                    
                    Select 
                            Area,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code3 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff2 WeightDiff, 
                            RateDiff2 RateDiff, 
                            DiffAmt3 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code3 <> ''
                    union all
                    
                    Select 
                            Area,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code4 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff3 WeightDiff, 
                            RateDiff3 RateDiff, 
                            DiffAmt4 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code4 <> ''
                    
                    union all
                    
                    Select 
                            Area,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code5 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff4 WeightDiff, 
                            RateDiff4 RateDiff, 
                            DiffAmt5 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and Code5 <> ''
                    order by Area, BillDt 
  
                ";        
        $query = $this->db->query($sql)->result_array();

        if(empty($query)){
          $sql = "      
                        Select 
                            Area,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code1 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff WeightDiff, 
                            RateDiff RateDiff, 
                            DiffAmt1 Amount
                        FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleDetails.Code1 <> ''
                        
                        union all
                        
                        Select 
                            Area,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code2 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff1 WeightDiff, 
                            RateDiff1 RateDiff, 
                            DiffAmt2 Amount
                        FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleDetails.Code2 <> ''
                                            
                        union all
                        
                        Select 
                            Area,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code3 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff2 WeightDiff, 
                            RateDiff2 RateDiff, 
                            DiffAmt3 Amount
                        FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleDetails.Code3 <> ''
                        union all
                        
                        Select 
                            Area,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code4 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff3 WeightDiff, 
                            RateDiff3 RateDiff, 
                            DiffAmt4 Amount
                        FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleDetails.Code4 <> ''
                        
                        union all
                        
                        Select 
                            Area,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code5 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff4 WeightDiff, 
                            RateDiff4 RateDiff, 
                            DiffAmt5 Amount
                        FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and Code5 <> ''
                        limit 1
                ";
                $query = $this->db->query($sql);
                $ea=array("empty");

                foreach ($query->list_fields() as $field){
                    array_push($ea, $field);
                }        
                return array($ea,$f,$t);
        }
        return array($query,$f,$t);
    }

    // 31-03-21 Party Detail Wise
    function get_RateDiffPD($f,$t){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ; 

        $sql = "        
                    Select 
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        SaleMast.BillNo,
                        DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                        Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleDetails.Code1 = ACMaster.ACCode 
                                    and SaleDetails.CoID = ACMaster.CoID
                                    and SaleDetails.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName, 
                        SaleMast.GodownID,
                        LotNo,
                        ItemCode,
                        (Select ItemName 
                            from ItemMaster 
                                where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                    and SaleDetails.CoID = ItemMaster.CoID
                                    and SaleDetails.WorkYear = ItemMaster.WorkYear 
                        ) as ItemName,
                        ItemMark as Mark,
                        Qty,
                        GrossWt,
                        NetWt,
                        Rate,
                        WgtDiff WeightDiff, 
                        RateDiff RateDiff, 
                        DiffAmt1 Amount
                FROM SaleMast,SaleDetails
                                    where SaleMast.CoID = SaleDetails.CoID
                                        and SaleMast.WorkYear = SaleDetails.WorkYear
                                        and SaleMast.BillNo = SaleDetails.BillNo
                                        and SaleMast.WorkYear = '$WorkYear'
                                        and SaleMast.CoID = '$CoID'
                                        and SaleMast.BillDate between '$f' and '$t'
                                        and SaleDetails.Code1 <> ''
                
                union all
                
                Select 
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        SaleMast.BillNo,
                        DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                        Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleDetails.Code2 = ACMaster.ACCode 
                                    and SaleDetails.CoID = ACMaster.CoID
                                    and SaleDetails.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName, 
                        SaleMast.GodownID,
                        LotNo,
                        ItemCode,
                        (Select ItemName 
                            from ItemMaster 
                                where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                    and SaleDetails.CoID = ItemMaster.CoID
                                    and SaleDetails.WorkYear = ItemMaster.WorkYear 
                        ) as ItemName,
                        ItemMark as Mark,
                        Qty,
                        GrossWt,
                        NetWt,
                        Rate,
                        WgtDiff1 WeightDiff, 
                        RateDiff1 RateDiff, 
                        DiffAmt2 Amount
                FROM SaleMast,SaleDetails
                                    where SaleMast.CoID = SaleDetails.CoID
                                        and SaleMast.WorkYear = SaleDetails.WorkYear
                                        and SaleMast.BillNo = SaleDetails.BillNo
                                        and SaleMast.WorkYear = '$WorkYear'
                                        and SaleMast.CoID = '$CoID'
                                        and SaleMast.BillDate between '$f' and '$t'
                                        and SaleDetails.Code2 <> ''
                                    
                union all
                
                Select 
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        SaleMast.BillNo,
                        DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                        Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleDetails.Code3 = ACMaster.ACCode 
                                    and SaleDetails.CoID = ACMaster.CoID
                                    and SaleDetails.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName, 
                        SaleMast.GodownID,
                        LotNo,
                        ItemCode,
                        (Select ItemName 
                            from ItemMaster 
                                where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                    and SaleDetails.CoID = ItemMaster.CoID
                                    and SaleDetails.WorkYear = ItemMaster.WorkYear 
                        ) as ItemName,
                        ItemMark as Mark,
                        Qty,
                        GrossWt,
                        NetWt,
                        Rate,
                        WgtDiff2 WeightDiff, 
                        RateDiff2 RateDiff, 
                        DiffAmt3 Amount
                FROM SaleMast,SaleDetails
                                    where SaleMast.CoID = SaleDetails.CoID
                                        and SaleMast.WorkYear = SaleDetails.WorkYear
                                        and SaleMast.BillNo = SaleDetails.BillNo
                                        and SaleMast.WorkYear = '$WorkYear'
                                        and SaleMast.CoID = '$CoID'
                                        and SaleMast.BillDate between '$f' and '$t'
                                        and SaleDetails.Code3 <> ''
                union all
                
                Select 
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        SaleMast.BillNo,
                        DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                        Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleDetails.Code4 = ACMaster.ACCode 
                                    and SaleDetails.CoID = ACMaster.CoID
                                    and SaleDetails.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName, 
                        SaleMast.GodownID,
                        LotNo,
                        ItemCode,
                        (Select ItemName 
                            from ItemMaster 
                                where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                    and SaleDetails.CoID = ItemMaster.CoID
                                    and SaleDetails.WorkYear = ItemMaster.WorkYear 
                        ) as ItemName,
                        ItemMark as Mark,
                        Qty,
                        GrossWt,
                        NetWt,
                        Rate,
                        WgtDiff3 WeightDiff, 
                        RateDiff3 RateDiff, 
                        DiffAmt4 Amount
                FROM SaleMast,SaleDetails
                                    where SaleMast.CoID = SaleDetails.CoID
                                        and SaleMast.WorkYear = SaleDetails.WorkYear
                                        and SaleMast.BillNo = SaleDetails.BillNo
                                        and SaleMast.WorkYear = '$WorkYear'
                                        and SaleMast.CoID = '$CoID'
                                        and SaleMast.BillDate between '$f' and '$t'
                                        and SaleDetails.Code4 <> ''
                
                union all
                
                Select 
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        SaleMast.BillNo,
                        DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                        Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleDetails.Code5 = ACMaster.ACCode 
                                    and SaleDetails.CoID = ACMaster.CoID
                                    and SaleDetails.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName, 
                        SaleMast.GodownID,
                        LotNo,
                        ItemCode,
                        (Select ItemName 
                            from ItemMaster 
                                where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                    and SaleDetails.CoID = ItemMaster.CoID
                                    and SaleDetails.WorkYear = ItemMaster.WorkYear 
                        ) as ItemName,
                        ItemMark as Mark,
                        Qty,
                        GrossWt,
                        NetWt,
                        Rate,
                        WgtDiff4 WeightDiff, 
                        RateDiff4 RateDiff, 
                        DiffAmt5 Amount
                FROM SaleMast,SaleDetails
                                    where SaleMast.CoID = SaleDetails.CoID
                                        and SaleMast.WorkYear = SaleDetails.WorkYear
                                        and SaleMast.BillNo = SaleDetails.BillNo
                                        and SaleMast.WorkYear = '$WorkYear'
                                        and SaleMast.CoID = '$CoID'
                                        and SaleMast.BillDate between '$f' and '$t'
                                        and Code5 <> ''
                order by PartyName, BillDt 
  
                ";        
        $query = $this->db->query($sql)->result_array();

        if(empty($query)){
          $sql = "      
                        Select 
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            Area,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code1 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff WeightDiff, 
                            RateDiff RateDiff, 
                            DiffAmt1 Amount
                        FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleDetails.Code1 <> ''
                        
                        union all
                        
                        Select 
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            Area,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code2 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff1 WeightDiff, 
                            RateDiff1 RateDiff, 
                            DiffAmt2 Amount
                        FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleDetails.Code2 <> ''
                                            
                        union all
                        
                        Select 
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            Area,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code3 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff2 WeightDiff, 
                            RateDiff2 RateDiff, 
                            DiffAmt3 Amount
                        FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleDetails.Code3 <> ''
                        union all
                        
                        Select 
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            Area,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code4 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff3 WeightDiff, 
                            RateDiff3 RateDiff, 
                            DiffAmt4 Amount
                        FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleDetails.Code4 <> ''
                        
                        union all
                        
                        Select 
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            Area,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code5 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.GodownID,
                            LotNo,
                            ItemCode,
                            (Select ItemName 
                                from ItemMaster 
                                    where SaleDetails.ItemCode = ItemMaster.ItemCode 
                                        and SaleDetails.CoID = ItemMaster.CoID
                                        and SaleDetails.WorkYear = ItemMaster.WorkYear 
                            ) as ItemName,
                            ItemMark as Mark,
                            Qty,
                            GrossWt,
                            NetWt,
                            Rate,
                            WgtDiff4 WeightDiff, 
                            RateDiff4 RateDiff, 
                            DiffAmt5 Amount
                        FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and Code5 <> ''
                        limit 1
                ";
                $query = $this->db->query($sql);
                $ea=array("empty");

                foreach ($query->list_fields() as $field){
                    array_push($ea, $field);
                }        
                return array($ea,$f,$t);
        }
        return array($query,$f,$t);
    }

    // 31-03-21 Broker Summary Wise
    function get_RateDiffBS($f,$t){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ; 

        $sql = "        
                    Select 
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code1 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            Area,
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt1 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code1 <> ''
                    
                    union all
                    
                    Select 
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code2 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            Area,
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt2 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code2 <> ''
                                        
                    union all
                    
                    Select 
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code3 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            Area,
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt3 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code3 <> ''
                    union all
                    
                    Select 
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code4 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            Area,
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt4 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code4 <> ''
                    
                    union all
                    
                    Select 
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code5 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            Area,
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt5 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and Code5 <> ''
                    order by BrokerName, BillDt 
  
                ";        
        $query = $this->db->query($sql)->result_array();

        if(empty($query)){
        $sql = "      
                    Select 
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code1 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            Area,
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt1 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleDetails.Code1 <> ''
                    
                    union all
                    
                    Select 
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code2 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            Area,
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt2 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleDetails.Code2 <> ''
                                        
                    union all
                    
                    Select 
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code3 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            Area,
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt3 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleDetails.Code3 <> ''
                    union all
                    
                    Select 
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code4 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            Area,
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt4 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleDetails.Code4 <> ''
                    
                    union all
                    
                    Select 
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code5 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            Area,
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt5 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and Code5 <> ''
                    limit 1
  
                ";
                $query = $this->db->query($sql);
                $ea=array("empty");

                foreach ($query->list_fields() as $field){
                    array_push($ea, $field);
                }        
                return array($ea,$f,$t);
        }
        return array($query,$f,$t);
    }

    // 31-03-21 Area Summary Wise
    function get_RateDiffAS($f,$t){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ; 

        $sql = "        
                    Select 
                            Area,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code1 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt1 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code1 <> ''
                    
                    union all
                    
                    Select 
                            Area,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code2 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt2 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code2 <> ''
                                        
                    union all
                    
                    Select 
                            Area,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code3 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt3 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code3 <> ''
                    union all
                    
                    Select 
                            Area,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code4 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt4 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code4 <> ''
                    
                    union all
                    
                    Select 
                            Area,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code5 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt5 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and Code5 <> ''
                    order by Area, BillDt 
    
                ";        
        $query = $this->db->query($sql)->result_array();

        if(empty($query)){
          $sql = "      
                    Select 
                        Area,
                        SaleMast.BillNo,
                        DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleDetails.Code1 = ACMaster.ACCode 
                                    and SaleDetails.CoID = ACMaster.CoID
                                    and SaleDetails.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName, 
                        ItemCode,
                        Qty,
                        GrossWt,
                        NetWt,
                        DiffAmt1 Amount
                    FROM SaleMast,SaleDetails
                                    where SaleMast.CoID = SaleDetails.CoID
                                        and SaleMast.WorkYear = SaleDetails.WorkYear
                                        and SaleMast.BillNo = SaleDetails.BillNo
                                        and SaleMast.WorkYear = '$WorkYear'
                                        and SaleMast.CoID = '$CoID'
                                        and SaleDetails.Code1 <> ''
                    
                    union all
                    
                    Select 
                        Area,
                        SaleMast.BillNo,
                        DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleDetails.Code2 = ACMaster.ACCode 
                                    and SaleDetails.CoID = ACMaster.CoID
                                    and SaleDetails.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName, 
                        ItemCode,
                        Qty,
                        GrossWt,
                        NetWt,
                        DiffAmt2 Amount
                    FROM SaleMast,SaleDetails
                                    where SaleMast.CoID = SaleDetails.CoID
                                        and SaleMast.WorkYear = SaleDetails.WorkYear
                                        and SaleMast.BillNo = SaleDetails.BillNo
                                        and SaleMast.WorkYear = '$WorkYear'
                                        and SaleMast.CoID = '$CoID'
                                        and SaleDetails.Code2 <> ''
                                        
                    union all
                    
                    Select 
                        Area,
                        SaleMast.BillNo,
                        DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleDetails.Code3 = ACMaster.ACCode 
                                    and SaleDetails.CoID = ACMaster.CoID
                                    and SaleDetails.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName, 
                        ItemCode,
                        Qty,
                        GrossWt,
                        NetWt,
                        DiffAmt3 Amount
                    FROM SaleMast,SaleDetails
                                    where SaleMast.CoID = SaleDetails.CoID
                                        and SaleMast.WorkYear = SaleDetails.WorkYear
                                        and SaleMast.BillNo = SaleDetails.BillNo
                                        and SaleMast.WorkYear = '$WorkYear'
                                        and SaleMast.CoID = '$CoID'
                                        and SaleDetails.Code3 <> ''
                    union all
                    
                    Select 
                        Area,
                        SaleMast.BillNo,
                        DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleDetails.Code4 = ACMaster.ACCode 
                                    and SaleDetails.CoID = ACMaster.CoID
                                    and SaleDetails.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName, 
                        ItemCode,
                        Qty,
                        GrossWt,
                        NetWt,
                        DiffAmt4 Amount
                    FROM SaleMast,SaleDetails
                                    where SaleMast.CoID = SaleDetails.CoID
                                        and SaleMast.WorkYear = SaleDetails.WorkYear
                                        and SaleMast.BillNo = SaleDetails.BillNo
                                        and SaleMast.WorkYear = '$WorkYear'
                                        and SaleMast.CoID = '$CoID'
                                        and SaleDetails.Code4 <> ''
                    
                    union all
                    
                    Select 
                        Area,
                        SaleMast.BillNo,
                        DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleDetails.Code5 = ACMaster.ACCode 
                                    and SaleDetails.CoID = ACMaster.CoID
                                    and SaleDetails.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName, 
                        ItemCode,
                        Qty,
                        GrossWt,
                        NetWt,
                        DiffAmt5 Amount
                    FROM SaleMast,SaleDetails
                                    where SaleMast.CoID = SaleDetails.CoID
                                        and SaleMast.WorkYear = SaleDetails.WorkYear
                                        and SaleMast.BillNo = SaleDetails.BillNo
                                        and SaleMast.WorkYear = '$WorkYear'
                                        and SaleMast.CoID = '$CoID'
                                        and Code5 <> ''
                    limit 1
                  ";
                $query = $this->db->query($sql);
                $ea=array("empty");

                foreach ($query->list_fields() as $field){
                    array_push($ea, $field);
                }        
                return array($ea,$f,$t);
        }
        return array($query,$f,$t);
    }

    // 31-03-21 Party Summary Wise
    function get_RateDiffPS($f,$t){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ; 

        $sql = "        
                    Select 
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            Area,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code1 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt1 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code1 <> ''
                    
                    union all
                    
                    Select 
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            Area,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code2 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt2 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code2 <> ''
                                        
                    union all
                    
                    Select 
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            Area,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code3 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt3 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code3 <> ''
                    union all
                    
                    Select 
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            Area,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code4 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt4 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and SaleDetails.Code4 <> ''
                    
                    union all
                    
                    Select 
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            Area,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code5 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt5 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleMast.BillDate between '$f' and '$t'
                                            and Code5 <> ''
                    order by PartyName, BillDt 
    
                ";        
        $query = $this->db->query($sql)->result_array();

        if(empty($query)){
          $sql = "      
                    Select 
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            Area,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code1 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt1 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleDetails.Code1 <> ''
                    
                    union all
                    
                    Select 
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            Area,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code2 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt2 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleDetails.Code2 <> ''
                                        
                    union all
                    
                    Select 
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            Area,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code3 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt3 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleDetails.Code3 <> ''
                    union all
                    
                    Select 
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            Area,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code4 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt4 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and SaleDetails.Code4 <> ''
                    
                    union all
                    
                    Select 
                            (Select PartyName 
                                from PartyMaster 
                                    where SaleMast.PartyCode = PartyMaster.PartyCode
                            ) as PartyName,
                            SaleMast.BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as 'BillDt',
                            Area,
                            (Select ACTitle 
                                from ACMaster 
                                    where SaleDetails.Code5 = ACMaster.ACCode 
                                        and SaleDetails.CoID = ACMaster.CoID
                                        and SaleDetails.WorkYear = ACMaster.WorkYear 
                            ) as BrokerName, 
                            ItemCode,
                            Qty,
                            GrossWt,
                            NetWt,
                            DiffAmt5 Amount
                    FROM SaleMast,SaleDetails
                                        where SaleMast.CoID = SaleDetails.CoID
                                            and SaleMast.WorkYear = SaleDetails.WorkYear
                                            and SaleMast.BillNo = SaleDetails.BillNo
                                            and SaleMast.WorkYear = '$WorkYear'
                                            and SaleMast.CoID = '$CoID'
                                            and Code5 <> ''
                    limit 1
                ";
                $query = $this->db->query($sql);
                $ea=array("empty");

                foreach ($query->list_fields() as $field){
                    array_push($ea, $field);
                }        
                return array($ea,$f,$t);
        }
        return array($query,$f,$t);
    }



}

?>