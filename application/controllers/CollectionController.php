<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CollectionController extends CI_Controller
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

  //  public function PrintFromGrid($IDNumber)
  public function PrintFromGrid($CollectDate)
  {
    $this->load->model('CollectionModel');
    //  $data["SlipHead"] = $this->CollectionModel->Get_Slip_Header($IDNumber);
    //  $data["Slip"] = $this->CollectionModel->Get_Slip_Data($IDNumber);

    $data["SlipHead"] = $this->CollectionModel->Get_Slip_Header($CollectDate);
    $data["Slip"] = $this->CollectionModel->Get_Slip_Data($CollectDate);
    $data["Company"] = $this->CollectionModel->companyDetails();

    // $AmtRef = $data["Slip"];
    $TotalAmount = 0;
    foreach ($data["Slip"]  as $res) {
      $TotalAmount += $res['ChequeAmt'];
    }    //  $Total_Cheque_Amt = $AmtRef[0]->ChqAmt;   
    $rwords =  $this->convert_number($TotalAmount);

    $data["rwords"] = $rwords;

    //  print_r( $data['Slip']); die; 
    //  print_r($data); die ; 
    $this->load->view('PaymentSlipPrintView', $data);
  }

  public function PrintReceipt($IDNumber)
  {
    $this->load->model('CollectionModel');

    $data["Company"] = $this->CollectionModel->companyDetails();
    $data["Receipt"] = $this->CollectionModel->Get_Receipt_Detail($IDNumber);
    // print_r($data["Receipt"]);
    // die;
    $this->load->view('reciept_view', $data);
  }

  public function convert_number($number)
  {
    //        $number=226545129.11;
    $no = intval($number);
    $point = round($number - $no, 2) * 100;
    // echo $no, " - ", $point ;
    // exit;
    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
      '0' => '', '1' => 'One', '2' => 'Two',
      '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
      '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
      '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
      '13' => 'Thirteen', '14' => 'Fourteen',
      '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
      '18' => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty',
      '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
      '60' => 'Sixty', '70' => 'Seventy',
      '80' => 'Eighty', '90' => 'Ninety'
    );
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');

    while ($i < $digits_1) {
      $divider = ($i == 2) ? 10 : 100;
      $number = floor($no % $divider);
      $no = floor($no / $divider);
      $i += ($divider == 10) ? 1 : 2;
      if ($number) {
        //                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $plural = (($counter = count($str)) && $number > 9) ? ' ' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str[] = ($number < 21) ? $words[$number] .
          " " . $digits[$counter] . $plural . " " . $hundred
          :
          $words[floor($number / 10) * 10]
          . " " . $words[$number % 10] . " "
          . $digits[$counter] . $plural . " " . $hundred;
      } else
        $str[] = null;
    }
    $str = array_reverse($str);
    $result = implode('', $str);

    if ($point > 0) {
      $points = ($point) ?
        " and " . $words[$point / 10] . " " .
        $words[$point = $point % 10] : '';
      $points = $points . " Paise ";
    } else
      $points = '';
    //         echo $result . $points . "Only  " ;
    return $result . $points . "Only  ";
  }

  function CollectionDatewise()
  {
    $this->load->model('CollectionModel');
    $data['result'] = $this->CollectionModel->get_CollectionDatewise();
    // print_r ($data);
    // die ; 
    $this->load->view('menu_1.php');
    $this->load->view('CollectionDatewise_View', $data);
  }

  function collectionDatewiseFilter()
  {
    if ($this->input->post('submit') != NULL) {
      $postData = $this->input->post();

      // Read POST data
      $fromYear = $postData['fromYear'];
      $toYear = $postData['toYear'];

      $this->load->model('CollectionModel');
      $data['result'] = $this->CollectionModel->get_CollectionDatewiseFilter($fromYear, $toYear);
      $this->load->view('menu_1.php');
      $this->load->view('CollectionDatewise_View', $data);
    }
  }



  public function show()
  {
    $this->load->model('CollectionModel');
    if ($this->input->post('submit') != NULL) {
      $postData = $this->input->post();

      // Read POST data
      $fromYear = $postData['fromYear'];
      $toYear = $postData['toYear'];

      $sessiondata['collectionfromyear'] = $fromYear;
      $sessiondata['collectiontoyear'] = $toYear;

      $this->session->set_userdata($sessiondata);

      $data['Item_List'] = $this->CollectionModel->get_detailsFilter($fromYear, $toYear);

      $this->load->view('menu_1');
      $this->load->view('CollectionGrid', $data);
    } else {
      if ($this->session->userdata('collectionfromyear') != '') {
        // echo "Session variables set salesfrom year and saleto year ";
        // echo $this->session->userdata('salesfromyear');
        // echo $this->session->userdata('salestoyear');
        $fromYear = $this->session->userdata('collectionfromyear');
        $toYear   = $this->session->userdata('collectiontoyear');
        $data['Item_List'] = $this->CollectionModel->get_detailsFilter($fromYear, $toYear);
      } else {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        // echo "Session variables not year set salesfrom year and saleto year ";
        $data['Item_List'] = $this->CollectionModel->get_details($CoID, $WorkYear);
      }
      $this->load->view('menu_1');
      $this->load->view('CollectionGrid', $data);
    }
  }

  public function x_show_180521()
  {
    $this->load->model('CollectionModel');
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $data['Item_List'] = $this->CollectionModel->get_details($CoID, $WorkYear);
    $this->load->view('menu_1');
    $this->load->view('CollectionGrid', $data);
  }


  public function showTry()
  {
    $this->load->model('CollectionModel');
    $this->form_validation->set_rules('IDNumber', 'IDNumber', 'trim');
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $data['PartyList'] = $this->CollectionModel->Get_Party_List();
    $data['CustomerList'] = $this->CollectionModel->Get_Customer_List();
    $data['ACMaster_List'] = $this->CollectionModel->Get_ACMaster_List($CoID, $WorkYear);
    $data['Bank_List'] = $this->CollectionModel->Get_ACMaster_List1($CoID, $WorkYear);
    $data['BankList'] = $this->CollectionModel->Get_Bank_List();
    $data['BrokerList'] = $this->CollectionModel->Get_Broker_List($CoID, $WorkYear);

    $this->load->view('CollectionTry', $data);
  }

  public function partycode($ACCode)
  {
    if (empty($ACCode)) {
      echo json_encode([]);
      exit;
    }

    $this->load->model('CollectionModel');
    $data = $this->CollectionModel->getPartyCode($ACCode);
    echo json_encode($data);
    exit;
  }

  public function partyname($ACTitle)
  {
    if (empty($ACTitle)) {
      echo json_encode([]);
      exit;
    }

    $this->load->model('CollectionModel');
    $data = $this->CollectionModel->getPartyName($ACTitle);
    echo json_encode($data);
    exit;
  }

  public function customer($PartyName)
  {
    if (empty($PartyName)) {
      echo json_encode([]);
      exit;
    }

    $this->load->model('CollectionModel');
    $data = $this->CollectionModel->getCustomer($PartyName);
    echo json_encode($data);
    exit;
  }

  public function brokercode($ACCode)
  {
    if (empty($ACCode)) {
      echo json_encode([]);
      exit;
    }

    $this->load->model('CollectionModel');
    $data = $this->CollectionModel->getBrokerCode($ACCode);
    echo json_encode($data);
    exit;
  }

  public function brokername($ACTitle)
  {
    if (empty($ACTitle)) {
      echo json_encode([]);
      exit;
    }

    $this->load->model('CollectionModel');
    $data = $this->CollectionModel->getBrokerName($ACTitle);
    echo json_encode($data);
    exit;
  }


  public function party_name_dropdown()
  {
    $this->load->model('CollectionModel');
    $value = $this->CollectionModel->party_name_ddmodel();
    echo json_encode($value);
  }

  public function customer_name_dropdown()
  {
    $this->load->model('CollectionModel');
    $value = $this->CollectionModel->customer_name_ddmodel();
    echo json_encode($value);
  }

  public function cashAccount($ACCode)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    if (empty($ACCode)) {
      echo json_encode([]);
      exit;
    }

    $this->load->model('CollectionModel');
    $data = $this->CollectionModel->GetCashAccount($CoID, $WorkYear, $ACCode);
    echo json_encode($data);
    exit;
  }

  public function depositBank($ACCode)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    if (empty($ACCode)) {
      echo json_encode([]);
      exit;
    }

    $this->load->model('CollectionModel');
    $data = $this->CollectionModel->GetDepositBank($CoID, $WorkYear, $ACCode);
    echo json_encode($data);
    exit;
  }

  public function chequeBank($BankCode)
  {
    if (empty($BankCode)) {
      echo json_encode([]);
      exit;
    }

    $this->load->model('CollectionModel');
    $data = $this->CollectionModel->GetChequeBank($BankCode);
    echo json_encode($data);
    exit;
  }

  public function show2($bill)
  {
    $this->load->model('CollectionModel');
    $data['TableData'] = $this->CollectionModel->getBillWiseData($bill);
    $data['Totals'] = $this->CollectionModel->getTotals($bill);
    $data['billno'] = $bill;

    $this->load->view('CollectionInsert1', $data);
  }

  //  Fetching Bill Data based on BillNo
  public function getBillData()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $BillNo = $this->input->post('BillNo');

    $this->load->model('CollectionModel');
    $result = $this->CollectionModel->getBillDetails($CoID, $WorkYear, $BillNo);

    if ($result == null) {
      echo json_encode('ERROR');
    } else {
      echo json_encode($result);
    }
  }
  // 16-09-21

  public function CheckCheqRet()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $BillNo = $this->input->post('BillNo');
    $this->load->model('CollectionModel');
    // $multiwhere = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'BillNo' => $BillNo);
    // $this->db->where($multiwhere);
    // $this->db->delete('Collection');
    $result = $this->CollectionModel->checkCheqReturn($BillNo);
    echo json_encode($result);
  }
  public function GetReturnData()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $BillNo = $this->input->post('BillNo');

    $this->load->model('CollectionModel');
    $result = $this->CollectionModel->GetReturnBillDetails($CoID, $WorkYear, $BillNo);

    if ($result == null) {
      echo json_encode('ERROR');
    } else {
      echo json_encode($result);
    }
  }

  // Generating SlipNo
  public function collectionSlipNo()
  {
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "select max(cast(SlipNo as unsigned) ) SlipNo
              from Collection
              where WorkYear = '$WorkYear'
              order by SlipNo desc";

    $query = $this->db->query($sql);
    $result = $query->result();

    echo json_encode($result);
  }

  public function CollectionInsertTry()
  {
    $this->load->model('CollectionModel');
    $this->form_validation->set_rules('IDNumber', 'IDNumber', 'trim');
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    if ($this->form_validation->run() == FALSE) {
      //fail validation 
      $data['PartyList'] = $this->CollectionModel->Get_Party_List();
      $data['CustomerList'] = $this->CollectionModel->Get_Customer_List($CoID, $WorkYear);
      $data['BrokerList'] = $this->CollectionModel->Get_Broker_List($CoID, $WorkYear);
      $data['ACMaster_List'] = $this->CollectionModel->Get_ACMaster_List($CoID, $WorkYear);
      $data['Bank_List'] = $this->CollectionModel->Get_ACMaster_List1($CoID, $WorkYear);
      $data['BankList'] = $this->CollectionModel->Get_Bank_List();
      //$data['BillList'] = $this->CollectionModel->Get_Bill_List($CoID,$WorkYear);
      $this->load->view('CollectionTry', $data);
    } else {
      $billno =  $this->input->post('BillNo');
      $Result = $this->CollectionModel->getBillAmt($billno);
      $billamt = $Result[0]->BillAmt;

      $rcptamt = $this->input->post('RcptAmt');
      $IDNumber = $this->input->post('IDNumber');

      // $balance = $billamt - $rcptamt;

      $data = array(
        'CoID' => $CoID,
        'WorkYear' => $WorkYear,
        'DebtorCode' => $this->input->post('DebtorCode'),
        'BrokerCode' => $this->input->post('BrokerCode'),
        'IDNumber' => $this->input->post('IDNumber'),
        'CollectDate' => $this->input->post('CollectDate'),
        'Mode' => $this->input->post('Mode'),
        'BillNo' => $billno,
        'LDays' => $this->input->post('LDays'),
        'VatavRate' => $this->input->post('VatavRate'),
        'VatavAmt' => $this->input->post('VatavAmt'),
        'BrokRate' => $this->input->post('BrokRate'),
        'BrokAmt' => $this->input->post('BrokAmt'),
        'IntRate' => $this->input->post('IntRate'),
        'IntAmt' => $this->input->post('IntAmt'),
        'LFeeRate' => $this->input->post('LFeeRate'),
        'LFeeAmt' => $this->input->post('LFeeAmt'),
        'Chithi' => $this->input->post('Chithi'),
        'ChequeAmt' => $this->input->post('ChequeAmt'),
        'CashAmt' => $this->input->post('CashAmt'),
        'KasarAmt' => $this->input->post('KasarAmt'),
      );

      $this->db->insert('Collection', $data);

      if ($IDNumber == 'New') {
        $this->load->model('CollectionModel');
        $result = $this->CollectionModel->getid($IDNumber);
        $IDNumber = $result;

        $data2 = array('IDNumber' => $IDNumber);
        $this->db->where('IDNumber', 'New');
        $this->db->update('Collection', $data2);
      }

      // Update Cash and Narration (Update total cash and total cheque)
      $sql = "SELECT min(ID) as ID
                    FROM Collection
                    where IDNumber  = '$IDNumber'
                    and WorkYear = '$WorkYear'
                    and CoID = '$CoID'
            ";
      $query = $this->db->query($sql);
      $result = $query->result();

      $minIdNumber = $result[0]->ID;

      $getCashBankTotal = "SELECT Sum(ChequeAmt) as TotalChqAmt,SUM(CashAmt) as TotalCashAmt
                                FROM Collection
                                where IDNumber  = '$IDNumber'
                                and WorkYear = '$WorkYear'
                                and CoID = '$CoID'
            ";
      $queryCashBankTotal = $this->db->query($getCashBankTotal);
      $cashBankTotal = $queryCashBankTotal->result();

      $TotalChequeAmt = $cashBankTotal[0]->TotalChqAmt;
      $TotalCashAmt = $cashBankTotal[0]->TotalCashAmt;

      $updatedBankDetails = array(
        'TotalChqAmt' => $TotalChequeAmt,
        'TotalCashAmt' => $TotalCashAmt
      );

      $arrayCollection = array('IDNumber' => $IDNumber, 'CoID' => $CoID, 'WorkYear' => $WorkYear, 'ID' => $minIdNumber);
      $this->db->where($arrayCollection);
      $this->db->update('Collection', $updatedBankDetails);

      $Amt = "
                                SELECT 
                                        Sum(
                                              VatavAmt+
                                              BrokAmt+
                                              (IntAmt+LFeeAmt+Chithi)+
                                              ChequeAmt+CashAmt+KasarAmt
                                            ) as RcptAmt
                                FROM Collection
                                where BillNo  = '$billno'
                                and WorkYear = '$WorkYear'
                                and CoID = '$CoID'
                              ";
      $query = $this->db->query($Amt);
      $result = $query->result();

      $RcptAmt = $result[0]->RcptAmt;

      $data1 = array(
        'RcptAmt' => $RcptAmt
      );

      // $data1 = array(
      //     'RcptAmt' => $this->input->post('RcptAmt')
      // );

      $this->db->where('BillNo', $billno);
      $this->db->update('SaleMast', $data1);

      echo "<script> ";
      echo "alert('New Collection Added !!');";
      echo "window.location.href = '" . base_url() . "index.php/CollectionController/InsertCollectionTry2/'+ $IDNumber;";
      echo "</script>";
    }
  }

  public function InsertCollectionTry2($IDNumber)
  {
    $this->load->model('CollectionModel');
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $this->form_validation->set_rules('IDNumber', 'IDNumber', 'trim');

    if ($this->form_validation->run() == FALSE) {
      //fail validation 

      $sql = "SELECT Mode
              FROM Collection
              where IDNumber  = '$IDNumber'
               and WorkYear = '$WorkYear'
               and CoID = '$CoID'
               and ID = (select max(ID) from Collection where IDNumber = '$IDNumber' and CoID ='$CoID' and WorkYear= '$WorkYear') 
           ";
      $query = $this->db->query($sql);
      $result = $query->result();

      $data['Mode'] = $result;

      $data['PartyList'] = $this->CollectionModel->Get_Party_List();
      $data['ItemList'] = $this->CollectionModel->getData($CoID, $WorkYear, $IDNumber);
      $data['CustomerList'] = $this->CollectionModel->Get_Customer_List($CoID, $WorkYear);
      $data['BrokerList'] = $this->CollectionModel->Get_Broker_List($CoID, $WorkYear);
      $data['ACMaster_List'] = $this->CollectionModel->Get_ACMaster_List($CoID, $WorkYear);
      $data['Bank_List'] = $this->CollectionModel->Get_ACMaster_List1($CoID, $WorkYear);
      $data['BankList'] = $this->CollectionModel->Get_Bank_List();
      //$data['BillList'] = $this->CollectionModel->Get_Bill_List();
      // $data['billno'] = $bill;
      $data['TableData'] = $this->CollectionModel->getBillWiseData($CoID, $WorkYear, $IDNumber);
      $data['Totals'] = $this->CollectionModel->getTotals($IDNumber);
      if ($data['ItemList'] == null) {
        $this->show();
      } else {
        $this->load->view('CollectionTry2', $data);
      }
    } else {
      $billno =  $this->input->post('BillNo');
      $IDNum = $this->input->post('IDNumber');

      $data = array(
        'CoID' => $CoID,
        'WorkYear' => $WorkYear,
        'DebtorCode' => $this->input->post('DebtorCode'),
        'BrokerCode' => $this->input->post('BrokerCode'),
        'IDNumber' => $this->input->post('IDNumber'),
        'CollectDate' => $this->input->post('CollectDate'),
        'Mode' => $this->input->post('Mode'),
        'BillNo' => $billno,
        'LDays' => $this->input->post('LDays'),
        'VatavRate' => $this->input->post('VatavRate'),
        'VatavAmt' => $this->input->post('VatavAmt'),
        'BrokRate' => $this->input->post('BrokRate'),
        'BrokAmt' => $this->input->post('BrokAmt'),
        'IntRate' => $this->input->post('IntRate'),
        'IntAmt' => $this->input->post('IntAmt'),
        'LFeeRate' => $this->input->post('LFeeRate'),
        'LFeeAmt' => $this->input->post('LFeeAmt'),
        'Chithi' => $this->input->post('Chithi'),
        'ChequeAmt' => $this->input->post('ChequeAmt'),
        'CashAmt' => $this->input->post('CashAmt'),
        'KasarAmt' => $this->input->post('KasarAmt'),
      );
      $this->db->insert('Collection', $data);

      // Update Cash and Narration (Update total cash and total cheque)
      $sql = "SELECT min(ID) as ID
                    FROM Collection
                    where IDNumber  = '$IDNum'
                    and WorkYear = '$WorkYear'
                    and CoID = '$CoID'
            ";
      $query = $this->db->query($sql);
      $result = $query->result();

      $minIdNumber = $result[0]->ID;

      $getCashBankTotal = "SELECT Sum(ChequeAmt) as TotalChqAmt,SUM(CashAmt) as TotalCashAmt
                                FROM Collection
                                where IDNumber  = '$IDNum'
                                and WorkYear = '$WorkYear'
                                and CoID = '$CoID'
            ";
      $queryCashBankTotal = $this->db->query($getCashBankTotal);
      $cashBankTotal = $queryCashBankTotal->result();

      $TotalChequeAmt = $cashBankTotal[0]->TotalChqAmt;
      $TotalCashAmt = $cashBankTotal[0]->TotalCashAmt;

      $updatedBankDetails = array(
        'TotalChqAmt' => $TotalChequeAmt,
        'TotalCashAmt' => $TotalCashAmt
      );

      $arrayCollection = array('IDNumber' => $IDNum, 'CoID' => $CoID, 'WorkYear' => $WorkYear, 'ID' => $minIdNumber);
      $this->db->where($arrayCollection);
      $this->db->update('Collection', $updatedBankDetails);
      $Amt = "
                                SELECT Sum(VatavAmt+BrokAmt+LFeeAmt+Chithi+ChequeAmt+CashAmt+KasarAmt - IntAmt) as RcptAmt
                                FROM Collection
                                where BillNo  = '$billno'
                                and WorkYear = '$WorkYear'
                                and CoID = '$CoID'
                              ";
      $query = $this->db->query($Amt);
      $result = $query->result();

      $RcptAmt = $result[0]->RcptAmt;

      $data1 = array(
        'RcptAmt' => $RcptAmt
      );


      // $data1 = array(
      //     'RcptAmt' =>$this->input->post('RcptAmt')
      // );
      $this->db->where('BillNo', $billno);
      $this->db->update('SaleMast', $data1);

      echo "<script> ";
      echo "alert('New Collection Added !!');";
      echo "window.location.href = '" . base_url() . "index.php/CollectionController/InsertCollectionTry2/'+ $IDNumber;";
      echo "</script>";
    }
  }

  public function addBankDetails($IDNumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    // Update Cash and Narration (Update total cash and total cheque)
    $sql = "SELECT min(ID) as ID
              FROM Collection
              where IDNumber  = '$IDNumber'
              and WorkYear = '$WorkYear'
              and CoID = '$CoID'
      ";
    $query = $this->db->query($sql);
    $result = $query->result();

    $minIdNumber = $result[0]->ID;

    $updatedBankDetails = array(
      'ReceiptNo' => $this->input->post('ReceiptNo'),
      'SlipNo' => $this->input->post('SlipNo'),
      'CashCode' => $this->input->post('CashCode'),
      'DepBankCode' => $this->input->post('DepBankCode'),
      'CheqNo' => $this->input->post('CheqNo'),
      'UTRNo' => $this->input->post('UTRNo'),
      'CheqBankCode' => $this->input->post('CheqBankCode'),
      'TrCode' => $this->input->post('TrCode'),
      'ChqDate' => $this->input->post('ChqDate')
    );

    $arrayCollection = array('IDNumber' => $IDNumber, 'CoID' => $CoID, 'WorkYear' => $WorkYear, 'ID' => $minIdNumber);
    $this->db->where($arrayCollection);
    $this->db->update('Collection', $updatedBankDetails);
  }


  public function EditTry2($id, $idnumber)
  {
    $this->load->model('CollectionModel');
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $data['idnumber'] = $idnumber;
    $data['id'] = $id;

    $data['Edit_Details'] = $this->CollectionModel->getEditData($id);

    $data['Totals'] = $this->CollectionModel->getTotals1($CoID, $WorkYear, $idnumber);
    $BillNo1 = $this->CollectionModel->getBillNo($id);
    $bno = $BillNo1[0]->BillNo;
    $data['TableData'] = $this->CollectionModel->getBillWiseData1($CoID, $WorkYear, $idnumber);
    $this->form_validation->set_rules('IDNumber', 'IDNumber', 'trim');

    if ($this->form_validation->run() == FALSE) {
      //fail validation
      $data['PartyList'] = $this->CollectionModel->Get_Party_List();
      // $data['ItemList'] = $this->CollectionModel->getDataByIDNum($CoID,$WorkYear,$idnumber);
      $data['ItemList'] = $this->CollectionModel->getData($CoID, $WorkYear, $idnumber);
      $data['ACMaster_List'] = $this->CollectionModel->Get_ACMaster_List($CoID, $WorkYear);
      $data['BankList'] = $this->CollectionModel->Get_Bank_List();
      $data['CustomerList'] = $this->CollectionModel->Get_Customer_List($CoID, $WorkYear);
      $data['BrokerList'] = $this->CollectionModel->Get_Broker_List($CoID, $WorkYear);
      // $data['BillList'] = $this->CollectionModel->Get_Bill_List();


      $this->load->view('CollectionEdit2', $data);
    } else {
      $data = array(
        'CoID' => $CoID,
        'WorkYear' => $WorkYear,
        'DebtorCode' => $this->input->post('DebtorCode'),
        'BrokerCode' => $this->input->post('BrokerCode'),
        'IDNumber' => $this->input->post('IDNumber'),
        'CollectDate' => $this->input->post('CollectDate'),
        'Mode' => $this->input->post('Mode'),
        'BillNo' => $this->input->post('BillNo'),
        'LDays' => $this->input->post('LDays'),
        'VatavRate' => $this->input->post('VatavRate'),
        'VatavAmt' => $this->input->post('VatavAmt'),
        'BrokRate' => $this->input->post('BrokRate'),
        'BrokAmt' => $this->input->post('BrokAmt'),
        'IntRate' => $this->input->post('IntRate'),
        'IntAmt' => $this->input->post('IntAmt'),
        'LFeeRate' => $this->input->post('LFeeRate'),
        'LFeeAmt' => $this->input->post('LFeeAmt'),
        'Chithi' => $this->input->post('Chithi'),
        'ChequeAmt' => $this->input->post('ChequeAmt'),
        'CashAmt' => $this->input->post('CashAmt'),
        'KasarAmt' => $this->input->post('KasarAmt'),
      );
      // $this->db->where('ID',$id);
      $dataCollection = array('IDNumber' => $idnumber, 'CoID' => $CoID, 'WorkYear' => $WorkYear, 'ID' => $id);
      $this->db->where($dataCollection);
      $this->db->update('Collection', $data);


      // Update Cash and Narration (Update total cash and total cheque)
      $sql = "SELECT min(ID) as ID
                    FROM Collection
                    where IDNumber  = '$idnumber'
                    and WorkYear = '$WorkYear'
                    and CoID = '$CoID'
            ";
      $query = $this->db->query($sql);
      $result = $query->result();

      $minIdNumber = $result[0]->ID;

      $getCashBankTotal = "
                                SELECT Sum(ChequeAmt) as TotalChqAmt,SUM(CashAmt) as TotalCashAmt
                                FROM Collection
                                where IDNumber  = '$idnumber'
                                and WorkYear = '$WorkYear'
                                and CoID = '$CoID'
                              ";
      $queryCashBankTotal = $this->db->query($getCashBankTotal);
      $cashBankTotal = $queryCashBankTotal->result();

      $TotalChequeAmt = $cashBankTotal[0]->TotalChqAmt;
      $TotalCashAmt = $cashBankTotal[0]->TotalCashAmt;

      $updatedBankDetails = array(
        'TotalChqAmt' => $TotalChequeAmt,
        'TotalCashAmt' => $TotalCashAmt
      );

      $arrayCollection = array('IDNumber' => $idnumber, 'CoID' => $CoID, 'WorkYear' => $WorkYear, 'ID' => $minIdNumber);
      $this->db->where($arrayCollection);
      $this->db->update('Collection', $updatedBankDetails);

      $Amt = "
                                SELECT Sum(VatavAmt+
                                            BrokAmt+
                                            ChequeAmt+
                                            CashAmt+
                                            KasarAmt-
                                            (Chithi+IntAmt+LFeeAmt) 
                                          ) as RcptAmt
                                FROM Collection
                                where BillNo  = '$bno'
                                and WorkYear = '$WorkYear'
                                and CoID = '$CoID'
                              ";

      $query = $this->db->query($Amt);
      $result = $query->result();

      $RcptAmt = $result[0]->RcptAmt;

      $data1 = array(
        'RcptAmt' => $RcptAmt
      );

      $arrayCollection = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'BillNo' => $bno);
      $this->db->where($arrayCollection);
      $this->db->update('SaleMast', $data1);

      echo "<script> ";
      echo "alert('Collection Updated!!');";
      echo "window.location.href = '" . base_url() . "index.php/CollectionController/InsertCollectionTry2/'+ $idnumber;";
      echo "</script>";
    }
  }

  public function name_dropdown()
  {
    $this->load->model('CollectionModel');
    $value = $this->CollectionModel->pname_ddmodel();
    echo json_encode($value);
  }

  public function getPartyBillList()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $this->load->model('CollectionModel');
    $ACCode = $this->input->post('PartyCode');
    $value['PartyBillList'] = $this->CollectionModel->Get_Party_Data($CoID, $WorkYear, $ACCode);
    // $value['GrandTotal'] = $this->CollectionModel->Get_Party_Total($CoID,$WorkYear,$ACCode);
    echo json_encode($value);
  }

  public function getCustBillList()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $this->load->model('CollectionModel');
    $ACCode = $this->input->post('CustomerCode');
    $value['CustBillList'] = $this->CollectionModel->Get_Cust_Data($CoID, $WorkYear, $ACCode);
    echo json_encode($value);
  }

  public function getBrokerBillList()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $this->load->model('CollectionModel');
    $ACCode = $this->input->post('BrokerCode1');
    $value['BrokerBillList'] = $this->CollectionModel->Get_Broker_Data($CoID, $WorkYear, $ACCode);
    echo json_encode($value);
  }

  public function Get_Bill_List()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $this->load->model('CollectionModel');
    $PartyCode = $this->input->post('PartyCode');
    $value['BillList'] = $this->CollectionModel->Get_Bill_List1($CoID, $WorkYear, $PartyCode);
    echo json_encode($value);
  }

  public function EditTry($id)
  {
    $this->load->model('CollectionModel');
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $data['TableData'] = $this->CollectionModel->getBillWiseData1($CoID, $WorkYear, $id);
    $data['Totals'] = $this->CollectionModel->getTotals1($CoID, $WorkYear, $id);
    $data['BillNo1'] = $this->CollectionModel->getBillNo1($id);
    $bno = $data['BillNo1'][0]->BillNo;

    $this->form_validation->set_rules('IDNumber', 'IDNumber', 'trim');

    if ($this->form_validation->run() == FALSE) {
      //fail validation
      $data['PartyList'] = $this->CollectionModel->Get_Party_List();
      // $data['ItemList'] = $this->CollectionModel->getDataByIDNum($CoID,$WorkYear,$id);
      $data['ItemList'] = $this->CollectionModel->getData($CoID, $WorkYear, $id);
      $data['CustomerList'] = $this->CollectionModel->Get_Customer_List($CoID, $WorkYear);
      $data['BrokerList'] = $this->CollectionModel->Get_Broker_List($CoID, $WorkYear);
      $data['ACMaster_List'] = $this->CollectionModel->Get_ACMaster_List($CoID, $WorkYear);
      $data['Bank_List'] = $this->CollectionModel->Get_ACMaster_List1($CoID, $WorkYear);
      $data['BankList'] = $this->CollectionModel->Get_Bank_List();
      //$data['BillList'] = $this->CollectionModel->Get_Bill_List();
      $data['idnumber'] = $id;

      $this->load->view('CollectionEdit', $data);
    } else {
      $data = array(
        'CollectDate' => $this->input->post('CollectDate'),
        'DebtorCode' => $this->input->post('DebtorCode'),
        'BrokerCode' => $this->input->post('BrokerCode'),
        'LDays' => $this->input->post('LDays'),
        'VatavRate' => $this->input->post('VatavRate'),
        'VatavAmt' => $this->input->post('VatavAmt'),
        'BrokRate' => $this->input->post('BrokRate'),
        'BrokAmt' => $this->input->post('BrokAmt'),
        'IntRate' => $this->input->post('IntRate'),
        'IntAmt' => $this->input->post('IntAmt'),
        'LFeeRate' => $this->input->post('LFeeRate'),
        'LFeeAmt' => $this->input->post('LFeeAmt'),
        'Chithi' => $this->input->post('Chithi'),
        'ChequeAmt' => $this->input->post('ChequeAmt'),
        'CashAmt' => $this->input->post('CashAmt'),
        'KasarAmt' => $this->input->post('KasarAmt'),
        'IDNumber' => $this->input->post('IDNumber'),
        'Mode' => $this->input->post('Mode'),
        'ReceiptNo' => $this->input->post('ReceiptNo'),
        'SlipNo' => $this->input->post('SlipNo'),
        'TotalCashAmt' => $this->input->post('TotalCashAmt'),
        'CashCode' => $this->input->post('CashCode'),
        'TotalChqAmt' => $this->input->post('TotalChqAmt'),
        'DepBankCode' => $this->input->post('DepBankCode'),
        'CheqNo' => $this->input->post('CheqNo'),
        'UTRNo' => $this->input->post('UTRNo'),
        'ReturnAmt' => $this->input->post('ReturnAmt'),
        'CheqBankCode' => $this->input->post('CheqBankCode'),
        'TrCode' => $this->input->post('TrCode'),
        'ChqDate' => $this->input->post('ChqDate')
      );
      $this->db->where('ID', $id);
      $this->db->update('Collection', $data);

      // Sum(VatavAmt+BrokAmt+LFeeAmt+Chithi+ChequeAmt+CashAmt+KasarAmt - IntAmt) as RcptAmt

      $Amt = "
                                SELECT 
                                        Sum(
                                          VatavAmt+
                                          BrokAmt+
                                          (IntAmt+LFeeAmt+Chithi)+
                                          ChequeAmt+CashAmt+KasarAmt
                                        ) as RcptAmt

                                FROM Collection
                                where BillNo  = '$bno'
                                and WorkYear = '$WorkYear'
                                and CoID = '$CoID'
                              ";
      $query = $this->db->query($Amt);
      $result = $query->result();

      $RcptAmt = $result[0]->RcptAmt;

      $data1 = array(
        'RcptAmt' => $RcptAmt
      );
      // $data1 = array(
      //     'RcptAmt' =>$this->input->post('RcptAmt')
      // );
      $this->db->where('BillNo', $bno);
      $this->db->update('SaleMast', $data1);

      echo "<script> ";
      echo "alert('Collection Updated!!');";
      echo "window.location.href = '" . base_url() . "index.php/CollectionController/EditTry/'+ $id;";
      echo "</script>";
    }
  }

  // public function InsertCollection2($bill)
  // {
  //    $this->load->model('CollectionModel');
  //     $this->form_validation->set_rules('IDNumber', 'IDNumber', 'trim');

  //     if ($this->form_validation->run() == FALSE) {
  //          //fail validation 
  //        $data['PartyList'] = $this->CollectionModel->Get_Party_List();
  //        $data['ItemList'] = $this->CollectionModel->get_details();
  //        $data['CustomerList'] = $this->CollectionModel->Get_Customer_List();
  //        $data['BrokerList'] = $this->CollectionModel->Get_Broker_List();
  //        $data['BillList'] = $this->CollectionModel->Get_Bill_List();

  //        $data['billno'] = $bill;
  //        $data['TableData'] = $this->CollectionModel->getBillWiseData($bill);
  //        $data['Totals'] = $this->CollectionModel->getTotals($bill);
  //        $this->load->view('CollectionInsert1',$data);
  //     }
  //     else
  //    {
  //        $billno =  $this->input->post('BillNo');
  //      $data = array(

  //             'BillNo' => $billno,
  //             'CollectDate' => $this->input->post('CollectDate'),
  //             'LDays' => $this->input->post('LDays'),
  //             'VatavRate' => $this->input->post('VatavRate'),
  //             'VatavAmt'=> $this->input->post('VatavAmt'),
  //             'BrokRate'=> $this->input->post('BrokRate'),
  //             'BrokAmt'=> $this->input->post('BrokAmt'),
  //             'IntRate'=> $this->input->post('IntRate'),
  //             'IntAmt'=> $this->input->post('IntAmt'),
  //             'LFeeRate'=> $this->input->post('LFeeRate'),
  //             'LFeeAmt'=> $this->input->post('LFeeAmt'),
  //             'Chithi'=> $this->input->post('Chithi'),
  //             'ChequeAmt'=> $this->input->post('ChequeAmt'),
  //             'CashAmt'=> $this->input->post('CashAmt'),
  //             'KasarAmt'=> $this->input->post('KasarAmt'),
  //             'IDNumber'=> $this->input->post('IDNumber'),
  //             'Mode'=> $this->input->post('Mode')
  //        );

  //        $this->db->insert('Collection', $data);

  //        $data1 = array(
  //            'RcptAmt' =>$this->input->post('RcptAmt')
  //        );
  //        $this->db->where('BillNo', $billno);
  //        $this->db->update('SaleMast', $data1);


  //        echo "<script> " ;
  //        echo "alert('New Collection Added !!');" ;
  //        echo "window.location.href = '" . base_url() . "index.php/CollectionController/InsertCollection2/'+ $billno;";
  //        echo "</script>" ;


  //    }
  // }

  // public function Edit($idnumber)
  // {

  //    $this->load->model('CollectionModel');
  //    $data['TableData'] = $this->CollectionModel->getBillWiseData1($idnumber);
  //    $data['Totals'] = $this->CollectionModel->getTotals1($idnumber);
  //    $this->form_validation->set_rules('IDNumber', 'IDNumber', 'trim');

  //    if ($this->form_validation->run() == FALSE)
  //      {
  //          //fail validation
  //        $data['PartyList'] = $this->CollectionModel->Get_Party_List();
  //        $data['ItemList'] = $this->CollectionModel->get_details('1','2020-21');
  //        $data['CustomerList'] = $this->CollectionModel->Get_Customer_List('1','2020-21');
  //        $data['BrokerList'] = $this->CollectionModel->Get_Broker_List('1','2020-21');
  //        $data['BillList'] = $this->CollectionModel->Get_Bill_List();
  //        $data['idnumber'] = $idnumber;


  //          $this->load->view('CollectionUpdate', $data);
  //      }
  //    else
  //    {
  //  //      $data = array(
  //  //          'AreaCode' => $this->input->post('area_code'),
  //  //          'AreaName' => $this->input->post('area_title')
  //  //     );
  //  //     $this->db->where('AreaCode', $areacode);
  //  //     $this->db->update('AreaMaster', $data); 

  //  // $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record is Successfully Updated!</div>');
  //  //     echo "<script> " ;
  //  //     echo "alert('Area Master Updated !!');" ;
  //  //     echo "window.location.href = '" . base_url() . "index.php/AreaMasterController/show';" ;
  //  //     echo "</script>" ;
  //    }

  // }

  // public function EditNew($id,$idnumber)
  // {

  //    $this->load->model('CollectionModel');
  //    $data['Edit_Details'] = $this->CollectionModel->getEditData($id);
  //    $data['TableData'] = $this->CollectionModel->getBillWiseData1($idnumber);
  //    $data['Totals'] = $this->CollectionModel->getTotals1($idnumber);
  //    $this->form_validation->set_rules('IDNumber', 'IDNumber', 'trim');

  //    if ($this->form_validation->run() == FALSE)
  //      {
  //          //fail validation
  //        $data['PartyList'] = $this->CollectionModel->Get_Party_List();
  //        $data['ItemList'] = $this->CollectionModel->get_details();
  //        $data['CustomerList'] = $this->CollectionModel->Get_Customer_List();
  //        $data['BrokerList'] = $this->CollectionModel->Get_Broker_List();
  //        $data['BillList'] = $this->CollectionModel->Get_Bill_List();
  //        $data['idnumber'] = $idnumber;
  //        $data['id'] = $id;


  //          $this->load->view('CollectionUpdate2', $data);
  //      }
  //    else
  //    {
  //  $data = array(

  //             'BillNo' => $this->input->post('BillNo'),
  //             'CollectDate' => $this->input->post('CollectDate'),
  //             'LDays' => $this->input->post('LDays'),
  //             'VatavRate' => $this->input->post('VatavRate'),
  //             'VatavAmt'=> $this->input->post('VatavAmt'),
  //             'BrokRate'=> $this->input->post('BrokRate'),
  //             'BrokAmt'=> $this->input->post('BrokAmt'),
  //             'IntRate'=> $this->input->post('IntRate'),
  //             'IntAmt'=> $this->input->post('IntAmt'),
  //             'LFeeRate'=> $this->input->post('LFeeRate'),
  //             'LFeeAmt'=> $this->input->post('LFeeAmt'),
  //             'Chithi'=> $this->input->post('Chithi'),
  //             'ChequeAmt'=> $this->input->post('ChequeAmt'),
  //             'CashAmt'=> $this->input->post('CashAmt'),
  //             'KasarAmt'=> $this->input->post('KasarAmt'),
  //             'IDNumber'=> $this->input->post('IDNumber'),
  //             'Mode'=> $this->input->post('Mode')
  //        );
  //        $this->db->where('ID',$id);
  //        $this->db->update('Collection', $data);

  //        $data1 = array(
  //            'RcptAmt' =>$this->input->post('RcptAmt')
  //        );
  //        $this->db->where('BillNo', $billno);
  //        $this->db->update('SaleMast', $data1); 

  //      echo "<script> " ;
  //        echo "alert('Collection Updated!!');" ;
  //        echo "window.location.href = '" . base_url() . "index.php/CollectionController/Edit/'+ $idnumber;";
  //        echo "</script>" ;
  //    }

  // }

  public function DeleteFromGrid($idnumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
            SELECT BillNo From Collection Where IDNumber = '$idnumber'
            ";
    $query = $this->db->query($sql);
    $result = $query->result_array();


    // $this->db->where('IDNumber', $idnumber);
    $delCollection = array('IDNumber' => $idnumber, 'CoID' => $CoID, 'WorkYear' => $WorkYear);
    $this->db->where($delCollection);
    $this->db->delete('Collection');


    foreach ($result as $key) {
      $bno = $key['BillNo'];
      // echo $bno;
      $Amt = "
                    SELECT Sum(VatavAmt+BrokAmt+LFeeAmt+Chithi+ChequeAmt+CashAmt+KasarAmt - IntAmt) as RcptAmt
                    FROM Collection
                    where BillNo  = '$bno'
                    and WorkYear = '$WorkYear'
                    and CoID = '$CoID'
                  ";

      $query = $this->db->query($Amt);
      $result = $query->result();

      $RcptAmt = $result[0]->RcptAmt;

      $data1 = array(
        'RcptAmt' => $RcptAmt
      );

      // $data1 = array(
      //     'RcptAmt' =>$this->input->post('RcptAmt')
      // );
      $this->db->where('BillNo', $bno);
      $this->db->update('SaleMast', $data1);
    }

    echo "<script> ";
    echo "alert('Collection Deleted !!');";
    echo "window.location.href = '" . base_url() . "index.php/CollectionController/show';";
    echo "</script>";
  }

  public function Delete1($id, $IDNumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $this->load->model('CollectionModel');
    $billNo = $this->CollectionModel->getBillNo($id);
    $bno = $billNo[0]->BillNo;

    $sql = "SELECT min(ID) as ID
                FROM Collection
                where IDNumber  = '$IDNumber'
                and WorkYear = '$WorkYear'
                and CoID = '$CoID'
        ";
    $query = $this->db->query($sql);
    $result = $query->result();

    $minIdNumber = $result[0]->ID;

    if ($minIdNumber == $id) {
      $this->load->model('CollectionModel');
      $data['BankDetails'] = $this->CollectionModel->getBankData($CoID, $WorkYear, $IDNumber, $id);

      $bno = $data['BankDetails'][0]->BillNo;
      $ReceiptNo = $data['BankDetails'][0]->ReceiptNo;
      $SlipNo = $data['BankDetails'][0]->SlipNo;
      $CashCode = $data['BankDetails'][0]->CashCode;
      $DepBankCode = $data['BankDetails'][0]->DepBankCode;
      $CheqNo = $data['BankDetails'][0]->CheqNo;
      $UTRNo = $data['BankDetails'][0]->UTRNo;
      $ReturnAmt = $data['BankDetails'][0]->ReturnAmt;
      $CheqBankCode = $data['BankDetails'][0]->CheqBankCode;
      $TrCode = $data['BankDetails'][0]->TrCode;
      $ChqDate = $data['BankDetails'][0]->ChqDate;

      // Delete Record
      $dataCollection = array('IDNumber' => $IDNumber, 'CoID' => $CoID, 'WorkYear' => $WorkYear, 'ID' => $id);
      $this->db->where($dataCollection);
      $this->db->delete('Collection');

      // Update Cash and Narration 
      $sql = "SELECT min(ID) as ID
                FROM Collection
                where IDNumber  = '$IDNumber'
                and WorkYear = '$WorkYear'
                and CoID = '$CoID'
            ";
      $query = $this->db->query($sql);
      $result = $query->result();

      $minIdNumber = $result[0]->ID;

      $getCashBankTotal = "SELECT Sum(ChequeAmt) as TotalChqAmt,SUM(CashAmt) as TotalCashAmt
                            FROM Collection
                            where IDNumber  = '$IDNumber'
                            and WorkYear = '$WorkYear'
                            and CoID = '$CoID'
            ";
      $queryCashBankTotal = $this->db->query($getCashBankTotal);
      $cashBankTotal = $queryCashBankTotal->result();

      $TotalChequeAmt = $cashBankTotal[0]->TotalChqAmt;
      $TotalCashAmt = $cashBankTotal[0]->TotalCashAmt;

      $updatedBankDetails = array(
        'TotalChqAmt' => $TotalChequeAmt,
        'TotalCashAmt' => $TotalCashAmt,
        'ReceiptNo' => $ReceiptNo,
        'SlipNo' => $SlipNo,
        'CashCode' => $CashCode,
        'DepBankCode' => $DepBankCode,
        'CheqNo' => $CheqNo,
        'UTRNo' => $UTRNo,
        'CheqBankCode' => $CheqBankCode,
        'TrCode' => $TrCode,
        'ChqDate' => $ChqDate
      );

      $arrayCollection = array('IDNumber' => $IDNumber, 'CoID' => $CoID, 'WorkYear' => $WorkYear, 'ID' => $minIdNumber);
      $this->db->where($arrayCollection);
      $this->db->update('Collection', $updatedBankDetails);


      $Amt = "
                SELECT 
                        Sum(
                              VatavAmt+
                              BrokAmt-
                              (IntAmt+LFeeAmt+Chithi)
                              +ChequeAmt+CashAmt+KasarAmt 
                          ) 
                        as RcptAmt
                FROM Collection
                where BillNo  = '$bno'
                and WorkYear = '$WorkYear'
                and CoID = '$CoID'
              ";


      $query = $this->db->query($Amt);
      $result = $query->result();

      $RcptAmt = $result[0]->RcptAmt;


      $data1 = array(
        'RcptAmt' => $RcptAmt
      );

      // $data1 = array(
      //     'RcptAmt' =>$this->input->post('RcptAmt')
      // );
      $this->db->where('BillNo', $bno);
      $this->db->update('SaleMast', $data1);
    }

    $dataCollection = array('IDNumber' => $IDNumber, 'CoID' => $CoID, 'WorkYear' => $WorkYear, 'ID' => $id);
    $this->db->where($dataCollection);
    $this->db->delete('Collection');

    $getCashBankTotal = "SELECT Sum(ChequeAmt) as TotalChqAmt,SUM(CashAmt) as TotalCashAmt
                            FROM Collection
                            where IDNumber  = '$IDNumber'
                            and WorkYear = '$WorkYear'
                            and CoID = '$CoID'
        ";
    $queryCashBankTotal = $this->db->query($getCashBankTotal);
    $cashBankTotal = $queryCashBankTotal->result();

    $TotalChequeAmt = $cashBankTotal[0]->TotalChqAmt;
    $TotalCashAmt = $cashBankTotal[0]->TotalCashAmt;

    $updatedBankDetails = array(
      'TotalChqAmt' => $TotalChequeAmt,
      'TotalCashAmt' => $TotalCashAmt
    );

    $arrayCollection = array('IDNumber' => $IDNumber, 'CoID' => $CoID, 'WorkYear' => $WorkYear, 'ID' => $minIdNumber);
    $this->db->where($arrayCollection);
    $this->db->update('Collection', $updatedBankDetails);

    $Amt = "
                SELECT Sum(VatavAmt+BrokAmt+LFeeAmt+Chithi+ChequeAmt+CashAmt+KasarAmt - IntAmt) as RcptAmt
                FROM Collection
                where BillNo  = '$bno'
                and WorkYear = '$WorkYear'
                and CoID = '$CoID'
              ";


    $query = $this->db->query($Amt);
    $result = $query->result();

    $RcptAmt = $result[0]->RcptAmt;

    $data1 = array(
      'RcptAmt' => $RcptAmt
    );

    // $data1 = array(
    //     'RcptAmt' =>$this->input->post('RcptAmt')
    // );
    $this->db->where('BillNo', $bno);
    $this->db->update('SaleMast', $data1);

    echo "<script> ";
    echo "alert('Collection Deleted !!');";
    echo "window.location.href = '" . base_url() . "index.php/CollectionController/InsertCollectionTry2/'+ $IDNumber;";
    echo "</script>";
  }
}
