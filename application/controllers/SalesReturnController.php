<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SalesReturnController extends CI_Controller
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
        if ($this->input->post('submit') != NULL) {
            $postData = $this->input->post();

            // Read POST data
            $fromYear = $postData['fromYear'];
            $toYear = $postData['toYear'];


            $this->load->model('SalesReturnModel');
            $data['Item_List'] = $this->SalesReturnModel->get_detailsFilter($fromYear, $toYear);

            $this->load->view('menu_1');
            $this->load->view('SalesReturnGrid', $data);
        } else {
            $this->load->model('SalesReturnModel');
            $data['Item_List'] = $this->SalesReturnModel->get_details();

            $this->load->view('menu_1');
            $this->load->view('SalesReturnGrid', $data);
        }
    }
    //Delete from grid
    function DeleteFromGrid($IDNumber)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $IDNumber);
        $this->db->where($multi_where);
        $this->db->delete('SaleReturnMast');

        $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $IDNumber);
        $this->db->where($multi_where);
        $this->db->delete('SalesReturnDets');

        echo "<script> ";
        echo "alert('Sales Deleted !!');";
        echo "window.location.href = '" . base_url() . "index.php/SalesReturnController/show';";
        echo "</script>";
    }

    //? To show the SalesReturnEntryView file
    public function salesReturnEntry()
    {
        $this->load->model('SalesReturnModel');

        $data['ACList'] = $this->SalesReturnModel->get_Acc_list();
        $this->load->view('SalesReturnEntryView', $data);
    }

    public function getQty()
    {
        // Calls the model
        $id = $this->input->post('refBillNo');

        $this->load->model('SalesReturnModel');
        $data['Bill'] = $this->SalesReturnModel->getQty($id);
        // // $this->load->view('menu_1');
        echo json_encode($data);
        // $rcount = $this->SalesReturnModel->getBill($id);
        // return $rcount;

    }

    public function getBill()
    {
        // Calls the model
        $id = $this->input->post('refBillNo');

        $this->load->model('SalesReturnModel');
        $data['Bill'] = $this->SalesReturnModel->getBill($id);
        echo json_encode($data);
    }


    public function getSalesDets()
    {
        // Calls the model
        $id = $this->input->post('refBillNo');

        $this->load->model('SalesReturnModel');
        $data['SalesData'] = $this->SalesReturnModel->getSalesReturnData($id);
        // $this->load->view('menu_1');
        echo json_encode($data);
    }

    public function getSalesDet()
    {
        // Calls the model
        $id = $this->input->post('refBillNo');

        $this->load->model('SalesReturnModel');
        $data['SalesEntryData'] = $this->SalesReturnModel->getSalesReturnEntryData($id);
        // $this->load->view('menu_1');
        echo json_encode($data);
    }
    public function ReturnAc($ACCode)
    {
        if (empty($ACCode)) {
            echo json_encode([]);
            exit;
        }

        $this->load->model('SalesReturnModel');
        $data = $this->SalesReturnModel->getACCode($ACCode);
        echo json_encode($data);
        exit;
    }

    public function SalesReturnInsertData()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $data = array(
            'CoID' => $CoID,
            'WorkYear' => $WorkYear,
            'IDNumber' => 'New',
            'CashDate' => $this->input->post('CashDate'),
            'BillNo' => $this->input->post('BillNo'),
            'BillDate' => $this->input->post('BillDate'),
            'PartyCode' => $this->input->post('PartyCode'),
            'ReturnAcc' => $this->input->post('ReturnAcc'),
            'BillAmt' => $this->input->post('BillAmt'),
            'CashCode' => $this->input->post('CashCode'),
            'Taxcode' => $this->input->post('Taxcode'),
            'SaleType' => '',
            'MudiBazar' => $this->input->post('MudiBazar'),
            'EntryType' => '',
            'SalRAmt' => '',
            'ItemAmt' => $this->input->post('ItemAmt'),
            'Lagaamt' => '',
            'ContAmt' => $this->input->post('ContAmt'),
            'DiscAmt' => $this->input->post('DiscAmt'),
            'APMCAmt' => $this->input->post('APMCAmt'),
            'OAPMCAmt' => '',
            'EtaxAmt' => '',
            'OEtaxAmt' => '',
            'AddAmt' => $this->input->post('AddAmt'),
            'LessAmt' => $this->input->post('LessAmt'),
            'TaxableAmt' => $this->input->post('TaxableAmt'),
            'TaxAmt' => $this->input->post('TaxAmt'),
            'CGSTAmt' => $this->input->post('CGSTAmt'),
            'SGSTAmt' => $this->input->post('SGSTAmt'),
            'IGSTAmt' => $this->input->post('IGSTAmt'),
            'HMajuAmt' => $this->input->post('HMajuAmt'),
            'OChrgamt' => $this->input->post('OChrgamt'),
            'RoffAmt' => $this->input->post('RoffAmt'),
            'Haste' => '',
            'BrokCode' => $this->input->post('BrokCode'),
            'BrokAmt' => '',
        );
        // print_r($data);
        // die;
        $this->db->insert('SaleReturnMast', $data);
        $this->load->model('SalesReturnModel');
        $result = $this->SalesReturnModel->getIDNum();
        // $purh_id = $result[0]->LastGaruPurRefIDNumber;
        $purh_id = $result;

        $data2 = array('IDNumber' => $purh_id);
        $this->db->where('IDNumber', 'New');
        $this->db->update('SaleReturnMast', $data2);

        echo json_encode($purh_id);
    }

    public function SalesReturnInsertDetail()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $data = array(
            'CoID' => $CoID,
            'WorkYear' => $WorkYear,
            'RefIDNumber' => $this->input->post('IDNumber'),
            'SalRetrnDt ' => $this->input->post('SalRetrnDt'),
            'BillNo ' => $this->input->post('BillNo'),
            'BillDate ' => $this->input->post('BillDate'),
            'GodownID ' => $this->input->post('GodownID'),
            'LotNo ' => $this->input->post('LotNo'),
            'CreditAcc ' => $this->input->post('CreditAcc'),
            'ItemCode ' => $this->input->post('ItemCode'),
            'ItemMark ' => $this->input->post('ItemMark'),
            'Qty ' => $this->input->post('Qty'),
            'GrossWt ' => $this->input->post('GrossWt'),
            'NetWt ' => $this->input->post('NetWt'),
            'Rate ' => $this->input->post('Rate'),
            'APMCIn ' => $this->input->post('APMCIn'),
            'ETaxIn ' => '',
            'ItemAmt ' => '',
            'ContChrg ' => $this->input->post('ContChrg'),
            'LagaAmt ' => '',
            'DiscRate ' => '',
            'DiscAmt ' => $this->input->post('DiscAmt'),
            'APMCChrg ' => $this->input->post('APMCChrg'),
            'APMCSChrg ' => '',
            'OApmcTax ' => '',
            'EntryTax ' => '',
            'Oetax ' => '',
            'AddAmt ' => $this->input->post('AddAmt'),
            'LessAmt ' => $this->input->post('LessAmt'),
            'TaxableAmt ' => $this->input->post('TaxableAmt'),
            'RetuTaxCode ' => $this->input->post('RetuTaxCode'),
            'TaxAmt ' => $this->input->post('TaxAmt'),
            'CGSTAmt ' => $this->input->post('CGSTAmt'),
            'SGSTAmt ' => $this->input->post('SGSTAmt'),
            'IGSTAmt ' => $this->input->post('IGSTAmt'),
            'SalRAmt ' => $this->input->post('SalRAmt'),
            'PattiInd ' => '',
            'BrokerCode ' => $this->input->post('BrokerCode'),
            'BrokInd ' => '',
            'BrokRate ' => '',
            'BrokAmt ' => '',
            'NAPMCIn ' => '',
            'NEtaxIn ' => '',
            'RDCODE1 ' => '',
            'RDCODE2 ' => '',
            'RDCODE3 ' => '',
            'RDCODE4 ' => '',
            'RDCODE5 ' => '',
            'RDAmt1 ' => '',
            'RDAmt2 ' => '',
            'RDAmt3 ' => '',
            'RDAmt4 ' => '',
            'RDAmt5 ' => '',
            'CreditAccAmt' => '',
            'EntryType ' => '',
            'Haste ' => '',
            'HelOthRoff ' => '',
        );
        // print_r($data);
        // die;
        $this->db->insert('SalesReturnDets', $data);
        // $this->load->model('SalesReturnModel');
        // $result = $this->SalesReturnModel->getIDNum();
        // // $purh_id = $result[0]->LastGaruPurRefIDNumber;
        // $purh_id = $result;

        // $data2 = array('IDNumber' => $purh_id);
        // $this->db->where('IDNumber', 'New');
        // $this->db->update('SalesReturnDets', $data2);
        // echo json_encode($purh_id);
        echo "data submited";
        return true;
    }

    function updateSalesReturn($IDNumber)
    {
        $this->load->model('SalesReturnModel');
        $data['SalesReturnMaster'] = $this->SalesReturnModel->SalesRetMastData($IDNumber);
        $data['TableData'] = $this->SalesReturnModel->SalesRetDets($IDNumber);

        $this->load->view('SalesReturnUpdateView', $data);
    }


    function getSalesDetails($id)
    {
        $this->load->model('SalesReturnModel');
        $data['SalesDetails'] = $this->SalesReturnModel->getSalesDetails($id);
        // $this->load->view('menu_1');
        echo json_encode($data);
    }


    public function SalesReturnUpdateData()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $IDNumber = $this->input->post('IDNumber');
        $data = array(
            'CashDate' => $this->input->post('CashDate'),
            'ReturnAcc' => $this->input->post('ReturnAcc'),
        );
        $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $IDNumber);
        $this->db->where($multi_where);
        $this->db->update('SaleReturnMast', $data);
        echo json_encode($IDNumber);
    }
    //? Pranav Patil 4-6-21    
    function getSalesReturnVoucher($ID)
    {
        $this->load->model('SalesReturnModel');

        $data['voucherInfo'] = $this->SalesReturnModel->salesReturnVoucher($ID);

        $this->load->view('salesReturnPrintzview', $data);
    }
}
