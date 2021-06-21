<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GSTReportModel extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

     function getModalData($first_date,$last_date)
     {
       $sql = "
                     SELECT 
                         SaleDetails.BillNo,
                         DATE_FORMAT(SaleDetails.BillDate,'%d-%m-%Y') as BillDate,
                         SaleDetails.NetAmt As Value,
                         TaxMaster.TaxRate As Rate, 
                         SaleDetails.TaxableAmt as TaxableValue,
                         SaleDetails.IGSTAmt as IntegratedTax,
                         SaleDetails.CGSTAmt as CentralTax,
                         SaleDetails.SGSTAmt  as StateUITax,
                         0 AS Cess,
                         PartyMaster.PartyState as PlaceOfSupplyNameOfState
                     FROM
                         SaleMast,
                         SaleDetails,
                         PartyMaster,
                         TaxMaster
                     WHERE
                         SaleMast.PartyCode = PartyMaster.PartyCode
                             AND SaleMast.CoID = PartyMaster.CoID
                             AND SaleMast.WorkYear = PartyMaster.WorkYear
                                     
                             AND SaleMast.CoID = SaleDetails.CoID
                             AND SaleMast.WorkYear = SaleDetails.WorkYear
                             AND SaleMast.BillNo = SaleDetails.BillNo
                             
                             AND SaleDetails.TaxCode = TaxMaster.TaxCode
                             AND SaleMast.BillDate Between '$first_date' and '$last_date'
                     Order By Cast(SaleMast.BillNo AS Integer)

             ";
      $query = $this->db->query($sql);
       $result = $query->result();
       return $result;
     }

     function get31($first_date,$last_date)
     {
         $sql = "

                       SELECT
                               YEAR(SaleDetails.BillDate) AS y, MONTH(SaleDetails.BillDate) AS m, 
                               SUM(SaleDetails.TaxableAmt) As TotalTaxableValue, 
                               SUM(SaleDetails.IGSTAmt) as IntegratedTax,
                               SUM(SaleDetails.CGSTAmt) as CentralTax, 
                               SUM(SaleDetails.SGSTAmt) as StateUITax,
                               0 as Cess

                       FROM
                               SaleMast,
                               SaleDetails,
                               PartyMaster,
                               ACMaster
                       WHERE
                               SaleMast.PartyCode = PartyMaster.PartyCode
                               AND SaleMast.CoID = PartyMaster.CoID
                               AND SaleMast.WorkYear = PartyMaster.WorkYear
                               AND SaleMast.CoID = ACMaster.CoID
                               AND SaleMast.WorkYear = ACMaster.WorkYear
                               AND SaleMast.BrokerID = ACMaster.ACCode
                               AND SaleMast.CoID = SaleDetails.CoID
                               AND SaleMast.WorkYear = SaleDetails.WorkYear
                               AND SaleMast.BillNo = SaleDetails.BillNo
                               AND SaleMast.BillDate Between '$first_date' and '$last_date'
               ";
        $query = $this->db->query($sql);
         $result = $query->result();
         return $result;
     }

     function get32($first_date,$last_date) //3.2 main screen
     {
         $sql = "

                       SELECT 
                           PartyMaster.PartyState as PlaceOfSupplyNameOfState,
                           sum(SaleDetails.TaxableAmt) as TaxableValue,
                           sum(SaleDetails.IGSTAmt) as IntegratedTax
                       FROM
                           SaleMast,
                           SaleDetails,
                           PartyMaster,
                           TaxMaster
                       WHERE
                           SaleMast.PartyCode = PartyMaster.PartyCode
                               AND SaleMast.CoID = PartyMaster.CoID
                               AND SaleMast.WorkYear = PartyMaster.WorkYear
                               AND PartyMaster.StateCode <> '27'
                               AND PartyMaster.PartyGSTNo = ''

                               AND SaleDetails.IGSTAmt > 0
                                       
                               AND SaleMast.CoID = SaleDetails.CoID
                               AND SaleMast.WorkYear = SaleDetails.WorkYear
                               AND SaleMast.BillNo = SaleDetails.BillNo
                               
                               AND SaleDetails.TaxCode = TaxMaster.TaxCode
                               AND SaleMast.BillDate Between '$first_date' and '$last_date'
                               Group By PartyMaster.PartyState  
               ";
        $query = $this->db->query($sql);
         $result = $query->result();
         return $result;
     }

     function getStateWise32Modal($state,$first_date,$last_date) //3.2 on tr click, Purdetails no billno col
     {

       $sql1="SELECT 
                           SaleDetails.BillNo,
                           DATE_FORMAT(SaleDetails.BillDate,'%d-%m-%Y') as BillDate,
                           SaleDetails.NetAmt As Value,
                           TaxMaster.TaxRate As Rate, 
                           SaleDetails.TaxableAmt as TaxableValue,
                           SaleDetails.IGSTAmt as IntegratedTax,
                           SaleDetails.CGSTAmt as CentralTax,
                           SaleDetails.SGSTAmt as StateUITax,
                           0 as Cess,
                           PartyMaster.PartyState as PlaceOfSupplyNameOfState
                       FROM
                           SaleMast,
                           SaleDetails,
                           PartyMaster,
                           TaxMaster
                       WHERE
                               PartyMaster.PartyState = '$state'
                               AND SaleMast.PartyCode = PartyMaster.PartyCode
                               AND SaleMast.CoID = PartyMaster.CoID
                               AND SaleMast.WorkYear = PartyMaster.WorkYear
                               AND PartyMaster.StateCode <> '27'
                               AND SaleDetails.IGSTAmt > 0
                                       
                               AND SaleMast.CoID = SaleDetails.CoID
                               AND SaleMast.WorkYear = SaleDetails.WorkYear
                               AND SaleMast.BillNo = SaleDetails.BillNo
                               
                               AND SaleDetails.TaxCode = TaxMaster.TaxCode
                               AND SaleMast.BillDate Between '$first_date' and '$last_date'";
       $query1 = $this->db->query($sql1);
       $result1 = $query1->result();
               
       //$resultFinal = $result1 + $result2;
       return $result1;
         
     }

     function getFourMainData($first_date,$last_date)
     {
       $sql2 = "
                   SELECT 
                       sum(PurDetails.IGSTAmt) as IntegratedTax,
                       sum(PurDetails.CGSTAmt) as CentralTax,
                       sum(PurDetails.SGSTAmt)  as StateUITax,
                       0 AS Cess,
                       ACMastDets.StateName as PlaceOfSupplyNameOfState
                   FROM
                       PurDetails,
                       ACMastDets
                   WHERE
                           PurDetails.PartyCode = ACMastDets.ACCode
                           AND PurDetails.CoID = ACMastDets.CoID
                           AND PurDetails.WorkYear = ACMastDets.WorkYear         
                           AND PurDetails.TaxRate > 0
                           AND PurDetails.GoodsRcptDate Between '$first_date' and '$last_date'
               ";

       $query2 = $this->db->query($sql2);
       $result2 = $query2->result();
       return $result2;
     }

     function getFourData($first_date,$last_date)
     {
       $sql2 = "
                   SELECT 
                       PurDetails.IDNumber,
                       DATE_FORMAT(PurDetails.GoodsRcptDate,'%d-%m-%Y') as BillDate,
                       '' as BillNo,
                       PurDetails.GrossAmount As Value,
                       PurDetails.TaxRate As Rate, 
                       PurDetails.TaxableAmt as TaxableValue,
                       PurDetails.IGSTAmt as IntegratedTax,
                       PurDetails.CGSTAmt as CentralTax,
                       PurDetails.SGSTAmt  as StateUITax,
                       0 AS Cess,
                       ACMastDets.StateName as PlaceOfSupplyNameOfState
                   FROM
                       PurDetails,
                       ACMastDets
                   WHERE
                           PurDetails.PartyCode = ACMastDets.ACCode
                           AND PurDetails.CoID = ACMastDets.CoID
                           AND PurDetails.WorkYear = ACMastDets.WorkYear         
                           AND PurDetails.TaxRate > 0
                           AND PurDetails.GoodsRcptDate Between '$first_date' and '$last_date'
               ";

       $query2 = $this->db->query($sql2);
       $result2 = $query2->result();
       return $result2;
     }

     function getFiveMainData($first_date,$last_date)
     {

       $CoID = $this->session->userdata('CoID');
       $WorkYear = $this->session->userdata('WorkYear');
       $sql2 = "
                   Select 
                           (
                               select
                                   sum(PurDetails.TaxableAmt + PurDetails.TaxCharges) 
                               FROM
                                   PurDetails, ACMastDets
                               WHERE
                                       PurDetails.TaxRate = 0
                               and ACMastDets.StateCode = 27

                               and PurDetails.GoodsRcptDate between '$first_date' and '$last_date'
                               and PurDetails.CoID = '$CoID'
                               and PurDetails.WorkYear = '$WorkYear'
                               
                               and PurDetails.PartyCode = ACMastDets.ACCode
                               and PurDetails.CoID = ACMastDets.CoID
                               and PurDetails.WorkYear = ACMastDets.WorkYear
                           ) as 'InterStateSupply', 
                           (
                               select
                                   sum(PurDetails.TaxableAmt + PurDetails.TaxCharges) 
                               FROM
                                   PurDetails, ACMastDets
                               WHERE
                                       PurDetails.TaxRate = 0
                               and ACMastDets.StateCode <> 27

                               and PurDetails.GoodsRcptDate between '$first_date' and '$last_date'
                               and PurDetails.CoID = '$CoID'
                               and PurDetails.WorkYear = '$WorkYear'
                               
                               and PurDetails.PartyCode = ACMastDets.ACCode
                               and PurDetails.CoID = ACMastDets.CoID
                               and PurDetails.WorkYear = ACMastDets.WorkYear) as 'IntraStateSupply'
                   from DUAL 

               ";


               $query = $this->db->query($sql2);
               $result = $query->result();
               return $result;
     }

     function getFiveData($first_date,$last_date)
     {

       $CoID = $this->session->userdata('CoID');
       $WorkYear = $this->session->userdata('WorkYear');
       $sql2 = "
                    SELECT 
                       PurDetails.IDNumber,
                       DATE_FORMAT(PurDetails.GoodsRcptDate,'%d-%m-%Y') as BillDate,
                       PurDetails.GrossAmount As Value,
                       PurDetails.TaxRate As Rate, 
                       PurDetails.TaxableAmt as TaxableValue,
                       PurDetails.IGSTAmt as IntegratedTax,
                       PurDetails.CGSTAmt as CentralTax,
                       PurDetails.SGSTAmt  as StateUITax,
                       0 AS Cess,
                       ACMastDets.StateName as PlaceOfSupplyNameOfState
                   FROM
                       PurDetails,
                       ACMastDets
                   WHERE
                       PurDetails.PartyCode = ACMastDets.ACCode
                       and PurDetails.GoodsRcptDate between '$first_date' and '$last_date'
                           AND PurDetails.CoID = ACMastDets.CoID
                           AND PurDetails.WorkYear = ACMastDets.WorkYear         
                           AND PurDetails.TaxRate = 0

               ";


               $query = $this->db->query($sql2);
               $result = $query->result();
               return $result;
     }

     function getSix1Data($first_date,$last_date)
     {

       $CoID = $this->session->userdata('CoID');
       $WorkYear = $this->session->userdata('WorkYear');
       $sql2 = "
                    SELECT
                               'Integrated Tax' as Description,
                               (
                                   SELECT
                                           SUM(SaleDetails.IGSTAmt) 
                                   FROM
                                           SaleMast,
                                           SaleDetails,
                                           PartyMaster,
                                           ACMaster
                                   WHERE
                                           SaleMast.PartyCode = PartyMaster.PartyCode
                                           AND SaleMast.CoID = PartyMaster.CoID
                                           AND SaleMast.WorkYear = PartyMaster.WorkYear
                                           AND SaleMast.CoID = ACMaster.CoID
                                           AND SaleMast.WorkYear = ACMaster.WorkYear
                                           AND SaleMast.BrokerID = ACMaster.ACCode
                                           AND SaleMast.CoID = SaleDetails.CoID
                                           AND SaleMast.WorkYear = SaleDetails.WorkYear
                                           AND SaleMast.BillNo = SaleDetails.BillNo            
                                           AND SaleMast.BillDate between '$first_date' and '$last_date'
                                           and SaleMast.CoID = '$CoID'
                                           and SaleMast.WorkYear = '$WorkYear'
           
                               ) as TaxPayable, 
                               (
                                   SELECT 
                                       sum(PurDetails.IGSTAmt) 
                                   FROM
                                       PurDetails,
                                       ACMastDets
                                   WHERE
                                       PurDetails.PartyCode = ACMastDets.ACCode
                                           AND PurDetails.CoID = ACMastDets.CoID
                                           AND PurDetails.WorkYear = ACMastDets.WorkYear         
                                           AND PurDetails.TaxRate > 0
                                           AND PurDetails.GoodsRcptDate between '$first_date' and '$last_date'
                                           and PurDetails.CoID = '$CoID'
                                           and PurDetails.WorkYear = '$WorkYear'
                                           ) as 'PaidThroughITC_IGST', 
                               '0' as 'PaidThroughITC_CGST',
                               '0' as 'PaidThroughITC_SGST'
                       from DUAL

                       UNION 

                       SELECT
                               'Central Tax' as Description,
                               (
                                   SELECT
                                           SUM(SaleDetails.CGSTAmt) 
                                   FROM
                                           SaleMast,
                                           SaleDetails,
                                           PartyMaster,
                                           ACMaster
                                   WHERE
                                           SaleMast.PartyCode = PartyMaster.PartyCode
                                           AND SaleMast.CoID = PartyMaster.CoID
                                           AND SaleMast.WorkYear = PartyMaster.WorkYear
                                           AND SaleMast.CoID = ACMaster.CoID
                                           AND SaleMast.WorkYear = ACMaster.WorkYear
                                           AND SaleMast.BrokerID = ACMaster.ACCode
                                           AND SaleMast.CoID = SaleDetails.CoID
                                           AND SaleMast.WorkYear = SaleDetails.WorkYear
                                           AND SaleMast.BillNo = SaleDetails.BillNo            
                                           AND SaleMast.BillDate between '$first_date' and '$last_date'
                                           and SaleMast.CoID = '$CoID'
                                           and SaleMast.WorkYear = '$WorkYear'            
                               ) as TaxPayable, 
                               '0' as 'PaidThroughITC_IGST', 
                               (
                                   SELECT 
                                       sum(PurDetails.CGSTAmt) 
                                   FROM
                                       PurDetails,
                                       ACMastDets
                                   WHERE
                                       PurDetails.PartyCode = ACMastDets.ACCode
                                           AND PurDetails.CoID = ACMastDets.CoID
                                           AND PurDetails.WorkYear = ACMastDets.WorkYear         
                                           AND PurDetails.TaxRate > 0
                                           AND PurDetails.GoodsRcptDate between '$first_date' and '$last_date'
                                           and PurDetails.CoID = '$CoID'
                                           and PurDetails.WorkYear = '$WorkYear'
                                           ) as 'PaidThroughITC_CGST',
                               '0' as 'PaidThroughITC_SGST'
                       from DUAL

                       UNION 

                       SELECT
                               'State/UT Tax' as Description,
                               (
                                   SELECT
                                           SUM(SaleDetails.SGSTAmt)
                                   FROM
                                           SaleMast,
                                           SaleDetails,
                                           PartyMaster,
                                           ACMaster
                                   WHERE
                                           SaleMast.PartyCode = PartyMaster.PartyCode
                                           AND SaleMast.CoID = PartyMaster.CoID
                                           AND SaleMast.WorkYear = PartyMaster.WorkYear
                                           AND SaleMast.CoID = ACMaster.CoID
                                           AND SaleMast.WorkYear = ACMaster.WorkYear
                                           AND SaleMast.BrokerID = ACMaster.ACCode
                                           AND SaleMast.CoID = SaleDetails.CoID
                                           AND SaleMast.WorkYear = SaleDetails.WorkYear
                                           AND SaleMast.BillNo = SaleDetails.BillNo            
                                           AND SaleMast.BillDate between '$first_date' and '$last_date'
                                           and SaleMast.CoID = '$CoID'
                                           and SaleMast.WorkYear = '$WorkYear'
                                           ) as TaxPayable, 
                               '0' as 'PaidThroughITC_IGST', 
                               '0' as 'PaidThroughITC_CGST', 
                               (
                                   SELECT 
                                       sum(PurDetails.SGSTAmt) 
                                   FROM
                                       PurDetails,
                                       ACMastDets
                                   WHERE
                                       PurDetails.PartyCode = ACMastDets.ACCode
                                           AND PurDetails.CoID = ACMastDets.CoID
                                           AND PurDetails.WorkYear = ACMastDets.WorkYear         
                                           AND PurDetails.TaxRate > 0
                                           AND PurDetails.GoodsRcptDate between '$first_date' and '$last_date'
                                           and PurDetails.CoID = '$CoID'
                                           and PurDetails.WorkYear = '$WorkYear'
                                           ) as 'PaidThroughITC_SGST'
                       from DUAL

               ";


               $query = $this->db->query($sql2);
               $result = $query->result();
               return $result;
     }

     // 110621
    function xgetModalData()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

          $sql = "
                        SELECT 
                            SaleDetails.BillNo as BillNo,
                            DATE_FORMAT(SaleMast.BillDate,'%d-%m-%Y') as BillDate,
                            SaleMast.BillAmt As Value,
                            TaxMaster.TaxRate As Rate, 
                            SaleDetails.TaxableAmt as TaxableValue,
                            SaleDetails.IGSTAmt as IntegratedTax,
                            SaleDetails.CGSTAmt as CentralTax,
                            SaleDetails.SGSTAmt  as StateUITax,
                            0 AS Cess,
                            PartyMaster.PartyState as PlaceOfSupplyNameOfState
                        FROM
                            SaleMast,
                            SaleDetails,
                            PartyMaster,
                            TaxMaster
                        WHERE
                            SaleMast.PartyCode = PartyMaster.PartyCode
                                AND SaleMast.CoID = PartyMaster.CoID
                                AND SaleMast.WorkYear = PartyMaster.WorkYear
                                        
                                AND SaleMast.CoID = SaleDetails.CoID
                                AND SaleMast.WorkYear = SaleDetails.WorkYear
                                AND SaleMast.BillNo = SaleDetails.BillNo
                                
                                AND SaleDetails.TaxCode = TaxMaster.TaxCode
                                and SaleDetails.CoID = '$CoID'
                                and SaleDetails.WorkYear = '$WorkYear'
    
                                AND SaleMast.BillDate Between '2021-04-01' and '2021-04-30'

                        UNION 

                        SELECT 
                                TDSonPayment.InvoiceNo as BillNo,
                                DATE_FORMAT(TDSonPayment.InvoiceDate,'%d-%m-%Y') as BillDate,
                                TDSonPayment.TotalGSTAmt As Value,
                                TaxMaster.TaxRate As Rate, 
                                TDSonPayment.GSTTaxableAmt as TaxableValue,
                                TDSonPayment.IGSTAmt as IntegratedTax,
                                TDSonPayment.CGSTAmt as CentralTax,
                                TDSonPayment.SGSTAmt  as StateUITax,
                                0 AS Cess,
                                ACMastDets.StateName as PlaceOfSupplyNameOfState                                 
                        FROM TDSonPayment,
                            ACMastDets,
                            TaxMaster

                        where                            
                            TDSonPayment.CashAcc = ACMastDets.ACCode
                            AND TDSonPayment.CoID = ACMastDets.CoID
                            AND TDSonPayment.WorkYear = ACMastDets.WorkYear
                                    
                            AND TDSonPayment.TaxCode = TaxMaster.TaxCode

                            and TDSonPayment.CoID = '$CoID'
                            and TDSonPayment.WorkYear = '$WorkYear'
                            and TDSonPayment.Nature = 'D'  
                            and TDSonPayment.InvoiceDate between '2021-04-01' and '2021-04-30'
                            


                        Order By BillDate ASC, Cast(BillNo AS Integer) ASC

                ";
         $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }

    function x1get31()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

          $sql = "
                    select 
                            (
                                SELECT
                                        SUM(SaleDetails.TaxableAmt) 

                                FROM
                                        SaleMast,
                                        SaleDetails
                                WHERE
                                        SaleMast.CoID = '$CoID'
                                        and SaleMast.WorkYear = '$WorkYear'

                                        AND SaleMast.CoID = SaleDetails.CoID
                                        AND SaleMast.WorkYear = SaleDetails.WorkYear
                                        AND SaleMast.BillNo = SaleDetails.BillNo
                                        
                                        AND SaleMast.BillDate Between '2021-04-01' and '2021-04-30'
                            )
                            +
                            (
                                SELECT 
                                        SUM(TDSonPayment.GSTTaxableAmt) 
                                FROM TDSonPayment
                                where
                                        TDSonPayment.CoID = '$CoID'
                                        and TDSonPayment.WorkYear = '$WorkYear'
                                        and TDSonPayment.Nature = 'D'  
                                        and TDSonPayment.InvoiceDate between '2021-04-01' and '2021-04-30'
                            ) As TotalTaxableValue, 
                            (
                                SELECT
                                        SUM(SaleDetails.IGSTAmt) 

                                FROM
                                        SaleMast,
                                        SaleDetails
                                WHERE
                                        SaleMast.CoID = '$CoID'
                                        and SaleMast.WorkYear = '$WorkYear'

                                        AND SaleMast.CoID = SaleDetails.CoID
                                        AND SaleMast.WorkYear = SaleDetails.WorkYear
                                        AND SaleMast.BillNo = SaleDetails.BillNo
                                        
                                        AND SaleMast.BillDate Between '2021-04-01' and '2021-04-30'
                            )
                            +
                            (
                                SELECT 
                                        SUM(TDSonPayment.IGSTAmt) 
                                FROM TDSonPayment
                                where
                                        TDSonPayment.CoID = '$CoID'
                                        and TDSonPayment.WorkYear = '$WorkYear'
                                        and TDSonPayment.Nature = 'D'  
                                        and TDSonPayment.InvoiceDate between '2021-04-01' and '2021-04-30'
                            )  as IntegratedTax, 
                            (
                                SELECT
                                        SUM(SaleDetails.CGSTAmt) 

                                FROM
                                        SaleMast,
                                        SaleDetails
                                WHERE
                                        SaleMast.CoID = '$CoID'
                                        and SaleMast.WorkYear = '$WorkYear'

                                        AND SaleMast.CoID = SaleDetails.CoID
                                        AND SaleMast.WorkYear = SaleDetails.WorkYear
                                        AND SaleMast.BillNo = SaleDetails.BillNo
                                        
                                        AND SaleMast.BillDate Between '2021-04-01' and '2021-04-30'
                            )
                            +
                            (
                                SELECT 
                                        SUM(TDSonPayment.CGSTAmt) 
                                FROM TDSonPayment
                                where
                                        TDSonPayment.CoID = '$CoID'
                                        and TDSonPayment.WorkYear = '$WorkYear'
                                        and TDSonPayment.Nature = 'D'  
                                        and TDSonPayment.InvoiceDate between '2021-04-01' and '2021-04-30'
                            )  as CentralTax, 
                            (
                                SELECT
                                        SUM(SaleDetails.SGSTAmt) 

                                FROM
                                        SaleMast,
                                        SaleDetails
                                WHERE
                                        SaleMast.CoID = '$CoID'
                                        and SaleMast.WorkYear = '$WorkYear'

                                        AND SaleMast.CoID = SaleDetails.CoID
                                        AND SaleMast.WorkYear = SaleDetails.WorkYear
                                        AND SaleMast.BillNo = SaleDetails.BillNo
                                        
                                        AND SaleMast.BillDate Between '2021-04-01' and '2021-04-30'
                            )
                            +
                            (
                                SELECT 
                                        SUM(TDSonPayment.SGSTAmt) 
                                FROM TDSonPayment
                                where
                                        TDSonPayment.CoID = '$CoID'
                                        and TDSonPayment.WorkYear = '$WorkYear'
                                        and TDSonPayment.Nature = 'D'  
                                        and TDSonPayment.InvoiceDate between '2021-04-01' and '2021-04-30'
                            )  as StateUITax, 
                            0 as Cess

                    FROM DUAL 
                                
                ";

         $query = $this->db->query($sql);
          $result = $query->result();
          return $result;

    }

      function xget31()
      {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

          $sql = "
                       
                        SELECT
                                YEAR(SaleDetails.BillDate) AS y, MONTH(SaleDetails.BillDate) AS m, 
                                SUM(SaleDetails.TaxableAmt) As TotalTaxableValue, 
                                SUM(SaleDetails.IGSTAmt) as IntegratedTax,
                                SUM(SaleDetails.CGSTAmt) as CentralTax, 
                                SUM(SaleDetails.SGSTAmt) as StateUITax,
                                0 as Cess

                        FROM
                                SaleMast,
                                SaleDetails,
                                PartyMaster,
                                ACMaster
                        WHERE
                                SaleMast.CoID = '$CoID'
                                and SaleMast.WorkYear = '$WorkYear'

                                AND SaleMast.PartyCode = PartyMaster.PartyCode
                                AND SaleMast.CoID = PartyMaster.CoID
                                AND SaleMast.WorkYear = PartyMaster.WorkYear

                                AND SaleMast.CoID = ACMaster.CoID
                                AND SaleMast.WorkYear = ACMaster.WorkYear
                                AND SaleMast.BrokerID = ACMaster.ACCode

                                AND SaleMast.CoID = SaleDetails.CoID
                                AND SaleMast.WorkYear = SaleDetails.WorkYear
                                AND SaleMast.BillNo = SaleDetails.BillNo
                                
                                AND SaleMast.BillDate Between '2021-04-01' and '2021-04-30'


                        union 

                        SELECT 
                                YEAR(TDSonPayment.InvoiceDate) AS y, MONTH(TDSonPayment.InvoiceDate) AS m, 
                                SUM(TDSonPayment.GSTTaxableAmt) As TotalTaxableValue, 
                                SUM(TDSonPayment.IGSTAmt) as IntegratedTax,
                                SUM(TDSonPayment.CGSTAmt) as CentralTax, 
                                SUM(TDSonPayment.SGSTAmt) as StateUITax,
                                0 as Cess

                        FROM TDSonPayment
                        where
                                TDSonPayment.CoID = '$CoID'
                                and TDSonPayment.WorkYear = '$WorkYear'
                                and TDSonPayment.Nature = 'D'  
                                and TDSonPayment.InvoiceDate between '2021-04-01' and '2021-04-30'
                                
                ";

         $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
      }

        //3.2 main screen
        function xget32() 
        {
          $sql = "

                        SELECT 
                            PartyMaster.PartyState as PlaceOfSupplyNameOfState,
                            sum(SaleDetails.TaxableAmt) as TaxableValue,
                            sum(SaleDetails.IGSTAmt) as IntegratedTax
                        FROM
                            SaleMast,
                            SaleDetails,
                            PartyMaster,
                            TaxMaster
                        WHERE
                            SaleMast.PartyCode = PartyMaster.PartyCode
                                AND SaleMast.CoID = PartyMaster.CoID
                                AND SaleMast.WorkYear = PartyMaster.WorkYear
                                AND PartyMaster.StateCode <> '27'
                                AND PartyMaster.PartyGSTNo = ''

                                AND SaleDetails.IGSTAmt > 0
                                        
                                AND SaleMast.CoID = SaleDetails.CoID
                                AND SaleMast.WorkYear = SaleDetails.WorkYear
                                AND SaleMast.BillNo = SaleDetails.BillNo
                                
                                AND SaleDetails.TaxCode = TaxMaster.TaxCode
                                AND SaleMast.BillDate Between '2021-04-01' and '2021-04-30'
                                Group By PartyMaster.PartyState  

                ";
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }

        //3.2 on tr click, Purdetails no billno col
        function xgetStateWise32Modal($state) 
        {
                $sql1="
                        SELECT 
                            SaleDetails.BillNo,
                            DATE_FORMAT(SaleDetails.BillDate,'%d-%m-%Y') as BillDate,
                            SaleDetails.NetAmt As Value,
                            TaxMaster.TaxRate As Rate, 
                            SaleDetails.TaxableAmt as TaxableValue,
                            SaleDetails.IGSTAmt as IntegratedTax,
                            SaleDetails.CGSTAmt as CentralTax,
                            SaleDetails.SGSTAmt as StateUITax,
                            0 as Cess,
                            PartyMaster.PartyState as PlaceOfSupplyNameOfState
                        FROM
                            SaleMast,
                            SaleDetails,
                            PartyMaster,
                            TaxMaster
                        WHERE
                                PartyMaster.PartyState = '$state'
                                AND SaleMast.PartyCode = PartyMaster.PartyCode
                                AND SaleMast.CoID = PartyMaster.CoID
                                AND SaleMast.WorkYear = PartyMaster.WorkYear
                                AND PartyMaster.StateCode <> '27'
                                AND SaleDetails.IGSTAmt > 0
                                        
                                AND SaleMast.CoID = SaleDetails.CoID
                                AND SaleMast.WorkYear = SaleDetails.WorkYear
                                AND SaleMast.BillNo = SaleDetails.BillNo
                                
                                AND SaleDetails.TaxCode = TaxMaster.TaxCode
                                AND SaleMast.BillDate Between '2021-04-01' and '2021-04-30'
                                
                ";
                $query1 = $this->db->query($sql1);
                $result1 = $query1->result();
                        
                //$resultFinal = $result1 + $result2;
                return $result1;
          
        }

        function x1getFourMainData()
        {
            $CoID = $this->session->userdata('CoID');
            $WorkYear = $this->session->userdata('WorkYear');
    
            $sql2 = "
                        select       
                            (
                                SELECT 
                                    sum(PurDetails.IGSTAmt) as IntegratedTax
                                FROM
                                    PurDetails
                                WHERE
                                        PurDetails.TaxRate > 0
                                        AND PurDetails.GoodsRcptDate Between '2021-04-01' and '2021-04-30'
                            )
                            +
                            (
                                SELECT 
                                    sum(TDSonPayment.IGSTAmt) as IntegratedTax
                                FROM
                                    TDSonPayment
                                WHERE                            
                                        TDSonPayment.Nature = 'C'
                                        AND TDSonPayment.TaxCode <> ''
                                        AND TDSonPayment.InvoiceDate Between '2021-04-01' and '2021-04-30'                        
                            ) as IntegratedTax, 

                            (
                                SELECT 
                                    sum(PurDetails.CGSTAmt)
                                FROM
                                    PurDetails
                                WHERE
                                        PurDetails.TaxRate > 0
                                        AND PurDetails.GoodsRcptDate Between '2021-04-01' and '2021-04-30'
                            )
                            +
                            (
                                SELECT 
                                    sum(TDSonPayment.CGSTAmt)
                                FROM
                                    TDSonPayment
                                WHERE                            
                                        TDSonPayment.Nature = 'C'
                                        AND TDSonPayment.TaxCode <> ''
                                        AND TDSonPayment.InvoiceDate Between '2021-04-01' and '2021-04-30'                        
                            ) as CentralTax, 

                            (
                                SELECT 
                                    sum(PurDetails.SGSTAmt)
                                FROM
                                    PurDetails
                                WHERE
                                        PurDetails.TaxRate > 0
                                        AND PurDetails.GoodsRcptDate Between '2021-04-01' and '2021-04-30'
                            )
                            +
                            (
                                SELECT 
                                    sum(TDSonPayment.SGSTAmt)
                                FROM
                                    TDSonPayment
                                WHERE                            
                                        TDSonPayment.Nature = 'C'
                                        AND TDSonPayment.TaxCode <> ''
                                        AND TDSonPayment.InvoiceDate Between '2021-04-01' and '2021-04-30'                        
                            ) as StateUITax, 
                            0.00 as Cess
                        from dual
                ";

                $query2 = $this->db->query($sql2);
                $result2 = $query2->result();
                return $result2;
        }

        function xgetFourMainData()
        {
            $sql2 = "
                    SELECT 
                        sum(PurDetails.IGSTAmt) as IntegratedTax,
                        sum(PurDetails.CGSTAmt) as CentralTax,
                        sum(PurDetails.SGSTAmt)  as StateUITax,
                        0 AS Cess,
                        ACMastDets.StateName as PlaceOfSupplyNameOfState
                    FROM
                        PurDetails,
                        ACMastDets
                    WHERE
                            PurDetails.PartyCode = ACMastDets.ACCode
                            AND PurDetails.CoID = ACMastDets.CoID
                            AND PurDetails.WorkYear = ACMastDets.WorkYear         
                            AND PurDetails.TaxRate > 0
                            AND PurDetails.GoodsRcptDate Between '2021-04-01' and '2021-04-30'
                            
                ";

                $query2 = $this->db->query($sql2);
                $result2 = $query2->result();
                return $result2;
        }

        function xgetFourData()
        {
                $sql2 = "
                    SELECT 
                        PurDetails.IDNumber,
                        DATE_FORMAT(PurDetails.GoodsRcptDate,'%d-%m-%Y') as BillDate,
                        '' as BillNo,
                        PurDetails.GrossAmount As Value,
                        PurDetails.TaxRate As Rate, 
                        PurDetails.TaxableAmt as TaxableValue,
                        PurDetails.IGSTAmt as IntegratedTax,
                        PurDetails.CGSTAmt as CentralTax,
                        PurDetails.SGSTAmt  as StateUITax,
                        0 AS Cess,
                        ACMastDets.StateName as PlaceOfSupplyNameOfState
                    FROM
                        PurDetails,
                        ACMastDets
                    WHERE
                            PurDetails.PartyCode = ACMastDets.ACCode
                            AND PurDetails.CoID = ACMastDets.CoID
                            AND PurDetails.WorkYear = ACMastDets.WorkYear         
                            AND PurDetails.TaxRate > 0
                            AND PurDetails.GoodsRcptDate Between '2021-04-01' and '2021-04-30'

                ";

                $query2 = $this->db->query($sql2);
                $result2 = $query2->result();
                return $result2;
        }

        function xgetFiveMainData()
        {
  
            $CoID = $this->session->userdata('CoID');
            $WorkYear = $this->session->userdata('WorkYear');
            $sql2 = "
                      Select 
                              (
                                  select
                                      sum(PurDetails.TaxableAmt + PurDetails.TaxCharges) 
                                  FROM
                                      PurDetails, ACMastDets
                                  WHERE
                                          PurDetails.TaxRate = 0
                                  and ACMastDets.StateCode = 27
  
                                  and PurDetails.GoodsRcptDate between '2021-04-01' and '2021-04-30'
                                  and PurDetails.CoID = '$CoID'
                                  and PurDetails.WorkYear = '$WorkYear'
                                  
                                  and PurDetails.PartyCode = ACMastDets.ACCode
                                  and PurDetails.CoID = ACMastDets.CoID
                                  and PurDetails.WorkYear = ACMastDets.WorkYear
                              ) as 'InterStateSupply', 
                              (
                                  select
                                      sum(PurDetails.TaxableAmt + PurDetails.TaxCharges) 
                                  FROM
                                      PurDetails, ACMastDets
                                  WHERE
                                          PurDetails.TaxRate = 0
                                  and ACMastDets.StateCode <> 27
  
                                  and PurDetails.GoodsRcptDate between '2021-04-01' and '2021-04-30'
                                  and PurDetails.CoID = '$CoID'
                                  and PurDetails.WorkYear = '$WorkYear'
                                  
                                  and PurDetails.PartyCode = ACMastDets.ACCode
                                  and PurDetails.CoID = ACMastDets.CoID
                                  and PurDetails.WorkYear = ACMastDets.WorkYear) as 'IntraStateSupply'
                      from DUAL 
  
                  ";
  
  
                  $query = $this->db->query($sql2);
                  $result = $query->result();
                  return $result;
        }

        function xgetFiveData()
        {
  
                $CoID = $this->session->userdata('CoID');
                $WorkYear = $this->session->userdata('WorkYear');
  
                $sql2 = "
                    SELECT 
                        PurDetails.IDNumber,
                        DATE_FORMAT(PurDetails.GoodsRcptDate,'%d-%m-%Y') as BillDate,
                        '' as BillNo,
                        PurDetails.GrossAmount As Value,
                        PurDetails.TaxRate As Rate, 
                        PurDetails.TaxableAmt as TaxableValue,
                        PurDetails.IGSTAmt as IntegratedTax,
                        PurDetails.CGSTAmt as CentralTax,
                        PurDetails.SGSTAmt  as StateUITax,
                        0 AS Cess,
                        ACMastDets.StateName as PlaceOfSupplyNameOfState
                    FROM
                        PurDetails,
                        ACMastDets
                    WHERE
                            PurDetails.PartyCode = ACMastDets.ACCode
                            AND PurDetails.CoID = ACMastDets.CoID
                            AND PurDetails.WorkYear = ACMastDets.WorkYear         
                            AND PurDetails.TaxRate = 0
                            AND PurDetails.GoodsRcptDate Between '2021-04-01' and '2021-04-30'
                            and PurDetails.CoID = '$CoID'
                            and PurDetails.WorkYear = '$WorkYear'

                ";

                $query2 = $this->db->query($sql2);
                $result2 = $query2->result();
                return $result2;

        }

        function xgetSix1Data()
        {
  
          $CoID = $this->session->userdata('CoID');
          $WorkYear = $this->session->userdata('WorkYear');
          $sql2 = "
                       SELECT
                                  'Integrated Tax' as Description,
                                  (
                                      SELECT
                                              SUM(SaleDetails.IGSTAmt) 
                                      FROM
                                              SaleMast,
                                              SaleDetails,
                                              PartyMaster,
                                              ACMaster
                                      WHERE
                                              SaleMast.PartyCode = PartyMaster.PartyCode
                                              AND SaleMast.CoID = PartyMaster.CoID
                                              AND SaleMast.WorkYear = PartyMaster.WorkYear
                                              AND SaleMast.CoID = ACMaster.CoID
                                              AND SaleMast.WorkYear = ACMaster.WorkYear
                                              AND SaleMast.BrokerID = ACMaster.ACCode
                                              AND SaleMast.CoID = SaleDetails.CoID
                                              AND SaleMast.WorkYear = SaleDetails.WorkYear
                                              AND SaleMast.BillNo = SaleDetails.BillNo            
                                              AND SaleMast.BillDate between '2021-04-01' and '2021-04-30'
                                              and SaleMast.CoID = '$CoID'
                                              and SaleMast.WorkYear = '$WorkYear'
              
                                  ) as TaxPayable, 
                                  (
                                      SELECT 
                                          sum(PurDetails.IGSTAmt) 
                                      FROM
                                          PurDetails,
                                          ACMastDets
                                      WHERE
                                          PurDetails.PartyCode = ACMastDets.ACCode
                                              AND PurDetails.CoID = ACMastDets.CoID
                                              AND PurDetails.WorkYear = ACMastDets.WorkYear         
                                              AND PurDetails.TaxRate > 0
                                              AND PurDetails.GoodsRcptDate between '2021-04-01' and '2021-04-30'
                                              and PurDetails.CoID = '$CoID'
                                              and PurDetails.WorkYear = '$WorkYear'
                                              ) as 'PaidThroughITC_IGST', 
                                  '0' as 'PaidThroughITC_CGST',
                                  '0' as 'PaidThroughITC_SGST'
                          from DUAL
  
                          UNION 
  
                          SELECT
                                  'Central Tax' as Description,
                                  (
                                      SELECT
                                              SUM(SaleDetails.CGSTAmt) 
                                      FROM
                                              SaleMast,
                                              SaleDetails,
                                              PartyMaster,
                                              ACMaster
                                      WHERE
                                              SaleMast.PartyCode = PartyMaster.PartyCode
                                              AND SaleMast.CoID = PartyMaster.CoID
                                              AND SaleMast.WorkYear = PartyMaster.WorkYear
                                              AND SaleMast.CoID = ACMaster.CoID
                                              AND SaleMast.WorkYear = ACMaster.WorkYear
                                              AND SaleMast.BrokerID = ACMaster.ACCode
                                              AND SaleMast.CoID = SaleDetails.CoID
                                              AND SaleMast.WorkYear = SaleDetails.WorkYear
                                              AND SaleMast.BillNo = SaleDetails.BillNo            
                                              AND SaleMast.BillDate between '2021-04-01' and '2021-04-30'
                                              and SaleMast.CoID = '$CoID'
                                              and SaleMast.WorkYear = '$WorkYear'            
                                  ) as TaxPayable, 
                                  '0' as 'PaidThroughITC_IGST', 
                                  (
                                      SELECT 
                                          sum(PurDetails.CGSTAmt) 
                                      FROM
                                          PurDetails,
                                          ACMastDets
                                      WHERE
                                          PurDetails.PartyCode = ACMastDets.ACCode
                                              AND PurDetails.CoID = ACMastDets.CoID
                                              AND PurDetails.WorkYear = ACMastDets.WorkYear         
                                              AND PurDetails.TaxRate > 0
                                              AND PurDetails.GoodsRcptDate between '2021-04-01' and '2021-04-30'
                                              and PurDetails.CoID = '$CoID'
                                              and PurDetails.WorkYear = '$WorkYear'
                                              ) as 'PaidThroughITC_CGST',
                                  '0' as 'PaidThroughITC_SGST'
                          from DUAL
  
                          UNION 
  
                          SELECT
                                  'State/UT Tax' as Description,
                                  (
                                      SELECT
                                              SUM(SaleDetails.SGSTAmt)
                                      FROM
                                              SaleMast,
                                              SaleDetails,
                                              PartyMaster,
                                              ACMaster
                                      WHERE
                                              SaleMast.PartyCode = PartyMaster.PartyCode
                                              AND SaleMast.CoID = PartyMaster.CoID
                                              AND SaleMast.WorkYear = PartyMaster.WorkYear
                                              AND SaleMast.CoID = ACMaster.CoID
                                              AND SaleMast.WorkYear = ACMaster.WorkYear
                                              AND SaleMast.BrokerID = ACMaster.ACCode
                                              AND SaleMast.CoID = SaleDetails.CoID
                                              AND SaleMast.WorkYear = SaleDetails.WorkYear
                                              AND SaleMast.BillNo = SaleDetails.BillNo            
                                              AND SaleMast.BillDate between '2021-04-01' and '2021-04-30'
                                              and SaleMast.CoID = '$CoID'
                                              and SaleMast.WorkYear = '$WorkYear'
                                              ) as TaxPayable, 
                                  '0' as 'PaidThroughITC_IGST', 
                                  '0' as 'PaidThroughITC_CGST', 
                                  (
                                      SELECT 
                                          sum(PurDetails.SGSTAmt) 
                                      FROM
                                          PurDetails,
                                          ACMastDets
                                      WHERE
                                          PurDetails.PartyCode = ACMastDets.ACCode
                                              AND PurDetails.CoID = ACMastDets.CoID
                                              AND PurDetails.WorkYear = ACMastDets.WorkYear         
                                              AND PurDetails.TaxRate > 0
                                              AND PurDetails.GoodsRcptDate between '2021-04-01' and '2021-04-30'
                                              and PurDetails.CoID = '$CoID'
                                              and PurDetails.WorkYear = '$WorkYear'
                                              ) as 'PaidThroughITC_SGST'
                          from DUAL
  
                  ";
  
  
                  $query = $this->db->query($sql2);
                  $result = $query->result();
                  return $result;
        }
  

 }

 ?>