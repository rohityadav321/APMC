<?php
include "header-form.php";

$id = 'New';
$newid = $id;

$timezone = "Asia/Colombo";
date_default_timezone_set($timezone);
$today = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link href="<?php echo base_url("assets/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css" />

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/media/css/jquery.dataTables.min.css" rel="stylesheet">
    <title>Sales Return Entry</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            /* font-size: 1.15em; */
            /* background-color: #90A0E5; */
            font-size: 12px;
            /* color: #011b52; */
        }

        .title {
            /* padding-top: 20px; */
            transform: translateY(-10px);
            font-family: "Gill Sans", sans-serif;
            font-size: 25px;
        }

        .idnum {
            font-weight: bold;
            font-size: 1.2em;
        }

        .sectionOne {
            display: flex;
            justify-content: flex-start;
            height: 23vh;
        }

        .sectionTwo {
            display: flex;
            justify-content: space-between;
            height: 23vh;
        }

        .Container {
            color: #011b52;
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
        }

        .Container .sectionOne .s1 {
            width: 60vw;
        }

        .Container .sectionOne .s2 {
            width: 40vw;
        }

        .Container .sectionOne .s3 {
            width: 60vw;
        }

        .Container .sectionOne .s4 {
            width: 40vw;
        }

        label {
            width: 100px;
            display: inline-block;
            padding-left: 5px;
        }

        input {
            display: inline-block;
            width: 140px;
            /* Univ width for the inputs */
            padding: 2px;
            border-color: white;
            box-shadow: inset .1px 0 0 .1px gray;
        }

        .s1 {
            padding: 5px;
        }

        .s2 {
            border: .5px solid rgb(155, 155, 180);
            padding: 5px;
            height: 170px;
        }

        .s4 {
            padding-right: 10px;
            padding-top: 30px;
        }

        .s1 input {
            /* background: rgb(165, 165, 255); */
            background-color: #AED6F1;
        }

        .s2 input {
            /* background: rgb(203, 203, 245); */
            background-color: #AED6F1;
            width: 150px;
        }

        .Table {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .Table-2 {
            display: flex;
            justify-content: center;
            align-items: center;

        }

        table {
            text-align: center;
            border: .5px solid gray;
            border-collapse: collapse;

        }

        thead {
            background: lightsalmon;
        }

        .tr td {
            background: rgb(255, 122, 69);
            font-size: 1em;
            padding: 5px 20px;
        }

        th {
            padding: 5px;
        }

        table input {
            width: 70px;
        }

        .text-center {
            width: 94px;

        }

        .head {
            width: 100%;
            height: 50px;
            background: #5b7ac9;
            margin-top: 0;
            padding: 20px;
            display: inline-block;

        }

        .head>span {
            font: 25px bold;
        }

        .pull-left {
            position: absolute;
            right: 20%;
            top: -10px;
        }
    </style>
</head>
<script>
    // $(document).ready(function() {
    //     document.getElementById("buttonVisibility").value = "ADD"
    // });

    // enter key logic

    var idarray = [
        "CashDate",
        "refBillNo",
        "HelMajuri1",
        "OtherChrg",
        "RoffAmt",
        "GdnTitle",
        "Qty",
        "GrossWt",
        "NetWt",
        "NApmc",
        "CCharg",
    ];




    function focusnext(e) {
        // try {
        // if (document.getElementById("buttonVisibility").value == "Add") {
        for (var i = 0; i < idarray.length; i++) {
            if (e.keyCode === 13 && e.target.id === idarray[i]) {
                document.querySelector(`#${idarray[i + 1]}`).focus();
                // document.querySelector('#${idarray[i + 1]}').focus();
            }
            // }
            //     }
            //     if (document.getElementById("buttonVisibility").value == "Update") {
            //         for (var i = 0; i < updateArray.length; i++) {
            //             if (e.keyCode === 13 && e.target.id === updateArray[i]) {
            //                 document.querySelector(`#${updateArray[i + 1]}`).focus();
            //                 // document.querySelector('#${idarray[i + 1]}').focus();
            //             }
            //         }
            //     }
            // } catch (error) {
            //     alert("Error:" + error);
        }
    }
</script>
<script>
    // calculate Gross wt,Net wt,ContCharges
    function calcItem(e) {

        const BalQty = parseFloat($('#BalQty').val());
        const weight = parseFloat($('#Weight').val());
        const Packing = parseFloat($('#Packing').val());
        const PackingChrg = parseFloat($('#PackingChrg').val());
        const Qty = parseFloat($('#Qty').val());
        const code = e.keyCode || e.which;

        if (code == 13 || code === 9) {

            if (Qty != "") {
                if (Qty > BalQty) {
                    alert('Quantity should not be greater than Balance Quantity! ');
                    $('#Qty').focus();
                } else {
                    const net = (Packing - weight).toFixed(2);
                    const grosswt = (Qty * Packing).toFixed(2);
                    const Netwt = (Qty * net).toFixed(2);
                    const Cont = (Qty * PackingChrg).toFixed(2);

                    $('#GrossWt').val(grosswt);
                    $('#NetWt').val(Netwt);
                    $('#CCharg').val(Cont);
                    $('#GrossWt').focus();

                }
            }
        }
    }
    // calculate Gross Amt,Net Amt
    function calcgross(e) {
        const code = e.keyCode || e.which;
        if (code == 13 || code === 9) {
            const netwt = parseFloat($('#NetWt').val());
            const Rate = parseFloat($('#Rate').val());
            //  const netwt = $('#NetWt').val();
            const Ntamt = ((netwt * Rate) / 100).toFixed(2);

            $('#grAmt').val(Ntamt);
            $('#NetAmt').val(Ntamt);
            $('#NApmc').focus();
        }

    }


    // calculate APMC, Gst ,ReturnAmt
    function calcNet(e) {
        const code = e.keyCode || e.which;
        if (code == 13 || code === 9) {
            const grAmt = parseFloat($('#grAmt').val());
            const ApmcRate = parseFloat($("#ApmcRate").val());
            var Cont;
            if ($('#CCharg').val() == "") {
                var Cont = 0;
            } else {
                var Cont = parseFloat($('#CCharg').val());

            }
            $('#NetAmt').val(grAmt + Cont);
            $('#grossamt').val((grAmt).toFixed(2));
            var APMCCharge;
            const grossAmt = parseFloat($('#grossamt').val());
            if ($('#OApmc').val() == 'Y' || $('#NApmc').val() == 'Y') {
                APMCCharge = parseFloat((grossAmt * ApmcRate) / 100).toFixed(2);
            } else {
                APMCCharge = parseFloat(0);
            }

            $('#taxableamt').val(parseFloat(grossAmt) + parseFloat(APMCCharge));
            $('#APMCSChg').val(APMCCharge);

            const cgstrate = parseFloat($("#TaxRate").val()) / 2;
            const sgstrate = parseFloat($("#TaxRate").val()) / 2;
            const igstrate = parseFloat($("#TaxRate").val());
            const taxableamt = parseFloat($('#taxableamt').val());

            if ($('#StateCode').val() == 27 || $('#StateCode').val() == "") {
                const cgst = parseFloat((taxableamt * cgstrate) / 100).toFixed(2);
                const sgst = parseFloat((taxableamt * sgstrate) / 100).toFixed(2);

                $('#cgstamt').val(cgst);
                $('#sgstamt').val(sgst);
                $("#igstamt").val("");

                const cgstamt = parseFloat($('#cgstamt').val());
                const sgstamt = parseFloat($('#sgstamt').val());

                $("#TotalTax").val((cgstamt + sgstamt).toFixed(2));

                const TotalTax = parseFloat($('#TotalTax').val());
                const ReturnAmt = (TotalTax + taxableamt);
                $("#ReturnAmt").val(ReturnAmt.toFixed(2));
            } else {
                const igst = ((taxableamt * igstrate) / 100).toFixed(2);

                $('#igstamt').val(igst);

                $("#cgstamt").val("");
                $("#sgstamt").val("");

                const igstamt = parseFloat($('#igstamt').val());

                $("#TotalTax").val(igstamt.toFixed(2));

                const TotalTax = igstamt;
                const ReturnAmt = (TotalTax + taxableamt);

                $("#ReturnAmt").val(ReturnAmt.toFixed(2));
            }

            $('#submit').focus();

        }

    }
</script>
<script>
    // ! <---Update the sales data - Rohit 2-6-21--->
    $(document).ready(function() {
        $("#RoffAmt").keydown(function(e) {
            var code = e.keyCode || e.which;
            if (code == 13 || code === 9) {
                var CashDate = $('#CashDate').val();
                var BillNo = $('#refBillNo').val();
                var BillDate = $('#BillDate').val();
                var PartyCode = $('#PartyCode').val();
                var ReturnAcc = $('#RetAccode').val();
                var BillAmt = $('#BillAmt').val();
                var CashCode = $('#ACCode').val();
                var Taxcode = $('#TaxCode').val();
                // var SaleType = $('#PartyCode').val();
                var MudiBazar = $('#MudiBazar').val();
                // var EntryType = $('#PartyCode').val();
                // var SalRAmt = $('#PartyCode').val();
                var ItemAmt = $('#Rate').val();
                // var Lagaamt = $('#PartyCode').val();
                var ContAmt = $('#CCharg').val();
                var DiscAmt = $('#Discount').val();
                var APMCAmt = $('#APMCSChg').val();
                // var OAPMCAmt = $('#PartyCode').val();
                // var EtaxAmt = $('#PartyCode').val();
                // var OEtaxAmt = $('#PartyCode').val();
                var AddAmt = $('#addchargeamt').val();
                var LessAmt = $('#lessamt').val();
                var TaxableAmt = $('#taxableamt').val();
                var TaxAmt = $('#TotalTax').val();
                var CGSTAmt = $('#cgstamt').val();
                var SGSTAmt = $('#sgstamt').val();
                var IGSTAmt = $('#igstamt').val();
                var HMajuAmt = $('#HelMajuri1').val();
                var OChrgamt = $('#OtherChrg').val();
                var RoffAmt = $('#RoffAmt').val();
                // var Haste = $('#PartyCode').val();
                var BrokCode = $('#BrokerID').val();
                // var BrokAmt = $('#PartyCode').val();


                $.ajax({
                    url: "<?= base_url() ?>index.php/SalesReturnController/SalesReturnInsertData",
                    data: {
                        CashDate: CashDate,
                        BillNo: BillNo,
                        BillDate: BillDate,
                        PartyCode: PartyCode,
                        ReturnAcc: ReturnAcc,
                        BillAmt: BillAmt,
                        CashCode: CashCode,
                        Taxcode: Taxcode,
                        // SaleType: SaleType,
                        MudiBazar: MudiBazar,
                        // EntryType: EntryType,
                        // SalRAmt: SalRAmt,
                        ItemAmt: ItemAmt,
                        // Lagaamt: Lagaamt,
                        ContAmt: ContAmt,
                        DiscAmt: DiscAmt,
                        APMCAmt: APMCAmt,
                        // OAPMCAmt: OAPMCAmt,
                        // EtaxAmt: EtaxAmt,
                        // OEtaxAmt: OEtaxAmt,
                        AddAmt: AddAmt,
                        LessAmt: LessAmt,
                        TaxableAmt: TaxableAmt,
                        TaxAmt: TaxAmt,
                        CGSTAmt: CGSTAmt,
                        SGSTAmt: SGSTAmt,
                        IGSTAmt: IGSTAmt,
                        HMajuAmt: HMajuAmt,
                        OChrgamt: OChrgamt,
                        RoffAmt: RoffAmt,
                        // Haste: Haste,
                        BrokCode: BrokCode,
                        // BrokAmt: BrokAmt,
                    },
                    type: "post",
                    dataType: "json",
                    cache: false,
                    success: function(result) {
                        alert("Data Inserted in SaleReturnMaster");
                        $('#IdNumber').val(result);
                        $('#GdnTitle').focus();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.responseText);
                    }

                });
            }
        })
    })
    // SalesReturn Detail Entry

    $(document).ready(function() {
        $("#submit").keydown(function(e) {
            var code = e.keyCode || e.which;
            if (code == 13 || code === 9) {
                var IDNumber = $('#IdNumber').val();
                var SalRetrnDt = $('#CashDate').val();
                var BillNo = $('#refBillNo').val();
                var BillDate = $('#BillDate').val();
                var GodownID = $('#GdnTitle').val();
                var LotNo = $('#LotNo').val();
                var CreditAcc = $('#CrAcc').val();
                var ItemCode = $('#ItemCode').val();
                var ItemMark = $('#ItemMark').val();
                var Qty = $('#Qty').val();
                var GrossWt = $('#GrossWt').val();
                var NetWt = $('#NetWt').val();
                var Rate = $('#Rate').val();
                var APMCIn = $('#OApmc').val();
                // var ETaxIn = $('#ETaxIn').val();
                // var ItemAmt = $('#').val();
                var ContChrg = $('#CCharg').val();
                // var LagaAmt = $('#').val();
                // var DiscRate = $('#').val();
                var DiscAmt = $('#Discount').val();
                var APMCChrg = $('#APMCSChg').val();
                // var APMCSChrg = $('#').val();
                // var OApmcTax = $('#').val();
                // var EntryTax = $('#').val();
                // var Oetax = $('#').val();
                var AddAmt = $('#addchargeamt').val();
                var LessAmt = $('#lessamt').val();
                var TaxableAmt = $('#taxableamt').val();
                var RetuTaxCode = $('#TaxCode').val();
                var TaxAmt = $('#TotalTax').val();
                var CGSTAmt = $('#cgstamt').val();
                var SGSTAmt = $('#sgstamt').val();
                var IGSTAmt = $('#igstamt').val();
                var SalRAmt = $('#ReturnAmt').val();
                // var PattiInd = $('#').val();
                var BrokerCode = $('#BrokerID').val();
                // var BrokInd = $('#').val();
                // var BrokRate = $('#').val();
                // var BrokAmt = $('#').val();
                var NAPMCIn = $('#NApmc').val();
                // var NEtaxIn = $('#').val();
                // var RDCODE1 = $('#').val();
                // var RDCODE2 = $('#').val();
                // var RDCODE3 = $('#').val();
                // var RDCODE4 = $('#').val();
                // var RDCODE5 = $('#').val();
                // var RDAmt1 = $('#').val();
                // var RDAmt2 = $('#').val();
                // var RDAmt3 = $('#').val();
                // var RDAmt4 = $('#').val();
                // var RDAmt5 = $('#').val();
                // var CreditAccAmt = $('#').val();
                // var EntryType = $('#').val();
                // var Haste = $('#').val();
                // var HelOthRo = $('#').val();

                $.ajax({
                    url: "<?= base_url() ?>index.php/SalesReturnController/SalesReturnInsertDetail",
                    data: {
                        IDNumber: IDNumber,
                        SalRetrnDt: SalRetrnDt,
                        BillNo: BillNo,
                        BillDate: BillDate,
                        GodownID: GodownID,
                        LotNo: LotNo,
                        CreditAcc: CreditAcc,
                        ItemCode: ItemCode,
                        ItemMark: ItemMark,
                        Qty: Qty,
                        GrossWt: GrossWt,
                        NetWt: NetWt,
                        Rate: Rate,
                        APMCIn: APMCIn,
                        // ETaxIn: ETaxIn,
                        // ItemAmt: ItemAmt,
                        ContChrg: ContChrg,
                        // LagaAmt: LagaAmt,
                        // DiscRate: DiscRate,
                        DiscAmt: DiscAmt,
                        APMCChrg: APMCChrg,
                        // APMCSChrg: APMCSChrg,
                        // OApmcTax: OApmcTax,
                        // EntryTax: EntryTax,
                        // Oetax: Oetax,
                        AddAmt: AddAmt,
                        LessAmt: LessAmt,
                        TaxableAmt: TaxableAmt,
                        RetuTaxCode: RetuTaxCode,
                        TaxAmt: TaxAmt,
                        CGSTAmt: CGSTAmt,
                        SGSTAmt: SGSTAmt,
                        IGSTAmt: IGSTAmt,
                        SalRAmt: SalRAmt,
                        // PattiInd: PattiInd,
                        BrokerCode: BrokerCode,
                        // BrokInd: BrokInd,
                        // BrokRate: BrokRate,
                        // BrokAmt: BrokAmt,
                        NAPMCIn: NAPMCIn,
                        // NEtaxIn: NEtaxIn,
                        // RDCODE1: RDCODE1,
                        // RDCODE2: RDCODE2,
                        // RDCODE3: RDCODE3,
                        // RDCODE4: RDCODE4,
                        // RDCODE5: RDCODE5,
                        // RDAmt1: RDAmt1,
                        // RDAmt2: RDAmt2,
                        // RDAmt3: RDAmt3,
                        // RDAmt4: RDAmt4,
                        // RDAmt5: RDAmt5,
                        // CreditAccAmt: CreditAccAmt,
                        // EntryType: EntryType,
                        // Haste: Haste,
                        // HelOthRo: HelOthRo,
                    },
                    type: "post",
                    dataType: "json",
                    cache: false,
                    success: function(result) {
                        // alert("Data Inserted in SaleReturnDetails");
                        // $('#GdnTitle').focus();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.responseText);
                    }

                });
            }
        })
    })
