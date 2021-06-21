select
0 as `IDNumber`,
'MC' as `CoID`,
'2020-21' as `WorkYear`,
PurDetails.IDNumber as `DocNo`,
PurHeader.GoodsRcptDate as `ACCDate`,
'PR' as `BookCode`,
(
PurDetails.Amount + PurDetails.ContChg + (PurDetails.AddAmt - PurDetails.LessAmt) + (PurDetails.OtherAdd - PurDetails.LessCharges) ) as `ACCAmount`,
(select ItemMaster.PurAccount
from PurDetails PD1, ItemMaster
where PD1.ItemCode = ItemMaster.ItemCode
and PD1.CoID = ItemMaster.CoID
and PD1.WorkYear = ItemMaster.WorkYear
and PD1.IDNumber = PurHeader.RefIDNumber
and PD1.ItemCode = PurDetails.ItemCode
and PD1.CoID = 'MC'
and PD1.WorkYear = '2020-21') as `ACCode`,
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
and PurDetails.CoID = 'MC'
and PurDetails.WorkYear = '2020-21'
and PurDetails.IDNumber = 40

UNION


select
0 as `IDNumber`,
'MC' as `CoID`,
'2020-21' as `WorkYear`,
PurDetails.IDNumber as `DocNo`,
PurHeader.GoodsRcptDate as `ACCDate`,
'PR' as `BookCode`,
( PurDetails.CGSTAmt) as `ACCAmount`,
(select TaxMaster.CGSTPurCode
from ItemMaster, TaxMaster,PurDetails PD1
where PD1.ItemCode = ItemMaster.ItemCode
and ItemMaster.TaxCode = TaxMaster.TaxCode
and PD1.CoID = ItemMaster.CoID
and PD1.WorkYear = ItemMaster.WorkYear
and PD1.IDNumber = PurHeader.RefIDNumber
and PD1.ItemCode = PurDetails.ItemCode
and PD1.CoID = 'MC'
and PD1.WorkYear = '2020-21' ) as `ACCode`,
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
from PurHeader, PurDetails
where PurHeader.CoID = PurDetails.CoID
and PurHeader.WorkYear = PurDetails.WorkYear
and PurHeader.RefIDNumber= PurDetails.IDNumber
and PurHeader.CoID = 'MC'
and PurHeader.WorkYear = '2020-21'
and PurHeader.RefIDNumber = 40

UNION



select
0 as `IDNumber`,
'MC' as `CoID`,
'2020-21' as `WorkYear`,
PurDetails.IDNumber as `DocNo`,
PurHeader.GoodsRcptDate as `ACCDate`,
'PR' as `BookCode`,
( PurDetails.SGSTAmt) as `ACCAmount`,
(select TaxMaster.SGSTPurCode
from ItemMaster, TaxMaster,PurDetails PD1
where PD1.ItemCode = ItemMaster.ItemCode
and ItemMaster.TaxCode = TaxMaster.TaxCode
and PD1.CoID = ItemMaster.CoID
and PD1.WorkYear = ItemMaster.WorkYear
and PD1.IDNumber = PurHeader.RefIDNumber
and PD1.ItemCode = PurDetails.ItemCode
and PD1.CoID = 'MC'
and PD1.WorkYear = '2020-21' ) as `ACCode`,
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
from PurHeader, PurDetails
where PurHeader.CoID = PurDetails.CoID
and PurHeader.WorkYear = PurDetails.WorkYear
and PurHeader.RefIDNumber= PurDetails.IDNumber
and PurHeader.CoID = 'MC'
and PurHeader.WorkYear = '2020-21'
and PurHeader.RefIDNumber = 40


UNION


select
0 as `IDNumber`,
'MC' as `CoID`,
'2020-21' as `WorkYear`,
PurDetails.IDNumber as `DocNo`,
PurHeader.GoodsRcptDate as `ACCDate`,
'PR' as `BookCode`,
( PurDetails.APMCChg) as `ACCAmount`,
(select APTAcc_Sale
from AccSettings
where PurDetails.CoID = AccSettings.CoID
and PurDetails.WorkYear = AccSettings.WorkYear
and PurDetails.IDNumber = '40'
and PurDetails.CoID = 'MC'
and PurDetails.WorkYear = '2020-21' ) as `ACCode`,
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
from PurHeader, PurDetails
where PurHeader.CoID = PurDetails.CoID
and PurHeader.WorkYear = PurDetails.WorkYear
and PurHeader.RefIDNumber= PurDetails.IDNumber
and PurHeader.CoID = 'MC'
and PurHeader.WorkYear = '2020-21'
and PurHeader.RefIDNumber = 40


UNION


select
0 as `IDNumber`,
'MC' as `CoID`,
'2020-21' as `WorkYear`,
PurDetails.IDNumber as `DocNo`,
PurHeader.GoodsRcptDate as `ACCDate`,
'PR' as `BookCode`,
( PurDetails.TCSAmount) as `ACCAmount`,
(select TCSPurchase
from AccSettings
where PurDetails.CoID = AccSettings.CoID
and PurDetails.WorkYear = AccSettings.WorkYear
and PurDetails.IDNumber = '40'
and PurDetails.CoID = 'MC'
and PurDetails.WorkYear = '2020-21' ) as `ACCode`,
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
from PurHeader, PurDetails
where PurHeader.CoID = PurDetails.CoID
and PurHeader.WorkYear = PurDetails.WorkYear
and PurHeader.RefIDNumber= PurDetails.IDNumber
and PurHeader.CoID = 'MC'
and PurHeader.WorkYear = '2020-21'
and PurHeader.RefIDNumber = 40


UNION


select
0 as `IDNumber`,
'MC' as `CoID`,
'2020-21' as `WorkYear`,
PurDetails.IDNumber as `DocNo`,
PurHeader.GoodsRcptDate as `ACCDate`,
'PR' as `BookCode`,
(
( PurDetails.Amount + PurDetails.ContChg + (PurDetails.AddAmt - PurDetails.LessAmt) + (PurDetails.OtherAdd - PurDetails.LessCharges) ) +
PurDetails.CGSTAmt + PurDetails.SGSTAmt + PurDetails.APMCChg + PurDetails.TCSAmount
) as `ACCAmount`,
PurHeader.PartyCode as `ACCode`,
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
from PurHeader, PurDetails
where PurHeader.CoID = PurDetails.CoID
and PurHeader.WorkYear = PurDetails.WorkYear
and PurHeader.RefIDNumber= PurDetails.IDNumber
and PurHeader.CoID = 'MC'
and PurHeader.WorkYear = '2020-21'
and PurHeader.RefIDNumber = 40


