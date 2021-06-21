<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tds_Model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function get_load_data1($id)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                    Select PartyCode,PartyName
                        from PartyMaster
                            where CoID='$CoID'
                            and WorkYear ='$WorkYear'

        ";
        $query = $this->db->$sql;

        $result = $query->result();
        return $result;
    }

    function getTaxCode($Code)
    {
        // $CoID = $this->session->userdata('CoID');
        // $WorkYear = $this->session->userdata('WorkYear');

        $sql = "
                SELECT TaxCode, TaxTitle, TaxRate
                FROM TaxMaster
                where TaxCode Like '$Code%'      
                ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }



    // Get details and display on TDS Grid - Pranav
    function get_details()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        // ID NO
        // BROKER NAME /PARTY NAME
        // GROSS AMT
        // TDS AMT
        // PAID AMT
        // BANK NAME 

        $sql = "
              select IDNumber, 
              DATE_FORMAT(EntryDate,'%d-%m-%Y') as EntryDate, 
              (select ACTitle
                    from ACMaster
                    where ACMaster.ACCode=TDSonPayment.BrokAcc
                    and ACMaster.WorkYear=TDSonPayment.WorkYear
                    and ACMaster.CoID=TDSonPayment.CoID
              ) as BrokName,
              GrossAmt,
              TotTDSAmt, 
              (CashAmt + CashAmt1) as TotalPaid, 
              CONCAT(
              (select ACTitle
                from ACMaster
                where ACMaster.ACCode=TDSonPayment. CashCode
                and ACMaster.WorkYear=TDSonPayment.WorkYear
                and ACMaster.CoID=TDSonPayment.CoID
              ), ' ',
              (select ACTitle
                from ACMaster
                where ACMaster.ACCode=TDSonPayment. CashCode1
                and ACMaster.WorkYear=TDSonPayment.WorkYear
                and ACMaster.CoID=TDSonPayment.CoID
              ) ) as  CashBankName
                        
              from TDSonPayment
              where CoID = '$CoID'
              and WorkYear = '$WorkYear'
              
              ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function getSuppliers($ACCode)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        $sql = "
            Select PartyCode,PartyName
                from PartyMaster
                where CoID='$CoID'
                and WorkYear ='$WorkYear'
                and PartyCode like '$ACCode%'
            ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    function Get_Supplier_List()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        $sql = "
            Select PartyCode,PartyName
                from PartyMaster
                where CoID='$CoID'
                and WorkYear ='$WorkYear'
            ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    function Get_Bank_List()
    {
        // $CoID = $this->session->userdata('CoID');
        // $WorkYear = $this->session->userdata('WorkYear');

        $sql = "
                SELECT BankCode,BankTitle as BankName, BankBranch
                from BankMaster 
                    ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function getPaymentType($TdsCode)
    {

        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        $sql = "

        Select TDsCode,TDsTitle,
                (select ACCode
                    from ACMaster
                    where ACMaster.ACCode=TdsMaster.AccountCode
                    and ACMaster.CoID='$CoID'
                    and ACMaster.WorkYear='$WorkYear'
                ) as ACCode,
                (select ACTitle
                    from ACMaster
                    where ACMaster.ACCode=TdsMaster.AccountCode
                    and ACMaster.CoID='$CoID'
                    and ACMaster.WorkYear='$WorkYear'
                ) as ACName,
                (select ACCode
                    from ACMaster
                    where ACMaster.ACCode=TdsMaster.TDSAccount
                    and ACMaster.CoID='$CoID'
                    and ACMaster.WorkYear='$WorkYear'
                ) as TDSCode,
                (select ACTitle
                    from ACMaster
                    where ACMaster.ACCode=TdsMaster.TDSAccount
                    and ACMaster.CoID='$CoID'
                    and ACMaster.WorkYear='$WorkYear'
                ) as TDSName
            from TdsMaster
            where TDsCode like '$TdsCode%'
        ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    function get_Tax_List()
    {
        $sql = "
                SELECT TaxCode, TaxTitle, TaxRate
                FROM TaxMaster        ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    function get_Account_list()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        $sql = "
            Select ACCode, ACTitle
                from ACMaster
                where CoID='$CoID'
                And WorkYear='$WorkYear'
            ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }


    function get_Acc_list()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        $sql = "
            Select ACCode, ACTitle,TDSRate,Surcharge,eCess
                from ACMaster
                where CoID='$CoID'
                And WorkYear='$WorkYear'
            ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function getACCode($Code)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        $sql = "
                Select ACCode, ACTitle, TDSRate
                from ACMaster
                where CoID='$CoID'
                And WorkYear='$WorkYear'
                and ACCode like '$Code%'
        ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function getBank()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        $sql = "
                Select ACCode,ACTitle, GroupCode
                  from ACMaster
                where CoID='$CoID'
                    And WorkYear='$WorkYear'
                    and (GroupCode='BB' or GroupCode='BZ')
                ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function getBankDet($Code)
    {
        $sql = "
                SELECT BankCode,BankTitle as BankName, BankBranch
                from BankMaster 
                where BankCode like '$Code%'
        ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    function getCashCode($Code)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        $sql = "
                Select ACCode,ACTitle
                from ACMaster
                where CoID='$CoID'
                And WorkYear='$WorkYear'
                and (GroupCode='BB' or GroupCode='BZ')
                and ACCode Like '$Code%'      
                ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }


    function getid($id)
    {
        // $sql="SELECT IDNumber,PartyCode from PurHeader WHERE RefIDNumber ='$id'";
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
        
                SELECT LastTdsIdNumber 
                  from CompData 
                  WHERE CoID = '$CoID'
                  AND WorkYear = '$WorkYear'
        
        ";
        $query = $this->db->query($sql);
        $result = $query->result();

        $NewValue = IntVal($result[0]->LastTdsIdNumber) + 1;

        $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear);
        $data2 = array('LastTdsIdNumber' => $NewValue);
        $this->db->where($multi_where);
        $this->db->update('CompData', $data2);

        return strval($NewValue);
    }


    function getTdsData($IDNumber)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
        
                SELECT LastTdsIdNumber 
                  from CompData 
                  WHERE CoID = '$CoID'
                  AND WorkYear = '$WorkYear'
        
        ";
        $query = $this->db->query($sql);
        $result = $query->result();
    }




    function getdata($id)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                    SELECT IDNumber,
                            EntryDate,
                            PayUpto, 
                            TdsType,
                            (select TDsTitle
                                from TdsMaster
                                where TdsMaster.TDsCode=TDSonPayment.TdsType
                            ) as PayType,
                            CashAcc, 
                            (select ACTitle
                                from ACMaster
                                where ACMaster.ACCode=TDSonPayment.CashAcc
                                and ACMaster.WorkYear=TDSonPayment.WorkYear
                                and ACMaster.CoID=TDSonPayment.CoID
                            ) as ACName,
                            Nature, 
                            LotNo,
                            PurRefNo, 
                            GrossAmt, 
                            AdvAmt, 
                            BrokAcc, 
                            (select ACTitle
                                from ACMaster
                                where ACMaster.ACCode=TDSonPayment.BrokAcc
                                and ACMaster.WorkYear=TDSonPayment.WorkYear
                                and ACMaster.CoID=TDSonPayment.CoID
                            ) as BrokName,                 
                            AddAmt, 
                            ACashAcc, 
                            (select ACTitle
                                from ACMaster
                                where ACMaster.ACCode=TDSonPayment.ACashAcc
                                and ACMaster.WorkYear=TDSonPayment.WorkYear
                                and ACMaster.CoID=TDSonPayment.CoID
                            ) as ACashName,                 
                            LessAmt, 
                            LCashAcc,
                            (select ACTitle
                                from ACMaster
                                where ACMaster.ACCode=TDSonPayment.LCashAcc
                                and ACMaster.WorkYear=TDSonPayment.WorkYear
                                and ACMaster.CoID=TDSonPayment.CoID
                            ) as LCashName,
                            TDSRate, 
                            TDSAmt, 
                            EcessRate, 
                            EcessAmt, 
                            SurRate, 
                            SurAmt, 
                            TotTDSAmt, 
                            Reason, 
                            CertiNo, 
                            TDS_Acc,
                            (select ACTitle
                                from ACMaster
                                where ACMaster.ACCode=TDSonPayment.TDS_Acc
                                and ACMaster.WorkYear=TDSonPayment.WorkYear
                                and ACMaster.CoID=TDSonPayment.CoID
                            ) as TDSName,
                            CashAmt, 
                            CashCode, 
                            (select ACTitle
                                from ACMaster
                                where ACMaster.ACCode=TDSonPayment. CashCode
                                and ACMaster.WorkYear=TDSonPayment.WorkYear
                                and ACMaster.CoID=TDSonPayment.CoID
                            ) as  CashName,
                            (select GroupCode
                                from ACMaster
                                where ACMaster.ACCode=TDSonPayment. CashCode
                                and ACMaster.WorkYear=TDSonPayment.WorkYear
                                and ACMaster.CoID=TDSonPayment.CoID
                            ) as  GrpCode,
                            CashAmt1, 
                            Cashcode1, 
                            (select ACTitle
                                from ACMaster
                                where ACMaster.ACCode=TDSonPayment. CashCode1
                                and ACMaster.WorkYear=TDSonPayment.WorkYear
                                and ACMaster.CoID=TDSonPayment.CoID
                            ) as  CashName1,
                            (select GroupCode
                                from ACMaster
                                where ACMaster.ACCode=TDSonPayment. CashCode1
                                and ACMaster.WorkYear=TDSonPayment.WorkYear
                                and ACMaster.CoID=TDSonPayment.CoID
                            ) as  GrpCode1,
                            CheqNo, 
                            UTRNo, 
                            SlipNo, 
                            CheqBank, 
                            (select BankTitle
                                from BankMaster
                                where BankMaster.BankCode=TDSonPayment.CheqBank
                            ) as CheqName,
                            (select BankBranch
                                from BankMaster
                                where BankMaster.BankCode=TDSonPayment.CheqBank
                            ) as BankBranch,      
                            ChallanNo, 
                            ChallanDate, 
                            DepoBankcode, 
                            (select BankTitle
                                from BankMaster
                                where BankMaster.BankCode=TDSonPayment.DepoBankcode
                            ) as DepoBankName,
                            (select BankBranch
                                from BankMaster
                                where BankMaster.BankCode=TDSonPayment.DepoBankcode
                            ) as DepoBankBranch,                
                            DepocheqNo, 
                            Form26, 
                            InvoiceNo, 
                            InvoiceDate, 
                            TaxCode, 
                            (select TaxRate
                                from TaxMaster
                                where TaxMaster.TaxCode=TDSonPayment.Taxcode
                            ) as TaxRate,                
                            SaleType, 
                            HSNCode, 
                            RCMInd, 
                            GSTTaxableAmt, 
                            CGSTAmt, 
                            SGSTAmt, 
                            IGSTAmt, 
                            TotalGSTAmt                   
                        from TDSonPayment 
                        WHERE CoID = '$CoID'
                        AND WorkYear = '$WorkYear'
                        AND IDNumber = '$id'
        ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }


    function getTdsTaxInvoice($IDNumber)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        $sql = "
                SELECT EntryDate,
                        (
                        select ACTitle
                        from ACMastDets
                        where ACMastDets.CoID=TDSonPayment.CoID
                        and ACMastDets.WorkYear=TDSonPayment.WorkYear
                        and ACMastDets.ACCode=TDSonPayment.CashAcc
                        ) as PartyName,
                        concat(
                        (
                        select ACMastDets.AddressI
                        from ACMastDets
                        where ACMastDets.CoID=TDSonPayment.CoID
                        and ACMastDets.WorkYear=TDSonPayment.WorkYear
                        and ACMastDets.ACCode=TDSonPayment.CashAcc
                        ),' ',(
                        select ACMastDets.AddressII
                        from ACMastDets
                        where ACMastDets.CoID=TDSonPayment.CoID
                        and ACMastDets.WorkYear=TDSonPayment.WorkYear
                        and ACMastDets.ACCode=TDSonPayment.CashAcc
                        ),' ',(
                        select ACMastDets.AddressIII
                        from ACMastDets
                        where ACMastDets.CoID=TDSonPayment.CoID
                        and ACMastDets.WorkYear=TDSonPayment.WorkYear
                        and ACMastDets.ACCode=TDSonPayment.CashAcc
                        ),' ',(
                        select ACMastDets.Pin
                        from ACMastDets
                        where ACMastDets.CoID=TDSonPayment.CoID
                        and ACMastDets.WorkYear=TDSonPayment.WorkYear
                        and ACMastDets.ACCode=TDSonPayment.CashAcc
                        ))as Address,
                        (
                        select ACMastDets.OfficePhone1
                        from ACMastDets
                        where ACMastDets.CoID=TDSonPayment.CoID
                        and ACMastDets.WorkYear=TDSonPayment.WorkYear
                        and ACMastDets.ACCode=TDSonPayment.CashAcc
                        ) as Phone,
                        (
                        select ACMastDets.GSTNo
                        from ACMastDets
                        where ACMastDets.CoID=TDSonPayment.CoID
                        and ACMastDets.WorkYear=TDSonPayment.WorkYear
                        and ACMastDets.ACCode=TDSonPayment.CashAcc
                        ) as GSTNo,
                        (
                        select ACMastDets.StateCode
                        from ACMastDets
                        where ACMastDets.CoID=TDSonPayment.CoID
                        and ACMastDets.WorkYear=TDSonPayment.WorkYear
                        and ACMastDets.ACCode=TDSonPayment.CashAcc
                        ) as StateCode,
                        (
                        select ACMastDets.StateName
                        from ACMastDets
                        where ACMastDets.CoID=TDSonPayment.CoID
                        and ACMastDets.WorkYear=TDSonPayment.WorkYear
                        and ACMastDets.ACCode=TDSonPayment.CashAcc
                        )as StateName,
                        (
                        select ACMastDets.PanNo
                        from ACMastDets
                        where ACMastDets.CoID=TDSonPayment.CoID
                        and ACMastDets.WorkYear=TDSonPayment.WorkYear
                        and ACMastDets.ACCode=TDSonPayment.CashAcc
                        ) as PanNo
                        ,
                        (select TaxRate
                        From TaxMaster
                        Where TaxMaster.TaxCode= TDSonPayment.TaxCode
                        ) as TaxRate
                        ,
                        TDSonPayment.GSTTaxableAmt,
                        TDSonPayment.CGSTAmt,
                        TDSonPayment.SGSTAmt,
                        TDSonPayment.IGSTAmt,
                        TDSonPayment.InvoiceNo,
                        TDSonPayment.InvoiceDate,
                        TDSonPayment.TotalGSTAmt                    
                    FROM TDSonPayment
                    WHERE TDSonPayment.CoID = '$CoID'
                    AND TDSonPayment.WorkYear = '$WorkYear'
                    AND TDSonPayment.IDNumber = '$IDNumber'


            ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function get_comp()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
               select Company.CoName,
                        concat(CompData.FirmAddress1,' ',CompData.FirmAddress2,' ', CompData.FirmAddress3,' ',CompData.FirmPinCode) as Address,
                        CompData.FirmPhoneNo as phone,
                        CompData.FirmStateName as State,
                        CompData.GSTNo
                from CompData, Company
                where CompData.COID=Company.CoID
                and CompData.COID='$CoID'
                and CompData.WorkYear='$WorkYear'

             ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
}
