<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class GSTR1ReportController extends CI_Controller
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

    function GSTR1_show()
    {
        if ($this->input->post('newMonth') != null) {
            $month = $this->input->post('newMonth');
        } else {
            $month = date('F');
        }

        $WorkYear = $this->session->userdata('WorkYear');
        $SpiltWorkYear = explode("-", $WorkYear);
        $finalWorkYear = $SpiltWorkYear[0];

        $first_date = date('Y-m-d', strtotime('first day of ' . $month . ' ' . $finalWorkYear));
        $last_date = date('Y-m-d', strtotime('last day of ' . $month . ' ' . $finalWorkYear));

        $this->load->view('menu_1.php');
        $this->load->model('GSTR1Model');
        $data['month'] = $month;
        $data['b2bList'] = $this->GSTR1Model->getB2BData($first_date, $last_date);
        $data['b2c1List'] = $this->GSTR1Model->getB2C1Data($first_date, $last_date);
        $data['b2csList'] = $this->GSTR1Model->getB2CSData($first_date, $last_date);
        $data['exemptList'] = $this->GSTR1Model->getGSTR1exempt($first_date, $last_date);
        $data['hsnList'] = $this->GSTR1Model->getHSN($first_date, $last_date);
        $data['docList'] = $this->GSTR1Model->getDoc($first_date, $last_date);
        $this->load->view('GSTR1_View.php', $data);
    }
}
