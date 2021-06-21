<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GSTR1Model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

     function getB2BData($first_date,$last_date){

        $CoID = $this->session->userdata('CoID');
  $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
                  select  
                          PartyMaster.PartyGSTNo as 'GSTIN', 
                          PartyMaster.PartyName, 
                          SaleMast.BillNo, 
                          DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as BillDate,
                          SaleMast.BillAmt,
                          PartyMaster.PartyState as PlaceOfSupply,
                          'N' ReverseCharge, 
                          '0' ApplicableTaxRate,
                          'Regular' InvoiceType, 
                          ' ' ECommerceGSTIN, 
                          SaleDetails.TaxCode, 
                          SaleDetails.TaxableAmt, 
                          '0' Cess
                              
                  from SaleMast, SaleDetails, PartyMaster
                  where 
                          SaleMast.CoID = SaleDetails.CoID
                  and SaleMast.WorkYear = SaleDetails.WorkYear
                  and SaleMast.BillNo = SaleDetails.BillNo

                  and PartyMaster.PartyCode = SaleMast.PartyCode
                  and PartyMaster.CoID = SaleMast.CoID
                  and PartyMaster.WorkYear = SaleMast.WorkYear

                  and SaleMast.CoID = '$CoID'
                  and SaleMast.WorkYear = '$WorkYear'
                  and SaleMast.BillDate between '$first_date' and '$last_date'

                  and  PartyMaster.PartyGSTNo <> ''
                  order by Cast(SaleMast.BillNo As Integer) 

          ";
   $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
}

 function getB2C1Data($first_date,$last_date){

        $CoID = $this->session->userdata('CoID');
  $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
                  select  
                          SaleMast.BillNo, 
                          DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as BillDate,
                          SaleMast.BillAmt,
                          PartyMaster.PartyState,
                          '0' ApplicableTaxRate,
                          SaleDetails.TaxCode, 
                          SaleDetails.TaxableAmt, 
                          '0' Cess,
                          ' ' ECommerceGSTIN
                                  
                  from SaleMast, SaleDetails, PartyMaster
                  where 
                          SaleMast.CoID = SaleDetails.CoID
                  and SaleMast.WorkYear = SaleDetails.WorkYear
                  and SaleMast.BillNo = SaleDetails.BillNo
                  
                  and PartyMaster.PartyCode = SaleMast.PartyCode
                  and PartyMaster.CoID = SaleMast.CoID
                  and PartyMaster.WorkYear = SaleMast.WorkYear
                  
                  and SaleMast.CoID = '$CoID'
                  and SaleMast.WorkYear = '$WorkYear'

                  and SaleMast.BillDate between '$first_date' and '$last_date'

                  and  PartyMaster.PartyGSTNo = ''
                  and SaleMast.BillAmt > 250000
                  order by Cast(SaleMast.BillNo As Integer) 

          ";
   $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
}

 function getB2CSData($first_date,$last_date){

        $CoID = $this->session->userdata('CoID');
  $WorkYear = $this->session->userdata('WorkYear');
  
    $sql = "
                  select  
                          'OE' as Type, 
                          PartyMaster.PartyState as PlaceOfSupply,
                          '0' ApplicableTaxRate,
                          SaleDetails.TaxCode, 
                          sum(SaleDetails.TaxableAmt) as TaxableAmt, 
                          '0' Cess,
                          ' ' ECommerceGSTIN
                                  
                  from SaleMast, SaleDetails, PartyMaster
                  where 
                      SaleMast.CoID = SaleDetails.CoID
                  and SaleMast.WorkYear = SaleDetails.WorkYear
                  and SaleMast.BillNo = SaleDetails.BillNo

                  and PartyMaster.PartyCode = SaleMast.PartyCode
                  and PartyMaster.CoID = SaleMast.CoID
                  and PartyMaster.WorkYear = SaleMast.WorkYear

                  and SaleMast.CoID = '$CoID'
                  and SaleMast.WorkYear = '$WorkYear'
                  and SaleMast.BillDate between '$first_date' and '$last_date'

                  and  PartyMaster.PartyGSTNo = ''
                  Group By Type, PlaceOfSupply, TaxCode
                  order by PlaceOfSupply, TaxCode

          ";
   $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
}

