<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SelectCompany extends CI_Controller
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
     public function show($CoID, $CoName, $WorkYear)
     {
        $sessiondata['CoID'] = $CoID;
        $sessiondata['CoName'] = $CoName;
        $sessiondata['WorkYear'] = $WorkYear ;

        $this->session->set_userdata($sessiondata);

        $this->load->view('menu_1');
        $this->load->view('welcome_message');
        // print_r ($sessiondata);
     }
 
}

?>