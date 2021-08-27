<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class GodownTransModel extends CI_Model
{
    public function getData($fromYear, $ToYear)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "SELECT IDNumber,LotNo,
                 TransferDate,
                FromGodown,
                ToGodown,
                ( select
                        PartyName
                    from 
                        PartyMaster
                    where PartyMaster.CoID=GodownTransfer.CoID
                    and PartyMaster.WorkYear=GodownTransfer.WorkYear
                    and PartyMaster.PartyCode=GodownTransfer.PartyCode
                ) PartyName
                from GodownTransfer
                where CoID='$CoID'
                and WorkYear='$WorkYear'
                and TransferDate between '$fromYear' and '$ToYear'
        ";
        $query = $this->db->query($sql)->result_array();
        if (empty($query)) {
            $sql = " SELECT LotNo,
                date_format(TransferDate,'%d/%m/%Y') as TransferDate,
                FromGodown,
                ToGodown,
                ( select
                        PartyName
                    from 
                        PartyMaster
                    where PartyMaster.CoID=GodownTransfer.CoID
                    and PartyMaster.WorkYear=GodownTransfer.WorkYear
                    and PartyMaster.PartyCode=GodownTransfer.PartyCode
                ) PartyName
                from GodownTransfer
                 where CoID='$CoID'
                and WorkYear='$WorkYear'
            ";
            $query = $this->db->query($sql);
            $ea = array("empty");

            foreach ($query->list_fields() as $field) {
                array_push($ea, $field);
            }

            return array($ea, $fromYear, $ToYear);
        }
        return array($query, $fromYear, $ToYear);
    }
    public function getGodownData()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = " SELECT 
            IDNumber,
            LotNo,
            ItemCode,
            ItemName,
            Mark,
            GodownID,
            (select 
                GodownDesc
            from Godown
                where Godown.CoID=PurDetails.CoID
                and Godown.WorkYear=PurDetails.WorkYear
                and Godown.GodownID=PurDetails.GodownID
            ) GodownDesc,
            (select
                     ACTitle
            from 
                ACMaster
            where ACMaster.CoID=PurDetails.CoID
            and ACMaster.WorkYear=PurDetails.WorkYear
            and ACMaster.ACCode=PurDetails.PurchaseCode
            ) SalesTitle,
            Qty BalQty,
            Units PackingText,
            Packing,
            Weight,
            DATE_FORMAT(GoodsRcptDate,'%d/%m/%Y') as GoodsRcptDate,
            'AE' AE,
            '*' Star,
            PartyCode,
            ( select
            PartyName
            from PartyMaster
            where PartyMaster.CoID=PurDetails.CoID
            and PartyMaster.WorkYear=PurDetails.WorkYear
            and PartyMaster.PartyCode=PurDetails.PartyCode) PartyName
        from 
            PurDetails
        where CoID='$CoID'
        and WorkYear='$WorkYear'
        ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function GetGodown()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');

        $sql = "select 
                    GodownID,
                    GodownDesc
                from 
                    Godown
                where CoID='$CoID'
                and WorkYear='$WorkYear'
                ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function GetLastId()
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "select 
                    LastGdnTrans
                from 
                    CompData
                where CoID='$CoID'
                and WorkYear='$WorkYear'
                ";
        $query = $this->db->query($sql);
        $result = $query->result();
        $NewValue = IntVal($result[0]->LastGdnTrans);

        return strval($NewValue);
    }
}
