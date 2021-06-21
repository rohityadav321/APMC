<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class NewGaruPurController extends CI_Controller{
         public $id1;

        public function __construct(){
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

        // Garu Purchase Grid
        public function show(){
            if($this->input->post('submit') != NULL ){
                $postData = $this->input->post();
            
                // Read POST data
                $fromYear = $postData['fromYear'];
                $toYear = $postData['toYear'];
                
          
                $this->load->model('NewGaruPurModel');
                $data['Item_List'] = $this->NewGaruPurModel->get_detailsFilter($fromYear,$toYear);
          
                $this->load->view('menu_1');
                $this->load->view('GaruPurchaseGrid',$data);
            }
            else{
                $this->load->model('NewGaruPurModel');
                $data['Item_List'] = $this->NewGaruPurModel->get_details();
                $this->load->view('menu_1.php');
                $this->load->view('GaruPurchaseGrid',$data);
            }
        }
 
        // Garu Purchase Insert View
        public function showInsert(){ 

            $CoID = $this->session->userdata('CoID') ;
            $WorkYear = $this->session->userdata('WorkYear');

            $this->load->model('NewGaruPurModel');
            $data['Item_List'] = $this->NewGaruPurModel->get_details();
            $data['TableData'] = $this->NewGaruPurModel->getTableData();
            $data['SupplierList'] = $this->NewGaruPurModel->Get_Supplier_List();
            $data['BrokerList'] = $this->NewGaruPurModel->Get_Broker_List();
            $data['AreaList'] = $this->NewGaruPurModel->Get_Area_List();
            // $data['Total'] = $this->NewGaruPurModel->getTotal1();
            $data['ItemList'] = $this->NewGaruPurModel->Get_Item_List();
            $data['GodownList'] = $this->NewGaruPurModel->Get_Godown_List();
            $this->load->view('NewGaruPurInsert',$data);
        
        }

        // Garu Purchase Dropdwon for Dispatched From and To
        public function dispatchedFrom($AreaCode){
            if(empty($AreaCode)){
                echo json_encode([]);exit;
            }

            $this->load->model('NewGaruPurModel');
            $data = $this->NewGaruPurModel->getDispatchedFrom($AreaCode);
            echo json_encode($data);exit;
        }

        // Garu Purchase Dropdwon for Suppliers
        public function supplier($ACCode){
            if(empty($ACCode)){
                echo json_encode([]);exit;
            }

            $this->load->model('NewGaruPurModel');
            $data = $this->NewGaruPurModel->getSuppliers($ACCode);
            echo json_encode($data);exit;
        }

        // 270421
        public function suppliername($ACTitle){
            if(empty($ACTitle)){
                echo json_encode([]);exit;
            }

            $this->load->model('NewGaruPurModel');
            $data = $this->NewGaruPurModel->getSuppliersName($ACTitle);
            echo json_encode($data);exit;
        }

        // Garu Purchase Dropdwon for Brokers
        public function broker($ACCode){
            if(empty($ACCode)){
                echo json_encode([]);exit;
            }

            $this->load->model('NewGaruPurModel');
            $data = $this->NewGaruPurModel->getBrokers($ACCode);
            echo json_encode($data);exit;
        }

        public function brokername($ACTitle){
            if(empty($ACTitle)){
                echo json_encode([]);exit;
            }

            $this->load->model('NewGaruPurModel');
            $data = $this->NewGaruPurModel->getBrokername($ACTitle);
            echo json_encode($data);exit;
        }


        // Garu Purchase Dropdown for Godown
        public function godown($GodownId){
            if(empty($GodownId)){
              echo json_encode([]);exit;
            }
            $this->load->model('NewGaruPurModel');
            $data = $this->NewGaruPurModel->getGodown($GodownId);
            echo json_encode($data);exit;
        }

        // Garu Purchase Dropdown for Item Code
        public function item($ItemCode){
            if(empty($ItemCode)){
            echo json_encode([]);exit;
            }
            $this->load->model('NewGaruPurModel');
            $data = $this->NewGaruPurModel->getItem($ItemCode);
            echo json_encode($data);exit;
        }

        // Inserting Data in Garu Purchase Header (PurHeader) 
        public function garuPurchaseHeaderInsert(){
            $CoID = $this->session->userdata('CoID') ;
            $WorkYear = $this->session->userdata('WorkYear');

            $RefIDNumber = $this->input->post('RefIDNumber');
            $data = array(
                    'RefIDNumber' => $this->input->post('RefIDNumber'),
                    'GoodsRcptDate' => $this->input->post('GoodsRcptDate'),
                    'InvoiceNo'=> $this->input->post('InvoiceNo'),
                    'InvoiceDate'=> $this->input->post('InvoiceDate'),
                    'LRNo'=> $this->input->post('LRNo'),
                    'LRDate'=> $this->input->post('LRDate'),
                    'TransportCharges' => $this->input->post('TransChg'),
                    'DespatchFrom'=> $this->input->post('DespatchFrom'),
                    'DespatchTitle'=> $this->input->post('DespatchTitle'),
                    'DespatchTo'=> $this->input->post('DespatchTo'),
                    'DespatchToTitle'=> $this->input->post('DespatchToTitle'),
                    'PartyCode'=> $this->input->post('PartyCode'),
                    'PartyName'=> $this->input->post('PartyName'),
                    'BrokerCode'=> $this->input->post('BrokerCode'),
                    'BrokerTitle'=> $this->input->post('BrokerTitle'),
                    'CoId' => $CoID,
                    'WorkYear' => $WorkYear
            );
                
            $this->db->insert('PurHeader', $data);  

            $this->load->model('NewGaruPurModel');
            $result = $this->NewGaruPurModel->getid($RefIDNumber);
            // $purh_id = $result[0]->LastGaruPurRefIDNumber;
            $purh_id = $result;

            $data2 = array('RefIDNumber' => $purh_id);              
            $this->db->where('RefIDNumber', 'New');
            $this->db->update('PurHeader', $data2);
            
            echo json_encode($purh_id);
        }

        // Inserting Data in Garu Purchase Details (PurDetails) from NewGaruPurInsert View
        public function garuPurchaseDetailsInsert($RefIDNumber){
            $CoID = $this->session->userdata('CoID') ;
            $WorkYear = $this->session->userdata('WorkYear');

            // $sql="select max(IDNumber) as IDNumber from PurHeader";
            // $query = $this->db->query($sql);
            // $result = $query->result();

            // $IDNumber = $result[0]->IDNumber;
            $IDNumber = $RefIDNumber;

            $StateCode = $this->input->post('StateCode');
            $TaxCharges = floatval( $this->input->post('TaxCharges'));
            $CGSTAmt = "";
            $SGSTAmt = "";
            $IGSTAmt = "";

            if($StateCode === "27"){
                $CGSTAmt = $TaxCharges/2;
                $SGSTAmt = $TaxCharges/2;
            }
            else{
                $IGSTAmt = $TaxCharges;
            }
            

            $data = array(
                    'IDNumber' => $IDNumber,
                    'CoID' => $CoID,
                    'WorkYear' => $WorkYear,
                    'GoodsRcptDate' => $this->input->post('GoodsRcptDate'),
                    'GodownID' => $this->input->post('GodownID'),
                    'PartyCode' => $this->input->post('PartyCode'),
                    'BrokerCode' => $this->input->post('BrokerCode'),
                    'LotNo' => $this->input->post('LotNo'),
                    'ItemCode' => $this->input->post('ItemCode'),
                    'ItemName' => $this->input->post('ItemName'),
                    'Packing'=> $this->input->post('Packing'),
                    'Mark' => $this->input->post('Mark'),   
                    'Qty'=> $this->input->post('Qty'),
                    'ClosingQty'=> $this->input->post('Qty'),
                    'Units'=> $this->input->post('Units'),
                    'Weight'=> $this->input->post('Weight'),
                    'Rate'=> $this->input->post('Rate'),
                    'APMCInd'=> $this->input->post('APMCInd'),
                    'ETaxInd'=> $this->input->post('ETaxInd'),
                    'Amount' => $this->input->post('Amount'),
                    'ContChg' => $this->input->post('ContChg'),
                    'APMCChg' => $this->input->post('APMCChg'),
                    'AddAmt' => $this->input->post('AddAmt'),
                    'LessAmt' => $this->input->post('LessAmt'),
                    'TaxableAmt' => $this->input->post('TaxableAmt'),
                    'TaxRate' => $this->input->post('TaxRate'),
                    'TaxCharges' => $this->input->post('TaxCharges'),
                    'CGSTAmt' => $CGSTAmt,
                    'SGSTAmt' => $SGSTAmt,
                    'IGSTAmt' => $IGSTAmt,
                    'GrossAmount' => $this->input->post('GrossAmount'),
                    'TCSAmount' => $this->input->post('TCSAmount'),
                    'OtherAdd' => $this->input->post('OtherAdd'),
                    'LessCharges' => $this->input->post('LessCharges'),
                    'NetPayable' => $this->input->post('NetPayable')
            );

            $this->db->insert('PurDetails', $data);  

            //Updating PurHeader Table

            $this->load->model('NewGaruPurModel');
            $res = $this->NewGaruPurModel->getData($IDNumber);

            $sql1="
                    select sum(TotalPay) amtPaid 
                    FROM PurPayments
                    where CoID ='$CoID' 
                    and WorkYear='$WorkYear'
                    and RefIDNumber = '$IDNumber'
                ";
                
            $query1 = $this->db->query($sql1);
            $result1 = $query1->result();

            
            $TotalAmount = $res[0]->Amount;
            $ContainerChg = $res[0]->ContChg;
            $APMCChg = $res[0]->APMCChg;
            $AddAmt = $res[0]->AddAmt;
            $LessAmt = $res[0]->LessAmt;
            $TaxableAmt = $res[0]->TaxableAmt;
            $TaxCharges = $res[0]->TaxCharges;
            $CGSTAmt = $res[0]->CGSTAmt;
            $SGSTAmt = $res[0]->SGSTAmt;
            $IGSTAmt = $res[0]->IGSTAmt;
            $GrossAmount = $res[0]->GrossAmount;
            $TCSAmount = $res[0]->TCSAmount;
            $OtherAdd = $res[0]->OtherAdd;
            $LessCharges = $res[0]->LessCharges;
            $NetPayable = $res[0]->NetPayable; 
            $TotalPaid = $result1[0]->amtPaid;      
            $BalanceDue = $NetPayable - $TotalPaid ;        

            $data1= array(
                'TotalAmount' => $TotalAmount,
                'ContainerChg' => $ContainerChg,
                'APMCChg' => $APMCChg,
                'AddAmt' => $AddAmt,
                'LessAmt' => $LessAmt,
                'TaxableAmt' => $TaxableAmt,
                'TaxCharges' => $TaxCharges,
                'CGSTAmt' => $CGSTAmt,
                'SGSTAmt' => $SGSTAmt,
                'IGSTAmt' => $IGSTAmt,
                'GrossAmount' => $GrossAmount,
                'TCSAmount' => $TCSAmount,
                'OtherAdd' => $OtherAdd,
                'LessCharges' => $LessCharges,
                'NetPayable' => $NetPayable,
                'TotalPaid' => $TotalPaid, 
                'BalanceDue' => $BalanceDue

            ) ;

            // $this->db->where('IDNumber', $IDNumber);
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'RefIDNumber' => $IDNumber );
            $this->db->where($multi_where);
            $this->db->update('PurHeader', $data1);  
            
            
            $this->getGaruPurchaseDetails1($IDNumber);
        }

        // Inserting Data in Garu Purchase Details (PurDetails) from NewGaruPurEdit View
        public function garuPurchaseDetailsInsert1(){
            $CoID = $this->session->userdata('CoID') ;
            $WorkYear = $this->session->userdata('WorkYear');

            $IDNumber = $this->input->post('IDNumber');

            $StateCode = $this->input->post('StateCode');
            $TaxCharges = floatval( $this->input->post('TaxCharges'));
            $CGSTAmt = "";
            $SGSTAmt = "";
            $IGSTAmt = "";

            if($StateCode === "27"){
                $CGSTAmt = $TaxCharges/2;
                $SGSTAmt = $TaxCharges/2;
            }
            else{
                $IGSTAmt = $TaxCharges;
            }

            $data = array(
                    'IDNumber' => $IDNumber,
                    'CoID' => $CoID,
                    'WorkYear' => $WorkYear,
                    'GoodsRcptDate' => $this->input->post('GoodsRcptDate'),
                    'GodownID' => $this->input->post('GodownID'),
                    'PartyCode' => $this->input->post('PartyCode'),
                    'BrokerCode' => $this->input->post('BrokerCode'),
                    'LotNo' => $this->input->post('LotNo'),
                    'ItemCode' => $this->input->post('ItemCode'),
                    'ItemName' => $this->input->post('ItemName'),
                    'Packing'=> $this->input->post('Packing'),
                    'Mark' => $this->input->post('Mark'),   
                    'Qty'=> $this->input->post('Qty'),
                    'ClosingQty'=> $this->input->post('Qty'),
                    'Units'=> $this->input->post('Units'),
                    'Weight'=> $this->input->post('Weight'),
                    'Rate'=> $this->input->post('Rate'),
                    'APMCInd'=> $this->input->post('APMCInd'),
                    'ETaxInd'=> $this->input->post('ETaxInd'),
                    'Amount' => $this->input->post('Amount'),
                    'ContChg' => $this->input->post('ContChg'),
                    'APMCChg' => $this->input->post('APMCChg'),
                    'AddAmt' => $this->input->post('AddAmt'),
                    'LessAmt' => $this->input->post('LessAmt'),
                    'TaxableAmt' => $this->input->post('TaxableAmt'),
                    'TaxRate' => $this->input->post('TaxRate'),
                    'TaxCharges' => $this->input->post('TaxCharges'),
                    'CGSTAmt' => $CGSTAmt,
                    'SGSTAmt' => $SGSTAmt,
                    'IGSTAmt' => $IGSTAmt,
                    'GrossAmount' => $this->input->post('GrossAmount'),
                    'TCSAmount' => $this->input->post('TCSAmount'),
                    'OtherAdd' => $this->input->post('OtherAdd'),
                    'LessCharges' => $this->input->post('LessCharges'),
                    'NetPayable' => $this->input->post('NetPayable')
            );

            $this->db->insert('PurDetails', $data);  

            //Updating PurHeader Table

            $this->load->model('NewGaruPurModel');
            $res = $this->NewGaruPurModel->getData($IDNumber);

            $sql="
                    select sum(TotalPay) amtPaid 
                    FROM PurPayments
                    where CoID ='$CoID' 
                    and WorkYear='$WorkYear'
                    and RefIDNumber = '$IDNumber'
                ";
                
            $query = $this->db->query($sql);
            $result = $query->result();
            
            $TotalAmount = $res[0]->Amount;
            $ContainerChg = $res[0]->ContChg;
            $APMCChg = $res[0]->APMCChg;
            $AddAmt = $res[0]->AddAmt;
            $LessAmt = $res[0]->LessAmt;
            $TaxableAmt = $res[0]->TaxableAmt;
            $TaxCharges = $res[0]->TaxCharges;
            $CGSTAmt = $res[0]->CGSTAmt;
            $SGSTAmt = $res[0]->SGSTAmt;
            $IGSTAmt = $res[0]->IGSTAmt;
            $GrossAmount = $res[0]->GrossAmount;
            $TCSAmount = $res[0]->TCSAmount;
            $OtherAdd = $res[0]->OtherAdd;
            $LessCharges = $res[0]->LessCharges;
            $NetPayable = $res[0]->NetPayable;  
            $TotalPaid = $result[0]->amtPaid;      
            $BalanceDue = $NetPayable - $TotalPaid ;        

            $data1= array(
                'TotalAmount' => $TotalAmount,
                'ContainerChg' => $ContainerChg,
                'APMCChg' => $APMCChg,
                'AddAmt' => $AddAmt,
                'LessAmt' => $LessAmt,
                'TaxableAmt' => $TaxableAmt,
                'TaxCharges' => $TaxCharges,
                'CGSTAmt' => $CGSTAmt,
                'SGSTAmt' => $SGSTAmt,
                'IGSTAmt' => $IGSTAmt,
                'GrossAmount' => $GrossAmount,
                'TCSAmount' => $TCSAmount, 
                'OtherAdd' => $OtherAdd,
                'LessCharges' => $LessCharges,
                'NetPayable' => $NetPayable,
                'TotalPaid' => $TotalPaid, 
                'BalanceDue' => $BalanceDue
            ) ;
            // $this->db->where('RefIDNumber', $IDNumber);
        
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'RefIDNumber' => $IDNumber );
            $this->db->where($multi_where);
            $this->db->update('PurHeader', $data1);  
            
            
            $this->getGaruPurchaseDetails1($IDNumber);
        }

        // Generating LotNo
        public function garuPurchaseLotNo(){
            $WorkYear = $this->session->userdata('WorkYear');

            $sql= "select max(cast(LotNo as unsigned) ) LotNo
                    from PurDetails
                    where workyear = '$WorkYear'
                    order by lotno desc";

            $query = $this->db->query($sql);
            $result = $query->result();

            echo json_encode($result);
        }

        // Edit Data of Garu Purchase Header and Details (From Garu Purchase Grid View)
        public function garuPurchaseEdit($id){
           $CoID = $this->session->userdata('CoID') ;
           $WorkYear = $this->session->userdata('WorkYear');
   
           $this->load->model('NewGaruPurModel');
            //    $result1 = $this->NewGaruPurModel->getid($id);
           $result1 = $this->NewGaruPurModel->getEditid($id);
           $mid = $result1[0]->RefIDNumber; 
           $partyCode = $result1[0]->PartyCode;

           $this->form_validation->set_rules('InvoiceNo', 'InvoiceNo', 'trim');
   
           $data['SupplierList'] = $this->NewGaruPurModel->Get_Supplier_List();
           $data['BrokerList'] = $this->NewGaruPurModel->Get_Broker_List();
           $data['AreaList'] = $this->NewGaruPurModel->Get_Area_List();
   
           if ($this->form_validation->run() == FALSE) {    
                $data['Loaded_List'] = $this->NewGaruPurModel->get_load_data1($id); 
                $data['ItemList'] = $this->NewGaruPurModel->Get_Item_List();
                $data['GodownList'] = $this->NewGaruPurModel->Get_Godown_List();
                
                $data['TableData'] = $this->NewGaruPurModel->getTableDataIdWise($mid);
                $data['Total'] = $this->NewGaruPurModel->getTotal($mid);

                $data['GstNo'] = $this->NewGaruPurModel->getGstNo($partyCode);
                $data['StateCode'] = $this->NewGaruPurModel->getStateCode($partyCode);
                $this->load->view('NewGaruPurEdit', $data);     
           }
        }


        // 180521 Delete Data of Garu Purchase Header and Details (From Garu Purchase Grid View)
        public function garuPurchaseDelete($id){
            $CoID = $this->session->userdata('CoID') ;
            $WorkYear = $this->session->userdata('WorkYear');

            $sql="
                    select count(*) as nos
                    from SaleDetails, PurDetails, PurHeader
                    where SaleDetails.CoID = PurDetails.CoID
                        and SaleDetails.WorkYear = PurDetails.WorkYear
                        and SaleDetails.LotNo = PurDetails .LotNo
                        and SaleDetails.ItemMark = PurDetails.Mark 
                        
                        and PurDetails.CoID = PurHeader.CoID
                        and PurDetails.WorkYear = PurHeader.WorkYear
                        and PurDetails.IDNumber = PurHeader.RefIDNumber
                
                        and PurDetails.CoID = '$CoID'
                        and PurDetails.WorkYear = '$WorkYear'
                        and PurHeader.RefIDNumber = '$id'
                    ";
                
            $query = $this->db->query($sql);
            $result = $query->result();

            $nos = $result[0]->nos ;

            if ($nos == 0)
            {
                    // $this->db->where('IDNumber', $id);
                    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $id );
                    $this->db->where($multi_where);
                    $this->db->delete('PurDetails');

                    // $this->db->where('RefIDNumber', $id);
                    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'RefIDNumber' => $id );
                    $this->db->where($multi_where);
                    $this->db->delete('PurHeader');

                    echo "<script> " ;
                    echo "alert('Purchase Deleted Succesfully !! ' +$id);" ;
                    echo "window.location.href = '" . base_url() . "index.php/NewGaruPurController/show/'";
                    echo "</script>" ;
            }
            else
            {
                echo "<script> " ;
                echo "alert('Sales Already done, Can not Delete ' +$id);" ;
                echo "window.location.href = '" . base_url() . "index.php/NewGaruPurController/show/'";
                echo "</script>" ;
            }
        }

        // Delete Data of Garu Purchase Header and Details (From Garu Purchase Grid View)
        public function x_garuPurchaseDelete_180521($id){
            $CoID = $this->session->userdata('CoID') ;
            $WorkYear = $this->session->userdata('WorkYear');

            // $this->db->where('IDNumber', $id);
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $id );
            $this->db->where($multi_where);
            $this->db->delete('PurDetails');

            // $this->db->where('RefIDNumber', $id);
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'RefIDNumber' => $id );
            $this->db->where($multi_where);
            $this->db->delete('PurHeader');

            echo "<script> " ;
            echo "alert('Purchase Deleted Succesfully !! ' +$id);" ;
            echo "window.location.href = '" . base_url() . "index.php/NewGaruPurController/show/'";
            echo "</script>" ;
        }


        // Delete Data of Garu Purchase Header and Details (From Garu Purchase Insert View)
        public function garuPurDelInsertPg($id){
            $CoID = $this->session->userdata('CoID') ;
            $WorkYear = $this->session->userdata('WorkYear');

            // $this->db->where('IDNumber', $id);
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $id );
            $this->db->where($multi_where);
            $this->db->delete('PurDetails');

            // $this->db->where('RefIDNumber', $id);
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'RefIDNumber' => $id );
            $this->db->where($multi_where);
            $this->db->delete('PurHeader');
            return true;
        }


        // 180521
        public function getGaruPurchaseDetails($IDNumber){
            $CoID = $this->session->userdata('CoID') ;
            $WorkYear = $this->session->userdata('WorkYear');

            $sql="
                    select count(*) as nos
                    from SaleDetails, PurDetails
                    where SaleDetails.CoID = PurDetails.CoID
                        and SaleDetails.WorkYear = PurDetails.WorkYear
                        and SaleDetails.LotNo = PurDetails .LotNo
                        and SaleDetails.ItemMark = PurDetails.Mark 
                        and PurDetails.CoID = '$CoID'
                        and PurDetails.WorkYear = '$WorkYear'
                        and PurDetails.ID = '$ID'
                ";
                
            $query = $this->db->query($sql);
            $result = $query->result();

            $nos = $result[0]->nos ;

            if ($nos == 0)
            {
                $sql="
                        select PurDetails.*,
                            ItemMaster.UsualRatePer,
                            ItemMaster.APMCChg as APMCTax,
                            ItemMaster.APMCSChg as APMCSChrg
                        from PurDetails,ItemMaster
                        where ID = '$IDNumber'
                        and PurDetails.CoID ='$CoID' 
                        and PurDetails.WorkYear='$WorkYear'
                        and PurDetails.CoID = ItemMaster.CoID
                        and PurDetails.WorkYear=ItemMaster.WorkYear
                        and PurDetails.ItemCode= ItemMaster.ItemCode
                    ";

                    // $sql="
                    //         select PurDetails.*,ItemMaster.UsualRatePer
                    //         from PurDetails,ItemMaster
                    //         where ID = '$IDNumber'
                    //             and PurDetails.CoID ='$CoID' 
                    //             and PurDetails.WorkYear='$WorkYear'
                    //             and PurDetails.CoID = ItemMaster.CoID
                    //             and PurDetails.WorkYear=ItemMaster.WorkYear
                    //             and PurDetails.ItemCode= ItemMaster.ItemCode
                    //     ";
                    $query = $this->db->query($sql);
                    $result = $query->result();
                    echo json_encode($result);
            }
            else
            {
                echo "<script> " ;
                echo "alert('Sales Already done, Can not Edit ' +$id);" ;
                echo "window.location.href = '" . base_url() . "index.php/NewGaruPurController/show/'";
                echo "</script>" ;
            }
        }

        // 180521
        public function x_getGaruPurchaseDetails_180521($IDNumber){
            $CoID = $this->session->userdata('CoID') ;
            $WorkYear = $this->session->userdata('WorkYear');

            $sql="
                        select PurDetails.*,
                            ItemMaster.UsualRatePer,
                            ItemMaster.APMCChg as APMCTax,
                            ItemMaster.APMCSChg as APMCSChrg
                        from PurDetails,ItemMaster
                        where ID = '$IDNumber'
                        and PurDetails.CoID ='$CoID' 
                        and PurDetails.WorkYear='$WorkYear'
                        and PurDetails.CoID = ItemMaster.CoID
                        and PurDetails.WorkYear=ItemMaster.WorkYear
                        and PurDetails.ItemCode= ItemMaster.ItemCode
                ";

            // $sql="
            //         select PurDetails.*,ItemMaster.UsualRatePer
            //         from PurDetails,ItemMaster
            //         where ID = '$IDNumber'
            //             and PurDetails.CoID ='$CoID' 
            //             and PurDetails.WorkYear='$WorkYear'
            //             and PurDetails.CoID = ItemMaster.CoID
            //             and PurDetails.WorkYear=ItemMaster.WorkYear
            //             and PurDetails.ItemCode= ItemMaster.ItemCode
            //     ";
            $query = $this->db->query($sql);
            $result = $query->result();

            echo json_encode($result);
        }


        public function getGaruPurchaseDetails1($IDNumber){
            $CoID = $this->session->userdata('CoID') ;
            $WorkYear = $this->session->userdata('WorkYear');

            $sql="
                    select PurDetails.*,ItemMaster.UsualRatePer
                    from PurDetails,ItemMaster
                    where IDNumber = '$IDNumber'
                        and PurDetails.CoID ='$CoID' 
                        and PurDetails.WorkYear='$WorkYear'
                        and PurDetails.CoID = ItemMaster.CoID
                        and PurDetails.WorkYear=ItemMaster.WorkYear
                        and PurDetails.ItemCode= ItemMaster.ItemCode
                ";
            $query = $this->db->query($sql);
            $result = $query->result();
            
            echo json_encode($result);
        }


        // Update Data of Garu Purchase Header (PurHeader)
        public function garuPurchaseHeaderUpdate(){
            $CoID = $this->session->userdata('CoID') ;
            $WorkYear = $this->session->userdata('WorkYear');

            $RefIDNumber = $this->input->post('RefIDNumber');
            $data = array(
                    'GoodsRcptDate' => $this->input->post('GoodsRcptDate'),
                    'InvoiceNo'=> $this->input->post('InvoiceNo'),
                    'InvoiceDate'=> $this->input->post('InvoiceDate'),
                    'LRNo'=> $this->input->post('LRNo'),
                    'LRDate'=> $this->input->post('LRDate'),
                    'TransportCharges' => $this->input->post('TransChg'),
                    'DespatchFrom'=> $this->input->post('DespatchFrom'),
                    'DespatchTitle'=> $this->input->post('DespatchTitle'),
                    'DespatchTo'=> $this->input->post('DespatchTo'),
                    'DespatchToTitle'=> $this->input->post('DespatchToTitle'),
                    'PartyCode'=> $this->input->post('PartyCode'),
                    'PartyName'=> $this->input->post('PartyName'),
                    'BrokerCode'=> $this->input->post('BrokerCode'),
                    'BrokerTitle'=> $this->input->post('BrokerTitle'),
                    'CoId' => $CoID,
                    'WorkYear' => $WorkYear
            );
            // $this->db->where('RefIDNumber',$RefIDNumber);
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'RefIDNumber' => $RefIDNumber );
            $this->db->where($multi_where);
            $this->db->update('PurHeader', $data);  


            // Updating PurDetails Table
            $data = array(
                'CoID' => $CoID,
                'WorkYear' => $WorkYear,
                'GoodsRcptDate' => $this->input->post('GoodsRcptDate'),
                'PartyCode' => $this->input->post('PartyCode'),
                'BrokerCode' => $this->input->post('BrokerCode')
            );

            // $this->db->where('IDNumber',$RefIDNumber);
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'IDNumber' => $RefIDNumber );
            $this->db->where($multi_where);
            $this->db->update('PurDetails', $data);  
        }

        // Update Data of Garu Purchase Details (PurDetails)
        public function garuPurchaseDetailsUpdate(){
            $CoID = $this->session->userdata('CoID') ;
            $WorkYear = $this->session->userdata('WorkYear');

            $ID = $this->input->post('ID');
            $IDNumber = $this->input->post('IDNumber');
            $GodownID = $this->input->post('GodownID');
            $LotNo = $this->input->post('LotNo');
            $Qty = $this->input->post('Qty');


            $StateCode = $this->input->post('StateCode');
            $TaxCharges = floatval( $this->input->post('TaxCharges'));
            $CGSTAmt = "";
            $SGSTAmt = "";
            $IGSTAmt = "";

            if($StateCode === "27"){
                $CGSTAmt = $TaxCharges/2;
                $SGSTAmt = $TaxCharges/2;
            }
            else{
                $IGSTAmt = $TaxCharges;
            }


            $sqlQDispatched="
                        SELECT sum(Qty) QtyDispatched 
                        FROM SaleDetails
                        where CoID = '$CoID' 
                        and WorkYear = '$WorkYear'
                        and GodownID = '$GodownID' 
                        and LotNo = '$LotNo' 
                    ";
            $queryQDispatched = $this->db->query($sqlQDispatched);
            $resQDispatched = $queryQDispatched->result();

            $closingQTY = $Qty - $resQDispatched[0]->QtyDispatched;

            // Updating PurDetails Table
            $data = array(
                    'CoID' => $CoID,
                    'WorkYear' => $WorkYear,
                    'GoodsRcptDate' => $this->input->post('GoodsRcptDate'),
                    'GodownID' => $this->input->post('GodownID'),
                    'PartyCode' => $this->input->post('PartyCode'),
                    'BrokerCode' => $this->input->post('BrokerCode'),
                    'LotNo' => $this->input->post('LotNo'),
                    'ItemCode' => $this->input->post('ItemCode'),
                    'ItemName' => $this->input->post('ItemName'),
                    'Packing'=> $this->input->post('Packing'),
                    'Mark' => $this->input->post('Mark'),   
                    'Qty'=> $this->input->post('Qty'),
                    'ClosingQty' => $closingQTY,
                    'Units'=> $this->input->post('Units'),
                    'Weight'=> $this->input->post('Weight'),
                    'Rate'=> $this->input->post('Rate'),
                    'APMCInd'=> $this->input->post('APMCInd'),
                    'ETaxInd'=> $this->input->post('ETaxInd'),
                    'Amount' => $this->input->post('Amount'),
                    'ContChg' => $this->input->post('ContChg'),
                    'APMCChg' => $this->input->post('APMCChg'),
                    'AddAmt' => $this->input->post('AddAmt'),
                    'LessAmt' => $this->input->post('LessAmt'),
                    'TaxableAmt' => $this->input->post('TaxableAmt'),
                    'TaxRate' => $this->input->post('TaxRate'),
                    'TaxCharges' => $this->input->post('TaxCharges'),
                    'CGSTAmt' => $CGSTAmt,
                    'SGSTAmt' => $SGSTAmt,
                    'IGSTAmt' => $IGSTAmt,
                    'GrossAmount' => $this->input->post('GrossAmount'),
                    'TCSAmount' => $this->input->post('TCSAmount'),
                    'OtherAdd' => $this->input->post('OtherAdd'),
                    'LessCharges' => $this->input->post('LessCharges'),
                    'NetPayable' => $this->input->post('NetPayable'),
                    
            );

            // $this->db->where('ID',$ID);
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'ID' => $ID , 'IDNumber' =>$IDNumber);
            $this->db->where($multi_where);
            $this->db->update('PurDetails', $data);  


            //Updating PurHeader Table
            $this->load->model('NewGaruPurModel');
            $res = $this->NewGaruPurModel->getData($IDNumber);

            $sql="
                    select sum(TotalPay) amtPaid 
                    FROM PurPayments
                    where CoID ='$CoID' 
                    and WorkYear='$WorkYear'
                    and RefIDNumber = '$IDNumber'
                ";
                
            $query = $this->db->query($sql);
            $result = $query->result();
            
            $TotalAmount = $res[0]->Amount;
            $ContainerChg = $res[0]->ContChg;
            $APMCChg = $res[0]->APMCChg;
            $AddAmt = $res[0]->AddAmt;
            $LessAmt = $res[0]->LessAmt;
            $TaxableAmt = $res[0]->TaxableAmt;
            $TaxCharges = $res[0]->TaxCharges;
            $CGSTAmt = $res[0]->CGSTAmt;
            $SGSTAmt = $res[0]->SGSTAmt;
            $IGSTAmt = $res[0]->IGSTAmt;
            $GrossAmount = $res[0]->GrossAmount;
            $TCSAmount = $res[0]->TCSAmount;
            $OtherAdd = $res[0]->OtherAdd;
            $LessCharges = $res[0]->LessCharges;
            $NetPayable = $res[0]->NetPayable;
            $TotalPaid = $result[0]->amtPaid;      
            $BalanceDue = $NetPayable - $TotalPaid ; 

            $data1= array(
                'TotalAmount' => $TotalAmount,
                'ContainerChg' => $ContainerChg,
                'APMCChg' => $APMCChg,
                'AddAmt' => $AddAmt,
                'LessAmt' => $LessAmt,
                'TaxableAmt' => $TaxableAmt,
                'TaxCharges' => $TaxCharges,
                'CGSTAmt' => $CGSTAmt,
                'SGSTAmt' => $SGSTAmt,
                'IGSTAmt' => $IGSTAmt,
                'GrossAmount' => $GrossAmount,
                'TCSAmount' => $TCSAmount,
                'OtherAdd' => $OtherAdd,
                'LessCharges' => $LessCharges,
                'NetPayable' => $NetPayable, 
                'TotalPaid' => $TotalPaid, 
                'BalanceDue' => $BalanceDue
            ) ;

            // $this->db->where('IDNumber', $IDNumber);
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'RefIDNumber' => $IDNumber );
            $this->db->where($multi_where);
            $this->db->update('PurHeader', $data1);  
        
        
            // Fetching Data from PurHeader table to display on view (TotalQuantity, TotalAmt,ContChg,ApmcChg,Other Charges 1.... Table)
            $res1 = $this->NewGaruPurModel->getTotal($IDNumber);
            echo json_encode($res1);
        }


        // 180521
        // Delete Data from Garu Purchase Details (PurDetails)
        public function garuPurchaseDetailsDelete($ID){
            $CoID = $this->session->userdata('CoID') ;
            $WorkYear = $this->session->userdata('WorkYear');


            $sql="
                    select count(*) as nos
                    from SaleDetails, PurDetails
                    where SaleDetails.CoID = PurDetails.CoID
                        and SaleDetails.WorkYear = PurDetails.WorkYear
                        and SaleDetails.LotNo = PurDetails .LotNo
                        and SaleDetails.ItemMark = PurDetails.Mark 
                        and PurDetails.CoID = '$CoID'
                        and PurDetails.WorkYear = '$WorkYear'
                        and PurDetails.ID = '$ID'
                ";
                
            $query = $this->db->query($sql);
            $result = $query->result();

            $nos = $result[0]->nos ;
            // print_r ($result);
            // echo "<br>";
            // echo 'Count ' . $nos ;
            // die ; 

            $IDNumber = $this->input->post('IDNumber');

            if ($nos == 0)
            {
                        // Delete Item from PurDetails Table
                        // $this->db->where('ID', $ID);
                        $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'ID' => $ID );
                        $this->db->where($multi_where);
                        $this->db->delete('PurDetails');


                        //Updating PurHeader Table
                        $this->load->model('NewGaruPurModel');
                        $res = $this->NewGaruPurModel->getData($IDNumber);

                        $sql="
                                select sum(TotalPay) amtPaid 
                                FROM PurPayments
                                where CoID ='$CoID' 
                                and WorkYear='$WorkYear'
                                and RefIDNumber = '$IDNumber'
                            ";
                            
                        $query = $this->db->query($sql);
                        $result = $query->result();
                        
                        $TotalAmount = $res[0]->Amount;
                        $ContainerChg = $res[0]->ContChg;
                        $APMCChg = $res[0]->APMCChg;
                        $AddAmt = $res[0]->AddAmt;
                        $LessAmt = $res[0]->LessAmt;
                        $TaxableAmt = $res[0]->TaxableAmt;
                        $TaxCharges = $res[0]->TaxCharges;
                        $CGSTAmt = $res[0]->CGSTAmt;
                        $SGSTAmt = $res[0]->SGSTAmt;
                        $IGSTAmt = $res[0]->IGSTAmt;
                        $GrossAmount = $res[0]->GrossAmount;
                        $OtherAdd = $res[0]->OtherAdd;
                        $LessCharges = $res[0]->LessCharges;
                        $NetPayable = $res[0]->NetPayable; 
                        $TotalPaid = $result[0]->amtPaid;      
                        $BalanceDue = $NetPayable - $TotalPaid ;        

                        $data1= array(
                            'TotalAmount' => $TotalAmount,
                            'ContainerChg' => $ContainerChg,
                            'APMCChg' => $APMCChg,
                            'AddAmt' => $AddAmt,
                            'LessAmt' => $LessAmt,
                            'TaxableAmt' => $TaxableAmt,
                            'TaxCharges' => $TaxCharges,
                            'CGSTAmt' => $CGSTAmt,
                            'SGSTAmt' => $SGSTAmt,
                            'IGSTAmt' => $IGSTAmt,
                            'GrossAmount' => $GrossAmount,
                            'OtherAdd' => $OtherAdd,
                            'LessCharges' => $LessCharges,
                            'NetPayable' => $NetPayable,
                            'TotalPaid' => $TotalPaid, 
                            'BalanceDue' => $BalanceDue

                        ) ;

                        // $this->db->where('IDNumber', $IDNumber);
                        $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'RefIDNumber' => $IDNumber );
                        $this->db->where($multi_where);
                        $this->db->update('PurHeader', $data1);
            }
            // Fetching Data from PurHeader table to display on view (TotalQuantity, TotalAmt,ContChg,ApmcChg,Other Charges 1.... Table)
            $res1 = $this->NewGaruPurModel->getTotal($IDNumber);
            echo json_encode($res1);
        }

        // Delete Data from Garu Purchase Details (PurDetails)
        public function x_garuPurchaseDetailsDelete_180521($ID){
            $CoID = $this->session->userdata('CoID') ;
            $WorkYear = $this->session->userdata('WorkYear');

            $IDNumber = $this->input->post('IDNumber');

            // Delete Item from PurDetails Table
            // $this->db->where('ID', $ID);
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'ID' => $ID );
            $this->db->where($multi_where);
            $this->db->delete('PurDetails');


            //Updating PurHeader Table
            $this->load->model('NewGaruPurModel');
            $res = $this->NewGaruPurModel->getData($IDNumber);

            $sql="
                    select sum(TotalPay) amtPaid 
                    FROM PurPayments
                    where CoID ='$CoID' 
                    and WorkYear='$WorkYear'
                    and RefIDNumber = '$IDNumber'
                ";
                
            $query = $this->db->query($sql);
            $result = $query->result();
            
            $TotalAmount = $res[0]->Amount;
            $ContainerChg = $res[0]->ContChg;
            $APMCChg = $res[0]->APMCChg;
            $AddAmt = $res[0]->AddAmt;
            $LessAmt = $res[0]->LessAmt;
            $TaxableAmt = $res[0]->TaxableAmt;
            $TaxCharges = $res[0]->TaxCharges;
            $CGSTAmt = $res[0]->CGSTAmt;
            $SGSTAmt = $res[0]->SGSTAmt;
            $IGSTAmt = $res[0]->IGSTAmt;
            $GrossAmount = $res[0]->GrossAmount;
            $OtherAdd = $res[0]->OtherAdd;
            $LessCharges = $res[0]->LessCharges;
            $NetPayable = $res[0]->NetPayable; 
            $TotalPaid = $result[0]->amtPaid;      
            $BalanceDue = $NetPayable - $TotalPaid ;        

            $data1= array(
                'TotalAmount' => $TotalAmount,
                'ContainerChg' => $ContainerChg,
                'APMCChg' => $APMCChg,
                'AddAmt' => $AddAmt,
                'LessAmt' => $LessAmt,
                'TaxableAmt' => $TaxableAmt,
                'TaxCharges' => $TaxCharges,
                'CGSTAmt' => $CGSTAmt,
                'SGSTAmt' => $SGSTAmt,
                'IGSTAmt' => $IGSTAmt,
                'GrossAmount' => $GrossAmount,
                'OtherAdd' => $OtherAdd,
                'LessCharges' => $LessCharges,
                'NetPayable' => $NetPayable,
                'TotalPaid' => $TotalPaid, 
                'BalanceDue' => $BalanceDue

            ) ;

            // $this->db->where('IDNumber', $IDNumber);
            $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'RefIDNumber' => $IDNumber );
            $this->db->where($multi_where);
            $this->db->update('PurHeader', $data1);

            // Fetching Data from PurHeader table to display on view (TotalQuantity, TotalAmt,ContChg,ApmcChg,Other Charges 1.... Table)
            $res1 = $this->NewGaruPurModel->getTotal($IDNumber);
            echo json_encode($res1);
        }


     // Report Functions Kajal

    //updated 13-02-21
    function TaxablePurDatewise(){
        $this->load->model('NewGaruPurModel');
        $data['result'] = $this->NewGaruPurModel->get_TaxablePurDatewise();
        // print_r ($data);
        // die ; 
        $this->load->view('menu_1.php');
        $this->load->view('TaxablePurDatewise_View',$data);
    }

    //updated 13-02-21
    function TaxablepurDatewiseFilter(){
        if($this->input->post('submit') != NULL ){
            $postData = $this->input->post();
        
            // Read POST data
            $fromYear = $postData['fromYear'];
            $toYear = $postData['toYear'];

            $this->load->model('NewGaruPurModel');
            $data['result'] = $this->NewGaruPurModel->get_TaxablePurDatewiseFilter($fromYear,$toYear);

            $this->load->view('menu_1.php');
            $this->load->view('TaxablePurDatewise_View',$data,$fromYear,$toYear);
        }
    }

    //updated 13-02-21
    function ItemwisePurDatewise(){
      $this->load->model('NewGaruPurModel');
      $data['result'] = $this->NewGaruPurModel->get_ItemwisePurDatewise();
      // print_r ($data);
      // die ; 
      $this->load->view('menu_1.php');
      $this->load->view('ItemwisePurDatewise_View',$data);
    }

    //updated 13-02-21
    function ItemwisepurDatewiseFilter(){
      if($this->input->post('submit') != NULL ){
        $postData = $this->input->post();
   
        // Read POST data
        $fromYear = $postData['fromYear'];
        $toYear = $postData['toYear'];

        $this->load->model('NewGaruPurModel');
        $data['result'] = $this->NewGaruPurModel->get_ItemwisePurDatewiseFilter($fromYear,$toYear);

        $this->load->view('menu_1.php');
        $this->load->view('ItemwisePurDatewise_View',$data,$fromYear,$toYear);
      }
    }        
    }
?>