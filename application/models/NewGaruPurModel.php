<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NewGaruPurModel extends CI_Model
{
    function __construct(){
          // Call the Model constructor
        parent::__construct();
    }

    // Get Purchase Details for GaruPurchaseGrid
    function get_details(){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;

        $fromYear="";$toYear="";
        $current_month = date("m");
        $current_year = date("Y");
        $yearArray = explode("-",$WorkYear);
        $year = explode("-",$yearArray[0]);
        $WY = substr($year[0], 0, 2).$yearArray[1];

        if((int)$WY > (int)$current_year)
        {
          $fromYear = date("$current_year-$current_month-01");
          $toYear = date("$current_year-$current_month-t");
        }
        else{
          $fromYear = date("$WY-03-01");
          $toYear = date("$WY-03-t");
        }

        $sql = "        
                  SELECT 
                    PurHeader.RefIDNumber RefIDNumber,
                    InvoiceNo,
                    LRNo,
                    PurHeader.GoodsRcptDate,
                    InvoiceDate,
                    LRDate,
                    DespatchFrom,
                    DespatchTitle,
                    DespatchTo,
                    DespatchToTitle,
                    PurHeader.PartyCode,
                    ACMaster.ACTitle PartyName,
                    PurHeader.BrokerCode,
                    (select ACTitle from ACMaster Broker 
                    where PurHeader.BrokerCode = Broker.ACCode 
                        and PurHeader.WorkYear = Broker.WorkYear
                        and PurHeader.CoID = Broker.CoID) as BrokerTitle,
                    TotalAmount,
                    ContainerChg,
                    PurHeader.APMCChg,
                    PurHeader.AddAmt,
                    PurHeader.LessAmt,
                    PurHeader.TaxableAmt,
                    PurHeader.TaxCharges,
                    PurHeader.IGSTAmt,
                    ImpIGSTAmt,
                    PurHeader.GrossAmount,
                    PurHeader.OtherAdd,
                    PurHeader.LessCharges,
                    PurHeader.NetPayable,
                    TransportCharges      
                  FROM PurHeader, ACMaster

                  where  PurHeader.CoID = ACMaster.CoID
                    and PurHeader.WorkYear = ACMaster.WorkYear
                    and PurHeader.PartyCode = ACMaster.ACCode
                    and PurHeader.CoId = '$CoID'
                    and PurHeader.WorkYear = '$WorkYear'
                    and PurHeader.GoodsRcptDate BETWEEN '$fromYear' AND '$toYear'
                  order by PurHeader.GoodsRcptDate desc
        ";
        // $query = $this->db->query($sql);
        // $result = $query->result();
        // return $result;  
        
        $result = $this->db->query($sql)->result_array();

        if(empty($result)){
          $emptyArray=array("empty");   
          return array($emptyArray,$fromYear,$toYear);
        }

        return array($result,$fromYear,$toYear);
      }

    // Get Purchase Details Datewise for GaruPurchaseGrid
    function get_detailsFilter($fromYear,$toYear){
      $CoID = $this->session->userdata('CoID') ;
      $WorkYear = $this->session->userdata('WorkYear') ; 

      $sql = "           
                SELECT 
                    PurHeader.RefIDNumber RefIDNumber,
                    InvoiceNo,
                    LRNo,
                    PurHeader.GoodsRcptDate,
                    InvoiceDate,
                    LRDate,
                    DespatchFrom,
                    DespatchTitle,
                    DespatchTo,
                    DespatchToTitle,
                    PurHeader.PartyCode,
                    (SELECT 
                            ACTitle
                        FROM
                            ACMaster 
                        WHERE
                            PurHeader.PartyCode = ACMaster.ACCode
                                AND PurHeader.WorkYear = ACMaster.WorkYear
                                AND PurHeader.CoID = ACMaster.CoID
                                AND PurHeader.WorkYear = ACMaster.WorkYear) AS PartyName,
                    
                    PurHeader.BrokerCode,
                    (SELECT 
                            ACTitle
                        FROM
                            ACMaster Broker
                        WHERE
                            PurHeader.BrokerCode = Broker.ACCode
                                AND PurHeader.WorkYear = Broker.WorkYear
                                AND PurHeader.CoID = Broker.CoID
                                AND PurHeader.WorkYear = Broker.WorkYear) AS BrokerTitle,
                    TotalAmount,
                    ContainerChg,
                    PurHeader.APMCChg,
                    PurHeader.AddAmt,
                    PurHeader.LessAmt,
                    PurHeader.TaxableAmt,
                    PurHeader.TaxCharges,
                    PurHeader.IGSTAmt,
                    ImpIGSTAmt,
                    PurHeader.GrossAmount,
                    PurHeader.OtherAdd,
                    PurHeader.LessCharges,
                    PurHeader.NetPayable,
                    TransportCharges
                FROM
                    PurHeader
                WHERE
                    PurHeader.CoId = '$CoID'
                        AND PurHeader.WorkYear = '$WorkYear'
                        AND PurHeader.GoodsRcptDate BETWEEN '$fromYear' AND '$toYear'
                ORDER BY PurHeader.GoodsRcptDate DESC
      ";
      
      $result = $this->db->query($sql)->result_array();

      if(empty($result)){
            $emptyArray=array("empty");   
            return array($emptyArray,$fromYear,$toYear);
      }

      return  array($result,$fromYear,$toYear); 
    }

    function getTableData(){
        $sql ="
                SELECT * 
                    FROM PurDetails 
                    INNER JOIN PurHeader ON 
                            PurDetails.IDNumber=PurHeader.RefIDNumber 
                WHERE PurHeader.RefIDNumber=''";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function Get_Supplier_List(){   
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;

        $sql ="
            SELECT
                    ACMaster.ACCode,
                    ACMaster.ACTitle,
                    ACMastDets.GSTNo,
                    ACMastDets.StateCode,
                    ACMaster.GroupCode,
                    ACMaster.BrokerCode, 
                    (select ACTitle from ACMaster Broker 
                        where ACMaster.BrokerCode = Broker.ACCode 
                        and ACMaster.WorkYear = Broker.WorkYear
                        and ACMaster.CoID = Broker.CoID) as BrokerTitle
            FROM  ACMaster, ACMastDets
            WHERE ACMaster.CoID = '$CoID'
                AND ACMaster.WorkYear = '$WorkYear'
                AND ACMaster.GroupCode = 'BC'
                AND ACMaster.ACCode = ACMastDets.ACCode
                AND ACMaster.CoID = ACMastDets.CoID 
                AND ACMaster.WorkYear = ACMastDets.WorkYear
            ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function Get_Broker_List(){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;

        $sql ="
            SELECT
                ACMaster.ACCode,
                ACMaster.ACTitle,
                ACMastDets.GSTNo,
                ACMaster.GroupCode,
                ACMaster.BrokerCode
            FROM  ACMaster, ACMastDets
            WHERE ACMaster.CoID = '$CoID'
                AND ACMaster.WorkYear = '$WorkYear'
                AND ACMaster.GroupCode = 'B1'
                AND ACMaster.ACCode = ACMastDets.ACCode
                AND ACMaster.CoID = ACMastDets.CoID 
                AND ACMaster.WorkYear = ACMastDets.WorkYear

              ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function Get_Area_List(){
        $sql ="
        SELECT
          AreaCode,
          AreaName
        FROM AreaMaster";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function Get_Item_List(){

        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;

        $sql ="
            SELECT ItemMaster.ItemCode,
                ItemName,
                UsualRate,
                UsualRatePer,
                UOM,
                Packing,
                GST_P,
                TaxCode, TaxTitle, TaxRate, 
                APMCChg as APMCTax,
                APMCSChg as APMCSChrg,APMCInd
            from ItemMaster 
            WHERE WorkYear = '$WorkYear'
            AND CoID = '$CoID'
        ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function Get_Godown_List(){

        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;

        $sql ="
            SELECT
                GodownID,
                GodownDesc
            FROM Godown
            WHERE CoID = '$CoID'
                AND WorkYear = '$WorkYear'
            ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function getDispatchedFrom($AreaCode){
        $query = $this->db
                    -> select('AreaCode, AreaName')
                    -> from ('AreaMaster')
                    -> where ("AreaCode like '$AreaCode%'")
                    -> order_by('AreaCode')
                    -> get();
        return $query->result_array();
    }

    function getSuppliers($ACCode){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear');

        $sql ="
                SELECT
                      ACMaster.ACCode, ACMaster.ACTitle, ACMaster.BrokerCode, 
                        (select ACTitle from ACMaster Broker 
                        where ACMaster.BrokerCode = Broker.ACCode 
                        and ACMaster.WorkYear = Broker.WorkYear
                        and ACMaster.CoID = Broker.CoID) as BrokerTitle,
                      ACMastDets.City,ACMastDets.GSTNo,ACMastDets.StateCode
                FROM  ACMaster,  ACMastDets
                WHERE ACMaster.CoID = '$CoID'
                  AND ACMaster.WorkYear = '$WorkYear'

                  AND ACMaster.ACCode = ACMastDets.ACCode
                  AND ACMaster.CoID = ACMastDets.CoID 
                  AND ACMaster.WorkYear = ACMastDets.WorkYear
  
                  AND ACMaster.ACCode like '$ACCode%'
                  AND ACMaster.GroupCode = 'BC'
              ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    // 270421
    function getSuppliersName($ACTitle){
      $CoID = $this->session->userdata('CoID') ;
      $WorkYear = $this->session->userdata('WorkYear');

      $sql ="
              SELECT
                    ACMaster.ACCode, ACMaster.ACTitle, ACMaster.BrokerCode, 
                      (select ACTitle from ACMaster Broker 
                      where ACMaster.BrokerCode = Broker.ACCode 
                      and ACMaster.WorkYear = Broker.WorkYear
                      and ACMaster.CoID = Broker.CoID) as BrokerTitle,
                    ACMastDets.City,ACMastDets.GSTNo,ACMastDets.StateCode
              FROM  ACMaster,  ACMastDets
              WHERE ACMaster.CoID = '$CoID'
                AND ACMaster.WorkYear = '$WorkYear'

                AND ACMaster.ACCode = ACMastDets.ACCode
                AND ACMaster.CoID = ACMastDets.CoID 
                AND ACMaster.WorkYear = ACMastDets.WorkYear

                AND ACMaster.ACTitle like '$ACTitle%'
                AND ACMaster.GroupCode = 'BC'
            ";
      $query = $this->db->query($sql);
      return $query->result_array();
  }

    function getBrokers($ACCode){

        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear');


        $sql ="
                SELECT
                      ACMaster.ACCode, ACMaster.ACTitle
                FROM  ACMaster
                WHERE ACMaster.CoID = '$CoID'
                  AND ACMaster.WorkYear = '$WorkYear'
                  AND ACMaster.ACCode like '$ACCode%'
              ";
        $query = $this->db->query($sql);
        return $query->result_array();

    }

    // 270421
    function getBrokername($ACTitle){

      $CoID = $this->session->userdata('CoID') ;
      $WorkYear = $this->session->userdata('WorkYear');


      $sql ="
              SELECT
                    ACMaster.ACCode, ACMaster.ACTitle
              FROM  ACMaster
              WHERE ACMaster.CoID = '$CoID'
                AND ACMaster.WorkYear = '$WorkYear'
                AND ACMaster.ACTitle like '$ACTitle%'
            ";
      $query = $this->db->query($sql);
      return $query->result_array();

  }

    function getGodown($GodownId){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;

        $sql ="
                  SELECT
                    GodownID,
                    GodownDesc
                  FROM Godown
                  WHERE CoID = '$CoID'
                    AND WorkYear = '$WorkYear'
                    and GodownId Like '$GodownId%'
              ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getItem($ItemCode){  
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;

        $sql ="
                  SELECT 
                        ItemMaster.ItemCode,
                        ItemName,
                        UsualRate,
                        UsualRatePer,
                        UOM,
                        Packing,
                        GST_P,
                        TaxCode, TaxTitle, TaxRate, 
                        APMCChg as APMCTax,
                        APMCSChg as APMCSChrg
                    from ItemMaster 
                    WHERE WorkYear = '$WorkYear'
                      AND CoID = '$CoID'
                      AND ItemCode like '$ItemCode%'
                  ";
          $query = $this->db->query($sql);
          return $query->result_array();
    }

    function getEditId($id){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;

        $sql="
                SELECT RefIDNumber,PartyCode 
                    from PurHeader 
                WHERE RefIDNumber ='$id'
                  and CoID = '$CoID'
                  AND WorkYear = '$WorkYear'
          ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;

    }

    function getid($id){
        // $sql="SELECT IDNumber,PartyCode from PurHeader WHERE RefIDNumber ='$id'";
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;
        $sql="
        
                SELECT LastGaruPurRefIDNumber 
                  from CompData 
                  WHERE CoID = '$CoID'
                  AND WorkYear = '$WorkYear'
        
        ";
        $query = $this->db->query($sql);
        $result = $query->result();

        $NewValue = IntVal($result[0]->LastGaruPurRefIDNumber)+1;

        $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear );
        $data2 = array('LastGaruPurRefIDNumber' => $NewValue);              
        $this->db->where($multi_where);
        $this->db->update('CompData', $data2);

        return strval($NewValue);
    }

    function getGstNo($partyCode){
      $CoID = $this->session->userdata('CoID') ;
      $WorkYear = $this->session->userdata('WorkYear') ;
      $sql = "SELECT GSTNo 
                    FROM ACMastDets
                    Where ACCode = '$partyCode'
                    AND ACMastDets.CoID = '$CoID' 
                    AND ACMastDets.WorkYear = '$WorkYear'
        ";
        
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function getStateCode($partyCode){
      $CoID = $this->session->userdata('CoID') ;
      $WorkYear = $this->session->userdata('WorkYear') ;
        $sql = "SELECT StateCode 
                    FROM ACMastDets
                    Where ACCode = '$partyCode'
                    AND ACMastDets.CoID = '$CoID' 
                    AND ACMastDets.WorkYear = '$WorkYear'

                    ;
        ";
        
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function getData($IDNumber){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;
        $sql=" 
                SELECT 
                    sum(QTY) as QTY,
                    sum(Amount) as Amount,
                    sum(ContChg) as ContChg,
                    sum(APMCChg) as APMCChg,
                    sum(AddAmt) as AddAmt,
                    sum(LessAmt) as LessAmt,
                    sum(TaxableAmt) as TaxableAmt,
                    sum(TaxCharges) as TaxCharges,
                    sum(CGSTAmt) as CGSTAmt,
                    sum(SGSTAmt) as SGSTAmt,
                    sum(IGSTAmt) as IGSTAmt,
                    sum(GrossAmount) as GrossAmount,
                    sum(TCSAmount) as TCSAmount,
                    sum(OtherAdd) as OtherAdd,
                    sum(LessCharges) as LessCharges,
                    sum(NetPayable) as NetPayable 
                FROM PurDetails 
                where IDNumber = '$IDNumber'
                AND CoID = '$CoID' 
                AND WorkYear = '$WorkYear' 
            ";

            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
    }

    function get_load_data1($id){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;

        $this->db->select('RefIDNumber');
        $this->db->select('InvoiceNo');
        $this->db->select('LRNo');
        $this->db->select('GoodsRcptDate');
        $this->db->select('InvoiceDate');
        $this->db->select('LRDate');
        $this->db->select('TransportCharges');
        $this->db->select('DespatchFrom');
        $this->db->select('DespatchTitle');
        $this->db->select('DespatchTo');
        $this->db->select('DespatchToTitle');
        $this->db->select('PartyCode');
        $this->db->select('PartyName');
        $this->db->select('BrokerCode');
        $this->db->select('BrokerTitle');
        
        $this->db->from('PurHeader');

        $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear, 'RefIDNumber' => $id );
        // $this->db->where('RefIDNumber', $id);
        $this->db->where($multi_where);
        $query = $this->db->get();
          
        $result = $query->result();
        return $result;

    }

    function getTableDataIdWise($id){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;

        $sql ="
                  SELECT 
                        ID,
                        IDNumber, 
                        GodownID,  
                        LotNo,
                        PurDetails.ItemCode, 
                        PurDetails.ItemName,
                        PurDetails.Packing, 
                        Mark, 
                        Qty ,
                        PurDetails.Units, 
                        Weight, 
                        Rate,
                        PurDetails.APMCInd, 
                        ETaxInd, 
                        Amount , 
                        ContChg ,
                        PurDetails.APMCChg ,
                        AddAmt  ,
                        LessAmt ,
                        TaxableAmt,   
                        PurDetails.TaxRate ,
                        TaxCharges, 
                        GrossAmount, 
                        TCSAmount,
                        OtherAdd ,
                        LessCharges, 
                        NetPayable,
                        Transport,
                        ItemMaster.UsualRatePer
                  FROM PurDetails,ItemMaster
                  WHERE IDNumber = '$id'
                  and PurDetails.CoID ='$CoID' 
                        and PurDetails.WorkYear='$WorkYear'
                        and PurDetails.CoID = ItemMaster.CoID
                        and PurDetails.WorkYear=ItemMaster.WorkYear
                        and PurDetails.ItemCode=ItemMaster.ItemCode;";
          
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
    }

    function getTotal($id){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;

        $sql ="
            SELECT 
                PartyCode,
                ACMastDets.ACCode,
                StateCode, 
                if(StateCode !=27,sum(TaxCharges),sum(TaxCharges)/2) as TaxChargeBreakUp,
                sum(Amount) AS TotalAmount ,
                sum(Qty) AS TotalQty,
                sum(ContChg) AS ContainerCharge,
                SUM(APMCChg) As APMCCharge,
                AddAmt,
                LessAmt,
                sum(AddAmt - LessAmt) as OtherCharge1,
                sum(TaxableAmt) as TaxableAmount,
                sum(TaxCharges) AS TaxCharge,
                sum(CGSTAmt) as CGSTAmt,
                sum(SGSTAmt) as SGSTAmt,
                sum(IGSTAmt) as IGSTAmt,
                sum(GrossAmount) as GrossAmounts,
                sum(TCSAmount) as TCSAmount,
                OtherAdd,
                LessCharges,
                sum(OtherAdd - LessCharges) as OtherCharge2, 
                sum(NetPayable) As NetPayables,
                sum(Transport) As Transport
            from PurDetails, ACMastDets
            WHERE IDNumber = '$id'
            and PurDetails.PartyCode = ACMastDets.ACCode
            and PurDetails.CoID = ACMastDets.CoID
            and PurDetails.WorkYear = ACMastDets.WorkYear
            and PurDetails.CoID = '$CoID'
            and PurDetails.WorkYear = '$WorkYear'
        ";

        // from PurDetails,ACMastDets 050421

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function getDetails($ID){
        $CoID = $this->session->userdata('CoID') ;
           $WorkYear = $this->session->userdata('WorkYear');
           $sql="
                    select * 
                    from PurDetails 
                    where ID = '$ID'
                    and CoID ='$CoID' 
                    and WorkYear='$WorkYear'
                ";
            $query = $this->db->query($sql);
            $result = $query->result();
    }

    // Report functions Kajal 
      //updated 13-02-21
      function get_TaxablePurDatewise()
      {
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ; 
        //$WorkYear = '2019-20';
          $sql="";$f="";$t="";
          $dt=date("d-m-yy");
          $current_month = date("m");
          $current_year = date("yy");
          $w=explode("-",$WorkYear);
          $WY = '20'.$w[1];

          if((int)$WY > (int)$current_year)
          {
            $f = date("$current_year-$current_month-01", strtotime($dt));
            $t = date("$current_year-$current_month-t", strtotime($dt));
          }
          else{
            $f = date("$WY-03-01", strtotime($dt));
            $t = date("$WY-03-t", strtotime($dt));
          }
                $sql = "        
                      select distinct
                            ph.IDNumber,
                            DATE_FORMAT(ph.GoodsRcptDate,'%d-%m-%Y') as 'GDN Date',
                            ph.InvoiceNo as 'BillNo',
                            DATE_FORMAT(ph.InvoiceDate,'%d-%m-%Y') as 'BillDate',
                            ph.PartyCode as 'Party Code',
                            ac.ACTitle as 'Party Name',
                            ph.DespatchFrom,
                            ph.DespatchTo,
                            ph.BrokerCode as 'Broker Code',
                            ac1.ACTitle as 'Broker Name',
                            ph.TotalAmount as 'Item Amount',
                            ph.TaxCharges,
                            ph.GrossAmount as 'Bill Amt',
                            ph.TaxIndicator,

                            CONCAT(ad.AddressI,' ',ad.AddressII,' ',ad.AddressIII,' ',ad.GalaNo,' ',ad.City,' ',ad.Pin,' ',ad.StateName) as 'Address',
                            ad.GSTNo
                      from
                      PurHeader ph left join PurDetails pd
                      on ph.CoID =pd.CoID
                      AND ph.WorkYear=pd.WorkYear
                      AND ph.IDNumber=pd.IDNumber
                      
                      left join ACMaster ac
                      on ph.WorkYear=ac.WorkYear
                      AND ph.CoID= ac.CoID
                      AND ph.PartyCode=ac.ACCode
                      
                      left join ACMaster ac1
                      on ph.WorkYear=ac1.WorkYear
                      AND ph.CoID= ac1.CoID
                      AND ph.BrokerCode=ac1.ACCode
                      
                      left join ACMastDets ad
                      on ac.ACCode=ad.ACCode
                      AND ac.WorkYear=ad.WorkYear
                      AND ac.CoID=ad.CoID

                      where  InvoiceDate BETWEEN '$f' AND '$t'
                      AND ph.CoID ='$CoID'
                      AND ph.WorkYear = '$WorkYear'
                      order by ph.InvoiceDate desc
                   ";
          
          $query = $this->db->query($sql)->result_array();
          if(empty($query))
          {
            $sql = "      
                  select distinct
                          ph.IDNumber,
                          DATE_FORMAT(ph.GoodsRcptDate,'%d-%m-%Y') as 'GDN Date',
                          ph.InvoiceNo as 'BillNo',
                          DATE_FORMAT(ph.InvoiceDate,'%d-%m-%Y') as 'BillDate',
                          ph.PartyCode as 'Party Code',
                          ac.ACTitle as 'Party Name',
                          ph.DespatchFrom,
                          ph.DespatchTo,
                          ph.BrokerCode as 'Broker Code',
                          ac1.ACTitle as 'Broker Name',
                          ph.TotalAmount as 'Item Amount',

                          ph.TaxCharges,
                          ph.GrossAmount as 'Bill Amt',
                          ph.TaxIndicator,
                          CONCAT(ad.AddressI,' ',ad.AddressII,' ',ad.AddressIII,' ',ad.GalaNo,' ',ad.City,' ',ad.Pin,' ',ad.StateName) as 'Address',
                          ad.GSTNo
                          from
                          PurHeader ph left join PurDetails pd
                          on ph.CoID =pd.CoID
                          AND ph.WorkYear=pd.WorkYear
                          AND ph.IDNumber=pd.IDNumber

                          left join ACMaster ac
                          on ph.WorkYear=ac.WorkYear
                          AND ph.CoID= ac.CoID
                          AND ph.PartyCode=ac.ACCode

                          left join ACMaster ac1
                          on ph.WorkYear=ac1.WorkYear
                          AND ph.CoID= ac1.CoID
                          AND ph.BrokerCode=ac1.ACCode

                          left join ACMastDets ad
                          on ac.ACCode=ad.ACCode 
                          AND ac.CoID= ad.CoID
                          AND ac.WorkYear=ad.WorkYear
                          
                          AND ph.CoID ='$CoID'
                          AND ph.WorkYear = '$WorkYear' limit 1
          ";
          $query = $this->db->query($sql);
          $ea=array("empty");

          foreach ($query->list_fields() as $field)
          {
                array_push($ea, $field);
          }
          array_push($ea, 'Local Amt (T)');
          array_push($ea, 'OMS Amt (T)');
          array_push($ea, 'Local Amt (F)');
          array_push($ea, 'OMS Amt (F)');
        
             return array($ea,$f,$t);
        }


          for($i=0;$i<count($query);$i++){

            if($query[$i]['GDN Date'] === '00-00-0000')
            {
              $query[$i]['GDN Date'] = $query[$i]['BillDate'];
            }

          if($query[$i]['TaxIndicator'] === 'T')
            {
              if(substr($query[$i]['GSTNo'],0,2 ) === '27')
               { 
                 
                $query[$i] = array_merge($query[$i],array('Local Amt (T)' => $query[$i]['Bill Amt']));
                $query[$i] = array_merge($query[$i],array('OMS Amt (T)' => ' ' ));
                }
              else
              {
                $query[$i] = array_merge($query[$i],array('Local Amt (T)' => ' '));
                $query[$i] = array_merge($query[$i],array('OMS Amt (T)' =>$query[$i]['Bill Amt'] ));
              }
          }
          else
           {
              $query[$i] = array_merge($query[$i],array('Local Amt (T)' => ' '));
              $query[$i] = array_merge($query[$i],array('OMS Amt (T)' => ' '));
          }
          if($query[$i]['TaxIndicator'] === 'F')
            {
              if(substr($query[$i]['GSTNo'],0,2 ) === '27')
               { 
                $query[$i] = array_merge($query[$i],array('Local Amt (F)' => $query[$i]['Bill Amt']));
                $query[$i] = array_merge($query[$i],array('OMS Amt (F)' => ' '));
                }
              else
              {
                $query[$i] = array_merge($query[$i],array('Local Amt (F)' => ' '));
                $query[$i] = array_merge($query[$i],array('OMS Amt (F)' => $query[$i]['Bill Amt'] ));
                
              }
            }
          else
           { $query[$i] = array_merge($query[$i],array('Local Amt (F)' => ' '));
            $query[$i] = array_merge($query[$i],array('OMS Amt (F)' => ' '));
          }
        }
          return array($query,$f,$t);
      }

      //updated 13-02-21
      function get_TaxablePurDatewiseFilter($fromYear,$toYear){
          $CoID = $this->session->userdata('CoID') ;
          $WorkYear = $this->session->userdata('WorkYear') ; 
          $sql = "        
                      select distinct
                            ph.IDNumber,
                            DATE_FORMAT(ph.GoodsRcptDate,'%d-%m-%Y') as 'GDN Date',
                            ph.InvoiceNo as 'BillNo',
                            DATE_FORMAT(ph.InvoiceDate,'%d-%m-%Y') as 'BillDate',
                            ph.PartyCode as 'Party Code',
                            ac.ACTitle as 'Party Name',
                            ph.DespatchFrom,
                            ph.DespatchTo,
                            ph.BrokerCode as 'Broker Code',
                            ac1.ACTitle as 'Broker Name',
                            ph.TotalAmount as 'Item Amount',

                            ph.TaxCharges,
                            ph.GrossAmount as 'Bill Amt',
                            ph.TaxIndicator,
                            CONCAT(ad.AddressI,' ',ad.AddressII,' ',ad.AddressIII,' ',ad.GalaNo,' ',ad.City,' ',ad.Pin,' ',ad.StateName) as 'Address',
                            ad.GSTNo
                      from
                      PurHeader ph left join PurDetails pd
                      on ph.CoID =pd.CoID
                      AND ph.WorkYear=pd.WorkYear
                      AND ph.IDNumber=pd.IDNumber
                      
                      left join ACMaster ac
                      on ph.WorkYear=ac.WorkYear
                      AND ph.CoID= ac.CoID
                      AND ph.PartyCode=ac.ACCode
                      
                      left join ACMaster ac1
                      on ph.WorkYear=ac1.WorkYear
                      AND ph.CoID= ac1.CoID
                      AND ph.BrokerCode=ac1.ACCode
                      
                      left join ACMastDets ad
                      on ac.ACCode=ad.ACCode
                      AND ac.CoID= ad.CoID
                      AND ac.WorkYear=ad.WorkYear

                      where  InvoiceDate BETWEEN '$fromYear' AND '$toYear'
                      AND ph.CoID ='$CoID'
                      order by ph.InvoiceDate desc
                  ";
          $query = $this->db->query($sql)->result_array();
          if(empty($query)){
                $sql = "      
                          select distinct
                                  ph.IDNumber,
                                  DATE_FORMAT(ph.GoodsRcptDate,'%d-%m-%Y') as 'GDN Date',
                                  ph.InvoiceNo as 'BillNo',
                                  DATE_FORMAT(ph.InvoiceDate,'%d-%m-%Y') as 'BillDate',
                                  ph.PartyCode as 'Party Code',
                                  ac.ACTitle as 'Party Name',
                                  ph.DespatchFrom,
                                  ph.DespatchTo,
                                  ph.BrokerCode as 'Broker Code',
                                  ac1.ACTitle as 'Broker Name',
                                  ph.TotalAmount as 'Item Amount',

                                  ph.TaxCharges,
                                  ph.GrossAmount as 'Bill Amt',
                                  ph.TaxIndicator,
                                  CONCAT(ad.AddressI,' ',ad.AddressII,' ',ad.AddressIII,' ',ad.GalaNo,' ',ad.City,' ',ad.Pin,' ',ad.StateName) as 'Address',
                                  ad.GSTNo
                            from
                                  PurHeader ph left join PurDetails pd
                                  on ph.CoID =pd.CoID
                                  AND ph.WorkYear=pd.WorkYear
                                  AND ph.IDNumber=pd.IDNumber
                                  
                                  left join ACMaster ac
                                  on ph.WorkYear=ac.WorkYear
                                  AND ph.CoID= ac.CoID
                                  AND ph.PartyCode=ac.ACCode
                                  
                                  left join ACMaster ac1
                                  on ph.WorkYear=ac1.WorkYear
                                  AND ph.CoID= ac1.CoID
                                  AND ph.BrokerCode=ac1.ACCode
                                  
                                  left join ACMastDets ad
                                  on ac.ACCode=ad.ACCode 
                                  AND ac.CoID= ad.CoID
                                  AND ac.WorkYear=ad.WorkYear            
                                  AND ph.CoID ='$CoID' limit 1
                  ";
                $query = $this->db->query($sql);
                $ea=array("empty");
                foreach ($query->list_fields() as $field){
                      array_push($ea, $field);
                }
                array_push($ea, 'Local Amt (T)');
                array_push($ea, 'OMS Amt (T)');
                array_push($ea, 'Local Amt (F)');
                array_push($ea, 'OMS Amt (F)');
                return array($ea,$fromYear,$toYear);
          }

          for($i=0;$i<count($query);$i++){
              if($query[$i]['GDN Date'] === '00-00-0000'){
                  $query[$i]['GDN Date'] = $query[$i]['BillDate'];
              }

              if($query[$i]['TaxIndicator'] === 'T'){
                    if(substr($query[$i]['GSTNo'],0,2 ) === '27') { 
                        $query[$i] = array_merge($query[$i],array('Local Amt (T)' => $query[$i]['Bill Amt']));
                        $query[$i] = array_merge($query[$i],array('OMS Amt (T)' => ' ' ));
                    }
                    else{
                        $query[$i] = array_merge($query[$i],array('Local Amt (T)' => ' '));
                        $query[$i] = array_merge($query[$i],array('OMS Amt (T)' =>$query[$i]['Bill Amt'] ));
                    }
              }
              else{
                  $query[$i] = array_merge($query[$i],array('Local Amt (T)' => ' '));
                  $query[$i] = array_merge($query[$i],array('OMS Amt (T)' => ' '));
              }

              if($query[$i]['TaxIndicator'] === 'F') {
                  if(substr($query[$i]['GSTNo'],0,2 ) === '27') { 
                      $query[$i] = array_merge($query[$i],array('Local Amt (F)' => $query[$i]['Bill Amt']));
                      $query[$i] = array_merge($query[$i],array('OMS Amt (F)' => ' '));
                  }
                  else{
                      $query[$i] = array_merge($query[$i],array('Local Amt (F)' => ' '));
                      $query[$i] = array_merge($query[$i],array('OMS Amt (F)' => $query[$i]['Bill Amt'] ));

                  }
              }
              else{ 
                      $query[$i] = array_merge($query[$i],array('Local Amt (F)' => ' '));
                      $query[$i] = array_merge($query[$i],array('OMS Amt (F)' => ' '));
              }
          }
          return  array($query,$fromYear,$toYear); 
      }

      //updated 13-02-21
      function get_ItemwisePurDatewise(){
          $CoID = $this->session->userdata('CoID') ;
          $WorkYear = $this->session->userdata('WorkYear') ; 

          $sql="";$f="";$t="";
          $dt=date("d-m-yy");
          $current_month = date("m");
          $current_year = date("yy");
          $w=explode("-",$WorkYear);
          $WY = '20'.$w[1];

          if((int)$WY > (int)$current_year){
            $f = date("$current_year-$current_month-01", strtotime($dt));
            $t = date("$current_year-$current_month-t", strtotime($dt));
          }
          else{
            $f = date("$WY-03-01", strtotime($dt));
            $t = date("$WY-03-t", strtotime($dt));
          }
          $sql = "        
                      select
                              ph.IDNumber,
                              DATE_FORMAT(IF(ph.GoodsRcptDate != '0000-00-00',ph.GoodsRcptDate,ph.InvoiceDate),'%d-%m-%Y') as 'GDN Date',
                              ph.InvoiceNo as 'BillNo',
                              DATE_FORMAT(ph.InvoiceDate,'%d-%m-%Y') as 'BillDate',
                              ph.PartyCode as 'Party Code',
                              ac.ACTitle as 'Party Name',
                              ph.BrokerCode as 'Broker Code',
                              ac1.ACTitle as 'Broker Name',
                              pd.LotNo,
                              pd.ItemCode,
                              im.ItemName,
                              pd.Mark as 'Item Mark',
                              pd.Qty,
                              pd.Weight as 'Net Wgt',
                              pd.Rate,
                              pd.Amount as 'Item Amt',
                              pd.ContChg,
                              pd.APMCChg as 'APMC Amt',
                              pd.AddAmt,
                              pd.LessAmt,
                              ph.TaxableAmt,
                              ph.TaxCharges,
                              ph.AddAmt,
                              ph.LessAmt,
                              ph.NetPayable as 'Net Amt',
                              ph.Commission,
                              ph.GdnRent,
                              ph.Majuri,
                              ph.Laga,
                              ph.InsuAmt,
                              ph.Brokerage,
                              ph.Transport,
                              ph.SalesProm,
                              ph.TotalExpenses,
                              ph.Insurance,
                              ph.FreightAmt,
                              ph.CustomAmt,
                              ph.CFAmt,
                              ph.CFAmt,
                              ph.DEPBAmt,
                              ph.SADAmt
                      from
                              PurHeader ph join PurDetails pd
                              on ph.CoID =pd.CoID
                              AND ph.WorkYear=pd.WorkYear
                              AND ph.IDNumber=pd.IDNumber

                              left join ACMaster ac
                              on ph.WorkYear=ac.WorkYear
                              AND ph.CoID= ac.CoID
                              AND ph.PartyCode=ac.ACCode

                              left join ACMaster ac1
                              on ph.WorkYear=ac1.WorkYear
                              AND ph.CoID= ac1.CoID
                              AND ph.BrokerCode=ac1.ACCode

                              left join ItemMaster im
                              on pd.WorkYear=im.WorkYear
                              AND pd.CoID= im.CoID
                              AND pd.ItemCode=im.ItemCode

                              where ph.WorkYear = '$WorkYear'
                              and ph.CoID = '$CoID'
                              and  InvoiceDate BETWEEN '$f' AND '$t'
                      order by ph.InvoiceDate desc, im.ItemName asc
                   ";
          $query = $this->db->query($sql)->result_array();

          if(empty($query)){
            $sql = "      
                    select
                              ph.IDNumber,
                              DATE_FORMAT(IF(ph.GoodsRcptDate != '0000-00-00',ph.GoodsRcptDate,ph.InvoiceDate),'%d-%m-%Y') as 'GDN Date',
                              ph.InvoiceNo as 'BillNo',
                              DATE_FORMAT(ph.InvoiceDate,'%d-%m-%Y') as 'BillDate',
                              ph.PartyCode as 'Party Code',
                              ac.ACTitle as 'Party Name',
                              ph.BrokerCode as 'Broker Code',
                              ac1.ACTitle as 'Broker Name',
                              pd.LotNo,
                              pd.ItemCode,
                              im.ItemName,
                              pd.Mark as 'Item Mark',
                              pd.Qty,
                              pd.Weight as 'Net Wgt',
                              pd.Rate,
                              pd.Amount as 'Item Amt',
                              pd.ContChg,
                              pd.APMCChg as 'APMC Amt',
                              pd.AddAmt,
                              pd.LessAmt,
                              ph.TaxableAmt,
                              ph.TaxCharges,
                              ph.AddAmt,
                              ph.LessAmt,
                              ph.NetPayable as 'Net Amt',
                              ph.Commission,
                              ph.GdnRent,
                              ph.Majuri,
                              ph.Laga,
                              ph.InsuAmt,
                              ph.Brokerage,
                              ph.Transport,
                              ph.SalesProm,
                              ph.TotalExpenses,
                              ph.Insurance,
                              ph.FreightAmt,
                              ph.CustomAmt,
                              ph.CFAmt,
                              ph.CFAmt,
                              ph.DEPBAmt,
                              ph.SADAmt
                      from
                              PurHeader ph join PurDetails pd
                              on ph.CoID =pd.CoID
                              AND ph.WorkYear=pd.WorkYear
                              AND ph.IDNumber=pd.IDNumber

                              left join ACMaster ac
                              on ph.WorkYear=ac.WorkYear
                              AND ph.CoID= ac.CoID
                              AND ph.PartyCode=ac.ACCode

                              left join ACMaster ac1
                              on ph.WorkYear=ac1.WorkYear
                              AND ph.CoID= ac1.CoID
                              AND ph.BrokerCode=ac1.ACCode

                              left join ItemMaster im
                              on pd.WorkYear=im.WorkYear
                              AND pd.CoID= im.CoID
                              AND pd.ItemCode=im.ItemCode 

                      where ph.WorkYear = '$WorkYear'
                      and ph.CoID = '$CoID' limit 1
                  ";
          $query = $this->db->query($sql);
          $ea=array("empty");

          foreach ($query->list_fields() as $field){
                array_push($ea, $field);
          }        
          return array($ea,$f,$t);
        }
        return array($query,$f,$t);
      }

      //updated 13-02-21
      function get_ItemwisePurDatewiseFilter($fromYear,$toYear){
          $CoID = $this->session->userdata('CoID') ;
          $WorkYear = $this->session->userdata('WorkYear') ; 
          $sql = "        
                    select
                              ph.IDNumber,
                              DATE_FORMAT(IF(ph.GoodsRcptDate != '0000-00-00',ph.GoodsRcptDate,ph.InvoiceDate),'%d-%m-%Y') as 'GDN Date',
                              ph.InvoiceNo as 'BillNo',
                              DATE_FORMAT(ph.InvoiceDate,'%d-%m-%Y') as 'BillDate',
                              ph.PartyCode as 'Party Code',
                              ac.ACTitle as 'Party Name',
                              ph.BrokerCode as 'Broker Code',
                              ac1.ACTitle as 'Broker Name',
                              pd.LotNo,
                              pd.ItemCode,
                              im.ItemName,
                              pd.Mark as 'Item Mark',
                              pd.Qty,
                              pd.Weight as 'Net Wgt',
                              pd.Rate,
                              pd.Amount as 'Item Amt',
                              pd.ContChg,
                              pd.APMCChg as 'APMC Amt',
                              pd.AddAmt,
                              pd.LessAmt,
                              ph.TaxableAmt,
                              ph.TaxCharges,
                              ph.AddAmt,
                              ph.LessAmt,
                              ph.NetPayable as 'Net Amt',
                              ph.Commission,
                              ph.GdnRent,
                              ph.Majuri,
                              ph.Laga,
                              ph.InsuAmt,
                              ph.Brokerage,
                              ph.Transport,
                              ph.SalesProm,
                              ph.TotalExpenses,
                              ph.Insurance,
                              ph.FreightAmt,
                              ph.CustomAmt,
                              ph.CFAmt,
                              ph.CFAmt,
                              ph.DEPBAmt,
                              ph.SADAmt
                    from
                              PurHeader ph join PurDetails pd
                              on ph.CoID =pd.CoID
                              AND ph.WorkYear=pd.WorkYear
                              AND ph.IDNumber=pd.IDNumber

                              left join ACMaster ac
                              on ph.WorkYear=ac.WorkYear
                              AND ph.CoID= ac.CoID
                              AND ph.PartyCode=ac.ACCode

                              left join ACMaster ac1
                              on ph.WorkYear=ac1.WorkYear
                              AND ph.CoID= ac1.CoID
                              AND ph.BrokerCode=ac1.ACCode

                              left join ItemMaster im
                              on pd.WorkYear=im.WorkYear
                              AND pd.CoID= im.CoID
                              AND pd.ItemCode=im.ItemCode
                    where ph.WorkYear='$WorkYear'
                    and ph.CoID='$CoID'
                    and  InvoiceDate BETWEEN '$fromYear' AND '$toYear'
                    order by ph.InvoiceDate desc, im.ItemName asc
              ";
          $query = $this->db->query($sql)->result_array();
          if(empty($query)){
              $sql = "      
                        select
                              ph.IDNumber,
                              DATE_FORMAT(IF(ph.GoodsRcptDate != '0000-00-00',ph.GoodsRcptDate,ph.InvoiceDate),'%d-%m-%Y') as 'GDN Date',
                              ph.InvoiceNo as 'BillNo',
                              DATE_FORMAT(ph.InvoiceDate,'%d-%m-%Y') as 'BillDate',
                              ph.PartyCode as 'Party Code',
                              ac.ACTitle as 'Party Name',
                              ph.BrokerCode as 'Broker Code',
                              ac1.ACTitle as 'Broker Name',
                              pd.LotNo,
                              pd.ItemCode,
                              im.ItemName,
                              pd.Mark as 'Item Mark',
                              pd.Qty,
                              pd.Weight as 'Net Wgt',
                              pd.Rate,
                              pd.Amount as 'Item Amt',
                              pd.ContChg,
                              pd.APMCChg as 'APMC Amt',
                              pd.AddAmt,
                              pd.LessAmt,
                              ph.TaxableAmt,
                              ph.TaxCharges,
                              ph.AddAmt,
                              ph.LessAmt,
                              ph.NetPayable as 'Net Amt',
                              ph.Commission,
                              ph.GdnRent,
                              ph.Majuri,
                              ph.Laga,
                              ph.InsuAmt,
                              ph.Brokerage,
                              ph.Transport,
                              ph.SalesProm,
                              ph.TotalExpenses,
                              ph.Insurance,
                              ph.FreightAmt,
                              ph.CustomAmt,
                              ph.CFAmt,
                              ph.CFAmt,
                              ph.DEPBAmt,
                              ph.SADAmt
                        from
                              PurHeader ph join PurDetails pd
                              on ph.CoID =pd.CoID
                              AND ph.WorkYear=pd.WorkYear
                              AND ph.IDNumber=pd.IDNumber

                              left join ACMaster ac
                              on ph.WorkYear=ac.WorkYear
                              AND ph.CoID= ac.CoID
                              AND ph.PartyCode=ac.ACCode

                              left join ACMaster ac1
                              on ph.WorkYear=ac1.WorkYear
                              AND ph.CoID= ac1.CoID
                              AND ph.BrokerCode=ac1.ACCode

                              left join ItemMaster im
                              on pd.WorkYear=im.WorkYear
                              AND pd.CoID= im.CoID
                              AND pd.ItemCode=im.ItemCode 
                              AND ph.WorkYear = '$WorkYear'
                              and ph.CoID = '$CoID' limit 1
                      ";
          $query = $this->db->query($sql);
          $ea=array("empty");
          foreach ($query->list_fields() as $field){
                array_push($ea, $field);
          }
          return array($ea,$fromYear,$toYear);
        }
        return  array($query,$fromYear,$toYear); 
      }



}
