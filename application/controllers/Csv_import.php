<?php 

	class Csv_import extends CI_Controller {
		public function __construct() {
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

		//loads the view and displays all the table names from database		
		function loadView() {
			$this->load->model('Csv_import_model');
			$data['tables'] = $this->Csv_import_model->getDatabaseTables();
			$data['result'] = "";	
			$this->load->view('csv_import',$data);	
		}
	
		//uploads excel data into database
		function importExcel() {
			$this->load->model('Csv_import_model');
			
			if(isset($_POST['submit'])) {
				$file = $_FILES['file']['tmp_name'];
				$handle = fopen($file,'r');
				$c = 0;
				while(($filepos = fgetcsv($handle,1000,','))!==false) {
					print_r($filepos);
					$filepos = array_map("utf8_encode",$filepos);
					if($c>0) {
						$this->load->Csv_import_model->insertExcelData($filepos);
					}
					$c = $c + 1;
				}
				echo "<script>alert('File Imported Successfully')</script>";
			}
		}	

		function displaySampleTable($viewTable) {
			$this->load->model('Csv_import_model');
			$data['result'] = $this->Csv_import_model->fetchSampleTableData($viewTable);
			$data['tables'] = $this->Csv_import_model->getDatabaseTables();
			$table = $data['result'];
			// echo json_encode($table);
			$this->load->view('csv_import',$data);	
		}	
	}

?>
