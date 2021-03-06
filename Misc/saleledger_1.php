CREATE OR REPLACE VIEW FinalSaleLedger AS
select
0 as `IDNumber`,
SaleDetails.CoID as 'CoID',
SaleDetails.WorkYear as 'WorkYear',
SaleDetails.BillNo as `DocNo`,
SaleMast.BillDate as `ACCDate`,
'SR' as `BookCode`,
(
(SaleDetails.ItemAmt + SaleDetails.ContChrg +SaleDetails.AddAmt + SaleDetails.lessAmt +SaleDetails.LagaAmt - SaleDetails.DiscAmt)
+ (SaleDetails.CGSTAmt + SaleDetails.SGSTAmt + SaleDetails.IGSTAmt + SaleDetails.APMCChrg + SaleDetails.TCSAmount )
) as `ACCAmount`,
SaleMast.DebtorID as 'ACCode',
'DR' as `DRCR`,
'' as `ChqNo`,
SaleDetails.LotNo as `LotNo`,
'' as `ALotNo`,
'' as `ChqBank`,
'' as `SlipNo` ,
SaleMast.BillNo as `InvoiceNo`,
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
from SaleDetails, SaleMast
where SaleMast.CoID = SaleDetails.CoID
and SaleMast.WorkYear = SaleDetails.WorkYear
and SaleMast.BillNo = SaleDetails.BillNo

UNION

select
0 as `IDNumber`,
SaleDetails.CoID as 'CoID',
SaleDetails.WorkYear as 'WorkYear',
SaleDetails.BillNo as `DocNo`,
SaleMast.BillDate as `ACCDate`,
'SR' as `BookCode`,
(
SaleDetails.ItemAmt + SaleDetails.ContChrg +SaleDetails.AddAmt + SaleDetails.lessAmt +SaleDetails.LagaAmt - SaleDetails.DiscAmt
) as `ACCAmount`,
(select SalesCode
from ItemMaster
Where ItemMaster.ItemCode = SaleDetails.ItemCode
and ItemMaster.CoID = SaleDetails.CoID
and ItemMaster.WorkYear = SaleDetails.WorkYear
) as 'ACCode',
'CR' as `DRCR`,
'' as `ChqNo`,
SaleDetails.LotNo as `LotNo`,
'' as `ALotNo`,
'' as `ChqBank`,
'' as `SlipNo` ,
SaleMast.BillNo as `InvoiceNo`,
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
from SaleDetails, SaleMast
where SaleMast.CoID = SaleDetails.CoID
and SaleMast.WorkYear = SaleDetails.WorkYear
and SaleMast.BillNo = SaleDetails.BillNo


UNION

select
0 as `IDNumber`,
SaleDetails.CoID as 'CoID',
SaleDetails.WorkYear as 'WorkYear',
SaleDetails.BillNo as `DocNo`,
SaleMast.BillDate as `ACCDate`,
'SR' as `BookCode`,
SaleDetails.CGSTAmt as `ACCAmount`,
(
select CGSTSalCode
from TaxMaster
where TaxMaster.TaxCode in
( select TaxCode
from ItemMaster
Where ItemMaster.ItemCode = SaleDetails.ItemCode
and ItemMaster.CoID = SaleDetails.CoID
and ItemMaster.WorkYear = SaleDetails.WorkYear
))
as 'ACCode',
'CR' as `DRCR`,
'' as `ChqNo`,
SaleDetails.LotNo as `LotNo`,
'' as `ALotNo`,
'' as `ChqBank`,
'' as `SlipNo` ,
SaleMast.BillNo as `InvoiceNo`,
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
from SaleDetails, SaleMast
where SaleMast.CoID = SaleDetails.CoID
and SaleMast.WorkYear = SaleDetails.WorkYear
and SaleMast.BillNo = SaleDetails.BillNo

UNION

