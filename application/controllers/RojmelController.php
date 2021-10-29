
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class RojmelController extends CI_Controller
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

  //Grid to show all entries
  public function rojshow()
  {
    if ($this->input->post('submit') != NULL) {
      $postData = $this->input->post();

      // Read POST data
      $fromYear = $postData['fromYear'];
      $toYear = $postData['toYear'];


      $this->load->model('RojmelModel');
      $data['Item_List'] = $this->RojmelModel->get_detailsFilter($fromYear, $toYear);

      $this->load->view('menu_1');
      $this->load->view('RojmelGrid', $data);
    } else {
      $this->load->model('RojmelModel');
      $data['Item_List'] = $this->RojmelModel->get_details();

      $this->load->view('menu_1.php');
      $this->load->view('RojmelGrid', $data);
    }
  }

  //for insert rojmel entries
  public function rojInsert()
  {

    $id = $this->input->post('IDNumber');

    $this->load->model('RojmelModel');
    $data['maxid'] = $this->RojmelModel->getDocno();

    $WorkYear = $this->session->userdata('WorkYear');
    $this->load->model('RojmelModel');
    $data['BookList'] = $this->RojmelModel->Get_Book_List();
    $data['ACList'] = $this->RojmelModel->Get_Account_List();


    $this->load->view('rojmel', $data);
  }

  //Edit Rojmel Entries
  public function EditTry($id)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $this->load->model('RojmelModel');
    $result1 = $this->RojmelModel->getid($id);
    $mid = $result1[0]->DocNo;
    $data['BookList'] = $this->RojmelModel->Get_Book_List();
    $data['ACList'] = $this->RojmelModel->Get_Account_List();
    $data['Rojdata'] = $this->RojmelModel->get_edit_details($mid);
    $data['Users'] = $this->RojmelModel->get_add_entries($mid);
    $data['bal'] = $this->RojmelModel->get_Balance($id);

    $this->load->view('rojmeledit', $data);
  }

  //To show closing balance using the account code
  public function getClosingBal($code)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $this->load->model('RojmelModel');
    $data = $this->RojmelModel->get_Balance_via_Code($code);

    echo json_encode($data);
    // die;
  }

  //Delete Rojmel Entries 
  public function DeleteRojmel($id)
  {
    $this->load->model('RojmelModel');

    $result = $this->RojmelModel->getid($id);
    $mid = $result[0]->DocNo;

    $this->db->where('DocNo', $mid);
    $this->db->delete('ACCDetails');

    //   $this->db->where('RefIDNumber', $id);
    //   $this->db->delete('ACCDetails');
    echo "<script> ";
    echo "alert('Rojmel Deleted Succesfully !!' +$id);";
    echo "window.location.href = '" . base_url() . "index.php/RojmelController/rojshow/'";
    echo "</script>";
  }
  // Updated on 8/10/21
  //Edit and update values of the rojmel entries
  public function Update($IDNumber)
  {
    $this->load->model('RojmelModel');

    $CoID = $this->session->userdata('CoID');
    $EntryType = 'ROJ';

    $t = $this->input->post('DRCR');

    if ($t == "DR") {
      $ACCAmount = $this->input->post('Amount1');
    } else {
      $ACCAmount = -$this->input->post('Amount1');
    }
    $WorkYear = $this->session->userdata('WorkYear');

    //  $data = array(
    //'RefIDNumber' => $idnumber,
    $UPid = $this->input->post('UPid');
    //  alert($UPid);
    if ($UPid) {
      $UPid = $this->input->post('UPid');
    } else {
      $UPid = "";
    }
    $BookCode = $this->input->post('BCode');
    $ACCAmount = $ACCAmount;
    $DRCR = $t;
    $ACCODE = $this->input->post('ACCode');
    $ChqNo = $this->input->post('Cheque_No');
    $LotNo = $this->input->post('Lot_No');
    $EntryNo = $this->input->post('IDNumber');
    $Date = $this->input->post('RojDate');
    $CNarration = $this->input->post('CNarration');
    $EntryType = $EntryType;
    $RefIDNo = $this->input->post('RefIDNum');
    $SBillNO = $this->input->post('SBillNO');


    // );
    $data = $this->RojmelModel->update_insert($IDNumber, $UPid, $BookCode, $ACCAmount, $DRCR, $ACCODE, $ChqNo, $LotNo, $EntryNo, $EntryType, $Date, $CNarration, $RefIDNo, $SBillNO);
    echo json_encode($data);
    die;
    // $this->db->where('IDNumber', $UPid);
    // $this->db->update('ACCDetails', $data);
  }

  //insert rojmel entries into the db
  public function InsertTry()
  {
    $this->load->model('RojmelModel');

    $CoID = $this->session->userdata('CoID');
    $EntryType = 'ROJ';

    $t = $this->input->post('DRCR');

    if ($t == "DR") {
      $ACCAmount = $this->input->post('Amount1');
    } else {
      $ACCAmount = - ($this->input->post('Amount1'));
    }
    $WorkYear = $this->session->userdata('WorkYear');

    $data = array(
      //'RefIDNumber' => $idnumber,
      'CoID' => $CoID,
      'WorkYear' => $WorkYear,
      'DocNo' => $this->input->post('IDNumber'),
      'ACCDate' => $this->input->post('RojDate'),
      'BookCode' => $this->input->post('BCode'),
      'ACCAmount' => $ACCAmount,
      'DRCR' => $t,
      'ACCode' => $this->input->post('ACCode'),
      'ChqNo' => $this->input->post('Cheque_No'),
      'LotNo' => $this->input->post('Lot_No'),
      'EntryNo' => $this->input->post('IDNumber'),
      'EntryType' => $EntryType,
      'IndNarration' => $this->input->post('CNarration'),
      'RefIDNo' => $this->input->post('RefIDNum'),
      'BillNo' => $this->input->post('SBillNO')
    );


    $this->db->insert('ACCDetails', $data);

    echo "<script> ";
    echo "window.location.href = '" . base_url() . "index.php/RojmelController/rojshow/'";
    echo "</script>";
  }
  // Updated on 8/10/21 ends

  //Get id number for the new entries by incrementing the id from comp table
  public function GetIDNumber()
  {
    $this->load->model('RojmelModel');
    $data1 = $this->RojmelModel->max_id();
    echo json_encode($data1);
  }

  public function AddedRecord1($Idnumber)
  {
    $this->load->model('RojmelModel');

    $data['Users'] = $this->RojmelModel->get_add_entries($Idnumber);
    echo json_encode($data);
  }

  //Set Amount number into the Amount textbox while editing the entries
  public function UpdateAmount($Idnumber)
  {
    $t = $this->input->post('DRCR');
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "SELECT 
          sum(IF(ACCAmount>0,ACCAmount,0)) as Debit,
          sum(IF(ACCAmount<0,ACCAmount*-1,0)) as Credit
          FROM ACCDetails
          where DocNo='$Idnumber'
          and ACCDetails.CoID = '$CoID'
          and ACCDetails.WorkYear='$WorkYear'          
          ";

    $query = $this->db->query($sql);
    $result = $query->result();
    echo json_encode($result);
  }

  //Edit entry from the grid
  public function UpdateRecord1($Idnumber)
  {
    $this->load->model('RojmelModel');

    $data = $this->RojmelModel->editfromgrid($Idnumber);
    echo json_encode($data);
  }

  //delete whole entries by id number
  public function deleteRecord($Idnumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $arraydelete = array('IDNumber' => $Idnumber, 'CoID' => $CoID, 'WorkYear' => $WorkYear);
    $this->db->where($arraydelete);
    $this->db->delete('ACCDetails');
  }

  //get suggestion for autocomplete (BookCode)
  public function RojmelData($BCode)
  {
    if (empty($BCode)) {
      echo json_encode([]);
      exit;
    }

    $this->load->model('RojmelModel');
    $data = $this->RojmelModel->getRojmelList($BCode);
    echo json_encode($data);
    exit;
  }

  public function GetFilteredDataParty($party)
  {
    $this->load->model('RojmelModel');

    $data['Users'] = $this->RojmelModel->GetModaldataParty($party);
    echo json_encode($data);
  }


  //get suggestion for autocomplete (Account Code)
  public function RojmelAccountData($ACCode)
  {
    if (empty($ACCode)) {
      echo json_encode([]);
      exit;
    }

    $this->load->model('RojmelModel');
    $data = $this->RojmelModel->getRojmelAccountList($ACCode);
    echo json_encode($data);
    exit;
  }


  public function PrintRoj($id)
  {
    $this->load->model('RojmelModel');
    $data['Party'] = $this->RojmelModel->party_det($id);
    $data['Comp'] = $this->RojmelModel->get_company();
    $data['BankDet'] = $this->RojmelModel->getBank($id);
    $party = $data['Party'];
    $ACCAmount = $party[0]->ACCAmount;
    $rwords =  $this->convert_number($ACCAmount);

    $data["rwords"] = $rwords;

    $this->load->view('RojRTGS', $data);
  }
  public function convert_number($number)
  {
    // $number = 226545129.11;
    $no = intval($number);
    $point = round($number - $no, 2) * 100;
    //           echo $no, " ", $point ;
    //           exit ;

    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
      '0' => '', '1' => 'One', '2' => 'Two',
      '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
      '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
      '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
      '13' => 'Thirteen', '14' => 'Fourteen',
      '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
      '18' => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty',
      '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
      '60' => 'Sixty', '70' => 'Seventy',
      '80' => 'Eighty', '90' => 'Ninety'
    );
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');

    while ($i < $digits_1) {
      $divider = ($i == 2) ? 10 : 100;
      $number = floor($no % $divider);
      $no = floor($no / $divider);
      $i += ($divider == 10) ? 1 : 2;
      if ($number) {
        //                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $plural = (($counter = count($str)) && $number > 9) ? ' ' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str[] = ($number < 21) ? $words[$number] .
          " " . $digits[$counter] . $plural . " " . $hundred
          :
          $words[floor($number / 10) * 10]
          . " " . $words[$number % 10] . " "
          . $digits[$counter] . $plural . " " . $hundred;
      } else
        $str[] = null;
    }
    $str = array_reverse($str);
    $result = implode('', $str);

    if ($point > 0) {
      $points = ($point) ?
        " and " . $words[$point / 10] . " " .
        $words[$point = $point % 10] : '';
      $points = $points . " Paise ";
    } else
      $points = '';
    //         echo $result . $points . "Only  " ;
    return $result . $points . "Only  ";
  }
}

?>