
<?php
// $image_path = realpath(BASEPATH . '../uploads');
if (!defined('BASEPATH')) exit('No direct script access allowed');

class CompanyMasterModel extends CI_Model
{
  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  function get_comp_data()
  {
    $sql = "
                select Company.CoID, Company.CoName, CompData.WorkYear
                  from Company, CompData
                 where Company.CoID = CompData.COID
                 order by WorkYear DESC
             ";

    $query = $this->db->query($sql);
    $result = $query->result();

    return $result;
  }

  function get_details()
  {
    $this->db->select('CoID');
    $this->db->select('CoName');
    $this->db->select('COStatus');
    $this->db->select('Priority');
    $this->db->select('Address1');
    $this->db->select('Address2');
    $this->db->select('Address3');

    $this->db->from('Company');

    $query = $this->db->get();

    $result = $query->result();
    return $result;
  }


  // function get_details2()
  // {
  //   // $this->db->select('COID');
  //   // $this->db->select('WorkYear');
  //   $this->db->select('FirmAddress1');
  //   $this->db->select('FirmAddress2');
  //   $this->db->select('FirmAddress3');
  //   $this->db->select('FirmAddress4');
  //   $this->db->select('FirmAddress5');
  //   $this->db->select('FirmPinCode');
  //   $this->db->select('FirmStateCode');
  //   $this->db->select('FirmStateName');
  //   $this->db->select('FirmPhoneNo');
  //   $this->db->select('FirmEmailID');
  //   $this->db->select('FirmAltPhoneNo');
  //   $this->db->select('FirmAltEmailID');
  //   $this->db->select('PersName');
  //   $this->db->select('PersPAN');
  //   $this->db->select('PersDesig');
  //   $this->db->select('PersMobileNo');
  //   $this->db->select('PANNo');
  //   $this->db->select('GSTNo');
  //   $this->db->select('TANNo');
  //   $this->db->select('TDSCircle');
  //   $this->db->select('TANAddress');
  //   $this->db->select('TANCity');
  //   $this->db->select('TANPin');
  //   $this->db->select('DeducteeType');
  //   $this->db->select('Qtr1RCTNo');
  //   $this->db->select('Qtr2RCTNo');
  //   $this->db->select('Qtr3RCTNo');
  //   $this->db->select('Qtr4RCTNo');
  //   $this->db->select('BranchDiv');
  //   $this->db->select('SoftDev');

  //   $this->db->from('CompData');

  //   $query = $this->db->get();

  //   $result = $query->result();
  //   return $result;
  // }



  function get_item_record($compid)
  {
    $this->db->select('CoID');
    $this->db->select('CoName');
    $this->db->select('COStatus');
    $this->db->select('Priority');
    $this->db->select('Address1');
    $this->db->select('Address2');
    $this->db->select('Address3');
    $this->db->select('BankName');
    $this->db->select('BankBranch');
    $this->db->select('BankAccount');
    $this->db->select('BankIFSC');
    $this->db->select('Logo');
    $this->db->from('Company');
    $this->db->where('CoID', $compid);



    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }


  function get_item_records2($compid, $WorkYear)
  {
    $this->db->select('WorkYear');
    $this->db->select('FirmAddress1');
    $this->db->select('FirmAddress2');
    $this->db->select('FirmAddress3');
    $this->db->select('FirmAddress4');
    $this->db->select('FirmAddress5');
    $this->db->select('FirmPinCode');
    $this->db->select('FirmStateCode');
    $this->db->select('FirmStateName');
    $this->db->select('FirmPhoneNo');
    $this->db->select('FirmEmailID');
    $this->db->select('FirmAltPhoneNo');
    $this->db->select('FirmAltEmailID');
    $this->db->select('PersName');
    $this->db->select('PersPAN');
    $this->db->select('PersDesig');
    $this->db->select('PersMobileNo');
    $this->db->select('PANNo');
    $this->db->select('GSTNo');
    $this->db->select('FSLNo');
    $this->db->select('TANNo');
    $this->db->select('TDSCircle');
    $this->db->select('TANAddress');
    $this->db->select('TANCity');
    $this->db->select('TANPin');
    $this->db->select('DeducteeType');
    // $this->db->select('Qtr1RCTNo');
    // $this->db->select('Qtr2RCTNo');
    // $this->db->select('Qtr3RCTNo');
    // $this->db->select('Qtr4RCTNo');
    // $this->db->select('BranchDiv');
    // $this->db->select('SoftDev');

    $this->db->from('CompData');
    $this->db->where("CoID= '$compid' and WorkYear='$WorkYear'");

    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }
}
