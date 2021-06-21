<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class GaruPaymentController extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->database();
    $this->load->helper('html');
    $this->load->library('form_validation');
   
    $this->load->helper('date');
  }

    // Get Data based on RefID
    public function GetRefIdData(){
      $Refid = $this->input->post('Refid');
      $payDate = $this->input->post('payDate');

      $this->load->model('GaruPaymentModel');
      $result = $this->GaruPaymentModel->GetRefIdData($Refid,$payDate);

      if($result == null){
        echo json_encode('ERROR');
      }
      else{
      echo json_encode($result);
      }
    }

    public function garuPaymentRTGS($id)
    {
        $this->load->model('GaruPaymentModel');
        $data['Party'] = $this->GaruPaymentModel->get_RTGS_details($id);
        $data['BankDet'] = $this->GaruPaymentModel->get_RTGS_BankDet($id);
        $data['Comp'] = $this->GaruPaymentModel->get_RTGScompany();

        $Party = $data["Party"];
        $TotalAmount = $Party[0]->TotalChequeAmt;
        $rwords =  $this->convert_number($TotalAmount);
        $data["rwords"] = $rwords;
    
        $this->load->view('Rtgs_view', $data);
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
  
  
  

  // Garu Payment Grid
  public function showGrid(){
    if($this->input->post('submit') != NULL ){
      $postData = $this->input->post();
  
      // Read POST data
      $fromYear = $postData['fromYear'];
      $toYear = $postData['toYear'];
      

      $this->load->model('GaruPaymentModel');
      $data['Grid'] = $this->GaruPaymentModel->GetGridDataFilter($fromYear,$toYear);

      $this->load->view('menu_1');
      $this->load->view('GaruPaymentGrid_view',$data);
    }
    else{
      $this->load->model('GaruPaymentModel');
      $data['Grid'] = $this->GaruPaymentModel->GetGridData();
      $this->load->view('menu_1.php');
      $this->load->view('GaruPaymentGrid_view',$data);
    }
  }

  // Garu Payment Insert View
  public function show(){
    $this->load->model('GaruPaymentModel');
    // $data['PVId'] = $this->GaruPaymentModel->GetNextPVId();
    $data['PVId'] = $this->GaruPaymentModel->GetId();
    $data['CurrentId'] = $this->GaruPaymentModel->GetNextId();
    $data['BankList'] = $this->GaruPaymentModel->Get_BankCode_List();
    $data['CashList'] = $this->GaruPaymentModel->Get_CashCode_List();

    $this->load->view('garuPayment_view',$data);
    // $this->load->view('NewGaruPaymentView',$data);
  }

  // Get max IDNumber from Garu Payment 
  public function GetIDNumber(){
    $this->load->model('GaruPaymentModel');
    $data = $this->GaruPaymentModel->GetNextId();
    echo json_encode($data);
  }

  public function GetFilteredData(){
    $BrokerCode = $this->input->post('BrokerCode');
    $PartyCode = $this->input->post('PartyCode');
    $payDate = $this->input->post('payDate');

    $this->load->model('GaruPaymentModel');
    $data['Users'] = $this->GaruPaymentModel->GetModaldata($PartyCode,$BrokerCode,$payDate);
    echo json_encode($data);
  }

  // Insert Data in Garu Payment
  public function InsertGaruPayment($Refid, $Idnumber,$BillNo,$Billdate){  
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    $BillDate = date("Y-m-d", strtotime($Billdate));

    // Insert in Garu Payment Table
    $VatavAmt = $this->input->post('VatavAmount');
    $BrokAmt = $this->input->post('BrokAmount');
    $IntAmt = $this->input->post('IntrestAmount');
    $WgtShort= $this->input->post('Wgtshort');
    $QualityDiffAmt = $this->input->post('QualityAmount');

    $ChequeAmounts = $this->input->post('Cheqamount');
    $CashAmount = $this->input->post('CashAmount');
    $Kasar = $this->input->post('Kasar');


    $ChqCashKasarAmt =  (float)$ChequeAmounts + (float)$CashAmount + (float)$Kasar;
    $VatBrokWgtQdiffAmt = (float)$VatavAmt + (float)$BrokAmt + (float)$WgtShort + (float)$QualityDiffAmt;

    $TotalPay = (float)$ChqCashKasarAmt +  (float)$VatBrokWgtQdiffAmt - (float)$IntAmt;

    $data = array(
      'WorkYear'=> $this->session->userdata('WorkYear'),
      'CoID' => $this->session->userdata('CoID'),
      'PvNumber'=> $this->input->post('Idnumber'), 
      'PaymentDate'=> $this->input->post('paymentDate'),
      'PartyCode'=> $this->input->post('PartyCode1'),
      'BillNo' => $BillNo,
      'BillDate' => $BillDate,
      'RefIDNumber' => $this->input->post('Refid'),
      'Days' => $this->input->post('days'),
      'DiscPerc' => $this->input->post('Vatav'),
      'VatavAmt'=> $this->input->post('VatavAmount'),
      'BrokRate'=> $this->input->post('Brokper'),
      'BrokAmt'=> $this->input->post('BrokAmount'),
      'IntRate'=> $this->input->post('IntrestPer'),
      'IntAmt'=> $this->input->post('IntrestAmount'),
      'WgtShort'=> $this->input->post('Wgtshort'),
      'QualityDiffRate'=> $this->input->post('QualityrPer'),
      'QualityDiffAmt'=> $this->input->post('QualityAmount'),
      'ChequeAmt'=> $this->input->post('Cheqamount'),
      'CashAmt'=> $this->input->post('CashAmount'),
      'KasarAmt'=> $this->input->post('Kasar'),
      'TotalPay'=>$TotalPay
    );

    $this->db->insert('PurPayments', $data);

    // Update PurHeader Table
    $sql= "SELECT NetPayable,TotalPaid,BalanceDue  
            from PurHeader 
            where RefIDNumber = '$Refid'
            AND CoID ='$CoID'
            AND WorkYear = '$WorkYear'
      ";
    $query = $this->db->query($sql);
    $Result = $query->result();

    $PrvBal = $Result[0]->BalanceDue;

    $NewBal = (float)$PrvBal - (float)$TotalPay;

    $totalPaySql= "select SUM(TotalPay) as TotalPaid 
                  from PurPayments
                  WHERE RefIDNumber = '$Refid'
                  AND CoID ='$CoID'
                  AND WorkYear = '$WorkYear'
    ";

    $totalPayQuery = $this->db->query($totalPaySql);
    $totalPayResult = $totalPayQuery->result();
              

    $AmtSettled = $totalPayResult[0]->TotalPaid;

    $data2= array(
      'TotalPaid'=> $AmtSettled,
      'BalanceDue'=> $NewBal,
    );
    $this->db->where('RefIDNumber', $Refid);
    $this->db->where('CoID', $CoID);
    $this->db->where('WorkYear', $WorkYear);
    $this->db->update('PurHeader', $data2);


    $paymentHeaderSql= "SELECT 
                IDNumber,
                TotalPaid,
                BalanceDue 
            FROM PurHeader 
            where RefIDNumber = '$Refid'
            AND CoID ='$CoID'
            AND WorkYear = '$WorkYear'
    ";

    $paymentHeaderQuery = $this->db->query($paymentHeaderSql);
    $output = $paymentHeaderQuery->result();

    echo json_encode($output);    
  }

  // Get Details along with Max IDNumber from Garu Payment 
  function getDetails(){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 
      
    $getID = "select *
                  FROM PurPayments
                  where CoID ='$CoID' 
                  and WorkYear='$WorkYear'
                  and IDNumber IN (select max(IDNumber) FROM PurPayments
                  where CoID ='$CoID' 
                  and WorkYear='$WorkYear')";

          $queryId = $this->db->query($getID);
          $output = $queryId->result();

          echo json_encode($output);
  }

  // Get Payment Details from Garu Payment
  public function AddedRecord1($PVIdnumber){
    $this->load->model('GaruPaymentModel');
    $data['Users'] = $this->GaruPaymentModel->GetTabledata($PVIdnumber);
    echo json_encode($data);
  }


  // Get particular PvNumber data from Garu Payment
  public function getPvNumData($PvNumber){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    $sql= "select * 
            from PurPayments 
            where PvNumber ='$PvNumber' 
              AND CoID ='$CoID'
              AND WorkYear = '$WorkYear'";
    $query = $this->db->query($sql);
    $result['Users'] = $query->result();

    echo json_encode($result);
  }

  // Get payment details
  public function UpdateRecord1($Idnumber){ 
    $this->load->model('GaruPaymentModel');
    $data = $this->GaruPaymentModel->GetTabledata1($Idnumber);
    echo json_encode($data);
  }

  // Update Garu Payment Details based on IDNumber from Garu Payment Insert View 
  function garuPaymentUpdate($Refid,$IDNumber){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    $Billdate= $this->input->post('Billdate');
    $BillDate = date("Y-m-d", strtotime($Billdate));
    
    $VatavAmount = $this->input->post('VatavAmount');
    $BrokAmount = $this->input->post('BrokAmount');
    $IntrestAmount = $this->input->post('IntrestAmount');
    $Wgtshort = $this->input->post('Wgtshort');
    $QualityAmount = $this->input->post('QualityAmount');
    $ChequeAmounts = $this->input->post('Cheqamount');
    $CashAmount =  $this->input->post('CashAmount');
    $Kasar = $this->input->post('Kasar');

    $ChqCashKasarAmt =  (float)$ChequeAmounts + (float)$CashAmount + (float)$Kasar;
    $VatBrokWgtQdiffAmt = (float)$VatavAmount + (float)$BrokAmount + (float)$Wgtshort + (float)$QualityAmount;

    $TotalPay = (float)$ChqCashKasarAmt +  (float)$VatBrokWgtQdiffAmt - (float)$IntrestAmount;

    $data = array(
      'WorkYear'=> $WorkYear,
      'CoID' => $CoID, 
      'PvNumber'=> $this->input->post('PVnumber'), 
      'PaymentDate'=> $this->input->post('paymentDate'),
      'PartyCode'=> $this->input->post('PartyCode1'),
      'BillNo'=> $this->input->post('Billno'),
      'BillDate'=> $BillDate,
      'RefIDNumber' => $this->input->post('Refid'),
      'Days' => $this->input->post('days'),
      'DiscPerc' => $this->input->post('Vatav'),
      'VatavAmt'=> $this->input->post('VatavAmount'),
      'BrokRate'=> $this->input->post('Brokper'),
      'BrokAmt'=> $this->input->post('BrokAmount'),
      'IntRate'=> $this->input->post('IntrestPer'),
      'IntAmt'=> $this->input->post('IntrestAmount'),
      'WgtShort'=> $this->input->post('Wgtshort'),
      'QualityDiffRate'=> $this->input->post('QualityrPer'),
      'QualityDiffAmt'=> $this->input->post('QualityAmount'),
      'ChequeAmt'=> $this->input->post('Cheqamount'),
      'CashAmt'=> $this->input->post('CashAmount'),
      'KasarAmt'=> $this->input->post('Kasar'),
      'TotalPay'=>$TotalPay
    );

    $array = array('IDNumber' => $IDNumber, 'CoID' => $CoID, 'WorkYear' => $WorkYear);
    $this->db->where($array); 
    $this->db->update('PurPayments', $data);


    // Update Pur payment TotalCheque and Total Cash based on PvNumber and Min IdNumber
    $PVnumber = $this->input->post('PVnumber');

    $sql= "SELECT min(IdNumber) as IdNumber
                    FROM PurPayments
                    where CoID  = '$CoID'
                    and WorkYear = '$WorkYear'
                    and PvNumber = '$PVnumber'
    ";
    $query = $this->db->query($sql);
    $result = $query->result();

    $minIdNumber = $result[0]->IdNumber;


    $getCashBankTotal= "SELECT Sum(ChequeAmt) as TotalChqAmt,SUM(CashAmt) as TotalCashAmt
                    FROM PurPayments
                    where CoID  = '$CoID'
                    and WorkYear = '$WorkYear'
                    and PvNumber = '$PVnumber'
    ";
    $queryCashBankTotal = $this->db->query($getCashBankTotal);
    $cashBankTotal = $queryCashBankTotal->result();

    $TotalChequeAmt = $cashBankTotal[0]->TotalChqAmt;
    $TotalCashAmt = $cashBankTotal[0]->TotalCashAmt;
 
    $updatedBankDetails = array(
      'TotalChequeAmt' => $TotalChequeAmt,
      'TotalCashAmt'=> $TotalCashAmt
    );

    $arrayPurPayment = array('PvNumber'=> $PVnumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear,'IdNumber'=>$minIdNumber);
    $this->db->where($arrayPurPayment);
    $this->db->update('PurPayments', $updatedBankDetails);


    // Update Purchase Header
    // Previous Inserted Values
    $VatavAmtHidden = $this->input->post('VatavAmtHidden');
    $brokerAmtHidden = $this->input->post('brokerAmtHidden');
    $interestAmtHidden = $this->input->post('interestAmtHidden');
    $wgtShortHidden = $this->input->post('wgtShortHidden');
    $diffPerAmtHidden = $this->input->post('diffPerAmtHidden');
    $ChqAmtHidden = $this->input->post('ChqAmtHidden');
    $CashAmtHidden = $this->input->post('CashAmtHidden');
    $KasarAmtHidden = $this->input->post('KasarAmtHidden');

    $ChqCashKasarAmtHidden =  (float)$ChqAmtHidden + (float)$CashAmtHidden + (float)$KasarAmtHidden;
    $VatBrokWgtQdiffAmtHidden = (float)$VatavAmtHidden + (float)$brokerAmtHidden + (float)$wgtShortHidden + (float)$diffPerAmtHidden;

    $TotalPayHidden = (float)$ChqCashKasarAmtHidden + (float)$VatBrokWgtQdiffAmtHidden - (float)$interestAmtHidden;
    
    // New Total Pay - Previous Total Pay
    $NewTotalPay = (float)$TotalPay - (float)$TotalPayHidden;

    $this->load->model('GaruPaymentModel');
    $Result = $this->GaruPaymentModel->GetRefHeader($Refid);
    $BalanceDue = $Result[0]->BalanceDue;


    $NewBalanceDue = (float)$BalanceDue - (float)$NewTotalPay;

    $totalPaySql= "select SUM(TotalPay) as TotalPaid 
                  from PurPayments
                  WHERE RefIDNumber = '$Refid'
                  AND CoID ='$CoID'
                  AND WorkYear = '$WorkYear'
    ";

    $totalPayQuery = $this->db->query($totalPaySql);
    $totalPayResult = $totalPayQuery->result();
              

    $AmtSettled = $totalPayResult[0]->TotalPaid;

    $data2= array(
      'TotalPaid'=> $AmtSettled,
      'BalanceDue'=> $NewBalanceDue,
    );
    
    $arrayPurHeader = array('RefIDNumber' => $Refid,'CoID' => $CoID, 'WorkYear' => $WorkYear);
    $this->db->where($arrayPurHeader);
    $this->db->update('PurHeader', $data2);

    echo json_encode(array("status" => TRUE));    
  }

  // Delete Garu Payment Details based on IDNumber from Garu Payment Insert View (Deletes Single Record)
  public function xgaruPaymentInsertDeleteRecord($Idnumber){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    $PVnumber = $this->input->post('Idnumber');

    $this->load->model('GaruPaymentModel');
   
    // Get Details from Garu Payment Table
    $data['payment'] = $this->GaruPaymentModel->GetTabledata1($Idnumber);
    $paymentDetails =  $data['payment'];
    $refID = $paymentDetails[0]->RefIDNumber;
    $TotalPay = $paymentDetails[0]->TotalPay;

    // Get Details from Garu Purchase Table
    $Result = $this->GaruPaymentModel->GetRefHeader($refID);
    $TotalPay = $Result[0]->TotalPaid;
    $BalanceDue = $Result[0]->BalanceDue;     
    
    $NewBalanceDue = (float)$BalanceDue + (float)$TotalPay;

    $totalPaySql= "select SUM(TotalPay) as TotalPaid 
                  from PurPayments
                  WHERE RefIDNumber = '$refID'
                  AND CoID ='$CoID'
                  AND WorkYear = '$WorkYear'
    ";

    $totalPayQuery = $this->db->query($totalPaySql);
    $totalPayResult = $totalPayQuery->result();
              

    $AmtSettled = $totalPayResult[0]->TotalPaid;

    $data2= array(
      'TotalPaid'=> $AmtSettled,
      'BalanceDue'=> $NewBalanceDue,
    );
          
    $arrayPurHeader = array('RefIDNumber'=> $refID,'CoID'=> $CoID,'WorkYear'=> $WorkYear);
    $this->db->where($arrayPurHeader);
    $this->db->update('PurHeader', $data2);


    $arrayPurPayment = array('IDNumber'=> $Idnumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear);
    $this->db->where($arrayPurPayment);
    $this->db->delete('PurPayments'); 
  

    // Update PurPayment TotalCheque and Total Cash based on PvNumber and Min IdNumber
    $sql= "SELECT min(IdNumber) as IdNumber
                    FROM PurPayments
                    where CoID  = '$CoID'
                    and WorkYear = '$WorkYear'
                    and PvNumber = '$PVnumber'
    ";
    $query = $this->db->query($sql);
    $result = $query->result();

    $minIdNumber = $result[0]->IdNumber;
      
    $getCashBankTotal= "SELECT Sum(ChequeAmt) as TotalChqAmt,SUM(CashAmt) as TotalCashAmt
                    FROM PurPayments
                    where CoID  = '$CoID'
                    and WorkYear = '$WorkYear'
                    and PvNumber = '$PVnumber'
    ";
    $queryCashBankTotal = $this->db->query($getCashBankTotal);
    $cashBankTotal = $queryCashBankTotal->result();

    $TotalChequeAmt = $cashBankTotal[0]->TotalChqAmt;
    $TotalCashAmt = $cashBankTotal[0]->TotalCashAmt;

    $updatedBankDetails = array(
      'TotalChequeAmt' => $TotalChequeAmt,
      'TotalCashAmt'=> $TotalCashAmt
    );

    $arrayPurPayment = array('PvNumber'=> $PVnumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear,'IdNumber'=>$minIdNumber);
    $this->db->where($arrayPurPayment);
    $this->db->update('PurPayments', $updatedBankDetails);
  }

  // 150321
  // Delete Garu Payment Details based on IDNumber from Garu Payment Insert View (Deletes Single Record)
  public function garuPaymentInsertDeleteRecord($Idnumber){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    $PVnumber = $this->input->post('Idnumber');

    // Get min IdNumber
    $sql= "SELECT min(IdNumber) as IdNumber
                    FROM PurPayments
                    where CoID  = '$CoID'
                    and WorkYear = '$WorkYear'
                    and PvNumber = '$PVnumber'
    ";
    $query = $this->db->query($sql);
    $result = $query->result();

    $minIdNumber = $result[0]->IdNumber;

    if($Idnumber == $minIdNumber){
          $sql= "SELECT TotalChequeAmt,TotalCashAmt,BankCode,CashCode,BankComm,ChequeNo,RTGS 
                  FROM PurPayments
                  where CoID  = '$CoID'
                  and WorkYear = '$WorkYear'
                  and PvNumber = '$PVnumber'
                  and IDNumber = '$Idnumber'
          ";

          $query = $this->db->query($sql);
          $result = $query->result();

          $TotalChequeAmt = $result[0]->TotalChequeAmt;
          $TotalCashAmt = $result[0]->TotalCashAmt;
          $BankCode = $result[0]->BankCode;
          $CashCode = $result[0]->CashCode;
          $BankComm = $result[0]->BankComm;
          $ChequeNo = $result[0]->ChequeNo;
          $RTGS = $result[0]->RTGS;

          $this->load->model('GaruPaymentModel');
      
          // Get Details from Garu Payment Table
          $data['payment'] = $this->GaruPaymentModel->GetTabledata1($Idnumber);
          $paymentDetails =  $data['payment'];
          $refID = $paymentDetails[0]->RefIDNumber;
          $TotalPay = $paymentDetails[0]->TotalPay;


          // Get Details from Garu Purchase Table
          $Result = $this->GaruPaymentModel->GetRefHeader($refID);
          // $TotalPay = $Result[0]->TotalPaid;
          $BalanceDue = $Result[0]->BalanceDue;     
          
          $NewBalanceDue = (float)$BalanceDue + (float)$TotalPay;

          $arrayPurPayment = array('IDNumber'=> $Idnumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear);
          $this->db->where($arrayPurPayment);
          $this->db->delete('PurPayments'); 

          $sql= "SELECT min(IdNumber) as IdNumber
                        FROM PurPayments
                        where CoID  = '$CoID'
                        and WorkYear = '$WorkYear'
                        and PvNumber = '$PVnumber'
          ";
          $query = $this->db->query($sql);
          $result = $query->result();

          $minIdNumber = $result[0]->IdNumber;

          // Update Bank Details in Next min IdNumber
          $updatedBankDetails = array(
            'TotalChequeAmt' => $TotalChequeAmt,
            'TotalCashAmt'=> $TotalCashAmt,
            'BankCode' => $BankCode,
            'CashCode' => $CashCode,
            'BankComm' => $BankComm,
            'ChequeNo' => $ChequeNo,
            'RTGS' => $RTGS
          );

          $updatePurPayment = array('IDNumber'=> $minIdNumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear,'PvNumber'=>$PVnumber);
          $this->db->where($updatePurPayment);
          $this->db->update('PurPayments',$updatedBankDetails); 

          $totalPaySql= "select SUM(TotalPay) as TotalPaid 
                  from PurPayments
                  WHERE RefIDNumber = '$refID'
                  and CoID  = '$CoID'
                  and WorkYear = '$WorkYear'
          ";

          $totalPayQuery = $this->db->query($totalPaySql);
          $totalPayResult = $totalPayQuery->result();
                    

          $AmtSettled = $totalPayResult[0]->TotalPaid;

          $data2= array(
            'TotalPaid'=> $AmtSettled,
            'BalanceDue'=> $NewBalanceDue,
          );
                
          $arrayPurHeader = array('RefIDNumber'=> $refID,'CoID'=> $CoID,'WorkYear'=> $WorkYear);
          $this->db->where($arrayPurHeader);
          $this->db->update('PurHeader', $data2);
        

          // Update PurPayment TotalCheque and Total Cash based on PvNumber and Min IdNumber
          $sql= "SELECT min(IdNumber) as IdNumber
                          FROM PurPayments
                          where CoID  = '$CoID'
                          and WorkYear = '$WorkYear'
                          and PvNumber = '$PVnumber'
          ";
          $query = $this->db->query($sql);
          $result = $query->result();

          $minIdNumber = $result[0]->IdNumber;
            
          $getCashBankTotal= "SELECT Sum(ChequeAmt) as TotalChqAmt,SUM(CashAmt) as TotalCashAmt
                          FROM PurPayments
                          where CoID  = '$CoID'
                          and WorkYear = '$WorkYear'
                          and PvNumber = '$PVnumber'
          ";
          $queryCashBankTotal = $this->db->query($getCashBankTotal);
          $cashBankTotal = $queryCashBankTotal->result();

          $TotalChequeAmt = $cashBankTotal[0]->TotalChqAmt;
          $TotalCashAmt = $cashBankTotal[0]->TotalCashAmt;

          $updatedBankDetails = array(
            'TotalChequeAmt' => $TotalChequeAmt,
            'TotalCashAmt'=> $TotalCashAmt
          );

          $arrayPurPayment = array('PvNumber'=> $PVnumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear,'IdNumber'=>$minIdNumber);
          $this->db->where($arrayPurPayment);
          $this->db->update('PurPayments', $updatedBankDetails);
    }

    else{
          $this->load->model('GaruPaymentModel');
        
          // Get Details from Garu Payment Table
          $data['payment'] = $this->GaruPaymentModel->GetTabledata1($Idnumber);
          $paymentDetails =  $data['payment'];
          $refID = $paymentDetails[0]->RefIDNumber;
          $TotalPay = $paymentDetails[0]->TotalPay;


          // Get Details from Garu Purchase Table
          $Result = $this->GaruPaymentModel->GetRefHeader($refID);
          // $TotalPay = $Result[0]->TotalPaid;
          $BalanceDue = $Result[0]->BalanceDue;     
          
          $NewBalanceDue = (float)$BalanceDue + (float)$TotalPay;

          $arrayPurPayment = array('IDNumber'=> $Idnumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear);
          $this->db->where($arrayPurPayment);
          $this->db->delete('PurPayments'); 

          $totalPaySql= "select SUM(TotalPay) as TotalPaid 
                        from PurPayments
                        WHERE RefIDNumber = '$refID'
                        and CoID  = '$CoID'
                        and WorkYear = '$WorkYear'
          ";

          $totalPayQuery = $this->db->query($totalPaySql);
          $totalPayResult = $totalPayQuery->result();
                    

          $AmtSettled = $totalPayResult[0]->TotalPaid;

          $data2= array(
            'TotalPaid'=> $AmtSettled,
            'BalanceDue'=> $NewBalanceDue,
          );
                
          $arrayPurHeader = array('RefIDNumber'=> $refID,'CoID'=> $CoID,'WorkYear'=> $WorkYear);
          $this->db->where($arrayPurHeader);
          $this->db->update('PurHeader', $data2);
        

          // Update PurPayment TotalCheque and Total Cash based on PvNumber and Min IdNumber
          $sql= "SELECT min(IdNumber) as IdNumber
                          FROM PurPayments
                          where CoID  = '$CoID'
                          and WorkYear = '$WorkYear'
                          and PvNumber = '$PVnumber'
          ";
          $query = $this->db->query($sql);
          $result = $query->result();

          $minIdNumber = $result[0]->IdNumber;
            
          $getCashBankTotal= "SELECT Sum(ChequeAmt) as TotalChqAmt,SUM(CashAmt) as TotalCashAmt
                          FROM PurPayments
                          where CoID  = '$CoID'
                          and WorkYear = '$WorkYear'
                          and PvNumber = '$PVnumber'
          ";
          $queryCashBankTotal = $this->db->query($getCashBankTotal);
          $cashBankTotal = $queryCashBankTotal->result();

          $TotalChequeAmt = $cashBankTotal[0]->TotalChqAmt;
          $TotalCashAmt = $cashBankTotal[0]->TotalCashAmt;

          $updatedBankDetails = array(
            'TotalChequeAmt' => $TotalChequeAmt,
            'TotalCashAmt'=> $TotalCashAmt
          );

          $arrayPurPayment = array('PvNumber'=> $PVnumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear,'IdNumber'=>$minIdNumber);
          $this->db->where($arrayPurPayment);
          $this->db->update('PurPayments', $updatedBankDetails);
    }
  }  

  // Delete Garu Payment Details based on IDNumber from Garu Payment Edit View (Deletes Single Record)
  public function xgaruPaymentDeleteRecord($Idnumber){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    $PVnumber = $this->input->post('Idnumber');

    $this->load->model('GaruPaymentModel');
   
    // Get Details from Garu Payment Table
    $data['payment'] = $this->GaruPaymentModel->GetTabledata1($Idnumber);
    $paymentDetails =  $data['payment'];
    $refID = $paymentDetails[0]->RefIDNumber;
    $TotalPay = $paymentDetails[0]->TotalPay;

    // Get Details from Garu Purchase Table
    $Result = $this->GaruPaymentModel->GetRefHeader($refID);
    $TotalPay = $Result[0]->TotalPaid;
    $BalanceDue = $Result[0]->BalanceDue;     
    
    $NewBalanceDue = (float)$BalanceDue + (float)$TotalPay;

    $totalPaySql= "select SUM(TotalPay) as TotalPaid 
                  from PurPayments
                  WHERE RefIDNumber = '$refID'
                  AND CoID ='$CoID'
                  AND WorkYear = '$WorkYear'
    ";

    $totalPayQuery = $this->db->query($totalPaySql);
    $totalPayResult = $totalPayQuery->result();
              

    $AmtSettled = $totalPayResult[0]->TotalPaid;

    $data2= array(
      'TotalPaid'=> $AmtSettled,
      'BalanceDue'=> $NewBalanceDue,
    );
          
    $arrayPurHeader = array('RefIDNumber'=> $refID,'CoID'=> $CoID,'WorkYear'=> $WorkYear);
    $this->db->where($arrayPurHeader);
    $this->db->update('PurHeader', $data2);


    $arrayPurPayment = array('IDNumber'=> $Idnumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear);
    $this->db->where($arrayPurPayment);
    $this->db->delete('PurPayments'); 
  }

  // 150321
  // Delete Garu Payment Details based on IDNumber from Garu Payment Edit View (Deletes Single Record)
  public function garuPaymentDeleteRecord($Idnumber){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    $PVnumber = $this->input->post('Idnumber');

    // Get min IdNumber
    $sql= "SELECT min(IdNumber) as IdNumber
                    FROM PurPayments
                    where CoID  = '$CoID'
                    and WorkYear = '$WorkYear'
                    and PvNumber = '$PVnumber'
    ";
    $query = $this->db->query($sql);
    $result = $query->result();

    $minIdNumber = $result[0]->IdNumber;

    if($Idnumber == $minIdNumber){
        $sql= "SELECT TotalChequeAmt,TotalCashAmt,BankCode,CashCode,BankComm,ChequeNo,RTGS 
                FROM PurPayments
                where CoID  = '$CoID'
                and WorkYear = '$WorkYear'
                and PvNumber = '$PVnumber'
                and IDNumber = '$Idnumber'
        ";

        $query = $this->db->query($sql);
        $result = $query->result();

        $TotalChequeAmt = $result[0]->TotalChequeAmt;
        $TotalCashAmt = $result[0]->TotalCashAmt;
        $BankCode = $result[0]->BankCode;
        $CashCode = $result[0]->CashCode;
        $BankComm = $result[0]->BankComm;
        $ChequeNo = $result[0]->ChequeNo;
        $RTGS = $result[0]->RTGS;

        $this->load->model('GaruPaymentModel');
    
        // Get Details from Garu Payment Table
        $data['payment'] = $this->GaruPaymentModel->GetTabledata1($Idnumber);
        $paymentDetails =  $data['payment'];
        $refID = $paymentDetails[0]->RefIDNumber;
        $TotalPay = $paymentDetails[0]->TotalPay;


        // Get Details from Garu Purchase Table
        $Result = $this->GaruPaymentModel->GetRefHeader($refID);
        // $TotalPay = $Result[0]->TotalPaid;
        $BalanceDue = $Result[0]->BalanceDue;     
        
        $NewBalanceDue = (float)$BalanceDue + (float)$TotalPay;

        $arrayPurPayment = array('IDNumber'=> $Idnumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear);
        $this->db->where($arrayPurPayment);
        $this->db->delete('PurPayments'); 

        $sql= "SELECT min(IdNumber) as IdNumber
                      FROM PurPayments
                      where CoID  = '$CoID'
                      and WorkYear = '$WorkYear'
                      and PvNumber = '$PVnumber'
        ";
        $query = $this->db->query($sql);
        $result = $query->result();

        $minIdNumber = $result[0]->IdNumber;

        // Update Bank Details in Next min IdNumber
        $updatedBankDetails = array(
          'TotalChequeAmt' => $TotalChequeAmt,
          'TotalCashAmt'=> $TotalCashAmt,
          'BankCode' => $BankCode,
          'CashCode' => $CashCode,
          'BankComm' => $BankComm,
          'ChequeNo' => $ChequeNo,
          'RTGS' => $RTGS
        );

        $updatePurPayment = array('IDNumber'=> $minIdNumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear,'PvNumber'=>$PVnumber);
        $this->db->where($updatePurPayment);
        $this->db->update('PurPayments',$updatedBankDetails); 

        $totalPaySql= "select SUM(TotalPay) as TotalPaid 
                from PurPayments
                WHERE RefIDNumber = '$refID'
                and CoID  = '$CoID'
                and WorkYear = '$WorkYear'
        ";

        $totalPayQuery = $this->db->query($totalPaySql);
        $totalPayResult = $totalPayQuery->result();
                  

        $AmtSettled = $totalPayResult[0]->TotalPaid;

        $data2= array(
          'TotalPaid'=> $AmtSettled,
          'BalanceDue'=> $NewBalanceDue,
        );
              
        $arrayPurHeader = array('RefIDNumber'=> $refID,'CoID'=> $CoID,'WorkYear'=> $WorkYear);
        $this->db->where($arrayPurHeader);
        $this->db->update('PurHeader', $data2);
    }

    else{
      $this->load->model('GaruPaymentModel');
    
      // Get Details from Garu Payment Table
      $data['payment'] = $this->GaruPaymentModel->GetTabledata1($Idnumber);
      $paymentDetails =  $data['payment'];
      $refID = $paymentDetails[0]->RefIDNumber;
      $TotalPay = $paymentDetails[0]->TotalPay;

      // Get Details from Garu Purchase Table
      $Result = $this->GaruPaymentModel->GetRefHeader($refID);
      // $TotalPay = $Result[0]->TotalPaid;
      $BalanceDue = $Result[0]->BalanceDue;     
      
      $NewBalanceDue = (float)$BalanceDue + (float)$TotalPay;

      $arrayPurPayment = array('IDNumber'=> $Idnumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear);
      $this->db->where($arrayPurPayment);
      $this->db->delete('PurPayments'); 

      $totalPaySql= "select SUM(TotalPay) as TotalPaid 
                    from PurPayments
                    WHERE RefIDNumber = '$refID'
                    and CoID  = '$CoID'
                    and WorkYear = '$WorkYear'
      ";

      $totalPayQuery = $this->db->query($totalPaySql);
      $totalPayResult = $totalPayQuery->result();
                

      $AmtSettled = $totalPayResult[0]->TotalPaid;

      $data2= array(
        'TotalPaid'=> $AmtSettled,
        'BalanceDue'=> $NewBalanceDue,
      );
            
      $arrayPurHeader = array('RefIDNumber'=> $refID,'CoID'=> $CoID,'WorkYear'=> $WorkYear);
      $this->db->where($arrayPurHeader);
      $this->db->update('PurHeader', $data2);
    }
  }  

  // Update PurPayment TotalCheque and Total Cash based on PvNumber and Min IdNumber
  public function updateTotalChqCash(){
    $output_str = "";

    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    $PVnumber = $this->input->post('Idnumber');
    $sql= "SELECT min(IdNumber) as IdNumber
                    FROM PurPayments
                    where CoID  = '$CoID'
                    and WorkYear = '$WorkYear'
                    and PvNumber = '$PVnumber'
    ";
    $query = $this->db->query($sql);
    $result = $query->result();

    $id = $result[0]-> IdNumber;

    if($id){
      $minIdNumber = $result[0]->IdNumber;
      
      $getCashBankTotal= "SELECT Sum(ChequeAmt) as TotalChqAmt,SUM(CashAmt) as TotalCashAmt
                      FROM PurPayments
                      where CoID  = '$CoID'
                      and WorkYear = '$WorkYear'
                      and PvNumber = '$PVnumber'
      ";
      $queryCashBankTotal = $this->db->query($getCashBankTotal);
      $cashBankTotal = $queryCashBankTotal->result();

      $TotalChequeAmt = $cashBankTotal[0]->TotalChqAmt;
      $TotalCashAmt = $cashBankTotal[0]->TotalCashAmt;
  
      $updatedBankDetails = array(
        'TotalChequeAmt' => $TotalChequeAmt,
        'TotalCashAmt'=> $TotalCashAmt
      );

      $arrayPurPayment = array('PvNumber'=> $PVnumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear,'IdNumber'=>$minIdNumber);
      $this->db->where($arrayPurPayment);
      $this->db->update('PurPayments', $updatedBankDetails);
      
      $output_str = "Data";
    }
    else{
      $output_str =  "No such IdNumber";
    }
    echo json_encode($output_str);
  }

  // Delete Garu Payment Entry based on PvNumber from Garu Payment Insert View (Deletes Entire Record)
  public function garuPaymentDelete($PvNumber){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    $this->load->model('GaruPaymentModel');
   
    // Get Details from Garu Payment and PurHeader Table
    $data = $this->GaruPaymentModel->GetTotalPaySum($PvNumber);

    for($i = 0 ;$i < count($data) ;$i++){
      echo json_encode($data[$i]);

      $RefIDNumber = $data[$i]->RefIDNumber;
      $TotalPaid = $data[$i]->Total;
      $BalanceDue = $data[$i]->Bal;
    
      $data2= array(
        'TotalPaid'=> $TotalPaid,
        'BalanceDue'=> $BalanceDue,
      );

      // Update PurHeader Table
      $arrayPurHeader = array('RefIDNumber'=> $RefIDNumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear);
      $this->db->where($arrayPurHeader);
      $this->db->update('PurHeader', $data2);
    }
        
    // Delete records from Garu Payment
    $arrayPurPayment = array('PvNumber'=> $PvNumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear);
    $this->db->where($arrayPurPayment);
    $this->db->delete('PurPayments'); 
  }

  // Delete Garu Payment Entry based on PvNumber from Garu Payment Grid View
  public function garuPaymentDeleteGrid($PvNumber){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    $this->load->model('GaruPaymentModel');
   
    // Get Details from Garu Payment and PurHeader Table
    $data = $this->GaruPaymentModel->GetTotalPaySum($PvNumber);

    for($i = 0 ;$i < count($data) ;$i++){
      // echo json_encode($data[$i]);

      $RefIDNumber = $data[$i]->RefIDNumber;
      $TotalPaid = $data[$i]->Total;
      $BalanceDue = $data[$i]->Bal;
    
      $data2= array(
        'TotalPaid'=> $TotalPaid,
        'BalanceDue'=> $BalanceDue,
      );

      // Update PurHeader Table
      $arrayPurHeader = array('RefIDNumber'=> $RefIDNumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear);
      $this->db->where($arrayPurHeader);
      $this->db->update('PurHeader', $data2);
    }
        
    // Delete records from Garu Payment
    $arrayPurPayment = array('PvNumber'=> $PvNumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear);
    $this->db->where($arrayPurPayment);
    $this->db->delete('PurPayments'); 

    echo "<script> " ;
    echo "alert('Payment Deleted Successfully !!');" ;
    echo "window.location.href = '" . base_url() . "index.php/GaruPaymentController/showGrid/'";
    echo "</script>" ; 
  }

  // Cash Bank Details (Total Chq Amt and Total Cash Amt)
  public function getCashBankTotal($PvNumber){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    $sql= "SELECT Sum(ChequeAmt) as TotalChqAmt,SUM(CashAmt) as TotalCashAmt
                    FROM PurPayments
                    where CoID  = '$CoID'
                    and WorkYear = '$WorkYear'
                    and PvNumber = '$PvNumber'
    ";
    $query = $this->db->query($sql);
    $result = $query->result();
    echo json_encode($result);
  }

  // Cash Bank Details
  public function getCashBankDetails($PvNumber){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    $sql= " 
                  SELECT 
                              PurPayments.CoID,
                              PurPayments.WorkYear,
                              IDNumber,
                              PvNumber,
                              TotalChequeAmt,
                              BankCode,
                              CashCode,
                              BankComm,
                              ChequeNo,
                              RTGS,
                              TotalCashAmt,
                              (
                                  Select ACTitle
                                    from ACMaster
                                    where PurPayments.CoID = ACMaster.CoID
                                      and PurPayments.WorkYear = ACMaster.WorkYear
                                      and PurPayments.BankCode = ACMaster.ACCode
                              ) as BankName,
                              (
                                  Select ACTitle
                                    from ACMaster
                                    where PurPayments.CoID = ACMaster.CoID
                                      and PurPayments.WorkYear = ACMaster.WorkYear
                                      and PurPayments.CashCode = ACMaster.ACCode
                              ) as CashName                
                  FROM PurPayments
                  where IDNumber In (select min(IDNumber) 
                                        from PurPayments 
                                        where CoId ='$CoID' 
                                  and WorkYear = '$WorkYear' 
                                  and PvNumber='$PvNumber'
                              );
    ";
    $query = $this->db->query($sql);
    $result = $query->result();

    echo json_encode($result);
  }

  // Get min IdNumber from Garu Payment Table
  public function getMinIdNumber($PvNumber){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    $sql= "SELECT min(IdNumber) as IdNumber
                    FROM PurPayments
                    where CoID  = '$CoID'
                    and WorkYear = '$WorkYear'
                    and PvNumber = '$PvNumber'
    ";
    $query = $this->db->query($sql);
    $result = $query->result();
    echo json_encode($result);
  }

  // Update Garu Payment Table ( Update Cash Bank details )
  public function updateCashDetails($IdNumber){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    $PvNumber = $this->input->post('Idnumber');
    $ChequeeAmt = $this->input->post('ChequeeAmt');
    $CashsAmt = $this->input->post('CashsAmt');
    $BankCode = $this->input->post('BankCode');
    $CashCode = $this->input->post('CashCode');
    $BankComm = $this->input->post('BankComm');
    $ChequeNo = $this->input->post('ChequeNo');
    $UTRno = $this->input->post('UTRno');

    $updatedBankDetails = array(
      'TotalChequeAmt' => $ChequeeAmt,
      'TotalCashAmt'=> $CashsAmt,
      'BankCode' => $BankCode,
      'CashCode' =>$CashCode,
      'BankComm' => $BankComm,
      'ChequeNo' => $ChequeNo,
      'RTGS' => $UTRno
    );

    $arrayPurPayment = array('PvNumber'=> $PvNumber,'CoID'=> $CoID,'WorkYear'=> $WorkYear,'IdNumber'=>$IdNumber);
    $this->db->where($arrayPurPayment);
    $this->db->update('PurPayments', $updatedBankDetails);
  }

  // Edit Grid View
  function EditRecordGrid($Pvnumber){
    $this->load->model('GaruPaymentModel');
    $data['payment'] = $this->GaruPaymentModel->GetTabledata($Pvnumber);
    $a =  $data['payment'];
    $data['BankList'] = $this->GaruPaymentModel->Get_BankCode_List();
    $data['CashList'] = $this->GaruPaymentModel->Get_CashCode_List();

      // print_r($a);
    $ref = $a[0]->RefIDNumber;
    $data['header'] = $this->GaruPaymentModel->GetHeaderGriddata($ref);

    $data['footer'] = $this->GaruPaymentModel->GetIdData1($Pvnumber);
    $data['PvIdnumber'] = $Pvnumber;
    $data['Totals'] = $this->GaruPaymentModel->Totals($Pvnumber);

    $this->load->view('garuPaymentEdit_view',$data);

  }

  // Garu Payment Dropdwon for Supplier
  public function supplier($ACCode){
    if(empty($ACCode)){
        echo json_encode([]);exit;
    }

    $this->load->model('GaruPaymentModel');
    $data = $this->GaruPaymentModel->getSuppliers($ACCode);
    echo json_encode($data);exit;  
  }


  // Garu Payment Dropdwon for Broker
  public function broker($ACCode){
    if(empty($ACCode)){
        echo json_encode([]);exit;
    }

    $this->load->model('GaruPaymentModel');
    $data = $this->GaruPaymentModel->getBrokers($ACCode);
    echo json_encode($data);exit;  
  }

  







  // Parth functions

  // 
  function PaymentDatewise(){
      $this->load->model('GaruPaymentModel');
      $data['result'] = $this->GaruPaymentModel->get_PaymentDatewise();
      $this->load->view('menu_1.php');
      $this->load->view('PaymentDatewise_View',$data);
  }
  
  // 
  function payDatewiseFilter(){
    if($this->input->post('submit') != NULL ){
      $postData = $this->input->post();
      // Read POST data
      $fromYear = $postData['fromYear'];
      $toYear = $postData['toYear'];
    
      $this->load->model('GaruPaymentModel');
      $data['result'] = $this->GaruPaymentModel->get_PaymentDatewiseFilter($fromYear,$toYear);
      $this->load->view('menu_1.php');
      $this->load->view('PaymentDatewise_View',$data);
    }
  }

   //jan 29
  public function GetFilteredData1($PVref,$Idnumber){
    $ref=$PVref;
    $no=$Idnumber;
      $BrokerCode = $this->input->post('BrokerCode');
      $PartyCode = $this->input->post('PartyCode');
      $this->load->model('GaruPaymentModel');
      $data['Users'] = $this->GaruPaymentModel->checkref($PartyCode,$BrokerCode,$ref,$no);
      echo json_encode($data);
  }

  // 
  public function getTotalAmt($PVref){
    $ref=$PVref;
    $this->load->model('GaruPaymentModel');
    $data['Users'] = $this->GaruPaymentModel->totalAmt($ref);
    echo json_encode($data);
  }
        
 

  


  //30jan
  public function uprecord($i){
 
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 
    $this->load->model('GaruPaymentModel');

    // $data['payment'] = $this->GaruPaymentModel->GetTabledata($pvnumber);
    $data['payment'] = $this->GaruPaymentModel->GetTabledata($i);
    $a =  $data['payment'];
    $ref = $a[0]->RefIDNumber;
    $Result = $this->GaruPaymentModel->GetRefHeader($i);
    $NetPayable = $Result[0]->NetPayable;
    $TotalPay = $Result[0]->TotalPaid;
    $BalanceDue= $Result[0]->BalanceDue;
      
    $ChequeAmounts = $this->input->post('ChequeeAmt');
    $CashAmounts = $this->input->post('CashsAmt');
    $Kasar = $this->input->post('Kasar');

    $TotalPaid = (int)$ChequeAmounts + (int)$CashAmounts + (int)$Kasar;

    $TotalPaid1 = (int)$TotalPay - (int)$TotalPaid;
    $BalanceDue1  = (int)$NetPayable - (int)$TotalPaid1;
      
    $data2= array(
      'TotalPaid'=> $TotalPaid1,
      'BalanceDue'=> $BalanceDue1,
    );

    $this->db->where('RefIDNumber', $i);
    $this->db->where('CoID', $CoID);
    $this->db->where('WorkYear', $WorkYear);
    $this->db->update('PurHeader', $data2);
  }

        //30jan
  public function deleteRecord1($pvnumber){
    
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 
    $this->load->model('GaruPaymentModel');
    // $data['payment'] = $this->GaruPaymentModel->GetTabledata($pvnumber);
    $data3 = $this->GaruPaymentModel->getRefLoop($pvnumber);
    $this->load->view('garuPayment_view',$data3);

    $this->db->where('PvNumber', $pvnumber);
    $this->db->where('CoID', $CoID);
    $this->db->where('WorkYear', $WorkYear);
    $this->db->delete('PurPayments');
  }

  //new updated 23/01/2021
  

  //new updated 23/01/2021
  public function InsertGaruPaymentBank($Refids,$id){  
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 
                   
    $this->load->model('GaruPaymentModel');
                   
    $Result = $this->GaruPaymentModel->GetRefHeader($Refids);
 
    $NetPayable = $Result[0]->NetPayable;
    $TotalPaid = $Result[0]->TotalPaid;
    $BalanceDue= $Result[0]->BalanceDue;
      
    $ChequeAmounts = $this->input->post('ChequeeAmt');
    $CashAmounts = $this->input->post('CashsAmt');
    $TotalPay = (int)$ChequeAmounts + (int)$CashAmounts;
 
    $data = array(
        'TotalChequeAmt'=> $ChequeAmounts,
        'BankCode' => $this->input->post('BankCode'),
        'BankComm' => $this->input->post('BankComm'),
        'ChequeNo' => $this->input->post('ChequeNo'),
        'RTGS'=> $this->input->post('UTRno'),
        'TotalCashAmt'=> $CashAmounts,
        'CashCode'=> $this->input->post('CashCode'),
        'BillNo'=> $this->input->post('Blno'),
        'BillDate'=> $this->input->post('Bldt'),
        'TotalPay'=> $TotalPay,
    );
 
                 
    $this->db->where('IDNumber', $id);
    $this->db->where('CoID', $CoID);
    $this->db->where('WorkYear', $WorkYear);
    $this->db->update('PurPayments', $data);

    $TotalPaid1 = (int)$TotalPay + (int)$TotalPaid;
    $BalanceDue1  = (int)$NetPayable - (int)$TotalPaid1;
                  
    $data2= array(
      'TotalPaid'=> $TotalPaid1,
      'BalanceDue'=> $BalanceDue1,
    );

    $this->db->where('RefIDNumber', $Refids);
    $this->db->where('CoID', $CoID);
    $this->db->where('WorkYear', $WorkYear);
    $this->db->update('PurHeader', $data2);
             
    echo json_encode(array("status" => TRUE));    
  }

  //new updated 23/01/2021
  

 //new updated 23/01/2021
  public function EditGaruPayment($id, $num){  
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 
                  
    $this->load->model('GaruPaymentModel');

    $Result = $this->GaruPaymentModel->GetRefHeader($id);

    $ResultPayment = $this->GaruPaymentModel->GetTabledata1($num);


    $NetPayable = $Result[0]->NetPayable;
    $TotalPay = $Result[0]->TotalPaid;
    $BalanceDue= $Result[0]->BalanceDue;


    
    $PVIdnumber = $num;
        
    $ChequeAmounts = $this->input->post('Cheqamount');
    $CashAmounts = $this->input->post('CashAmount');

    $TotalPaid = (int)$ChequeAmounts + (int)$CashAmounts;

    $data = array(
      'WorkYear'=> $this->session->userdata('WorkYear'),
      'CoID' => $this->session->userdata('CoID'),
      'PartyCode'=> $this->input->post('PartyCode1'),
      'RefIDNumber' => $this->input->post('Refid'),
      'Days' => $this->input->post('days'),
      'DiscPerc' => $this->input->post('Vatav'),
      'VatavAmt'=> $this->input->post('VatavAmount'),
      'BrokRate'=> $this->input->post('Brokper'),
      'BrokAmt'=> $this->input->post('BrokAmount'),
      'IntRate'=> $this->input->post('IntrestPer'),
      'IntAmt'=> $this->input->post('IntrestAmount'),
      'WgtShort'=> $this->input->post('Wgtshort'),
      'QualityDiffRate'=> $this->input->post('QualityrPer'),
      'QualityDiffAmt'=> $this->input->post('QualityAmount'),
      'ChequeAmt'=> $this->input->post('Cheqamount'),
      'CashAmt'=> $this->input->post('CashAmount'),
      'KasarAmt'=> $this->input->post('Kasar'),
      'TotalChequeAmt'=> $this->input->post('Cheqamount'),
      'TotalCashAmt'=> $this->input->post('CashAmount'),
      'BankCode' => $this->input->post('BankCode'),
      'BankComm' => $this->input->post('BankComm'),
      'ChequeNo' => $this->input->post('ChequeNo'),
      'RTGS' => $this->input->post('UTRno'),
      'CashCode' => $this->input->post('CashCode'),
    );

    
    $this->db->where('IDNumber', $num);
    $this->db->where('CoID', $CoID);
    $this->db->where('WorkYear', $WorkYear);
    $this->db->update('PurPayments', $data);

  
    $TotalPaid1 = (int)$TotalPay + (int)$TotalPaid - ( (int)$ResultPayment[0]->ChequeAmt + (int) $ResultPayment[0]->CashAmt);

    $BalanceDue1  = (int)$NetPayable - (int)$TotalPaid1;
    
    $data2= array(
      'TotalPaid'=> $TotalPaid1,
      'BalanceDue'=> $BalanceDue1,
    );

    $this->db->where('RefIDNumber', $id);
    $this->db->where('CoID', $CoID);
    $this->db->where('WorkYear', $WorkYear);
    $this->db->update('PurHeader', $data2);
  
    echo json_encode(array("status" => TRUE));    

  }


  

  // below old functions
  public function AddedRecord($PVIdnumber){
    $this->load->model('GaruPaymentModel');
    $data['footer'] = $this->GaruPaymentModel->GetIdData1($PVIdnumber);
    $data['PvIdnumber'] = $PVIdnumber;
    $data['Totals'] = $this->GaruPaymentModel->Totals($PVIdnumber);
    $data['BrokerList'] = $this->GaruPaymentModel->Get_Broker_List();

    $result =  $this->GaruPaymentModel->Totals($PVIdnumber);

    $TotalChequeAmt=$result[0]->ChequeAmt;
    $BankCode=$result[0]->BankCode;
    $BankComm=$result[0]->BankComm;
    $ChequeNo = $result[0]->ChequeNo;
    $RTGS=$result[0]->RTGS;
    $TotalCashAmt=$result[0]->CashAmt;
    $CashCode=$result[0]->CashCode;

    $updateddata = array(
      'TotalChequeAmt' => $TotalChequeAmt,
      'BankCode' => $BankCode,
      'BankComm' => $BankComm,
      'ChequeNo' => $ChequeNo,
      'RTGS' => $RTGS,
      'TotalCashAmt'=> $TotalCashAmt,
      'CashCode' =>$CashCode
    );

    $this->db->where('PvNumber', $PVIdnumber);
    $this->db->update('PurPayments', $updateddata);

    $this->load->view('GaruPaymentAdded',$data);
  }

  public function UpdateGaruPaymentSingle($id){

    $this->form_validation->set_rules('Idnumber', 'IdNumber', 'trim');

    if ($this->form_validation->run() == FALSE) {
        $this->load->model('GaruPaymentModel');
        $Result = $this->GaruPaymentModel->GetReferenceId($id);
        $Refid=$Result[0]->RefIDNumber;
        $data['footer'] = $this->GaruPaymentModel->GetDataSingle1($id);
        $data['header'] = $this->GaruPaymentModel->GetDataSingle($Refid);
        $data['Totals'] = $this->GaruPaymentModel->GetTotalSingle($id);
        $data['BrokerList'] = $this->GaruPaymentModel->Get_Broker_List();
        $this->load->view('GaruPaymentUpdate',$data);
    }else{
      $Refids = $this->input->post('Refid');
      $this->load->model('GaruPaymentModel');

      $Result = $this->GaruPaymentModel->GetRefHeader($Refids);
      $NetPayable = $Result[0]->NetPayable;
      $TotalPay = $Result[0]->TotalPaid;
      $BalanceDue= $Result[0]->BalanceDue;
      
      $PVIdnumber = $this->input->post('Idnumber');
      $ChequeAmounts = $this->input->post('Cheqamount');
      $CashAmounts = $this->input->post('CashAmount');
      $Kasar = $this->input->post('Kasar');
      $TotalPaid = (float)$ChequeAmounts + (float)$CashAmounts + (float)$Kasar;

      $data = array(
                    'PvNumber'=> $this->input->post('Idnumber'),
                    'Paymentdate'=> $this->input->post('todaydate'),
                    'RefIDNumber' => $this->input->post('Refid'),
                    'Days' => $this->input->post('date'),
                    'DiscPerc' => $this->input->post('Vatav'),
                    'VatavAmt'=> $this->input->post('VatavAmount'),
                    'BrokRate'=> $this->input->post('Brokper'),
                    'BrokAmt'=> $this->input->post('BrokAmount'),
                    'IntRate'=> $this->input->post('IntrestPer'),
                    'IntAmt'=> $this->input->post('IntrestAmount'),
                    'WgtShort'=> $this->input->post('Wgtshort'),
                    'QualityDiffRate'=> $this->input->post('QualityrPer'),
                    'QualityDiffAmt'=> $this->input->post('QualityAmount'),
                    'ChequeAmt'=> $this->input->post('Cheqamount'),
                    'CashAmt'=> $this->input->post('CashAmount'),
                    'KasarAmt'=> $this->input->post('Kasar'),
                    'TotalChequeAmt'=> $this->input->post('TotalAmt')
      ); 
               
      $this->db->where('IDNumber', $id);
      $this->db->update('PurPayments', $data);

      $TotalP = $TotalPay - $TotalPay + $TotalPaid;
      $BalanceDue1  = $NetPayable - $TotalP;

      $data2= array(
        'TotalPaid'=> $TotalP,
        'BalanceDue'=> $BalanceDue1
      );
      $this->db->where('RefIDNumber', $Refids);
      $this->db->update('PurHeader', $data2);


      echo "<script> " ;
      echo "alert('Updated !!');" ;
      echo "window.location.href = '" . base_url() . "index.php/GaruPaymentController/AddedRecord/'+ $PVIdnumber;";
      echo "</script>" ; 

    }        
  }

  public function UpdateBankDetails($PVIdnumber){
    $data = array(
      'TotalChequeAmt' => $this->input->post('ChequeeAmt'),
      'BankCode' => $this->input->post('BankCode'),
      'BankComm' => $this->input->post('BankComm'),
      'ChequeNo' => $this->input->post('ChequeNo'),
      'RTGS' => $this->input->post('UTRno'),
      'TotalCashAmt'=>$this->input->post('CashsAmt'),
      'CashCode' => $this->input->post('CashCode'),
    );

    $this->db->where('PvNumber', $PVIdnumber);
    $this->db->update('PurPayments', $data);

    echo "<script> " ;
    echo "alert('Bank Detailed Added !!');" ;
    echo "window.location.href = '" . base_url() . "index.php/GaruPaymentController/showGrid'";
    echo "</script>" ;  
  }

  public function DeleteGaruPaymentSingle($IdNumber,$PvNumber){
    $this->db->where('IdNumber', $IdNumber);
    $this->db->delete('PurPayments');

    echo "<script> " ;
    echo "alert('Deleted !!');" ;
    echo "window.location.href = '" . base_url() . "index.php/GaruPaymentController/AddedRecord/'+$PvNumber";
    echo "</script>" ;
  }

  public function DeletePayment($PvNumber){
    $this->db->where('PvNumber', $PvNumber);
    $this->db->delete('PurPayments');

    echo "<script> " ;
    echo "alert('Payment Deleted !!');" ;
    echo "window.location.href = '" . base_url() . "index.php/GaruPaymentController/showGrid/'";
    echo "</script>" ;
  }

}

?>