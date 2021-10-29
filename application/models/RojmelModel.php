
<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class RojmelModel extends CI_Model
{
  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }


  function Get_Book_List()
  {

    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
                  SELECT 
                        ACCode,
                        ACTitle,
                        GroupCode,OpeningBal,ClosingBal
                  from ACMaster
                  where  (GroupCode='J' or GroupCode='BZ' or GroupCode='BB') 
                    and CoID = '$CoID'
                    and WorkYear='$WorkYear'
                ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function Get_Account_List()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
                        SELECT 
                        ACCode,
                        ACTitle,
                        GroupCode
                    from ACMaster
                    where CoID = '$CoID'
                      and WorkYear='$WorkYear'
                    
                  ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  // Get Rojmel Data for RojmelGrid
  function get_details()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $fromYear = "";
    $toYear = "";
    $current_month = date("m");
    $current_year = date("Y");
    $yearArray = explode("-", $WorkYear);
    $year = explode("-", $yearArray[0]);
    $WY = substr($year[0], 0, 2) . $yearArray[1];

    if ((int)$WY > (int)$current_year) {
      $fromYear = date("$current_year-$current_month-01");
      $toYear = date("$current_year-$current_month-t");
    } else {
      $fromYear = date("$WY-03-01");
      $toYear = date("$WY-03-t");
    }

    $sql = "
                SELECT ACCDetails.IDNumber,ACCDetails.CoID, ACCDetails.WorkYear, ACCDetails.BookCode,
                     ACMaster.ACTitle, DocNo, DATE_FORMAT(ACCDate,'%d/%m/%Y') AS ACCDateGrid ,ACCDetails.ACCode,ACCDetails.ACCAmount,
                     ACCDetails.IndNarration as Narration,
                    sum(IF(ACCAmount>0,ACCAmount,0)) DR,
                    sum(IF(ACCAmount<0,ACCAmount*-1,0)) CR,
                    ((sum(IF(ACCAmount<0,ACCAmount*-1,0))) - (sum(IF(ACCAmount>0,ACCAmount,0))) ) as Withdraw,
                    (CASE 
                    WHEN (ACMaster.GroupCode = 'BB'  and ((sum(IF(ACCAmount<0,ACCAmount*-1,0))) - (sum(IF(ACCAmount>0,ACCAmount,0))) ) < 0 ) THEN 'Withdrawal'
                    WHEN (ACMaster.GroupCode = 'BB' and ((sum(IF(ACCAmount<0,ACCAmount*-1,0))) - (sum(IF(ACCAmount>0,ACCAmount,0))) ) > 0 ) THEN 'Deposit'
                    WHEN (ACMaster.GroupCode = 'BZ'  and ((sum(IF(ACCAmount<0,ACCAmount*-1,0))) - (sum(IF(ACCAmount>0,ACCAmount,0))) ) < 0 ) THEN 'Payment'
                    WHEN (ACMaster.GroupCode = 'BZ' and ((sum(IF(ACCAmount<0,ACCAmount*-1,0))) - (sum(IF(ACCAmount>0,ACCAmount,0))) ) > 0 ) THEN 'Receipt'
                    
                    ELSE 'Journal'
                END) AS Nature
                FROM ACCDetails, ACMaster
                where ACCDetails.BookCode = ACMaster.ACCode
                and ACCDetails.CoId = ACMaster.CoID
                and ACCDetails.WorkYear = ACMaster.WorkYear
                and ACCDetails.CoId = '$CoID'
                and ACCDetails.WorkYear = '$WorkYear'
                and ACCDate BETWEEN '$fromYear' AND '$toYear'
                GROUP BY DocNo
                Order by ACCDate DESC , DocNo 
        ";

    // $query = $this->db->query($sql);
    // $result = $query->result();
    // return $result;

    $result = $this->db->query($sql)->result_array();

    if (empty($result)) {
      $emptyArray = array("empty");
      return array($emptyArray, $fromYear, $toYear);
    }

    return array($result, $fromYear, $toYear);
  }


  // Get Rojmel Data Datewise for RojmelGrid
  function get_detailsFilter($fromYear, $toYear)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
                SELECT ACCDetails.IDNumber, 
                        ACCDetails.CoID, 
                        ACCDetails.WorkYear, 
                        ACCDetails.BookCode,
                        ACMaster.ACTitle, 
                        DocNo, 
                        DATE_FORMAT(ACCDate,'%d/%m/%Y') AS ACCDateGrid,
                        ACCDetails.ACCode,
                        ACCDetails.ACCAmount,
                        ACCDetails.IndNarration as Narration,
                        sum(IF(ACCAmount>0,ACCAmount,0)) DR,
                        sum(IF(ACCAmount<0,ACCAmount*-1,0)) CR,
                        ((sum(IF(ACCAmount<0,ACCAmount*-1,0))) - (sum(IF(ACCAmount>0,ACCAmount,0))) ) as Withdraw,
                    (CASE 
                          WHEN (ACMaster.GroupCode = 'BB'  and ((sum(IF(ACCAmount<0,ACCAmount*-1,0))) - (sum(IF(ACCAmount>0,ACCAmount,0))) ) < 0 ) THEN 'Withdrawal'
                          WHEN (ACMaster.GroupCode = 'BB' and ((sum(IF(ACCAmount<0,ACCAmount*-1,0))) - (sum(IF(ACCAmount>0,ACCAmount,0))) ) > 0 ) THEN 'Deposit'
                          WHEN (ACMaster.GroupCode = 'BZ'  and ((sum(IF(ACCAmount<0,ACCAmount*-1,0))) - (sum(IF(ACCAmount>0,ACCAmount,0))) ) < 0 ) THEN 'Payment'
                          WHEN (ACMaster.GroupCode = 'BZ' and ((sum(IF(ACCAmount<0,ACCAmount*-1,0))) - (sum(IF(ACCAmount>0,ACCAmount,0))) ) > 0 ) THEN 'Receipt'
                    ELSE 'Journal'
                    END) AS Nature
                FROM ACCDetails, ACMaster
                where ACCDetails.BookCode = ACMaster.ACCode
                and ACCDetails.CoId = ACMaster.CoID
                and ACCDetails.WorkYear = ACMaster.WorkYear
                and ACCDetails.CoId = '$CoID'
                and ACCDetails.WorkYear = '$WorkYear'
                and ACCDate BETWEEN '$fromYear' AND '$toYear'
                GROUP BY DocNo
                Order by ACCDate DESC , DocNo 
        ";

    $result = $this->db->query($sql)->result_array();

    if (empty($result)) {
      $emptyArray = array("empty");
      return array($emptyArray, $fromYear, $toYear);
    }

    return  array($result, $fromYear, $toYear);
  }


  function get_edit_details($id)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
        
            SELECT IDNumber, Date(ACCDate) as ACCDate, BookCode,Book.ACTitle,ACCDetails.ACCode, Accounts.ACTitle,
                    ACCAmount,Accounts.OpeningBal,Accounts.ClosingBal,DocNo,Accounts.GroupCode,
                    (if(((sum(IF(ACCAmount<0,ACCAmount*-1,0))) - (sum(IF(ACCAmount>0,ACCAmount,0))) )<0,'Withdraw','Deposit')) as Nature
              FROM ACCDetails, ACMaster Book, ACMaster Accounts
              where DocNo = '$id'
              and ACCDetails.CoID = '$CoID'
              and ACCDetails.WorkYear = '$WorkYear'

              and ACCDetails.CoID = Book.CoID
              and ACCDetails.WorkYear = Book.WorkYear
              and ACCDetails.BookCode = Book.ACCode

              and ACCDetails.CoID = Accounts.CoID
              and ACCDetails.WorkYear = Accounts.WorkYear
              and ACCDetails.BookCode = Accounts.ACCode

            Order By ACCDetails.ACCDate DESC ;";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function getid($id)
  {
    $sql = "
                SELECT DocNo 
                  from ACCDetails 
                WHERE DocNo ='$id'
            ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function delete_record_edit($Idnumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "delete from ACCDetails
        where 
           ACCDetails.CoID = '$CoID'
          and ACCDetails.WorkYear='$WorkYear'          
          and ACCDetails.IDNumber = '$Idnumber'";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }


  function get_add_entries($Idnumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
                SELECT 
                    IDNumber,
                    ACCDetails.ACCode,
                    Accounts.ACTitle,
                    GroupCode,
                    BookCode,
                    ABS(ACCAmount) as ACCAmount,
                    DRCR,
                    ChqNo,
                    LotNo
          from ACCDetails, ACMaster Accounts
          WHERE ACCDetails.CoID = Accounts.CoID
          and ACCDetails.WorkYear = Accounts.WorkYear
          and ACCDetails.ACCode = Accounts.ACCode
          and ACCDetails.CoID = '$CoID'
          and ACCDetails.WorkYear='$WorkYear'          
          and ACCDetails.DocNo = '$Idnumber'

        ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }
  //update in below datatable part
  function editfromgrid($Idnumber)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
        SELECT 
        IDNumber,
        ACCDetails.ACCode,
        Accounts.ACTitle,
        GroupCode,
        BookCode,
        ABS(ACCAmount) as ACCAmount,
        DRCR,
        ChqNo,
        LotNo

          from ACCDetails, ACMaster Accounts
          WHERE ACCDetails.CoID = Accounts.CoID
          and ACCDetails.WorkYear = Accounts.WorkYear
          and ACCDetails.ACCode = Accounts.ACCode
          and ACCDetails.CoID = '$CoID'
          and ACCDetails.WorkYear='$WorkYear'          
          and ACCDetails.IDNumber = '$Idnumber'

        ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function max_id()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = "
        
            SELECT max(DocNo) as id
                FROM ACCDetails
              Where ACCDetails.CoID = '$CoID'
                and ACCDetails.WorkYear = '$WorkYear'
                    
            ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }


  function Get_AccountSetting_List()
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
                      SELECT 
                              ACCode,
                              ACTitle,
                              GroupCode
                        from ACMaster
                        where  (GroupCode='J' or GroupCode='BZ') 
                        and CoID = '$CoID'
                        and WorkYear='$WorkYear'
                  ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }


  function getDocno()
  {
    // $sql="SELECT IDNumber,PartyCode from PurHeader WHERE RefIDNumber ='$id'";
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
        
                SELECT LastRojmelDocNo 
                  from CompData 
                  WHERE CoID = '$CoID'
                  AND WorkYear = '$WorkYear'
        
        ";
    $query = $this->db->query($sql);
    $result = $query->result();

    $NewValue = IntVal($result[0]->LastRojmelDocNo) + 1;

    $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear);
    $data2 = array('LastRojmelDocNo' => $NewValue);
    $this->db->where($multi_where);
    $this->db->update('CompData', $data2);

    return strval($NewValue);
  }
  // Updated on 8/10/21
  function update_insert($Idnumber, $UPid, $BookCode, $ACCAmount, $DRCR, $ACCODE, $ChqNo, $LotNo, $EntryNo, $EntryType, $date, $CNarration, $RefIDNo, $SBillNO)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');

    $sql = " INSERT INTO ACCDetails (ACCode,DocNo,ACCDate,IDNumber,BookCode, ACCAmount,ChqNo,LotNo,EntryNo,EntryType,DRCR,WorkYear,CoID,IndNarration,BillNo,RefIDNo) 
            VALUES('$ACCODE','$Idnumber','$date','$UPid','$BookCode','$ACCAmount','$ChqNo','$LotNo','$EntryNo','$EntryType','$DRCR','$WorkYear','$CoID','$CNarration','$SBillNO','$RefIDNo')
            ON DUPLICATE KEY UPDATE
            BookCode = '$BookCode', DRCR = '$DRCR',ACCAmount='$ACCAmount', ChqNo = '$ChqNo', LotNo = '$LotNo',WorkYear='$WorkYear',CoID='$CoID',ACCode='$ACCODE',DocNo='$Idnumber',ACCDate='$date',IndNarration='$CNarration',BillNo='$SBillNO',RefIDNo='$RefIDNo';                    
                  ";

    $query = $this->db->query($sql);
    $result = "";
    return $result;
  }

  function get_Balance($Idnumber)
  {
    // $sql="SELECT IDNumber,PartyCode from PurHeader WHERE RefIDNumber ='$id'";
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "SELECT distinct mast.ClosingBal as clbal, 
                    (if(((sum(IF(ACCAmount<0,ACCAmount*-1,0))) - (sum(IF(ACCAmount>0,ACCAmount,0))))<0,((sum(IF(ACCAmount<0,ACCAmount*-1,0))) - (sum(IF(ACCAmount>0,ACCAmount,0))) )*-1,((sum(IF(ACCAmount<0,ACCAmount*-1,0))) - (sum(IF(ACCAmount>0,ACCAmount,0))) ))) as AMT
        FROM ACCDetails as ac,ACMaster as mast
        where
        ac.DocNo='$Idnumber'
        and ac.WorkYear = '$WorkYear'
        and ac.CoID = '$CoID'
        and ac.BookCode=mast.ACCode
        and ac.WorkYear=mast.WorkYear
        and ac.CoID=mast.CoID";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function get_Balance_via_Code($Code)
  {
    // $sql="SELECT IDNumber,PartyCode from PurHeader WHERE RefIDNumber ='$id'";
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "SELECT  ClosingBal as clbal
      FROM ACMaster
      where
      ACCode='$Code'
      and WorkYear = '$WorkYear'
      and CoID = '$CoID'";


    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }


  function getRojmelList($BCode)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
            SELECT 
                  ACCode,
                  ACTitle,
                  GroupCode
            from ACMaster
            where 
             (GroupCode='J' or GroupCode='BZ' or GroupCode='BB') 
              and CoID = '$CoID'
              and WorkYear='$WorkYear'
              and ACCode like '$BCode%'
          ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }
  function getRojmelAccountList($ACCode)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
                  SELECT 
                  ACCode,
                  ACTitle,
                  GroupCode
              from ACMaster
              where CoID = '$CoID'
                and WorkYear='$WorkYear'
                and ACCode like '$ACCode%'
            ";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function party_det($id)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
              Select
                      ACCDetails.ACCDate,
                      ACMastDets.ACTitle as PartyName,
                      ACMastDets.ACCode as PartyCode,
                      ACMastDets.City as Address,
                      ACMastDets.BankName,
                      ACMastDets.BankBranch,
                      ACMastDets.BankACNo,
                      ACMastDets.BankRTGSCode,
                      ACMastDets.PanNo,
                      ACMastDets.CellPhone1,
                      ACCDetails.ACCAmount,
                      ACCDetails.ChqNo
                from  ACCDetails,ACMastDets
                where ACCDetails.CoID = ACMastDets.CoID
                      and ACCDetails.WorkYear=ACMastDets.WorkYear
                      and ACCDetails.ACCode=ACMastDets.ACCode
                      and ACCDetails.CoID='$CoID'
                      and ACCDetails.WorkYear='$WorkYear'
                      and ACCDetails.DocNo='$id'
                  ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }
  // ACCDetails.ChequeNo,
  //                 ACCDetails.TotalChequeAmt,

  function get_company()
  {
    $CoID = $this->session->userdata('CoID');
    // $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
                  select CoName,
                          concat(Address1,'',Address2,'',Address3)as Address,
                          BankName,BankAccount
                    from Company
                    WHERE CoID= '$CoID'
                  ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  function getBank($id)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "
              select
                      ACMaster.ACTitle as BankName,
                      ACMaster.AccountNo as BankACNo
                from ACCDetails,ACMaster
                where ACCDetails.CoID = ACMaster.CoID
                  and ACCDetails.WorkYear=ACMaster.WorkYear
                  and ACCDetails.BookCode=ACMaster.ACCode
                  and ACCDetails.CoID='$CoID'
                  and ACCDetails.WorkYear='$WorkYear'
                  and ACCDetails.DocNo='$id'
              ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  // Updated on 8/10/21

  function GetModaldataParty($party)
  {
    $CoID = $this->session->userdata('CoID');
    $WorkYear = $this->session->userdata('WorkYear');
    $sql = "SELECT 
          `RefIDNumber`, 
          TotalAmount,
          DATE_FORMAT(GoodsRcptDate,'%d-%m-%Y') AS GoodsRcptDate, 
          `PartyCode`, 
          PartyName,
          PurHeader.BrokerCode, 
          `InvoiceNo`, 
          DATE_FORMAT(InvoiceDate,'%d-%m-%Y') AS InvoiceDate,
          `NetPayable`,
          `TotalPaid`,
       	  (
                  ifnull(
              (SELECT sum(ACCAmount)
                  from ACCDetails
                  where ACCDetails.CoID=PurHeader.CoID
                  and ACCDetails.WorkYear=PurHeader.WorkYear
                  and ACCDetails.RefIDNo=PurHeader.RefIDNumber
              ),
            0)
                +
                ifnull(( SELECT sum(TotalPay)
            FROM PurPayments
            where PurPayments.CoID = PurHeader.CoID
                    and PurPayments.WorkYear = PurHeader.WorkYear
            and PurPayments.PartyCode = PurHeader.PartyCode 
            and PurPayments.RefIDNumber = PurHeader.RefIDNumber ),0) 
                )TP,    
          DATEDIFF(current_date(),GoodsRcptDate) AS Days,
               (`BalanceDue`
          -
          ifnull(
					(SELECT sum(ACCAmount)
							from ACCDetails
							where ACCDetails.CoID=PurHeader.CoID
							and ACCDetails.WorkYear=PurHeader.WorkYear
							and ACCDetails.RefIDNo=PurHeader.RefIDNumber
					),
				0) 
                ) BalanceDue,
          `IntRate`
      from PurHeader ,ACMaster
      where  PurHeader.PartyCode='$party'
      and BalanceDue > 0
      AND PurHeader.CoID ='$CoID'
      AND PurHeader.WorkYear = '$WorkYear' 
      AND PurHeader.PartyCode = ACMaster.ACCode
      AND PurHeader.CoID = ACMaster.CoID
      AND PurHeader.WorkYear = ACMaster.WorkYear
    ";

    $query = $this->db->query($sql);
    $result = $query->result();

    return $result;
  }
}

?>