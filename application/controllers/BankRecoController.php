<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class BankRecoController extends CI_Controller
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
    public function show()
    {

        date_default_timezone_set("Asia/Colombo");
        $this->load->model('BankRecoModel');

        $data['ACList'] = $this->BankRecoModel->Account();
        if ($this->input->post('submit') != NULL) {
            // $this->BankRecoModel->DropTempTable();
            // $this->BankRecoModel->CreateBankReco();
            $postData = $this->input->post();
            // Read POST data
            $Date = $postData['toYear'];
            $type = $postData['ClrType'];
            $BookCode = $postData['BCode'];
            $BookName = $postData['BName'];

            $data['OutPut'] = 1;
            $data['ClrType'] = $type;
            if ($type == 'all') {
                $data['result'] = $this->BankRecoModel->GetAllData($BookCode, $Date, $BookName);
                $data['Balance'] = $this->BankRecoModel->GetBalance($BookCode);
            } else if ($type == 'pending') {
                $data['result'] = $this->BankRecoModel->GetUnclearedData($BookCode, $Date, $BookName);
                $data['Balance'] = $this->BankRecoModel->GetBalance($BookCode);
            }
        } else {
            $Date = date('Y-m-d');
            $BookCode = "";
            $BookName = "";
            $data['OutPut'] = 0;
            $data['Balance'] = $this->BankRecoModel->GetBalance($BookCode, $BookName);
            $data['result'] = $this->BankRecoModel->GetAllData($BookCode, $Date, $BookName);
        }
        // echo json_encode($data['OutPut']);
        // die;
        $this->load->view('menu_1');
        $this->load->view('BankRecoView', $data);
    }
    public function AccData($ACCode)
    {
        if (empty($ACCode)) {
            echo json_encode([]);
            exit;
        }

        $this->load->model('BankRecoModel');
        $data = $this->BankRecoModel->GetBook($ACCode);
        echo json_encode($data);
        exit;
    }
    function UpdateType($ID, $type, $BookCode)
    {
        $this->load->model('BankRecoModel');
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        date_default_timezone_set("Asia/Colombo");
        $Date = $this->input->post("ClrDate");
        $ClrType = "C";

        if ($type == "RJ") {
            $data2 = array(
                'ClrType' => $ClrType,
                'ClrDate' => $Date
            );
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $ID);
            // echo json_encode($data2);
            // die;
            $this->db->where($multi_where);
            $this->db->update('ACCDetails', $data2);
        } else
             if ($type == "SR") {
            $data2 = array(
                'ClrType' => $ClrType,
                'ClrDate' => $Date
            );
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'ID' => $ID);
            $this->db->where($multi_where);
            $this->db->update('Collection', $data2);
        } else
            if ($type == "PYR") {
            $data2 = array(
                'ClrType' => $ClrType,
                'ClrDate' => $Date
            );
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $ID);
            $this->db->where($multi_where);
            $this->db->update('PurPayment', $data2);
        } else
            if ($type == "TDS") {
            $data2 = array(
                'ClrType' => $ClrType,
                'ClrDate' => $Date
            );
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $ID);
            $this->db->where($multi_where);
            $this->db->update('TDSonPayment', $data2);
        }
        $data['Balance'] = $this->BankRecoModel->GetBalance($BookCode);
        echo json_encode($data);
    }
    function UpdateType2($ID, $type, $BookCode)
    {
        $this->load->model('BankRecoModel');
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        date_default_timezone_set("Asia/Colombo");
        // $Date = date("Y-m-d");
        $Date = "";
        $ClrType = " ";

        if ($type == "RJ") {
            $data2 = array(
                'ClrType' => $ClrType,
                'ClrDate' => $Date
            );
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $ID);
            $this->db->where($multi_where);
            $this->db->update('ACCDetails', $data2);
        } else
             if ($type == "SR") {
            $data2 = array(
                'ClrType' => $ClrType,
                'ClrDate' => $Date
            );
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'ID' => $ID);
            $this->db->where($multi_where);
            $this->db->update('Collection', $data2);
        } else
            if ($type == "PYR") {
            $data2 = array(
                'ClrType' => $ClrType,
                'ClrDate' => $Date
            );
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $ID);
            $this->db->where($multi_where);
            $this->db->update('PurPayment', $data2);
        } else
            if ($type == "TDS") {
            $data2 = array(
                'ClrType' => $ClrType,
                'ClrDate' => $Date
            );
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $ID);
            $this->db->where($multi_where);
            $this->db->update('TDSonPayment', $data2);
        }

        $data['Balance'] = $this->BankRecoModel->GetBalance($BookCode);
        echo json_encode($data);
    }
}