</script>
<script>
    function isupdateconfirm(id) {
        var idNum = id;
        $('#GdnTitle').focus();
        $.ajax({
            url: "<?= base_url() ?>index.php/SalesReturnController/getSalesDetails/" + idNum,
            data: {
                idNum: idNum
            },
            type: "post",
            dataType: "json",
            cache: false,
            success: function(result) {
                console.log(result);
                var data = result.SalesDetails[0];
                $('#GdnTitle').val(data.GodownID);
                $('#LotNo').val(data.LotNo);
                $('#CrAcc').val(data.CreditAcc);
                $('#ItemCode').val(data.ItemCode);
                $('#ItemMark').val(data.ItemMark);
                $('#Qty').val(data.SBal_Qty);
                $('#GrossWt').val(data.GrossWt);
                $('#NetWt').val(data.NetWt);
                $('#Rate').val(data.Rate);
                $('#OApmc').val(data.APMCIn);
                $('#grAmt').val(data.GrossAmt);
                $('#CCharg').val(data.ContChrg);
                $('#NetAmt').val(data.NetAmt);
                $('#TaxCode').val(data.TaxCode);
                $('#TaxTitle').val(data.TaxTitle);
                $('#TaxRate').val(data.TaxRate);
                $('#ApmcRate').val(data.ApmcRate);
                $('#Weight').val(data.weight);
                $('#Packing').val(data.Packing);
                $('#PackingChrg').val(data.PackingChrg);
                $('#BalQty').val(data.SBal_Qty);
            },
            error: function(errorThrown) {
                alert("Error: " + errorThrown);
            }
        });
    };
