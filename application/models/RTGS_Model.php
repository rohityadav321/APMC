<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class RTGS_Model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function party_det()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "
            select ACMastDets.ACTitle as PatyName,
                ACMastDets.ACCode as PatyCode,
                concat(ACMastDets.AddressI,'',
                        ACMastDets.AddressII,'',
                        ACMastDets.AddressIII,'',
                        ACMastDets.City) as Address,
                    ACMastDets.BankName,
                    ACMastDets.BankBranch,
                    ACMastDets.BankACNo,
                    PurPayments.ChequeNo,
                    PurPayments.TotalChequeAmt,
                    ACMastDets.BankRTGSCode,
                    ACMastDets.PanNo,
                    ACMastDets.CellPhone1
                from PurPayments,ACMastDets
                    where PurPayments.CoID = ACMastDets.CoID
                    and PurPayments.WorkYear=ACMastDets.WorkYear
                    and PurPayments.PartyCode=ACMastDets.ACCode
                    and PurPayments.CoID='$CoID'
                    and PurPayments.WorkYear='$WorkYear'
                    and PurPayments.PvNumber='100056'
                ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
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
}
