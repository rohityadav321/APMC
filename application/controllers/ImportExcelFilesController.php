<?php 

	class ImportExcelFilesController extends CI_Controller {
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
			$this->load->model('ImportExcelFilesModel');
			$data['tables'] = $this->ImportExcelFilesModel->getDatabaseTables();
			$data['result'] = "";	
			$this->load->view('ImportExcelFiles_View',$data);	
		}
	
		//uploads excel data into database
		function importExcel() {
			$this->load->model('ImportExcelFilesModel');
			
			if(isset($_POST['submit'])) {
				$file = $_FILES['file']['tmp_name'];
				$handle = fopen($file,'r');
				$c = 0;
				while(($filepos = fgetcsv($handle,1000,','))!==false) {
					$filepos = array_map("utf8_encode",$filepos);
					if($c>0) {
						$this->load->ImportExcelFilesModel->insertExcelData($filepos);
					}
					$c = $c + 1;
				}
				echo "<script>alert('File Imported Successfully')</script>";
			}
		}	

		function displaySampleTable($viewTable) {
			$this->load->model('ImportExcelFilesModel');
			$data['result'] = $this->ImportExcelFilesModel->fetchSampleTableData($viewTable);
			$data['tables'] = $this->ImportExcelFilesModel->getDatabaseTables();
			$table = $data['result'];
			// echo json_encode($table);
			$this->load->view('csv_import',$data);	
		}	
	}

?>
