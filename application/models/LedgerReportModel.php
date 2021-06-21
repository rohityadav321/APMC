<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LedgerReportModel extends CI_Model
{
      function __construct()
      {
            // Call the Model constructor
            parent::__construct();
      }

      function get_accGroupDetails(){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;
        $sql="
        
                  SELECT  Accounts.ACCode, 
                          Accounts.ACTitle as Account_Name,
                          Accounts.OpeningBal,
                          sum(case when ACCDetails.ACCAmount < 0  then (ACCAmount*-1) else 0 end) as Credit_Amount,
                          sum(case when ACCDetails.ACCAmount > 0  then ACCAmount else 0 end) as Debit_Amount, 
                          Accounts.ClosingBal
                  FROM ACCDetails, ACMaster Accounts  
                  where ACCDetails.CoID = '$CoID'
                        and ACCDetails.WorkYear = '$WorkYear'
                        and ACCDetails.CoID = Accounts.CoID
                        and ACCDetails.WorkYear = Accounts.WorkYear
                        and ACCDetails.ACCode = Accounts.ACCode
                  GROUP BY Accounts.ACCode
                  Order By ACCDetails.ACCDate DESC;
              ";
            
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;       

      }

      function get_accGroupDetails_title($title,$fromYear,$toYear){
        $CoID = $this->session->userdata('CoID') ;
        $WorkYear = $this->session->userdata('WorkYear') ;

        // DATE_FORMAT(x.ACCDate, '%d/%m/%y') as pDate,
        // x.ACCDate as Date,

    //     ( SELECT  SUM(y.ACCAmount)
    //     FROM ACCDetails y
    //    WHERE  (case 
    //               when y.ACCDate = x.ACCDate 
    //               then x.IDNumber >= y.IDNumber 
    //               else y.ACCDate <= x.ACCDate 
    //           end) 
    //     and CoID = '$CoID'
    //     and Workyear = '$WorkYear'
    //     and ACCode='$title'
    //   order by ACCDate,IDNumber
    // ) AS Balance,

//     ( SELECT  @yrow_number:=@yrow_number+1 AS yrow_number, 
//     SUM(y.ACCAmount)
// FROM FinalLedger y, (SELECT @yrow_number:=0) AS ty 
// WHERE  (case 
//         when y.ACCDate = x.ACCDate 
//         then xrow_number >= yrow_number 
//         else y.ACCDate <= x.ACCDate 
//     end) 
// and CoID = '$CoID'
// and Workyear = '$WorkYear'
// and ACCode='$title'
// order by ACCDate,yrow_number
// ) AS Balance,

    // SELECT @row_number:=@row_number+1 AS row_number, FinalLedger.*
    // FROM FinalLedger, (SELECT @row_number:=0) AS t
    // DATE_FORMAT(x.ACCDate,'%d-%m-%Y') as 'Date',

    echo $title ; 
    echo "<br>";
    echo $fromYear ; 
    echo "<br>";
    echo $toYear ; 
        $sql="
              SELECT  
                      @xrow_number:=@xrow_number+1 AS 'SrNo',
                      DATE_FORMAT(x.ACCDate,'%d-%m-%Y') as 'TranDate',
                      concat(x.DocNo,'/',x.InvoiceNo) as 'RefNo',
                      x.BookCode,
                      (select distinct ACMaster.ACTitle 
                        from ACMaster 
                        where x.BookCode = ACMaster.ACCode
                      ) as Particulars,
                      x.IndNarration as Narration,
                      (case when x.ACCAmount > 0  then ACCAmount else 0 end) as Debit,
                      (case when x.ACCAmount < 0  then (ACCAmount*-1) else 0 end) as Credit,
                      ACMastDets.City
              FROM FinalLedger x, ACMaster Accounts,ACMastDets, (SELECT @xrow_number:=0) AS tx 
              where x.CoID = '$CoID'
                and x.WorkYear = '$WorkYear'
                and x.CoID = Accounts.CoID
                and x.WorkYear = Accounts.WorkYear
                and x.ACCode = Accounts.ACCode
                and x.BookCode=ACMastDets.ACCode
                and Accounts.ACCode = '$title'
                and x.ACCAmount <> 0 
                order by x.ACCDate asc, SrNo
            ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;            
    }      
      function x_get_accGroupDetails_title($title,$fromYear,$toYear){
          $CoID = $this->session->userdata('CoID') ;
          $WorkYear = $this->session->userdata('WorkYear') ;

          // DATE_FORMAT(x.ACCDate, '%d/%m/%y') as pDate,
          $sql="
                SELECT  
                        x.ACCDate as Date,
                        concat(x.BillNo,'/',x.ChqNo) as 'Bill/ChqNo',
                        x.BookCode,
                        (select distinct ACMaster.ACTitle 
                          from ACMaster 
                          where x.BookCode = ACMaster.ACCode
                        ) as Particulars,
                        x.IndNarration as Narration,
                        (case when x.ACCAmount > 0  then ACCAmount else 0 end) as Debit,
                        (case when x.ACCAmount < 0  then (ACCAmount*-1) else 0 end) as Credit,
                        ACMastDets.City
                FROM ACCDetails x, ACMaster Accounts,ACMastDets  
                where x.CoID = '$CoID'
                  and x.WorkYear = '$WorkYear'
                  and x.CoID = Accounts.CoID
                  and x.WorkYear = Accounts.WorkYear
                  and x.ACCode = Accounts.ACCode
                  and x.BookCode=ACMastDets.ACCode
                  and Accounts.ACCode = '$title'
                  order by ACCDate, IDNumber;
              ";
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;            
      }

      //fetch acc details on dropdown
      function getAccData($ACCode){
        $query = $this->db
                    -> select('ACCode, ACTitle')
                    -> from ('ACMastDets')
                    -> where ("ACCode like '$ACCode%'")
                    -> order_by('ACCode')
                    -> get();
        return $query->result_array();
      }

      function getAcTitle($ACCode){
        $sql ="
              SELECT 
              ACTitle
              from ACMastDets
              where ACCode = '$ACCode'
              ";

              $query = $this->db->query($sql);
              $result = $query->result();
              return $result;
      }

      function Get_Account_List(){
              $CoID = $this->session->userdata('CoID');
              $WorkYear = $this->session->userdata('WorkYear');
              $sql ="
                      SELECT 
                      ACCode,
                      ACTitle
                      from ACMastDets
              ";

              $query = $this->db->query($sql);
              $result = $query->result();
              return $result;
      }


    
}

?>