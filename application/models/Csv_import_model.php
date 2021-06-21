<?php
class Csv_import_model extends CI_Model {
	
    function __construct() {
        parent::__construct();
    }

    //fetches all table names from database
	function getDatabaseTables() {
        $sql = "
                SELECT t.TABLE_NAME AS myTables
                FROM INFORMATION_SCHEMA.TABLES AS t
                WHERE t.TABLE_SCHEMA = 'apmc_00002'; 
        ";
        $tables=$this->db->query($sql)->result_array(); 
        return $tables;
    }

    //fetches sample data for each table from database
    function fetchSampleTableData($tablename) {
        $sql = "
                Select * from $tablename
                limit 1;
        ";
        $result=$this->db->query($sql)->result_array(); 
        return $result;
    }
	
    //uploads excel file data into database
	function insertExcelData($data) {
        $exceldata = array(
            "name" => $data[0],
            "email" => $data[1],
        );
        $this->db->insert("excel_Test",$exceldata);
    }

}
