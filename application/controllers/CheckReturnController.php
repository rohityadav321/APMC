<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CheckReturnController extends CI_Controller
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
    $this->load->model('CheckReturnModel');
  }

  public function show()
  {
    if ($this->input->post('submit') != NULL) {
      $fromYear = $this->input->post('fromYear');
      $ToYear = $this->input->post('toYear');
    } else {
      $Fromdate = date('Y-m-01');
      $Todate = date('Y-m-30');
      $fromYear = $Fromdate;
      $ToYear = $Todate;
    }
    $data['CheqRet'] = $this->CheckReturnModel->getgrid($fromYear, $ToYear);
    // echo json_encode($data);
    $this->load->view('menu_1');
    $this->load->view('ChequeReturnGrid', $data);
  }

  public function add()
  {
    $this->load->view('header-form');
    $this->load->view('CheckReturnadd_view');
  }
  public function Edit($refers_no)
  {
    $data['CheqRet'] = $this->CheckReturnModel->getEditDetails($refers_no);
    // echo json_encode($data['CheqRet']);
    $this->load->view('header-form');
    $this->load->view('ChequeReturnEdit_view', $data);
  }

  public function InsertCheque()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $refId = $this->input->post('RefIDNumber');
    $data = array(
      'CoID' => $CoID,
      'WorkYear' => $WorkYear,
      'RefIDNumber' => $refId,
      'ReturnDate' => $this->input->post('ReturnDate'),
      'CRChrg' => $this->input->post('CRChrg'),
      'ReturnAmt' => $this->input->post('ReturnAmt'),
      'CheqNo' => $this->input->post('CheqNo'),
      'BankCode' => $this->input->post('BankCode')
    );
    $this->db->insert('ChequeReturn', $data);
    $data = array(
      'CheqReturn' => "Y",
      'ChqretuChrg' => $this->input->post('CRChrg')
    );
    $multiwhere = array(
      'CoID' => $CoID,
      'WorkYear' => $WorkYear,
      'IDNumber' => $refId
    );
    $this->db->where($multiwhere);
    $this->db->update('Collection', $data);

    $bills['Bills'] = $this->CheckReturnModel->getBills($refId);
    $BillNo = $bills['Bills'];

    for ($i = 0; $i < count($BillNo); $i++) {
      $data = array(
        'CheqReturn' => "Y",
        'CRChrg' => $this->input->post('CRChrg')
      );
      $multiwhere = array(
        'CoID' => $CoID,
        'WorkYear' => $WorkYear,
        'BillNo' => $BillNo[$i]->BillNo
      );
      $this->db->where($multiwhere);
      $this->db->update('SaleMast', $data);
    }
    echo json_encode($BillNo);
  }
  // 25-08-21
  public function UpdateCheque($IDNumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $result = $this->CheckReturnModel->GetRef($IDNumber);
    // echo $result[0]->RefIDNumber;
    // die;
    $data1 = array(
      'CheqReturn' => "N",
      'ChqretuChrg' => 00
    );
    $multiwhere = array(
      'CoID' => $CoID,
      'WorkYear' => $WorkYear,
      'IDNumber' => $result[0]->RefIDNumber
    );
    $this->db->where($multiwhere);
    $this->db->update('Collection', $data1);

    $data = array(
      'RefIDNumber' => $this->input->post('RefIDNumber'),
      'ReturnDate' => $this->input->post('ReturnDate'),
      'CRChrg' => $this->input->post('CRChrg'),
      'ReturnAmt' => $this->input->post('ReturnAmt'),
      'CheqNo' => $this->input->post('CheqNo'),
      'BankCode' => $this->input->post('BankCode')
    );
    $multiwhere = array(
      'CoID' => $CoID,
      'WorkYear' => $WorkYear,
      'IDNumber' => $IDNumber
    );
    $this->db->where($multiwhere);
    $this->db->update('ChequeReturn', $data);
    $data = array(
      'CheqReturn' => "Y",
      'ChqretuChrg' => $this->input->post('CRChrg')
    );
    $multiwhere = array(
      'CoID' => $CoID,
      'WorkYear' => $WorkYear,
      'IDNumber' => $this->input->post('RefIDNumber')
    );
    $this->db->where($multiwhere);
    $this->db->update('Collection', $data);

    $bills['Bills'] = $this->CheckReturnModel->getBills($result[0]->RefIDNumber);
    $BillNo = $bills['Bills'];

    for ($i = 0; $i < count($BillNo); $i++) {
      $data = array(
        'CheqReturn' => "Y",
        'CRChrg' => $this->input->post('CRChrg')
      );
      $multiwhere = array(
        'CoID' => $CoID,
        'WorkYear' => $WorkYear,
        'BillNo' => $BillNo[$i]->BillNo
      );
      $this->db->where($multiwhere);
      $this->db->update('SaleMast', $data);
    }
    echo json_encode($data);
  }

  public function getdetails()
  {
    $refers_no = $this->input->post('refer_no');
    $years = $this->session->userdata('WorkYear');
    $result = $this->CheckReturnModel->getDetails($refers_no, $years);
    // print_r($result);
    echo json_encode($result);
  }
  public function DeleteCheque($refers_no)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $multiwhere = array(
      'CoID' => $CoID,
      'WorkYear' => $WorkYear,
      'RefIDNumber' => $refers_no
    );
    $this->db->where($multiwhere);
    $this->db->Delete('ChequeReturn');
    // Update Data In Collection
    $data = array(
      'CheqReturn' => "N",
      'ChqretuChrg' => 00
    );
    $multiwhere = array(
      'CoID' => $CoID,
      'WorkYear' => $WorkYear,
      'IDNumber' => $refers_no
    );
    $this->db->where($multiwhere);
    $this->db->update('Collection', $data);
    $bills['Bills'] = $this->CheckReturnModel->getBills($refers_no);
    $BillNo = $bills['Bills'];

    for ($i = 0; $i < count($BillNo); $i++) {
      $data = array(
        'CheqReturn' => "N",
        'CRChrg' => 00
      );
      $multiwhere = array(
        'CoID' => $CoID,
        'WorkYear' => $WorkYear,
        'BillNo' => $BillNo[$i]->BillNo
      );
      $this->db->where($multiwhere);
      $this->db->update('SaleMast', $data);
    }
    echo "<script> ";
    echo "alert('Cheque Deleted !!');";
    echo "window.location.href = '" . base_url() . "index.php/CheckReturnController/show'";
    echo "</script>";
  }

  public function CheckCheque($refers_no)
  {
    $data = $this->CheckReturnModel->CountCheque($refers_no);
    // echo $data;
    echo json_encode($data);
  }
}
