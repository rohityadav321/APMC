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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Sales Return Update</title>

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
            width: 130px;
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
        "RetAccode",
        "HelMajuri1",
        "OtherChrg",
        "RoffAmt"

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
    // calculate Gross wt,Net wt,ContCharges
    function calcItem(e) {
        const weight = parseFloat($('#Weight').val());
        const Packing = parseFloat($('#Packing').val());
        const PackingChrg = parseFloat($('#PackingChrg').val());
        const Qty = parseFloat($('#Qty').val());
        const code = e.keyCode || e.which;
        if (code == 13 || code === 9) {

            if (Qty != "") {
                const net = (Packing - weight).toFixed(2);
                const grosswt = (Qty * Packing).toFixed(2);
                const Netwt = (Qty * net).toFixed(2);
                const Cont = (Qty * PackingChrg).toFixed(2);

                $('#GrossWt').val(grosswt);
                $('#NetWt').val(Netwt);
                $('#CCharg').val(Cont);
            }
            $('#GrossWt').focus();
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
    // ! <---Update the sales data - Pranav 7-5-21--->
    $(document).ready(function() {
        $("#RoffAmt").keydown(function(e) {
            var code = e.keyCode || e.which;
            if (code == 13 || code === 9) {
                var CashDate = $('#CashDate').val();
                var ReturnAcc = $('#RetAccode').val();
                var IDNumber = $('#IdNumber').val();
                // alert(CashDate + ReturnAcc + IDNumber);

                $.ajax({
                    url: "<?= base_url() ?>index.php/SalesReturnController/SalesReturnUpdateData",
                    data: {
                        CashDate: CashDate,
                        ReturnAcc: ReturnAcc,
                        IDNumber: IDNumber
                    },
                    type: "post",
                    dataType: "json",
                    cache: false,
                    success: function() {
                        alert("Data Updated in SaleReturnMaster");
                        // $('#GdnTitle').focus();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.responseText);
                    }

                });
            }
        })
    })
    // SalesReturn Detail Entry

    // $(document).ready(function() {
    //     $("#submit").keydown(function(e) {
    //         var code = e.keyCode || e.which;
    //         if (code == 13 || code === 9) {
    //             var SalRetrnDt = $('#CashDate').val();
    //             var BillNo = $('#refBillNo').val();
    //             var BillDate = $('#BillDate').val();
    //             var GodownID = $('#GdnTitle').val();
    //             var LotNo = $('#LotNo').val();
    //             var CreditAcc = $('#CrAcc').val();
    //             var ItemCode = $('#ItemCode').val();
    //             var ItemMark = $('#ItemMark').val();
    //             var Qty = $('#Qty').val();
    //             var GrossWt = $('#GrossWt').val();
    //             var NetWt = $('#NetWt').val();
    //             var Rate = $('#Rate').val();
    //             var APMCIn = $('#OApmc').val();
    //             var ContChrg = $('#CCharg').val();
    //             var DiscAmt = $('#Discount').val();
    //             var APMCChrg = $('#APMCSChg').val();
    //             var AddAmt = $('#addchargeamt').val();
    //             var LessAmt = $('#lessamt').val();
    //             var TaxableAmt = $('#taxableamt').val();
    //             var RetuTaxCode = $('#TaxCode').val();
    //             var TaxAmt = $('#TotalTax').val();
    //             var CGSTAmt = $('#cgstamt').val();
    //             var SGSTAmt = $('#sgstamt').val();
    //             var IGSTAmt = $('#igstamt').val();
    //             var SalRAmt = $('#ReturnAmt').val();
    //             var BrokerCode = $('#BrokerID').val();
    //             var NAPMCIn = $('#NApmc').val();

    //             $.ajax({
    //                 url: "<?= base_url() ?>index.php/SalesReturnController/SalesReturnUpdateDetail",
    //                 data: {
    //                     SalRetrnDt: SalRetrnDt,
    //                     BillNo: BillNo,
    //                     BillDate: BillDate,
    //                     GodownID: GodownID,
    //                     LotNo: LotNo,
    //                     CreditAcc: CreditAcc,
    //                     ItemCode: ItemCode,
    //                     ItemMark: ItemMark,
    //                     Qty: Qty,
    //                     GrossWt: GrossWt,
    //                     NetWt: NetWt,
    //                     Rate: Rate,
    //                     APMCIn: APMCIn,
    //                     // ETaxIn: ETaxIn,
    //                     // ItemAmt: ItemAmt,
    //                     ContChrg: ContChrg,
    //                     // LagaAmt: LagaAmt,
    //                     // DiscRate: DiscRate,
    //                     DiscAmt: DiscAmt,
    //                     APMCChrg: APMCChrg,
    //                     // APMCSChrg: APMCSChrg,
    //                     // OApmcTax: OApmcTax,
    //                     // EntryTax: EntryTax,
    //                     // Oetax: Oetax,
    //                     AddAmt: AddAmt,
    //                     LessAmt: LessAmt,
    //                     TaxableAmt: TaxableAmt,
    //                     RetuTaxCode: RetuTaxCode,
    //                     TaxAmt: TaxAmt,
    //                     CGSTAmt: CGSTAmt,
    //                     SGSTAmt: SGSTAmt,
    //                     IGSTAmt: IGSTAmt,
    //                     SalRAmt: SalRAmt,
    //                     // PattiInd: PattiInd,
    //                     BrokerCode: BrokerCode,
    //                     // BrokInd: BrokInd,
    //                     // BrokRate: BrokRate,
    //                     // BrokAmt: BrokAmt,
    //                     NAPMCIn: NAPMCIn,
    //                     // NEtaxIn: NEtaxIn,
    //                     // RDCODE1: RDCODE1,
    //                     // RDCODE2: RDCODE2,
    //                     // RDCODE3: RDCODE3,
    //                     // RDCODE4: RDCODE4,
    //                     // RDCODE5: RDCODE5,
    //                     // RDAmt1: RDAmt1,
    //                     // RDAmt2: RDAmt2,
    //                     // RDAmt3: RDAmt3,
    //                     // RDAmt4: RDAmt4,
    //                     // RDAmt5: RDAmt5,
    //                     // CreditAccAmt: CreditAccAmt,
    //                     // EntryType: EntryType,
    //                     // Haste: Haste,
    //                     // HelOthRo: HelOthRo,
    //                 },
    //                 type: "post",
    //                 dataType: "json",
    //                 cache: false,
    //                 success: function() {
    //                     alert("Data Inserted in SaleReturnDetails");
    //                     $('#GdnTitle').focus();
    //                 },
    //                 error: function(xhr, ajaxOptions, thrownError) {
    //                     alert(xhr.responseText);
    //                 }

    //             });
    //         }
    //     })
    // })
</script>
<script>
    function isdeleteconfirm() {
        if (!confirm('Are you sure you want to delete ?')) {
            event.preventDefault();
            return;
        }
        return true;
    }
</script>
<script>
    function isupdateconfirm(id) {
        var idNum = id;
        $('#GdnTitle').focus();
        $.ajax({
            url: "<?= base_url() ?>index.php/SalesReturnController/getSalesRetItemWise/" + idNum,
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
                $('#Qty').val(data.Qty);
                $('#GrossWt').val(data.GrossWt);
                $('#NetWt').val(data.NetWt);
                $('#Rate').val(data.Rate);
                $('#OApmc').val(data.NAPMCIn);
                $('#NApmc').val(data.NAPMCIn);
                $('#grAmt').val((data.NetWt) * ((data.Rate) / 100));
                $('#CCharg').val(data.ContChrg);
                $('#NetAmt').val(parseFloat(((data.NetWt) * ((data.Rate) / 100))) + parseFloat(data.ContChrg));
                $('#TaxCode').val(data.RetuTaxCode);
                $('#TaxTitle').val(data.TaxTitle);
                $('#TaxRate').val(data.TaxRate);
                $('#ApmcRate').val(data.ApmcRate);
                $('#Weight').val(data.weight);
                $('#Packing').val(data.Packing);
                $('#PackingChrg').val(data.PackingChrg);
            },
            error: function(errorThrown) {
                alert("Error: " + errorThrown);
            }
        });
    };
</script>
<script>
    //get the sales data with the help of reference bill number
</script>


<body>
    <div class="Container container-fluid" style="background: #a6b6e0; height: auto;">
        <div class="card border-dark">
            <div class="head">

                <span class="title" style="float: left; color: white;">Sales Return Update</span>
                <!-- <input type="hidden" name="buttonVisibility" id="buttonVisibility"> -->
                <div class="bsbtn">


                    <a style="float: right; transform: translateY(-10px);" id="cancel" accesskey="b" class="btn btn-danger" href="<?php echo base_url() . "index.php/SalesReturnController/Show/" ?>" tabindex="-1" type="button" class="btn btn-danger">Go Back(Alt+B)</a>
                    <a style="float: right; transform: translateY(-10px);" id="cancel" accesskey="b" class="btn btn-success" href="<?php echo base_url() . "index.php/SalesReturnController/Show/" ?>" tabindex="-1" type="button" class="btn btn-success">Save(Alt+S)</a>

                </div>

            </div>
        </div>

        <div class="sectionOne">
            <div class="s1">
                <label for="">Party</label>
                <input type="text" readonly id="PartyCode" name="PartyCode" value="<?php echo $SalesReturnMaster[0]->PartyCode; ?>" placeholder="Party Code">
                <input type="text" readonly style="width: 350px;" id="PartyName" value="<?php echo $SalesReturnMaster[0]->PartyName; ?>" placeholder="Party Name" name="PartyCode">
                Bazar Ind <input type="text" readonly style="width: 70px;" name="MudiBazar" id="MudiBazar" value="<?php echo $SalesReturnMaster[0]->MudiBazar; ?>" placeholder=""> <br>

                <label for="">Broker</label>
                <input type="text" readonly name="BrokerID" id="BrokerID" value="<?php echo $SalesReturnMaster[0]->BrokCode; ?>" placeholder="Broker">
                <input type="text" readonly style="width: 350px;" name="BrokerName" id="BrokerName" value="<?php echo $SalesReturnMaster[0]->BrokName; ?>" placeholder="Broker Name">
                <input type="text" readonly style="width: 135px;" value="" placeholder=""> <br>

                <label for="">Name</label>
                <input type="text" readonly style="width: 140px;" name="ACCode" id="ACCode" value="<?php echo $SalesReturnMaster[0]->CashCode; ?>" placeholder="ACCode">
                <input type="text" readonly style="width: 350px;" name="ACName" id="ACName" value="<?php echo $SalesReturnMaster[0]->CashName; ?>" placeholder="ACName">
                <input type="text" readonly style="width: 135px;" name="ACAdd" id="ACAdd" value="" placeholder=""> <br>
                <input type="hidden" name="StateCode" id="StateCode">
                <label for="">Bill Date</label>
                <input type="date" readonly name="BillDate" id="BillDate" value="<?php echo date_format(date_create($SalesReturnMaster[0]->BillDate), "Y-m-d"); ?>" placeholder="">

                <label for="">Bill Amount</label>
                <input type="text" readonly name="BillAmt" id="BillAmt" value="<?php echo $SalesReturnMaster[0]->BillAmt; ?>" placeholder="">

                <label for="">Hel / Majuri</label>
                <input type="text" readonly name="HelMajuri" id="HelMajuri" value="<?php echo $SalesReturnMaster[0]->HMajuAmt; ?>" placeholder="Hel/Majuri"> <br>

                <label for="">Amt Recvd</label>
                <input type="text" readonly name="AmtRecvd" id="AmtRecvd" value="" placeholder="">

                <label for="">Return Amt</label>
                <input type="text" readonly name="RetAmt" id="RetAmt" value="" placeholder="">

                <label for="">Other Charges</label>
                <input type="text" readonly name="OtherChrgs" id="OtherChrgs" value="<?php echo $SalesReturnMaster[0]->OChrgamt; ?>" placeholder=""> <br>
            </div>

            <div class="s2">
                <label for="">Gross</label>
                <input type="text" readonly name="grossamt" id="grossamt" value="<?php echo $SalesReturnMaster[0]->TaxableAmt - $SalesReturnMaster[0]->APMCChrg; ?>" placeholder="Gross Amount">

                <label for="">Taxable Amt</label>
                <input type="text" readonly name="taxableamt" id="taxableamt" value="<?php echo $SalesReturnMaster[0]->TaxableAmt; ?>" placeholder="Taxabel Amount"> <br>

                <label for="">APMC</label>
                <input type="text" readonly name="APMCSChg" id="APMCSChg" value="<?php echo $SalesReturnMaster[0]->APMCChrg; ?>" placeholder="APMC">

                <label for="">CGST Amt</label>
                <input type="text" readonly name="cgstamt" id="cgstamt" value="<?php echo $SalesReturnMaster[0]->CGSTAmt; ?>" placeholder="CGST"><br>

                <label for="">Add Amt</label>
                <input type="text" readonly name="addchargeamt" id="addchargeamt" value="" placeholder="Add Amount">

                <label for="">SGST Amt</label>
                <input type="text" readonly name="sgstamt" id="sgstamt" value="<?php echo $SalesReturnMaster[0]->SGSTAmt; ?>" placeholder="SGST"> <br>

                <label for="">Less Amt</label>
                <input type="text" readonly name="lessamt" id="lessamt" value="" placeholder="">

                <label for="">IGST Amt</label>
                <input type="text" readonly name="igstamt" id="igstamt" value="<?php echo $SalesReturnMaster[0]->IGSTAmt; ?>" placeholder="IGST"> <br>

                <label for="">Hel / Charges</label>
                <input type="text" readonly name="HelMajur" id="HelMajur" value="" placeholder="">

                <label for="">Total Tax</label>
                <input type="text" readonly name="TotalTax" id="TotalTax" value="<?php echo $SalesReturnMaster[0]->TaxAmt; ?>" placeholder=""> <br>

                <label for="" style="margin: 0 0 0 243px;;">Return Amt</label>
                <input type="text" readonly name="ReturnAmt" id="ReturnAmt" value="<?php echo $SalesReturnMaster[0]->SalRAmt; ?>" placeholder=""> <br>
            </div>
        </div>
        <hr>
        <div class="sectionTwo">
            <div class="s3">
                <label for=""><span class="idnum">ID Number</span></label>
                <input type="text" readonly style="background-color :#AED6F1;" readonly id="IdNumber" name="IdNumber" placeholder="ID Number" value="<?php echo $SalesReturnMaster[0]->IDNumber; ?>">
                <span style="padding-left: 100px; 
                font-weight: bold;"> <br>

                    <label for="">Date</label>
                    <input type="date" name="CashDate" id="CashDate" value="<?php echo date_format(date_create($SalesReturnMaster[0]->CashDate), "Y-m-d"); ?>" onkeydown="focusnext(event)" autofocus placeholder="">
                    <br>

                    <label for="">Ref Bill No.</label>
                    <input type="text" readonly name="refBillNo" style="background-color :#AED6F1;" id="refBillNo" value="<?php echo $SalesReturnMaster[0]->BillNo; ?>" placeholder="Ref Bill No."> <br>

                    <label for="" style="width: fit-content;">Return Account</label>
                    <a id="party" type="button" class="btn btn-info" data-toggle="modal" data-target="#SupplyModal">
                        <i class="glyphicon glyphicon-th"></i>
                    </a>
                    <input type="text" name="RetAccode" id="RetAccode" value="<?php echo $SalesReturnMaster[0]->ReturnAcc; ?>" placeholder="">
                    <input type="text" readonly style="width: 350px;background-color :#AED6F1;" name="RetAcname" id="RetAcname" value="<?php echo $SalesReturnMaster[0]->RetAccName; ?>" placeholder=""> <br>

                    <label for="">Tax Code Rate</label>
                    <input type="text" readonly style="width: 70px; background-color :#AED6F1;" name="TaxCode" id="TaxCode" value="" placeholder="Tax Code">
                    <input type="text" readonly style="width: 170px;background-color :#AED6F1;" name="TaxTitle" id="TaxTitle" value="" placeholder="">
                    <input type="text" readonly style="width: 70px;background-color :#AED6F1;" name="TaxRate" id="TaxRate" value="" placeholder="">

                    <label for="" style="width: 65px;">Discount</label>
                    <input type="text" readonly style="width: 70px;background-color :#AED6F1;" name="Discount" id="Discount" value="<?php echo $SalesReturnMaster[0]->DiscAmt; ?>" placeholder="">
                    <input type="text" readonly style="width: 100px;background-color :#AED6F1;" name="" id="" value="" placeholder=""> <br>
            </div>

            <div class="s4">
                <label for="">Hel / Majuri</label>
                <input type="text" name="HelMajuri1" id="HelMajuri1" onkeydown="focusnext(event)" value="<?php echo $SalesReturnMaster[0]->HMajuAmt; ?>" placeholder=""> <br>
                <label for="">Other Charges</label>
                <input type="text" name="OtherChrg" id="OtherChrg" onkeydown="focusnext(event)" value="<?php echo $SalesReturnMaster[0]->OChrgamt; ?>" placeholder=""> <br>
                <label for="">Round Off</label>
                <input type="text" name="RoffAmt" id="RoffAmt" value="" placeholder="<?php echo $SalesReturnMaster[0]->RoffAmt; ?>"> <br>
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
            <table id="fetch" border="1" cellspacing="0" cellpadding="0">
                <thead>
                    <tr class="tr">
                        <th>Action</th>
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
                        <th>ETax</th>
                        <th>Gr. Amt.</th>
                        <th>C. Chrgs</th>
                        <th>Net Amt.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($TableData); $i++) {
                        $count = $i + 1;
                        // $qty = $qty + $TableData[$i]->Qty;
                        // $netWt = $netWt + $TableData[$i]->NetWt;
                        // $grAmt = $grAmt + $TableData[$i]->GrAmt;
                    ?>
                        <tr>
                            <td id="width" style="padding: 5px;color: #fff; font-size:15px;">
                                <center>
                                    <!-- <a class="btn btn-warning btn-xs" onclick="isupdateconfirm(<?php echo $TableData[$i]->IDNumber ?>);" tabindex="-1">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a> -->
                                    <a class="btn btn-danger btn-xs" onclick="isdeleteconfirm();" href="<?php echo base_url() . "index.php/SalesReturnController/DeleteSingleEntry/" . $TableData[$i]->IDNumber; ?>" tabindex="-1">
                                        <i class="glyphicon glyphicon-remove"></i>
                                    </a>
                                </center>
                            </td>
                            <td class="text-center"><?php echo $TableData[$i]->GodownID; ?></td>
                            <td><?php echo $TableData[$i]->LotNo; ?></td>
                            <td><?php echo $TableData[$i]->CreditAcc; ?></td>
                            <td><?php echo $TableData[$i]->ItemCode; ?></td>
                            <td><?php echo $TableData[$i]->ItemMark; ?></td>
                            <td><?php echo $TableData[$i]->Qty; ?></td>
                            <td><?php echo $TableData[$i]->GrossWt; ?></td>
                            <td><?php echo $TableData[$i]->NetWt; ?></td>
                            <td><?php echo $TableData[$i]->Rate; ?></td>
                            <td><?php echo $TableData[$i]->APMCIn; ?></td>
                            <td><?php echo $TableData[$i]->ETaxIn; ?></td>
                            <td><?php echo ($TableData[$i]->Qty) * ($TableData[$i]->NetWt); ?></td>
                            <td><?php echo $TableData[$i]->ContChrg; ?></td>
                            <td><?php echo (($TableData[$i]->Qty) * ($TableData[$i]->NetWt)) + $TableData[$i]->ContChrg; ?></td>
                        </tr>

                    <?php } ?>

                    <!-- <tr>
                        <td><?php echo $count; ?></td>
                        <td colspan="4">
                            <center>Totals</center>
                        </td>
                        <td><?php echo $qty; ?></td>
                        <td></td>
                        <td><?php echo $netWt; ?>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $grAmt; ?>
                        </td>
                        <td colspan="3">
                            <center>BillAmt Total : <?php echo $Total[0]->BillAmt; ?></center>
                        </td>
                    </tr> -->
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

        });
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
            $("#RetAccode").keydown(function(event) {
                if (event.keyCode == 13)
                    $("#HelMajuri1").focus();
            });
        });
    </script>

</body>

</html>