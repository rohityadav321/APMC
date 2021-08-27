<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//? Created on 23-6-21
class OrderSalesController extends CI_Controller
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
        $this->load->helper('date');
    }


    //* Shows the Grid of OrderEntryGrid -Pranav 23-6-21
    public function show()
    {
        // if ($this->input->post('submit') != NULL) {
        //     $postData = $this->input->post();

        //     // Read POST data
        //     $fromYear = $postData['fromYear'];
        //     $toYear = $postData['toYear'];

        //     $this->load->model('OrderEntryModel');
        //     $data['Item_List'] = $this->OrderEntryModel->get_detailsFilter($fromYear, $toYear);

        //     $this->load->view('menu_1');
        //     $this->load->view('OrderEntryGrid', $data);
        // } else {
        $this->load->model('OrderEntryModel');
        $data['Item_List'] = $this->OrderEntryModel->get_details();
        // echo json_encode($data);
        // die;
        $this->load->view('menu_1');
        $this->load->view('OrderEntryGrid', $data);
        // }
    }

    //* Data fro all the Modals  -Pranav 23-6-21
    public function showTry()
    {
        $this->load->model('OrderEntryModel');
        $data['GodownList'] = $this->OrderEntryModel->Get_Godown_List();
        $data['DebtorList'] = $this->OrderEntryModel->Get_Debtor_List();
        $data['BrokerList'] = $this->OrderEntryModel->Get_Broker_List();
        $data['CustomerList'] = $this->OrderEntryModel->Get_Customer_List();

        $this->load->view('orderEntryView2', $data);
    }

    public function LotWiseitem()
    {
        $this->load->model('OrderEntryModel');
        $gid = $this->input->post('GID');
        // $LotNo = $this->input->post('LotNo');
        $value['LotWise'] = $this->OrderEntryModel->itemWise($gid);
        echo json_encode($value);
    }


    //? Order Entry Controller  -Pranav 23-6-21
    public function SalesorderEntry()
    {
        $this->load->model('OrderEntryModel');
        $data['GodownList'] = $this->OrderEntryModel->Get_Godown_List();
        $this->load->view('orderEntryView2', $data);
    }
    function insertOrderHeader()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        $data = array(
            'CoID' => $CoID,
            'WorkYear' => $WorkYear,
            'OrderNo' =>  $this->input->post('OrderNo'),
            'OrderDate' => $this->input->post('OrderDate'),
            'ForwardDO' => $this->input->post('ForwardDO'),
            'SaleType' => $this->input->post('SaleType'),
            'LRNo' => $this->input->post('LRNo'),
            'DebtorID' => $this->input->post('DebtorID'),
            'PartyCode' => $this->input->post('PartyCode'),
            'Area' => $this->input->post('Area'),
            'BrokerID' => $this->input->post('BrokerID'),
            'MudiBazar' => $this->input->post('MudiBazar'),
            'CPName' => $this->input->post('CPName')
        );
        $this->db->insert('ORDDAT', $data);

        $this->load->model('OrderEntryModel');

        $result = $this->OrderEntryModel->getOrder();

        $Order = $result;

        $data2 = array('OrderNo' => $Order);
        $this->db->where('OrderNo', 'New');
        $this->db->update('ORDDAT', $data2);

        echo json_encode($Order);
    }
    function insertOrderDetails()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        $data = array(
            'CoID' => $CoID,
            'WorkYear' => $WorkYear,
            'OrderNo' => $this->input->post("OrderNo"),
            'OrderDate' => $this->input->post("OrderDate"),
            'ForwardDO' => $this->input->post("ForwardDO"),
            'GodownID' => $this->input->post("GodownID"),
            'LotNo' => $this->input->post("LotNo"),
            'CreditAcc' => $this->input->post("CreditAcc"),
            'ItemCode' => $this->input->post("ItemCode"),
            'ItemMark' => $this->input->post("ItemMark"),
            'OrderQty' => $this->input->post("OrderQty"),
            'OrderBal' => $this->input->post("OrderBal"),
            'Rate' => $this->input->post("Rate"),
            'RATEPER' => $this->input->post("RATEPER"),
            'APMCIn' => $this->input->post("APMCIn"),
            'ETaxIn' => $this->input->post("ETaxIn"),
            'TaxCode' => $this->input->post("TaxCode"),
            'MudiBazar' => $this->input->post("MudiBazar"),
            'BrokerCode' => $this->input->post("BrokerCode"),
            'LRNo' => $this->input->post("LRNo")
        );
        $this->db->insert('ORDDET', $data);

        $this->load->model('OrderEntryModel');
    }

    //? Demo Order Entry Controller  -Pranav 23-6-21
    public function showOrderEntry()
    {
        // $this->load->model('SalesModel');

        // To view the page
        $this->load->view('orderEntryView');
    }
}
