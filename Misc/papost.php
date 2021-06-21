select
0 as `IDNumber`,
PurDetails.CoID as 'CoID',
PurDetails.WorkYear as 'WorkYear',
PurDetails.IDNumber as `DocNo`,
PurHeader.GoodsRcptDate as `ACCDate`,
'PR' as `BookCode`,
(PurDetails.Amount + PurDetails.ContChg + (PurDetails.AddAmt - PurDetails.LessAmt) + (PurDetails.OtherAdd - PurDetails.LessCharges) ) as `ACCAmount`,
(
Select ItemMaster.PurAccount
from ItemMaster
where ItemMaster.ItemCode = PurDetails.ItemCode
and ItemMaster.CoID = PurDetails.CoID
and ItemMaster.WorkYear = PurDetails.WorkYear
) as `ACCode`,
'DR' as `DRCR`,
'' as `ChqNo`,
PurDetails.LotNo as `LotNo`,
'' as `ALotNo`,
'' as `ChqBank`,
'' as `SlipNo` ,
PurHeader.InvoiceNo as `InvoiceNo`,
' ' as `BillNo`,
'' as `OppCode`,
'' as `RefIDNo` ,
'' as `UTRNo` ,
'' as `ClrType`,
'' as `ClrDate` ,
'' as `CommDate` ,
'' as `EntryType` ,
'' as `EntryNo` ,
'' as `IndNarration`,
'' as `ContraEntry` ,
'' as `RecordNo` ,
'' as `AddedBy` ,
'' as `AddedOn`,
'' as `ModifiedBy`,
'' as `ModifiedOn` ,
'' as `LockedBy`
from PurDetails, PurHeader
where PurHeader.CoID = PurDetails.CoID
and PurHeader.WorkYear = PurDetails.WorkYear
and PurHeader.RefIDNumber= PurDetails.IDNumber