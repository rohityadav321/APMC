<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class CollectionModel extends CI_Model
{
  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  function companyDetails()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
                   SELECT  
                           CompData.WorkYear,
                           Company.CoName,
                           concat(FirmPhoneNo , ' ' , FirmAltPhoneNo) as phone,
                           FirmEmailID,
                          concat( FirmAddress1 , ' ' , FirmAddress2 , ' ' , FirmAddress3 , ' ' , FirmPinCode ) as address
                    from Company, CompData
                    where Company.CoID = CompData.CoID         
                      and Company.CoID = '$CoID'
                      and CompData.WorkYear = '$WorkYear'   
       ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function Get_Receipt_Detail($IDNumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
            SELECT
            Collection.BillNo,
            SaleMast.BillDate,
            SaleMast.BillAmt, 
            Collection.IDNumber,
            Collection.CollectDate,
            Collection.ReceiptNo,
            PartyMaster.PartyName,
            (   Collection.VatavAmt+
                Collection.BrokAmt-
                (Collection.IntAmt+
                Collection.LfeeAmt+
                Collection.Chithi)+
                Collection.KasarAmt
            ) as VatavAmt,
            (Collection.ChequeAmt+Collection.CashAmt) as Amount,
            ( Collection.VatavAmt+
              Collection.BrokAmt-
              (Collection.IntAmt+
              Collection.LfeeAmt+
              Collection.Chithi)+
              Collection.KasarAmt
            )+
            (
              Collection.ChequeAmt+
              Collection.CashAmt
            ) as TotalAmt,
            Collection.ChequeAmt,
            Collection.CashAmt,
            Collection.CheqNo,
            (
              Select BankMaster.BankTitle
              from BankMaster
              where BankMaster.BankCode=Collection.CheqBankCode
              ) as BankName,
              (
              Select BankMaster.Bankbranch
              from BankMaster
              where BankMaster.BankCode=Collection.CheqBankCode
              ) as BankBranch,  
            PartyMaster.PartyArea as PartyAddress,
            Collection.BrokerCode, 
            (select ACTitle from ACMaster 
              where ACMaster.ACCode = Collection.BrokerCode
                and ACMaster.CoID = Collection.CoID
                and ACMaster.WorkYear = Collection.WorkYear) as BrokerName

        from Collection, PartyMaster, SaleMast
        where Collection.WorkYear = SaleMast.WorkYear
        and Collection.CoID = SaleMast.CoID
        and Collection.BillNo = SaleMast.BillNo

        and PartyMaster.CoID = SaleMast.CoID
        and PartyMaster.WorkYear = SaleMast.WorkYear
        and PartyMaster.PartyCode = SaleMast.PartyCode

        and Collection.IDNumber = '$IDNumber'
        and Collection.WorkYear = '$WorkYear'
        and Collection.CoID='$CoID'
    ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }
  //  function Get_Slip_Header($IDNumber)
  function Get_Slip_Header($CollectDate)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = " 
                   SELECT 'DEBTOR' PartyName,TotalChqAmt, DepBankcode, CollectDate, CheqNo
                    FROM Collection
                    where Collection.CoID = '$CoID'
                    and Collection.WorkYear = '$WorkYear'
                    and Collection.CollectDate = '$CollectDate'
              ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }
  //  and Collection.IDNumber = '$IDNumber'


  //  function Get_Slip_Data($IDNumber)
  function Get_Slip_Data($CollectDate)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = " 
              SELECT 
                        Collection.CollectDate,
                        PartyMaster.PartyName, PartyArea, 
                        Collection.CheqNo,
                        (select BankTitle
                                  from  BankMaster 
                                where Collection.CheqBankCode = BankMaster.BankCode) BankTitle,
                        (select BankBranch
                                  from  BankMaster 
                                where Collection.CheqBankCode = BankMaster.BankCode) BankBranch,

                        (select ACTitle
                                from  ACMaster
                              where Collection.DepBankcode = ACMaster.ACCode
                                and Collection.CoID = ACMaster.CoID 
                                and Collection.WorkYear = ACMaster.WorkYear) BankName,

                        (select AccountNo
                                from  ACMaster
                              where Collection.DepBankcode = ACMaster.ACCode
                              and Collection.CoID = ACMaster.CoID 
                              and Collection.WorkYear = ACMaster.WorkYear) AccountNo,

                        (select AccountType
                              from  ACMaster
                            where Collection.DepBankcode = ACMaster.ACCode
                            and Collection.CoID = ACMaster.CoID 
                            and Collection.WorkYear = ACMaster.WorkYear) AccountType,


                        Collection.ChequeAmt, Collection.TotalChqAmt,
                        if(Collection.ChqDate='0000-00-00','null',Collection.ChqDate) ChqDate,  
                        Collection.UTRNo  
              FROM Collection, SaleMast, PartyMaster
              WHERE Collection.CollectDate = '$CollectDate'
                and Collection.CoID = '$CoID'
                and Collection.WorkYear = '$WorkYear'
                and Collection.ChequeAmt > 0
                and Collection.CoID = SaleMast.CoID
                and Collection.WorkYear = SaleMast.WorkYear
                and Collection.BillNo = SaleMast.BillNo
                and SaleMast.PartyCode = PartyMaster.PartyCode
                and SaleMast.CoID = PartyMaster.CoID 
                and SaleMast.WorkYear = PartyMaster.WorkYear
                and Collection.TotalChqAmt > 0
            ";

    $query = $this->db->query($sql);
    $result = $query->result_array();
    return $result;
  }


  function get_CollectionDatewise()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "";
    $f = "";
    $t = "";
    $dt = date("d-m-yy");
    $current_month = date("m");
    $current_year = date("yy");
    $w = explode("-", $WorkYear);
    $WY = '20' . $w[1];

    if ((int)$WY > (int)$current_year) {
      $f = date("$current_year-$current_month-01", strtotime($dt));
      $t = date("$current_year-$current_month-t", strtotime($dt));
    } else {
      $f = date("$WY-03-01", strtotime($dt));
      $t = date("$WY-03-t", strtotime($dt));
    }
    $sql = "        
                    Select 
                          c.IDNumber as 'IDN No',
                          c.Mode,
                          c.BillNo,
                          DATE_FORMAT(c.CollectDate,'%d-%m-%Y') as ReceiptDate,
                          DATE_FORMAT(sm.BillDate,'%d-%m-%Y') as BillDate,
                          c.LDays,
                          c.DebtorCode,
                          dn.ACTitle as DebtorName,
                          pm.PartyCode,
                          pm.PartyName,
                          pm.PartyArea as 'Area Name',
                          c.BrokerCode,
                          ac.ACTitle as BrokerName,
                          c.DebtorAmt as BillAmt,
                          c.ChequeAmt,
                          c.CashAmt,
                          c.VatavAmt,
                          c.BrokAmt,
                          c.IntAmt,
                          c.IntDue,
                          c.LFeeAmt,
                          c.Chithi as 'Chithi Amt',
                          c.KasarAmt,
                          c.ReceiptNo as RCTNo,
                          c.CashCode,
                          c.DepBankcode as 'Depo Bank',
                          c.CheqNo,
                          c.CheqBankCode,
                          c.UTRNo,
                          c.TaxCode,
                          c.GSTTaxableAmt,
                          c.CGSTAmt,
                          c.SGSTAmt,
                          c.IGSTAmt,
                          c.TotalGSTAmt,
                          pm.PartyGSTNo as GSTNo,            
                          pm.PartyAddressI as Address,
                          pm.StateCode,
                          pm.PartyState as StateName
                  
                    from Collection c left join SaleMast sm
                    on c.CoID=sm.CoID AND c.WorkYear=sm.WorkYear 
                    AND c.BillNo=sm.BillNo 
                    left join PartyMaster pm
                    on sm.PartyCode=pm.PartyCode 
                    AND sm.PartyID=pm.PartyName 
                    AND sm.Area=pm.PartyArea 
                    AND sm.CoID = pm.CoID
                    AND sm.WorkYear = pm.WorkYear
                    left join ACMaster ac
                    on c.CoID=ac.CoID 
                    AND c.WorkYear=ac.WorkYear 
                    AND c.BrokerCode=ac.ACCode 
                    left join ACMaster dn
                    on c.CoID=dn.CoID 
                    AND c.WorkYear=dn.WorkYear 
                    AND c.DebtorCode=dn.ACCode
                    AND c.CoID = '$CoID'
                    AND c.WorkYear = '$WorkYear'
                   where  c.CollectDate  BETWEEN '$f' AND '$t'
                   order by c.CollectDate desc
               ";
    $query = $this->db->query($sql)->result_array();
    if (empty($query)) {
      $sql = "          
                Select 
                          c.IDNumber as 'IDN No',
                          c.Mode,
                          c.BillNo,
                          DATE_FORMAT(c.CollectDate,'%d-%m-%Y') as ReceiptDate,
                          DATE_FORMAT(sm.BillDate,'%d-%m-%Y') as BillDate,
                          c.LDays,
                          c.DebtorCode,
                          dn.ACTitle as DebtorName,
                          pm.PartyCode,
                          pm.PartyName,
                          pm.PartyArea as 'Area Name',
                          c.BrokerCode,
                          ac.ACTitle as BrokerName,
                          c.DebtorAmt as BillAmt,
                          c.ChequeAmt,
                          c.CashAmt,
                          c.VatavAmt,
                          c.BrokAmt,
                          c.IntAmt,
                          c.IntDue,
                          c.LFeeAmt,
                          c.Chithi as 'Chithi Amt',
                          c.KasarAmt,
                          c.ReceiptNo as RCTNo,
                          c.CashCode,
                          c.DepBankcode as 'Depo Bank',
                          c.CheqNo,
                          c.CheqBankCode,
                          c.UTRNo,
                          c.TaxCode,
                          c.GSTTaxableAmt,
                          c.CGSTAmt,
                          c.SGSTAmt,
                          c.IGSTAmt,
                          c.TotalGSTAmt,
                          pm.PartyGSTNo as GSTNo,            
                          pm.PartyAddressI as Address,
                          pm.StateCode,
                          pm.PartyState as StateName
                  
                    from Collection c left join SaleMast sm
                    on c.CoID=sm.CoID AND c.WorkYear=sm.WorkYear 
                    AND c.BillNo=sm.BillNo 
                    left join PartyMaster pm
                    on sm.PartyCode=pm.PartyCode 
                    AND sm.PartyID=pm.PartyName 
                    AND sm.Area=pm.PartyArea 
                    AND sm.CoID = pm.CoID
                    AND sm.WorkYear = pm.WorkYear
                    left join ACMaster ac
                    on c.CoID=ac.CoID 
                    AND c.WorkYear=ac.WorkYear 
                    AND c.BrokerCode=ac.ACCode 
                    left join ACMaster dn
                    on c.CoID=dn.CoID 
                    AND c.WorkYear=dn.WorkYear 
                    AND c.DebtorCode=dn.ACCode limit 1
       
      ";
      $query = $this->db->query($sql);
      $ea = array("empty");

      foreach ($query->list_fields() as $field) {
        array_push($ea, $field);
      }

      return array($ea, $f, $t);
    }
    return array($query, $f, $t);
  }

  function get_CollectionDatewiseFilter($fromDate, $toDate)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "        
            Select 
                      c.IDNumber as 'IDN No',
                      c.Mode,
                      c.BillNo,
                      DATE_FORMAT(c.CollectDate,'%d-%m-%Y') as ReceiptDate,
                      DATE_FORMAT(sm.BillDate,'%d-%m-%Y') as BillDate,
                      c.LDays,
                      c.DebtorCode,
                      dn.ACTitle as DebtorName,
                      pm.PartyCode,
                      pm.PartyName,
                      pm.PartyArea as 'Area Name',
                      c.BrokerCode,
                      ac.ACTitle as BrokerName,
                      c.DebtorAmt as BillAmt,
                      c.ChequeAmt,
                      c.CashAmt,
                      c.VatavAmt,
                      c.BrokAmt,
                      c.IntAmt,
                      c.IntDue,
                      c.LFeeAmt,
                      c.Chithi as 'Chithi Amt',
                      c.KasarAmt,
                      c.ReceiptNo as RCTNo,
                      c.CashCode,
                      c.DepBankcode as 'Depo Bank',
                      c.CheqNo,
                      c.CheqBankCode,
                      c.UTRNo,
                      c.TaxCode,
                      c.GSTTaxableAmt,
                      c.CGSTAmt,
                      c.SGSTAmt,
                      c.IGSTAmt,
                      c.TotalGSTAmt,
                      pm.PartyGSTNo as GSTNo,            
                      pm.PartyAddressI as Address,
                      pm.StateCode,
                      pm.PartyState as StateName

              from Collection c left join SaleMast sm
              on c.CoID=sm.CoID AND c.WorkYear=sm.WorkYear 
              AND c.BillNo=sm.BillNo 
              left join PartyMaster pm
              on sm.PartyCode=pm.PartyCode 
              AND sm.PartyID=pm.PartyName 
              AND sm.Area=pm.PartyArea 
              AND sm.CoID = pm.CoID
              AND sm.WorkYear = pm.WorkYear
              left join ACMaster ac
              on c.CoID=ac.CoID 
              AND c.WorkYear=ac.WorkYear 
              AND c.BrokerCode=ac.ACCode 
              left join ACMaster dn
              on c.CoID=dn.CoID 
              AND c.WorkYear=dn.WorkYear 
              AND c.DebtorCode=dn.ACCode
              AND c.CoID = '$CoID'
              AND c.WorkYear = '$WorkYear'
              where c.CollectDate BETWEEN '$fromDate' AND '$toDate'
                order by c.CollectDate desc 
            ";
    $query = $this->db->query($sql)->result_array();



    if (empty($query)) {


      $sql = "        
            
      Select 
                        c.IDNumber as 'IDN No',
                        c.Mode,
                        c.BillNo,
                        DATE_FORMAT(c.CollectDate,'%d-%m-%Y') as ReceiptDate,
                        DATE_FORMAT(sm.BillDate,'%d-%m-%Y') as BillDate,
                        c.LDays,
                        c.DebtorCode,
                        dn.ACTitle as DebtorName,
                        pm.PartyCode,
                        pm.PartyName,
                        pm.PartyArea as 'Area Name',
                        c.BrokerCode,
                        ac.ACTitle as BrokerName,
                        c.DebtorAmt as BillAmt,
                        c.ChequeAmt,
                        c.CashAmt,
                        c.VatavAmt,
                        c.BrokAmt,
                        c.IntAmt,
                        c.IntDue,
                        c.LFeeAmt,
                        c.Chithi as 'Chithi Amt',
                        c.KasarAmt,
                        c.ReceiptNo as RCTNo,
                        c.CashCode,
                        c.DepBankcode as 'Depo Bank',
                        c.CheqNo,
                        c.CheqBankCode,
                        c.UTRNo,
                        c.TaxCode,
                        c.GSTTaxableAmt,
                        c.CGSTAmt,
                        c.SGSTAmt,
                        c.IGSTAmt,
                        c.TotalGSTAmt,
                        pm.PartyGSTNo as GSTNo,            
                        pm.PartyAddressI as Address,
                        pm.StateCode,
                        pm.PartyState as StateName
                
                  from Collection c left join SaleMast sm
                  on c.CoID=sm.CoID AND c.WorkYear=sm.WorkYear 
                  AND c.BillNo=sm.BillNo 
                  left join PartyMaster pm
                  on sm.PartyCode=pm.PartyCode 
                  AND sm.PartyID=pm.PartyName 
                  AND sm.Area=pm.PartyArea 
                  AND sm.CoID = pm.CoID
                  AND sm.WorkYear = pm.WorkYear
                  left join ACMaster ac
                  on c.CoID=ac.CoID 
                  AND c.WorkYear=ac.WorkYear 
                  AND c.BrokerCode=ac.ACCode 
                  left join ACMaster dn
                  on c.CoID=dn.CoID 
                  AND c.WorkYear=dn.WorkYear 
                  AND c.DebtorCode=dn.ACCode limit 1

      ";
      $query = $this->db->query($sql);
      $ea = array("empty");

      foreach ($query->list_fields() as $field) {
        array_push($ea, $field);
      }

      return array($ea, $fromDate, $toDate);
    }


    return  array($query, $fromDate, $toDate);
  }

  function x_get_CollectionDatewise()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
                 Select c.*,sm.BillDate,pm.PartyCode,pm.PartyName,pm.PartyArea,pm.PartyGSTNo,pm.PartyAddressI,pm.StateCode,pm.PartyState,ac.ACTitle as BrokerName,dn.ACTitle as DebtorName
                   from Collection c 
                      left join SaleMast sm
                      on c.CoID=sm.CoID AND c.WorkYear=sm.WorkYear AND c.BillNo=sm.BillNo 
                      left join PartyMaster pm
                      on sm.PartyCode=pm.PartyCode AND sm.PartyID=pm.PartyName AND sm.Area=pm.PartyArea AND sm.CoID = pm.CoID AND sm.WorkYear = pm.WorkYear 
                      left join ACMaster ac
                      on c.CoID=ac.CoID AND c.WorkYear=ac.WorkYear AND c.BrokerCode=ac.ACCode 
                      left join ACMaster dn
                      on c.CoID=dn.CoID AND c.WorkYear=dn.WorkYear AND c.DebtorCode=dn.ACCode
                  where c.CoID = '$CoID' 
                    and c.WorkYear='$WorkYear'
                 order by c.CollectDate desc
                 ";
    $query = $this->db->query($sql)->result_array();
    return $query;
  }

  function x_get_CollectionDatewiseFilter($fromYear, $toYear)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
                  Select c.*,sm.BillDate,pm.PartyCode,pm.PartyName,pm.PartyArea,pm.PartyGSTNo,pm.PartyAddressI,pm.StateCode,pm.PartyState,ac.ACTitle as BrokerName,dn.ACTitle as DebtorName
                  from Collection c 
                      left join SaleMast sm
                      on c.CoID=sm.CoID AND c.WorkYear=sm.WorkYear AND c.BillNo=sm.BillNo 
                      left join PartyMaster pm
                      on sm.PartyCode=pm.PartyCode AND sm.PartyID=pm.PartyName AND sm.Area=pm.PartyArea AND sm.CoID = pm.CoID AND sm.WorkYear = pm.WorkYear
                      left join ACMaster ac
                      on c.CoID=ac.CoID AND c.WorkYear=ac.WorkYear AND c.BrokerCode=ac.ACCode 
                      left join ACMaster dn
                      on c.CoID=dn.CoID AND c.WorkYear=dn.WorkYear AND c.DebtorCode=dn.ACCode
                  where c.CoID = '$CoID' 
                    and c.WorkYear='$WorkYear'
                    and c.CollectDate BETWEEN '$fromYear' AND '$toYear'
                    order by c.CollectDate desc
                 ";
    $query = $this->db->query($sql)->result_array();
    return $query;
  }

  function get_details($CoID, $WorkYear)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $fromYear = "";
    $toYear = "";
    $current_month = date("m");
    $current_year = date("Y");
    $yearArray = explode("-", $WorkYear);
    $year = explode("-", $yearArray[0]);
    $WY = substr($year[0], 0, 2) . $yearArray[1];

    if ((int)$WY > (int)$current_year) {
      $fromYear = date("$current_year-$current_month-01");
      $toYear = date("$current_year-$current_month-t");
    } else {
      $fromYear = date("$WY-03-01");
      $toYear = date("$WY-03-t");
    }
    $sql = "
              SELECT 
                        DISTINCT IDNumber,
                        CollectDate,
                        sum(ChequeAmt) As ChequeAmt,
                        sum(CashAmt) As CashAmt
              FROM Collection
              Where CoID = '$CoID'
              And WorkYear = '$WorkYear'
              Group by cast(IDNumber as Integer) DESC 
          ";
    $result = $this->db->query($sql)->result_array();

    if (empty($result)) {
      $emptyArray = array("empty");
      return array($emptyArray, $fromYear, $toYear);
    }
    return array($result, $fromYear, $toYear);
  }

  // Get Collection Details Datewise for CollectionGrid
  function get_detailsFilter($fromYear, $toYear)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = " 
          SELECT 
              DISTINCT IDNumber,
              CollectDate,
              sum(ChequeAmt) As ChequeAmt,
              sum(CashAmt) As CashAmt
              FROM Collection
            Where CoID = '$CoID'
              And WorkYear = '$WorkYear'
              AND CollectDate BETWEEN '$fromYear' AND '$toYear'
            Group by IDNumber
            order by CollectDate DESC       
      ";
    $result = $this->db->query($sql)->result_array();

    if (empty($result)) {
      $emptyArray = array("empty");
      return array($emptyArray, $fromYear, $toYear);
    }

    return  array($result, $fromYear, $toYear);
  }


  function x_get_details_180521($CoID, $WorkYear)
  {
    $sql = "
          SELECT 
            DISTINCT IDNumber,
            CollectDate,
            sum(ChequeAmt) As ChequeAmt,
            sum(CashAmt) As CashAmt
            FROM Collection
            Where CoID = '$CoID'
            And WorkYear = '$WorkYear'
            Group by cast(IDNumber as Integer) DESC 
        ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function get_details2($CoID, $WorkYear)
  {
    $sql = "
          SELECT 
            DISTINCT IDNumber,
            CollectDate,
            sum(ChequeAmt) As ChequeAmt,
            sum(CashAmt) As CashAmt
            FROM Collection
            Where CoID = '$CoID'
            And WorkYear = '$WorkYear'
            Group by IDNumber
        ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  // function getBillWiseData($CoID,$WorkYear,$billno)
  // {
  //   $sql ="
  //   SELECT ID, IDNumber,BillNo, 
  //   LDays, VatavRate, VatavAmt, 
  //   BrokRate, BrokAmt, IntRate, 
  //   IntAmt, LFeeRate, LFeeAmt, 
  //   Chithi, ChequeAmt, CashAmt, KasarAmt 
  //   FROM Collection
  //   WHERE BillNo = '$billno'
  //   And CoID = '$CoID'
  //   And WorkYear = '$WorkYear'
  //   ";
  //   $query = $this->db->query($sql);
  //     $result = $query->result();
  //     return $result;
  //   }

  function getBillWiseData($CoID, $WorkYear, $IDNumber)
  {
    $sql = "
        SELECT ID, IDNumber,BillNo, 
        LDays, VatavRate, VatavAmt, 
        BrokRate, BrokAmt, IntRate, 
        IntAmt, LFeeRate, LFeeAmt, 
        Chithi, ChequeAmt, CashAmt, KasarAmt 
        FROM Collection
        WHERE IDNumber = '$IDNumber'
        And CoID = '$CoID'
        And WorkYear = '$WorkYear'
        ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function getData($CoID, $WorkYear, $IDNumber)
  {
    $sql = "
            SELECT 
              IDNumber,
              CollectDate,
              ReceiptNo,
              SlipNo,
              TotalCashAmt,
              CashCode,
              (SELECT
                ACTitle
                GroupCode 
                  FROM ACMaster
                  Where (GroupCode = 'BZ' )
                          and CashCode = ACMaster.ACCode
                          and CoID = '$CoID'
                          and WorkYear = '$WorkYear') as CashTitle,
              TotalChqAmt,
              DepBankCode,
              (SELECT
                ACTitle
                GroupCode 
                  FROM ACMaster
                  Where (GroupCode = 'BB' )
                          and DepBankCode = ACMaster.ACCode
                          and CoID = '$CoID'
                          and WorkYear = '$WorkYear') as DepBankTitle,
              CheqNo,
              UTRNo,
              ReturnAmt,
              CheqBankCode,
              (SELECT
                BankTitle
                  FROM BankMaster
                  Where CheqBankCode = BankMaster.BankCode ) as CheqBankTitle,
              TrCode,
              ChqDate 
            from Collection 
            Where IDNumber = '$IDNumber'
            and CoID = '$CoID'
            and WorkYear = '$WorkYear'
          ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function getBankData($CoID, $WorkYear, $IDNumber, $ID)
  {
    $sql = "
            SELECT 
              BillNo,
              ReceiptNo,
              SlipNo,
              CashCode,
              DepBankCode,
              CheqNo,
              UTRNo,
              ReturnAmt,
              CheqBankCode,
              TrCode,
              ChqDate 
            from Collection 
            Where IDNumber = '$IDNumber'
            and ID = '$ID'
            and CoID = '$CoID'
            and WorkYear = '$WorkYear'
          ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function getDataByID($CoID, $WorkYear, $id)
  {
    $sql = "
          SELECT 
          IDNumber,
            CollectDate,
            ReceiptNo,
            SlipNo,
            TotalCashAmt,
            CashCode,
            TotalChqAmt,
            DepBankCode,
            CheqNo,
            UTRNo,
            ReturnAmt,
            CheqBankCode,
            TrCode,
            ChqDate 
          from 
          Collection 
          Where ID = '$id'
          and CoID = '$CoID'
          and WorkYear = '$WorkYear'
          ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function getDataByIDNum($CoID, $WorkYear, $idnum)
  {
    $sql = "
              SELECT 
                  IDNumber,
                  CollectDate,
                  ReceiptNo,
                  SlipNo,
                  TotalCashAmt,
                  CashCode,
                  TotalChqAmt,
                  DepBankCode,
                  CheqNo,
                  UTRNo,
                  ReturnAmt,
                  CheqBankCode,
                  TrCode,
                  ChqDate
            from 
            Collection 
            Where IDNumber = '$idnum'
            and CoID = '$CoID'
            and WorkYear = '$WorkYear'
          ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function getBillWiseData1($CoID, $WorkYear, $idnumber)
  {
    $sql = "
        SELECT ID, IDNumber, BillNo, 
        LDays, VatavRate, VatavAmt, 
        BrokRate, BrokAmt, IntRate, 
        IntAmt, LFeeRate, LFeeAmt, 
        Chithi, ChequeAmt, CashAmt, KasarAmt 
        FROM Collection
        WHERE IDNumber = '$idnumber'
        And CoID = '$CoID'
        And WorkYear = '$WorkYear'
        ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }


  function getTotals($IDNumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
          SELECT 
              sum(VatavAmt) As VatavAmt,
              sum(BrokAmt) AS BrokAmt,
              sum(IntAmt) As IntAmt,
              sum(LFeeAmt) As LFee,
              sum(Chithi) As Chithi,
              sum(ChequeAmt) As ChequeAmt,
              sum(CashAmt) as CashAmt,
              sum(KasarAmt) As Kasar
              FROM Collection
              Where IDNumber = '$IDNumber'
              and CoID = '$CoID'
              and WorkYear = '$WorkYear'
          ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function getBillAmt($billno)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
              SELECT BillAmt From SaleMast Where BillNo = '$billno' and CoID = '$CoID' and WorkYear = '$WorkYear'
              ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function getBillNo($id)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
              SELECT BillNo From Collection Where ID = '$id' and CoID = '$CoID' and WorkYear = '$WorkYear'
              ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function getBillNo1($id)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
              SELECT BillNo From Collection Where IDNumber = '$id' and CoID = '$CoID' and WorkYear = '$WorkYear'
              ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function getTotals1($CoID, $WorkYear, $idnumber)
  {
    $sql = "
          SELECT 
              count(BillNo) As BillCount,
              sum(VatavAmt) As VatavAmt,
              sum(BrokAmt) AS BrokAmt,
              sum(IntAmt) As IntAmt,
              sum(LFeeAmt) As LFee,
              sum(Chithi) As Chithi,
              sum(ChequeAmt) As ChequeAmt,
              sum(CashAmt) as CashAmt,
              sum(KasarAmt) As Kasar
              FROM Collection
              Where IDNumber = '$idnumber'
              And CoID = '$CoID'
              and WorkYear = '$WorkYear'
          ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  //   public function party_name_ddmodel()
  //   {
  //   $this->db->select('ACCode, ACTitle');
  //   $this->db->from('ACMastDets');
  //   $query = $this->db->get();

  //   foreach($query->result_array() as $row)
  //   {
  //      $data[] = array(
  //         'ACCode' => $row['ACCode'],
  //         'ACTitle' => $row['ACTitle']
  //     );
  //   }
  // }

  public function pname_ddmodel()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
                  SELECT 
                  PartyCode,
                  PartyName
                  From PartyMaster
                  where CoID = '$CoID' 
                    and WorkYear = '$WorkYear'
          ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  //ACcount help
  function Get_Party_List()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
            SELECT ACCode as PartyCode,ACTitle as PartyName
            FROM ACMaster
            where CoID = '$CoID'
            and WorkYear = '$WorkYear'
            and GroupCode = 'BD'
        ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function getPartyCode($ACCode)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
            SELECT ACCode as PartyCode,ACTitle as PartyName
            FROM ACMaster
            where CoID = '$CoID'
            and WorkYear = '$WorkYear'
            AND ACCode like '$ACCode%'
            and GroupCode = 'BD'
        ";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  function getPartyName($ACTitle)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
            SELECT ACCode as PartyCode,ACTitle as PartyName
            FROM ACMaster
            where CoID = '$CoID'
            and WorkYear = '$WorkYear'
            AND ACTitle like '$ACTitle%'
            and GroupCode = 'BD'
        ";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  function Get_Customer_List()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
        SELECT
          PartyCode,
          PartyName,
          PartyArea,
          BrokerCode,
          BrokerTitle,
          PartyType
        FROM PartyMaster
        where CoID = '$CoID' 
          and WorkYear = '$WorkYear'";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function getCustomer($PartyName)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
        SELECT
          PartyCode,
          PartyName,
          PartyArea,
          BrokerCode,
          BrokerTitle,
          PartyType
        FROM PartyMaster
        where PartyName like '$PartyName%'
          and CoID = '$CoID' 
          and WorkYear = '$WorkYear'";

    $query = $this->db->query($sql);
    return $query->result_array();
  }

  function Get_Broker_List($CoID, $WorkYear)
  {
    $sql = "
        SELECT
          ACCode,
          ACTitle,
          GroupCode 
        FROM ACMaster
        Where CoID = '$CoID'
        and WorkYear = '$WorkYear'
        and GroupCode = 'B1'
        ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }


  function getBrokerCode($ACCode)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
        SELECT
          ACCode,
          ACTitle,
          GroupCode 
        FROM ACMaster
        Where CoID = '$CoID'
        and WorkYear = '$WorkYear'
        and GroupCode = 'B1'
        AND ACCode like '$ACCode%'
        ";

    $query = $this->db->query($sql);
    return $query->result_array();
  }


  function getBrokerName($ACTitle)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
        SELECT
          ACCode,
          ACTitle,
          GroupCode 
        FROM ACMaster
        Where CoID = '$CoID'
        and WorkYear = '$WorkYear'
        and GroupCode = 'B1'
        AND ACTitle like '$ACTitle%'
        ";

    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function customer_name_ddmodel()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $this->db->select('PartyCode, PartyName');
    $this->db->from('PartyMaster');
    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear);
    $this->db->where($multi_where);
    $query = $this->db->get();

    foreach ($query->result_array() as $row) {
      $data[] = array(
        'PartyCode' => $row['PartyCode'],
        'PartyName' => $row['PartyName']
      );
    }
  }

  function getid($IDNumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
      
              SELECT LastCollectionIDNumber 
                from CompData 
                WHERE CoID = '$CoID'
                AND WorkYear = '$WorkYear'
      
      ";
    $query = $this->db->query($sql);
    $result = $query->result();

    $NewValue = IntVal($result[0]->LastCollectionIDNumber) + 1;

    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear);
    $data2 = array('LastCollectionIDNumber' => $NewValue);
    $this->db->where($multi_where);
    $this->db->update('CompData', $data2);

    return strval($NewValue);
  }

  function getEditData($id)
  {
    $sql = "
              SELECT 
                  Collection.ID,
                  Collection.IDNumber,
                  Collection.BillNo As BillNo,
                  Collection.CollectDate,
                  Collection.Mode,
                  Collection.DebtorCode,
                  (select ACMaster.ACTitle 
                                from ACMaster 
                                where ACMaster.CoID = SaleMast.CoID 
                                  and ACMaster.WorkYear = SaleMast.WorkYear
                                  and ACMaster.ACCode = SaleMast.DebtorID ) as DebtorName,
                  SaleMast.PartyCode as CustomerCode,
                  (select PartyMaster.PartyName 
                                from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                                  and SaleMast.CoID = PartyMaster.CoID
                                  and SaleMast.WorkYear = PartyMaster.WorkYear) as CustomerName,
                  Collection.BrokerCode,
                  (select ACMaster.ACTitle 
                                  from ACMaster 
                                  where ACMaster.CoID = SaleMast.CoID 
                                    and ACMaster.WorkYear = SaleMast.WorkYear
                                    and ACMaster.ACCode = SaleMast.BrokerID ) as BrokerTitle,
                  Collection.LDays,
                  Collection.VatavRate,
                  Collection.VatavAmt,
                  Collection.BrokRate,
                  Collection.BrokAmt,
                  Collection.IntAmt,
                  Collection.IntRate,
                  Collection.LFeeRate,
                  Collection.LFeeAmt,
                  Collection.Chithi,
                  Collection.ChequeAmt,
                  Collection.CashAmt As CashAmt,
                  Collection.KasarAmt As KasarAmt,
                  SaleMast.RcptAmt As RcptAmt,
                  SaleMast.BillDate As BillDate,
                  SaleMast.ItemAmt,
                  SaleMast.BillAmt As BillAmt
              From Collection, SaleMast
              WHERE Collection.ID = '$id'
                  and Collection.CoID =SaleMast.CoID
                  and Collection.WorkYear = SaleMast.WorkYear
                  AND Collection.BillNo = SaleMast.BillNo    
        ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }


  // Cash Account
  function Get_ACMaster_List($CoID, $WorkYear)
  {
    $sql = "
            SELECT
              ACCode,
              ACTitle,
              GroupCode 
            FROM ACMaster
            Where (GroupCode = 'BZ' )
            and CoID = '$CoID'
            and WorkYear = '$WorkYear'
        ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function GetCashAccount($CoID, $WorkYear, $ACCode)
  {
    $sql = "
            SELECT
              ACCode,
              ACTitle,
              GroupCode 
            FROM ACMaster
            Where (GroupCode = 'BZ' )
            and CoID = '$CoID'
            and WorkYear = '$WorkYear'
            and ACCode like '$ACCode%'
        ";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  // Deposit Bank 
  function Get_ACMaster_List1($CoID, $WorkYear)
  {
    $sql = "
        SELECT
          ACCode,
          ACTitle,
          GroupCode 
        FROM ACMaster
        Where (GroupCode = 'BB')
        and CoID = '$CoID'
        and WorkYear = '$WorkYear'
        ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function GetDepositBank($CoID, $WorkYear, $ACCode)
  {
    $sql = "
            SELECT
              ACCode,
              ACTitle,
              GroupCode 
            FROM ACMaster
            Where (GroupCode = 'BB' )
            and CoID = '$CoID'
            and WorkYear = '$WorkYear'
            and ACCode like '$ACCode%'
        ";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  // Cheque Bank
  function Get_Bank_List()
  {
    $sql = "
        SELECT
          BankCode,
          BankTitle 
        FROM BankMaster
        ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function GetChequeBank($BankCode)
  {
    $sql = "
            SELECT
            BankCode,
            BankTitle 
            FROM BankMaster
            where BankCode like '$BankCode%'
        ";
    $query = $this->db->query($sql);
    return $query->result_array();
  }


  // Get data for Party
  function Get_Party_Data($CoID, $WorkYear, $ACCode)
  {
    $sql = "SELECT distinct
                SaleMast.BillNo As BillNo,
                SaleMast.CoID AS Comp,
                SaleMast.DebtorID,
                (select ACMaster.ACTitle 
                            from ACMaster 
                            where ACMaster.CoID = SaleMast.CoID 
                              and ACMaster.WorkYear = SaleMast.WorkYear
                              and ACMaster.ACCode = SaleMast.DebtorID ) as DebtorName,
                SaleMast.PartyCode,
                PartyMaster.PartyName, 
                SaleMast.BrokerID as BrokerCode,
                PartyMaster.PartyArea as Area, 
                    (select ACMaster.ACTitle 
                              from ACMaster 
                              where ACMaster.CoID = SaleMast.CoID 
                                and ACMaster.WorkYear = SaleMast.WorkYear
                                and ACMaster.ACCode = SaleMast.BrokerID ) as BrokerTitle,
                            
                SaleMast.BillDate As BillDate,
                SaleMast.ItemAmt As ItemAmt, 
                SaleMast.BillAmt As BillAmt,
                (
                ifnull(
                        (SELECT sum(ACCAmount)*(-1)
                            from ACCDetails
                            where ACCDetails.CoID=SaleMast.CoID
                            and ACCDetails.WorkYear=SaleMast.WorkYear
                            and ACCDetails.BillNo=SaleMast.BillNo
                        ),
                      0)
                +
                IFNULL(
                        (SELECT sum(
                                      VatavAmt+
                                      BrokAmt+
                                      (IntAmt+LFeeAmt+Chithi)+
                                      ChequeAmt+CashAmt+KasarAmt
                                    ) 
                          FROM Collection
                          where Collection.WorkYear = SaleMast.WorkYear
                          and Collection.CoID = SaleMast.CoID
                          and Collection.BillNo = SaleMast.BillNo)
                ,0)
                ) as AmtRecd,
                (SaleMast.BillAmt - 
                        IFNULL(
                          (SELECT sum(VatavAmt+BrokAmt+LFeeAmt+Chithi+ChequeAmt+CashAmt+KasarAmt - IntAmt) 
                            FROM Collection
                            where Collection.WorkYear = SaleMast.WorkYear
                            and Collection.CoID = SaleMast.CoID
                            and Collection.BillNo = SaleMast.BillNo)
                          ,0)- 
                          ifnull(
                              (SELECT sum(ACCAmount)*(-1)
                                from ACCDetails
                                where ACCDetails.CoID=SaleMast.CoID
                                and ACCDetails.WorkYear=SaleMast.WorkYear
                                and ACCDetails.BillNo=SaleMast.BillNo
                              ),
                        0)                 
                ) as BalAmt  
                FROM SaleMast, PartyMaster
                where SaleMast.DebtorID = '$ACCode'
                and SaleMast.CoID = '$CoID'
                and SaleMast.WorkYear = '$WorkYear'
                and SaleMast.PartyCode = PartyMaster.PartyCode
                and SaleMast.CoID = PartyMaster.CoID
                and SaleMast.WorkYear = PartyMaster.WorkYear
                having BalAmt > 0 
        ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  // Get data for Customer
  function Get_Cust_Data($CoID, $WorkYear, $ACCode)
  {
    $sql = "SELECT distinct
                  SaleMast.BillNo As BillNo,
                  SaleMast.CoID AS Comp,
                  SaleMast.DebtorID as ACCode,
                  (select ACMaster.ACTitle 
                            from ACMaster 
                            where ACMaster.CoID = SaleMast.CoID 
                              and ACMaster.WorkYear = SaleMast.WorkYear
                              and ACMaster.ACCode = SaleMast.DebtorID ) as ACTitle,
                  SaleMast.PartyCode as CustomerCode,
                  (select PartyMaster.PartyName 
                            from PartyMaster 
                            where SaleMast.PartyCode = PartyMaster.PartyCode
                              and SaleMast.CoID = PartyMaster.CoID
                              and SaleMast.WorkYear = PartyMaster.WorkYear) as CustomerName,
                  (select PartyMaster.PartyArea 
                            from PartyMaster 
                            where SaleMast.PartyCode = PartyMaster.PartyCode
                              and SaleMast.CoID = PartyMaster.CoID
                              and SaleMast.WorkYear = PartyMaster.WorkYear) as Area,
                  SaleMast.BrokerID as BrokerCode,
                  (select ACMaster.ACTitle 
                          from ACMaster 
                          where ACMaster.CoID = SaleMast.CoID 
                          and ACMaster.WorkYear = SaleMast.WorkYear
                          and ACMaster.ACCode = SaleMast.BrokerID ) as BrokerTitle,
                  SaleMast.BillDate As BillDate,
                  SaleMast.ItemAmt As ItemAmt, 
                  SaleMast.BillAmt As BillAmt,
                  (
                ifnull(
                        (SELECT sum(ACCAmount)*(-1)
                            from ACCDetails
                            where ACCDetails.CoID=SaleMast.CoID
                            and ACCDetails.WorkYear=SaleMast.WorkYear
                            and ACCDetails.BillNo=SaleMast.BillNo
                        ),
                      0)
                +
                  IFNULL(
                    (SELECT sum(
                                VatavAmt+
                                BrokAmt-
                                (IntAmt+
                                LFeeAmt+
                                Chithi)+
                                ChequeAmt+
                                CashAmt+
                                KasarAmt 
                                ) 
                      FROM Collection
                      where Collection.WorkYear = SaleMast.WorkYear
                      and Collection.CoID = SaleMast.CoID
                      and Collection.BillNo = SaleMast.BillNo)
                    ,0)
                    ) as AmtRecd,
                    (SaleMast.BillAmt - 
                          IFNULL(
                            (SELECT sum(
                                        VatavAmt+
                                        BrokAmt-
                                        (IntAmt+
                                        LFeeAmt+
                                        Chithi)+
                                        ChequeAmt+
                                        CashAmt+
                                        KasarAmt 
                                      ) 
                              FROM Collection
                              where Collection.WorkYear = SaleMast.WorkYear
                              and Collection.CoID = SaleMast.CoID
                              and Collection.BillNo = SaleMast.BillNo)
                            ,0)- 
                          ifnull(
                              (SELECT sum(ACCAmount)*(-1)
                                from ACCDetails
                                where ACCDetails.CoID=SaleMast.CoID
                                and ACCDetails.WorkYear=SaleMast.WorkYear
                                and ACCDetails.BillNo=SaleMast.BillNo
                              ),
                        0)                   
                      ) as BalAmt  
                  FROM SaleMast
                  where SaleMast.PartyCode = '$ACCode'
                  and SaleMast.CoID = '$CoID'
                  and SaleMast.WorkYear = '$WorkYear'
                  having BalAmt > 0 
        ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  // Get data for Broker
  function Get_Broker_Data($CoID, $WorkYear, $ACCode)
  {
    $sql = "SELECT distinct
              SaleMast.BillNo As BillNo,
              SaleMast.CoID AS Comp,
              SaleMast.BillDate As BillDate,
              SaleMast.DebtorID,
              (select ACMaster.ACTitle 
                            from ACMaster 
                            where ACMaster.CoID = SaleMast.CoID 
                              and ACMaster.WorkYear = SaleMast.WorkYear
                              and ACMaster.ACCode = SaleMast.DebtorID ) as DebtorName,
              SaleMast.PartyCode,
              PartyMaster.PartyName, 
              PartyMaster.PartyArea as Area,
              SaleMast.BrokerID as BrokerCode,
              (select ACMaster.ACTitle 
                            from ACMaster 
                            where ACMaster.CoID = SaleMast.CoID 
                              and ACMaster.WorkYear = SaleMast.WorkYear
                              and ACMaster.ACCode = SaleMast.BrokerID ) as BrokerTitle,
              SaleMast.ItemAmt As ItemAmt, 
              SaleMast.BillAmt As BillAmt,
              (
                ifnull(
                        (SELECT sum(ACCAmount)*(-1)
                            from ACCDetails
                            where ACCDetails.CoID=SaleMast.CoID
                            and ACCDetails.WorkYear=SaleMast.WorkYear
                            and ACCDetails.BillNo=SaleMast.BillNo
                        ),
                      0)
                +
              IFNULL(
                      (SELECT sum(VatavAmt+BrokAmt+LFeeAmt+Chithi+ChequeAmt+CashAmt+KasarAmt - IntAmt) 
                        FROM Collection
                        where Collection.WorkYear = SaleMast.WorkYear
                        and Collection.CoID = SaleMast.CoID
                        and Collection.BillNo = SaleMast.BillNo)
              ,0)
              ) as AmtRecd,
              (SaleMast.BillAmt - 
                      IFNULL(
                        (SELECT sum(VatavAmt+BrokAmt+LFeeAmt+Chithi+ChequeAmt+CashAmt+KasarAmt - IntAmt) 
                          FROM Collection
                          where Collection.WorkYear = SaleMast.WorkYear
                          and Collection.CoID = SaleMast.CoID
                          and Collection.BillNo = SaleMast.BillNo)
                        ,0)- 
                          ifnull(
                              (SELECT sum(ACCAmount)*(-1)
                                from ACCDetails
                                where ACCDetails.CoID=SaleMast.CoID
                                and ACCDetails.WorkYear=SaleMast.WorkYear
                                and ACCDetails.BillNo=SaleMast.BillNo
                              ),
                        0)                   
              ) as BalAmt  
              FROM SaleMast, PartyMaster
              where SaleMast.BrokerID = '$ACCode'
              and SaleMast.CoID = '$CoID'
              and SaleMast.WorkYear = '$WorkYear'
              and SaleMast.PartyCode = PartyMaster.PartyCode
              and SaleMast.CoID = PartyMaster.CoID
              and SaleMast.WorkYear = PartyMaster.WorkYear
              having BalAmt > 0
        ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function Get_Bill_List1($CoID, $WorkYear, $PartyCode)
  {
    $sql = "
                  SELECT
                        SaleMast.BillNo As BillNo,
                        SaleMast.BillDate As BillDate,
                        SaleMast.BillAmt As BillAmt,
                        SaleMast.ItemAmt As ItemAmt, 
                        IFNULL(
                              (SELECT sum(ChequeAmt+CashAmt+KasarAmt) 
                                FROM Collection
                                where Collection.WorkYear = SaleMast.WorkYear
                                and Collection.CoID = SaleMast.CoID
                                and Collection.BillNo = SaleMast.BillNo)
                              ,0) as AmtRecd,
                        (SaleMast.BillAmt - SaleMast.RcptAmt) as BalAmt           
              FROM SaleMast, PartyMaster
              where SaleMast.PartyCode = PartyMaster.PartyCode
              and SaleMast.CoID = PartyMaster.CoID
              and SaleMast.WorkYear = PartyMaster.WorkYear
              and (SaleMast.BillAmt - SaleMast.RcptAmt) > 0
              and SaleMast.PartyCode = '$PartyCode'
              and SaleMast.CoID = '$CoID'
              and SaleMast.WorkYear = '$WorkYear'

                ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }


  function getBillDetails($CoID, $WorkYear, $BillNo)
  {
    $sql = "SELECT 
              SaleMast.BillNo As BillNo,
              SaleMast.CoID AS Comp,
              SaleMast.DebtorID as DebtorCode,
              (select ACMaster.ACTitle 
                        from ACMaster 
                        where ACMaster.CoID = SaleMast.CoID 
                          and ACMaster.WorkYear = SaleMast.WorkYear
                          and ACMaster.ACCode = SaleMast.DebtorID ) as DebtorTitle,
              SaleMast.PartyCode as CustomerCode,
              (select PartyMaster.PartyName 
                        from PartyMaster 
                        where SaleMast.PartyCode = PartyMaster.PartyCode
                          and SaleMast.CoID = PartyMaster.CoID
                          and SaleMast.WorkYear = PartyMaster.WorkYear) as CustomerName,
              (select PartyMaster.PartyArea 
                        from PartyMaster 
                        where SaleMast.PartyCode = PartyMaster.PartyCode
                          and SaleMast.CoID = PartyMaster.CoID
                          and SaleMast.WorkYear = PartyMaster.WorkYear) as Area,
              SaleMast.BrokerID as BrokerCode,
              (select ACMaster.ACTitle 
                      from ACMaster 
                      where ACMaster.CoID = SaleMast.CoID 
                      and ACMaster.WorkYear = SaleMast.WorkYear
                      and ACMaster.ACCode = SaleMast.BrokerID ) as BrokerTitle,
              SaleMast.BillDate As BillDate,
              SaleMast.ItemAmt As ItemAmt, 
              SaleMast.BillAmt As BillAmt,
              IFNULL(
                      (SELECT sum(
                                  VatavAmt+
                                  BrokAmt-
                                  (IntAmt+
                                  LFeeAmt+
                                  Chithi)+
                                  ChequeAmt+
                                  CashAmt+
                                  KasarAmt 
                                  ) 
                        FROM Collection
                        where Collection.WorkYear = SaleMast.WorkYear
                        and Collection.CoID = SaleMast.CoID
                        and Collection.BillNo = SaleMast.BillNo
                        and Collection.CheqReturn<>'Y'
                        )
                      ,0) as AmtRecd,
                      case 
                      when SaleMast.CheqReturn = 'Y'
                      then (SaleMast.BillAmt - 
                          IFNULL(
                            (SELECT sum(
                                        VatavAmt+
                                        BrokAmt-
                                        (IntAmt+
                                        LFeeAmt+
                                        Chithi)+
                                        ChequeAmt+
                                        CashAmt+
                                        KasarAmt 
                                      ) 
                              FROM Collection
                              where Collection.WorkYear = SaleMast.WorkYear
                              and Collection.CoID = SaleMast.CoID
                              and Collection.BillNo = SaleMast.BillNo
                              and Collection.CheqReturn<>'Y'
                              )
                            ,0)+SaleMast.CRChrg                   
                          ) 
                        when SaleMast.CheqReturn <> 'Y'
                        then (SaleMast.BillAmt - 
                          IFNULL(
                            (SELECT sum(
                                        VatavAmt+
                                        BrokAmt-
                                        (IntAmt+
                                        LFeeAmt+
                                        Chithi)+
                                        ChequeAmt+
                                        CashAmt+
                                        KasarAmt 
                                      ) 
                              FROM Collection
                              where Collection.WorkYear = SaleMast.WorkYear
                              and Collection.CoID = SaleMast.CoID
                              and Collection.BillNo = SaleMast.BillNo
                              and Collection.CheqReturn<>'Y'
                              )
                            ,0)                  
                          ) 
                          else 0 end as BalAmt
              
              FROM SaleMast
              where SaleMast.BillNo = '$BillNo'
              and SaleMast.CoID = '$CoID'
              and SaleMast.WorkYear = '$WorkYear'
              -- and SaleMast.CheqReturn = 'N'
        ";


    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function GetReturnBillDetails($CoID, $WorkYear, $BillNo)
  {
    $sql = "SELECT 
              SaleMast.BillNo As BillNo,
              SaleMast.CoID AS Comp,
              SaleMast.DebtorID as DebtorCode,
              (select ACMaster.ACTitle 
                        from ACMaster 
                        where ACMaster.CoID = SaleMast.CoID 
                          and ACMaster.WorkYear = SaleMast.WorkYear
                          and ACMaster.ACCode = SaleMast.DebtorID ) as DebtorTitle,
              SaleMast.PartyCode as CustomerCode,
              (select PartyMaster.PartyName 
                        from PartyMaster 
                        where SaleMast.PartyCode = PartyMaster.PartyCode
                          and SaleMast.CoID = PartyMaster.CoID
                          and SaleMast.WorkYear = PartyMaster.WorkYear) as CustomerName,
              (select PartyMaster.PartyArea 
                        from PartyMaster 
                        where SaleMast.PartyCode = PartyMaster.PartyCode
                          and SaleMast.CoID = PartyMaster.CoID
                          and SaleMast.WorkYear = PartyMaster.WorkYear) as Area,
              SaleMast.BrokerID as BrokerCode,
              (select ACMaster.ACTitle 
                      from ACMaster 
                      where ACMaster.CoID = SaleMast.CoID 
                      and ACMaster.WorkYear = SaleMast.WorkYear
                      and ACMaster.ACCode = SaleMast.BrokerID ) as BrokerTitle,
              SaleMast.BillDate As BillDate,
              SaleMast.ItemAmt As ItemAmt, 
              SaleMast.BillAmt As BillAmt,
              IFNULL(
                      (SELECT sum(
                                  VatavAmt+
                                  BrokAmt-
                                  (IntAmt+
                                  LFeeAmt+
                                  Chithi)+
                                  ChequeAmt+
                                  CashAmt+
                                  KasarAmt
                                  ) 
                        FROM Collection
                        where Collection.WorkYear = SaleMast.WorkYear
                        and Collection.CoID = SaleMast.CoID
                        and Collection.BillNo = SaleMast.BillNo
                        and Collection.CheqReturn='N'
                        )
                      ,0) as AmtRecd,
              (SaleMast.BillAmt - 
                    IFNULL(
                      (SELECT sum(
                                  VatavAmt+
                                  BrokAmt-
                                  (IntAmt+
                                  LFeeAmt+
                                  Chithi)+
                                  ChequeAmt+
                                  CashAmt+
                                  KasarAmt
                                ) 
                        FROM Collection
                        where Collection.WorkYear = SaleMast.WorkYear
                        and Collection.CoID = SaleMast.CoID
                        and Collection.BillNo = SaleMast.BillNo
                        and Collection.CheqReturn='N'
                        )
                      ,0)+ SaleMast.CRChrg                  
              ) as BalAmt  
              FROM SaleMast
              where SaleMast.BillNo = '$BillNo'
              and SaleMast.CoID = '$CoID'
              and SaleMast.WorkYear = '$WorkYear'
        ";


    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function checkCheqReturn($billNo)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "SELECT SaleMast.CheqReturn
            from SaleMast,Collection
            where Collection.CoID=SaleMast.CoID 
            and Collection.WorkYear=SaleMast.WorkYear
            and Collection.BillNo=SaleMast.BillNo
            and SaleMast.CoID='$CoID'
            and SaleMast.WorkYear='$WorkYear'
            and SaleMast.BillNo='$billNo'";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }
}