</script>
<script>
    // Disable Right Click to view source code
    document.addEventListener('contextmenu', event => event.preventDefault());

    // Disable ShortCut keys to view source code (67 = c, 86 = v, 85 = u, 117 = f6)
    document.onkeydown = function(e) {
        var message = 'Content is protected.';
        if (e.ctrlKey && (e.keyCode === 67 || e.keyCode === 86 || e.keyCode === 85 || e.keyCode === 117)) {
            alert(message);
            return false;
        } else {
            return true;
        }
    };

    // Disable F12 Key and Ctrl + shift + I combination
    $(document).keydown(function(event) {
        var message = 'Content is protected.';
        if (event.keyCode == 123) { // Prevent F12
            alert(message);
            return false;
        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
            alert(message);
            return false;
        }
    });
</script>

<script>
    //get the sales data with the help of reference bill number
    $(document).ready(function() {
        $("#refBillNo").keydown(function(e) {
            var code = e.keyCode || e.which;
            if (code == 13 || code === 9) {
                var refBillNo = $("#refBillNo").val();
                $.ajax({
                    url: "<?= base_url() ?>index.php/SalesReturnController/getBill",
                    data: {
                        refBillNo: refBillNo,
                    },
                    type: "post",
                    dataType: "json",
                    cache: false,
                    success: function(result) {
                        console.log(result);
                        var Bill = result.Bill[0];
                        if (Bill.Numbers == 0) {
                            alert("New Return");
                            $.ajax({
                                url: "<?= base_url() ?>index.php/SalesReturnController/getSalesDets",
                                data: {
                                    refBillNo: refBillNo,
                                },
                                type: "post",
                                dataType: "json",
                                cache: false,
                                success: function(result) {
                                    console.log(result);
                                    var data = result.SalesData;
                                    var content = '';

                                    for (var i = 0; i < data.length; i++) {
                                        content += '<tr class="blue">';
                                        content += '<td style="padding: 5px;color: #fff; font-size:15px;" id="widthh">' +
                                            '<div style="text-align:center;">' +
                                            '<button class="btn btn-warning btn-xs" onclick="isupdateconfirm(' + data[i].ID + ');">' +
                                            '<i class="glyphicon glyphicon-pencil"></i>' +
                                            '</button>' + '</div>' +
                                            '</td>';
                                        content += '<td class="text-center">' + data[i].GodownID + '</td>';
                                        content += '<td class="text-center">' + data[i].LotNo + '</td>';
                                        content += '<td class="text-center">' + data[i].CreditAcc + '</td>';
                                        content += '<td class="text-center">' + data[i].ItemCode + '</td>';
                                        content += '<td class="text-center">' + data[i].ItemMark + '</td>';
                                        content += '<td class="text-right">' + data[i].Qty + '</td>';
                                        content += '<td class="text-right">' + data[i].Qty + '</td>';
                                        content += '<td class="text-right">' + data[i].GrossWt + '</td>';
                                        content += '<td class="text-right">' + data[i].NetWt + '</td>';
                                        content += '<td class="text-right">' + data[i].Rate + '</td>';
                                        content += '<td class="text-right">' + data[i].APMCIn + '</td>';
                                        content += '<td class="text-right">' + data[i].ETaxIn + '</td>';
                                        content += '<td class="text-right">' + data[i].GrossAmt + '</td>';
                                        content += '<td class="text-right">' + data[i].ContChrg + '</td>';
                                        content += '<td class="text-right">' + data[i].NetAmt + '</td>';
                                        // content += '<td class="text-right">' + data[i]. + '</td>';
                                        content += '</tr>';
                                    }
                                    $('#fetch tbody ').html(content);

                                    // console.log(data.APMCChrg);
                                    $('#PartyCode').val(data[0].DebtorID);
                                    $('#PartyName').val(data[0].DebtorName);
                                    $('#MudiBazar').val(data[0].MudiBazar);
                                    $('#BrokerID').val(data[0].BrokerID);
                                    $('#ACCode').val(data[0].PartyCode);
                                    $('#ACName').val(data[0].PartyID);
                                    $('#StateCode').val(data[0].DebtorState);
                                    $('#BrokerName').val(data[0].BrokerName);
                                    $('#BillDate').val(data[0].BillDate);
                                    $('#BillAmt').val(data[0].BillAmt);
                                    $('#HelMajuri').val(data[0].HelMajuri);
                                    $('#HelMajuri1').val(data[0].HelMajuri);
                                    $('#RoffAmt').val(data[0].RoffAmt);
                                    $('#RetAmt').val(data[0].ReturnAmt);
                                    $('#OtherChrgs').val(data[0].OtherChrgs);
                                    $('#OtherChrg').val(data[0].OtherChrgs);
                                    $('#Discount').val(data[0].DiscountAmt);

                                }
                            });
                            $('#RetAccode').focus();
                        } else {
                            alert("re return");
                            $.ajax({
                                url: "<?= base_url() ?>index.php/SalesReturnController/getQty",
                                data: {
                                    refBillNo: refBillNo,
                                },
                                type: "post",
                                dataType: "json",
                                cache: false,
                                success: function(result) {
                                    console.log(result.Bill);
                                    var Bill = result.Bill;
                                    if (Bill > 0) {
                                        alert('count 1' + Bill);
                                        $.ajax({
                                            url: "<?= base_url() ?>index.php/SalesReturnController/getSalesDet",
                                            data: {
                                                refBillNo: refBillNo,
                                            },
                                            type: "post",
                                            dataType: "json",
                                            cache: false,
                                            success: function(result) {
                                                console.log(result);
                                                var data = result.SalesEntryData;
                                                var content = '';

                                                for (var i = 0; i < data.length; i++) {
                                                    content += '<tr class="blue">';
                                                    content += '<td style="padding: 5px;color: #fff; font-size:15px;" id="widthh">' +
                                                        '<div style="text-align:center;">' +
                                                        '<button class="btn btn-warning btn-xs" onclick="isupdateconfirm(' + data[i].ID + ');">' +
                                                        '<i class="glyphicon glyphicon-pencil"></i>' +
                                                        '</button>' + '</div>' +
                                                        '</td>';
                                                    content += '<td class="text-center">' + data[i].GodownID + '</td>';
                                                    content += '<td class="text-center">' + data[i].LotNo + '</td>';
                                                    content += '<td class="text-center">' + data[i].CreditAcc + '</td>';
                                                    content += '<td class="text-center">' + data[i].ItemCode + '</td>';
                                                    content += '<td class="text-center">' + data[i].ItemMark + '</td>';
                                                    content += '<td class="text-right">' + data[i].Qty + '</td>';
                                                    content += '<td class="text-right">' + data[i].SBal_Qty + '</td>';
                                                    content += '<td class="text-right">' + data[i].GrossWt + '</td>';
                                                    content += '<td class="text-right">' + data[i].NetWt + '</td>';
                                                    content += '<td class="text-right">' + data[i].Rate + '</td>';
                                                    content += '<td class="text-right">' + data[i].APMCIn + '</td>';
                                                    content += '<td class="text-right">' + data[i].ETaxIn + '</td>';
                                                    content += '<td class="text-right">' + data[i].GrossAmt + '</td>';
                                                    content += '<td class="text-right">' + data[i].ContChrg + '</td>';
                                                    content += '<td class="text-right">' + data[i].NetAmt + '</td>';
                                                    // content += '<td class="text-right">' + data[i]. + '</td>';
                                                    content += '</tr>';
                                                }
                                                $('#fetch tbody ').html(content);
                                                // console.log(data.APMCChrg);
                                                $('#PartyCode').val(data[0].DebtorID);
                                                $('#PartyName').val(data[0].DebtorName);
                                                $('#MudiBazar').val(data[0].MudiBazar);
                                                $('#BrokerID').val(data[0].BrokerID);
                                                $('#ACCode').val(data[0].PartyCode);
                                                $('#ACName').val(data[0].PartyID);
                                                $('#StateCode').val(data[0].DebtorState);
                                                $('#BrokerName').val(data[0].BrokerName);
                                                $('#BillDate').val(data[0].BillDate);
                                                $('#BillAmt').val(data[0].BillAmt);
                                                $('#HelMajuri').val(data[0].HelMajuri);
                                                $('#HelMajuri1').val(data[0].HelMajuri);
                                                $('#RoffAmt').val(data[0].RoffAmt);
                                                $('#RetAmt').val(data[0].ReturnAmt);
                                                $('#OtherChrgs').val(data[0].OtherChrgs);
                                                $('#OtherChrg').val(data[0].OtherChrgs);
                                                $('#Discount').val(data[0].DiscountAmt);
                                            }
                                        });
                                        $('#RetAccode').focus();
                                    } else {
                                        alert("Bill Number Already Returned!..");

                                        $("#refBillNo").focus();
                                    }
                                }
                            });
                        }
                    }
                });
            }
        });
    });
