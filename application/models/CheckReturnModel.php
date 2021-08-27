<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class CheckReturnModel extends CI_Model
{
  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  public function getDetails($refers_id, $years)
  {

    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "

              SELECT 
                  ACMaster.ACTitle DebtorName,
                  broker.ACTitle BrokerName,
                  PartyMaster.PartyName PartyName,
                  bank.ACTitle BankName,
                  Collection.*
              FROM
                  Collection,
                  ACMaster,
                  ACMaster broker,
                  ACMaster bank,
                  SaleMast,
                  PartyMaster
              WHERE
                      Collection.CoID = ACMaster.CoID
                      AND Collection.WorkYear = ACMaster.WorkYear
                  AND Collection.DebtorCode = ACMaster.ACCode
                      
                      AND Collection.CoID = broker.CoID
                      AND Collection.WorkYear = broker.WorkYear
                      AND Collection.BrokerCode = broker.ACCode
                      
                      AND Collection.CoID = bank.CoID
                      AND Collection.WorkYear = bank.WorkYear
                      AND Collection.DepBankCode = bank.ACCode
                      
                      AND Collection.CoID = SaleMast.CoID
                      AND Collection.WorkYear = SaleMast.WorkYear
                      AND Collection.BillNo = SaleMast.BillNo
                      
                      AND SaleMast.CoID = PartyMaster.CoID
                      AND SaleMast.WorkYear = PartyMaster.WorkYear
                      AND SaleMast.PartyCode = PartyMaster.PartyCode
                      
                      AND Collection.CoID = '$CoID'
                      AND Collection.WorkYear = '$WorkYear'
                      AND Collection.IDNumber = '$refers_id'

    ";

    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function getgrid($fyear, $tyear)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $Xsql = "
          Select 
              RefIDNumber, 
              ReturnDate,
              BankCode,
              ReturnAmt, 
              CheqNo
          From ChequeReturn
          Where ChequeReturn.CoID = '$CoID'
          AND ChequeReturn.WorkYear = '$WorkYear'
          and ReturnDate between '$fyear' and '$tyear'
            ";
    $sql = "
              Select 
                  RefIDNumber, 
                  ReturnDate,
                  ChequeReturn.CheqNo,
                  ChequeReturn.BankCode,
                  Bank.ACTitle, 
                  ChequeReturn.ReturnAmt
              From ChequeReturn, ACMaster Bank
              Where ChequeReturn.CoID = '$CoID'
              AND ChequeReturn.WorkYear = '$WorkYear'
              AND ReturnDate between '$fyear' and '$tyear'

              AND ChequeReturn.BankCode = Bank.ACCode
              AND ChequeReturn.CoID = Bank.CoID
              AND ChequeReturn.WorkYear = Bank.WorkYear

              ORDER BY ReturnDate
    
    ";

    $query = $this->db->query($sql)->result_array();
    if (empty($query)) {
      $sql = "
          Select 
              RefIDNumber, 
              ReturnDate,
              BankCode,
              ReturnAmt, 
              CheqNo
          From ChequeReturn
            ";
      $query = $this->db->query($sql);
      $ea = array("empty");

      foreach ($query->list_fields() as $field) {
        array_push($ea, $field);
      }

      return array($ea, $fyear, $tyear);
    }
    return array($query, $fyear, $tyear);
  }
  public function getEditDetails($refers_id)
  {

    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "

              SELECT 
                  ACMaster.ACTitle DebtorName,
                  broker.ACTitle BrokerName,
                  PartyMaster.PartyName PartyName,
                  bank.ACTitle BankName,
                  Collection.*,
                  ChequeReturn.IDNumber,
                  ChequeReturn.ReturnDate,
                  ChequeReturn.CRChrg,
                  ChequeReturn.RefIDNumber

              FROM
                  Collection,
                  ACMaster,
                  ACMaster broker,
                  ACMaster bank,
                  SaleMast,
                  PartyMaster,
                  ChequeReturn
              WHERE
                      Collection.CoID = ACMaster.CoID
                      AND Collection.WorkYear = ACMaster.WorkYear
                  AND Collection.DebtorCode = ACMaster.ACCode
                      
                      AND Collection.CoID = broker.CoID
                      AND Collection.WorkYear = broker.WorkYear
                      AND Collection.BrokerCode = broker.ACCode
                      
                      AND Collection.CoID = bank.CoID
                      AND Collection.WorkYear = bank.WorkYear
                      AND Collection.DepBankCode = bank.ACCode
                      
                      AND Collection.CoID = SaleMast.CoID
                      AND Collection.WorkYear = SaleMast.WorkYear
                      AND Collection.BillNo = SaleMast.BillNo
                      
                      AND SaleMast.CoID = PartyMaster.CoID
                      AND SaleMast.WorkYear = PartyMaster.WorkYear
                      AND SaleMast.PartyCode = PartyMaster.PartyCode

                      AND Collection.CoID = ChequeReturn.CoID
                      AND Collection.WorkYear = ChequeReturn.WorkYear
                      AND Collection.IDNumber = ChequeReturn.RefIDNumber
                      
                      AND ChequeReturn.CoID = '$CoID'
                      AND ChequeReturn.WorkYear = '$WorkYear'
                      AND ChequeReturn.RefIDNumber = '$refers_id'

    ";

    $query = $this->db->query($sql);
    return $query->result_array();
  }
  public function CountCheque($refers_id)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
    Select count(RefIDNumber) as Number
    from ChequeReturn
    where CoID='$CoID' 
    and WorkYear='$WorkYear'
    and RefIDNumber='$refers_id'";
    $query = $this->db->query($sql);
    return $query->result();
  }
  // 25-08-21
  public function GetRef($IDNumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
    Select
      RefIDNumber
    from ChequeReturn
      where CoID='$CoID' 
      and WorkYear='$WorkYear'
      and IDNumber=$IDNumber";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }
}
