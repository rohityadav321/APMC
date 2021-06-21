Create or Replace View PRLedgerAPMC as
select
0 as `IDNumber`,
PurDetails.CoID as 'CoID',
PurDetails.WorkYear as 'WorkYear',
PurDetails.IDNumber as `DocNo`,
PurHeader.GoodsRcptDate as `ACCDate`,
'PR' as `BookCode`,
PurDetails.APMCChg as `ACCAmount`,
( select ACCode
from PRGetAPMC
Where PRGetAPMC.CoId = PurDetails.CoID
and PRGetAPMC.WorkYear = PurDetails.WorkYear
and PRGetAPMC.IDNumber = PurDetails.IDNumber
and PRGetAPMC.ItemCode = PurDetails.ItemCode
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

-- and PurHeader.CoID = 'MC'
-- and PurHeader.WorkYear = '2020-21'
-- and PurHeader.RefIDNumber = 51



Create or Replace View PRLedgerTCS as
select
0 as `IDNumber`,
PurDetails.CoID as 'CoID',
PurDetails.WorkYear as 'WorkYear',
PurDetails.IDNumber as `DocNo`,
PurHeader.GoodsRcptDate as `ACCDate`,
'PR' as `BookCode`,
PurDetails.TCSAmount as `ACCAmount`,
( select ACCode
from PRGetTCS
Where PRGetTCS.CoId = PurDetails.CoID
and PRGetTCS.WorkYear = PurDetails.WorkYear
and PRGetTCS.IDNumber = PurDetails.IDNumber
and PRGetTCS.ItemCode = PurDetails.ItemCode
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

-- and PurHeader.CoID = 'MC'
-- and PurHeader.WorkYear = '2020-21'
-- and PurHeader.RefIDNumber = 51



Create or Replace View PRLedgerNetPay as
select
0 as `IDNumber`,
PurDetails.CoID as 'CoID',
PurDetails.WorkYear as 'WorkYear',
PurDetails.IDNumber as `DocNo`,
PurHeader.GoodsRcptDate as `ACCDate`,
'PR' as `BookCode`,
(
(( PurDetails.Amount + PurDetails.ContChg + (PurDetails.AddAmt - PurDetails.LessAmt) + (PurDetails.OtherAdd - PurDetails.LessCharges) ) +
PurDetails.CGSTAmt + PurDetails.SGSTAmt + PurDetails.APMCChg + PurDetails.TCSAmount)*-1
) as `ACCAmount`,
PurHeader.PartyCode as `ACCode`,
PurDetails.ItemCode as 'ItemCode',
'CR' as `DRCR`,
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

-- and PurHeader.CoID = 'MC'
-- and PurHeader.WorkYear = '2020-21'
-- and PurHeader.RefIDNumber = 51