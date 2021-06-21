<?php
class ImportExcelFilesModel extends CI_Model {
	
    function __construct() {
        parent::__construct();
    }

	function getDatabaseTables() {
        $sql = "
                SELECT t.TABLE_NAME AS myTables
                FROM INFORMATION_SCHEMA.TABLES AS t
                WHERE t.TABLE_SCHEMA = 'apmc_00002'; 
        ";
        $tables=$this->db->query($sql)->result_array(); 
        return $tables;
    }

    function fetchSampleTableData($tablename) {
        $sql = "
                Select * from $tablename
                limit 1;
        ";
        $result=$this->db->query($sql)->result_array(); 
        return $result;
    }
	
	function insertExcelData($data) {
        $exceldata = array(
            "name" => $data[0],
            "email" => $data[1],
        );
        $this->db->insert("excel_Test",$exceldata);
    }

}