select
0 as `IDNumber`,
SaleDetails.CoID as 'CoID',
SaleDetails.WorkYear as 'WorkYear',
SaleDetails.BillNo as `DocNo`,
SaleMast.BillDate as `ACCDate`,
'SR' as `BookCode`,
SaleDetails.SGSTAmt as `ACCAmount`,
(
select SGSTSalCode
from TaxMaster
where TaxMaster.TaxCode in
( select TaxCode
from ItemMaster
Where ItemMaster.ItemCode = SaleDetails.ItemCode
and ItemMaster.CoID = SaleDetails.CoID
and ItemMaster.WorkYear = SaleDetails.WorkYear
)
)
as 'ACCode',
'CR' as `DRCR`,
'' as `ChqNo`,
SaleDetails.LotNo as `LotNo`,
'' as `ALotNo`,
'' as `ChqBank`,
'' as `SlipNo` ,
SaleMast.BillNo as `InvoiceNo`,
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
from SaleDetails, SaleMast
where SaleMast.CoID = SaleDetails.CoID
and SaleMast.WorkYear = SaleDetails.WorkYear
and SaleMast.BillNo = SaleDetails.BillNo

UNION

select
0 as `IDNumber`,
SaleDetails.CoID as 'CoID',
SaleDetails.WorkYear as 'WorkYear',
SaleDetails.BillNo as `DocNo`,
SaleMast.BillDate as `ACCDate`,
'SR' as `BookCode`,
SaleDetails.IGSTAmt as `ACCAmount`,
(
select IGSTSalCode
from TaxMaster
where TaxMaster.TaxCode in
( select TaxCode
from ItemMaster
Where ItemMaster.ItemCode = SaleDetails.ItemCode
and ItemMaster.CoID = SaleDetails.CoID
and ItemMaster.WorkYear = SaleDetails.WorkYear
))
as 'ACCode',
'CR' as `DRCR`,
'' as `ChqNo`,
SaleDetails.LotNo as `LotNo`,
'' as `ALotNo`,
'' as `ChqBank`,
'' as `SlipNo` ,
SaleMast.BillNo as `InvoiceNo`,
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
from SaleDetails, SaleMast
where SaleMast.CoID = SaleDetails.CoID
and SaleMast.WorkYear = SaleDetails.WorkYear
and SaleMast.BillNo = SaleDetails.BillNo

UNION

select
0 as `IDNumber`,
SaleDetails.CoID as 'CoID',
SaleDetails.WorkYear as 'WorkYear',
SaleDetails.BillNo as `DocNo`,
SaleMast.BillDate as `ACCDate`,
'SR' as `BookCode`,
SaleDetails.APMCChrg as `ACCAmount`,
(
select APTAcc_sale
from AccSettings
Where AccSettings.CoId = SaleDetails.CoID
and AccSettings.WorkYear = SaleDetails.WorkYear
)
as 'ACCode',
'CR' as `DRCR`,
'' as `ChqNo`,
SaleDetails.LotNo as `LotNo`,
'' as `ALotNo`,
'' as `ChqBank`,
'' as `SlipNo` ,
SaleMast.BillNo as `InvoiceNo`,
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
from SaleDetails, SaleMast
where SaleMast.CoID = SaleDetails.CoID
and SaleMast.WorkYear = SaleDetails.WorkYear
and SaleMast.BillNo = SaleDetails.BillNo

UNION

select
0 as `IDNumber`,
SaleDetails.CoID as 'CoID',
SaleDetails.WorkYear as 'WorkYear',
SaleDetails.BillNo as `DocNo`,
SaleMast.BillDate as `ACCDate`,
'SR' as `BookCode`,
SaleDetails.TCSAmount as `ACCAmount`,
(
select TCSSales
from AccSettings
Where AccSettings.CoId = SaleDetails.CoID
and AccSettings.WorkYear = SaleDetails.WorkYear
)
as 'ACCode',
'CR' as `DRCR`,
'' as `ChqNo`,
SaleDetails.LotNo as `LotNo`,
'' as `ALotNo`,
'' as `ChqBank`,
'' as `SlipNo` ,
SaleMast.BillNo as `InvoiceNo`,
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
from SaleDetails, SaleMast
where SaleMast.CoID = SaleDetails.CoID
and SaleMast.WorkYear = SaleDetails.WorkYear
and SaleMast.BillNo = SaleDetails.BillNo


CONCAT((SELECT
`ItemMaster`.`ItemName`
FROM
`ItemMaster`
WHERE
((`ItemMaster`.`ItemCode` = `SaleDetails`.`ItemCode`)
AND (`ItemMaster`.`CoID` = `SaleDetails`.`CoID`)
AND (`ItemMaster`.`WorkYear` = `SaleDetails`.`WorkYear`))),
' LotNo: ',
`SaleDetails`.`LotNo`,
' Mark: ',
`SaleDetails`.`ItemMark`,
' Qty: ',
`SaleDetails`.`Qty`) AS `IndNarration`