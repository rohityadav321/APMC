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
from PurDetails, ItemMaster
where PurDetails.ItemCode = ItemMaster.ItemCode
and PurDetails.CoID = ItemMaster.CoID
and PurDetails.WorkYear = ItemMaster.WorkYear
and PurDetails.IDNumber = PurHeader.RefIDNumber
and PurDetails.CoID = 'MC'
and PurDetails.WorkYear = '2020-21') as `ACCode`,
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
and PurHeader.RefIDNumber = 51


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
from PurDetails, ItemMaster, TaxMaster
where PurDetails.ItemCode = ItemMaster.ItemCode
and PurDetails.CoID = ItemMaster.CoID
and PurDetails.WorkYear = ItemMaster.WorkYear
and ItemMaster.TaxCode = TaxMaster.TaxCode
and PurDetails.IDNumber = '51'
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
and PurHeader.RefIDNumber = 51

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
from PurDetails, ItemMaster, TaxMaster
where PurDetails.ItemCode = ItemMaster.ItemCode
and PurDetails.CoID = ItemMaster.CoID
and PurDetails.WorkYear = ItemMaster.WorkYear
and ItemMaster.TaxCode = TaxMaster.TaxCode
and PurDetails.IDNumber = '51'
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
and PurHeader.RefIDNumber = 51


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
and PurDetails.IDNumber = '51'
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
and PurHeader.RefIDNumber = 51


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
and PurDetails.IDNumber = '51'
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
and PurHeader.RefIDNumber = 51


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
and PurHeader.RefIDNumber = 51
