<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PaymentTdsController extends CI_Controller
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
        $this->load->model('Tds_Model');
        // get_details() func is coming from Model 
        $data['Item_List'] = $this->Tds_Model->get_details();
        $this->load->view('menu_1');
        // Change this later once u t done 
        $this->load->view('TdsGrid', $data);
    }

    public function getTax($Code)
    {
        if (empty($Code)) {
            echo json_encode([]);
            exit;
        }

        $this->load->model('Tds_Model');
        $data = $this->Tds_Model->getTaxCode($Code);
        echo json_encode($data);
        exit;
    }

    function Tds()
    {
        $this->load->model('Tds_Model');
        $data['SupplierList'] = $this->Tds_Model->get_Acc_list();
        $data['BankList'] = $this->Tds_Model->Get_Bank_List();
        $data['TaxList'] = $this->Tds_Model->get_Tax_List();
        $data['AClist'] = $this->Tds_Model->get_Account_list();
        $data['Cash'] = $this->Tds_Model->getBank();

        $this->load->view('paymentTds_view', $data);
    }
    public function supplier($ACCode)
    {
        if (empty($ACCode)) {
            echo json_encode([]);
            exit;
        }

        $this->load->model('Tds_Model');
        $data = $this->Tds_Model->getACCode($ACCode);
        echo json_encode($data);
        exit;
    }
    public function CashCode($ACCode)
    {
        if (empty($ACCode)) {
            echo json_encode([]);
            exit;
        }

        $this->load->model('Tds_Model');
        $data = $this->Tds_Model->getCashCode($ACCode);
        echo json_encode($data);
        exit;
    }
    public function Accode($Code)
    {
        if (empty($Code)) {
            echo json_encode([]);
            exit;
        }

        $this->load->model('Tds_Model');
        $data = $this->Tds_Model->getACCode($Code);
        echo json_encode($data);
        exit;
    }

    public function BankDet($Code)
    {
        if (empty($Code)) {
            echo json_encode([]);
            exit;
        }

        $this->load->model('Tds_Model');
        $data = $this->Tds_Model->getBankDet($Code);
        echo json_encode($data);
        exit;
    }

    public function Paytype($TdsCode)
    {
        if (empty($TdsCode)) {
            echo json_encode([]);
            exit;
        }

        $this->load->model('Tds_Model');
        $data = $this->Tds_Model->getPaymentType($TdsCode);
        echo json_encode($data);
        exit;
    }

    public function insertTdsData()
    {

        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        $IDNumber = $this->input->post('IdNumber');
        $data = array(
            'CoID' => $CoID,
            'WorkYear' => $WorkYear,
            'IDNumber' => 'New',
            'EntryDate' => $this->input->post('EntryDate'),
            'PayUpto' => $this->input->post('PayUpto'),
            'TdsType' => $this->input->post('TdsType'),
            'CashAcc' => $this->input->post('CashAcc'),
            'Nature' => $this->input->post('Nature'),
            'LotNo' => $this->input->post('LotNo'),
            'PurRefNo' => $this->input->post('PurRefNo'),
            'GrossAmt' => $this->input->post('GrossAmt'),
            'AdvAmt' => $this->input->post('AdvAmt'),
            'BrokAcc' => $this->input->post('BrokAcc'),
            'AddAmt' => $this->input->post('AddAmt'),
            'ACashAcc' => $this->input->post('ACashAcc'),
            'LessAmt' => $this->input->post('LessAmt'),
            'LCashAcc' => $this->input->post('LCashAcc'),
            'TDSRate' => $this->input->post('TDSRate'),
            'TDSAmt' => $this->input->post('TDSAmt'),
            'EcessRate' => $this->input->post('EcessRate'),
            'EcessAmt' => $this->input->post('EcessAmt'),
            'SurRate' => $this->input->post('SurRate'),
            'SurAmt' => $this->input->post('SurAmt'),
            'TotTDSAmt' => $this->input->post('TotTDSAmt'),
            'Reason' => $this->input->post('Reason'),
            'CertiNo' => 'r',
            'TDS_Acc' => $this->input->post('TDS_Acc'),
            'CashAmt' => $this->input->post('CashAmt'),
            'CashCode' => $this->input->post('CashCode'),
            'CashAmt1' => $this->input->post('CashAmt1'),
            'Cashcode1' => $this->input->post('Cashcode1'),
            'CheqNo' => $this->input->post('CheqNo'),
            'UTRNo' => $this->input->post('UTRNo'),
            'SlipNo' => $this->input->post('SlipNo'),
            'CheqBank' => $this->input->post('CheqBank'),
            'ChallanNo' => $this->input->post('ChallanNo'),
            'ChallanDate' => $this->input->post('ChallanDate'),
            'DepoBankcode' => $this->input->post('DepoBankcode'),
            'DepocheqNo' => $this->input->post('DepocheqNo'),
            // 'Form26' => $this->input->post('RefIDNumber'),
            'InvoiceNo' => $this->input->post('InvoiceNo'),
            'InvoiceDate' => $this->input->post('InvoiceDate'),
            'TaxCode' => $this->input->post('TaxCode'),
            'SaleType' => $this->input->post('SaleType'),
            'HSNCode' => $this->input->post('HSNCode'),
            'RCMInd' => $this->input->post('RCMInd'),
            'GSTTaxableAmt' => $this->input->post('GSTTaxableAmt'),
            'CGSTAmt' => $this->input->post('CGSTAmt'),
            'SGSTAmt' => $this->input->post('SGSTAmt'),
            'IGSTAmt' => $this->input->post('IGSTAmt'),
            'TotalGSTAmt' => $this->input->post('TotalGSTAmt')
        );
        $this->db->insert('TDSonPayment', $data);
        $this->load->model('Tds_Model');

        $result = $this->Tds_Model->getid($IDNumber);
        // $purh_id = $result[0]->LastGaruPurRefIDNumber;
        $purh_id = $result;

        $data2 = array('IDNumber' => $purh_id);
        $this->db->where('IDNumber', 'New');
        $this->db->update('TDSonPayment', $data2);

        echo json_encode($purh_id);
    }


    public function x_insertTdsData()
    {

        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $IDNumber = $this->input->post('IdNumber');
        $data = array(
            'CoID' => $CoID,
            'WorkYear' => $WorkYear,
            'IDNumber' => 'New',
            'EntryDate' => $this->input->post('EntryDate'),
            'PayUpto' => $this->input->post('PayUpto'),
            'TdsType' => $this->input->post('TdsType'),
            'CashAcc' => $this->input->post('CashAcc'),
            'Nature' => $this->input->post('Nature'),
            'LotNo' => $this->input->post('LotNo'),
            'PurRefNo' => $this->input->post('PurRefNo'),
            'GrossAmt' => $this->input->post('GrossAmt'),
            'AdvAmt' => $this->input->post('AdvAmt'),
            'AddAmt' => $this->input->post('AddAmt'),
            'BrokAcc' => $this->input->post('BrokAcc'),
            'ACashAcc' => $this->input->post('ACashAcc'),
            'LessAmt' => $this->input->post('LessAmt'),
            'LCashAcc' => $this->input->post('LCashAcc'),
            'TDSRate' => $this->input->post('TDSRate'),
            'TDSAmt' => $this->input->post('TDSAmt'),
            'EcessRate' => $this->input->post('EcessRate'),
            'EcessAmt' => $this->input->post('EcessAmt'),
            'SurRate' => $this->input->post('SurRate'),
            'SurAmt' => $this->input->post('SurAmt'),
            'TotTDSAmt' => $this->input->post('TotTDSAmt'),
            'Reason' => $this->input->post('Reason'),
            'CertiNo' => 'r',
            'TDS_Acc' => $this->input->post('TDS_Acc'),
            'CashAmt' => $this->input->post('CashAmt'),
            'CashCode' => $this->input->post('CashCode'),
            'CashAmt1' => $this->input->post('CashAmt1'),
            'Cashcode1' => $this->input->post('Cashcode1'),
            'CheqNo' => $this->input->post('CheqNo'),
            'UTRNo' => $this->input->post('UTRNo'),
            'SlipNo' => $this->input->post('SlipNo'),
            'CheqBank' => $this->input->post('CheqBank'),
            'ChallanNo' => $this->input->post('ChallanNo'),
            'ChallanDate' => $this->input->post('ChallanDate'),
            'DepoBankcode' => $this->input->post('DepoBankcode'),
            'DepocheqNo' => $this->input->post('DepocheqNo'),
            // 'Form26' => $this->input->post('RefIDNumber'),
            'InvoiceNo' => $this->input->post('InvoiceNo'),
            'InvoiceDate' => $this->input->post('InvoiceDate'),
            'TaxCode' => $this->input->post('TaxCode'),
            'SaleType' => $this->input->post('SaleType'),
            'HSNCode' => $this->input->post('HSNCode'),
            'RCMInd' => $this->input->post('RCMInd'),
            'GSTTaxableAmt' => $this->input->post('GSTTaxableAmt'),
            'CGSTAmt' => $this->input->post('CGSTAmt'),
            'SGSTAmt' => $this->input->post('SGSTAmt'),
            'IGSTAmt' => $this->input->post('IGSTAmt'),
            'TotalGSTAmt' => $this->input->post('TotalGSTAmt')
        );
        // print_r($data);
        // die;
        $this->db->insert('TDSonPayment', $data);
        $this->load->model('Tds_Model');
        $result = $this->Tds_Model->getid($IDNumber);
        // $purh_id = $result[0]->LastGaruPurRefIDNumber;
        $purh_id = $result;

        $data2 = array('IDNumber' => $purh_id);
        $this->db->where('IDNumber', 'New');
        $this->db->update('TDSonPayment', $data2);

        echo json_encode($purh_id);
    }
    public function Updateview($IDNumber)
    {

        $this->load->model('Tds_Model');
        $data['TdsDet'] = $this->Tds_Model->getdata($IDNumber);
        $data['SupplierList'] = $this->Tds_Model->get_Acc_list();
        $data['BankList'] = $this->Tds_Model->Get_Bank_List();
        $data['TaxList'] = $this->Tds_Model->get_Tax_List();
        $data['AClist'] = $this->Tds_Model->get_Account_list();
        $data['Cash'] = $this->Tds_Model->getBank();
        $this->load->view('TdsUpdate_view', $data);
    }

    public function printoutward($IDNumber)
    {
        $this->load->model('Tds_Model');

        // Data to be displayed from the Table TDSonPayment
        $data['details'] = $this->Tds_Model->getTdsTaxInvoice($IDNumber);
        $data['company'] = $this->Tds_Model->get_comp();
        $detail = $data['details'];
        $total = $detail[0]->TotalGSTAmt;
        $rwords = $this->convert_number($total);
        $data['rwords'] = $rwords;


        $this->load->view('Outword_view', $data);
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



    public function updateEntry($IDNumber)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $data = array(
            'CoID' => $CoID,
            'WorkYear' => $WorkYear,
            'IDNumber' => $IDNumber,
            'EntryDate' => $this->input->post('EntryDate'),
            'PayUpto' => $this->input->post('PayUpto'),
            'TdsType' => $this->input->post('TdsType'),
            'CashAcc' => $this->input->post('CashAcc'),
            'Nature' => $this->input->post('Nature'),
            'LotNo' => $this->input->post('LotNo'),
            'PurRefNo' => $this->input->post('PurRefNo'),
            'GrossAmt' => $this->input->post('GrossAmt'),
            'AdvAmt' => $this->input->post('AdvAmt'),
            'BrokAcc' => $this->input->post('BrokAcc'),
            'AddAmt' => $this->input->post('AddAmt'),
            'ACashAcc' => $this->input->post('ACashAcc'),
            'LessAmt' => $this->input->post('LessAmt'),
            'LCashAcc' => $this->input->post('LCashAcc'),
            'TDSRate' => $this->input->post('TDSRate'),
            'TDSAmt' => $this->input->post('TDSAmt'),
            'EcessRate' => $this->input->post('EcessRate'),
            'EcessAmt' => $this->input->post('EcessAmt'),
            'SurRate' => $this->input->post('SurRate'),
            'SurAmt' => $this->input->post('SurAmt'),
            'TotTDSAmt' => $this->input->post('TotTDSAmt'),
            'Reason' => $this->input->post('Reason'),
            'CertiNo' => 'r',
            'TDS_Acc' => $this->input->post('TDS_Acc'),
            'CashAmt' => $this->input->post('CashAmt'),
            'CashCode' => $this->input->post('CashCode'),
            'CashAmt1' => $this->input->post('CashAmt1'),
            'Cashcode1' => $this->input->post('Cashcode1'),
            'CheqNo' => $this->input->post('CheqNo'),
            'UTRNo' => $this->input->post('UTRNo'),
            'SlipNo' => $this->input->post('SlipNo'),
            'CheqBank' => $this->input->post('CheqBank'),
            'ChallanNo' => $this->input->post('ChallanNo'),
            'ChallanDate' => $this->input->post('ChallanDate'),
            'DepoBankcode' => $this->input->post('DepoBankcode'),
            'DepocheqNo' => $this->input->post('DepocheqNo'),
            // 'Form26' => $this->input->post('RefIDNumber'),
            'InvoiceNo' => $this->input->post('InvoiceNo'),
            'InvoiceDate' => $this->input->post('InvoiceDate'),
            'TaxCode' => $this->input->post('TaxCode'),
            'SaleType' => $this->input->post('SaleType'),
            'HSNCode' => $this->input->post('HSNCode'),
            'RCMInd' => $this->input->post('RCMInd'),
            'GSTTaxableAmt' => $this->input->post('GSTTaxableAmt'),
            'CGSTAmt' => $this->input->post('CGSTAmt'),
            'SGSTAmt' => $this->input->post('SGSTAmt'),
            'IGSTAmt' => $this->input->post('IGSTAmt'),
            'TotalGSTAmt' => $this->input->post('TotalGSTAmt')
        );
        // print_r($data);
        // die;
        $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $IDNumber);
        $this->db->where($multi_where);
        $this->db->Update('TDSonPayment', $data);
    }

    function DeleteEntry($id)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        // $this->db->where('IDNumber', $id);
        $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $id);
        $this->db->where($multi_where);
        $this->db->delete('TDSonPayment');

        echo "<script> ";
        echo "alert('TDS Deleted Succesfully !! ' +$id);";
        echo "window.location.href = '" . base_url() . "index.php/PaymentTdsController/show/'";
        echo "</script>";
    }

    // public function show()
    // {
    //     $this->load->model('PaymentTDS_Model');
    //     $data['SupplierList'] = $this->PaymentTDS_Model->Get_Supplier_List();
    //     $data['BankList'] = $this->PaymentTDS_Model->Get_Bank_List();

    //     $this->load->view('PaymentTDS_view', $data);
    // }

    // public function supplier($ACCode)
    // {
    //     if (empty($ACCode)) {
    //         echo json_encode([]);
    //         exit;
    //     }

    //     $this->load->model('PaymentTDS_Model');
    //     $data = $this->PaymentTDS_Model->getSuppliers($ACCode);
    //     echo json_encode($data);
    //     exit;
    // }

    // public function Paytype($TdsCode)
    // {
    //     if (empty($TdsCode)) {
    //         echo json_encode([]);
    //         exit;
    //     }

    //     $this->load->model('PaymentTDS_Model');
    //     $data = $this->PaymentTDS_Model->getPaymentType($TdsCode);
    //     echo json_encode($data);
    //     exit;
    // }





}
