<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class ReportModelSingle extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_brokerWiseDetails($fromYear, $toYear)
    {

        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                  SELECT 
                    BillNo,
                    BillDate,
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                    Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                    and CoID = '$CoID'
                    and BillDate between '$fromYear' AND '$toYear'
                order by BrokerID;
              ";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }


    // get accdata
    function getPartyData($PartyCode)
    {
        $query = $this->db
            ->select('PartyCode, PartyName')
            ->from('PartyMaster')
            ->where("PartyCode like '$PartyCode%'")
            ->order_by('PartyCode')
            ->get();
        return $query->result_array();
    }
    // get areadata
    function getAreaData($area)
    {
        $sql = " 
        Select Distinct area 
        from SaleMast 
        Where area Like '$area%'
        order by 'area'
        ";
        $query = $this->db->query($sql);
        // ->select('distinct')('area')
        // ->from('SaleMast')
        // ->where("area like '$area%'")
        // ->order_by('area')
        // ->get();
        return $query->result_array();
    }
    // get brokeradata
    function getBrokerData($ACCode)
    {
        //  sql="
        //         select ACCode,ACTitle
        //         from ACMaster
        //         where ACCode like '$ACCode%'
        //         and WorkYear= '$WorkYear'
        //         and CoID = '$CoID'
        //         order by ACCode
        //     ";
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $query = $this->db
            ->select('ACCode, ACTitle')
            ->from('ACMaster')
            ->where("ACCode like '$ACCode%' and   WorkYear= '$WorkYear' and CoID = '$CoID'  ")
            ->order_by('ACCode')
            ->get();
        return $query->result_array();
    }

    // get account code
    function Get_Party_List()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                      SELECT 
                      PartyCode,
                      PartyName
                      from PartyMaster
              ";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    function Get_Area_List()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                      SELECT  distinct area
                      from SaleMast
              ";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    function Get_Broker_List()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                      SELECT 
                      ACCode,
                      ACTitle
                      from ACMaster
                      WHERE CoID = '$CoID'
                      and WorkYear = '$WorkYear'
              ";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function get_areaWiseDetails($fromYear, $toYear)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                  SELECT 
                    BillNo,
                    BillDate,
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                    Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                    and CoID = '$CoID'
                    and BillDate between '$fromYear' AND '$toYear'
                order by Area;
              ";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function get_partyWiseDetails($fromYear, $toYear)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                  SELECT 
                    BillNo,
                    BillDate,
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                    Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                    and CoID = '$CoID'
                    and BillDate between '$fromYear' AND '$toYear'
                order by PartyCode;
              ";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function get_OSReceivables($f, $t)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "        
                  SELECT 
                      (Select ACTitle 
                        from ACMaster 
                            where SaleMast.BrokerID = ACMaster.ACCode 
                                and SaleMast.CoID = ACMaster.CoID
                                and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillNo,
                    DATE_FORMAT(BillDate,'%d-%m-%Y') as 'BillDt',
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                    Area,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                    and CoID = '$CoID'
                    and BillDate BETWEEN '$f' AND '$t'
                    and (BillAmt-RcptAmt) > 0 
                    order by BrokerName, BillDate 
                 ";
        // echo $sql;         
        $query = $this->db->query($sql)->result_array();

        // print_r ( $query);
        // die ; 

        if (empty($query)) {
            $sql = "      
                    SELECT 
                    BillNo,
                    BillDate,
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                    Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                  and CoID = '$CoID' limit 1
                ";
            $query = $this->db->query($sql);
            $ea = array("empty");

            foreach ($query->list_fields() as $field) {
                array_push($ea, $field);
            }
            return array($ea, $f, $t);
        }
        return array($query, $f, $t);
    }


    function get_OSReceivablesB($f, $t, $A)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');


        // $sql="";$f="";$t="";
        // $dt=date("d-m-yy");
        // $current_month = date("m");
        // $current_year = date("yy");
        // $w=explode("-",$WorkYear);
        // $WY = '20'.$w[1];

        // if((int)$WY > (int)$current_year){
        //   $f = date("$current_year-$current_month-01", strtotime($dt));
        //   $t = date("$current_year-$current_month-t", strtotime($dt));
        // }
        // else{
        //   $f = date("$WY-03-01", strtotime($dt));
        //   $t = date("$WY-03-t", strtotime($dt));
        // }
        // echo $f .' === ' . $t ;
        // echo "<br>";
        $sql = "        
                  SELECT 
                      (Select ACTitle 
                        from ACMaster 
                            where SaleMast.BrokerID = ACMaster.ACCode 
                                and SaleMast.CoID = ACMaster.CoID
                                and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillNo,
                    DATE_FORMAT(BillDate,'%d-%m-%Y') as 'BillDt',
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                    Area,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                    and CoID = '$CoID'
                    and BrokerID='$A'
                    and BillDate BETWEEN '$f' AND '$t'
                    and (BillAmt-RcptAmt) > 0 
                    order by BrokerName, BillDate 
                 ";
        // echo $sql;         
        $query = $this->db->query($sql)->result_array();

        // print_r ( $query);
        // die ; 

        if (empty($query)) {
            $sql = "      
                    SELECT 
                    BillNo,
                    BillDate,
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                    Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                  and CoID = '$CoID' limit 1
                ";
            $query = $this->db->query($sql);
            $ea = array("empty");

            foreach ($query->list_fields() as $field) {
                array_push($ea, $field);
            }
            return array($ea, $f, $t);
        }
        return array($query, $f, $t);
    }

    function get_OSReceivablesA($f, $t, $A)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        // $sql="";$f="";$t="";
        // $dt=date("d-m-yy");
        // $current_month = date("m");
        // $current_year = date("yy");
        // $w=explode("-",$WorkYear);
        // $WY = '20'.$w[1];

        // if((int)$WY > (int)$current_year){
        //   $f = date("$current_year-$current_month-01", strtotime($dt));
        //   $t = date("$current_year-$current_month-t", strtotime($dt));
        // }
        // else{
        //   $f = date("$WY-03-01", strtotime($dt));
        //   $t = date("$WY-03-t", strtotime($dt));
        // }
        $sql = "        
                  SELECT 
                    area,
                    BillNo,
                    DATE_FORMAT(BillDate,'%d-%m-%Y') as 'BillDt',
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                    and CoID = '$CoID'
                    and area = '$A'
                    and BillDate BETWEEN '$f' AND '$t'
                    and (BillAmt-RcptAmt) > 0 
                    order by area, BillDate 
                 ";
        $query = $this->db->query($sql)->result_array();

        if (empty($query)) {
            $sql = "      
                    SELECT 
                    BillNo,
                    BillDate,
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                    Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                  and CoID = '$CoID' limit 1
                ";
            $query = $this->db->query($sql);
            $ea = array("empty");

            foreach ($query->list_fields() as $field) {
                array_push($ea, $field);
            }
            return array($ea, $f, $t);
        }
        return array($query, $f, $t);
    }

    function get_OSReceivablesP($f, $t, $PartyName)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        // $sql="";$f="";$t="";
        // $dt=date("d-m-yy");
        // $current_month = date("m");
        // $current_year = date("yy");
        // $w=explode("-",$WorkYear);
        // $WY = '20'.$w[1];

        // if((int)$WY > (int)$current_year){
        //   $f = date("$current_year-$current_month-01", strtotime($dt));
        //   $t = date("$current_year-$current_month-t", strtotime($dt));
        // }
        // else{
        //   $f = date("$WY-03-01", strtotime($dt));
        //   $t = date("$WY-03-t", strtotime($dt));
        // }
        $sql = "        
                  SELECT 
                      (Select PartyName 
                        from PartyMaster 
                            where SaleMast.PartyCode = PartyMaster.PartyCode
                    ) as PartyName,
                    BillNo,
                    DATE_FORMAT(BillDate,'%d-%m-%Y') as 'BillDt',
                        Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                    and CoID = '$CoID'
                    and BillDate BETWEEN '$f' AND '$t'
                    and PartyCode = '$PartyName'
                    and (BillAmt-RcptAmt) > 0 
                    order by PartyName, BillDate 
                 ";
        $query = $this->db->query($sql)->result_array();

        if (empty($query)) {
            $sql = "      
                    SELECT 
                    BillNo,
                    BillDate,
                        (Select PartyName 
                            from PartyMaster 
                                where SaleMast.PartyCode = PartyMaster.PartyCode
                        ) as PartyName,
                    Area,
                        (Select ACTitle 
                            from ACMaster 
                                where SaleMast.BrokerID = ACMaster.ACCode 
                                    and SaleMast.CoID = ACMaster.CoID
                                    and SaleMast.WorkYear = ACMaster.WorkYear 
                        ) as BrokerName,
                    BillAmt,
                    (BillAmt-RcptAmt) as BalAmt 
                FROM SaleMast
                where WorkYear = '$WorkYear'
                  and CoID = '$CoID' limit 1
                ";
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
