<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class rtgs extends CI_Controller
{
    public $id1;

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
        $this->load->model('RTGS_Model');
        $data['Party'] = $this->RTGS_Model->party_det();
        $data['Comp'] = $this->RTGS_Model->get_company();


        $this->load->view('Rtgs_view', $data);
    }
}
