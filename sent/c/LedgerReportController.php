<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LedgerReportController extends CI_Controller
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
     
     function AccountGroupReportDatewise() {
          $this->load->model('LedgerReportModel');
          //   $this->form_validation->set_rules('AC_Name','Account Code','trim|required');

          $data['ACList'] = $this->LedgerReportModel->Get_Account_List();         
          $data['result'] = $this->LedgerReportModel->get_accGroupDetails();
        
          $this->load->view('menu_1.php');
          $this->load->view('LedgerReportHomeView',$data);

    }

    function AccountGroupReportDatewise1($title,$fromYear,$toYear) {

            $this->load->model('LedgerReportModel');

            //   $title= $this->input->post('ACName');
            $data['ACList'] = $this->LedgerReportModel->Get_Account_List(); 
            $data['result1'] = $this->LedgerReportModel->get_accGroupDetails_title($title,$fromYear,$toYear);
            $data['ACTitle'] = $this->LedgerReportModel->getAcTitle($title); 
            $data['from']=$fromYear;
            $data['to']=$toYear;

            //   print_r ($data);
            // echo json_encode($data);
            //   die ; 
            $this->load->view('menu_1.php');
            $this->load->view('LedgerReportView',$data);

    }

    //fetch Account code data in dropdown
    public function AccData($ACCode){
          if(empty($ACCode)){
              echo json_encode([]);exit;
          }

          $this->load->model('LedgerReportModel');
          $data = $this->LedgerReportModel->getAccData($ACCode);
          echo json_encode($data);exit;
    }

}

?>