<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inv01 extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->database();
        $this->load->helper('html');
        $this->load->library('form_validation');

        // load data helper
        $this->load->helper('date');
    }

    public function printInvoice() {
        // $sessiondata['CoID'] = $CoID;
        // $sessiondata['CoName'] = $CoName;
        // $sessiondata['WorkYear'] = $WorkYear;

        // $this->session->set_userdata($sessiondata);

        $this->load->view('Invoice_View2.php');
    }
}
