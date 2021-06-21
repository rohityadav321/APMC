<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class SalesReturnModel extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    //updated 31-05-2021  rohit 

    function get_details()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        // $fromYear = "";
        // $toYear = "";
        // $current_month = date("m");
        // $current_year = date("Y");
        // $yearArray = explode("-", $WorkYear);
        // $year = explode("-", $yearArray[0]);
        // $WY = substr($year[0], 0, 2) . $yearArray[1];

        // if ((int)$WY > (int)$current_year) {
        //     $fromYear = date("$current_year-$current_month-01");
        //     $toYear = date("$current_year-$current_month-t");
        // } else {
        //     $fromYear = date("$WY-03-01");
        //     $toYear = date("$WY-03-t");
        // }

        $sql = "
                select SaleReturnMast.BillNo , 
                    SaleReturnMast.IDNumber, 
                    SaleReturnMast.BillDate, 
                    SaleReturnMast.CashDate, 
                    SaleMast.GodownID,
                    SaleReturnMast.PartyCode as CPName, 
                    PartyMaster.PartyName as PartyTitle, 
                    SaleReturnMast.BrokCode as BrokerID, 
                    Broker.ACTitle as BrokerTitle, 
                    (select 
                        sum(SalesReturnDets.SalRAmt)
                    from SalesReturnDets
                        where SalesReturnDets.CoID = SaleReturnMast.CoID
                        and SalesReturnDets.WorkYear = SaleReturnMast.WorkYear
                        and SalesReturnDets.BillNo = SaleReturnMast.BillNo) as RetAmt

                from SaleReturnMast,PartyMaster,ACMaster Broker,SaleMast   
                where PartyMaster.PartyCode = SaleReturnMast.CashCode
                and   PartyMaster.CoID = SaleReturnMast.CoID 
                and   PartyMaster.WorkYear = SaleReturnMast.WorkYear 
                                
                and Broker.ACCode = SaleReturnMast.BrokCode
                and Broker.CoID = SaleReturnMast.CoID
                and Broker.WorkYear = SaleReturnMast.WorkYear

                and SaleMast.CoID = SaleReturnMast.CoID
                and SaleMast.WorkYear = SaleReturnMast.WorkYear
                and SaleMast.BillNo = SaleReturnMast.BillNo

                and SaleReturnMast.CoID = '$CoID'
                and SaleReturnMast.WorkYear = '$WorkYear'
                order by CAST(SaleReturnMast.IDNumber As Integer) DESC
      ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    function getSalesReturnEntryData($bill)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                    SELECT
                            SaleDetails.ID,
                            SaleMast.PartyCode,
                            SaleMast.PartyID,
                            SaleMast.DebtorID,
                            (
                                select ACTitle
                                from ACMastDets
                                where ACMastDets.CoID=SaleMast.CoID
                                and ACMastDets.WorkYear=SaleMast.WorkYear
                                and ACMastDets.ACCode=SaleMast.DebtorID
                            ) as DebtorName,
                            (
                                select StateCode
                                from ACMastDets
                                where ACMastDets.CoID=SaleMast.CoID
                                and ACMastDets.WorkYear=SaleMast.WorkYear
                                and ACMastDets.ACCode=SaleMast.DebtorID
                            ) as DebtorState,
                            SaleMast.BillDate,
                            SaleMast.GodownID,
                            SaleMast.MudiBazar,
                            SaleMast.BrokerID,
                            (
                                select ACTitle
                                    from ACMastDets
                                    where ACMastDets.CoID=SaleMast.CoID
                                    and ACMastDets.WorkYear=SaleMast.WorkYear
                                    and ACMastDets.ACCode=SaleMast.BrokerID
                            ) as BrokerName,
                            SaleMast.BillAmt,
                            SaleMast.HelMajuri,
                            SaleMast.ReturnAmt,
                            SaleMast.OtherChrgs,
                            SaleDetails.GrAmt as GrossAmt,
                            SaleMast.RoffAmt,
                            SaleDetails.TaxableAmt,
                            SaleDetails.APMCIn,
                            SaleDetails.APMCSChrg,
                            SaleDetails.ContChrg,
                            SaleDetails.APMCChrg,
                            SaleDetails.TaxCode,
                            SaleDetails.EntryType,
                            SaleDetails.ETaxIn,
                            SaleDetails.NetAmt,
                            SaleMast.DiscountAmt,
                            SaleDetails.CreditAcc,
                            SaleDetails.LotNo,
                            SaleDetails.ItemCode,
                            SaleDetails.ItemMark,
                            SaleDetails.Qty,
                            SaleDetails.GrossWt,
                            SaleDetails.NetWt,
                            SaleDetails.Rate,
                           case when
                            ( 
                            Qty  -
                                    (select sum(qty) 
                                        from SalesReturnDets
                                    WHERE WorkYear = SaleDetails.WorkYear
                                    and ItemCode = SaleDetails.ItemCode
                                    and SalesReturnDets.LotNo = SaleDetails.LotNo
                                    and BillNo = SaleDetails.BillNo) 
                            ) is null then Qty else
                            (
                            Qty  -
                                    (select sum(qty) 
                                        from SalesReturnDets
                                    WHERE WorkYear = SaleDetails.WorkYear
                                    and ItemCode = SaleDetails.ItemCode
                                    and SalesReturnDets.LotNo = SaleDetails.LotNo
                                    and BillNo = SaleDetails.BillNo) 
                            ) end as SBal_Qty

                    from SaleDetails, SaleMast
                    where SaleDetails.CoID=SaleMast.CoID
                    and SaleDetails.WorkYear=SaleMast.WorkYear
                    and SaleDetails.BillNo=SaleMast.BillNO
                    and SaleDetails.CoID = '$CoID'
                    AND SaleDetails.WorkYear = '$WorkYear'
                    And SaleDetails.BillNo='$bill'

                    having SBal_Qty > 0 

              ";
        $query = $this->db->query($sql);
        // $query = $this->db->get($sql);
        $result = $query->result();
        return $result;
    }

    function getSalesReturnData($bill)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                    SELECT
                            SaleDetails.ID,
                            SaleMast.PartyCode,
                            SaleMast.PartyID,
                            SaleMast.DebtorID,
                            (
                                select ACTitle
                                from ACMastDets
                                where ACMastDets.CoID=SaleMast.CoID
                                and ACMastDets.WorkYear=SaleMast.WorkYear
                                and ACMastDets.ACCode=SaleMast.DebtorID
                            ) as DebtorName,
                            (
                                select StateCode
                                from ACMastDets
                                where ACMastDets.CoID=SaleMast.CoID
                                and ACMastDets.WorkYear=SaleMast.WorkYear
                                and ACMastDets.ACCode=SaleMast.DebtorID
                            ) as DebtorState,
                            SaleMast.BillDate,
                            SaleMast.GodownID,
                            SaleMast.MudiBazar,
                            SaleMast.BrokerID,
                            (
                                select ACTitle
                                    from ACMastDets
                                    where ACMastDets.CoID=SaleMast.CoID
                                    and ACMastDets.WorkYear=SaleMast.WorkYear
                                    and ACMastDets.ACCode=SaleMast.BrokerID
                            ) as BrokerName,
                            SaleMast.BillAmt,
                            SaleMast.HelMajuri,
                            SaleMast.ReturnAmt,
                            SaleMast.OtherChrgs,
                            SaleDetails.GrAmt as GrossAmt,
                            SaleMast.RoffAmt,
                            SaleDetails.TaxableAmt,
                            SaleDetails.APMCIn,
                            SaleDetails.APMCSChrg,
                            SaleDetails.ContChrg,
                            SaleDetails.APMCChrg,
                            SaleDetails.TaxCode,
                            SaleDetails.EntryType,
                            SaleDetails.ETaxIn,
                            SaleDetails.NetAmt,
                            SaleMast.DiscountAmt,
                            SaleDetails.CreditAcc,
                            SaleDetails.LotNo,
                            SaleDetails.ItemCode,
                            SaleDetails.ItemMark,
                            SaleDetails.Qty,
                            SaleDetails.GrossWt,
                            SaleDetails.NetWt,
                            SaleDetails.Rate
                    from SaleDetails, SaleMast
                    where SaleDetails.CoID=SaleMast.CoID
                    and SaleDetails.WorkYear=SaleMast.WorkYear
                    and SaleDetails.BillNo=SaleMast.BillNO
                    and SaleDetails.CoID = '$CoID'
                    AND SaleDetails.WorkYear = '$WorkYear'
                    And SaleDetails.BillNo='$bill'
              ";
        $query = $this->db->query($sql);
        // $query = $this->db->get($sql);
        $result = $query->result();
        return $result;
    }


    function xgetQty($bill)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $query = $this->db->query("
                                    select  SaleDetails.BillNo, SaleDetails.ItemCode, SaleDetails.LotNo,  Qty as Sold_Qty,
                                            (select sum(SalesReturnDets.Qty) 
                                                from SalesReturnDets
                                            WHERE SalesReturnDets.WorkYear = SaleDetails.WorkYear
                                            and SalesReturnDets.ItemCode = SaleDetails.ItemCode
                                            and SalesReturnDets.LotNo = SaleDetails.LotNo
                                            and BillNo = SaleDetails.BillNo) as SRet_Qty, 
                                            ( 
                                            Qty  -
                                                    (select sum(qty) 
                                                        from SalesReturnDets
                                                    WHERE WorkYear = SaleDetails.WorkYear
                                                    and ItemCode = SaleDetails.ItemCode
                                                    and SalesReturnDets.LotNo = SaleDetails.LotNo
                                                    and BillNo = SaleDetails.BillNo) 
                                            ) as SBal_Qty
                                    from SaleDetails 
                                    WHERE SaleDetails.CoID = '$CoID' 
                                    and WorkYear = '$WorkYear'
                                    and BillNo = '$bill'
                                    having SBal_Qty > 0 
                                ");

        return $query->num_rows();
    }

    function getQty($bill)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $query = $this->db->query("
   select  SaleDetails.BillNo, SaleDetails.ItemCode, SaleDetails.LotNo,  Qty as Sold_Qty,
                                            case 
                                            when 
                                            (select sum(SalesReturnDets.Qty) 
                                                from SalesReturnDets
                                            WHERE SalesReturnDets.WorkYear = SaleDetails.WorkYear
                                            and SalesReturnDets.ItemCode = SaleDetails.ItemCode
                                            and SalesReturnDets.LotNo = SaleDetails.LotNo
                                            and BillNo = SaleDetails.BillNo) is null then 
                                            0
                                            else                                         
                                            (select sum(SalesReturnDets.Qty) 
                                                from SalesReturnDets
                                            WHERE SalesReturnDets.WorkYear = SaleDetails.WorkYear
                                            and SalesReturnDets.ItemCode = SaleDetails.ItemCode
                                            and SalesReturnDets.LotNo = SaleDetails.LotNo
                                            and BillNo = SaleDetails.BillNo)
                                            end
                                            as SRet_Qty, 
                                            case when
                                            ( 
                                            Qty  -
                                                    (select sum(qty) 
                                                        from SalesReturnDets
                                                    WHERE WorkYear = SaleDetails.WorkYear
                                                    and ItemCode = SaleDetails.ItemCode
                                                    and SalesReturnDets.LotNo = SaleDetails.LotNo
                                                    and BillNo = SaleDetails.BillNo) 
                                            ) is null then Qty else
                                            (
                                            Qty  -
                                                    (select sum(qty) 
                                                        from SalesReturnDets
                                                    WHERE WorkYear = SaleDetails.WorkYear
                                                    and ItemCode = SaleDetails.ItemCode
                                                    and SalesReturnDets.LotNo = SaleDetails.LotNo
                                                    and BillNo = SaleDetails.BillNo) 
                                            ) end as SBal_Qty
                                    from SaleDetails 
                                    WHERE SaleDetails.CoID = '$CoID' 
                                    and WorkYear = '$WorkYear'
                                    and BillNo = '$bill'
                                    having SBal_Qty > 0 
                                ");

        return $query->num_rows();
    }

    function getBill($bill)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $query = $this->db->query("
                  select count(SaleReturnMast.BillNo) as Numbers 
                      from SaleReturnMast
                      where SaleReturnMast.CoID = '$CoID'
                      and SaleReturnMast.WorkYear = '$WorkYear'
                      and SaleReturnMast.BillNo='$bill'
              ");
        // $query = $this->db->get($sql);
        $result = $query->result();
        return $result;
    }


    // $xsql = "


    function getSalesDetails($id)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                    SELECT
                        GodownID,
                        APMCIn,
                        APMCSChrg,
                        ContChrg,
                        APMCChrg,
                        ETaxIn,
                        NetAmt,
                        TaxCode,
                    (select TaxTitle
                        from TaxMaster
                        where TaxMaster.TaxCode=SaleDetails.TaxCode
                    ) as TaxTitle,
                    (select TaxRate
                        from TaxMaster
                        where TaxMaster.TaxCode=SaleDetails.TaxCode
                    ) as TaxRate,
                    CreditAcc,
                    LotNo,
                    ItemCode,
                    (
                      select APMCChg
                      from ItemMaster
                      where SaleDetails.CoID=ItemMaster.CoID
						and SaleDetails.WorkYear=ItemMaster.WorkYear
						and SaleDetails.ItemCode=ItemMaster.ItemCode 
                    ) as ApmcRate,
                    (
                      select WeightDeduct
                      from ItemMaster
                      where SaleDetails.CoID=ItemMaster.CoID
						and SaleDetails.WorkYear=ItemMaster.WorkYear
						and SaleDetails.ItemCode=ItemMaster.ItemCode 
                    ) as weight,
                    (
                      select Packing
                      from ItemMaster
                      where SaleDetails.CoID=ItemMaster.CoID
						and SaleDetails.WorkYear=ItemMaster.WorkYear
						and SaleDetails.ItemCode=ItemMaster.ItemCode 
                    ) as Packing,
                    (
                      select PackingChrg
                      from ItemMaster
                      where SaleDetails.CoID=ItemMaster.CoID
						and SaleDetails.WorkYear=ItemMaster.WorkYear
						and SaleDetails.ItemCode=ItemMaster.ItemCode 
                    ) as PackingChrg,
                    ItemMark,
                    Qty,
                    GrossWt,
                    NetWt,
                    Rate,
                    case when
                    ( 
                        Qty  -
                            (select sum(qty) 
                                from SalesReturnDets
                            WHERE WorkYear = SaleDetails.WorkYear
                            and ItemCode = SaleDetails.ItemCode
                            and SalesReturnDets.LotNo = SaleDetails.LotNo
                            and BillNo = SaleDetails.BillNo) 
                    ) is null then Qty else
                    (
                        Qty  -
                            (select sum(qty) 
                                from SalesReturnDets
                            WHERE WorkYear = SaleDetails.WorkYear
                            and ItemCode = SaleDetails.ItemCode
                            and SalesReturnDets.LotNo = SaleDetails.LotNo
                            and BillNo = SaleDetails.BillNo) 
                    ) end as SBal_Qty
                from SaleDetails
                where SaleDetails.CoID = '$CoID'
                AND SaleDetails.WorkYear = '$WorkYear'
                And SaleDetails.ID=$id
              ";
        $query = $this->db->query($sql);
        // $query = $this->db->get($sql);
        $result = $query->result();
        return $result;
    }

    function get_Acc_list()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        $sql = "
                Select ACCode, ACTitle
                from ACMaster
                where CoID='$CoID'
                And WorkYear='$WorkYear'
                ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function getIDNum()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                SELECT LastSaleRetrnId
                from CompData
                WHERE CoID = '$CoID'
                AND WorkYear = '$WorkYear'

                ";
        $query = $this->db->query($sql);
        $result = $query->result();

        $NewValue = IntVal($result[0]->LastSaleRetrnId) + 1;

        $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear);
        $data2 = array('LastSaleRetrnId' => $NewValue);
        $this->db->where($multi_where);
        $this->db->update('CompData', $data2);

        return strval($NewValue);
    }

    function getACCode($Code)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        $sql = "
            Select ACCode, ACTitle
            from ACMaster
            where CoID='$CoID'
            And WorkYear='$WorkYear'
            and ACCode like '$Code%'
          ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function SalesRetMastData($IDNumber)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                    SELECT
                        SaleReturnMast.IDNumber, 
                        SaleReturnMast.CashDate,  
                        SaleReturnMast.BillNo, 
                        SaleReturnMast.BillDate, 
                        SaleReturnMast.PartyCode,  
                        (
                            SELECT 
                            ACTitle
                            FROM ACMastDets
                            WHERE ACMastDets.CoID = SaleReturnMast.CoID
                            AND ACMastDets.WorkYear = SaleReturnMast.WorkYear
                            AND ACMastDets.ACCode = SaleReturnMast.PartyCode
                        ) AS PartyName,
                        SaleReturnMast.ReturnAcc,  
                        (
                            SELECT 
                            ACTitle
                            FROM ACMastDets
                            WHERE ACMastDets.CoID = SaleReturnMast.CoID
                            AND ACMastDets.WorkYear = SaleReturnMast.WorkYear
                            AND ACMastDets.ACCode = SaleReturnMast.ReturnAcc
                        ) AS RetAccName,
                        SaleReturnMast.BillAmt,  
                        SaleReturnMast.CashCode,  
                        (
                            SELECT 
                            PartyName
                            FROM PartyMaster
                            WHERE PartyMaster.CoID = SaleReturnMast.CoID
                            AND PartyMaster.WorkYear = SaleReturnMast.WorkYear
                            AND PartyMaster.PartyCode = SaleReturnMast.CashCode
                        ) AS CashName,
                        SaleReturnMast.SaleType,  
                        SaleReturnMast.MudiBazar,  
                        SaleReturnMast.EntryType,  
                        SaleReturnMast.DiscAmt,  
                        SaleReturnMast.EtaxAmt,  
                        SaleReturnMast.OEtaxAmt,  
                        SaleReturnMast.AddAmt,  
                        SaleReturnMast.LessAmt,  
                        SaleReturnMast.HMajuAmt,   
                        SaleReturnMast.OChrgamt,   
                        SaleReturnMast.RoffAmt,   
                        SaleReturnMast.Haste,   
                        SaleReturnMast.BrokCode, 
                        (
                            SELECT 
                            ACTitle
                            FROM ACMastDets
                            WHERE ACMastDets.CoID = SaleReturnMast.CoID 
                            AND ACMastDets.WorkYear = SaleReturnMast.WorkYear
                            AND  ACMastDets.ACCode = SaleReturnMast.BrokCode
                        ) AS BrokName,
                        SaleReturnMast.BrokAmt,
                sum(SalesReturnDets.SalRAmt) as SalRAmt,  
                sum(SalesReturnDets.TaxableAmt) as TaxableAmt,  
                sum(SalesReturnDets.TaxAmt) as TaxAmt, 
                sum(SalesReturnDets.CGSTAmt) as CGSTAmt,   
                sum(SalesReturnDets.SGSTAmt) as SGSTAmt,   
                sum(SalesReturnDets.IGSTAmt) as IGSTAmt,   
                sum(SalesReturnDets.APMCChrg) as APMCChrg 
                    FROM SaleReturnMast, SalesReturnDets
                    WHERE  SalesReturnDets.CoID = SaleReturnMast.CoID
                        And SalesReturnDets.WorkYear = SaleReturnMast.WorkYear
                        And SalesReturnDets.BillNo = SaleReturnMast.BillNo
                        And SalesReturnDets.RefIDNumber = SaleReturnMast.IDNumber
                    
                        And  SaleReturnMast.CoID = '$CoID'
                        AND SaleReturnMast.WorkYear = '$WorkYear'
                        And SaleReturnMast.IDNumber='$IDNumber'
              ";
        $query = $this->db->query($sql);
        // $query = $this->db->get($sql);
        $result = $query->result();
        return $result;
    }
    function SalesRetDets($IDNumber)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
            SELECT
                SalesReturnDets.IDNumber,
                SalesReturnDets.ItemAmt,  
                SalesReturnDets.Lagaamt,   
                SalesReturnDets.APMCIn,    
                SalesReturnDets.SalRetrnDt,
                SalesReturnDets.GodownID, 
                SalesReturnDets.LotNo, 
                SalesReturnDets.CreditAcc, 
                SalesReturnDets.ItemCode, 
                SalesReturnDets.ItemMark, 
                SalesReturnDets.Qty, 
                SalesReturnDets.GrossWt, 
                SalesReturnDets.NetWt, 
                SalesReturnDets.Rate, 
                SalesReturnDets.APMCIn, 
                SalesReturnDets.ETaxIn, 
                SalesReturnDets.ItemAmt, 
                SalesReturnDets.ContChrg, 
                SalesReturnDets.LagaAmt, 
                SalesReturnDets.DiscRate, 
                SalesReturnDets.APMCSChrg, 
                SalesReturnDets.OApmcTax, 
                SalesReturnDets.EntryTax, 
                SalesReturnDets.RetuTaxCode, 
                SalesReturnDets.PattiInd, 
                SalesReturnDets.BrokInd, 
                SalesReturnDets.BrokRate, 
                SalesReturnDets.NAPMCIn, 
                SalesReturnDets.NEtaxIn,
                SalesReturnDets.CreditAccAmt,
                SalesReturnDets.EntryType

                FROM SaleReturnMast, SalesReturnDets
                WHERE SaleReturnMast.CoID=SalesReturnDets.CoID
                    AND SaleReturnMast.WorkYear=SalesReturnDets.WorkYear
                    AND SaleReturnMast.BillNo=SalesReturnDets.BillNO
                    AND SaleReturnMast.IDNumber=SalesReturnDets.RefIDNumber
                    AND SaleReturnMast.CoID = '$CoID'
                        AND SaleReturnMast.WorkYear = '$WorkYear'
                        And SaleReturnMast.IDNumber='$IDNumber'
              ";
        $query = $this->db->query($sql);
        // $query = $this->db->get($sql);
        $result = $query->result();
        return $result;
    }
    function getSalesDetItemWise($Id)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
            SELECT
                SalesReturnDets.IDNumber,
                SalesReturnDets.SalRAmt,  
                SalesReturnDets.ItemAmt,  
                SalesReturnDets.Lagaamt,   
                SalesReturnDets.APMCIn,    
                SalesReturnDets.TaxableAmt,  
                SalesReturnDets.TaxAmt, 
                SalesReturnDets.CGSTAmt,   
                SalesReturnDets.SGSTAmt,   
                SalesReturnDets.IGSTAmt,   
                SalesReturnDets.SalRetrnDt,
                SalesReturnDets.GodownID, 
                SalesReturnDets.LotNo, 
                SalesReturnDets.CreditAcc, 
                SalesReturnDets.ItemCode,
                                    (
                      select APMCChg
                      from ItemMaster
                      where SalesReturnDets.CoID=ItemMaster.CoID
						and SalesReturnDets.WorkYear=ItemMaster.WorkYear
						and SalesReturnDets.ItemCode=ItemMaster.ItemCode 
                    ) as ApmcRate,
                    (
                      select WeightDeduct
                      from ItemMaster
                      where SalesReturnDets.CoID=ItemMaster.CoID
						and SalesReturnDets.WorkYear=ItemMaster.WorkYear
						and SalesReturnDets.ItemCode=ItemMaster.ItemCode 
                    ) as weight,
                    (
                      select Packing
                      from ItemMaster
                      where SalesReturnDets.CoID=ItemMaster.CoID
						and SalesReturnDets.WorkYear=ItemMaster.WorkYear
						and SalesReturnDets.ItemCode=ItemMaster.ItemCode 
                    ) as Packing,
                    (
                      select PackingChrg
                      from ItemMaster
                      where SalesReturnDets.CoID=ItemMaster.CoID
						and SalesReturnDets.WorkYear=ItemMaster.WorkYear
						and SalesReturnDets.ItemCode=ItemMaster.ItemCode 
                    ) as PackingChrg,
 
                SalesReturnDets.ItemMark, 
                SalesReturnDets.Qty, 
                SalesReturnDets.GrossWt, 
                SalesReturnDets.NetWt, 
                SalesReturnDets.Rate, 
                SalesReturnDets.APMCIn, 
                SalesReturnDets.ETaxIn, 
                SalesReturnDets.ItemAmt, 
                SalesReturnDets.ContChrg, 
                SalesReturnDets.LagaAmt, 
                SalesReturnDets.DiscRate, 
                SalesReturnDets.APMCChrg, 
                SalesReturnDets.APMCSChrg, 
                SalesReturnDets.OApmcTax, 
                SalesReturnDets.EntryTax, 
                SalesReturnDets.RetuTaxCode, 
                (
                    SELECT 
                    TaxTitle
                    FROM TaxMaster
                    WHERE TaxMaster.TaxCode = SalesReturnDets.RetuTaxCode
                ) AS TaxTitle,
                (
                    SELECT 
                    TaxRate
                    FROM TaxMaster
                    WHERE TaxMaster.TaxCode = SalesReturnDets.RetuTaxCode
                ) AS TaxRate,
                
                SalesReturnDets.PattiInd, 
                SalesReturnDets.BrokInd, 
                SalesReturnDets.BrokRate, 
                SalesReturnDets.NAPMCIn, 
                SalesReturnDets.NEtaxIn,
                SalesReturnDets.CreditAccAmt,
                SalesReturnDets.EntryType

                FROM SalesReturnDets
                WHERE SalesReturnDets.CoID = '$CoID'
                  AND SalesReturnDets.WorkYear = '$WorkYear'
                  And SalesReturnDets.IDNumber='$Id'
              ";
        $query = $this->db->query($sql);
        // $query = $this->db->get($sql);
        $result = $query->result();
        return $result;
    }


    //? Pranav Patil 4-6-21 
    function salesReturnVoucher($BillNo)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
        SELECT  SalesReturnDets.IDNumber, 
                SalesReturnDets.SalRetrnDt, 
                SalesReturnDets.BillNo, 
                SalesReturnDets.BillDate, 
                SalesReturnDets.GodownID, 
                SalesReturnDets.LotNo, 
                 
             
                SalesReturnDets.ItemMark, 
                SalesReturnDets.Qty, 
                SalesReturnDets.GrossWt, 
                SalesReturnDets.NetWt, 
                SalesReturnDets.Rate, 

                SalesReturnDets.APMCChrg, 
                SalesReturnDets.APMCSChrg, 
                SalesReturnDets.OApmcTax, 
                
                SalesReturnDets.CGSTAmt, 
                SalesReturnDets.SGSTAmt, 
                SalesReturnDets.IGSTAmt, 
                SalesReturnDets.SalRAmt, 
                
                SalesReturnDets.HelOthRoff, 
                SalesReturnDets.SalReturnRecNo, 
                

                Company.CoName,

                CompData.FirmAddress1,
                CompData.FirmAddress2,
                CompData.FirmAddress3,
                CompData.FirmAddress4,
                CompData.FirmAddress5,
                CompData.FirmPinCode,

                PartyMaster.PartyName,
                PartyMaster.PartyArea
        
        FROM SalesReturnDets, Company, CompData, PartyMaster
        WHERE Company.CoID = SalesReturnDets.CoID

        AND CompData.CoID = SalesReturnDets.CoID
        AND CompData.WorkYear = SalesReturnDets.WorkYear

        AND PartyMaster.CoID = SalesReturnDets.CoID
        AND PartyMaster.WorkYear = SalesReturnDets.WorkYear
        
        AND  SalesReturnDets.BillNo = '$BillNo'
        AND SalesReturnDets.CoID = '$CoID' 
        AND SalesReturnDets.WorkYear = '$WorkYear'
        ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
}
