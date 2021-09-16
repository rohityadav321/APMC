<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class GodownTransModel extends CI_Model
{
    public function getData($fromYear, $ToYear)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "SELECT PurDetails.ID, GodownTransfer.IDNumber,
        GodownTransfer.LotNo,
                         GodownTransfer.TransferDate,
                        GodownTransfer.FromGodown,
                        GodownTransfer.ToGodown,
                        ( select
                                PartyName
                            from 
                                PartyMaster
                            where PartyMaster.CoID=GodownTransfer.CoID
                            and PartyMaster.WorkYear=GodownTransfer.WorkYear
                            and PartyMaster.PartyCode=GodownTransfer.PartyCode
                        ) PartyName,
                        GodownTransfer.Qty
                        from GodownTransfer,PurDetails
                        where PurDetails.CoID=GodownTransfer.CoID
                        and PurDetails.WorkYear=GodownTransfer.WorkYear
                        and PurDetails.LotNo=GodownTransfer.LotNo
                        and PurDetails.IDNumber=GodownTransfer.IDNumber
                        and GodownTransfer.CoID='$CoID'
                        and GodownTransfer.WorkYear='$WorkYear'
                        and GodownTransfer.TransferDate between '$fromYear' and '$ToYear'
                        -- limit 1
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
        $sql = "SELECT 
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
                                (select IFNULL( sum(op.Qty),   0) 
                                        FROM PurDetails op
                                        where GoodsRcptDate<curdate()
                                        and op.LotNo = PurDetails.LotNo
                                        and op.Mark = PurDetails.Mark
                                        and op.ItemCode = PurDetails.ItemCode) 
                                        as Opening, 

                                (select  IFNULL( sum(Inw.Qty),   0) 
                                        FROM PurDetails Inw
                                        where GoodsRcptDate<curdate()
                                        and Inw.LotNo = PurDetails.LotNo
                                        and Inw.Mark = PurDetails.Mark
                                        and Inw.ItemCode = PurDetails.ItemCode) as Inward, 

                                (SELECT IFNULL( sum(outward.Qty),   0)  
                                        from SaleDetails outward
                                        where outward.BillDate <curdate() 
                                        and outward.LotNo = PurDetails.LotNo
                                        and outward.ItemMark = PurDetails.Mark
                                        and outward.ItemCode = PurDetails.ItemCode) as Outward, 
           (
                    (select IFNULL( sum(op.Qty),   0) 
                            FROM PurDetails op
                                   where GoodsRcptDate<curdate()
									and op.LotNo = PurDetails.LotNo
                                    and op.Mark = PurDetails.Mark
                                    and op.ItemCode = PurDetails.ItemCode)                         
                    +
                    (select IFNULL( sum(Inw.Qty),   0) 
                            FROM PurDetails Inw
                                     where GoodsRcptDate<curdate()
									and Inw.LotNo = PurDetails.LotNo
                                    and Inw.Mark = PurDetails.Mark
                                    and Inw.ItemCode = PurDetails.ItemCode) 
                    -
                    (SELECT IFNULL( sum(outward.Qty),   0)  
                                    from SaleDetails outward
                                    where outward.BillDate <curdate() 
									and outward.LotNo = PurDetails.LotNo
                                    and outward.ItemMark = PurDetails.Mark
                                    and outward.ItemCode = PurDetails.ItemCode)
            ) as BalQty,
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

    public function GetGodowntrans($IDNumber)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "SELECT 
                PurDetails.ID RefID,
                GodownTransfer.IDNumber,
                GodownTransfer.PartyCode,
                ( select
                    PartyName
                    from PartyMaster
                    where PartyMaster.CoID=GodownTransfer.CoID
                    and PartyMaster.WorkYear=GodownTransfer.WorkYear
                    and PartyMaster.PartyCode=GodownTransfer.PartyCode) PartyName,
                GodownTransfer.ItemCode,
                ( select
                    ItemName
                    from ItemMaster
                    where ItemMaster.CoID=GodownTransfer.CoID
                    and ItemMaster.WorkYear=GodownTransfer.WorkYear
                    and ItemMaster.ItemCode=GodownTransfer.ItemCode) ItemName,
                GodownTransfer.Mark,
                GodownTransfer.LotNo,
                Date_format(GodownTransfer.TransferDate,'%d/%m/%Y') TransferDate,
                GodownTransfer.Qty,
                PurDetails.Qty BalQty,
                PurDetails.Units as Unit,
                (select
                    distinct(Packing)
                    from PurDetails
                    where PurDetails.CoID=GodownTransfer.CoID
                    and PurDetails.WorkYear=GodownTransfer.WorkYear
                    and PurDetails.LotNo=GodownTransfer.LotNo
                ) Packing,
                GodownTransfer.Weight,
                GodownTransfer.FromGodown,
                (select 
                    GodownDesc
                from Godown
                    where Godown.CoID=GodownTransfer.CoID
                    and Godown.WorkYear=GodownTransfer.WorkYear
                    and Godown.GodownID=GodownTransfer.FromGodown
                ) FromGodownDesc,
                GodownTransfer.ToGodown,
                (select 
                    GodownDesc
                from Godown
                    where Godown.CoID=GodownTransfer.CoID
                    and Godown.WorkYear=GodownTransfer.WorkYear
                    and Godown.GodownID=GodownTransfer.ToGodown
                ) ToGodownDesc
        from GodownTransfer,PurDetails
        where GodownTransfer.CoID=PurDetails.CoID
        and GodownTransfer.WorkYear=PurDetails.WorkYear
        and GodownTransfer.LotNo=PurDetails.LotNo
        and GodownTransfer.CoID='$CoID'
        and GodownTransfer.WorkYear='$WorkYear'
        and GodownTransfer.IDNumber='$IDNumber'
                ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function GetQty($id)
    {
        $CoID = $this->session->userdata('CoID');
        $WorkYear = $this->session->userdata('WorkYear');
        $sql = "SELECT 
                PurDetails.Qty
                from PurDetails
        Where PurDetails.CoID='$CoID'
        and PurDetails.WorkYear='$WorkYear'
        and PurDetails.ID='$id'
                ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
}
// (select
// sum(Qty)
// from PurDetails
// where PurDetails.CoID=GodownTransfer.CoID
// and PurDetails.WorkYear=GodownTransfer.WorkYear
// and PurDetails.LotNo=GodownTransfer.LotNo
// ) BalQty, 
