<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class conversionModel extends CI_Model
{

        public function ItemWiseItemStock()
        {
                $CoID = $this->session->userdata('CoID');
                $WorkYear = $this->session->userdata('WorkYear');
                $fromYear = date('Y-m-01');
                $month_end = strtotime('last day of this month', time());
                // echo 'end date ' . date('D, M jS Y', $month_end).'<br/>';
                $toYear = date('Y-m-d', $month_end);

                $sql = "SELECT LotNo, Mark, PurDetails.ItemCode, ItemMaster.ItemName, 

                                (select IFNULL( sum(op.Qty),   0) 
                                        FROM PurDetails op
                                        where GoodsRcptDate < '$fromYear'
                                        and op.LotNo = PurDetails.LotNo
                                        and op.Mark = PurDetails.Mark
                                        and op.ItemCode = PurDetails.ItemCode) as Opening, 

                                (select  IFNULL( sum(Inw.Qty),   0) 
                                        FROM PurDetails Inw
                                        where GoodsRcptDate between '$fromYear' and '$toYear'
                                        and Inw.LotNo = PurDetails.LotNo
                                        and Inw.Mark = PurDetails.Mark
                                        and Inw.ItemCode = PurDetails.ItemCode) as Inward, 

                                (SELECT IFNULL( sum(outward.Qty),   0)  
                                        from SaleDetails outward
                                        where outward.BillDate between '$fromYear' and '$toYear'
                                        and outward.LotNo = PurDetails.LotNo
                                        and outward.ItemMark = PurDetails.Mark
                                        and outward.ItemCode = PurDetails.ItemCode) as Outward, 

                                (
                                                (select IFNULL( sum(op.Qty),   0) 
                                                        FROM PurDetails op
                                                        where GoodsRcptDate < '$fromYear'
                                                                and op.LotNo = PurDetails.LotNo
                                                                and op.Mark = PurDetails.Mark
                                                                and op.ItemCode = PurDetails.ItemCode)                         
                                +
                                                (select IFNULL( sum(Inw.Qty),   0) 
                                                        FROM PurDetails Inw
                                                        where GoodsRcptDate between '$fromYear' and '$toYear'
                                                                and Inw.LotNo = PurDetails.LotNo
                                                                and Inw.Mark = PurDetails.Mark
                                                                and Inw.ItemCode = PurDetails.ItemCode) 
                                -
                                                (SELECT IFNULL( sum(outward.Qty),   0)  
                                                                from SaleDetails outward
                                                        where outward.BillDate between '$fromYear' and '$toYear'
                                                                and outward.LotNo = PurDetails.LotNo
                                                                and outward.ItemMark = PurDetails.Mark
                                                                and outward.ItemCode = PurDetails.ItemCode)
                                ) as Closing,
                                IDNumber as 'Entry#', 
                                DATE_FORMAT(GoodsRcptDate,'%d-%m-%Y') as 'Date'
                                
                        FROM PurDetails, ItemMaster
                        where PurDetails.ItemCode = ItemMaster.ItemCode
                        and PurDetails.CoID = ItemMaster.CoID
                        and PurDetails.WorkYear = ItemMaster.WorkYear
                        and PurDetails.CoID = '$CoID'
                        and PurDetails.WorkYear = '$WorkYear'
                        order by ItemMaster.ItemName, 
                        CAST(LotNo AS Integer), Mark                        
                ";

                $query = $this->db->query($sql);
                $result = $query->result();
                return $result;
        }

        public function getGodownData($GID)
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
                and GodownID='$GID'
                ";
                $query = $this->db->query($sql);
                $result = $query->result();
                return $result;
        }
        public function lastConv()
        {
                $CoID = $this->session->userdata('CoID');
                $WorkYear = $this->session->userdata('WorkYear');
                $sql = "SELECT LastConvId
                        from CompData
                        where COID='$CoID'
                        and WorkYear='$WorkYear' 
                ";
                $query = $this->db->query($sql);
                $result = $query->result();
                $NewValue = IntVal($result[0]->LastConvId) + 1;

                $multi_where = array('CoID' => $CoID, 'WorkYear' => $WorkYear);
                $data2 = array('LastConvId' => $NewValue);
                $this->db->where($multi_where);
                $this->db->update('CompData', $data2);

                return strval($NewValue);
        }
        public function getTableData($ID, $Type, $CoID, $WorkYear)
        {
                $sql = "SELECT CM.IDNumber as MasterID,
		CT.IDNumber,
                CT.ConvInd,
		CT.ItemCode,
		(select ItemName
                        from ItemMaster 
                        where ItemMaster.CoID=CT.CoID
                        and ItemMaster.WorkYear=CT.WorkYear
                        and ItemMaster.ItemCode=CT.ItemCode) ItemName,
                CT.Mark,
                (select Packing
                        from ItemMaster 
                        where ItemMaster.CoID=CT.CoID
                        and ItemMaster.WorkYear=CT.WorkYear
                        and ItemMaster.ItemCode=CT.ItemCode) Packing,  
                (select UOM
                        from ItemMaster 
                        where ItemMaster.CoID=CT.CoID
                        and ItemMaster.WorkYear=CT.WorkYear
                        and ItemMaster.ItemCode=CT.ItemCode) UOM,
                CT.LotNo,
                CT.APMCInd,
                CT.ETAXInd,
                CT.Weight,
                CT.QTY,
                CT.Rate,
                CT.GRcptDate,
                CT.RentDate,
                CT.GdnRate,
                CT.Commission,
                CT.TapaleeAC,
                CT.PartyCode
                from ConvTran CT,ConvMast CM
                where CT.CoID=CM.CoID
                        and CT.WorkYear=CM.WorkYear
                        and CT.RefIDNumber=CM.IDNumber
                        and CM.IDNumber='$ID'
                        and CT.ConvInd='$Type'
                        and CM.WorkYear='$WorkYear'
                        and CM.CoID='$CoID'
                ";
                $query = $this->db->query($sql);
                $result = $query->result();
                return $result;
        }
}
