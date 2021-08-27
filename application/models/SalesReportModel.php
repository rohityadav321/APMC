<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class SalesReportModel extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function get_Sales($f, $t)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
        select  monthname(SaleDetails.BillDate) as Months,
                sum((SaleDetails.DiscAmt-SalesReturnDets.DiscAmt)) as DiscAmt,
                sum((SaleDetails.TaxableAmt-SalesReturnDets.TaxableAmt)) as TaxableAmt,
                sum((SaleDetails.APMCChrg-SalesReturnDets.APMCChrg)) as APMCAmt,
                sum((SaleDetails.APMCSChrg-SalesReturnDets.APMCSChrg)) as APMCChrg,
                sum(((SaleDetails.APMCChrg-SalesReturnDets.APMCChrg) +
                (SaleDetails.APMCSChrg-SalesReturnDets.APMCSChrg))) as TotalAPMC
                
        from SaleDetails,SalesReturnDets
            where SaleDetails.CoID=SalesReturnDets.CoID
            and SaleDetails.WorkYear=SalesReturnDets.WorkYear
            and SaleDetails.BillNo=SalesReturnDets.BillNo
            and SaleDetails.CoID='$CoID'
            and SaleDetails.WorkYear='$WorkYear'
            and SaleDetails.BillDate between '$f' and '$t'
            order by months 
   ";
        // echo $sql;
        $query = $this->db->query($sql)->result_array();

        // print_r ( $query);
        // die ;

        if (empty($query)) {
            $sql = "
                select  monthname(SaleDetails.BillDate) as Months,
                        sum((SaleDetails.DiscAmt-SalesReturnDets.DiscAmt)) as DiscAmt,
                        sum((SaleDetails.TaxableAmt-SalesReturnDets.TaxableAmt)) as TaxableAmt,
                        sum((SaleDetails.APMCChrg-SalesReturnDets.APMCChrg)) as APMCAmt,
                        sum((SaleDetails.APMCSChrg-SalesReturnDets.APMCSChrg)) as APMCChrg,
                        sum(((SaleDetails.APMCChrg-SalesReturnDets.APMCChrg) +
                        (SaleDetails.APMCSChrg-SalesReturnDets.APMCSChrg))) as TotalAPMC
                        
                from SaleDetails,SalesReturnDets
                     where SaleDetails.CoID=SalesReturnDets.CoID
                        and SaleDetails.WorkYear=SalesReturnDets.WorkYear
                        and SaleDetails.BillNo=SalesReturnDets.BillNo
                        and SaleDetails.CoID='$CoID'
                        and SaleDetails.WorkYear='$WorkYear'
                        and SaleDetails.BillDate between '$f' and '$t'
                    order by months 
                    limit 1    
                    ";
            //                         and SaleDetails.BillDate between '$f' and '$t'
            $query = $this->db->query($sql);
            $ea = array("empty");

            foreach ($query->list_fields() as $field) {
                array_push($ea, $field);
            }
            return array($ea, $f, $t);
        }
        return array($query, $f, $t);
    }
    function get_Salesfilter($f, $t)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
        select  monthname(SaleDetails.BillDate) as Months,
                sum((SaleDetails.DiscAmt-SalesReturnDets.DiscAmt)) as DiscAmt,
                sum((SaleDetails.TaxableAmt-SalesReturnDets.TaxableAmt)) as TaxableAmt,
                sum((SaleDetails.APMCChrg-SalesReturnDets.APMCChrg)) as APMCAmt,
                sum((SaleDetails.APMCSChrg-SalesReturnDets.APMCSChrg)) as APMCChrg,
                sum(((SaleDetails.APMCChrg-SalesReturnDets.APMCChrg) +
                (SaleDetails.APMCSChrg-SalesReturnDets.APMCSChrg))) as TotalAPMC
                
        from SaleDetails,SalesReturnDets
            where SaleDetails.CoID=SalesReturnDets.CoID
            and SaleDetails.WorkYear=SalesReturnDets.WorkYear
            and SaleDetails.BillNo=SalesReturnDets.BillNo
            and SaleDetails.CoID='$CoID'
            and SaleDetails.WorkYear='$WorkYear'
            and SaleDetails.BillDate between '$f' and '$t'
            order by months 
   ";
        // echo $sql;
        $query = $this->db->query($sql)->result_array();

        // print_r ( $query);
        // die ;

        if (empty($query)) {
            $sql = "
                select  monthname(SaleDetails.BillDate) as Months,
                        sum((SaleDetails.DiscAmt-SalesReturnDets.DiscAmt)) as DiscAmt,
                        sum((SaleDetails.TaxableAmt-SalesReturnDets.TaxableAmt)) as TaxableAmt,
                        sum((SaleDetails.APMCChrg-SalesReturnDets.APMCChrg)) as APMCAmt,
                        sum((SaleDetails.APMCSChrg-SalesReturnDets.APMCSChrg)) as APMCChrg,
                        sum(((SaleDetails.APMCChrg-SalesReturnDets.APMCChrg) +
                        (SaleDetails.APMCSChrg-SalesReturnDets.APMCSChrg))) as TotalAPMC
                        
                from SaleDetails,SalesReturnDets
                     where SaleDetails.CoID=SalesReturnDets.CoID
                        and SaleDetails.WorkYear=SalesReturnDets.WorkYear
                        and SaleDetails.BillNo=SalesReturnDets.BillNo
                        and SaleDetails.CoID='$CoID'
                        and SaleDetails.WorkYear='$WorkYear'
                        and SaleDetails.BillDate between '$f' and '$t'
                    order by months 
                    limit 1    
                    ";
            //                         and SaleDetails.BillDate between '$f' and '$t'
            $query = $this->db->query($sql);
            $ea = array("empty");

            foreach ($query->list_fields() as $field) {
                array_push($ea, $field);
            }
            return array($ea, $f, $t);
        }
        return array($query, $f, $t);
    }
}
