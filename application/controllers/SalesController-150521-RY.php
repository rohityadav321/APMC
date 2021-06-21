<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SalesController extends CI_Controller
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

  public function salesReturnEntryShow()
  {
    // Calls the model
    // $this->load->model('SalesModel');
    // $data['SalesEntryData'] = $this->SalesModel->getSalesReturnEntryData();
    // $this->load->view('menu_1');
    $this->load->view('SalesReturnEntryView');
    // print_r('Success');
  }

  public function getSalesDet()
  {
    // Calls the model
    $id = $this->input->post('refBillNo');

    $this->load->model('SalesModel');
    $data['SalesEntryData'] = $this->SalesModel->getSalesReturnEntryData($id);
    // $this->load->view('menu_1');
    echo json_encode($data);
  }

  public function show()
  {
    if ($this->input->post('submit') != NULL) {
      $postData = $this->input->post();

      // Read POST data
      $fromYear = $postData['fromYear'];
      $toYear = $postData['toYear'];


      $this->load->model('SalesModel');
      $data['Item_List'] = $this->SalesModel->get_detailsFilter($fromYear, $toYear);

      $this->load->view('menu_1');
      $this->load->view('SalesGrid', $data);
    } else {
      $this->load->model('SalesModel');
      $data['Item_List'] = $this->SalesModel->get_details();
      $this->load->view('menu_1');
      $this->load->view('SalesGrid', $data);
    }
  }

  // Insert 
  public function showTry()
  {
    $this->load->model('SalesModel');
    $data['GodownList'] = $this->SalesModel->Get_Godown_List();
    $data['DebtorList'] = $this->SalesModel->Get_Debtor_List();
    $data['BrokerList'] = $this->SalesModel->Get_Broker_List();
    $data['CustomerList'] = $this->SalesModel->Get_Customer_List();

    $this->load->view('SalesInsertTry', $data);
  }


  public function showTry2($bill)
  {
    $this->load->model('SalesModel');
    $data['GodownList'] = $this->SalesModel->Get_Godown_List();
    $data['DebtorList'] = $this->SalesModel->Get_Debtor_List();
    $data['BrokerList'] = $this->SalesModel->Get_Broker_List();
    $data['CustomerList'] = $this->SalesModel->Get_Customer_List();
    $data['Loaded_List'] = $this->SalesModel->get_load_data($bill);
    $Debtor = $data['Loaded_List'][0]->DebtorID;
    $data['DebtorID'] = $this->SalesModel->getDebtorName($Debtor);
    $data['TableData'] = $this->SalesModel->getTableDataIdWise($bill);
    $data['Total'] = $this->SalesModel->getTotal($bill);
    $this->load->view('SalesInsertTry2', $data);
  }

  public function debtor($ACCode)
  {
    if (empty($ACCode)) {
      echo json_encode([]);
      exit;
    }

    $this->load->model('SalesModel');
    $data = $this->SalesModel->getDebtors($ACCode);
    echo json_encode($data);
    exit;
  }

  public function customercode($ACCode)
  {
    if (empty($ACCode)) {
      echo json_encode([]);
      exit;
    }

    $this->load->model('SalesModel');
    $data = $this->SalesModel->getCustomersCode($ACCode);
    echo json_encode($data);
    exit;
  }

  public function customer($ACCode)
  {
    if (empty($ACCode)) {
      echo json_encode([]);
      exit;
    }

    $this->load->model('SalesModel');
    $data = $this->SalesModel->getCustomers($ACCode);
    echo json_encode($data);
    exit;
  }

  public function broker($ACCode)
  {
    if (empty($ACCode)) {
      echo json_encode([]);
      exit;
    }

    $this->load->model('SalesModel');
    $data = $this->SalesModel->getBrokers($ACCode);
    echo json_encode($data);
    exit;
  }

  public function godownData()
  {
    $this->load->model('SalesModel');
    $GID = $this->input->post('GID');
    $value['GodownWise'] = $this->SalesModel->godownWise($GID);
    echo json_encode($value);
  }

  // created 23/03/21
  public function LotNoData()
  {
    $this->load->model('SalesModel');
    $GodownI = $this->input->post('GodownI');
    $LotNo = $this->input->post('LotNo');
    $result = $this->SalesModel->lotWise($GodownI, $LotNo);
    if ($result == null) {
      echo json_encode("EMPTY");
    } else {
      echo json_encode($result);
    }
  }


  // Updated - Bijal

  // ItemWise Modal 
  public function itemData()
  {
    $this->load->model('SalesModel');
    $gid = $this->input->post('GID');
    $itemCode = $this->input->post('ItemCode');
    $value['ItemWise'] = $this->SalesModel->itemWise($gid, $itemCode);
    echo json_encode($value);
  }

  public function InsertSalesTry()
  {
    $this->load->model('SalesModel');
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $this->form_validation->set_rules('BillNo', 'BillNo', 'trim');
    $this->form_validation->set_rules('GodownID', 'Godown Id ', 'trim|required');
    $this->form_validation->set_rules('DebtorID', 'Debtor Id ', 'trim|required');
    $this->form_validation->set_rules('PartyCode', 'Party Code', 'trim|required');
    $this->form_validation->set_rules('BrokerID', 'Broker Code', 'trim|required');


    if ($this->form_validation->run() == FALSE) {
      $data['GodownList'] = $this->SalesModel->Get_Godown_List();
      $data['DebtorList'] = $this->SalesModel->Get_Debtor_List();
      $data['BrokerList'] = $this->SalesModel->Get_Broker_List();
      $data['CustomerList'] = $this->SalesModel->Get_Customer_List();
      $this->load->view('SalesInsertTry', $data);
    } else {
      $billno = $this->input->post('BillNo');
      $godownID = $this->input->post('GodownID');
      $partyCode = $this->input->post('PartyCode');
      $taxable = $this->input->post('Taxable');
      $tax = $this->input->post('TaxRate');

      $cgstAmt = 0;
      $sgstAmt = 0;
      $igstAmt = 0;
      $taxAmt = 0;
      $apmcchg = 0;

      if ($this->input->post('APMCIn') == "Y") {
        $apmcchg = round($this->input->post('GrAmt') * (($this->input->post('APMCChg') + $this->input->post('APMCSChg')) / 100), 2);
      }

      $GstData = $this->SalesModel->GetGST($partyCode);

      $StateCode = $GstData[0]->StateCode;
      $PartyGSTNo = $GstData[0]->PartyGSTNo;
      $PartyType = $GstData[0]->PartyType;

      $billno = $this->input->post('BillNo');
      $godownID = $this->input->post('GodownID');
      $partyCode = $this->input->post('PartyCode');
      $taxable = round($this->input->post('Taxable') + $apmcchg, 2);
      $tax = $this->input->post('TaxRate');
      $tcsAmt = $this->input->post('TCSAmt');

      if (($StateCode == '27') || ($PartyType == 'L' || $PartyType == 'M')) {
        $gst = round(($taxable * $tax) / 100, 2);
        $taxAmt = $gst;
        $cgstAmt = round(($gst / 2), 2);
        $sgstAmt = round(($gst / 2), 2);
      } else {
        $igstAmt = round(($taxable * $tax) / 100, 2);
        $taxAmt = $igstAmt;
      }

      $billAmtTotal = $tcsAmt + $taxable + $cgstAmt + $sgstAmt + $igstAmt + $this->input->post('HelMajuri') + $this->input->post('OtherChrgs');

      $vRupee = intval($billAmtTotal);
      $vPaise = $billAmtTotal - $vRupee;
      $roundoffAmt = 0;

      if ($vPaise > 0.49) {
        $roundoffAmt = 1 - $vPaise;
      } else {
        $roundoffAmt = $vPaise * -1;
      }

      $billAmt = $tcsAmt + $taxable + $cgstAmt + $sgstAmt + $igstAmt + $this->input->post('HelMajuri') + $this->input->post('OtherChrgs') + $roundoffAmt;

      $idnumber = $this->input->post('IDNumber');
      $qty = $this->input->post('Qty');
      $balqty = $this->input->post('BalQty');
      $cqty = $balqty - $qty;

      $data = array(
        'CoID' => $CoID,
        'WorkYear' => $WorkYear,
        'BillNo' => $billno,
        'BillDate' => $this->input->post('BillDate'),
        'GodownID' => $godownID,
        'LRNo' => $this->input->post('LRNo'),
        'MudiBazar' => $this->input->post('MudiBazar'),
        'EWayBillNo' => $this->input->post('EWayBillNo'),
        'DeliDate' => $this->input->post('DeliDate'),
        'DebtorID' => $this->input->post('DebtorID'),
        'PartyCode' => $partyCode,
        'CPName' => $this->input->post('CPName'),
        'Area' => $this->input->post('Area'),
        'SaleType' => $this->input->post('SaleType'),
        'BrokerID' => $this->input->post('BrokerID'),
        'BrokerTitle' => $this->input->post('BrokerTitle'),
        'HelMajuri' => $this->input->post('HelMajuri'),
        'OtherChrgs' => $this->input->post('OtherChrgs'),
        'ItemAmt' => $this->input->post('GrAmt'),
        'DiscountAmt' => $this->input->post('DiscAmt'),
        'ContAmt' => $this->input->post('ContChrg'),
        'APMCChrg' => $apmcchg,
        'TaxableAmt' => $taxable,
        'TaxAmt' => $taxAmt,
        'CGSTAmt' => $cgstAmt,
        'SGSTAmt' => $sgstAmt,
        'IGSTAmt' => $igstAmt,
        'RoffAmt' => $roundoffAmt,
        'TCSAmount' => $tcsAmt,
        'BillAmt' => $billAmt,
        'RcptAmt' => 0
      );

      $this->db->insert('SaleMast', $data);

      // Update Bill No in SaleMast table -- 27/02/2021
      $this->load->model('SalesModel');
      $result = $this->SalesModel->getBillNo();
      $BillNo = $result;

      $data2 = array('BillNo' => $BillNo);
      $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'BillNo' => 'New');
      $this->db->where($multi_where);
      $this->db->update('SaleMast', $data2);

      $data1 = array(
        'CoID' => $CoID,
        'WorkYear' => $WorkYear,
        'BillNo' => $BillNo,
        'BillDate' => $this->input->post('BillDate'),
        'GodownID' => $godownID,
        'LotNo' => $this->input->post('LotNo'),
        'ItemCode' => $this->input->post('ItemCode'),
        'ItemMark' => $this->input->post('ItemMark'),
        'Qty' => $qty,
        'GrossWt' => $this->input->post('GrossWt'),
        'NetWt' => $this->input->post('NetWt'),
        'Rate' => $this->input->post('Rate'),
        'RATEPER' => $this->input->post('RatePer'),
        'APMCIn' => $this->input->post('APMCIn'),
        'ETaxIn' => $this->input->post('ETaxIn'),
        'GrAmt' => $this->input->post('GrAmt'),
        'LagaAmt' => $this->input->post('Laga'),
        'APMCChrg' => $this->input->post('APMCChg'),
        'APMCSChrg' => $this->input->post('APMCSChg'),
        'OAPMCChrg' => $apmcchg,
        'SGSTAmt' => $sgstAmt,
        'IGSTAmt' => $igstAmt,
        'CGSTAmt' => $cgstAmt,
        'ContChrg' => $this->input->post('ContChrg'),
        'NetAmt' => $this->input->post('NetAmt'),
        'DiscDetRate' => $this->input->post('DiscDetRate'),
        'DiscAmt' => $this->input->post('DiscAmt'),
        'TaxableAmt' => $taxable,
        'TaxCode' => $this->input->post('TaxCode'),
        'TaxAmt' => $taxAmt,
        'TCSPer' => $this->input->post('TCSPer'),
        'TCSAmount' => $this->input->post('TCSAmt'),
        'WgtDiff' => $this->input->post('WgtDiff'),
        'WgtDiff1' => $this->input->post('WgtDiff1'),
        'WgtDiff2' => $this->input->post('WgtDiff2'),
        'WgtDiff3' => $this->input->post('WgtDiff3'),
        'WgtDiff4' => $this->input->post('WgtDiff4'),
        'RateDiff' => $this->input->post('RateDiff'),
        'RateDiff1' => $this->input->post('RateDiff1'),
        'RateDiff2' => $this->input->post('RateDiff2'),
        'RateDiff3' => $this->input->post('RateDiff3'),
        'RateDiff4' => $this->input->post('RateDiff4'),
        'Code1' => $this->input->post('Code1'),
        'Code2' => $this->input->post('Code2'),
        'Code3' => $this->input->post('Code3'),
        'Code4' => $this->input->post('Code4'),
        'Code5' => $this->input->post('Code5'),
        'DiffAmt1' => $this->input->post('DiffAmt1'),
        'DiffAmt2' => $this->input->post('DiffAmt2'),
        'DiffAmt3' => $this->input->post('DiffAmt3'),
        'DiffAmt4' => $this->input->post('DiffAmt4'),
        'DiffAmt5' => $this->input->post('DiffAmt5')
      );

      $this->db->insert('SaleDetails', $data1);

      $data3 = array(
        'ClosingQty' => $cqty
      );

      $this->db->where('IDNumber', $idnumber);
      $this->db->update('PurDetails', $data3);

      echo "<script> ";
      echo "alert('New Sales Added !!');";
      echo "window.location.href = '" . base_url() . "index.php/SalesController/showTry2/$BillNo'";
      echo "</script>";
    }
  }

  // Updated - Bijal
  public function InsertDetailTry($billno)
  {
    $this->load->model('SalesModel');
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $this->form_validation->set_rules('LotNo', 'LotNo', 'trim');
    if ($this->form_validation->run() == FALSE) {

      $data['GodownList'] = $this->SalesModel->Get_Godown_List();
      $data['DebtorList'] = $this->SalesModel->Get_Debtor_List();
      $data['BrokerList'] = $this->SalesModel->Get_Broker_List();
      $data['CustomerList'] = $this->SalesModel->Get_Customer_List();
      $data['Loaded_List'] = $this->SalesModel->get_load_data($billno);
      $data['TableData'] = $this->SalesModel->getTableDataIdWise($billno);
      $data['Total'] = $this->SalesModel->getTotal($billno);
      $this->load->view('SalesInsertTry2', $data);
    } else {
      $billno = $this->input->post('BillNo');
      $godownID = $this->input->post('GodownID');
      $partyCode = $this->input->post('PartyCode');
      $taxable = $this->input->post('Taxable');
      $tax = $this->input->post('TaxRate');


      $cgstAmt = 0;
      $sgstAmt = 0;
      $igstAmt = 0;
      $taxAmt = 0;
      $apmcchg = 0;

      if ($this->input->post('APMCIn') == "Y") {
        $apmcchg = round($this->input->post('GrAmt') * (($this->input->post('APMCChg') + $this->input->post('APMCSChg')) / 100), 2);
      }

      $GstData = $this->SalesModel->GetGST($partyCode);

      $StateCode = $GstData[0]->StateCode;
      $PartyGSTNo = $GstData[0]->PartyGSTNo;
      $PartyType = $GstData[0]->PartyType;

      $billno = $this->input->post('BillNo');
      $godownID = $this->input->post('GodownID');
      $partyCode = $this->input->post('PartyCode');
      $taxable = round($this->input->post('Taxable') + $apmcchg, 2);
      $tax = $this->input->post('TaxRate');

      if (($StateCode == '27') || ($PartyType == 'L' || $PartyType == 'M')) {
        $gst = round(($taxable * $tax) / 100, 2);
        $taxAmt = $gst;
        $cgstAmt = round(($gst / 2), 2);
        $sgstAmt = round(($gst / 2), 2);
      } else {
        $igstAmt = round(($taxable * $tax) / 100, 2);
        $taxAmt = $igstAmt;
      }


      $idnumber = $this->input->post('IDNumber');
      $qty = $this->input->post('Qty');
      $balqty = $this->input->post('BalQty');
      $cqty = $balqty - $qty;

      $data1 = array(
        'CoID' => $CoID,
        'WorkYear' => $WorkYear,
        'BillNo' => $billno,
        'BillDate' => $this->input->post('BillDate'),
        'GodownID' => $godownID,
        'LotNo' => $this->input->post('LotNo'),
        'ItemCode' => $this->input->post('ItemCode'),
        'ItemMark' => $this->input->post('ItemMark'),
        'Qty' => $qty,
        'GrossWt' => $this->input->post('GrossWt'),
        'NetWt' => $this->input->post('NetWt'),
        'Rate' => $this->input->post('Rate'),
        'RATEPER' => $this->input->post('RatePer'),
        'APMCIn' => $this->input->post('APMCIn'),
        'ETaxIn' => $this->input->post('ETaxIn'),
        'GrAmt' => $this->input->post('GrAmt'),
        'LagaAmt' => $this->input->post('Laga'),
        'APMCChrg' => $this->input->post('APMCChg'),
        'APMCSChrg' => $this->input->post('APMCSChg'),
        'OAPMCChrg' => $apmcchg,
        'SGSTAmt' => $sgstAmt,
        'IGSTAmt' => $igstAmt,
        'CGSTAmt' => $cgstAmt,
        'ContChrg' => $this->input->post('ContChrg'),
        'NetAmt' => $this->input->post('NetAmt'),
        'DiscDetRate' => $this->input->post('DiscDetRate'),
        'DiscAmt' => $this->input->post('DiscAmt'),
        'TaxableAmt' => $taxable,
        'TaxCode' => $this->input->post('TaxCode'),
        'TaxAmt' => $taxAmt,
        'TCSPer' => $this->input->post('TCSPer'),
        'TCSAmount' => $this->input->post('TCSAmt'),
        'WgtDiff' => $this->input->post('WgtDiff'),
        'WgtDiff1' => $this->input->post('WgtDiff1'),
        'WgtDiff2' => $this->input->post('WgtDiff2'),
        'WgtDiff3' => $this->input->post('WgtDiff3'),
        'WgtDiff4' => $this->input->post('WgtDiff4'),
        'RateDiff' => $this->input->post('RateDiff'),
        'RateDiff1' => $this->input->post('RateDiff1'),
        'RateDiff2' => $this->input->post('RateDiff2'),
        'RateDiff3' => $this->input->post('RateDiff3'),
        'RateDiff4' => $this->input->post('RateDiff4'),
        'Code1' => $this->input->post('Code1'),
        'Code2' => $this->input->post('Code2'),
        'Code3' => $this->input->post('Code3'),
        'Code4' => $this->input->post('Code4'),
        'Code5' => $this->input->post('Code5'),
        'DiffAmt1' => $this->input->post('DiffAmt1'),
        'DiffAmt2' => $this->input->post('DiffAmt2'),
        'DiffAmt3' => $this->input->post('DiffAmt3'),
        'DiffAmt4' => $this->input->post('DiffAmt4'),
        'DiffAmt5' => $this->input->post('DiffAmt5')
      );
      $this->db->insert('SaleDetails', $data1);

      $salesDetailsTotal = $this->SalesModel->getTotal($billno);


      $add = $salesDetailsTotal[0]->TCSAmount + $salesDetailsTotal[0]->TaxableAmt + $salesDetailsTotal[0]->IGSTAmt +
        $salesDetailsTotal[0]->CGSTAmt + $salesDetailsTotal[0]->SGSTAmt;

      $billAmtTotal = $add + $this->input->post('HelMajuri') + $this->input->post('OtherChrgs');

      $vRupee = intval($billAmtTotal);
      $vPaise = $billAmtTotal - $vRupee;
      $roundoffAmt = 0;

      if ($vPaise > 0.49) {
        $roundoffAmt = 1 - $vPaise;
      } else {
        $roundoffAmt = $vPaise * -1;
      }
      $billAmt = $add + $this->input->post('HelMajuri') + $this->input->post('OtherChrgs') + $roundoffAmt;


      $data4 = array(
        'ItemAmt' => $salesDetailsTotal[0]->ItemAmount,
        'DiscountAmt' => $salesDetailsTotal[0]->DiscAmt,
        'LagaAmt' => $salesDetailsTotal[0]->Laga,
        'EntryTax' => $salesDetailsTotal[0]->EntryTax,
        'ContAmt' => $salesDetailsTotal[0]->PackingCharge,
        'APMCChrg' => $salesDetailsTotal[0]->APMCChrg,
        'TaxableAmt' => $salesDetailsTotal[0]->TaxableAmt,
        'TaxAmt' => $salesDetailsTotal[0]->TaxAmt,
        'CGSTAmt' => $salesDetailsTotal[0]->CGSTAmt,
        'SGSTAmt' => $salesDetailsTotal[0]->SGSTAmt,
        'IGSTAmt' => $salesDetailsTotal[0]->IGSTAmt,
        'RoffAmt' => $roundoffAmt,
        'TCSAmount' => $salesDetailsTotal[0]->TCSAmount,
        'BillAmt' => $billAmt
      );

      $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'BillNo' => $billno);
      $this->db->where($multi_where);
      $this->db->update('SaleMast', $data4);


      $data3 = array(
        'ClosingQty' => $cqty
      );

      $this->db->where('IDNumber', $idnumber);
      $this->db->update('PurDetails', $data3);

      echo "<script> ";
      echo "alert('New Sales Details Added !!');";
      echo "window.location.href = '" . base_url() . "index.php/SalesController/showTry2/'+ $billno;";
      echo "</script>";
    }
  }


  // Updated - Bijal
  public function EditTry($billid)
  {
    $this->load->model('SalesModel');
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $this->form_validation->set_rules('LotNo', 'LotNo', 'trim');
    $billn = $this->SalesModel->getBill($billid);
    $bno = $billn[0]->BillNo;

    if ($this->form_validation->run() == FALSE) {
      $data['GodownList'] = $this->SalesModel->Get_Godown_List();
      $data['DebtorList'] = $this->SalesModel->Get_Debtor_List();
      $data['BrokerList'] = $this->SalesModel->Get_Broker_List();
      $data['CustomerList'] = $this->SalesModel->Get_Customer_List();
      $data['SalesDList'] = $this->SalesModel->loadSalesDetail($billid);
      $gid = $data['SalesDList'][0]->GodownID;
      $data['SalesDetails'] = $this->SalesModel->getSalesDetail($billid, $gid);
      $data['Loaded_List'] = $this->SalesModel->get_load_data($bno);
      $Debtor = $data['Loaded_List'][0]->DebtorID;
      $data['DebtorID'] = $this->SalesModel->getDebtorName($Debtor);
      $data['TableData'] = $this->SalesModel->getTableDataIdWise($bno);
      $data['Total'] = $this->SalesModel->getTotal($bno);
      $this->load->view('SalesDetailEditTry', $data);
    } else {
      $currentQty1 = $this->SalesModel->getCurrentQty($billid);
      $currentQty = $currentQty1[0]->Qty;

      $billno = $this->input->post('BillNo');
      $godownID = $this->input->post('GodownID');
      $partyCode = $this->input->post('PartyCode');
      $taxable = $this->input->post('Taxable');
      $tax = $this->input->post('TaxRate');

      $cgstAmt = 0;
      $sgstAmt = 0;
      $igstAmt = 0;
      $taxAmt = 0;
      $apmcchg = 0;

      if ($this->input->post('APMCIn') == "Y") {
        $apmcchg = round($this->input->post('GrAmt') * (($this->input->post('APMCChg') + $this->input->post('APMCSChg')) / 100), 2);
      }

      $GstData = $this->SalesModel->GetGST($partyCode);
      $StateCode = $GstData[0]->StateCode;
      $PartyGSTNo = $GstData[0]->PartyGSTNo;
      $PartyType = $GstData[0]->PartyType;

      $billno = $this->input->post('BillNo');
      $godownID = $this->input->post('GodownID');
      $partyCode = $this->input->post('PartyCode');
      $taxable = round($this->input->post('Taxable') + $apmcchg, 2);
      $tax = $this->input->post('TaxRate');

      if (($StateCode == '27') || ($PartyType == 'L' || $PartyType == 'M')) {
        $gst = round(($taxable * $tax) / 100, 2);
        $taxAmt = $gst;
        $cgstAmt = round(($gst / 2), 2);
        $sgstAmt = round(($gst / 2), 2);
      } else {
        $igstAmt = round(($taxable * $tax) / 100, 2);
        $taxAmt = $igstAmt;
      }

      $billAmt = $taxAmt + $this->input->post('Taxable') + $apmcchg + $this->input->post('HelMajuri') + $this->input->post('OtherChrgs');

      $idnumber = $this->input->post('IDNumber');
      $qty = $this->input->post('Qty');
      $balqty = $this->input->post('BalQty');
      $cqty = ($balqty + $currentQty) - $qty;

      $data1 = array(
        'CoID' => $CoID,
        'WorkYear' => $WorkYear,
        'BillNo' => $billno,
        'BillDate' => $this->input->post('BillDate'),
        'GodownID' => $godownID,
        'LotNo' => $this->input->post('LotNo'),
        'ItemCode' => $this->input->post('ItemCode'),
        'ItemMark' => $this->input->post('ItemMark'),
        'Qty' => $qty,
        'GrossWt' => $this->input->post('GrossWt'),
        'NetWt' => $this->input->post('NetWt'),
        'Rate' => $this->input->post('Rate'),
        'RATEPER' => $this->input->post('RatePer'),
        'APMCIn' => $this->input->post('APMCIn'),
        'ETaxIn' => $this->input->post('ETaxIn'),
        'GrAmt' => $this->input->post('GrAmt'),
        'LagaAmt' => $this->input->post('Laga'),
        'APMCChrg' => $this->input->post('APMCChg'),
        'APMCSChrg' => $this->input->post('APMCSChg'),
        'OAPMCChrg' => $apmcchg,
        'SGSTAmt' => $sgstAmt,
        'IGSTAmt' => $igstAmt,
        'CGSTAmt' => $cgstAmt,
        'ContChrg' => $this->input->post('ContChrg'),
        'NetAmt' => $this->input->post('NetAmt'),
        'DiscDetRate' => $this->input->post('DiscDetRate'),
        'DiscAmt' => $this->input->post('DiscAmt'),
        'TaxableAmt' => $taxable,
        'TaxCode' => $this->input->post('TaxCode'),
        'TaxAmt' => $taxAmt,
        'TCSPer' => $this->input->post('TCSPer'),
        'TCSAmount' => $this->input->post('TCSAmt'),
        'WgtDiff' => $this->input->post('WgtDiff'),
        'WgtDiff1' => $this->input->post('WgtDiff1'),
        'WgtDiff2' => $this->input->post('WgtDiff2'),
        'WgtDiff3' => $this->input->post('WgtDiff3'),
        'WgtDiff4' => $this->input->post('WgtDiff4'),
        'RateDiff' => $this->input->post('RateDiff'),
        'RateDiff1' => $this->input->post('RateDiff1'),
        'RateDiff2' => $this->input->post('RateDiff2'),
        'RateDiff3' => $this->input->post('RateDiff3'),
        'RateDiff4' => $this->input->post('RateDiff4'),
        'Code1' => $this->input->post('Code1'),
        'Code2' => $this->input->post('Code2'),
        'Code3' => $this->input->post('Code3'),
        'Code4' => $this->input->post('Code4'),
        'Code5' => $this->input->post('Code5'),
        'DiffAmt1' => $this->input->post('DiffAmt1'),
        'DiffAmt2' => $this->input->post('DiffAmt2'),
        'DiffAmt3' => $this->input->post('DiffAmt3'),
        'DiffAmt4' => $this->input->post('DiffAmt4'),
        'DiffAmt5' => $this->input->post('DiffAmt5')
      );

      $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'ID' => $billid, 'BillNo' => $billno);
      $this->db->where($multi_where);
      $this->db->update('SaleDetails', $data1);

      $salesDetailsTotal = $this->SalesModel->getTotal($billno);

      $add = $salesDetailsTotal[0]->TCSAmount + $salesDetailsTotal[0]->TaxableAmt + $salesDetailsTotal[0]->IGSTAmt + $salesDetailsTotal[0]->CGSTAmt + $salesDetailsTotal[0]->SGSTAmt;
      $billAmtTotal = $add + $this->input->post('HelMajuri') + $this->input->post('OtherChrgs');

      $vRupee = intval($billAmtTotal);
      $vPaise = $billAmtTotal - $vRupee;
      $roundoffAmt = 0;

      if ($vPaise > 0.49) {
        $roundoffAmt = 1 - $vPaise;
      } else {
        $roundoffAmt = $vPaise * -1;
      }
      $billAmt = $add + $this->input->post('HelMajuri') + $this->input->post('OtherChrgs') + $roundoffAmt;

      $data4 = array(
        'ItemAmt' => $salesDetailsTotal[0]->ItemAmount,
        'DiscountAmt' => $salesDetailsTotal[0]->DiscAmt,
        'LagaAmt' => $salesDetailsTotal[0]->Laga,
        'EntryTax' => $salesDetailsTotal[0]->EntryTax,
        'ContAmt' => $salesDetailsTotal[0]->PackingCharge,
        'APMCChrg' => $salesDetailsTotal[0]->APMCChrg,
        'TaxableAmt' => $salesDetailsTotal[0]->TaxableAmt,
        'TaxAmt' => $salesDetailsTotal[0]->TaxAmt,
        'CGSTAmt' => $salesDetailsTotal[0]->CGSTAmt,
        'SGSTAmt' => $salesDetailsTotal[0]->SGSTAmt,
        'IGSTAmt' => $salesDetailsTotal[0]->IGSTAmt,
        'RoffAmt' => $roundoffAmt,
        'TCSAmount' => $salesDetailsTotal[0]->TCSAmount,
        'BillAmt' => $billAmt
      );

      $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'BillNo' => $billno);
      $this->db->where($multi_where);
      $this->db->update('SaleMast', $data4);

      $data3 = array(
        'ClosingQty' => $cqty
      );

      $this->db->where('IDNumber', $idnumber);
      $this->db->update('PurDetails', $data3);

      echo "<script> ";
      echo "alert('Record Updated !!');";
      echo "window.location.href = '" . base_url() . "index.php/SalesController/showTry2/'+ $bno;";
      echo "</script>";
    }
  }

  public function EditTry2($billno, $bid)
  {
    $this->load->model('SalesModel');
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $this->form_validation->set_rules('BillNo', 'BillNo', 'trim');
    $data['bid'] = $bid;

    if ($this->form_validation->run() == FALSE) {
      $data['GodownList'] = $this->SalesModel->Get_Godown_List();
      $data['DebtorList'] = $this->SalesModel->Get_Debtor_List();
      $data['BrokerList'] = $this->SalesModel->Get_Broker_List();
      $data['ItemList'] = $this->SalesModel->Get_Item_List();
      $data['CustomerList'] = $this->SalesModel->Get_Customer_List();
      $data['Loaded_List'] = $this->SalesModel->get_load_data($billno);
      if ($bid != 0) {
        $data['SalesDList'] = $this->SalesModel->loadSalesDetail($bid);
        $gid = $data['SalesDList'][0]->GodownID;
        $PID = $data['SalesDList'][0]->PID;
        $PrvQty = $data['SalesDList'][0]->Qty;
        $data['SalesDetails'] = $this->SalesModel->getSalesDetail($bid, $gid);
        $data['SalesDList0'] = 1;
      } else {
        $data['SalesDList0'] = 0;
      }
      $Debtor = $data['Loaded_List'][0]->DebtorID;
      $data['DebtorID'] = $this->SalesModel->getDebtorName($Debtor);

      $data['TableData'] = $this->SalesModel->getTableDataIdWise($billno);
      $data['Total'] = $this->SalesModel->getTotal($billno);

      $this->load->view('SalesEditTry', $data);
    } else {

      $data['SalesDList'] = $this->SalesModel->loadSalesDetail($bid);
      $gid = $data['SalesDList'][0]->GodownID;
      $PID = $data['SalesDList'][0]->PID;
      $PBalQty = $data['SalesDList'][0]->BalQty;
      $PrvQty = $data['SalesDList'][0]->Qty;

      $data1 = array(
        'CoID' => $CoID,
        'WorkYear' => $WorkYear,
        'BillDate' => $this->input->post('BillDate'),
        'GodownID' => $this->input->post('GodownID'),
        'LRNo' => $this->input->post('LRNo'),
        'MudiBazar' => $this->input->post('MudiBazar'),
        'EWayBillNo' => $this->input->post('EWayBillNo'),
        'DeliDate' => $this->input->post('DeliDate'),
        'DebtorID' => $this->input->post('DebtorID'),
        'PartyCode' => $this->input->post('PartyCode'),
        'CPName' => $this->input->post('CPName'),
        'Area' => $this->input->post('Area'),
        'SaleType' => $this->input->post('SaleType'),
        'BrokerID' => $this->input->post('BrokerID'),
        'BrokerTitle' => $this->input->post('BrokerTitle'),
        'HelMajuri' => $this->input->post('HelMajuri'),
        'OtherChrgs' => $this->input->post('OtherChrgs')
      );

      // $this->db->where('BillNo', $billno);
      $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'BillNo' => $billno);
      $this->db->where($multi_where);
      $this->db->update('SaleMast', $data1);

      if ($this->input->post('LotNo') != "") {

        $idnumber = $this->input->post('IDNumber');
        $qty = $this->input->post('Qty');
        // $balqty = $this->input->post('BalQty');
        // $cqty = $balqty - $qty;

        // $cqty = $balqty + $PrvQty - $qty ;  // 090521 v2
        $cqty = $PBalQty + $PrvQty - $qty;  // 090521 v2

        $data3 = array(
          'ClosingQty' => $cqty
        );

        // $this->db->where('IDNumber', $idnumber);
        $this->db->where('ID', $PID);
        $this->db->update('PurDetails', $data3);


        $currentQty1 = $this->SalesModel->getCurrentQty($bid);
        $currentQty = $currentQty1[0]->Qty;

        $billno = $this->input->post('BillNo');
        $godownID = $this->input->post('GodownID');
        $partyCode = $this->input->post('PartyCode');
        $taxable = $this->input->post('Taxable');
        $tax = $this->input->post('TaxRate');

        $cgstAmt = 0;
        $sgstAmt = 0;
        $igstAmt = 0;
        $taxAmt = 0;
        $apmcchg = 0;

        if ($this->input->post('APMCIn') == "Y") {
          $apmcchg = round($this->input->post('GrAmt') * (($this->input->post('APMCChg') + $this->input->post('APMCSChg')) / 100), 2);
        }

        $GstData = $this->SalesModel->GetGST($partyCode);
        $StateCode = $GstData[0]->StateCode;
        $PartyGSTNo = $GstData[0]->PartyGSTNo;
        $PartyType = $GstData[0]->PartyType;

        $billno = $this->input->post('BillNo');
        $godownID = $this->input->post('GodownID');
        $partyCode = $this->input->post('PartyCode');
        $taxable = round($this->input->post('Taxable') + $apmcchg, 2);
        $tax = $this->input->post('TaxRate');

        if (($StateCode == '27') || ($PartyType == 'L' || $PartyType == 'M')) {
          $gst = round(($taxable * $tax) / 100, 2);
          $taxAmt = $gst;
          $cgstAmt = round(($gst / 2), 2);
          $sgstAmt = round(($gst / 2), 2);
        } else {
          $igstAmt = round(($taxable * $tax) / 100, 2);
          $taxAmt = $igstAmt;
        }


        $data1 = array(
          'CoID' => $CoID,
          'WorkYear' => $WorkYear,
          'BillDate' => $this->input->post('BillDate'),
          'GodownID' => $godownID,
          'LotNo' => $this->input->post('LotNo'),
          'ItemCode' => $this->input->post('ItemCode'),
          'ItemMark' => $this->input->post('ItemMark'),
          'Qty' => $qty,
          'GrossWt' => $this->input->post('GrossWt'),
          'NetWt' => $this->input->post('NetWt'),
          'Rate' => $this->input->post('Rate'),
          'APMCIn' => $this->input->post('APMCIn'),
          'ETaxIn' => $this->input->post('ETaxIn'),
          'GrAmt' => $this->input->post('GrAmt'),
          'LagaAmt' => $this->input->post('Laga'),
          'APMCChrg' => $this->input->post('APMCChg'),
          'APMCSChrg' => $this->input->post('APMCSChg'),
          'OAPMCChrg' => $apmcchg,
          'SGSTAmt' => $sgstAmt,
          'IGSTAmt' => $igstAmt,
          'CGSTAmt' => $cgstAmt,
          'ContChrg' => $this->input->post('ContChrg'),
          'NetAmt' => $this->input->post('NetAmt'),
          'DiscDetRate' => $this->input->post('DiscDetRate'),
          'DiscAmt' => $this->input->post('DiscAmt'),
          'TaxableAmt' => $taxable,
          'TaxCode' => $this->input->post('TaxCode'),
          'TaxAmt' => $taxAmt,
          'TCSPer' => $this->input->post('TCSPer'),
          'TCSAmount' => $this->input->post('TCSAmt'),
          'WgtDiff' => $this->input->post('WgtDiff'),
          'WgtDiff1' => $this->input->post('WgtDiff1'),
          'WgtDiff2' => $this->input->post('WgtDiff2'),
          'WgtDiff3' => $this->input->post('WgtDiff3'),
          'WgtDiff4' => $this->input->post('WgtDiff4'),
          'RateDiff' => $this->input->post('RateDiff'),
          'RateDiff1' => $this->input->post('RateDiff1'),
          'RateDiff2' => $this->input->post('RateDiff2'),
          'RateDiff3' => $this->input->post('RateDiff3'),
          'RateDiff4' => $this->input->post('RateDiff4'),
          'Code1' => $this->input->post('Code1'),
          'Code2' => $this->input->post('Code2'),
          'Code3' => $this->input->post('Code3'),
          'Code4' => $this->input->post('Code4'),
          'Code5' => $this->input->post('Code5'),
          'DiffAmt1' => $this->input->post('DiffAmt1'),
          'DiffAmt2' => $this->input->post('DiffAmt2'),
          'DiffAmt3' => $this->input->post('DiffAmt3'),
          'DiffAmt4' => $this->input->post('DiffAmt4'),
          'DiffAmt5' => $this->input->post('DiffAmt5')

        );

        // $this->db->where('ID', $bid);
        $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'ID' => $bid);
        $this->db->where($multi_where);
        $this->db->update('SaleDetails', $data1);

        $salesDetailsTotal = $this->SalesModel->getTotal($billno);

        $add = $salesDetailsTotal[0]->TCSAmount + $salesDetailsTotal[0]->TaxableAmt + $salesDetailsTotal[0]->IGSTAmt + $salesDetailsTotal[0]->CGSTAmt + $salesDetailsTotal[0]->SGSTAmt;
        $billAmtTotal = $add + $this->input->post('HelMajuri') + $this->input->post('OtherChrgs');

        $vRupee = intval($billAmtTotal);
        $vPaise = $billAmtTotal - $vRupee;
        $roundoffAmt = 0;

        if ($vPaise > 0.49) {
          $roundoffAmt = 1 - $vPaise;
        } else {
          $roundoffAmt = $vPaise * -1;
        }
        $billAmt = $add + $this->input->post('HelMajuri') + $this->input->post('OtherChrgs') + $roundoffAmt;

        $data4 = array(
          'ItemAmt' => $salesDetailsTotal[0]->ItemAmount,
          'DiscountAmt' => $salesDetailsTotal[0]->DiscAmt,
          'LagaAmt' => $salesDetailsTotal[0]->Laga,
          'EntryTax' => $salesDetailsTotal[0]->EntryTax,
          'ContAmt' => $salesDetailsTotal[0]->PackingCharge,
          'APMCChrg' => $salesDetailsTotal[0]->APMCChrg,
          'TaxableAmt' => $salesDetailsTotal[0]->TaxableAmt,
          'TaxAmt' => $salesDetailsTotal[0]->TaxAmt,
          'CGSTAmt' => $salesDetailsTotal[0]->CGSTAmt,
          'SGSTAmt' => $salesDetailsTotal[0]->SGSTAmt,
          'IGSTAmt' => $salesDetailsTotal[0]->IGSTAmt,
          'RoffAmt' => $roundoffAmt,
          'TCSAmount' => $salesDetailsTotal[0]->TCSAmount,
          'BillAmt' => $billAmt
        );

        // $this->db->where('BillNo', $billno);
        $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'BillNo' => $billno);
        $this->db->where($multi_where);
        $this->db->update('SaleMast', $data4);
      }

      echo "<script> ";
      echo "alert('Sales Details Updated Finally !!');";
      echo "window.location.href = '" . base_url() . "index.php/SalesController/EditTry2/'+ $billno+'/0'";
      echo "</script>";
    }
  }

  function updateHeader($billno)
  {
    $this->load->model('SalesModel');
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $headerData = array(
      'CoID' => $CoID,
      'WorkYear' => $WorkYear,
      'BillDate' => $this->input->post('BillDate'),
      'GodownID' => $this->input->post('GodownID'),
      'LRNo' => $this->input->post('LRNo'),
      'MudiBazar' => $this->input->post('MudiBazar'),
      'EWayBillNo' => $this->input->post('EWayBillNo'),
      'DeliDate' => $this->input->post('DeliDate'),
      'DebtorID' => $this->input->post('DebtorID'),
      'PartyCode' => $this->input->post('PartyCode'),
      'CPName' => $this->input->post('CPName'),
      'Area' => $this->input->post('Area'),
      'SaleType' => $this->input->post('SaleType'),
      'BrokerID' => $this->input->post('BrokerID'),
      'BrokerTitle' => $this->input->post('BrokerTitle'),
      'HelMajuri' => $this->input->post('HelMajuri'),
      'OtherChrgs' => $this->input->post('OtherChrgs')
    );

    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'BillNo' => $billno);
    $this->db->where($multi_where);
    $this->db->update('SaleMast', $headerData);

    $salesDetailsTotal = $this->SalesModel->getTotal($billno);

    $add = $salesDetailsTotal[0]->TaxableAmt + $salesDetailsTotal[0]->IGSTAmt + $salesDetailsTotal[0]->CGSTAmt + $salesDetailsTotal[0]->SGSTAmt;
    $billAmtTotal = $add + $this->input->post('HelMajuri') + $this->input->post('OtherChrgs');

    $vRupee = intval($billAmtTotal);
    $vPaise = $billAmtTotal - $vRupee;
    $roundoffAmt = 0;

    if ($vPaise > 0.49) {
      $roundoffAmt = 1 - $vPaise;
    } else {
      $roundoffAmt = $vPaise * -1;
    }
    $billAmt = $add + $this->input->post('HelMajuri') + $this->input->post('OtherChrgs') + $roundoffAmt;

    $newHeaderData = array(
      'ItemAmt' => $salesDetailsTotal[0]->ItemAmount,
      'DiscountAmt' => $salesDetailsTotal[0]->DiscAmt,
      'LagaAmt' => $salesDetailsTotal[0]->Laga,
      'EntryTax' => $salesDetailsTotal[0]->EntryTax,
      'ContAmt' => $salesDetailsTotal[0]->PackingCharge,
      'APMCChrg' => $salesDetailsTotal[0]->APMCChrg,
      'TaxableAmt' => $salesDetailsTotal[0]->TaxableAmt,
      'TaxAmt' => $salesDetailsTotal[0]->TaxAmt,
      'CGSTAmt' => $salesDetailsTotal[0]->CGSTAmt,
      'SGSTAmt' => $salesDetailsTotal[0]->SGSTAmt,
      'IGSTAmt' => $salesDetailsTotal[0]->IGSTAmt,
      'RoffAmt' => $roundoffAmt,
      'BillAmt' => $billAmt
    );

    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'BillNo' => $billno);
    $this->db->where($multi_where);
    $this->db->update('SaleMast', $newHeaderData);
  }


  public function show1($bill)
  {
    $this->load->model('SalesModel');
    $data['Loaded_List'] = $this->SalesModel->get_load_data($bill);
    $this->load->view('SalesInsert1', $data);
  }

  //shows page after detail page data is inserted
  public function show2($bill)
  {
    $this->load->model('SalesModel');
    $data['Loaded_List'] = $this->SalesModel->get_load_data1($bill);
    $data['TableData'] = $this->SalesModel->getTableDataIdWise($bill);
    $data['Total'] = $this->SalesModel->getTotal($bill);
    $this->load->view('SalesInsert2', $data);
  }

  public function godown_name_dropdown()
  {
    $this->load->model('SalesModel');
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $value = $this->SalesModel->godown_name_ddmodel($CoID, $WorkYear);
    echo json_encode($value);
  }

  public function debtor_name_dropdown()
  {
    $this->load->model('SalesModel');
    $value = $this->SalesModel->debtor_name_ddmodel();
    echo json_encode($value);
  }

  public function name_dropdown()
  {
    $this->load->model('SalesModel');
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $value = $this->SalesModel->pname_ddmodel($CoID, $WorkYear);
    echo json_encode($value);
  }

  public function InsertSales()
  {
    $this->load->model('SalesModel');
    $WorkYear = $this->session->userdata('WorkYear');
    $this->form_validation->set_rules('BillNo', 'BillNo', 'trim');

    if ($this->form_validation->run() == FALSE) {
      //fail validation 
      $data['GodownList'] = $this->SalesModel->Get_Godown_List();
      $data['DebtorList'] = $this->SalesModel->Get_Debtor_List();
      $data['BrokerList'] = $this->SalesModel->Get_Broker_List();
      $data['CustomerList'] = $this->SalesModel->Get_Customer_List();
      $this->load->view('SalesInsert', $data);
    } else {
      $billno = $this->input->post('BillNo');
      $godownID = $this->input->post('GodownID');
      $data = array(

        'BillNo' => $billno,
        'BillDate' => $this->input->post('BillDate'),
        'GodownID' => $godownID,
        'LRNo' => $this->input->post('LRNo'),
        'MudiBazar' => $this->input->post('MudiBazar'),
        'EWayBillNo' => $this->input->post('EWayBillNo'),
        'DeliDate' => $this->input->post('DeliDate'),
        'DebtorID' => $this->input->post('DebtorID'),
        'CPName' => $this->input->post('CPName'),
        'PartyTitle' => $this->input->post('PartyTitle'),
        'Area' => $this->input->post('Area'),
        'SaleType' => $this->input->post('SaleType'),
        'BrokerID' => $this->input->post('BrokerID'),
        'BrokerTitle' => $this->input->post('BrokerTitle'),
        'HelMajuri' => $this->input->post('HelMajuri'),
        'OtherChrgs' => $this->input->post('OtherChrgs')
      );

      $this->db->insert('SaleMast', $data);

      echo "<script> ";
      echo "alert('New Sales Added !!');";
      echo "window.location.href = '" . base_url() . "index.php/SalesController/InsertDetail/$billno/$godownID'";
      echo "</script>";
    }
  }

  function InsertDetail($bill, $gid)
  {
    $this->load->model('SalesModel');
    $this->form_validation->set_rules('LotNo', 'LotNo', 'trim');

    if ($this->form_validation->run() == FALSE) {
      //fail validation 
      $this->load->model('SalesModel');
      $data['Loaded_List'] = $this->SalesModel->get_load_data($bill);
      $data['GodownWise'] = $this->SalesModel->godownWise($gid);
      $bill_id = $this->SalesModel->getId($bill);
      $bid = $bill_id[0]->CoID;
      $data['billid'] = $bid;
      $data['gid'] = $gid;

      $this->load->view('SalesDetailInsert', $data);
    } else {
      $billAmt = $this->input->post('TaxableAmt') + $this->input->post('CGSTAmt') + $this->input->post('SGSTAmt') + $this->input->post('HelMajuri') + $this->input->post('OtherChrgs');

      $data = array(

        'BillNo' => $bill,
        'LotNo' => $this->input->post('LotNo'),
        'ItemCode' => $this->input->post('ItemCode'),
        'ItemMark' => $this->input->post('ItemMark'),
        'Qty' => $this->input->post('Qty'),
        'GrossWt' => $this->input->post('GrossWt'),
        'NetWt' => $this->input->post('NetWt'),
        'Rate' => $this->input->post('Rate'),
        'APMCIn' => $this->input->post('APMCIn'),
        'ETaxIn' => $this->input->post('ETaxIn'),
        'GrAmt' => $this->input->post('GrAmt'),
        'ContChrg' => $this->input->post('ContChrg'),
        'NetAmt' => $this->input->post('NetAmt'),
        'LagaAmt' => $this->input->post('LagaAmt'),
        'DiscDetRate' => $this->input->post('DiscDetRate'),
        'DiscAmt' => $this->input->post('DiscAmt'),
        'TaxableAmt' => $this->input->post('TaxableAmt'),
        'APMCChrg' => $this->input->post('APMCChrg'),
        'EntryTax' => $this->input->post('EntryTax'),
        'TaxCode' => $this->input->post('TaxCode'),
        'IGSTAmt' => $this->input->post('IGSTAmt'),
        'CGSTAmt' => $this->input->post('CGSTAmt'),
        'SGSTAmt' => $this->input->post('SGSTAmt')
      );

      $this->db->insert('SaleDetails', $data);

      $data1 = array(
        'BillAmt' => $billAmt
      );

      $this->db->where('CoID', $bill);
      $this->db->update('SaleMast', $data1);

      echo "<script> ";
      echo "alert('New Sales Details Added !!');";
      echo "window.location.href = '" . base_url() . "index.php/SalesController/show2/'+ $bill;";
      echo "</script>";
    }
  }

  function Edit($bill)
  {
    $this->load->model('SalesModel');
    $WorkYear = $this->session->userdata('WorkYear');
    $this->form_validation->set_rules('BillNo', 'BillNo', 'trim');

    if ($this->form_validation->run() == FALSE) {
      //fail validation 
      $data['Loaded_List'] = $this->SalesModel->get_load_data($bill);
      $data['TableData'] = $this->SalesModel->getTableDataIdWise($bill);
      $data['Total'] = $this->SalesModel->getTotal($bill);
      $data['GodownList'] = $this->SalesModel->Get_Godown_List();
      $data['DebtorList'] = $this->SalesModel->Get_Debtor_List();
      $data['BrokerList'] = $this->SalesModel->Get_Broker_List();
      $data['CustomerList'] = $this->SalesModel->Get_Customer_List();
      $this->load->view('SalesInsertUpdate', $data);
    } else {
      $data = array(

        'BillDate' => $this->input->post('BillDate'),
        'GodownID' => $this->input->post('GodownID'),
        'LRNo' => $this->input->post('LRNo'),
        'MudiBazar' => $this->input->post('MudiBazar'),
        'EWayBillNo' => $this->input->post('EWayBillNo'),
        'DeliDate' => $this->input->post('DeliDate'),
        'DebtorID' => $this->input->post('DebtorID'),
        'CPName' => $this->input->post('CPName'),
        'PartyTitle' => $this->input->post('PartyTitle'),
        'Area' => $this->input->post('Area'),
        'SaleType' => $this->input->post('SaleType'),
        'BrokerID' => $this->input->post('BrokerID'),
        'BrokerTitle' => $this->input->post('BrokerTitle'),
        'HelMajuri' => $this->input->post('HelMajuri'),
        'OtherChrgs' => $this->input->post('OtherChrgs')
      );
      $this->db->where('BillNo', $bill);
      $this->db->update('SaleMast', $data);

      echo "<script> ";
      echo "alert('New Sales Added !!');";
      echo "window.location.href = '" . base_url() . "index.php/SalesController/Edit1/'+ $bill;";
      echo "</script>";
    }
  }

  function Edit1($bill)
  {

    $this->load->model('SalesModel');
    $WorkYear = $this->session->userdata('WorkYear');
    $this->form_validation->set_rules('BillNo', 'BillNo', 'trim');

    if ($this->form_validation->run() == FALSE) {
      //fail validation 
      $data['Loaded_List'] = $this->SalesModel->get_load_data($bill);
      $data['TableData'] = $this->SalesModel->getTableDataIdWise($bill);
      $data['Total'] = $this->SalesModel->getTotal($bill);
      $data['GodownList'] = $this->SalesModel->Get_Godown_List();
      $data['DebtorList'] = $this->SalesModel->Get_Debtor_List();
      $data['BrokerList'] = $this->SalesModel->Get_Broker_List();
      $data['CustomerList'] = $this->SalesModel->Get_Customer_List();
      $this->load->view('SalesInsertUpdate1', $data);
      print_r($data['Loaded_List']);
    } else {
      $billno = $bill;
      $godownID = $this->input->post('GodownID');
      $data = array(
        'BillDate' => $this->input->post('BillDate'),
        'GodownID' => $godownID,
        'LRNo' => $this->input->post('LRNo'),
        'MudiBazar' => $this->input->post('MudiBazar'),
        'EWayBillNo' => $this->input->post('EWayBillNo'),
        'DeliDate' => $this->input->post('DeliDate'),
        'DebtorID' => $this->input->post('DebtorID'),
        'CPName' => $this->input->post('CPName'),
        'PartyTitle' => $this->input->post('PartyTitle'),
        'Area' => $this->input->post('Area'),
        'SaleType' => $this->input->post('SaleType'),
        'BrokerID' => $this->input->post('BrokerID'),
        'BrokerTitle' => $this->input->post('BrokerTitle'),
        'HelMajuri' => $this->input->post('HelMajuri'),
        'OtherChrgs' => $this->input->post('OtherChrgs')
      );

      $this->db->where('BillNo', $bill);
      $this->db->update('SaleMast', $data);

      echo "<script> ";
      echo "alert('New Sales Added !!');";
      echo "window.location.href = '" . base_url() . "index.php/SalesController/InsertDetail/$billno/$godownID'";
      echo "</script>";
    }
  }

  function Edit2($bill)
  {
    $this->load->model('SalesModel');
    $WorkYear = $this->session->userdata('WorkYear');
    $b = $this->SalesModel->getBill($bill);
    $billno = $b[0]->BillNo;
    // print_r($billno);
    $this->form_validation->set_rules('BillNo', 'BillNo', 'trim');

    if ($this->form_validation->run() == FALSE) {
      //fail validation 
      $data['Loaded_List'] = $this->SalesModel->get_load_data($billno);
      $data['TableData'] = $this->SalesModel->getTableDataIdWise($billno);
      $data['Total'] = $this->SalesModel->getTotal($billno);
      $data['GodownList'] = $this->SalesModel->Get_Godown_List();
      $data['DebtorList'] = $this->SalesModel->Get_Debtor_List();
      $data['BrokerList'] = $this->SalesModel->Get_Broker_List();
      $data['CustomerList'] = $this->SalesModel->Get_Customer_List();
      $this->load->view('SalesInsertUpdate1', $data);
    } else {
      $data = array(
        'BillDate' => $this->input->post('BillDate'),
        'GodownID' => $this->input->post('GodownID'),
        'LRNo' => $this->input->post('LRNo'),
        'MudiBazar' => $this->input->post('MudiBazar'),
        'EWayBillNo' => $this->input->post('EWayBillNo'),
        'DeliDate' => $this->input->post('DeliDate'),
        'DebtorID' => $this->input->post('DebtorID'),
        'CPName' => $this->input->post('CPName'),
        'PartyTitle' => $this->input->post('PartyTitle'),
        'Area' => $this->input->post('Area'),
        'SaleType' => $this->input->post('SaleType'),
        'BrokerID' => $this->input->post('BrokerID'),
        'BrokerTitle' => $this->input->post('BrokerTitle'),
        'HelMajuri' => $this->input->post('HelMajuri'),
        'OtherChrgs' => $this->input->post('OtherChrgs')
      );
      $this->db->where('BillNo', $billno);
      $this->db->update('SaleMast', $data);

      echo "<script> ";
      echo "alert('New Sales Added !!');";
      echo "window.location.href = '" . base_url() . "index.php/SalesController/Edit1/'+ $billno;";
      echo "</script>";
    }
  }

  function EditDetails($bill, $gid)
  {
    $this->load->model('SalesModel');
    $this->form_validation->set_rules('LotNo', 'LotNo', 'trim');

    if ($this->form_validation->run() == FALSE) {
      //fail validation 
      $this->load->model('SalesModel');
      $data['Loaded_List'] = $this->SalesModel->get_load_data($bill);

      $data['GodownWise'] = $this->SalesModel->godownWise($gid);
      $bill_id = $this->SalesModel->getId($bill);
      $bid = $bill_id[0]->CoID;
      $data['billid'] = $bid;
      $data['gid'] = $gid;

      $data['SalesList'] = $this->SalesModel->loadSalesDetail($bid);

      $this->load->view('SalesDetailUpdate', $data);
    } else {

      $billAmt = $this->input->post('TaxableAmt') + $this->input->post('CGSTAmt') + $this->input->post('SGSTAmt') + $this->input->post('HelMajuri') + $this->input->post('OtherChrgs');

      $data = array(
        'LotNo' => $this->input->post('LotNo'),
        'ItemCode' => $this->input->post('ItemCode'),
        'ItemMark' => $this->input->post('ItemMark'),
        'Qty' => $this->input->post('Qty'),
        'GrossWt' => $this->input->post('GrossWt'),
        'NetWt' => $this->input->post('NetWt'),
        'Rate' => $this->input->post('Rate'),
        'APMCIn' => $this->input->post('APMCIn'),
        'ETaxIn' => $this->input->post('ETaxIn'),
        'GrAmt' => $this->input->post('GrAmt'),
        'ContChrg' => $this->input->post('ContChrg'),
        'NetAmt' => $this->input->post('NetAmt'),
        'LagaAmt' => $this->input->post('LagaAmt'),
        'DiscDetRate' => $this->input->post('DiscDetRate'),
        'DiscAmt' => $this->input->post('DiscAmt'),
        'TaxableAmt' => $this->input->post('TaxableAmt'),
        'APMCChrg' => $this->input->post('APMCChrg'),
        'EntryTax' => $this->input->post('EntryTax'),
        'TaxCode' => $this->input->post('TaxCode'),
        'IGSTAmt' => $this->input->post('IGSTAmt'),
        'CGSTAmt' => $this->input->post('CGSTAmt'),
        'SGSTAmt' => $this->input->post('SGSTAmt')
      );

      $this->db->where('BillNo', $bill);
      $this->db->update('SaleDetails', $data);

      $data1 = array(
        'BillAmt' => $billAmt
      );

      $this->db->where('CoID', $bill);
      $this->db->update('SaleMast', $data1);

      echo "<script> ";
      echo "alert('New Sales Details Updated !!');";
      echo "window.location.href = '" . base_url() . "index.php/SalesController/Edit2/'+ $bill;";
      echo "</script>";
    }
  }

  // Updated - Bijal - 02-03-2021
  function DeleteTry($billid)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $this->load->model('SalesModel');

    $data['SalesDList'] = $this->SalesModel->loadSalesDetail($billid);
    $gid = $data['SalesDList'][0]->GodownID;
    $data['ClosingQty'] = $this->SalesModel->getSalesDetail($billid, $gid);
    $IDNumber = $data['ClosingQty'][0]->IDNumber;
    $ItemCode = $data['ClosingQty'][0]->ItemCode;
    $Qty = $data['ClosingQty'][0]->Qty;
    $ClosingQty = $data['ClosingQty'][0]->ClosingQty;

    $cqty =  $ClosingQty + $Qty;

    $id = $this->SalesModel->getBill($billid);
    $billno = $id[0]->BillNo;

    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'BillNo' => $billno, 'ID' => $billid);
    $this->db->where($multi_where);
    $this->db->delete('SaleDetails');


    $salesDetailsTotal = $this->SalesModel->getTotal($billno);

    $add = $salesDetailsTotal[0]->TCSAmount + $salesDetailsTotal[0]->TaxableAmt + $salesDetailsTotal[0]->IGSTAmt + $salesDetailsTotal[0]->CGSTAmt + $salesDetailsTotal[0]->SGSTAmt;
    $billAmtTotal = $add + $salesDetailsTotal[0]->HelMajuri + $salesDetailsTotal[0]->OtherChrgs;

    $vRupee = intval($billAmtTotal);
    $vPaise = $billAmtTotal - $vRupee;
    $roundoffAmt = 0;

    if ($vPaise > 0.49) {
      $roundoffAmt = 1 - $vPaise;
    } else {
      $roundoffAmt = $vPaise * -1;
    }
    $billAmt = $add + $salesDetailsTotal[0]->HelMajuri + $salesDetailsTotal[0]->OtherChrgs + $roundoffAmt;

    $data4 = array(
      'ItemAmt' => $salesDetailsTotal[0]->ItemAmount,
      'DiscountAmt' => $salesDetailsTotal[0]->DiscAmt,
      'LagaAmt' => $salesDetailsTotal[0]->Laga,
      'EntryTax' => $salesDetailsTotal[0]->EntryTax,
      'ContAmt' => $salesDetailsTotal[0]->PackingCharge,
      'APMCChrg' => $salesDetailsTotal[0]->APMCChrg,
      'TaxableAmt' => $salesDetailsTotal[0]->TaxableAmt,
      'TaxAmt' => $salesDetailsTotal[0]->TaxAmt,
      'CGSTAmt' => $salesDetailsTotal[0]->CGSTAmt,
      'SGSTAmt' => $salesDetailsTotal[0]->SGSTAmt,
      'IGSTAmt' => $salesDetailsTotal[0]->IGSTAmt,
      'RoffAmt' => $roundoffAmt,
      'TCSAmount' => $salesDetailsTotal[0]->TCSAmount,
      'BillAmt' => $billAmt
    );

    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'BillNo' => $billno);
    $this->db->where($multi_where);
    $this->db->update('SaleMast', $data4);



    $data3 = array(
      'ClosingQty' => $cqty
    );

    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $IDNumber, 'ItemCode' => $ItemCode);
    $this->db->where($multi_where);
    $this->db->update('PurDetails', $data3);


    echo "<script> ";
    echo "alert('Sales Record Deleted (Deleted Single Record) !!');";
    echo "window.location.href = '" . base_url() . "index.php/SalesController/showTry2/'+ $billno;";
    echo "</script>";
  }

  // Updated - Bijal - 01-03-2021
  function DeleteSales($billid)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'BillNo' => $billid);
    $this->db->where($multi_where);
    $this->db->delete('SaleDetails');

    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'BillNo' => $billid);
    $this->db->where($multi_where);
    $this->db->delete('SaleMast');

    echo "<script> ";
    echo "alert('Sales Record Deleted (Deleted Entire Record) !!');";
    echo "window.location.href = '" . base_url() . "index.php/SalesController/show';";
    echo "</script>";
  }

  // Updated - Bijal - 01-03-2021
  function DeleteFromGrid($billno)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $this->load->model('SalesModel');

    // add qty back to PurDetails
    $query = $this->db->query("
                                select *
                                from SaleDetails 
                                where SaleDetails.CoID = '$CoID'
                                and SaleDetails.WorkYear = '$WorkYear'
                                and SaleDetails.BillNo = '$billno'
                            ");

    $result = $query->result();
    // print_r($result);
    // echo "<br>";
    foreach ($result as $r) {
      // echo 'ID ' . $r->ID;
      // echo "<br>";
      // echo 'ItemCode ' . $r->ItemCode;
      // echo "<br>";
      // echo 'Qty ' . $r->Qty;
      // echo "<br>";
      // echo 'GodownID ' . $r->GodownID;
      // echo "<br>";

      $billid = $r->ID;
      $gid = $r->GodownID;

      $data['ClosingQty'] = $this->SalesModel->getSalesDetail($billid, $gid);
      $IDNumber = $data['ClosingQty'][0]->IDNumber;
      $ItemCode = $data['ClosingQty'][0]->ItemCode;
      $Qty = $data['ClosingQty'][0]->Qty;
      $ClosingQty = $data['ClosingQty'][0]->ClosingQty;

      $cqty =  $ClosingQty + $r->Qty;

      $data3 = array(
        'ClosingQty' => $cqty
      );

      $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $IDNumber, 'ItemCode' => $ItemCode);
      $this->db->where($multi_where);
      $this->db->update('PurDetails', $data3);

      $id = $this->SalesModel->getBill($billid);
      $billno = $id[0]->BillNo;

      $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'BillNo' => $billno, 'ID' => $billid);
      $this->db->where($multi_where);
      $this->db->delete('SaleDetails');
    }
    $this->load->model('SalesModel');

    // reduce Bill No in compdata table -- 16/04/21
    $this->load->model('SalesModel');
    $result = $this->SalesModel->getLastBillNo();
    $compDataBillNo = $result;

    // echo "CompdataBillNo " . $compDataBillNo ; 
    // echo "<br>";
    // echo "billno " . $billno ; 
    // die ; 

    if ($compDataBillNo == $billno) {
      // echo "calling reducebillno ";
      // echo "<br>";
      // echo "CompdataBillNo " . $compDataBillNo ; 
      // echo "<br>";
      // echo "billno " . $billno ; 

      $result = $this->SalesModel->reduceBillNo();
    }

    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'BillNo' => $billno);
    $this->db->where($multi_where);
    $this->db->delete('SaleMast');

    // $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'BillNo' => $billno);
    // $this->db->where($multi_where);
    // $this->db->delete('SaleDetails');

    echo "<script> ";
    echo "alert('Sales Deleted !!');";
    echo "window.location.href = '" . base_url() . "index.php/SalesController/show';";
    echo "</script>";
  }


  // RY 160421
  function getLogoInvoiceData($BillNo)
  {
    $this->load->model('SalesModel');
    $data['gst'] = $this->SalesModel->getGSTInvoice($BillNo);
    $data['company'] = $this->SalesModel->companyInvoiceTitle($BillNo);
    $data['sales'] = $this->SalesModel->salesInvoice($BillNo);
    $data['broker'] = $this->SalesModel->invoiceBroker($BillNo);
    $data['billingAddress'] = $this->SalesModel->billingAddressInvoice($BillNo);
    $data['debitMemo'] = $this->SalesModel->debitMemoInvoice($BillNo);
    $data['calculate'] = $this->SalesModel->calculateInvoice($BillNo);
    $data['goDown'] = $this->SalesModel->fetchGoDownDescription($BillNo);
    $data['tax'] = $this->SalesModel->tax($BillNo);
    $data['taxCodeGST'] = $this->SalesModel->taxCodeGST($BillNo);

    $Calculate = $data["calculate"];
    $TotalAmount = $Calculate[0]->BillAmt;
    // foreach ($data["calculate"]  as $res) {
    //   $TotalAmount += $res['BillAmt'];
    // }    //  $Total_Cheque_Amt = $AmtRef[0]->ChqAmt;   
    $rwords =  $this->convert_number($TotalAmount);

    $data["rwords"] = $rwords;

    $this->load->view('LogoInvoice_View', $data);
  }

  // HM 19022021
  //get data for invoice 01032021
  function getInvoiceData($BillNo)
  {
    $this->load->model('SalesModel');
    $data['gst'] = $this->SalesModel->getGSTInvoice($BillNo);
    $data['company'] = $this->SalesModel->companyInvoiceTitle($BillNo);
    $data['sales'] = $this->SalesModel->salesInvoice($BillNo);
    $data['broker'] = $this->SalesModel->invoiceBroker($BillNo);
    $data['billingAddress'] = $this->SalesModel->billingAddressInvoice($BillNo);
    $data['debitMemo'] = $this->SalesModel->debitMemoInvoice($BillNo);
    $data['calculate'] = $this->SalesModel->calculateInvoice($BillNo);
    $data['goDown'] = $this->SalesModel->fetchGoDownDescription($BillNo);
    $data['tax'] = $this->SalesModel->tax($BillNo);
    $data['taxCodeGST'] = $this->SalesModel->taxCodeGST($BillNo);
    $this->load->view('Invoice_View', $data);
  }


  public function convert_number($number)
  {
    // $number = 226545129.11;
    $no = intval($number);
    $point = round($number - $no, 2) * 100;
    //           echo $no, " ", $point ;
    //           exit ;

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




  // all report functions KAJAL
  // updated 13-02-21
  function SalesDatewise()
  {
    $this->load->model('SalesModel');
    $data['result'] = $this->SalesModel->get_SalesDatewise();
    // print_r ($data);
    // die ; 
    $this->load->view('menu_1.php');
    $this->load->view('SalesDatewise_View', $data);
  }

  // updated 13-02-21
  function salesDatewiseFilter()
  {
    if ($this->input->post('submit') != NULL) {
      $postData = $this->input->post();

      // Read POST data
      $fromYear = $postData['fromYear'];
      $toYear = $postData['toYear'];

      $this->load->model('SalesModel');
      $data['result'] = $this->SalesModel->get_SalesDatewiseFilter($fromYear, $toYear);
      $this->load->view('menu_1.php');
      $this->load->view('SalesDatewise_View', $data);
    }
  }

  // updated 13-02-21
  function BriefSalesDatewise()
  {
    $this->load->model('SalesModel');
    $data['result'] = $this->SalesModel->get_BriefSalesDatewise();
    // print_r ($data);
    // die ; 
    $this->load->view('menu_1.php');
    $this->load->view('BriefSalesDatewise_View', $data);
  }

  // updated 13-02-21
  function BriefsalesDatewiseFilter()
  {
    if ($this->input->post('submit') != NULL) {
      $postData = $this->input->post();

      // Read POST data
      $fromYear = $postData['fromYear'];
      $toYear = $postData['toYear'];

      $this->load->model('SalesModel');
      $data['result'] = $this->SalesModel->get_BriefSalesDatewiseFilter($fromYear, $toYear);
      $this->load->view('menu_1.php');
      $this->load->view('BriefSalesDatewise_View', $data);
    }
  }

  //updated 13-02-21
  function TaxableSalesDatewise()
  {
    $this->load->model('SalesModel');
    $data['result'] = $this->SalesModel->get_TaxableSalesDatewise();
    // print_r ($data);
    // die ; 
    $this->load->view('menu_1.php');
    $this->load->view('TaxableSalesDatewise_View', $data);
  }

  //updated 13-02-21
  function TaxablesalesDatewiseFilter()
  {
    if ($this->input->post('submit') != NULL) {
      $postData = $this->input->post();

      // Read POST data
      $fromYear = $postData['fromYear'];
      $toYear = $postData['toYear'];

      $this->load->model('SalesModel');
      $data['result'] = $this->SalesModel->get_TaxableSalesDatewiseFilter($fromYear, $toYear);
      $this->load->view('menu_1.php');
      $this->load->view('TaxableSalesDatewise_View', $data);
    }
  }
}
