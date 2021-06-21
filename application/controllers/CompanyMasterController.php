<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$timezone = "Asia/Colombo";
date_default_timezone_set($timezone);
$today = date("Y-m-d");
$time = date("hh:mm:ss");

class CompanyMasterController extends CI_Controller
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
          $this->load->model('CompanyMasterModel');
          $data['Item_List'] = $this->CompanyMasterModel->get_details();
          // $data['Item_List1'] = $this->CompanyMasterModel->get_details2();
          $this->load->view('menu_1.php');
          $this->load->view('CompanyMasterView', $data);
     }

     // public function addCompanyMaster()
     // {
     //      $this->form_validation->set_rules('comp_id', 'Company ID', 'trim|required');
     //      $this->form_validation->set_rules('comp_name', 'Company Name', 'trim|required');

     //      if ($this->form_validation->run() == FALSE) {
     //           //fail validation 
     //           $this->load->view('CompanyMasterInsert');
     //      } else {
     //           $data1 = array(
     //                'CoID' => $this->input->post('comp_id'),
     //                'CoName' => $this->input->post('comp_name'),
     //                'COStatus' => $this->input->post('comp_status'),
     //                'Priority' => $this->input->post('priority'),
     //                'Address1' => $this->input->post('add1'),
     //                'Address2' => $this->input->post('add2'),
     //                'Address3' => $this->input->post('add3')
     //           );
     //           $this->db->insert('Company', $data1);

     //           $data2 = array(
     //                'COID' => $this->input->post('comp_id'),
     //                'WorkYear' => $this->input->post('work_year'),
     //                'FirmAddress1' => $this->input->post('firm_add1'),
     //                'FirmAddress2' => $this->input->post('firm_add2'),
     //                'FirmAddress3' => $this->input->post('firm_add3'),
     //                'FirmAddress4' => $this->input->post('firm_add4'),
     //                'FirmAddress5' => $this->input->post('firm_add5'),
     //                'FirmPinCode' => $this->input->post('firm_pin'),
     //                'FirmStateCode' => $this->input->post('firm_state_code'),
     //                'FirmStateName' => $this->input->post('firm_state_name'),
     //                'FirmPhoneNo' => $this->input->post('firm_phone1'),
     //                'FirmEmailID' => $this->input->post('firm_email1'),
     //                'FirmAltPhoneNo' => $this->input->post('firm_phone2'),
     //                'FirmAltEmailID' => $this->input->post('firm_email2'),
     //                'PersName' => $this->input->post('person_name'),
     //                'PersPAN' => $this->input->post('person_pan'),
     //                'PersDesig' => $this->input->post('person_desig'),
     //                'PersMobileNo' => $this->input->post('person_mobile'),
     //                'PANNo' => $this->input->post('person_pan'),
     //                'GSTNo' => $this->input->post('gstno'),
     //                'TANNo' => $this->input->post('tan_no'),
     //                'TDSCircle' => $this->input->post('tds_circle'),
     //                'TANAddress' => $this->input->post('tan_add'),
     //                'TANCity' => $this->input->post('tan_city'),
     //                'TANPin' => $this->input->post('tan_pin'),
     //                'DeducteeType' => $this->input->post('deductee'),
     //                'Qtr1RCTNo' => $this->input->post('qtr1'),
     //                'Qtr2RCTNo' => $this->input->post('qtr2'),
     //                'Qtr3RCTNo' => $this->input->post('qtr3'),
     //                'Qtr4RCTNo' => $this->input->post('qtr4'),
     //                'BranchDiv' => $this->input->post('branch'),
     //                'SoftDev' => $this->input->post('soft_dev')
     //           );
     //           $this->db->insert('CompData', $data2);


     //           $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">New Company Master added Succesfully.!!!</div>');
     //           redirect('CompanyMasterController/show');
     //      }
     // }

     public function EditCompanyMaster($compid)
     {
          // $CoID = $this->session->userdata('CoID');
          $WorkYear = $this->session->userdata('WorkYear');

          $this->load->model('CompanyMasterModel');

          $data['Edit_Details'] = $this->CompanyMasterModel->get_item_record($compid);
          $data['Edit_Details1'] = $this->CompanyMasterModel->get_item_records2($compid, $WorkYear);
          $config = array(
               'file_name' => 'logo-' . date("hms"),
               'upload_path' => "./upload/",
               'allowed_types' => "jpg|png|jpeg",
               'overwrite' => TRUE,
               'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
               'max_height' => "768",
               'max_width' => "1024"
          );

          $this->form_validation->set_rules('comp_id', 'Company ID', 'trim|required');
          $this->form_validation->set_rules('comp_name', 'Company Name', 'trim|required');
          if ($this->form_validation->run() == FALSE) {
               //fail validation
               $this->load->view('CompanyMasterUpdate', $data);
          } else {
               $this->load->library('upload', $config);
               $this->upload->do_upload('firm_logo');
               $imageData = $this->upload->data();
               // print_r($this->upload->data());
               // die;
               $file_name = $imageData['file_name'];
               $data1 = array(
                    'CoName' => $this->input->post('comp_name'),
                    'COStatus' => $this->input->post('comp_status'),
                    'Priority' => $this->input->post('priority'),
                    'Address1' => $this->input->post('add1'),
                    'Address2' => $this->input->post('add2'),
                    'Address3' => $this->input->post('add3'),
                    'BankName' => $this->input->post('bank_name'),
                    'BankBranch' => $this->input->post('bank_branch'),
                    'BankAccount' => $this->input->post('a/c_number'),
                    'BankIFSC' => $this->input->post('ifsc_code'),
                    'Logo' => $file_name

               );
               $this->db->where('CoID', $compid);
               $this->db->update('Company', $data1);

               $data2 = array(
                    'FirmAddress1' => $this->input->post('firm_add1'),
                    'FirmAddress2' => $this->input->post('firm_add2'),
                    'FirmAddress3' => $this->input->post('firm_add3'),
                    'FirmAddress4' => $this->input->post('firm_add4'),
                    'FirmAddress5' => $this->input->post('firm_add5'),
                    'FirmPinCode' => $this->input->post('firm_pin'),
                    'FirmStateCode' => $this->input->post('firm_state_code'),
                    'FirmStateName' => $this->input->post('firm_state_name'),
                    'FirmPhoneNo' => $this->input->post('firm_phone1'),
                    'FirmEmailID' => $this->input->post('firm_email1'),
                    'FirmAltPhoneNo' => $this->input->post('firm_phone2'),
                    'FirmAltEmailID' => $this->input->post('firm_email2'),
                    'PersName' => $this->input->post('person_name'),
                    'PersPAN' => $this->input->post('person_pan'),
                    'PersDesig' => $this->input->post('person_desig'),
                    'PersMobileNo' => $this->input->post('person_mobile'),
                    'PANNo' => $this->input->post('person_pan'),
                    'GSTNo' => $this->input->post('gstno'),
                    'TANNo' => $this->input->post('tan_no'),
                    'TDSCircle' => $this->input->post('tds_circle'),
                    'TANAddress' => $this->input->post('tan_add'),
                    'TANCity' => $this->input->post('tan_city'),
                    'TANPin' => $this->input->post('tan_pin'),
                    'DeducteeType' => $this->input->post('deductee')
               );
               $this->db->where('COID', $compid);
               $this->db->update('CompData', $data2);

               $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record is Successfully Updated!</div>');
               echo "<script> ";
               echo "alert('Company Master Updated !!');";
               echo "window.location.href = '" . base_url() . "index.php/CompanyMasterController/show';";
               echo "</script>";
          }
     }


     // public function DeleteCompanyMaster($compid)
     // {
     //      $this->db->where('CoID', $compid);
     //      $this->db->delete('Company');

     //      $this->db->where('COID', $compid);
     //      $this->db->delete('CompData');
     //      echo "<script> ";
     //      echo "alert('Company Master Deleted !!');";
     //      echo "window.location.href = '" . base_url() . "index.php/CompanyMasterController/show';";
     //      echo "</script>";
     // }

}
