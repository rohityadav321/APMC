<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class GodownTransController extends CI_Controller
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
        $this->load->model('GodownTransModel');
    }
    public function Show()
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
        $data['Godown'] = $this->GodownTransModel->getData($fromYear, $ToYear);
        // echo json_encode($data);
        $this->load->view('menu_1');
        $this->load->view('GodownTransGrid', $data);
    }
    public function GodownTransfer()
    {
        $this->load->view('godownTrans_view');
    }
    public function GodownData()
    {
        $data['GodownDetail'] = $this->GodownTransModel->getGodownData();
        echo json_encode($data);
    }
    public function GetGodown()
    {
        $data['Godown'] = $this->GodownTransModel->GetGodown();
        echo json_encode($data);
    }
    public function TransferGodown()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $Bal = $this->input->post('BalQty');
        $Qty = $this->input->post('Qty');
        $refIDNumber = $this->input->post('refIDNumber');
        $BalQty = $Bal - $Qty;
        // Add Data In Godown Transfer
        $data = array(
            'CoID' => $CoID,
            'WorkYear' => $WorkYear,
            'IDNumber' => "New",
            'PartyCode' => $this->input->post('PartyCode'),
            'ItemCode' => $this->input->post('ItemCode'),
            'Mark' => $this->input->post('Mark'),
            'LotNo' => $this->input->post('LotNo'),
            'TransferDate' => $this->input->post('TransferDate'),
            'Qty' => $Qty,
            'Weight' => $this->input->post('Weight'),
            'FromGodown' => $this->input->post('FromGodown'),
            'ToGodown' => $this->input->post('ToGodown'),
            'EntryType' => "G"
        );
        // print_r($data);
        // die;
        $this->db->insert('GodownTransfer', $data);
        // Get Last ID
        $LastID = $this->GodownTransModel->GetLastId();
        $LastIDNumber = IntVal($LastID) + 1;
        // Update Godown 
        $data1 = array(
            'IDNumber' => $LastIDNumber
        );
        $multiWhere = array(
            'CoID' => $CoID,
            'WorkYear' => $WorkYear,
            'IDNumber' => "New"
        );
        $this->db->where($multiWhere);
        $this->db->update('GodownTransfer', $data1);
        // Update CompData
        $data1 = array(
            'LastGdnTrans' => $LastIDNumber
        );
        $multiWhere = array(
            'CoID' => $CoID,
            'WorkYear' => $WorkYear,

        );
        $this->db->where($multiWhere);
        $this->db->update('CompData', $data1);
        // insert in PurDetails
        $data = array(
            'CoID' => $CoID,
            'WorkYear' => $WorkYear,
            'IDNumber' => $LastIDNumber,
            'PartyCode' => $this->input->post('PartyCode'),
            'ItemCode' => $this->input->post('ItemCode'),
            'Mark' => $this->input->post('Mark'),
            'LotNo' => $this->input->post('LotNo'),
            'GoodsRcptDate' => $this->input->post('TransferDate'),
            'Qty' => $Qty,
            'Weight' => $this->input->post('Weight'),
            'GodownID' => $this->input->post('ToGodown'),
            'ItemName' => $this->input->post('ItemName'),
            'Units' => $this->input->post('Units'),
            'Packing' => $this->input->post('Packing'),
            'EntryType' => "G"
        );
        $this->db->insert('PurDetails', $data);
        // Update PurDetails
        $data = array(
            'Qty' => $BalQty
        );
        $multiWhere = array(
            'CoID' => $CoID,
            'WorkYear' => $WorkYear,
            'IDNumber' => $refIDNumber
        );
        $this->db->where($multiWhere);
        $this->db->update('PurDetails', $data);
        echo json_encode($data);
    }
}