function getGSTR1exempt($first_date,$last_date){

        $CoID = $this->session->userdata('CoID');
  $WorkYear = $this->session->userdata('WorkYear');
  
    $sql = "
                  select  
                          'Inter-State supplies to registered persons' as Description,
                          sum(SaleMast.BillAmt) as NilRatedSupply, 
                          '0' as ExemptedOtherThanNilRatedNonGSTSupply,
                          '0' as NonGSTSupply

                  from SaleMast, SaleDetails, PartyMaster
                  where 
                          SaleMast.CoID = SaleDetails.CoID
                  and SaleMast.WorkYear = SaleDetails.WorkYear
                  and SaleMast.BillNo = SaleDetails.BillNo

                  and PartyMaster.PartyCode = SaleMast.PartyCode
                  and PartyMaster.CoID = SaleMast.CoID
                  and PartyMaster.WorkYear = SaleMast.WorkYear

                  and SaleMast.CoID = '$CoID'
                  and SaleMast.WorkYear = '$WorkYear'
                  and SaleMast.BillDate between '$first_date' and '$last_date'

                  and PartyMaster.StateCode = '27'
                  and SaleDetails.TaxCode = 'G0'
                  and  PartyMaster.PartyGSTNo <> ''

                  UNION 

                  select  
                          'Intra-State supplies to registered persons' as Description,
                          sum(SaleMast.BillAmt) as NilRatedSupply, 
                          '0' as ExemptedOtherThanNilRatedNonGSTSupply,
                          '0' as NonGSTSupply

                  from SaleMast, SaleDetails, PartyMaster
                  where 
                          SaleMast.CoID = SaleDetails.CoID
                  and SaleMast.WorkYear = SaleDetails.WorkYear
                  and SaleMast.BillNo = SaleDetails.BillNo

                  and PartyMaster.PartyCode = SaleMast.PartyCode
                  and PartyMaster.CoID = SaleMast.CoID
                  and PartyMaster.WorkYear = SaleMast.WorkYear

                  and SaleMast.CoID = '$CoID'
                  and SaleMast.WorkYear = '$WorkYear'
                  and SaleMast.BillDate between '$first_date' and '$last_date'

                  and PartyMaster.StateCode <> '27'
                  and SaleDetails.TaxCode = 'G0'	
                  and  PartyMaster.PartyGSTNo <> ''    

                  union

                  select  
                          'Inter-State supplies to unregistered persons' as Description,
                          sum(SaleMast.BillAmt) as NilRatedSupply, 
                          '0' as ExemptedOtherThanNilRatedNonGSTSupply,
                          '0' as NonGSTSupply

                  from SaleMast, SaleDetails, PartyMaster
                  where 
                          SaleMast.CoID = SaleDetails.CoID
                  and SaleMast.WorkYear = SaleDetails.WorkYear
                  and SaleMast.BillNo = SaleDetails.BillNo

                  and PartyMaster.PartyCode = SaleMast.PartyCode
                  and PartyMaster.CoID = SaleMast.CoID
                  and PartyMaster.WorkYear = SaleMast.WorkYear

                  and SaleMast.CoID = '$CoID'
                  and SaleMast.WorkYear = '$WorkYear'
                  and SaleMast.BillDate between '$first_date' and '$last_date'

                  and PartyMaster.StateCode = '27'
                  and SaleDetails.TaxCode = 'G0'
                  and  PartyMaster.PartyGSTNo = ''

                  UNION 

                  select  
                          'Intra-State supplies to unregistered persons' as Description,
                          sum(SaleMast.BillAmt) as NilRatedSupply, 
                          '0' as ExemptedOtherThanNilRatedNonGSTSupply,
                          '0' as NonGSTSupply

                  from SaleMast, SaleDetails, PartyMaster
                  where 
                          SaleMast.CoID = SaleDetails.CoID
                  and SaleMast.WorkYear = SaleDetails.WorkYear
                  and SaleMast.BillNo = SaleDetails.BillNo

                  and PartyMaster.PartyCode = SaleMast.PartyCode
                  and PartyMaster.CoID = SaleMast.CoID
                  and PartyMaster.WorkYear = SaleMast.WorkYear

                  and SaleMast.CoID = '$CoID'
                  and SaleMast.WorkYear = '$WorkYear'
                  and SaleMast.BillDate between '$first_date' and '$last_date'

                  and PartyMaster.StateCode <> '27'
                  and SaleDetails.TaxCode = 'G0'	
                  and  PartyMaster.PartyGSTNo = ''  

          ";
   $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
}

 function getHSN($first_date,$last_date){

        $CoID = $this->session->userdata('CoID');
  $WorkYear = $this->session->userdata('WorkYear');
  
    $sql = "
                  select ItemMaster.HSNCode,
                          ItemMaster.ItemName,
                          ItemMaster.UOM, 
                          sum(SaleDetails.NetWt) as TotalQty, 
                          sum( (SaleDetails.TaxableAmt + SaleDetails.TaxAmt )) as TotalValue, 
                          sum(SaleDetails.TaxableAmt) as TaxableValue, 
                          sum(SaleDetails.IGSTAmt) as IntegratedTaxAmount, 
                          sum(SaleDetails.CGSTAmt) as CentralTaxAmount, 
                          sum(SaleDetails.SGSTAmt) as StateUTTaxAmount, 
                          '0' as Cess
                  from SaleDetails, ItemMaster
                  where
                          SaleDetails.ItemCode = ItemMaster.ItemCode
                          and SaleDetails.CoID = ItemMaster.CoID
                          and SaleDetails.WorkYear = ItemMaster.WorkYear
                          and SaleDetails.BillDate between '$first_date' and '$last_date'

                          and SaleDetails.CoID = '$CoID'
                          and SaleDetails.WorkYear = '$WorkYear'
                                  
                  group by ItemMaster.HSNCode, ItemMaster.ItemName, ItemMaster.UOM
                  order by  ItemMaster.HSNCode, ItemMaster.ItemName, ItemMaster.UOM  

          ";
   $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
}

