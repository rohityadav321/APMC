select
0 as `IDNumber`,
PurDetails.CoID as 'CoID',
PurDetails.WorkYear as 'WorkYear',
PurDetails.IDNumber as `DocNo`,
PurHeader.GoodsRcptDate as `ACCDate`,
'PR' as `BookCode`,
(PurDetails.Amount + PurDetails.ContChg + (PurDetails.AddAmt - PurDetails.LessAmt) + (PurDetails.OtherAdd - PurDetails.LessCharges) ) as `ACCAmount`,
(select PurAccount
from PRGET_ACCode
where 
    PRGET_ACCode.CoId = PurDetails.CoID
and PRGET_ACCode.WorkYear = PurDetails.WorkYear
and PRGET_ACCode.IDNumber = PurDetails.IDNumber
and PRGET_ACCode.ItemCode = PurDetails.ItemCode
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

and PurHeader.CoId = 'MC'
and PurHeader.WorkYear = '2020-21'
and PurDetails.IDNumber = 51

UNION 

select
0 as `IDNumber`,
PurDetails.CoID as 'CoID',
PurDetails.WorkYear as 'WorkYear',
PurDetails.IDNumber as `DocNo`,
PurHeader.GoodsRcptDate as `ACCDate`,
'PR' as `BookCode`,
PurDetails.CGSTAmt as `ACCAmount`,
(select TaxCode
from PRGET_TaxCode
where 
    PRGET_TaxCode.CoId = PurDetails.CoID
and PRGET_TaxCode.WorkYear = PurDetails.WorkYear
and PRGET_TaxCode.IDNumber = PurDetails.IDNumber
and PRGET_TaxCode.ItemCode = PurDetails.ItemCode
) as `TaxCode`,
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
and PurHeader.CoId = 'MC'
and PurHeader.WorkYear = '2020-21'
and PurDetails.IDNumber = 51

