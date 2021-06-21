<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReportController extends CI_Controller
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
          $this->load->model('BankMasterModel');

          //load date helper
          $this->load->helper('date');
     }
     public function show()
     {
          $this->load->model('ReportModel');

          $fromYear = '2017-03-01';
          $toYear = '2021-04-01';

          $data['result'] = $this->ReportModel->get_brokerWiseDetails($fromYear,$toYear);    

          $this->load->view('menu_1.php');
          $this->load->view('OutstandingReport_View',$data);
     }

     public function showFilterData()
     {
          //  echo     $this->input->post('filter');
          //  die ; 
          $this->load->model('ReportModel');

          // $fromYear = '2017-03-01';
          // $toYear = '2021-04-01';

          $filter = $this->input->post('filter');
          $filter1 = $this->input->post('filter1');

          $fromYear = $this->input->post('fromYear');
          $toYear = $this->input->post('toYear');

          // echo $fromYear, $toYear;
          // die ; 

          if($filter == "Brokerwise"){
               $data['result'] = $this->ReportModel->get_brokerWiseDetails($fromYear,$toYear);
          }
          elseif($filter == "Areawise"){
               $data['result'] = $this->ReportModel->get_areaWiseDetails($fromYear,$toYear);
          }
          else{
               $data['result'] = $this->ReportModel->get_partyWiseDetails($fromYear,$toYear);
          }
           
          // print_r ($data);
          // die ;
          $this->load->view('menu_1.php');
          $this->load->view('OutstandingReport_View',$data);
     }

    //updated 13-02-21
     function OSReceivables(){
          $this->load->model('ReportModel');
          $y= date("Y");
          $m=date("m");
          $fromYear= $y."-".$m."-01";
          $toYear=date("Y-m-t", strtotime($fromYear));

          $data['result'] = $this->ReportModel->get_OSReceivablesB($fromYear,$toYear);
          // print_r ($data);
          // die ; 
          $this->load->view('menu_1.php');
          $this->load->view('OSReceivables_View',$data);
     }

     //updated 13-02-21
     function OSReceivablesFilter(){
          if($this->input->post('submit') != NULL ){
          $postData = $this->input->post();
     
          // Read POST data
          $fromYear = $postData['fromYear'];
          $toYear = $postData['toYear'];

          $filter = $this->input->post('filter');

          $this->load->model('ReportModel');

               $data['RTYPE'] = $filter;

               if($filter == "Brokerwise"){
                    $data['result'] = $this->ReportModel->get_OSReceivablesB($fromYear,$toYear);
               }
               elseif($filter == "Areawise"){
                    $data['result'] = $this->ReportModel->get_OSReceivablesA($fromYear,$toYear);
               }
               else{
                    $data['result'] = $this->ReportModel->get_OSReceivablesP($fromYear,$toYear);
               }


               // print_r($data);
               // die ; 
          //   $data['result'] = $this->ReportModel->get_OSReceivablesFilter($fromYear,$toYear);

          $this->load->view('menu_1.php');
          $this->load->view('OSReceivables_View',$data,$fromYear,$toYear);
          }
     }        

     // updated 01-04-21 RY
     function OSSingleReceivables()
     {
          $this->load->model('ReportModelSingle');
          $y = date("Y");
          $m = date("m");
          $fromYear = $y . "-" . $m . "-01";
          $toYear = date("Y-m-t", strtotime($fromYear));
          // $ACTitle = $postData['ACTitle'];
          $data['result'] = $this->ReportModelSingle->get_OSReceivables($fromYear, $toYear);
          $data['PartyList'] = $this->ReportModelSingle->Get_Party_List();
          $data['AreaList'] = $this->ReportModelSingle->Get_Area_List();
          $data['BrokerList'] = $this->ReportModelSingle->Get_Broker_List();
          // print_r ($data);
          // die ; 
          $this->load->view('menu_1.php');
          $this->load->view('OSSingleReceivables_View', $data);
     }

     // updated 01-04-21 RY
     function OSSingleReceivablesFilter()
     {
          if ($this->input->post('submit') != NULL) {
               $postData = $this->input->post();

               // Read POST data
               $fromYear = $postData['fromYear'];
               $toYear = $postData['toYear'];
               $AreaName = $postData['AreaName'];
               $PartyName = $postData['PartyName'];
               $ACTitle = $postData['ACTitle'];

               $filter = $this->input->post('filter');

               $this->load->model('ReportModelSingle');
               $data['PartyList'] = $this->ReportModelSingle->Get_Party_List();
               $data['AreaList'] = $this->ReportModelSingle->Get_Area_List();
               $data['BrokerList'] = $this->ReportModelSingle->Get_Broker_List();


               $data['RTYPE'] = $filter;


               if ($filter == "Brokerwise") {
                    $data['result'] = $this->ReportModelSingle->get_OSReceivablesB($fromYear, $toYear, $ACTitle);
               } elseif ($filter == "Areawise") {
                    $data['result'] = $this->ReportModelSingle->get_OSReceivablesA($fromYear, $toYear, $AreaName);
               } else {
                    $data['result'] = $this->ReportModelSingle->get_OSReceivablesP($fromYear, $toYear, $PartyName);
               }


               // print_r($data);
               // die ; 
               //   $data['result'] = $this->ReportModel->get_OSReceivablesFilter($fromYear,$toYear);

               $this->load->view('menu_1.php');
               $this->load->view('OSSingleReceivables_View', $data, $fromYear, $toYear);
          }
     }

     // updated 31-03-21   
     function rateDiffReport(){
          $this->load->model('ReportModel');
          $y= date("Y");
          $m=date("m");
          $fromYear= $y."-".$m."-01";
          $toYear=date("Y-m-t", strtotime($fromYear));

          $data['RTYPE'] = "Brokerwise";
          $data['RTYPE1'] = "Detail";
          $data['result'] = $this->ReportModel->get_RateDiffBD($fromYear,$toYear);
     
          $this->load->view('menu_1.php');
          $this->load->view('RateDiffReport_View',$data);
     }

     // updated 31-03-21 
     function rateDiffReportFilter(){
          if($this->input->post('submit') != NULL ){
          $postData = $this->input->post();
     
          // Read POST data
          $fromYear = $postData['fromYear'];
          $toYear = $postData['toYear'];

          $filter = $this->input->post('filter');
          $filter1 = $this->input->post('filter1');

          $this->load->model('ReportModel');

               $data['RTYPE'] = $filter;
               $data['RTYPE1'] = $filter1;

               if($filter == "Brokerwise" && $filter1 == "Detail"){
                    $data['result'] = $this->ReportModel->get_RateDiffBD($fromYear,$toYear);
               }
               elseif($filter == "Areawise" && $filter1 == "Detail"){
                    $data['result'] = $this->ReportModel->get_RateDiffAD($fromYear,$toYear);
               }
               elseif($filter == "Partywise" && $filter1 == "Detail"){
                    $data['result'] = $this->ReportModel->get_RateDiffPD($fromYear,$toYear);
               }
               elseif($filter == "Partywise" && $filter1 == "Summary"){
                    $data['result'] = $this->ReportModel->get_RateDiffBS($fromYear,$toYear);
               }
               elseif($filter == "Areawise" && $filter1 == "Summary"){
                    $data['result'] = $this->ReportModel->get_RateDiffAS($fromYear,$toYear);
               }
               else{
                    $data['result'] = $this->ReportModel->get_RateDiffPS($fromYear,$toYear); 
               }
               
          $this->load->view('menu_1.php');
          $this->load->view('RateDiffReport_View',$data,$fromYear,$toYear);
          }
     }

     // updated 01-04-21 RY
     public function PartyData($PartyCode)
     {
          if (empty($PartyCode)) {
               echo json_encode([]);
               exit;
          }

          $this->load->model('ReportModelSingle');
          $data = $this->ReportModelSingle->getPartyData($PartyCode);
          echo json_encode($data);
          exit;
     }

     // updated 01-04-21 RY
     public function AreaData($area)
     {
          if (empty($area)) {
               echo json_encode([]);
               exit;
          }

          $this->load->model('ReportModelSingle');
          $data = $this->ReportModelSingle->getAreaData($area);
          echo json_encode($data);
          exit;
     }

     // updated 01-04-21 RY
     public function BrokerData($ACCode)
     {
          if (empty($ACCode)) {
               echo json_encode([]);
               exit;
          }

          $this->load->model('ReportModelSingle');
          $data = $this->ReportModelSingle->getBrokerData($ACCode);
          echo json_encode($data);
          exit;
     }


}