</script>

<body>
    <div class="Container container-fluid" style="background: #a6b6e0; height: auto;">
        <div class="card border-dark">
            <div class="head">

                <div class="title" style="float: left; color: white;">Sales Return Entry</div>
                <!-- <input type="hidden" name="buttonVisibility" id="buttonVisibility"> -->
                <div class="bsbtn">


                    <a style="float: right; transform: translateY(-10px);" id="cancel" accesskey="b" class="btn btn-danger" href="<?php echo base_url() ?>index.php/SalesReturnController/Show" tabindex="-1" type="button" class="btn btn-danger">Go Back(Alt+B)</a>
                    <a style="float: right; transform: translateY(-10px);" id="cancel" accesskey="b" class="btn btn-success" href="<?php echo base_url() ?>index.php/SalesReturnController/Show " tabindex="-1" type="button" class="btn btn-success">Save(Alt+S)</a>

                </div>

            </div>
        </div>
        <!-- <input type="hidden" name="buttonVisibility" id="buttonVisibility"> -->

        <div class="sectionOne">
            <div class="s1">
                <label for="">Party</label>
                <input type="text" readonly id="PartyCode" name="PartyCode" value="" placeholder="Party Code">
                <input type="text" readonly style="width: 350px;" id="PartyName" value="" placeholder="Party Name" name="PartyCode">
                Bazar Ind <input type="text" readonly style="width: 70px;" name="MudiBazar" id="MudiBazar" value="" placeholder=""> <br>

                <label for="">Broker</label>
                <input type="text" readonly name="BrokerID" id="BrokerID" value="" placeholder="Broker">
                <input type="text" readonly style="width: 350px;" name="BrokerName" id="BrokerName" value="" placeholder="Broker Name">
                <input type="text" readonly style="width: 135px;" value="" placeholder=""> <br>

                <label for="">Name</label>
                <input type="text" readonly style="width: 140px;" name="ACCode" id="ACCode" value="" placeholder="ACCode">
                <input type="text" readonly style="width: 350px;" name="ACName" id="ACName" value="" placeholder="ACName">
                <input type="text" readonly style="width: 135px;" name="ACAdd" id="ACAdd" value="" placeholder=""> <br>
                <input type="hidden" name="StateCode" id="StateCode">
                <label for="">Bill Date</label>
                <input type="date" readonly name="BillDate" id="BillDate" value="" placeholder="">

                <label for="">Bill Amount</label>
                <input type="text" readonly name="BillAmt" id="BillAmt" value="" placeholder="">

                <label for="">Hel / Majuri</label>
                <input type="text" readonly name="HelMajuri" id="HelMajuri" value="" placeholder="Hel/Majuri"> <br>

                <label for="">Amt Recvd</label>
                <input type="text" readonly name="AmtRecvd" id="AmtRecvd" value="" placeholder="">

                <label for="">Return Amt</label>
                <input type="text" readonly name="RetAmt" id="RetAmt" value="" placeholder="">

                <label for="">Other Charges</label>
                <input type="text" readonly name="OtherChrgs" id="OtherChrgs" value="" placeholder=""> <br>
            </div>

            <div class="s2">
                <label for="">Gross</label>
                <input type="text" readonly name="grossamt" id="grossamt" value="" placeholder="Gross Amount">

                <label for="">Taxable Amt</label>
                <input type="text" readonly name="taxableamt" id="taxableamt" value="" placeholder="Taxabel Amount"> <br>

                <label for="">APMC</label>
                <input type="text" readonly name="APMCSChg" id="APMCSChg" value="" placeholder="APMC">

                <label for="">CGST Amt</label>
                <input type="text" readonly name="cgstamt" id="cgstamt" value="" placeholder="CGST"><br>

                <label for="">Add Amt</label>
                <input type="text" readonly name="addchargeamt" id="addchargeamt" value="" placeholder="Add Amount">

                <label for="">SGST Amt</label>
                <input type="text" readonly name="sgstamt" id="sgstamt" value="" placeholder="SGST"> <br>

                <label for="">Less Amt</label>
                <input type="text" readonly name="lessamt" id="lessamt" value="" placeholder="">

                <label for="">IGST Amt</label>
                <input type="text" readonly name="igstamt" id="igstamt" value="" placeholder="IGST"> <br>

                <label for="">Hel / Charges</label>
                <input type="text" readonly name="HelMajur" id="HelMajur" value="" placeholder="">

                <label for="">Total Tax</label>
                <input type="text" readonly name="TotalTax" id="TotalTax" value="" placeholder=""> <br>

                <label for="" style="margin: 0 0 0 263px;">Return Amt</label>
                <input type="text" readonly name="ReturnAmt" id="ReturnAmt" value="" placeholder=""> <br>
            </div>
        </div>
        <hr>
        <div class="sectionTwo">
            <div class="s3">
                <label for=""><span class="idnum">ID Number</span></label>
                <input type="text" readonly style="background:#AED6F1;" readonly id="IdNumber" name="IdNumber" placeholder="ID Number" value="<?php echo $newid; ?>">
                <span style="padding-left: 100px; 
                font-weight: bold;"> <br>

                    <label for="">Date</label>
                    <input type="date" name="CashDate" id="CashDate" value="<?php echo $today; ?>" onkeydown="focusnext(event)" autofocus placeholder="">
                    <br>

                    <label for="">Ref Bill No.</label>
                    <input type="text" name="refBillNo" id="refBillNo" value="" placeholder="Ref Bill No."> <br>

                    <label for="" style="width: fit-content;">Return Account</label>
                    <a id="party" type="button" class="btn btn-info" data-toggle="modal" data-target="#SupplyModal">
                        <i class="glyphicon glyphicon-th"></i>
                    </a>
                    <input type="text" name="RetAccode" id="RetAccode" value="" placeholder="">
                    <input type="text" readonly style="width: 350px; background:#AED6F1;" name="RetAcname" id="RetAcname" value="" placeholder=""> <br>

                    <label for="">Tax Code Rate</label>
                    <input type="text" readonly style="width: 70px; background:#AED6F1;" name="TaxCode" id="TaxCode" value="" placeholder="Tax Code">
                    <input type="text" readonly style="width: 170px;background:#AED6F1;" name="TaxTitle" id="TaxTitle" value="" placeholder="">
                    <input type="text" readonly style="width: 70px;background:#AED6F1;" name="TaxRate" id="TaxRate" value="" placeholder="">

                    <label for="" style="width: 65px;">Discount</label>
                    <input type="text" readonly style="width: 70px;background:#AED6F1;" name="Discount" id="Discount" value="" placeholder="">
                    <input type="text" readonly style="width: 100px;background:#AED6F1;" name="" id="" value="" placeholder=""> <br>
            </div>

            <div class="s4">
                <label for="">Hel / Majuri</label>
                <input type="text" name="HelMajuri1" id="HelMajuri1" onkeydown="focusnext(event)" value="" placeholder=""> <br>
                <label for="">Other Charges</label>
                <input type="text" name="OtherChrg" id="OtherChrg" onkeydown="focusnext(event)" value="" placeholder=""> <br>
                <label for="">Round Off</label>
                <input type="text" name="RoffAmt" id="RoffAmt" value="" placeholder=""> <br>
            </div>
        </div>
        <hr>

        <div class="Table">
            <table cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>GDN</th>
                        <th>Lot No.</th>
                        <th>Cr Acc.</th>
                        <th>Item Code</th>
                        <th>Mark</th>
                        <th>Qty</th>
                        <th>Gross Wt.</th>
                        <th>Net Wt.</th>
                        <th>Rate</th>
                        <th>APMC(Old)</th>
                        <th>APMC(New)</th>
                        <th>Gr. Amt.</th>
                        <th>C. Chrgs</th>
                        <th>Net Amt.</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input name="GdnTitle" id="GdnTitle" value="" onkeydown="focusnext(event)" placeholder="" type="text">
                        </td>
                        <td>
                            <input name="LotNo" id="LotNo" value="" placeholder="" type="text" style="background:rgb(165, 165, 255);" readonly>
                        </td>
                        <td>
                            <input name="CrAcc" id="CrAcc" value="" placeholder="" type="text" style="background:rgb(165, 165, 255);" readonly>
                        </td>
                        <td>
                            <input type="hidden" name="ApmcRate" id="ApmcRate">
                            <input name="ItemCode" id="ItemCode" value="" placeholder="" type="text" style="background:rgb(165, 165, 255);" readonly>
                        </td>
                        <td><input name="ItemMark" id="ItemMark" value="" placeholder="" type="text" style="background:rgb(165, 165, 255);" readonly></td>
                        <td><input type="hidden" name="Weight" id="Weight">
                            <input type="hidden" name="Packing" id="Packing">
                            <input type="hidden" name="PackingChrg" id="PackingChrg">
                            <input type="hidden" name="BalQty" id="BalQty">
                            <input name="Qty" id="Qty" value="" onkeydown="calcItem(event)" placeholder="" type="text">
                        </td>
                        <td>
                            <input name="GrossWt" id="GrossWt" value="" onkeydown="focusnext(event)" placeholder="" type="text">
                        </td>
                        <td>
                            <input name="NetWt" id="NetWt" value="" onkeydown="calcgross(event)" placeholder="" type="text">
                        </td>
                        <td>
                            <input name="Rate" id="Rate" value="" placeholder="" type="text" style="background:rgb(165, 165, 255);" readonly>
                        </td>
                        <td>
                            <input name="OApmc" id="OApmc" value="" onkeydown="focusnext(event)" placeholder="" type="text" style="background:rgb(165, 165, 255);" readonly>
                        </td>
                        <td>
                            <input name="NApmc" id="NApmc" value="" onkeydown="focusnext(event)" placeholder="" type="text">
                        </td>
                        <td>
                            <input name="grAmt" id="grAmt" value="" placeholder="" type="text" style="background:rgb(165, 165, 255);" readonly>
                        </td>
                        <td>
                            <input name="CCharg" id="CCharg" value="" onkeydown="calcNet(event)" placeholder="" type="text">
                        </td>
                        <td>
                            <input name="NetAmt" id="NetAmt" value="" placeholder="" type="text" style="background:rgb(165, 165, 255);" readonly>
                        </td>
                        <td><b>
                                <!-- Button to update the data  -->
                                <button class="btn btn-success" id="submit"> &check; </button>
                            </b><br>
                            <button class="btn btn-danger" id="Cancel"><b>X</b></button>
                        </td>

                    </tr>
                </tbody>

            </table>

        </div>
        <br>
        <div class="Table">
            <table id="fetch" cellspacing="0" cellpadding="0" border="1">
                <thead>
                    <tr class="tr">
                        <th>Action</th>
                        <th class="text-center">GDN</th>
                        <th>Lot No.</th>
                        <th>Cr Acc.</th>
                        <th>Item Code</th>
                        <th>Mark</th>
                        <th>Qty</th>
                        <th>BalQty</th>
                        <th>Gross Wt.</th>
                        <th>Net Wt.</th>
                        <th>Rate</th>
                        <th>APMC(Old)</th>
                        <th>ETax</th>
                        <th>Gr. Amt.</th>
                        <th>C. Chrgs</th>
                        <th>Net Amt.</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>

        </div>
    </div>

    <script>
        function SupplyCode($PartyCode, $PartyName, $TDSRate) {
            $("#RetAccode").val($PartyCode);
            $("#RetAcname").val($PartyName);
        }
        $(Document).ready(function() {
            $('#RetAC').DataTable();
            $('.dataTables_filter').addClass('pull-left');

        })
    </script>
    <div class="modal fade" id="SupplyModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float: right;">Account List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <table id="RetAC" class="display" border="1">
                        <thead>
                            <tr>
                                <th width="100">No.</th>
                                <th width="100">A/C Code</th>
                                <th width="100">Account Title</th>
                                <th width="100">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($ACList)) {
                                foreach ($ACList as $List) {
                            ?>
                                    <tr>
                                        <td height="10"><?php echo $i; ?></td>
                                        <td class="text-left"><?php echo $List->ACCode; ?></td>
                                        <td class="text-left"><?php echo $List->ACTitle; ?></td>

                                        <td align="center">
                                            <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="SupplyCode(
                                                                                                                                        '<?php echo $List->ACCode; ?>',
                                                                                                                                        '<?php echo $List->ACTitle; ?>',
                                                                                                                                        
                                                                                                                                    ); ">
                                                <i class="glyphicon glyphicon-check"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo "No Data found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
    <!-- AutoComplete  -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" frel="Stylesheet">
    </link>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <script>
        $(document).ready(function() {

            $("#RetAccode").autocomplete({
                autoFocus: true,
                source: function(request, cb) {
                    console.log(request);

                    $.ajax({
                        url: "<?= base_url() ?>index.php/SalesReturnController/ReturnAc/" + request.term,
                        method: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            var result;
                            result = [{
                                label: 'There is no matching record found for ' + request.term,
                                value: ''
                            }];

                            console.log("Before format", res);


                            if (res.length) {
                                result = $.map(res, function(obj) {
                                    return {
                                        label: obj.ACCode + " / " + obj.ACTitle,
                                        value: obj.ACCode,
                                        data: obj
                                    };
                                });
                            }

                            console.log("formatted response", result);
                            cb(result);
                        }
                    });

                },
                select: function(event, selectedData) {
                    console.log(selectedData);
                    if (selectedData && selectedData.item && selectedData.item.data) {
                        var data = selectedData.item.data;
                        console.log("Selected ", data);
                        $('#RetAcname').val(data.ACTitle);

                    }
                    if (event.keyCode == 13) {
                        $('#HelMajuri1').focus();
                    }


                }
            });

            // Move To Next TextBox if TextBox Has Value
            $("#PartyCode").keydown(function(event) {
                if (event.keyCode == 13)
                    $("#HelMajuri1").focus();
            });
        });
    </script>

</body>

</html>