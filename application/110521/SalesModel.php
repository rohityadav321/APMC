<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SalesModel extends CI_Model
{
  function __construct(){
        // Call the Model constructor
        parent::__construct();
  }

  // Get Sale Details for SalesGrid
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
            select BillNo, BillDate, GodownID, SaleMast.PartyCode CPName, 
                    PartyMaster.PartyName PartyTitle, 
                    BrokerID, Broker.ACTitle BrokerTitle, 
                    BillAmt
                    
            from SaleMast, PartyMaster, ACMaster Broker
            
            where SaleMast.PartyCode = PartyMaster.PartyCode
              and SaleMast.CoID = PartyMaster.CoID 
              and SaleMast.WorkYear = PartyMaster.WorkYear 
                  
              and SaleMast.BrokerId = Broker.ACCode
              and SaleMast.CoID = Broker.CoID
              and SaleMast.WorkYear = Broker.WorkYear

              and SaleMast.CoID = '$CoID'
              and SaleMast.WorkYear = '$WorkYear'
              and BillDate BETWEEN '$fromYear' AND '$toYear'
              order by BillDate DESC, CAST(BillNo AS Integer) DESC 

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

  // Get Sale Details Datewise for SalesGrid
  function get_detailsFilter($fromYear,$toYear){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    $sql = "        
              select 
                  BillNo, 
                  BillDate, 
                  GodownID, 
                  SaleMast.PartyCode CPName, 
                  PartyMaster.PartyName PartyTitle, 
                  BrokerID, 
                  Broker.ACTitle BrokerTitle, 
                  BillAmt
  
              from SaleMast, PartyMaster, ACMaster Broker

              where SaleMast.PartyCode = PartyMaster.PartyCode
                and SaleMast.CoID = PartyMaster.CoID 
                and SaleMast.WorkYear = PartyMaster.WorkYear 
                    
                and SaleMast.BrokerId = Broker.ACCode
                and SaleMast.CoID = Broker.CoID
                and SaleMast.WorkYear = Broker.WorkYear

                and SaleMast.CoID = '$CoID'
                and SaleMast.WorkYear = '$WorkYear'
                and BillDate BETWEEN '$fromYear' AND '$toYear'
                order by BillDate DESC, CAST(BillNo AS Integer) DESC 
    ";
    $result = $this->db->query($sql)->result_array();

    if(empty($result)){
          $emptyArray=array("empty");   
          return array($emptyArray,$fromYear,$toYear);
    }

    return  array($result,$fromYear,$toYear); 
  }

  function getDebtors($ACCode){
      $CoID = $this->session->userdata('CoID') ;
      $WorkYear = $this->session->userdata('WorkYear');

      $sql ="
              SELECT
                    ACMaster.ACCode, ACMaster.ACTitle
              FROM  ACMaster
              WHERE ACMaster.CoID = '$CoID'
                AND ACMaster.WorkYear = '$WorkYear'
                AND GroupCode = 'BD'
                AND ACMaster.ACCode like '$ACCode%'
            ";
      $query = $this->db->query($sql);
      return $query->result_array();
  }

  function getCustomers($ACCode){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');

    $sql ="
            SELECT
                    PartyMaster.PartyCode,
                    PartyMaster.PartyName,
                    PartyMaster.PartyArea,
                    PartyMaster.BrokerCode,
                    ACMaster.ACTitle as 'BrokerTitle',
                    PartyMaster.PartyType 
            from PartyMaster, ACMaster
            Where PartyMaster.BrokerCode = ACMaster.ACCode
              and PartyMaster.CoID = ACMaster.CoID
              and PartyMaster.WorkYear = ACMaster.WorkYear       
              AND ACMaster.CoID = '$CoID'
              AND ACMaster.WorkYear = '$WorkYear'
              AND PartyMaster.PartyName like '$ACCode%'
          ";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  function getCustomersCode($ACCode){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');

    $sql ="
            SELECT
                    PartyMaster.PartyCode,
                    PartyMaster.PartyName,
                    PartyMaster.PartyArea,
                    PartyMaster.BrokerCode,
                    (select ACTitle 
                        from ACMaster Broker 
                        where PartyMaster.BrokerCode = Broker.ACCode
                          and PartyMaster.CoID = Broker.CoID
                          and PartyMaster.WorkYear = Broker.WorkYear
                          and Broker.CoID = '$CoID' 
                          and Broker.WorkYear = '$WorkYear') as BrokerTitle,
                    PartyMaster.PartyGSTNo, 
                    PartyMaster.PartyFSLNo,
                    PartyMaster.PartyType 
            from PartyMaster
            where PartyMaster.PartyCode like '$ACCode%'
              and PartyMaster.CoID = '$CoID' 
              and PartyMaster.WorkYear = '$WorkYear'
          ";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  function godownWise($gid){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');

    $sql="
                  SELECT 
                  IDNumber,
                  LotNo,
                  PurDetails.ItemCode As ItemCode, 
                  ItemMaster.ItemName As ItemName,
                  Mark, 
                  GodownID, 
                  ACMaster.ACTitle As SalesTitle,
                  ClosingQty as 'BalQty', ItemMaster.PackingText, 
                  DATE_FORMAT(GoodsRcptDate,'%d-%m-%Y') as GoodsRcptDate,
                  CONCAT(PurDetails.APMCInd, PurDetails.ETaxInd) as 'AE', 
                  '*' as 'Star',
                  ItemMaster.SalesCode As SalesCode, 
                  ItemMaster.WeightDeduct As Weight,
                  ItemMaster.Packing as Packing,
                  ItemMaster.PackingChrg As PackingChrg,
                  ItemMaster.UsualRatePer, 
                  ItemMaster.UsualRate, 
                  ItemMaster.Brand, 
                  ItemMaster.TaxCode As TaxCode,
                  ItemMaster.TaxTitle As TaxTitle,
                  ItemMaster.TaxRate As TaxRate,
                  ItemMaster.Laga As Laga,
                  ItemMaster.ETax As EntryTax,
                  ItemMaster.APMCChg As APMCChg, 
                  ItemMaster.APMCSChg As APMCSChg,
                        (select GodownDesc 
                          from Godown 
                          Where GodownID = '$gid' 
                          and CoID = '$CoID' 
                          and WorkYear = '$WorkYear') As GodownDesc,
                  PurDetails.Units as Units
          FROM PurDetails, ItemMaster, ACMaster
          where PurDetails.ItemCode = ItemMaster.ItemCode
          and PurDetails.CoID = ItemMaster.CoID
          and PurDetails.WorkYear = ItemMaster.WorkYear                    
          and ItemMaster.SalesCode = ACMaster.ACCode
          AND ItemMaster.WorkYear = ACMaster.WorkYear
          and ItemMaster.CoID = ACMaster.CoID
          and PurDetails.CoID = '$CoID'
          and PurDetails.WorkYear = '$WorkYear'
          and PurDetails.GodownID = '$gid'
          and PurDetails.ClosingQty > 0 ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
    // PurDetails.Packing as Packing REMOVED 2/4/21
    
  }  

  // created - 23/03/21
  function lotWise($gid,$LotNo){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');

    $sql="
                  SELECT 
                  IDNumber,
                  LotNo,
                  PurDetails.ItemCode As ItemCode, 
                  ItemMaster.ItemName As ItemName,
                  Mark, 
                  GodownID, 
                  ACMaster.ACTitle As SalesTitle,
                  ClosingQty as 'BalQty', ItemMaster.PackingText, 
                  DATE_FORMAT(GoodsRcptDate,'%d-%m-%Y') as GoodsRcptDate,
                  CONCAT(PurDetails.APMCInd, PurDetails.ETaxInd) as 'AE', 
                  '*' as 'Star',
                  ItemMaster.SalesCode As SalesCode, 
                  ItemMaster.WeightDeduct As Weight,
                  ItemMaster.PackingChrg As PackingChrg,
                  ItemMaster.UsualRatePer, 
                  ItemMaster.UsualRate, 
                  ItemMaster.Brand, 
                  ItemMaster.TaxCode As TaxCode,
                  ItemMaster.TaxTitle As TaxTitle,
                  ItemMaster.TaxRate As TaxRate,
                  ItemMaster.Laga As Laga,
                  ItemMaster.ETax As EntryTax,
                  ItemMaster.APMCChg As APMCChg, 
                  ItemMaster.APMCSChg As APMCSChg,
                        (select GodownDesc 
                          from Godown 
                          Where GodownID = '$gid' 
                          and CoID = '$CoID' 
                          and WorkYear = '$WorkYear') As GodownDesc,
                  PurDetails.Units as Units,
                  PurDetails.Packing as Packing
          FROM PurDetails, ItemMaster, ACMaster
          where PurDetails.ItemCode = ItemMaster.ItemCode
          and PurDetails.CoID = ItemMaster.CoID
          and PurDetails.WorkYear = ItemMaster.WorkYear                    
          and ItemMaster.SalesCode = ACMaster.ACCode
          AND ItemMaster.WorkYear = ACMaster.WorkYear
          and ItemMaster.CoID = ACMaster.CoID
          and PurDetails.CoID = '$CoID'
          and PurDetails.WorkYear = '$WorkYear'
          and PurDetails.GodownID = '$gid'
          and LotNo = '$LotNo'
          and PurDetails.ClosingQty > 0 ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }
      
  function itemWise($gid,$itemCode){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');

    $sql="
                  SELECT 
                  IDNumber,
                  LotNo,
                  PurDetails.ItemCode As ItemCode, 
                  ItemMaster.ItemName As ItemName,
                  Mark, 
                  GodownID, 
                  ACMaster.ACTitle As SalesTitle,
                  ClosingQty as 'BalQty', ItemMaster.PackingText, 
                  DATE_FORMAT(GoodsRcptDate,'%d-%m-%Y') as GoodsRcptDate,
                  CONCAT(PurDetails.APMCInd, PurDetails.ETaxInd) as 'AE', 
                  '*' as 'Star',
                  ItemMaster.SalesCode As SalesCode, 
                  ItemMaster.WeightDeduct As Weight,
                  ItemMaster.PackingChrg As PackingChrg,
                  ItemMaster.Packing as Packing, 
                  ItemMaster.UsualRatePer, 
                  ItemMaster.UsualRate, 
                  ItemMaster.Brand, 
                  ItemMaster.TaxCode As TaxCode,
                  ItemMaster.TaxTitle As TaxTitle,
                  ItemMaster.TaxRate As TaxRate,
                  ItemMaster.Laga As Laga,
                  ItemMaster.ETax As EntryTax,
                  ItemMaster.APMCChg As APMCChg, 
                  ItemMaster.APMCSChg As APMCSChg,
                        (select GodownDesc 
                          from Godown 
                          Where GodownID = '$gid' 
                          and CoID = '$CoID' 
                          and WorkYear = '$WorkYear') As GodownDesc,
                  PurDetails.Units as Units
          FROM PurDetails, ItemMaster, ACMaster
          where PurDetails.ItemCode = ItemMaster.ItemCode
          and PurDetails.CoID = ItemMaster.CoID
          and PurDetails.WorkYear = ItemMaster.WorkYear                    
          and ItemMaster.SalesCode = ACMaster.ACCode
          AND ItemMaster.WorkYear = ACMaster.WorkYear
          and ItemMaster.CoID = ACMaster.CoID
          and PurDetails.CoID = '$CoID'
          and PurDetails.WorkYear = '$WorkYear'
          and PurDetails.GodownID = '$gid'
          and PurDetails.ItemCode = '$itemCode'
          and PurDetails.ClosingQty > 0 ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
    // PurDetails.Packing as Packing 2/4/21 REMOVED 

  }  
            
  function getSalesDetail($billid,$gid){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');

    $sql="
                SELECT 
                                    
                PurDetails.ItemCode As ItemCode, 
                ItemMaster.ItemName As ItemName,
                PurDetails.Mark, 
                ItemMaster.PackingText as PackingText, 
                ItemMaster.Packing as Packing,
                ItemMaster.WeightDeduct As Weight,
                ItemMaster.PackingChrg,
                SaleDetails.RATEPER,
                PurDetails.IDNumber as IDNumber,
                SaleDetails.Qty as Qty,
                PurDetails.ClosingQty as ClosingQty
                
                FROM PurDetails, ItemMaster, ACMaster, SaleDetails

                where PurDetails.ItemCode = ItemMaster.ItemCode
                and PurDetails.CoID = ItemMaster.CoID
                and PurDetails.WorkYear = ItemMaster.WorkYear  

                and PurDetails.Mark = SaleDetails.ItemMark
                and PurDetails.ItemCode = SaleDetails.ItemCode
                and PurDetails.CoID = SaleDetails.CoID
                and PurDetails.WorkYear = SaleDetails.WorkYear 

                and ItemMaster.SalesCode = ACMaster.ACCode
                AND ItemMaster.WorkYear = ACMaster.WorkYear
                and ItemMaster.CoID = ACMaster.CoID


                and PurDetails.CoID = '$CoID' 
                and PurDetails.WorkYear = '$WorkYear'
                and PurDetails.GodownID = '$gid'
                and PurDetails.ClosingQty > 0 
                and SaleDetails.ID = '$billid'";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }  

  /// unwanted code 300121 
  function GetDetailsData(){

    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ;

    $this->db->select('BillNo');
    $this->db->select('BillDate');
    $this->db->select('GodownID');
    
    $this->db->select('BrokerID');
    $this->db->select('BrokerTitle');
    $this->db->select('BillAmt');
    $this->db->select('LRNo');
    $this->db->select('DeliDate');
    $this->db->select('DebtorID');
    $this->db->select('MudiBazar');
    $this->db->select('EWayBillNo');
    $this->db->select('CPName');
    $this->db->select('PartyTitle');
    $this->db->select('Area');
    $this->db->select('SaleType');
    $this->db->select('HelMajuri');
    $this->db->select('OtherChrgs');
    
    $this->db->from('SaleMast');
    $this->db->where(array('CoID' => $CoID, 'WorkYear' => $WorkYear));
    $query = $this->db->get();

      
    $result = $query->result();
    return $result;
  }
      
  //Display inserted data after insert
  function get_load_data($bill){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ;

    $sql ="
          SELECT 
              SaleMast.BillNo,
              SaleMast.BillDate,
              SaleMast.GodownID,
              SaleMast.BrokerID,
              SaleMast.BillAmt,
              SaleMast.LRNo,
              SaleMast.DeliDate,
              SaleMast.DebtorID,
              SaleMast.MudiBazar,
              SaleMast.EWayBillNo,
              SaleMast.PartyCode,
              SaleMast.CPName,
              SaleMast.Area,
              SaleMast.SaleType,
              SaleMast.HelMajuri,
              SaleMast.OtherChrgs,
              Godown.GodownDesc,
              ACMastDets.ACTitle As 'BrokerTitle'
            FROM SaleMast,Godown,ACMastDets
            WHERE SaleMast.CoID = '$CoID'
              and SaleMast.WorkYear = '$WorkYear'
              and SaleMast.BillNo = '$bill'
              and SaleMast.GodownID = Godown.GodownID
              and SaleMast.BrokerID = ACMastDets.ACCode
              and SaleMast.CoID = ACMastDets.CoID 
              and SaleMast.WorkYear = ACMastDets.WorkYear
              ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    
  }

  function get_load_data1($id){
    $WorkYear = $this->session->userdata('WorkYear') ;

    $this->db->select('BillNo');
    $this->db->select('BillDate');
    $this->db->select('GodownID');
    
    $this->db->select('BrokerID');
    $this->db->select('BrokerTitle');
    $this->db->select('BillAmt');
    $this->db->select('LRNo');
    $this->db->select('DeliDate');
    $this->db->select('DebtorID');
    $this->db->select('MudiBazar');
    $this->db->select('EWayBillNo');
    $this->db->select('CPName');
    $this->db->select('PartyTitle');
    $this->db->select('Area');
    $this->db->select('SaleType');
    $this->db->select('HelMajuri');
    $this->db->select('OtherChrgs');
    
    $this->db->from('SaleMast');
    $this->db->where(array('CoID' => $id, 'WorkYear' => $WorkYear));
    $query = $this->db->get();
      
    $result = $query->result();
    return $result;
  }

  function loadSalesDetail($id){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ;

    $sql ="
    SELECT
          SaleDetails.ID,
          SaleDetails.GodownID,
          SaleDetails.LotNo,
          SaleDetails.ItemCode,
          SaleDetails.ItemMark,
          SaleDetails.Qty,
          SaleDetails.GrossWt,
          SaleDetails.NetWt,
          SaleDetails.Rate,
          SaleDetails.RATEPER,
          SaleDetails.APMCIn,
          SaleDetails.ETaxIn,
          SaleDetails.GrAmt,
          SaleDetails.ContChrg,
          SaleDetails.OAPMCChrg,
          SaleDetails.NetAmt,
          SaleDetails.DiscAmt,
          SaleDetails.DiscDetRate,
          SaleDetails.TaxableAmt,
          SaleDetails.TCSPer,
          SaleDetails.TCSAmount,
          SaleDetails.TaxCode,
          SaleDetails.WgtDiff, 
          SaleDetails.WgtDiff1, 
          SaleDetails.WgtDiff2,
          SaleDetails.WgtDiff3, 
          SaleDetails.WgtDiff4, 
          SaleDetails.RateDiff,
          SaleDetails.RateDiff1,
          SaleDetails.RateDiff2,
          SaleDetails.RateDiff3,
          SaleDetails.RateDiff4,
          SaleDetails.Code1,
          (SELECT
              ACMaster.ACTitle
            FROM  ACMaster
            WHERE GroupCode = 'B1'  
              AND ACMaster.CoID = '$CoID'
              AND ACMaster.WorkYear = '$WorkYear'
              AND ACMaster.CoID = SaleDetails.CoID
              AND ACMaster.WorkYear = SaleDetails.WorkYear
              AND ACMaster.ACCode = SaleDetails.Code1) as CodeName1,
          SaleDetails.Code2,
          (SELECT
              ACMaster.ACTitle
            FROM  ACMaster
            WHERE GroupCode = 'B1'  
              AND ACMaster.CoID = '$CoID'
              AND ACMaster.WorkYear = '$WorkYear'
              AND ACMaster.CoID = SaleDetails.CoID
              AND ACMaster.WorkYear = SaleDetails.WorkYear
              AND ACMaster.ACCode = SaleDetails.Code2) as CodeName2,
          SaleDetails.Code3,
          (SELECT
              ACMaster.ACTitle
            FROM  ACMaster
            WHERE GroupCode = 'B1'  
              AND ACMaster.CoID = '$CoID'
              AND ACMaster.WorkYear = '$WorkYear'
              AND ACMaster.CoID = SaleDetails.CoID
              AND ACMaster.WorkYear = SaleDetails.WorkYear
              AND ACMaster.ACCode = SaleDetails.Code3) as CodeName3,
          SaleDetails.Code4,
          (SELECT
              ACMaster.ACTitle
            FROM  ACMaster
            WHERE GroupCode = 'B1'  
              AND ACMaster.CoID = '$CoID'
              AND ACMaster.WorkYear = '$WorkYear'
              AND ACMaster.CoID = SaleDetails.CoID
              AND ACMaster.WorkYear = SaleDetails.WorkYear
              AND ACMaster.ACCode = SaleDetails.Code4) as CodeName4,
          SaleDetails.Code5, 
          (SELECT
              ACMaster.ACTitle
            FROM  ACMaster
            WHERE GroupCode = 'B1'  
              AND ACMaster.CoID = '$CoID'
              AND ACMaster.WorkYear = '$WorkYear'
              AND ACMaster.CoID = SaleDetails.CoID
              AND ACMaster.WorkYear = SaleDetails.WorkYear
              AND ACMaster.ACCode = SaleDetails.Code5) as CodeName5,
          SaleDetails.DiffAmt1,
          SaleDetails.DiffAmt2,
          SaleDetails.DiffAmt3,
          SaleDetails.DiffAmt4,
          SaleDetails.DiffAmt5,
          (Select sum(SaleDetails.DiffAmt1 + SaleDetails.DiffAmt2 + SaleDetails.DiffAmt3 + SaleDetails.DiffAmt4 + SaleDetails.DiffAmt5) 
            from SaleDetails 
            where CoID='$CoID' 
            and WorkYear='$WorkYear' 
            and ID='$id')  as totalDiffAmt,
          Godown.GodownDesc,
          ItemMaster.ItemName,
          ItemMaster.Packing,
          ACMaster.ACTitle As SalesTitle,
          ItemMaster.SalesCode As SalesCode,
          ItemMaster.WeightDeduct As Weight,
          ItemMaster.APMCChg,
          ItemMaster.APMCSChg,
          ItemMaster.PackingChrg,
          ItemMaster.Laga,
          TaxMaster.TaxTitle,
          TaxMaster.TaxRate,
          PurDetails.ID as 'PID',
          PurDetails.Units As 'PackingTest',
          PurDetails.ClosingQty As 'BalQty',
          PurDetails.Packing,
          PurDetails.Packing As 'GrossWtOriginal',
          PurDetails.Packing - ItemMaster.WeightDeduct As 'NetWtOriginal'
        From SaleDetails, Godown,ItemMaster, TaxMaster,PurDetails, ACMaster
        Where SaleDetails.ID = '$id'
          and SaleDetails.CoID = '$CoID'
          and SaleDetails.WorkYear = '$WorkYear' 
          and SaleDetails.GodownID = Godown.GodownID
          and SaleDetails.CoID = Godown.CoID
          and SaleDetails.WorkYear = Godown.WorkYear
          
          and SaleDetails.ItemCode = ItemMaster.ItemCode
          and SaleDetails.CoID = ItemMaster.CoID
          and SaleDetails.WorkYear = ItemMaster.WorkYear
          
          and SaleDetails.ItemCode = PurDetails.ItemCode
          and SaleDetails.ItemMark = PurDetails.Mark
          and SaleDetails.GodownID = PurDetails.GodownID
          and SaleDetails.CoID = PurDetails.CoID
          and SaleDetails.WorkYear = PurDetails.WorkYear
          
          and SaleDetails.TaxCode = TaxMaster.TaxCode
          
          and ItemMaster.SalesCode = ACMaster.ACCode
          AND ItemMaster.CoID = ACMaster.CoID
          AND ItemMaster.WorkYear = ACMaster.WorkYear
          
          and PurDetails.ItemCode = ItemMaster.ItemCode
          and PurDetails.CoID = ItemMaster.CoID
          and PurDetails.WorkYear = ItemMaster.WorkYear
          LIMIT 1
      ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;

  }

  function getTableDataIdWise($id){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ;

    $sql ="
          SELECT 
              ID,
              BillNo,
              GodownID,  
              LotNo,
              ItemCode, 
              ItemMark,
                Qty ,
              GrossWt, 
              NetWt,
              Rate,
              LagaAmt,
              APMCChrg,
              APMCIn,
              ETaxIn,
              GrAmt,
              ContChrg,
              NetAmt,
              TaxCode,
              IGSTAmt,
              CGSTAmt,
              SGSTAmt 
              FROM SaleDetails
              WHERE BillNo = '$id' 
              AND CoID = '$CoID'
              AND WorkYear = '$WorkYear'
              ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

  function getTotal($id){
    $sql ="
    SELECT 
    SaleDetails.BillNo,
    SaleDetails.BillDate,
    sum(SaleDetails.GrAmt) AS ItemAmount,  
    sum(SaleDetails.DiscAmt) As DiscAmt,
    sum(SaleDetails.ContChrg) AS PackingCharge,
    sum(SaleDetails.LagaAmt) AS Laga,
    sum(SaleDetails.OAPMCChrg) As APMCChrg,
    sum(SaleDetails.EntryTax) As EntryTax,
    sum(SaleDetails.AddAmt) As Charges,
    sum(SaleDetails.LessAmt) As Expenses,
    sum(SaleDetails.TaxableAmt) As TaxableAmt,
    sum(SaleDetails.IGSTAmt) AS IGSTAmt,
    sum(SaleDetails.CGSTAmt) AS CGSTAmt,
    sum(SaleDetails.SGSTAmt) AS SGSTAmt,
    sum(SaleDetails.TaxAmt) AS TaxAmt,
    sum(SaleDetails.TCSAmount) AS TCSAmount,
    SaleMast.HelMajuri AS HelMajuri,
    SaleMast.OtherChrgs As OtherChrgs,
    SaleMast.RoffAmt As RoffAmt,
    SaleMast.BillAmt As BillAmt
    from SaleDetails, SaleMast
    WHERE SaleDetails.BillNo = '$id'
    and SaleMast.BillNo = '$id'
    and SaleMast.CoID = SaleDetails.CoID
    and SaleMast.WorkYear = SaleDetails.WorkYear
    ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result; 
  }

  //'vachat/trad' As vtac,

  function GetGST($code){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ;
    $sql="
        SELECT 
                StateCode, 
                PartyGSTNo, 
                PartyType 
          FROM 
                PartyMaster 
          WHERE PartyCode = '$code'
          and PartyMaster.CoID = '$CoID'
          and PartyMaster.WorkYear = '$WorkYear'

        ";
    $query = $this->db->query($sql);
        $result = $query->result();
        return $result;

  }

  function getId($bill){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ;

    $sql="
            SELECT CoID 
              from SaleMast 
              WHERE BillNo ='$bill'
                and SaleMast.CoID = '$CoID'
                and SaleMast.WorkYear = '$WorkYear'
          ";
    $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

  function getBillNo(){
      $CoID = $this->session->userdata('CoID') ;
      $WorkYear = $this->session->userdata('WorkYear') ;

      $sql="
      
              SELECT LastSalesBillNo 
                from CompData 
                WHERE CoID = '$CoID'
                AND WorkYear = '$WorkYear'
      
      ";
      $query = $this->db->query($sql);
      $result = $query->result();

      $NewValue = IntVal($result[0]->LastSalesBillNo)+1;

      $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear );
      $data2 = array('LastSalesBillNo' => $NewValue);              
      $this->db->where($multi_where);
      $this->db->update('CompData', $data2);

      return strval($NewValue);
  }

  function getLastBillNo(){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ;

    $sql="
    
            SELECT LastSalesBillNo 
              from CompData 
              WHERE CoID = '$CoID'
              AND WorkYear = '$WorkYear'
    
    ";
    $query = $this->db->query($sql);
    $result = $query->result();

    $NewValue = IntVal($result[0]->LastSalesBillNo);

    return strval($NewValue);
}

  function reduceBillNo(){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ;

    $sql="
            SELECT LastSalesBillNo 
            from CompData 
            WHERE CoID = '$CoID'
            AND WorkYear = '$WorkYear'
    ";
    $query = $this->db->query($sql);
    $result = $query->result();

    $NewValue = IntVal($result[0]->LastSalesBillNo)-1;

    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear );
    $data2 = array('LastSalesBillNo' => $NewValue);              
    $this->db->where($multi_where);
    $this->db->update('CompData', $data2);

    return strval($NewValue);
}



  function getCurrentQty($id){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ;

    $sql="
              SELECT Qty 
                from SaleDetails 
                WHERE ID ='$id'
                and SaleDetails.CoID = '$CoID'
                and SaleDetails.WorkYear = '$WorkYear'

          ";
    $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

  function getBill($billid){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ;

    $sql="SELECT BillNo from SaleDetails WHERE ID ='$billid' and CoID = '$CoID' and WorkYear = '$WorkYear'";
    $query= $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function getDebtorName($DebtorID){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ;

          $sql ="
          SELECT 
              ACTitle
              FROM ACMaster
              WHERE ACCode = '$DebtorID' 
              and GroupCode = 'BD'
              and CoID = '$CoID'
              and WorkYear = '$WorkYear'
              ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

  public function godown_name_ddmodel($CoID,$WorkYear){
    $this->db->select('GodownID, GodownDesc');
    $this->db->from('Godown');
    $this->db->where('CoID', $CoID);
    $this->db->where('WorkYear', $WorkYear);
    $query = $this->db->get();

    foreach($query->result_array() as $row)
    {
        $data[] = array(
          'GodownID' => $row['GodownID'],
          'GodownDesc' => $row['GodownDesc']
      );
    }
    return $data;
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
  
  function Get_Debtor_List(){
      $CoID = $this->session->userdata('CoID') ;
      $WorkYear = $this->session->userdata('WorkYear') ;

        $sql ="
                  SELECT ACCode, ACTitle, GroupCode
                    FROM ACMaster
                  WHERE GroupCode = 'BD'
                    and CoID = '$CoID'
                    and WorkYear = '$WorkYear'
        ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
  }

  public function debtor_name_ddmodel(){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ;

    $this->db->select('ACCode, ACTitle');
    $this->db->from('ACMastDets');
    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear );
    $this->db->where($multi_where);
    $query = $this->db->get();

    foreach($query->result_array() as $row)
    {
        $data[] = array(
          'ACCode' => $row['ACCode'],
          'ACTitle' => $row['ACTitle']
      );
    }
    return $data;
  }

  public function name_ddmodel(){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ;

    $this->db->select('PartyCode, PartyName');
    $this->db->from('PartyMaster');
    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear );
    $this->db->where($multi_where);
    $query = $this->db->get();

    foreach($query->result_array() as $row)
    {
        $data[] = array(
          'PartyCode' => $row['PartyCode'],
          'PartyName' => $row['PartyName']
      );
    }
    return $data;
  }

  public function pname_ddmodel($CoID,$WorkYear){
            $sql ="
                    SELECT 
                    PartyMaster.PartyCode,
                    PartyMaster.PartyName,
                    PartyMaster.PartyArea,
                    PartyMaster.BrokerCode,
                    ACMaster.ACTitle as 'BrokerTitle',
                    PartyMaster.PartyType 
                    From PartyMaster, ACMaster
                    Where PartyMaster.BrokerCode = ACMaster.ACCode
                    AND PartyMaster.CoID = ACMaster.CoID
                    AND PartyMaster.WorkYear = ACMaster.WorkYear
                    AND ACMaster.CoID = '$CoID'
                    AND ACMaster.WorkYear='$WorkYear'
            ";

            $query = $this->db->query($sql);
      $result = $query->result();
      return $result;

  }
      
  function Get_Customer_List(){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ;

    $sql ="
                    SELECT 
                            PartyMaster.PartyCode,
                            PartyMaster.PartyName,
                            PartyMaster.PartyArea,
                            PartyMaster.BrokerCode,
                            ACMaster.ACTitle as 'BrokerTitle',
                            PartyMaster.PartyType 
                    From PartyMaster, ACMaster
                    Where PartyMaster.BrokerCode = ACMaster.ACCode
                    AND PartyMaster.CoID = ACMaster.CoID
                    AND PartyMaster.WorkYear = ACMaster.WorkYear
                    AND ACMaster.CoID = '$CoID'
                    AND ACMaster.WorkYear='$WorkYear'
                    ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

  function getBrokers($ACCode){

      $CoID = $this->session->userdata('CoID') ;
      $WorkYear = $this->session->userdata('WorkYear');


      $sql ="
              SELECT
                    ACMaster.ACCode, ACMaster.ACTitle
              FROM  ACMaster
              WHERE GroupCode = 'B1'  
                AND ACMaster.CoID = '$CoID'
                AND ACMaster.WorkYear = '$WorkYear'
                AND ACMaster.ACCode like '$ACCode%'
            ";
      $query = $this->db->query($sql);
      return $query->result_array();

  }

  function Get_Broker_List(){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');

    $sql ="
    SELECT
      ACCode,
      ACTitle,
      GroupCode,
      BrokerCode
    FROM  ACMaster
      WHERE GroupCode = 'B1' 
      AND CoID = '$CoID'
    AND WorkYear = '$WorkYear'
    ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  } 

  // unwanted 300121
  function x1_get_details()
  {

    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ;

    $this->db->select('BillNo');
    $this->db->select('BillDate');
    $this->db->select('GodownID');
  
    $this->db->select('BrokerID');
    $this->db->select('BrokerTitle');
    $this->db->select('BillAmt');
    $this->db->select('LRNo');
    $this->db->select('DeliDate');
    $this->db->select('DebtorID');
    $this->db->select('MudiBazar');
    $this->db->select('EWayBillNo');
    $this->db->select('CPName');
    $this->db->select('PartyTitle');
    $this->db->select('Area');
    $this->db->select('SaleType');
    $this->db->select('HelMajuri');
    $this->db->select('OtherChrgs');
  
    $this->db->from('SaleMast');
    $this->db->where(array('CoID' => $CoID, 'WorkYear' => $WorkYear));
    $query = $this->db->get();

      
    $result = $query->result();
    return $result;
  }

  //HM 19-02-2021 ALL FUNCTIONS BELOW 
  //items details of invoice
  function salesInvoice($BillNo){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "        
      SELECT * 
      FROM SaleMast, SaleDetails, ItemMaster, PartyMaster, ACMaster Broker
      where SaleMast.CoID = SaleDetails.CoID
      and SaleMast.WorkYear = SaleDetails.WorkYear
      and SaleMast.BillNo = SaleDetails.BillNo
      
      and ItemMaster.CoID = SaleDetails.CoID
      and ItemMaster.WorkYear = SaleDetails.WorkYear
      and ItemMaster.ItemCode = SaleDetails.ItemCode
      
      and PartyMaster.CoID = SaleMast.CoID
      and PartyMaster.WorkYear = SaleMast.WorkYear
      and PartyMaster.PartyCode = SaleMast.PartyCode
    
      and SaleMast.CoID = Broker.CoID
      and SaleMast.WorkYear = Broker.WorkYear
      and SaleMast.BrokerId = Broker.ACCode
      
      and SaleMast.BillNo = '$BillNo'
      and SaleMast.CoID = '$CoID'
      and SaleMast.WorkYear = '$WorkYear';       
    ";
    $query = $this->db->query($sql);
    $result= $query->result_array();
    return $result;
  }

  //gstno and fssaino details
  function getGSTInvoice($BillNo){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
    SELECT BillNo,CompData.WorkYear,GSTNo,FSLNo,BankName,BankBranch,BankAccount,BankIFSC
    FROM Company,CompData,SaleMast
    where Company.CoID = CompData.COID
    and	SaleMast.CoID = Company.CoID
    and SaleMast.CoID = CompData.COID
    and SaleMast.WorkYear = CompData.WorkYear
    and SaleMast.BillNo = '$BillNo'
      and SaleMast.CoId = '$CoID'
      and SaleMast.WorkYear = '$WorkYear';
    ";
    $query = $this->db->query($sql);
    $result= $query->result();
    return $result;
  }

  //company invoice details
  function companyInvoiceTitle($BillNo){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');
    $sql ="
    SELECT BillNo,CompData.WorkYear,CoName,concat(FirmPhoneNo , ' ' , FirmAltPhoneNo) as phone,FirmEmailID, Company.Logo,
    concat( FirmAddress1 , ' ' , FirmAddress2 , ' ' , FirmAddress3 , ' ' , FirmPinCode ) as address
    from Company,SaleMast,CompData
    where Company.CoID = SaleMast.CoID
    and Company.CoID = CompData.COID
    and SaleMast.CoID = CompData.COID
    and SaleMast.WorkYear = CompData.WorkYear
    and SaleMast.BillNo = '$BillNo'
      and SaleMast.CoID = '$CoID' 
      and SaleMast.WorkYear = '$WorkYear';
    ";
    $query = $this->db->query($sql);
    $result= $query->result();
    return $result; 
  }

  //gsttin no, fssai no and broker invoice details
  function invoiceBroker($BillNo){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
    SELECT BillNo,SaleMast.WorkYear,PartyGSTNo,PartyFSLNo,BillDate,PartyFSLDate, 
          (select ACTitle 
             from ACMaster 
             where ACMaster.ACCode = SaleMast.BrokerID
               and ACMaster.CoID = '$CoID'
               and ACMaster.WorkYear = '$WorkYear') as BrokerTitle
    from PartyMaster,SaleMast
    where PartyMaster.PartyCode = SaleMast.PartyCode
      and PartyMaster.CoID = SaleMast.CoID
      and PartyMaster.WorkYear = SaleMast.WorkYear 
      and SaleMast.BillNo = '$BillNo'
      and SaleMast.CoID = '$CoID' 
      and SaleMast.WorkYear = '$WorkYear';
    ";
    $query = $this->db->query($sql);
    $result= $query->result();
    return $result; 
  }

  //invoice billing address details
  function billingAddressInvoice($BillNo){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
    SELECT BillNo,SaleMast.WorkYear,PartyName,PartyAddressI,PartyAddressII,PartyAddressIII,PartyCity,PartyState,StateCode,EMailID,PartyArea
    from PartyMaster,SaleMast
    where PartyMaster.PartyCode = SaleMast.PartyCode
      and PartyMaster.CoID = SaleMast.CoID
      and PartyMaster.WorkYear = SaleMast.WorkYear 
      and SaleMast.BillNo = '$BillNo'
      and SaleMast.CoID = '$CoID'
      and SaleMast.WorkYear = '$WorkYear';
    ";
    $query = $this->db->query($sql);
    $result= $query->result();
    return $result; 
  }

  //invoice debit memo details
  function debitMemoInvoice($BillNo){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
      SELECT BillNo,SaleMast.WorkYear,PartyPANo,LRNo,BillDate,Haste
      from PartyMaster,SaleMast
      where PartyMaster.PartyCode = SaleMast.PartyCode
      and PartyMaster.CoID = SaleMast.CoID
      and PartyMaster.WorkYear = SaleMast.WorkYear 
      and SaleMast.BillNo = '$BillNo'
      and SaleMast.CoID = '$CoID' 
      and SaleMast.WorkYear = '$WorkYear';
    ";
    $query = $this->db->query($sql);
    $result= $query->result();
    return $result;
  }

  //shows invoice item details and calculates charges
  function calculateInvoice($BillNo){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
            Select BillNo,WorkYear,ItemAmt as GrossAmt,ContAmt,DiscountAmt,HelMajuri,APMCChrg,
                    sum(CGSTAmt) as CGSTAmt,sum(SGSTAmt) as SGSTAmt,sum(IGSTAmt) as IGSTAmt,
                    RoffAmt,TCSAmount, BillAmt
              from SaleMast
              where BillNo = '$BillNo'
              and CoID = '$CoID'
              and WorkYear = '$WorkYear';
    ";
    $query = $this->db->query($sql);
    $result= $query->result();
    return $result;
  }

  //fetches godown description of invoice
  function fetchGoDownDescription($BillNo){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
      Select SaleMast.BillNo,SaleMast.WorkYear,SaleMast.GodownID,GodownDesc 
      FROM Godown,SaleMast
      where SaleMast.GodownID = Godown.GodownID
      and SaleMast.BillNo = '$BillNo'
      and SaleMast.CoID = '$CoID'
      and SaleMast.WorkYear = '$WorkYear';
    ";
    $query = $this->db->query($sql);
    $result= $query->result();
    return $result; 
  }

  //divides TaxCode-5 into CGST,SGST or IGST 
  function taxCode5($BillNo) {
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
            Select sum(TaxAmt) as TaxAmt,TaxCode,BillNo,sum(CGSTAmt) as CGST,sum(SGSTAmt) as SGST,sum(IGSTAmt) as IGST
            from SaleDetails
            where TaxCode = 'G5'
            and BillNo = '$BillNo' 
            and CoID = '$CoID'
            and WorkYear = '$WorkYear'	
            group by TaxCode;        
    ";
    $query = $this->db->query($sql);
    $result= $query->result();
    return $result;
  }

  //divides TaxCode-12 into CGST,SGST or IGST 
  function taxCode12($BillNo) {
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
    Select sum(TaxAmt) as TaxAmt,TaxCode,BillNo,sum(CGSTAmt) as CGST,sum(SGSTAmt) as SGST,sum(IGSTAmt) as IGST
    from SaleDetails
    where TaxCode = 'G12'
    and BillNo = '$BillNo' 
    and CoID = '$CoID'
    and WorkYear = '$WorkYear'	
    group by TaxCode;        
    ";
    $query = $this->db->query($sql);
    $result= $query->result();
    return $result;
  }

  //divides TaxCode-18 into CGST,SGST or IGST 
  function taxCode18($BillNo) {
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
    Select sum(TaxAmt) as TaxAmt,TaxCode,BillNo,sum(CGSTAmt) as CGST,sum(SGSTAmt) as SGST,sum(IGSTAmt) as IGST
    from SaleDetails
    where TaxCode = 'G18'
    and BillNo = '$BillNo' 
    and CoID = '$CoID'
    and WorkYear = '$WorkYear'	
    group by TaxCode;        
    ";
    $query = $this->db->query($sql);
    $result= $query->result();
    return $result;
  }

  //divides TaxCode>18 into CGST,SGST or IGST 
  function taxCode18Plus($BillNo) {
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
    Select sum(TaxAmt) as TaxAmt,TaxCode,BillNo,sum(CGSTAmt) as CGST,sum(SGSTAmt) as SGST,sum(IGSTAmt) as IGST
    from SaleDetails
    where TaxCode not in ('G5','G12','G18')
    and BillNo = '$BillNo' 
    and CoID = '$CoID'
    and WorkYear = '$WorkYear'	
    group by TaxCode;        
    ";
    $query = $this->db->query($sql);
    $result= $query->result();
    return $result;
  }

  // TaxCode for GST 01032021
  function tax($BillNo) {
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
    Select SaleDetails.TaxCode,TaxTitle,CGSTTitle,SGSTTitle,IGSTTitle
    from TaxMaster,SaleDetails
    where TaxMaster.TaxCode = SaleDetails.TaxCode
    and BillNo = '$BillNo' 
    and CoID = '$CoID'
    and WorkYear = '$WorkYear'
    group by TaxTitle;
    ";
    $query = $this->db->query($sql);
    $result= $query->result();
    return $result;
  }

  // divides TaxCode into CGST,SGST or IGST 01032021
  function taxCodeGST($BillNo) {
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
              Select sum(TaxAmt) as TaxAmt,TaxMaster.TaxCode,BillNo,TaxTitle,CGSTTitle,SGSTTitle,IGSTTitle,
                      (case when (TaxMaster.TaxCode = 'G5') then round(Sum(TaxAmt)/2,2) else round(0,2) end) GST5, 
                      (case when (TaxMaster.TaxCode = 'G12') then round(Sum(TaxAmt)/2,2) else round(0,2) end) GST12,
                      (case when (TaxMaster.TaxCode = 'G18') then round(Sum(TaxAmt)/2,2) else round(0,2) end) GST18,
                      (case when (TaxMaster.TaxCode <> 'G5' && 
                                  TaxMaster.TaxCode <> 'G12' && 
                                  TaxMaster.TaxCode <> 'G18') then round(Sum(TaxAmt)/2,2) else round(0,2) end) GST18Plus
              from SaleDetails,TaxMaster
              where TaxMaster.TaxCode = SaleDetails.TaxCode
              and BillNo = '$BillNo' 
              and CoID = '$CoID'
              and WorkYear = '$WorkYear'	
              group by TaxMaster.TaxCode;       
            ";
    $query = $this->db->query($sql);
    $result= $query->result();
    return $result;
  }

  // ALL REPORTS FUNCTIONS KAJAL 

  // updated 13-02-21
  function get_SalesDatewise(){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    // $WorkYear = '2019-20';

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
                  select
                      sm.BillNo,
                      DATE_FORMAT(sm.BillDate,'%d-%m-%Y') as BillDate,
                      pm.PartyName as PartyName,
                      sm.PartyCode,
                      sm.Area as AreaName,
                      ac.ACTitle as BrokerName,
                      sm.BrokerID,
                      sm.BillAmt,
                      sd.Qty,
                      sd.NetWt,
                      sd.Rate,
                      sm.EWayBillNo,
                      pm.PartyGSTNo as GSTNo
                  from
                      SaleMast sm, SaleDetails sd, ACMaster ac, PartyMaster pm
                  where sm.CoID=sd.CoID 
                    AND sm.WorkYear=sd.WorkYear 
                    AND sm.BillNo=sd.BillNo

                    AND sd.CoID=ac.CoID 
                    AND sm.WorkYear=ac.WorkYear 
                    AND sm.BrokerID=ac.ACCode

                    AND sm.CoID=pm.CoID 
                    AND sm.WorkYear=pm.WorkYear 
                    AND sm.PartyCode=pm.PartyCode 
                    
                    and sm.BillDate BETWEEN '$f' AND '$t'
                    AND sm.CoID ='$CoID'
                    AND sm.WorkYear = '$WorkYear'
                 order by sm.BillDate desc
               ";
    $query = $this->db->query($sql)->result_array();

    
    if(empty($query))
    {
      $sql = "           
          select
                  sm.BillNo,
                  DATE_FORMAT(sm.BillDate,'%d-%m-%Y') as BillDate,
                  pm.PartyName as PartyName,
                  sm.PartyCode,
                  sm.Area as AreaName,
                  ac.ACTitle as BrokerName,
                  sm.BrokerID,
                  sm.BillAmt,
                  sd.Qty,
                  sd.NetWt,
                  sd.Rate,
                  sm.EWayBillNo,
                  pm.PartyGSTNo as GSTNo
          from
          SaleMast sm, SaleDetails sd, ACMaster ac, PartyMaster pm
          where sm.CoID=sd.CoID 
          AND sm.WorkYear=sd.WorkYear 
          AND sm.BillNo=sd.BillNo

          AND sm.CoID=ac.CoID 
          AND sm.WorkYear=ac.WorkYear 
          AND sm.BrokerID=ac.ACCode

          AND sm.CoID=pm.CoID 
          AND sm.WorkYear=pm.WorkYear 
          AND sm.PartyCode=pm.PartyCode 
          
          AND sm.CoID ='$CoID'
          AND sm.WorkYear = '$WorkYear' limit 1
          
      ";
      $query = $this->db->query($sql);
      $ea=array("empty");

      foreach ($query->list_fields() as $field)
      {
            array_push($ea, $field);
      }
  
       return array($ea,$f,$t);
    }
    return array($query,$f,$t);
  }

  // updated 13-02-21
  function get_SalesDatewiseFilter($fromYear,$toYear){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 

    $sql = "        
              select 
                    sm.BillNo,
                    DATE_FORMAT(sm.BillDate,'%d-%m-%Y') as BillDate,
                    pm.PartName,
                    sm.PartyCode,
                    sm.Area as AreaName,
                    ac.ACTitle as BrokerName,
                    sm.BrokerID,
                    sm.BillAmt,
                    sd.Qty,
                    sd.NetWt,
                    sd.Rate,
                    sm.EWayBillNo,
                    pm.PartyGSTNo as GSTNo
              
              from
              SaleMast sm, SaleDetails sd, ACMaster ac, PartyMaster pm
              where sm.CoID=sd.CoID 
              AND sm.WorkYear=sd.WorkYear 
              AND sm.BillNo=sd.BillNo
              
              AND sm.CoID=ac.CoID 
              AND sm.WorkYear=ac.WorkYear 
              AND sm.BrokerID=ac.ACCode

              AND sm.CoID=pm.CoID 
              AND sm.WorkYear=pm.WorkYear 
              AND sm.PartyCode=pm.PartyCode 

              and sm.BillDate BETWEEN '$fromYear' AND '$toYear'
              AND sm.CoID ='$CoID'
              AND sm.WorkYear = '$WorkYear'
              order by sm.BillDate desc 
              ";
      $query = $this->db->query($sql)->result_array();

      if(empty($query))
      {
        $sql = "           
        select
                    sm.BillNo,
                    DATE_FORMAT(sm.BillDate,'%d-%m-%Y') as BillDate,
                    sm.PartyID as PartyName,
                    sm.PartyCode,
                    sm.Area as AreaName,
                    ac.ACTitle as BrokerName,
                    sm.BrokerID,
                    sm.BillAmt,
                    sd.Qty,
                    sd.NetWt,
                    sd.Rate,
                    sm.EWayBillNo,
                    pm.PartyGSTNo as GSTNo
            from
            SaleMast sm, SaleDetails sd, ACMaster ac, PartyMaster pm
            where sm.CoID=sd.CoID 
            AND sm.WorkYear=sd.WorkYear 
            AND sm.BillNo=sd.BillNo

            AND sm.CoID=ac.CoID 
            AND sm.WorkYear=ac.WorkYear 
            AND sm.BrokerID=ac.ACCode

            AND sm.CoID=pm.CoID 
            AND sm.WorkYear=pm.WorkYear 
            AND sm.PartyCode=pm.PartyCode 

            AND sm.CoID ='$CoID'
            AND sm.WorkYear = '$WorkYear' limit 1
      ";
      $query = $this->db->query($sql);
      $ea=array("empty");

      foreach ($query->list_fields() as $field)
      {
            array_push($ea, $field);
      }
    
         return array($ea,$fromYear,$toYear);
    }


      return array($query,$fromYear,$toYear);
  }

  //updated 13-02-21
  function get_BriefSalesDatewise(){
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
            SELECT 
                    sm.BillNo,
                    DATE_FORMAT(sm.BillDate,'%d-%m-%Y') as BillDate,
                    sm.DebtorID,
                    ac.ACTitle as 'Debtor Name',
                    sm.PartyCode,
                    pm.PartyName,
                    pm.PartyArea as 'Area Name',
                    sm.BrokerID,
                    ac1.ACTitle as 'Broker Name',
                    sm.BillAmt
                FROM
                SaleMast sm left join ACMaster ac
                ON sm.CoID = ac.CoID
                AND sm.WorkYear = ac.WorkYear
                AND sm.DebtorID = ac.ACCode

                left join PartyMaster pm
                ON sm.PartyCode = pm.PartyCode
                AND sm.CoID=pm.CoID 
                AND sm.WorkYear=pm.WorkYear 

                left join ACMaster ac1
                ON sm.CoID = ac1.CoID
                AND sm.WorkYear = ac1.WorkYear
                AND sm.BrokerID = ac1.ACCode
                where sm.BillDate BETWEEN '$f' AND '$t'
                AND sm.CoID ='$CoID'
                AND sm.WorkYear = '$WorkYear'
                 order by sm.BillDate desc
             ";
    $query = $this->db->query($sql)->result_array();

    
    if(empty($query))
    {
      $sql = "           
      SELECT 
              sm.BillNo,
              DATE_FORMAT(sm.BillDate,'%d-%m-%Y') as BillDate,
              sm.DebtorID,
              ac.ACTitle as 'Debtor Name',
              sm.PartyCode,
              pm.PartyName,
              pm.PartyArea as 'Area Name',
              sm.BrokerID,
              ac1.ACTitle as 'Broker Name',
              sm.BillAmt
          FROM
          SaleMast sm left join ACMaster ac
          ON sm.CoID = ac.CoID
          AND sm.WorkYear = ac.WorkYear
          AND sm.DebtorID = ac.ACCode
          
          left join PartyMaster pm
          ON sm.PartyCode = pm.PartyCode
          AND sm.CoID=pm.CoID 
          AND sm.WorkYear=pm.WorkYear 
          
          left join ACMaster ac1
          ON sm.CoID = ac1.CoID
          AND sm.WorkYear = ac1.WorkYear
          AND sm.BrokerID = ac1.ACCode 
          AND sm.CoID ='$CoID'
          AND sm.WorkYear = '$WorkYear' limit 1
      ";
      $query = $this->db->query($sql);
      $ea=array("empty");

      foreach ($query->list_fields() as $field)
      {
            array_push($ea, $field);
      }
    
        return array($ea,$f,$t);
    }
      
    return array($query,$f,$t);
    
  }

  //updated 13-02-21
  function get_BriefSalesDatewiseFilter($fromYear,$toYear){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 
    $sql = "        
            SELECT 
                sm.BillNo,
                DATE_FORMAT(sm.BillDate,'%d-%m-%Y') as BillDate,
                sm.DebtorID,
                ac.ACTitle as 'Debtor Name',
                sm.PartyCode,
                pm.PartyName,
                pm.PartyArea as 'Area Name',
                sm.BrokerID,
                ac1.ACTitle as 'Broker Name',
                sm.BillAmt
            FROM
            SaleMast sm left join ACMaster ac
            ON sm.CoID = ac.CoID
            AND sm.WorkYear = ac.WorkYear
            AND sm.DebtorID = ac.ACCode
            
            left join PartyMaster pm
            ON sm.PartyCode = pm.PartyCode
            AND sm.CoID=pm.CoID 
            AND sm.WorkYear=pm.WorkYear 
            
            left join ACMaster ac1
            ON sm.CoID = ac1.CoID
            AND sm.WorkYear = ac1.WorkYear
            AND sm.BrokerID = ac1.ACCode
            where sm.BillDate BETWEEN '$fromYear' AND '$toYear'
            AND sm.CoID ='$CoID'
            order by sm.BillDate desc 
              ";
      $query = $this->db->query($sql)->result_array();

      if(empty($query))
      {
        $sql = "           
        SELECT 
                sm.BillNo,
                DATE_FORMAT(sm.BillDate,'%d-%m-%Y') as BillDate,
                sm.DebtorID,
                ac.ACTitle as 'Debtor Name',
                sm.PartyCode,
                pm.PartyName,
                pm.PartyArea as 'Area Name',
                sm.BrokerID,
                ac1.ACTitle as 'Broker Name',
                sm.BillAmt
            FROM
            SaleMast sm left join ACMaster ac
            ON sm.CoID = ac.CoID
            AND sm.WorkYear = ac.WorkYear
            AND sm.DebtorID = ac.ACCode
            
            left join PartyMaster pm
            ON sm.PartyCode = pm.PartyCode
            AND sm.CoID=pm.CoID 
            AND sm.WorkYear=pm.WorkYear 
            
            left join ACMaster ac1
            ON sm.CoID = ac1.CoID
            AND sm.WorkYear = ac1.WorkYear
            AND sm.BrokerID = ac1.ACCode 
            AND sm.CoID ='$CoID' limit 1
      ";
      $query = $this->db->query($sql);
      $ea=array("empty");

      foreach ($query->list_fields() as $field)
      {
            array_push($ea, $field);
      }
    
         return array($ea,$fromYear,$toYear);
    }


    return array($query,$fromYear,$toYear);
  }

  //updated 13-02-21
  function get_TaxableSalesDatewise(){
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
            SELECT 
                    sm.BillNo,
                    DATE_FORMAT(sm.BillDate,'%d-%m-%Y') as BillDate,
                    sm.DebtorID,
                    ac.ACTitle as 'Debtor Name',
                    sm.PartyCode,
                    pm.PartyName,
                    pm.PartyArea as 'Area Name',
                    pm.PartyGSTNo, 
                    pm.PartyFSLNo,  
                    sm.BrokerID,
                    ac1.ACTitle as 'Broker Name',
                    sm.BillAmt,
                    sd.GodownID,
                    sd.LotNo,
                    im.HSNCode,
                    sd.ItemCode,
                    im.ItemName,
                    sd.ItemMark,
                    sd.Qty,
                    sd.GrossWt,
                    sd.NetWt,
                    sd.Rate,
                    sd.ItemAmt,
                    sd.DiscAmt,
                    sd.ContChrg,
                    sd.GrAmt,
                    sm.LagaAmt,
                    sd.APMCChrg as 'APMC Amt',
                    sm.AddAmt,
                    sm.LessAmt,
                    sd.TaxableAmt,
                    sd.TaxAmt,
                    sd.CGSTAmt,
                    sd.SGSTAmt,
                    sd.IGSTAmt,
                    sd.APMCIn,
                    sm.RoffAmt as 'HMaju Amt',
                    sm.SaleType
            FROM
            SaleMast sm left join SaleDetails sd
            ON sm.CoID = sd.CoID
            AND sm.WorkYear = sd.WorkYear
            AND sm.BillNo = sd.BillNo
            
            left join ACMaster ac
            ON sm.CoID = ac.CoID
            AND sm.WorkYear = ac.WorkYear
            AND sm.DebtorID = ac.ACCode
            
            left join PartyMaster pm
            ON sm.PartyCode = pm.PartyCode
            AND sm.CoID=pm.CoID 
            AND sm.WorkYear=pm.WorkYear 
            
            left join ItemMaster im
            on sd.WorkYear=im.WorkYear
            AND sd.CoID= im.CoID
            AND sd.ItemCode=im.ItemCode
            
            left join ACMaster ac1
            ON sm.CoID = ac1.CoID
            AND sm.WorkYear = ac1.WorkYear
            AND sm.BrokerID = ac1.ACCode
                where sm.BillDate BETWEEN '$f' AND '$t'
                AND sm.CoID ='$CoID'
                AND sm.WorkYear = '$WorkYear'
                 order by sm.BillDate desc
             ";
    $query = $this->db->query($sql)->result_array();

    
    if(empty($query))
    {
      $sql = "           
          SELECT 
                  sm.BillNo,
                  DATE_FORMAT(sm.BillDate,'%d-%m-%Y') as BillDate,
                  sm.DebtorID,
                  ac.ACTitle as 'Debtor Name',
                  sm.PartyCode,
                  pm.PartyName,
                  pm.PartyArea as 'Area Name',
                  pm.PartyGSTNo, 
                  pm.PartyFSLNo,
                  sm.BrokerID,
                  ac1.ACTitle as 'Broker Name',
                  sm.BillAmt,
                  sd.GodownID,
                  sd.LotNo,
                  im.HSNCode,
                  sd.ItemCode,
                  im.ItemName,
                  sd.ItemMark,
                  sd.Qty,
                  sd.GrossWt,
                  sd.NetWt,
                  sd.Rate,
                  sm.ItemAmt,
                  sm.DiscountAmt,
                  sd.ContChrg,
                  sm.GrossAmt,
                  sm.LagaAmt,
                  sd.APMCChrg as 'APMC Amt',
                  sm.AddAmt,
                  sm.LessAmt,
                  sm.TaxableAmt,
                  sm.TaxAmt,
                  sm.CGSTAmt,
                  sm.SGSTAmt,
                  sm.IGSTAmt,
                  sd.APMCIn,
                  sm.RoffAmt as 'HMaju Amt',
                  sm.SaleType
          FROM
          SaleMast sm left join SaleDetails sd
          ON sm.CoID = sd.CoID
          AND sm.WorkYear = sd.WorkYear
          AND sm.BillNo = sd.BillNo
          
          left join ACMaster ac
          ON sm.CoID = ac.CoID
          AND sm.WorkYear = ac.WorkYear
          AND sm.DebtorID = ac.ACCode
          
          left join PartyMaster pm
          ON sm.PartyCode = pm.PartyCode
          AND sm.CoID=pm.CoID 
          AND sm.WorkYear=pm.WorkYear 
          
          left join ItemMaster im
          on sd.WorkYear=im.WorkYear
          AND sd.CoID= im.CoID
          AND sd.ItemCode=im.ItemCode
          
          left join ACMaster ac1
          ON sm.CoID = ac1.CoID
          AND sm.WorkYear = ac1.WorkYear
          AND sm.BrokerID = ac1.ACCode
          AND sm.CoID ='$CoID'
          AND sm.WorkYear = '$WorkYear' limit 1
      ";
      $query = $this->db->query($sql);
      $ea=array("empty");

      foreach ($query->list_fields() as $field)
      {
            array_push($ea, $field);
      }
    
      return array($ea,$f,$t);
    }
    
    return array($query,$f,$t);  
  }

  //updated 13-02-21
  function get_TaxableSalesDatewiseFilter($fromYear,$toYear){
    $CoID = $this->session->userdata('CoID') ;
    $WorkYear = $this->session->userdata('WorkYear') ; 
    $sql = "        
      SELECT 
                  sm.BillNo,
                  DATE_FORMAT(sm.BillDate,'%d-%m-%Y') as BillDate,
                  sm.DebtorID,
                  ac.ACTitle as 'Debtor Name',
                  sm.PartyCode,
                  pm.PartyName,
                  pm.PartyArea as 'Area Name',
                  pm.PartyGSTNo, 
                  pm.PartyFSLNo,
                  sm.BrokerID,
                  ac1.ACTitle as 'Broker Name',
                  sm.BillAmt,
                  sd.GodownID,
                  sd.LotNo,
                  im.HSNCode,
                  sd.ItemCode,
                  im.ItemName,
                  sd.ItemMark,
                  sd.Qty,
                  sd.GrossWt,
                  sd.NetWt,
                  sd.Rate,
                  sd.ItemAmt,
                  sd.DiscAmt,
                  sd.ContChrg,
                  sd.GrAmt,
                  sm.LagaAmt,
                  sm.APMCChrg as 'APMC Amt',
                  sm.AddAmt,
                  sm.LessAmt,
                  sd.TaxableAmt,
                  sd.TaxAmt,
                  sd.CGSTAmt,
                  sd.SGSTAmt,
                  sd.IGSTAmt,
                  sd.APMCIn,
                  sm.RoffAmt as 'HMaju Amt',
                  sm.SaleType
          FROM
          SaleMast sm left join SaleDetails sd
          ON sm.CoID = sd.CoID
          AND sm.WorkYear = sd.WorkYear
          AND sm.BillNo = sd.BillNo

          left join ACMaster ac
          ON sm.CoID = ac.CoID
          AND sm.WorkYear = ac.WorkYear
          AND sm.DebtorID = ac.ACCode

          left join PartyMaster pm
          ON sm.PartyCode = pm.PartyCode
          AND sm.CoID=pm.CoID 
          AND sm.WorkYear=pm.WorkYear 

          left join ItemMaster im
          on sd.WorkYear=im.WorkYear
          AND sd.CoID= im.CoID
          AND sd.ItemCode=im.ItemCode

          left join ACMaster ac1
          ON sm.CoID = ac1.CoID
          AND sm.WorkYear = ac1.WorkYear
          AND sm.BrokerID = ac1.ACCode
            where sm.BillDate BETWEEN '$fromYear' AND '$toYear'
            AND sm.CoID ='$CoID'
            order by sm.BillDate desc 
              ";
      $query = $this->db->query($sql)->result_array();

      if(empty($query))
      {
        $sql = "           
          SELECT 
              sm.BillNo,
              DATE_FORMAT(sm.BillDate,'%d-%m-%Y') as BillDate,
              sm.DebtorID,
              ac.ACTitle as 'Debtor Name',
              sm.PartyCode,
              pm.PartyName,
              pm.PartyArea as 'Area Name',
              pm.PartyGSTNo, 
              pm.PartyFSLNo,
              sm.BrokerID,
              ac1.ACTitle as 'Broker Name',
              sm.BillAmt,
              sd.GodownID,
              sd.LotNo,
              im.HSNCode,
              sd.ItemCode,
              im.ItemName,
              sd.ItemMark,
              sd.Qty,
              sd.GrossWt,
              sd.NetWt,
              sd.Rate,
              sm.ItemAmt,
              sm.DiscAmt,
              sm.ContChrg,
              sm.GrossAmt,
              sm.LagaAmt,
              sm.APMCChrg as 'APMC Amt',
              sm.AddAmt,
              sm.LessAmt,
              sm.TaxableAmt,
              sm.TaxAmt,
              sm.CGSTAmt,
              sm.SGSTAmt,
              sm.IGSTAmt,
              sd.APMCIn,
              sm.RoffAmt as 'HMaju Amt',
              sm.SaleType
      FROM
      SaleMast sm left join SaleDetails sd
      ON sm.CoID = sd.CoID
      AND sm.WorkYear = sd.WorkYear
      AND sm.BillNo = sd.BillNo
      
      left join ACMaster ac
      ON sm.CoID = ac.CoID
      AND sm.WorkYear = ac.WorkYear
      AND sm.DebtorID = ac.ACCode
      
      left join PartyMaster pm
      ON sm.PartyCode = pm.PartyCode
      AND sm.CoID=pm.CoID 
      AND sm.WorkYear=pm.WorkYear 
      
      left join ItemMaster im
      on sd.WorkYear=im.WorkYear
      AND sd.CoID= im.CoID
      AND sd.ItemCode=im.ItemCode
      
      left join ACMaster ac1
      ON sm.CoID = ac1.CoID
      AND sm.WorkYear = ac1.WorkYear
      AND sm.BrokerID = ac1.ACCode
      AND sm.CoID ='$CoID' limit 1
      ";
      $query = $this->db->query($sql);
      $ea=array("empty");

      foreach ($query->list_fields() as $field)
      {
            array_push($ea, $field);
      }
    
         return array($ea,$fromYear,$toYear);
    }


      return array($query,$fromYear,$toYear);
  }



  function getSalesReturnEntryData($id)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
      SELECT 
                  SaleMast.PartyCode,
                  SaleMast.PartyID,
                  SaleMast.BillDate,
                  SaleMast.GodownID,
                  SaleMast.MudiBazar,
                  SaleMast.BrokerID,
                  (select ACTitle
                      from ACMastDets
                      where ACMastDets.CoID=SaleMast.CoID
                      and ACMastDets.WorkYear=SaleMast.WorkYear
                      and ACMastDets.ACCode=SaleMast.BrokerID)
                       as BrokerName,
                  SaleMast.BillAmt,
                  SaleMast.HelMajuri,
                  SaleMast.ReturnAmt,
                  SaleMast.OtherChrgs,
                  SaleMast.GrossAmt,
                  SaleMast.ADDAmt,
                  SaleMast.LessAmt,
                  SaleMast.TaxableAmt,
                  SaleDetails.APMCChrg,
                  SaleMast.CGSTAmt,
                  SaleMast.SGSTAmt,
                  SaleMast.IGSTAmt,
                  SaleMast.TaxInd,
                  SaleDetails.NetAmt,
                  SaleMast.DiscountAmt,
                  SaleDetails.CreditAcc,
                  SaleDetails.LotNo,
                  SaleDetails.ItemCode,
                  SaleDetails.ItemMark,
                  SaleDetails.Qty,
                  SaleDetails.GrossWt,
                  SaleDetails.NetWt,
                  SaleDetails.Rate
       from SaleDetails, SaleMast
       where SaleDetails.CoID=SaleMast.CoID
       and SaleDetails.WorkYear=SaleMast.WorkYear
       and SaleDetails.BillNo=SaleMast.BillNO
       and SaleDetails.CoID = '$CoID'
       AND SaleDetails.WorkYear = '$WorkYear'
       And SaleDetails.BillNo=$id
 ";
    $query = $this->db->query($sql);
    // $query = $this->db->get($sql);
    $result = $query->result();
    return $result;
  }



}

?>