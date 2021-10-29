<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class GaruPaymentModel extends CI_Model
{
  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  function get_RTGS_details($id)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
            select ACMastDets.ACTitle as PatyName,
                ACMastDets.ACCode as PatyCode,
                concat(ACMastDets.AddressI,'',
                        ACMastDets.AddressII,'',
                        ACMastDets.AddressIII,'',
                        ACMastDets.City) as Address,
                    ACMastDets.BankName,
                    ACMastDets.BankBranch,
                    ACMastDets.BankACNo,
                    DATE_FORMAT(PurPayments.PaymentDate,'%d-%m-%Y') as 'PaymentDate',
                    PurPayments.ChequeNo,
                    PurPayments.TotalChequeAmt,
                    ACMastDets.BankRTGSCode,
                    ACMastDets.PanNo,
                    ACMastDets.CellPhone1
                from PurPayments,ACMastDets
                    where PurPayments.CoID = ACMastDets.CoID
                    and PurPayments.WorkYear=ACMastDets.WorkYear
                    and PurPayments.PartyCode=ACMastDets.ACCode
                    and PurPayments.CoID='$CoID'
                    and PurPayments.WorkYear='$WorkYear'
                    and PurPayments.PvNumber='$id'
                ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function get_RTGS_BankDet($id)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
            select ACMastDets.ACTitle as PatyName,
                ACMastDets.ACCode as PatyCode,
                concat(ACMastDets.AddressI,'',
                        ACMastDets.AddressII,'',
                        ACMastDets.AddressIII,'',
                        ACMastDets.City) as Address,
                    ACMastDets.BankName,
                    ACMastDets.BankBranch,
                    ACMastDets.BankACNo,
                    PurPayments.ChequeNo,
                    PurPayments.TotalChequeAmt,
                    ACMastDets.BankRTGSCode,
                    ACMastDets.PanNo,
                    ACMastDets.CellPhone1
                from PurPayments,ACMastDets
                    where PurPayments.CoID = ACMastDets.CoID
                    and PurPayments.WorkYear=ACMastDets.WorkYear
                    and PurPayments.BankCode=ACMastDets.ACCode
                    and PurPayments.CoID='$CoID'
                    and PurPayments.WorkYear='$WorkYear'
                    and PurPayments.PvNumber='$id'
                ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }
  function get_RTGScompany()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
                    select Company.CoName,
                        concat(Company.Address1,' ',Company.Address2,' ',Company.Address3, ' ', CompData.FirmPinCode) as Address
                    from Company, CompData
                    WHERE Company.CoID = CompData.CoID
                    and CompData.WorkYear = '$WorkYear'
                    and Company.CoID= '$CoID'
                ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function GetRefIdData($Refid, $payDate)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
          SELECT 
            `RefIDNumber`, 
            TotalAmount,
            DATE_FORMAT(GoodsRcptDate,'%d-%m-%Y') AS GoodsRcptDate, 
            `PartyCode`, 
            PartyName,
            PurHeader.BrokerCode, 
            `InvoiceNo`, 
            DATE_FORMAT(InvoiceDate,'%d-%m-%Y') AS InvoiceDate,
            `NetPayable`,
            `TotalPaid`,
            DATEDIFF('$payDate',GoodsRcptDate) AS Days,
            `BalanceDue`,
            `IntRate`
        from PurHeader ,ACMaster
        where RefIDNumber = '$Refid'
        AND BalanceDue > 0
        AND PurHeader.CoID ='$CoID'
        AND PurHeader.WorkYear = '$WorkYear' 
        AND PurHeader.PartyCode = ACMaster.ACCode
        AND PurHeader.CoID = ACMaster.CoID
        AND PurHeader.WorkYear = ACMaster.WorkYear
      ";

    $query = $this->db->query($sql);
    $result = $query->result();

    return $result;
  }

  function GetId()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
      
              SELECT LastPaymentPVNumber
                from CompData 
                WHERE CoID = '$CoID'
                AND WorkYear = '$WorkYear'
      
      ";
    $query = $this->db->query($sql);
    $result = $query->result();

    $NewValue = IntVal($result[0]->LastPaymentPVNumber) + 1;

    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear);
    $data2 = array('LastPaymentPVNumber' => $NewValue);
    $this->db->where($multi_where);
    $this->db->update('CompData', $data2);

    return strval($NewValue);
  }


  function get_PaymentDatewise()
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
        select distinct 
              pp.IDNumber as 'IDN No',
              pp.RefIDNumber as 'Ref Idn',
              pp.BillNo,
              DATE_FORMAT(pp.PaymentDate,'%d-%m-%Y') as PaymentDate, 
              DATE_FORMAT(pp.BillDate,'%d-%m-%Y') as BillDate, 
              pp.PartyCode,
              ac.ACTitle as PartyName,
              ac1.ACCode as BrokerCode,
              ac1.ACTitle as BrokerName, 
              pp.TotalPay as 'Bill Amt',
              pp.ChequeAmt,
              pp.CashAmt,
              pp.VatavAmt,
              pp.BrokAmt,
              pp.IntAmt,
              pp.WgtShort,
              pp.QualityDiffAmt as QDiffAmt,
              pp.KasarAmt,
              pp.BankComm,
              pp.BankCode,
              pp.ChequeNo
        from PurPayments pp left join PurHeader ph
        on pp.CoID = ph.CoID 
        AND pp.WorkYear = ph.WorkYear 
        AND pp.BillNo=ph.InvoiceNo 
        AND pp.PartyCode=ph.PartyCode
        left join ACMaster ac
        on pp.PartyCode = ac.ACCode 
        AND pp.CoID = ac.CoID 
        AND pp.WorkYear = ac.WorkYear
        left join ACMaster ac1
        on ph.BrokerCode = ac1.ACCode
        where pp.PaymentDate BETWEEN '$f' AND '$t'
        and pp.WorkYear = '$WorkYear'
        and pp.CoId = '$CoID'
        order by pp.PaymentDate desc
      ";

    $query = $this->db->query($sql)->result_array();

    if (empty($query)) {
      $sql = "        
          select distinct 
                pp.IDNumber as 'IDN No',
                pp.RefIDNumber as 'Ref Idn',
                pp.BillNo,
                DATE_FORMAT(pp.PaymentDate,'%d-%m-%Y') as PaymentDate, 
                DATE_FORMAT(pp.BillDate,'%d-%m-%Y') as BillDate, 
                pp.PartyCode,
                ac.ACTitle as PartyName,
                ac1.ACCode as BrokerCode,
                ac1.ACTitle as BrokerName, 
                pp.TotalPay as 'Bill Amt',
                pp.ChequeAmt,
                pp.CashAmt,
                pp.VatavAmt,
                pp.BrokAmt,
                pp.IntAmt,
                pp.WgtShort,
                pp.QualityDiffAmt as QDiffAmt,
                pp.KasarAmt,
                pp.BankComm,
                pp.BankCode,
                pp.ChequeNo
          from PurPayments pp left join PurHeader ph
          on pp.CoID = ph.CoID 
          AND pp.WorkYear = ph.WorkYear 
          AND pp.BillNo=ph.InvoiceNo 
          AND pp.PartyCode=ph.PartyCode
          left join ACMaster ac
          on pp.PartyCode = ac.ACCode 
          AND pp.CoID = ac.CoID 
          AND pp.WorkYear = ac.WorkYear
          left join ACMaster ac1
          on ph.BrokerCode = ac1.ACCode limit 1

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

  function get_PaymentDatewiseFilter($fromYear, $toYear)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "        
        select distinct 
              pp.IDNumber as 'IDN No',
              pp.RefIDNumber as 'Ref Idn',
              pp.BillNo,
              DATE_FORMAT(pp.PaymentDate,'%d-%m-%Y') as PaymentDate, 
              DATE_FORMAT(pp.BillDate,'%d-%m-%Y') as BillDate, 
              pp.PartyCode,
              ac.ACTitle as PartyName,
              ac1.ACCode as BrokerCode,
              ac1.ACTitle as BrokerName, 
              pp.TotalPay as 'Bill Amt',
              pp.ChequeAmt,
              pp.CashAmt,
              pp.VatavAmt,
              pp.BrokAmt,
              pp.IntAmt,
              pp.WgtShort,
              pp.QualityDiffAmt as QDiffAmt,
              pp.KasarAmt,
              pp.BankComm,
              pp.BankCode,
              pp.ChequeNo
        from PurPayments pp left join PurHeader ph
        on pp.CoID = ph.CoID 
        AND pp.WorkYear = ph.WorkYear 
        AND pp.BillNo=ph.InvoiceNo 
        AND pp.PartyCode=ph.PartyCode
        left join ACMaster ac
        on pp.PartyCode = ac.ACCode 
        AND pp.CoID = ac.CoID 
        AND pp.WorkYear = ac.WorkYear
        left join ACMaster ac1
        on ph.BrokerCode = ac1.ACCode
        where pp.PaymentDate BETWEEN '$fromYear' AND '$toYear'
        and pp.WorkYear = '$WorkYear'
        and pp.CoId = '$CoID'
        order by pp.PaymentDate desc
                     
      ";

    $query = $this->db->query($sql)->result_array();

    if (empty($query)) {
      $sql = "        
          select distinct 
              pp.IDNumber as 'IDN No',
              pp.RefIDNumber as 'Ref Idn',
              pp.BillNo,
              DATE_FORMAT(pp.PaymentDate,'%d-%m-%Y') as PaymentDate, 
              DATE_FORMAT(pp.BillDate,'%d-%m-%Y') as BillDate, 
              pp.PartyCode,

              ac.ACTitle as PartyName,
              ac1.ACCode as BrokerCode,
              ac1.ACTitle as BrokerName,
               
              pp.TotalPay as 'Bill Amt',
              pp.ChequeAmt,
              pp.CashAmt,
              pp.VatavAmt,
              pp.BrokAmt,
              pp.IntAmt,
              pp.WgtShort,
              pp.QualityDiffAmt as QDiffAmt,
              pp.KasarAmt,
              pp.BankComm,
              pp.BankCode,
              pp.ChequeNo
          from PurPayments pp left join PurHeader ph
          on pp.CoID = ph.CoID 
          AND pp.WorkYear = ph.WorkYear 
          AND pp.BillNo=ph.InvoiceNo 
          AND pp.PartyCode=ph.PartyCode
          left join ACMaster ac
          on pp.PartyCode = ac.ACCode 
          AND pp.CoID = ac.CoID 
          AND pp.WorkYear = ac.WorkYear
          left join ACMaster ac1
          on ph.BrokerCode = ac1.ACCode limit 1
          
        ";

      $query = $this->db->query($sql);
      $ea = array("empty");

      foreach ($query->list_fields() as $field) {
        array_push($ea, $field);
      }

      return array($ea, $fromYear, $toYear);
    }
    return  array($query, $fromYear, $toYear);
  }

  function x_get_PaymentDatewise()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
        select distinct 
            pp.*,
            ac.ACTitle as PartyName, 
            ac1.ACTitle as BrokerName, 
            ac1.ACCode as BrokerCode
        from PurPayments pp left join PurHeader ph
        on pp.CoID = ph.CoID 
        AND pp.WorkYear = ph.WorkYear 
        AND pp.BillNo=ph.InvoiceNo 
        AND pp.PartyCode=ph.PartyCode
        left join ACMaster ac 
          on pp.PartyCode = ac.ACCode 
          AND pp.CoID = ac.CoID 
          AND pp.WorkYear = ac.WorkYear
        left join ACMaster ac1
          on ph.BrokerCode = ac1.ACCode
        where pp.WorkYear='$WorkYear'
        order by pp.PaymentDate desc;         
      ";

    $query = $this->db->query($sql)->result_array();
    return $query;
  }

  function x_get_PaymentDatewiseFilter($fromYear, $toYear)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "        
        select distinct 
            pp.*,
            ac.ACTitle as PartyName, 
            ac1.ACTitle as BrokerName, 
            ac1.ACCode as BrokerCode
        from PurPayments pp left join PurHeader ph
        on pp.CoID = ph.CoID 
        AND pp.WorkYear = ph.WorkYear 
        AND pp.BillNo=ph.InvoiceNo 
        AND pp.PartyCode=ph.PartyCode
        left join ACMaster ac 
        on pp.PartyCode = ac.ACCode 
        AND pp.CoID = ac.CoID 
        AND pp.WorkYear = ac.WorkYear
        left join ACMaster ac1
        on ph.BrokerCode = ac1.ACCode
        where pp.WorkYear='$WorkYear'
        and pp.PaymentDate BETWEEN '$fromYear' AND '$toYear'
        order by pp.PaymentDate desc                     
      ";

    $query = $this->db->query($sql)->result_array();
    return $query;
  }

  // Get Payment Details fro GaruPaymentGrid_view
  function GetGridData()
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
            p1.IDNumber as IDNumber, 
            p1.RefIDNumber, 
            p1.PvNumber, 
            DATE_FORMAT(p1.PaymentDate,'%d-%m-%Y') AS PaymentDate, 
            p1.PartyCode, 
            ACMaster.ACTitle as PartyName, 
            (SELECT SUM(TotalChequeAmt) AS tcamt FROM PurPayments pa where pa.PvNumber =  p1.PvNumber ) AS TotalChequeAmt, 
            (SELECT SUM(TotalCashAmt) AS tcamt FROM PurPayments pb where pb.PvNumber =  p1.PvNumber ) AS TotalCashAmt, 
            (SELECT SUM(KasarAmt) AS tkamt FROM PurPayments pb where pb.PvNumber =  p1.PvNumber ) AS TotalKasarAmt,            
            (SELECT (SUM(TotalChequeAmt)+SUM(TotalCashAmt)+SUM(KasarAmt)) AS tcq FROM PurPayments pp where pp.PvNumber =  p1.PvNumber) AS TCQ
            
        FROM PurPayments p1 , ACMaster 
        where p1.PartyCode = ACMaster.ACCode
        AND p1.WorkYear = ACMaster.WorkYear 
        AND p1.CoID = ACMaster.CoID 
        AND p1.CoID ='$CoID'
        AND p1.WorkYear = '$WorkYear'
        AND  p1.PaymentDate BETWEEN '$fromYear' AND '$toYear'
        Group By PvNumber
        order by p1.PaymentDate DESC
      ";

    // $query = $this->db->query($sql);
    // $result = $query->result();
    // return $result;

    $result = $this->db->query($sql)->result_array();

    if (empty($result)) {
      $emptyArray = array("empty");
      return array($emptyArray, $fromYear, $toYear);
    }

    return array($result, $fromYear, $toYear);
  }

  // Get Payment Details Datewise for GaruPaymentGrid_view
  function GetGridDataFilter($fromYear, $toYear)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "        
            SELECT  
                p1.IDNumber as IDNumber, 
                p1.RefIDNumber, 
                p1.PvNumber, 
                DATE_FORMAT(p1.PaymentDate,'%d-%m-%Y') AS PaymentDate, 
                p1.PartyCode, 
                ACMaster.ACTitle as PartyName, 
                (SELECT SUM(TotalChequeAmt) AS tcamt FROM PurPayments pa where pa.PvNumber =  p1.PvNumber ) AS TotalChequeAmt, 
                (SELECT SUM(TotalCashAmt) AS tcamt FROM PurPayments pb where pb.PvNumber =  p1.PvNumber ) AS TotalCashAmt, 
                (SELECT SUM(KasarAmt) AS tkamt FROM PurPayments pb where pb.PvNumber =  p1.PvNumber ) AS TotalKasarAmt,            
                (SELECT (SUM(TotalChequeAmt)+SUM(TotalCashAmt)+SUM(KasarAmt)) AS tcq FROM PurPayments pp where pp.PvNumber =  p1.PvNumber) AS TCQ
            
            FROM PurPayments p1 , ACMaster 
            where p1.PartyCode = ACMaster.ACCode
              AND p1.WorkYear = ACMaster.WorkYear 
              AND p1.CoID = ACMaster.CoID 
              AND p1.CoID ='$CoID'
              AND p1.WorkYear = '$WorkYear'
              AND  p1.PaymentDate BETWEEN '$fromYear' AND '$toYear'
            Group By PvNumber
            order by p1.PaymentDate DESC
      ";
    $result = $this->db->query($sql)->result_array();

    if (empty($result)) {
      $emptyArray = array("empty");
      return array($emptyArray, $fromYear, $toYear);
    }

    return  array($result, $fromYear, $toYear);
  }

  //new updated 23/01/2021
  function GetRefHeader($id)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "SELECT NetPayable,TotalPaid,BalanceDue  from PurHeader 
            where RefIDNumber = '$id'
            AND CoID ='$CoID'
            AND WorkYear = '$WorkYear'
      ";
    $query = $this->db->query($sql);
    $result = $query->result();
    print_r($result);
    return $result;
  }

  //30jan
  function getRefLoop($pno)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = " SELECT RefIDNumber
              from PurPayments
              where PvNumber='$pno'
      ";
    $query = $this->db->query($sql);

    $result = $query->result();

    return $result;
  }

  //29jan
  function checkref($PartyCode, $BrokerCode, $ref, $no)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = " SELECT DISTINCT  
                PurHeader.RefIDNumber, 
                TotalAmount,
                DATE_FORMAT(PurHeader.GoodsRcptDate,'%d-%m-%Y') AS GoodsRcptDate, 
                PurHeader.PartyCode, 
                PurHeader.PartyName,
                PurHeader.BrokerCode, 
                PurHeader.InvoiceNo, 
                DATE_FORMAT(PurHeader.InvoiceDate,'%d-%m-%Y') AS InvoiceDate,
                PurHeader.NetPayable,
                PurHeader.TotalPaid,
                DATEDIFF(CURDATE(),PurHeader.GoodsRcptDate) AS Days,
                PurHeader.BalanceDue
      
              from PurHeader, PurPayments 
              where (PurHeader.PartyCode = '$PartyCode' )
              AND PurHeader.RefIDNumber NOT IN (select RefIDNumber from PurPayments where PvNumber='$no')
              AND PurHeader.BalanceDue > 0
              AND PurHeader.CoID ='$CoID'
              AND PurHeader.WorkYear = '$WorkYear' 
      ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function totalAmt($PVref)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = " SELECT 
          sum(ChequeAmt) AS chq,
          sum(CashAmt) AS csh
          from PurPayments
          where 
          PvNumber ='$PVref'

          AND PurHeader.CoID ='$CoID'
          AND PurHeader.WorkYear = '$WorkYear'
    ";

    $query = $this->db->query($sql);

    $result = $query->result();

    return $result;
  }
  // Updated on 8/10/21
  function GetModaldataParty($PartyCode, $payDate)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "SELECT 
          `RefIDNumber`, 
          TotalAmount,
          DATE_FORMAT(GoodsRcptDate,'%d-%m-%Y') AS GoodsRcptDate, 
          `PartyCode`, 
          PartyName,
          PurHeader.BrokerCode, 
          `InvoiceNo`, 
          DATE_FORMAT(InvoiceDate,'%d-%m-%Y') AS InvoiceDate,
          `NetPayable`,
       	  (
                  ifnull(
              (SELECT sum(ACCAmount)
                  from ACCDetails
                  where ACCDetails.CoID=PurHeader.CoID
                  and ACCDetails.WorkYear=PurHeader.WorkYear
                  and ACCDetails.RefIDNo=PurHeader.RefIDNumber
              ),
            0)
                +
                ifnull(( SELECT sum(TotalPay)
            FROM PurPayments
            where PurPayments.CoID = PurHeader.CoID
                    and PurPayments.WorkYear = PurHeader.WorkYear
            and PurPayments.PartyCode = PurHeader.PartyCode 
            and PurPayments.RefIDNumber = PurHeader.RefIDNumber ),0) 
                )TotalPaid,    
          DATEDIFF($payDate,GoodsRcptDate) AS Days,
               (`BalanceDue`
          -
          ifnull(
					(SELECT sum(ACCAmount)
							from ACCDetails
							where ACCDetails.CoID=PurHeader.CoID
							and ACCDetails.WorkYear=PurHeader.WorkYear
							and ACCDetails.RefIDNo=PurHeader.RefIDNumber
					),
				0) 
                ) BalanceDue,
          `IntRate`
      from PurHeader ,ACMaster
      where (PartyCode = '$PartyCode')
      AND BalanceDue > 0
      AND PurHeader.CoID ='$CoID'
      AND PurHeader.WorkYear = '$WorkYear' 
      AND PurHeader.PartyCode = ACMaster.ACCode
      AND PurHeader.CoID = ACMaster.CoID
      AND PurHeader.WorkYear = ACMaster.WorkYear
    ";

    $query = $this->db->query($sql);
    $result = $query->result();

    return $result;
  }

  function GetModaldataBroker($BrokerCode, $payDate)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "SELECT 
        `RefIDNumber`, 
        TotalAmount,
        DATE_FORMAT(GoodsRcptDate,'%d-%m-%Y') AS GoodsRcptDate, 
        `PartyCode`, 
        PartyName,
        PurHeader.BrokerCode, 
        `InvoiceNo`, 
        DATE_FORMAT(InvoiceDate,'%d-%m-%Y') AS InvoiceDate,
        `NetPayable`,
       	  (
                  ifnull(
              (SELECT sum(ACCAmount)
                  from ACCDetails
                  where ACCDetails.CoID=PurHeader.CoID
                  and ACCDetails.WorkYear=PurHeader.WorkYear
                  and ACCDetails.RefIDNo=PurHeader.RefIDNumber
              ),
            0)
                +
                ifnull(( SELECT sum(TotalPay)
            FROM PurPayments
            where PurPayments.CoID = PurHeader.CoID
            and PurPayments.WorkYear = PurHeader.WorkYear
            and PurPayments.PartyCode = PurHeader.PartyCode 
            and PurPayments.RefIDNumber = PurHeader.RefIDNumber ),0) 
                )TotalPaid,    
          DATEDIFF($payDate,GoodsRcptDate) AS Days,
               (`BalanceDue`
          -
          ifnull(
					(SELECT sum(ACCAmount)
							from ACCDetails
							where ACCDetails.CoID=PurHeader.CoID
							and ACCDetails.WorkYear=PurHeader.WorkYear
							and ACCDetails.RefIDNo=PurHeader.RefIDNumber
					),
				0) 
                ) BalanceDue,
        `IntRate`
        from PurHeader ,ACMaster
        where (PurHeader.BrokerCode = '$BrokerCode')
        AND BalanceDue > 0
        AND PurHeader.CoID ='$CoID'
        AND PurHeader.WorkYear = '$WorkYear' 
        AND PurHeader.PartyCode = ACMaster.ACCode
        AND PurHeader.CoID = ACMaster.CoID
        AND PurHeader.WorkYear = ACMaster.WorkYear
    ";

    $query = $this->db->query($sql);
    $result = $query->result();

    return $result;
  }

  function GetModaldata($PartyCode, $BrokerCode, $payDate)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = " SELECT 
            `RefIDNumber`, 
            TotalAmount,
            DATE_FORMAT(GoodsRcptDate,'%d-%m-%Y') AS GoodsRcptDate, 
            `PartyCode`, 
            PartyName,
            PurHeader.BrokerCode, 
            `InvoiceNo`, 
            DATE_FORMAT(InvoiceDate,'%d-%m-%Y') AS InvoiceDate,
            `NetPayable`,
                 (
                      ifnull(
                  (SELECT sum(ACCAmount)
                      from ACCDetails
                      where ACCDetails.CoID=PurHeader.CoID
                      and ACCDetails.WorkYear=PurHeader.WorkYear
                      and ACCDetails.RefIDNo=PurHeader.RefIDNumber
                  ),
                0)
                    +
                    ifnull(( SELECT sum(TotalPay)
                FROM PurPayments
                where PurPayments.CoID = PurHeader.CoID
                and PurPayments.WorkYear = PurHeader.WorkYear
                and PurPayments.PartyCode = PurHeader.PartyCode 
                and PurPayments.RefIDNumber = PurHeader.RefIDNumber ),0) 
                    )TotalPaid,    
              DATEDIFF($payDate,GoodsRcptDate) AS Days,
                  (`BalanceDue`
              -
              ifnull(
              (SELECT sum(ACCAmount)
                  from ACCDetails
                  where ACCDetails.CoID=PurHeader.CoID
                  and ACCDetails.WorkYear=PurHeader.WorkYear
                  and ACCDetails.RefIDNo=PurHeader.RefIDNumber
              ),
            0) 
                    ) BalanceDue,
            `IntRate`
        from PurHeader ,ACMaster
        where (PartyCode = '$PartyCode' and PurHeader.BrokerCode = '$BrokerCode')
        AND BalanceDue > 0
        AND PurHeader.CoID ='$CoID'
        AND PurHeader.WorkYear = '$WorkYear' 
        AND PurHeader.PartyCode = ACMaster.ACCode
        AND PurHeader.CoID = ACMaster.CoID
        AND PurHeader.WorkYear = ACMaster.WorkYear
      ";

    $query = $this->db->query($sql);
    $result = $query->result();

    return $result;
  }
  // Updated on 8/10/21 ends

  //new updated 23/01/2021
  function GetHeaderGriddata($Refid)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "SELECT 
              `RefIDNumber`, 
              TotalAmount,
              DATE_FORMAT(GoodsRcptDate,'%d-%m-%Y') AS GoodsRcptDate, 
              `PartyCode`, 
              PartyName,
              `BrokerCode`, 
              `InvoiceNo`, 
              DATE_FORMAT(InvoiceDate,'%d-%m-%Y') AS InvoiceDate,
              `NetPayable`,
              `TotalPaid`,
              DATEDIFF(CURDATE(),GoodsRcptDate) AS Days,
              `BalanceDue`
          from PurHeader 
          where RefIDNumber = '$Refid'
          AND CoID ='$CoID'
          AND WorkYear = '$WorkYear'
    ";

    $query = $this->db->query($sql);
    $result = $query->result();

    return $result;
  }

  // Get Data based on PvNumber from Garu Payment
  function GetTabledata($PvNumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "SELECT 
                IDNumber,
                PvNumber,
                DATE_FORMAT(PaymentDate,'%d-%m-%Y') AS PaymentDate,
                RefIDNumber,
                PartyCode,
                Days,
                DiscPerc AS Vatav,
                VatavAmt,
                BrokRate,
                BrokAmt,
                IntRate,
                IntAmt,
                WgtShort,
                QualityDiffRate,
                QualityDiffAmt,
                ChequeAmt,
                CashAmt,
                KasarAmt,
                TotalChequeAmt,
                BankCode,
                BankComm,
                ChequeNo,
                RTGS,
                TotalCashAmt,
                CashCode
            FROM PurPayments
            WHERE PvNumber = '$PvNumber'
            AND CoID ='$CoID'
            AND WorkYear = '$WorkYear'
    ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  // Get Data based on IDNumber from Garu Payment
  function GetTabledata1($Idnumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "SELECT 
                IDNumber,
                PvNumber,
                DATE_FORMAT(PaymentDate,'%d-%m-%Y') AS PaymentDate,
                RefIDNumber,
                PartyCode,
                Days,
                DiscPerc AS Vatav,
                VatavAmt,
                BrokRate,
                BrokAmt,
                IntRate,
                IntAmt,
                WgtShort,
                QualityDiffRate,
                QualityDiffAmt,
                ChequeAmt,
                CashAmt,
                KasarAmt,
                TotalChequeAmt,
                TotalPay,
                BankCode,
                    (SELECT
                      ACTitle
                    FROM  ACMaster
                    WHERE ACCode = BankCode
                    AND GroupCode='BB'
                    AND CoID ='$CoID'
                    AND WorkYear = '$WorkYear') AS BankName,
                BankComm,
                ChequeNo,
                RTGS,
                TotalCashAmt,
                CashCode,
                    (SELECT
                        ACTitle
                      FROM  ACMaster
                      WHERE ACCode = CashCode
                      AND GroupCode='BZ'
                      AND CoID ='$CoID'
                      AND WorkYear = '$WorkYear') AS CashName
              FROM PurPayments
              WHERE IDNumber = '$Idnumber'
              AND CoID ='$CoID'
              AND WorkYear = '$WorkYear'
      ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }


  // Get Sum of TotalPay from Garu Payment Table
  function GetTotalPaySum($PvNumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "SELECT 	
                PurHeader.RefIDNumber,
                PurHeader.NetPayable,
                PurHeader.TotalPaid,
                PurHeader.BalanceDue,
                sum(TotalPay) TotalPay,
                PurHeader.TotalPaid - sum(TotalPay) Total,
                PurHeader.NetPayable - (PurHeader.TotalPaid - sum(TotalPay)) Bal
            FROM PurHeader 
              join PurPayments 
                on PurHeader.RefIDNumber = PurPayments.RefIDNumber and PurHeader.CoID = PurPayments.CoID and PurHeader.WorkYear =PurPayments.WorkYear
                where PurPayments.PvNumber='$PvNumber'
            group by PurPayments.RefIDNumber,PurPayments.CoID,PurPayments.WorkYear
            having PurPayments.CoID= '$CoID' 
            and PurPayments.WorkYear = '$WorkYear';
    ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function GetNextPVId()
  {
    $sql = "SELECT max(PvNumber) as PVID FROM PurPayments";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function GetNextId()
  {
    $sql = "SELECT max(IDNumber) as Currentid FROM PurPayments";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function GetDataSingle($refid)
  {
    $sql = "SELECT
                  RefIDNumber, 
                  TotalAmount,
                  DATE_FORMAT(GoodsRcptDate,'%d-%m-%Y') AS GoodsRcptDate, 
                  PartyCode, 
                  PartyName,
                  BrokerCode, 
                  InvoiceNo, 
                  DATE_FORMAT(InvoiceDate,'%d-%m-%Y') AS InvoiceDate,
                  NetPayable,
                  TotalPaid,
                  BalanceDue
              FROM PurHeader
              WHERE RefIDNumber = '$refid'
      ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function GetDataSingle1($IDNumber)
  {
    $sql = "SELECT 
                  IDNumber,
                  PvNumber,
                  DATE_FORMAT(PaymentDate,'%d-%m-%Y') AS PaymentDate,
                  RefIDNumber,
                  PartyCode,
                  Days,
                  DiscPerc,
                  VatavAmt,
                  BrokRate,
                  BrokAmt,
                  IntRate,
                  IntAmt,
                  WgtShort,
                  QualityDiffRate,
                  QualityDiffAmt,
                  ChequeAmt,
                  CashAmt,
                  KasarAmt,
                  TotalChequeAmt,
                  BankCode,
                  BankComm,
                  ChequeNo,
                  RTGS,
                  TotalCashAmt,
                  CashCode
              FROM PurPayments
              WHERE IDNumber = '$IDNumber'
      ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }


  //new updated 23/01/2021
  function GetIdData1($PVIdnumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "SELECT 
                IDNumber,
                PvNumber,
                DATE_FORMAT(PaymentDate,'%d-%m-%Y') AS PaymentDate,
                RefIDNumber,
                PartyCode,
                Days,
                DiscPerc,
                VatavAmt,
                BrokRate,
                BrokAmt,
                IntRate,
                IntAmt,
                WgtShort,
                QualityDiffRate,
                QualityDiffAmt,
                ChequeAmt,
                CashAmt,
                KasarAmt
              FROM PurPayments
              WHERE PvNumber = '$PVIdnumber'
              AND CoID ='$CoID'
              AND WorkYear = '$WorkYear'
      ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function GetTotalSingle($Id)
  {
    $sql = "SELECT 
                  COUNT(RefIDNumber) as TotalRecord,
                  SUM(VatavAmt) AS VatavAmt,
                  SUM(BrokAmt) AS BrokAmt,
                  SUM(IntAmt) as IntAmt,
                  SUM(WgtShort) as WgtShort ,
                  SUM(QualityDiffAmt) as QualityDiffAmt ,
                  SUM(ChequeAmt) AS ChequeAmt,
                  SUM(CashAmt) AS CashAmt  ,
                  SUM(KasarAmt) AS KasarAmt
              FROM PurPayments
              WHERE IDNumber  = '$Id'
      ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  //new updated 23/01/2021
  function Totals($PVIdnumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "SELECT    
                COUNT(RefIDNumber) as TotalRecord,
                SUM(VatavAmt) AS VatavAmt,
                SUM(BrokAmt) AS BrokAmt,
                SUM(IntAmt) as IntAmt,
                SUM(WgtShort) as WgtShort ,
                SUM(QualityDiffAmt) as QualityDiffAmt ,
                SUM(ChequeAmt) AS ChequeAmt,
                SUM(CashAmt) AS CashAmt  ,
                SUM(KasarAmt) AS KasarAmt,
                BankCode,
                BankComm,
                ChequeNo,
                RTGS,
                CashCode
            FROM PurPayments
            WHERE PvNumber  = '$PVIdnumber'
            AND CoID ='$CoID'
            AND WorkYear = '$WorkYear'
    ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  //new updated 23/01/2021
  function GetReferenceId($IDNumber)
  {
    $sql = "SELECT RefIDNumber from PurPayments WHERE IDNumber='$IDNumber'";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function Get_Broker_List()
  {
    $sql = "
              SELECT
                ACCode,
                ACTitle,
                GroupCode,
                BrokerCode
              FROM  ACMaster
        ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  //new updated 23/01/2021
  function Get_CashCode_List()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
        SELECT
            ACCode,
            ACTitle,
            GroupCode,
            BrokerCode
        FROM  ACMaster
        WHERE GroupCode='BZ'
        AND CoID ='$CoID'
        AND WorkYear = '$WorkYear'
    ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  //new updated 23/01/2021
  function Get_BankCode_List()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
        SELECT
          ACCode,
          ACTitle,
          GroupCode,
          BrokerCode
        FROM  ACMaster
        WHERE GroupCode='BB'
        AND CoID ='$CoID'
        AND WorkYear = '$WorkYear'
    ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function getSuppliers($ACCode)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
          SELECT ACCode, ACTitle
          FROM  ACMaster
          WHERE CoID = '$CoID'
            AND WorkYear = '$WorkYear'
            AND ACCode like '$ACCode%'
            AND GroupCode = 'BC'
          ";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  function getBrokers($ACCode)
  {

    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');


    $sql = "
              SELECT ACCode, ACTitle
              FROM  ACMaster
              WHERE CoID = '$CoID'
                AND WorkYear = '$WorkYear'
                AND ACCode like '$ACCode%'
                AND GroupCode = 'B1'
            ";
    $query = $this->db->query($sql);
    return $query->result_array();
  }
}