function getDoc($first_date,$last_date){

        $CoID = $this->session->userdata('CoID');
  $WorkYear = $this->session->userdata('WorkYear');
  
    $sql = "
                  select 
                          'Invoices for outward supply' as 'NatureofDocument',
                          min(cast(SaleMast.BillNo as Integer)) as 'SrNoFrom', 
                          max(cast(SaleMast.BillNo as Integer)) as 'SrNoTo', 
                          Count(SaleMast.BillNo) as 'TotalNumber', 
                          '0' as 'Cancelled'
                  from SaleMast
                  where SaleMast.BillDate between '$first_date' and '$last_date'
                  and SaleMast.CoID = '$CoID'
                  and SaleMast.WorkYear = '$WorkYear'

          ";
   $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
}     

     // 110621
     function x1getB2BData(){
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
          $sql = "

                        select  
                                PartyMaster.PartyGSTNo as 'GSTIN', 
                                PartyMaster.PartyName, 
                                SaleMast.BillNo as BillNo, 
                                SaleMast.BillDate BDT,
                                DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as BillDate,
                                SaleMast.BillAmt,
                                PartyMaster.PartyState as PlaceOfSupply,
                                'N' ReverseCharge, 
                                '0' ApplicableTaxRate,
                                'Regular' InvoiceType, 
                                ' ' ECommerceGSTIN, 
                                SaleDetails.TaxCode, 
                                SaleDetails.TaxableAmt,       
                                '0' Cess
                                
                        from SaleMast, SaleDetails, PartyMaster
                        where 
                                SaleMast.CoID = SaleDetails.CoID
                                and SaleMast.WorkYear = SaleDetails.WorkYear
                                and SaleMast.BillNo = SaleDetails.BillNo

                                and PartyMaster.PartyCode = SaleMast.PartyCode
                                and PartyMaster.CoID = SaleMast.CoID
                                and PartyMaster.WorkYear = SaleMast.WorkYear

                                and SaleMast.CoID = '$CoID'
                                and SaleMast.WorkYear = '$WorkYear'
                                and SaleMast.BillDate between '2021-04-01' and '2021-04-30'

                                and  PartyMaster.PartyGSTNo <> ''

                        union

                        select  
                                ACMastDets.GSTNo as 'GSTIN', 
                                ACMastDets.ACTitle as PartyName, 
                                TDSonPayment.InvoiceNo as BillNo, 
                                TDSonPayment.InvoiceDate BDT,
                                DATE_FORMAT(TDSonPayment.InvoiceDate,'%d-%m-%Y') as BillDate,
                                TDSonPayment.TotalGSTAmt as BillAmt,
                                ACMastDets.StateName as PlaceOfSupply,
                                'N' ReverseCharge, 
                                '0' ApplicableTaxRate,
                                'Regular' InvoiceType, 
                                ' ' ECommerceGSTIN, 
                                TDSonPayment.TaxCode, 
                                TDSonPayment.GSTTaxableAmt as TaxableAmt, 
                                '0' Cess
                                
                        from TDSonPayment, ACMastDets
                        where 
                                TDSonPayment.CashAcc = ACMastDets.ACCode
                                and TDSonPayment.CoID = ACMastDets.CoID
                                and TDSonPayment.WorkYear = ACMastDets.WorkYear

                                and TDSonPayment.Nature = 'D'
                                and TDSonPayment.CoID = '$CoID'
                                and TDSonPayment.WorkYear = '$WorkYear'
                                and TDSonPayment.InvoiceDate between '2021-04-01' and '2021-04-30'

                                and  ACMastDets.GSTNo <> ''

                        order by Cast(BillNo As Integer) ASC

                ";
                $query = $this->db->query($sql);
                $result = $query->result();
                return $result;
      
     }

      function xgetB2BData(){

      	$CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
          $sql = "
                        select  
                                PartyMaster.PartyGSTNo as 'GSTIN', 
                                PartyMaster.PartyName, 
                                SaleMast.BillNo, 
                                DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as BillDate,
                                SaleMast.BillAmt,
                                PartyMaster.PartyState as PlaceOfSupply,
                                'N' ReverseCharge, 
                                '0' ApplicableTaxRate,
                                'Regular' InvoiceType, 
                                ' ' ECommerceGSTIN, 
                                SaleDetails.TaxCode, 
                                SaleDetails.TaxableAmt, 
                                '0' Cess
                                    
                        from SaleMast, SaleDetails, PartyMaster
                        where 
                                SaleMast.CoID = SaleDetails.CoID
                        and SaleMast.WorkYear = SaleDetails.WorkYear
                        and SaleMast.BillNo = SaleDetails.BillNo

                        and PartyMaster.PartyCode = SaleMast.PartyCode
                        and PartyMaster.CoID = SaleMast.CoID
                        and PartyMaster.WorkYear = SaleMast.WorkYear

                        and SaleMast.CoID = '$CoID'
                        and SaleMast.WorkYear = '$WorkYear'
                        and SaleMast.BillDate between '2021-04-01' and '2021-04-30'

                        and  PartyMaster.PartyGSTNo <> ''
                        order by Cast(SaleMast.BillNo As Integer) 

                ";
         $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
      }

       function xgetB2C1Data(){

      	$CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

          $sql = "
                        select  
                                SaleMast.BillNo, 
                                DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as BillDate,
                                SaleMast.BillAmt,
                                PartyMaster.PartyState,
                                '0' ApplicableTaxRate,
                                SaleDetails.TaxCode, 
                                SaleDetails.TaxableAmt, 
                                '0' Cess,
                                ' ' ECommerceGSTIN
                                        
                        from SaleMast, SaleDetails, PartyMaster
                        where 
                                SaleMast.CoID = SaleDetails.CoID
                        and SaleMast.WorkYear = SaleDetails.WorkYear
                        and SaleMast.BillNo = SaleDetails.BillNo
                        
                        and PartyMaster.PartyCode = SaleMast.PartyCode
                        and PartyMaster.CoID = SaleMast.CoID
                        and PartyMaster.WorkYear = SaleMast.WorkYear
                        
                        and SaleMast.CoID = '$CoID'
                        and SaleMast.WorkYear = '$WorkYear'

                        and SaleMast.BillDate between '2021-04-01' and '2021-04-30'

                        and  PartyMaster.PartyGSTNo = ''
                        and SaleMast.BillAmt > 250000
                        order by Cast(SaleMast.BillNo As Integer) 

                ";
         $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
      }

       function xgetB2CSData(){

      	$CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        
          $sql = "
                        select  
                                'OE' as Type, 
                                PartyMaster.PartyState as PlaceOfSupply,
                                '0' ApplicableTaxRate,
                                SaleDetails.TaxCode, 
                                sum(SaleDetails.TaxableAmt) as TaxableAmt, 
                                '0' Cess,
                                ' ' ECommerceGSTIN
                                        
                        from SaleMast, SaleDetails, PartyMaster
                        where 
                            SaleMast.CoID = SaleDetails.CoID
                        and SaleMast.WorkYear = SaleDetails.WorkYear
                        and SaleMast.BillNo = SaleDetails.BillNo

                        and PartyMaster.PartyCode = SaleMast.PartyCode
                        and PartyMaster.CoID = SaleMast.CoID
                        and PartyMaster.WorkYear = SaleMast.WorkYear

                        and SaleMast.CoID = '$CoID'
                        and SaleMast.WorkYear = '$WorkYear'
                        and SaleMast.BillDate between '2021-04-01' and '2021-04-30'

                        and  PartyMaster.PartyGSTNo = ''
                        Group By Type, PlaceOfSupply, TaxCode
                        order by PlaceOfSupply, TaxCode

                ";
         $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
      }

      function xgetGSTR1exempt(){

      	$CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        
          $sql = "
                        select  
                                'Inter-State supplies to registered persons' as Description,
                                sum(SaleMast.BillAmt) as NilRatedSupply, 
                                '0' as ExemptedOtherThanNilRatedNonGSTSupply,
                                '0' as NonGSTSupply

                        from SaleMast, SaleDetails, PartyMaster
                        where 
                                SaleMast.CoID = SaleDetails.CoID
                        and SaleMast.WorkYear = SaleDetails.WorkYear
                        and SaleMast.BillNo = SaleDetails.BillNo

                        and PartyMaster.PartyCode = SaleMast.PartyCode
                        and PartyMaster.CoID = SaleMast.CoID
                        and PartyMaster.WorkYear = SaleMast.WorkYear

                        and SaleMast.CoID = '$CoID'
                        and SaleMast.WorkYear = '$WorkYear'
                        and SaleMast.BillDate between '2021-04-01' and '2021-04-30'

                        and PartyMaster.StateCode = '27'
                        and SaleDetails.TaxCode = 'G0'
                        and  PartyMaster.PartyGSTNo <> ''

                        UNION 

                        select  
                                'Intra-State supplies to registered persons' as Description,
                                sum(SaleMast.BillAmt) as NilRatedSupply, 
                                '0' as ExemptedOtherThanNilRatedNonGSTSupply,
                                '0' as NonGSTSupply

                        from SaleMast, SaleDetails, PartyMaster
                        where 
                                SaleMast.CoID = SaleDetails.CoID
                        and SaleMast.WorkYear = SaleDetails.WorkYear
                        and SaleMast.BillNo = SaleDetails.BillNo

                        and PartyMaster.PartyCode = SaleMast.PartyCode
                        and PartyMaster.CoID = SaleMast.CoID
                        and PartyMaster.WorkYear = SaleMast.WorkYear

                        and SaleMast.CoID = '$CoID'
                        and SaleMast.WorkYear = '$WorkYear'
                        and SaleMast.BillDate between '2021-04-01' and '2021-04-30'

                        and PartyMaster.StateCode <> '27'
                        and SaleDetails.TaxCode = 'G0'	
                        and  PartyMaster.PartyGSTNo <> ''    

                        union

                        select  
                                'Inter-State supplies to unregistered persons' as Description,
                                sum(SaleMast.BillAmt) as NilRatedSupply, 
                                '0' as ExemptedOtherThanNilRatedNonGSTSupply,
                                '0' as NonGSTSupply

                        from SaleMast, SaleDetails, PartyMaster
                        where 
                                SaleMast.CoID = SaleDetails.CoID
                        and SaleMast.WorkYear = SaleDetails.WorkYear
                        and SaleMast.BillNo = SaleDetails.BillNo

                        and PartyMaster.PartyCode = SaleMast.PartyCode
                        and PartyMaster.CoID = SaleMast.CoID
                        and PartyMaster.WorkYear = SaleMast.WorkYear

                        and SaleMast.CoID = '$CoID'
                        and SaleMast.WorkYear = '$WorkYear'
                        and SaleMast.BillDate between '2021-04-01' and '2021-04-30'

                        and PartyMaster.StateCode = '27'
                        and SaleDetails.TaxCode = 'G0'
                        and  PartyMaster.PartyGSTNo = ''

                        UNION 

                        select  
                                'Intra-State supplies to unregistered persons' as Description,
                                sum(SaleMast.BillAmt) as NilRatedSupply, 
                                '0' as ExemptedOtherThanNilRatedNonGSTSupply,
                                '0' as NonGSTSupply

                        from SaleMast, SaleDetails, PartyMaster
                        where 
                                SaleMast.CoID = SaleDetails.CoID
                        and SaleMast.WorkYear = SaleDetails.WorkYear
                        and SaleMast.BillNo = SaleDetails.BillNo

                        and PartyMaster.PartyCode = SaleMast.PartyCode
                        and PartyMaster.CoID = SaleMast.CoID
                        and PartyMaster.WorkYear = SaleMast.WorkYear

                        and SaleMast.CoID = '$CoID'
                        and SaleMast.WorkYear = '$WorkYear'
                        and SaleMast.BillDate between '2021-04-01' and '2021-04-30'

                        and PartyMaster.StateCode <> '27'
                        and SaleDetails.TaxCode = 'G0'	
                        and  PartyMaster.PartyGSTNo = ''  

                ";
         $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
      }

       function xgetHSN(){

      	$CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        
          $sql = "
                        select ItemMaster.HSNCode,
                                ItemMaster.ItemName,
                                ItemMaster.UOM, 
                                sum(SaleDetails.NetWt) as TotalQty, 
                                sum( (SaleDetails.TaxableAmt + SaleDetails.TaxAmt )) as TotalValue, 
                                sum(SaleDetails.TaxableAmt) as TaxableValue, 
                                sum(SaleDetails.IGSTAmt) as IntegratedTaxAmount, 
                                sum(SaleDetails.CGSTAmt) as CentralTaxAmount, 
                                sum(SaleDetails.SGSTAmt) as StateUTTaxAmount, 
                                '0' as Cess
                        from SaleDetails, ItemMaster
                        where
                                SaleDetails.ItemCode = ItemMaster.ItemCode
                                and SaleDetails.CoID = ItemMaster.CoID
                                and SaleDetails.WorkYear = ItemMaster.WorkYear
                                and SaleDetails.BillDate between '2021-04-01' and '2021-04-30'

                                and SaleDetails.CoID = '$CoID'
                                and SaleDetails.WorkYear = '$WorkYear'
                                        
                        group by ItemMaster.HSNCode, ItemMaster.ItemName, ItemMaster.UOM
                        order by  ItemMaster.HSNCode, ItemMaster.ItemName, ItemMaster.UOM  

                ";
         $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
      }

      function xgetDoc(){

      	$CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        
          $sql = "
                        select 
                                'Invoices for outward supply' as 'NatureofDocument',
                                min(cast(SaleMast.BillNo as Integer)) as 'SrNoFrom', 
                                max(cast(SaleMast.BillNo as Integer)) as 'SrNoTo', 
                                Count(SaleMast.BillNo) as 'TotalNumber', 
                                '0' as 'Cancelled'
                        from SaleMast
                        where SaleMast.BillDate between '2021-04-01' and '2021-04-30'
                        and SaleMast.CoID = '$CoID'
                        and SaleMast.WorkYear = '$WorkYear'

                ";
         $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
      }
}