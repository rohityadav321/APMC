<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class BankRecoModel extends CI_Model
{
    public function Account()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                SELECT ACCode,ACTitle,
                    GroupCode, ClosingBal as BBBalance,
                    ( ACMaster.ClosingBal
                    - 
                        (select abs(sum(ACCAmount))
                        from ACCDetails 
                        where CoID = ACMaster.CoID
                        and WorkYear = ACMaster.WorkYear
                        and BookCode = ACMaster.ACCode 
                        and ClrType <>'C' )
                        ) as BSBalance 
                FROM ACMaster
                where CoID='$CoID'
                and WorkYear='$WorkYear'
                and GroupCode='BB'
        ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function GetBook($BookCode)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                SELECT ACCode,
                    ACTitle,GroupCode, ClosingBal as BBBalance,
                    ( ACMaster.ClosingBal
                    - 
                        (select abs(sum(ACCAmount))
                        from ACCDetails 
                        where CoID = ACMaster.CoID
                        and WorkYear = ACMaster.WorkYear
                        and BookCode = ACMaster.ACCode 
                        and ClrType <>'C' )
                        ) as BSBalance 
                FROM ACMaster
                where CoID='$CoID'
                and WorkYear='$WorkYear'
                and GroupCode='BB'
                And ACCode like'%$BookCode'
        ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function GetBalance($BookCode)
    {
        $this->CreateBankReco();
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                SELECT 
                ACCode,
                ClosingBal as BBBalance,
                    ( ACMaster.ClosingBal
                    - 
                        (select abs(sum(ACCAmount))
                        from Ledger 
                        where CoID = ACMaster.CoID
                        and WorkYear = ACMaster.WorkYear
                        and BookCode = ACMaster.ACCode 
                        and ClrType<>'C' )
                        ) as BSBalance 
                FROM ACMaster
                where CoID='$CoID'
                and WorkYear='$WorkYear'
                and ACCode='$BookCode'
        ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function CreateBankReco()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
        DROP TEMPORARY TABLE IF EXISTS Ledger;
        ";
        $query = $this->db->query($sql);
        $sql = "
            Create Temporary Table Ledger
            SELECT  
                    `Collection`.`ID` AS `IDNumber`,
                    `Collection`.`CoID` AS `CoID`,
                    `Collection`.`WorkYear` AS `WorkYear`,
                    `Collection`.`IDNumber` AS `DocNo`,
                    SaleMast.PartyID as PartyName,
                    `Collection`.`CollectDate` AS `ACCDate`,
                    'SR' As `EntryType`, 
                    `Collection`.`CheqNo` AS `ChequeNo`,
                    `Collection`.`ChequeAmt` AS `ACCAmount`,
                    `Collection`.`DebtorCode` AS `ACCode`,
                    'DR' AS `DRCR`,
                    `Collection`.`DepBankcode` AS `BookCode`,
                    `Collection`.`BillNo` AS `IndNarration`,
                    `Collection`.`ClrType` as `ClrType`,
                    `Collection`.`ClrDate` as `ClrDate`
                FROM
                    `Collection`,SaleMast 

                WHERE 
						SaleMast.BillNo=Collection.BillNo
					and  `Collection`.`CoID` = '$CoID'
                    and `Collection`.`WorkYear` = '$WorkYear'
                    
            UNION 

            SELECT 
                    `ACCDetails`.`IDNumber` AS `IDNumber`,
                    `ACCDetails`.`CoID` AS `CoID`,
                    `ACCDetails`.`WorkYear` AS `WorkYear`,
                    `ACCDetails`.`DocNo` AS `DocNo`,
                    ACMaster.ACTitle as PartyName,
                    `ACCDetails`.`ACCDate` AS `ACCDate`,
                    'RJ' As `EntryType`, 
                    `ACCDetails`.`ChqNo` AS `ChequeNo`,
                    `ACCDetails`.`ACCAmount` AS `ACCAmount`,
                    `ACCDetails`.`ACCode` AS `ACCode`,
                    `ACCDetails`.`DRCR` AS `DRCR`,
                    `ACCDetails`.`BookCode` AS `BookCode`,
                    `ACCDetails`.`IndNarration` AS `IndNarration`,
                    `ACCDetails`.`ClrType` as `ClrType`,
                    `ACCDetails`.`ClrDate` as `ClrDate`
                FROM
                    `ACCDetails` ,ACMaster
                WHERE        
                ACMaster.CoID=ACCDetails.CoID
                and ACMaster.WorkYear=ACCDetails.WorkYear
					and	ACMaster.ACCode=ACCDetails.ACCode
					and `ACCDetails`.`CoID` = '$CoID'
                    and `ACCDetails`.`WorkYear` = '$WorkYear'
            UNION 

            SELECT 
                    `PurPayments`.`IDNumber` AS `IDNumber`,
                    `PurPayments`.`CoID` AS `CoID`,
                    `PurPayments`.`WorkYear` AS `WorkYear`,
                    `PurPayments`.`PvNumber` AS `DocNo`,
                    ACMaster.ACTitle as PartyName,
                    `PurPayments`.`PaymentDate` AS `ACCDate`,
                    'PYR' As `EntryType`, 
                    `PurPayments`.`ChequeNo` AS `ChequeNo`,
                    `PurPayments`.`TotalChequeAmt` AS `ACCAmount`,
                    `PurPayments`.`PartyCode` AS `ACCode`,
                    'CR' AS `DRCR`,
                    `PurPayments`.`BankCode` AS `BookCode`,
                    `PurPayments`.`BillNo` AS `IndNarration`,
                    `PurPayments`.`ClrType` as `ClrType`,
                    `PurPayments`.`ClrDate` as `ClrDate`
                FROM
                    `PurPayments`,ACMaster
                WHERE 
					ACMaster.CoID=PurPayments.CoID
					and ACMaster.WorkYear=PurPayments.WorkYear
					and	ACMaster.ACCode=PurPayments.PartyCode
					and  `PurPayments`.`CoID` = '$CoID'
                    and `PurPayments`.`WorkYear` = '$WorkYear'
        	UNION
            
            SELECT         
                    `TDSonPayment`.`IDNumber` AS `IDNumber`,
                    `TDSonPayment`.`CoID` AS `CoID`,
                    `TDSonPayment`.`WorkYear` AS `WorkYear`,
                    `TDSonPayment`.`IDNumber` AS `DocNo`,
                    ACMaster.ACTitle as PartyName,
                    `TDSonPayment`.`EntryDate` AS `ACCDate`,
                    'TDS' As `EntryType`, 
                     `TDSonPayment`.`CheqNo` AS `ChequeNo`,
                    `TDSonPayment`.`TotalGSTAmt` AS `ACCAmount`,
                    `TDSonPayment`.`CashCode` AS `ACCode`,
                    IF(`TDSonPayment`.`Nature`='D','DR','CR') AS `DRCR`,
                    `TDSonPayment`.`DepoBankCode` AS `BookCode`,
                    `TDSonPayment`.`InvoiceNo` AS `IndNarration`,
                    `TDSonPayment`.`ClrType` as `ClrType`,
                    `TDSonPayment`.`ClrDate` as `ClrDate`
                FROM
                    `TDSonPayment`,ACMaster
                WHERE        
    				ACMaster.CoID=TDSonPayment.CoID
					and ACMaster.WorkYear=TDSonPayment.WorkYear
					and	ACMaster.ACCode=TDSonPayment.CashAcc
					and `TDSonPayment`.`CoID` = '$CoID'
                    and `TDSonPayment`.`WorkYear` = '$WorkYear'

        ";
        $query = $this->db->query($sql);
    }

    public function DropTempTable()
    {
        $sql = "
        DROP TEMPORARY TABLE IF EXISTS Ledger;
        ";
        $query = $this->db->query($sql);
    }
    public function GetUnclearedData($BookCode, $Date, $BookName)
    {
        $this->CreateBankReco();
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                select
                    date_format(ClrDate,'%d/%m/%Y') as Clear_Date,
                    IDNumber,
                    date_format(ACCDate,'%d/%m/%Y') as Date,
                    PartyName as Perticular,ChequeNo,
                    DRCR,EntryType,BookCode,
                    if(DRCR='DR',ACCAmount,0) as Withdrawal,
                    if(DRCR='CR',ACCAmount*-1,0) as Deposit,
                    ClrType
                from Ledger
                where CoID='$CoID'
                and WorkYear='$WorkYear'
                and BookCode='$BookCode'
                and ACCDate<'$Date'
                and ClrType<>'C'

            ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return array($result, $Date, $BookCode, $BookName);
    }


    public function GetAllData($BookCode, $Date, $BookName)
    {
        $this->CreateBankReco();
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
                    select 
                        date_format(ClrDate,'%d/%m/%Y') as Clear_Date,
                        IDNumber,
                        date_format(ACCDate,'%d/%m/%Y') as Date,
                        PartyName as Perticular,ChequeNo,
                        DRCR,EntryType,BookCode,
                        if(DRCR='DR',ACCAmount,0) as Withdrawal,
                        if(DRCR='CR',ACCAmount*-1,0) as Deposit,
                        ClrType
                    from Ledger
                    where CoID='$CoID'
                    and WorkYear='$WorkYear'
                    and BookCode='$BookCode'
                    and ACCDate<'$Date'
        ";
        $query = $this->db->query($sql)->result_array();
        if (empty($query)) {
            $sql = "
                    select 
                        date_format(ClrDate,'%d/%m/%Y') as Clear_Date,
                        IDNumber,
                        date_format(ACCDate,'%d/%m/%Y') as Date,
                        PartyName as Perticular,ChequeNo,
                        DRCR,EntryType,BookCode,
                        if(DRCR='CR',ACCAmount,0) as Withdrawal,
                        if(DRCR='DR',ACCAmount*-1,0) as Deposit,
                        ClrType
                    from Ledger
                    where CoID='$CoID'
                    and WorkYear='$WorkYear'
                    and BookCode='$BookCode'
                    and ACCDate<'$Date'
                ";
            $query = $this->db->query($sql);
            $ea = array("empty");

            foreach ($query->list_fields() as $field) {
                array_push($ea, $field);
            }

            return array($ea, $Date, $BookCode, $BookName);
        }
        return array($query, $Date, $BookCode, $BookName);
    }
}
                    // and `TDSonPayment`.`DepoBankCode` = 'K'
                    // and `TDSonPayment`.`ClrType` <> 'C'
                    // and `PurPayments`.`BankCode` = 'K'
                    // and `PurPayments`.`ClrType` <> 'C'
                    // and `ACCDetails`.`BookCode` = 'K'
                    // and `ACCDetails`.`ClrType` <> 'C'
                    // and `Collection`.`DepBankCode` = 'K'
                    // and `Collection`.`ClrType` <> 'C'
