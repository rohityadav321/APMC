<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//? Created on 23-6-21 -Pranav
class OrderEntryModel extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  //* Get Order Details Datewise for OrderEntryGrid -Pranav 23-6-21
  function get_detailsFilter($fromYear, $toYear)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "        
              select ORDDAT.OrderNo,
                     ORDDAT.OrderDate,
                     ORDDAT.PartyID,
                     ORDDAT.OrderAmt
              from ORDDAT
              where ORDDAT.CoID='$CoID'
              and ORDDAT.WorkYear='$WorkYear'

              ";
    $result = $this->db->query($sql)->result_array();

    if (empty($result)) {
      $emptyArray = array("empty");
      return array($emptyArray, $fromYear, $toYear);
    }

    return  array($result, $fromYear, $toYear);
  }

  //* Get Order Details for OrderEntryGrid -Pranav 23-6-21
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
    //   $fromYear = date("$current_year-$current_month-01");
    //   $toYear = date("$current_year-$current_month-t");
    // } else {
    //   $fromYear = date("$WY-03-01");
    //   $toYear = date("$WY-03-t");
    // }

    $sql = "
              select ORDDAT.OrderNo,
                     ORDDAT.OrderDate,
                     ORDDAT.PartyCode,
                     ORDDAT.OrderAmt
              from ORDDAT
              where ORDDAT.CoID='$CoID'
              and ORDDAT.WorkYear='$WorkYear'
        ";
    // $query = $this->db->query($sql);
    // $result = $query->result();
    // return $result;
    $result = $this->db->query($sql)->result();

    // if (empty($result)) {
    //   $emptyArray = array("empty");
    //   // return array($emptyArray, $fromYear, $toYear);
    // }

    return $result;
    // , $fromYear, $toYear);
  }

  //? All the Modal data functions with its queries -Pranav 23-6-21
  //? Godown modal data
  function Get_Godown_List()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
                  SELECT
                    GodownID,
                    GodownDesc
                  FROM Godown
                  WHERE CoID = '$CoID'
                  AND WorkYear = '$WorkYear'
              ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function getOrder()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
          Select
            LastSalesOrder
          from CompData
          where CoID='$CoID'
          and WorkYear='$WorkYear'
      ";
    $query = $this->db->query($sql);
    $result = $query->result();

    $NewValue = IntVal($result[0]->LastSalesOrder) + 1;

    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear);
    $data2 = array('LastSalesOrder' => $NewValue);
    $this->db->where($multi_where);
    $this->db->update('CompData', $data2);
    return strval($NewValue);
  }

  //? Debtor modal data -Pranav 23-6-21
  function Get_Debtor_List()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
                    SELECT ACCode, ACTitle, GroupCode
                      FROM ACMaster
                    WHERE GroupCode = 'BD'
                      and CoID = '$CoID'
                      and WorkYear = '$WorkYear'
          ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  //? Broker modal data -Pranav 23-6-21
  function Get_Broker_List()
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
          WHERE GroupCode = 'B1' 
          AND CoID = '$CoID'
        AND WorkYear = '$WorkYear'
        ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  //? Customer modal data 23-6-21 
  function Get_Customer_List()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
                        SELECT 
                                PartyMaster.PartyCode,
                                PartyMaster.PartyName,
                                PartyMaster.PartyArea,
                                PartyMaster.BrokerCode,
                                ACMaster.ACTitle as 'BrokerTitle',
                                PartyMaster.PartyType 
                        From PartyMaster, ACMaster
                        Where PartyMaster.BrokerCode = ACMaster.ACCode
                        AND PartyMaster.CoID = ACMaster.CoID
                        AND PartyMaster.WorkYear = ACMaster.WorkYear
                        AND ACMaster.CoID = '$CoID'
                        AND ACMaster.WorkYear='$WorkYear'
                        ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }
  function itemwise($gid)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
                  SELECT *
                  from dbView_StockLedger
                  where dbView_StockLedger.CoID = '$CoID'
                    and dbView_StockLedger.WorkYear = '$WorkYear'
                    and dbView_StockLedger.GodownID like '$gid%'
                    and dbView_StockLedger.BalQty > 0 
                    order by Cast(LotNo as Integer)                
             ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }
}
