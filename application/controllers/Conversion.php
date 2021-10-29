<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Conversion extends CI_Controller
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
        $this->load->model('conversionModel');
    }
    public function show()
    {

        $this->load->model('NewGaruPurModel');
        $data['ItemList'] = $this->NewGaruPurModel->Get_Item_List();
        $this->load->view('conversionview', $data);
    }

    public function LotData()
    {
        $GID = $this->input->post('GID');
        $data['GodownDetail'] = $this->conversionModel->getGodownData($GID);
        echo json_encode($data);
    }

    public function GodownData()
    {
        $this->load->model('NewGaruPurModel');
        $data['GodownDetail'] = $this->NewGaruPurModel->Get_Godown_List();
        echo json_encode($data);
    }
    public function PartyData()
    {
        $this->load->model('NewGaruPurModel');
        $data['Party'] = $this->NewGaruPurModel->Get_Supplier_List();
        echo json_encode($data);
    }
    public function fetchType($ID, $Type, $CoID, $WorkYear)
    {
        $data['tableData'] = $this->conversionModel->getTableData($ID, $Type, $CoID, $WorkYear);
        return $data['tableData'];
    }
    public function AddExisting()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $Type = $this->input->post('Type');
        if ($this->input->post('IDNumber') == 'New') {
            $data = array(
                'CoID'     => $CoID,
                'WorkYear'  => $WorkYear,
                'IDNumber' => $this->input->post('IDNumber'),
                'ConvDate'  => $this->input->post('ConvDate')
            );

            $this->db->insert('ConvMast', $data);

            $lastConv = $this->conversionModel->lastConv();
            $ConvId = array(
                'IDNumber' => $lastConv
            );

            $multiwhere = array(
                'CoID' => $CoID,
                'WorkYear' => $WorkYear,
                'IDNumber' => 'New'
            );
            $this->db->where($multiwhere);
            $this->db->update('ConvMast', $ConvId);

            $data = array(
                'CoID'     => $CoID,
                'WorkYear'  => $WorkYear,
                'RefIDNumber' => $lastConv,
                'ConvDate'  => $this->input->post('ConvDate'),
                'PartyCode' => $this->input->post('PartyCode'),
                'GodownID'  => $this->input->post('GodownID'),
                'LotNo'     => $this->input->post('LotNo'),
                'ItemCode'  => $this->input->post('ItemCode'),
                'Mark'      => $this->input->post('Mark'),
                'Qty'      => $this->input->post('Qty'),
                'Rate'      => $this->input->post('Rate'),
                'Weight'     => $this->input->post('Weight'),
                'APMCInd'   => $this->input->post('APMCInd'),
                'ETaxInd'   => $this->input->post('ETaxInd'),
                'ConvInd'   => $Type,
                'Commission' => $this->input->post('Commission'),
                'TapaleeAC' => $this->input->post('TapaleeAC'),
                'GdnRate'   => $this->input->post('GdnRate'),
                // 'EntryType' => $this->input->post('EntryType'),
                'GRcptDate'  => $this->input->post('GoodsRcptDate')
            );

            $this->db->insert('ConvTran', $data);
            // echo json_encode($data);
            // die;
            $results["TableData"] = $this->fetchType($lastConv, $Type, $CoID, $WorkYear);
            $results["ID"] = $lastConv;

            echo json_encode($results);
        } else {
            $data = array(
                'CoID'     => $CoID,
                'WorkYear'  => $WorkYear,
                'RefIDNumber' => $this->input->post('IDNumber'),
                'ConvDate'  => $this->input->post('ConvDate'),
                'PartyCode' => $this->input->post('PartyCode'),
                'GodownID'  => $this->input->post('GodownID'),
                'LotNo'     => $this->input->post('LotNo'),
                'ItemCode'  => $this->input->post('ItemCode'),
                'Mark'      => $this->input->post('Mark'),
                'Qty'      => $this->input->post('Qty'),
                'Rate'      => $this->input->post('Rate'),
                'Weight'     => $this->input->post('Weight'),
                'APMCInd'   => $this->input->post('APMCInd'),
                'ETaxInd'   => $this->input->post('ETaxInd'),
                'ConvInd'   => $Type,
                'Commission' => $this->input->post('Commissio'),
                'TapaleeAC' => $this->input->post('TapaleeAC'),
                'GdnRate'   => $this->input->post('GdnRate'),
                // 'EntryType' => $this->input->post('EntryType'),
                'GRcptDate'  => $this->input->post('GoodsRcptDate')
            );
            $this->db->insert('ConvTran', $data);
            $results["TableData"] = $this->fetchType($this->input->post('IDNumber'), $Type, $CoID, $WorkYear);
            $results["ID"] = $this->input->post('IDNumber');
            echo json_encode($results);
        }
    }
    // public function AddNew()
    // {
    //     $CoID = $this->session->userdata('CoID');
    //     $WorkYear = $this->session->userdata('WorkYear');
    //     if ($this->input->post('IDNumber') == 'New') {
    //         $data = array(
    //             'CoID'     => $CoID,
    //             'WorkYear'  => $WorkYear,
    //             'IDNumber' => $this->input->post('IDNumber'),
    //             'ConvDate'  => $this->input->post('ConvDate')
    //         );
    //         $this->db->insert('ConvMast', $data);
    //         $lastConv = $this->conversionModel->lastConv();
    //         $ConvId = array(
    //             'IDNumber' => $lastConv
    //         );
    //         $multiwhere = array(
    //             'CoID' => $CoID,
    //             'WorkYear' => $WorkYear,
    //             ''
    //         );
    //         $this->db->update('ConvTrans', $ConvId);
    //         $this->db->where($multiwhere);

    //         $data = array(
    //             'CoID'     => $CoID,
    //             'WorkYear'  => $WorkYear,
    //             'RefIDNumber' => $lastConv,
    //             'ConvDate'  => $this->input->post('ConvDate'),
    //             'PartyCode' => $this->input->post('PartyCode'),
    //             'GodownID'  => $this->input->post('GodownID'),
    //             'LotNo'     => $this->input->post('LotNo'),
    //             'ItemCode'  => $this->input->post('ItemCode'),
    //             'Mark'      => $this->input->post('Mark'),
    //             'Qty'      => $this->input->post('Qty'),
    //             'Rate'      => $this->input->post('Rate'),
    //             'Weigh'     => $this->input->post('Weight'),
    //             'APMCInd'   => $this->input->post('NAPMCInd'),
    //             'ETaxInd'   => $this->input->post('NETaxInd'),
    //             'ConvInd'   => "F",
    //             'Commission' => 0,
    //             'TapaleeAC' => 0,
    //             'GdnRate'   => 0,
    //             // 'EntryType' => $this->input->post('EntryType'),
    //             'GRcptDate'  => $this->input->post('GoodsRcptDate')
    //         );
    //         $this->db->insert('ConvTran', $data);
    //         $results["TableData"] = $this->fetchType($lastConv, "F", $CoID, $WorkYear);
    //         $results["ID"] = $lastConv;

    //         return $results;
    //     } else {
    //         $data = array(
    //             'CoID'     => $CoID,
    //             'WorkYear'  => $WorkYear,
    //             'RefIDNumber' => $this->input->post('IDNumber'),
    //             'ConvDate'  => $this->input->post('ConvDate'),
    //             'PartyCode' => $this->input->post('PartyCode'),
    //             'GodownID'  => $this->input->post('GodownID'),
    //             'LotNo'     => $this->input->post('LotNo'),
    //             'ItemCode'  => $this->input->post('ItemCode'),
    //             'Mark'      => $this->input->post('Mark'),
    //             'Qty'      => $this->input->post('Qty'),
    //             // 'Rate'      => $this->input->post('Rate'),
    //             'Weigh'     => $this->input->post('Weight'),
    //             'APMCInd'   => $this->input->post('APMCInd'),
    //             'ETaxInd'   => $this->input->post('ETaxInd'),
    //             'ConvInd'   => "F",
    //             // 'Commission' => $this->input->post('Commissio'),
    //             // 'TapaleeAC' => $this->input->post('TapaleeAC'),
    //             // 'GdnRate'   => $this->input->post('GdnRate'),
    //             // 'EntryType' => $this->input->post('EntryType'),
    //             'GRcptDate'  => $this->input->post('GoodsRcptDate')
    //         );
    //         $this->db->insert('ConvTran', $data);
    //         $results["TableData"] = $this->fetchType($this->input->post('IDNumber'), "F", $CoID, $WorkYear);
    //         return $results;
    //     }
    // }
}
