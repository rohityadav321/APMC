<?php
include 'header-form.php';
$attributes = array("class" => "form-horizontal", "id" => "rojmel", "name" => "rojmel");
// echo form_open("RojmelController/InsertTry/", $attributes);
//echo form_open("RojmelController/AddRojmel/",$attributes);

$id = mt_rand(100000, 999999);
$newid = 1;

$timezone = "Asia/Colombo";
date_default_timezone_set($timezone);
$today = date("Y-m-d");
?>

<style type="text/css">
  /* POP UP FORM STYLE START */


  /* The popup form - hidden by default */
  .form-popup {
    display: none;
    position: fixed;
    bottom: 0;
    right: 15px;
    border: 3px solid #f1f1f1;
    z-index: 9;

  }

  .form-popup1 {
    display: none;
    position: fixed;
    bottom: 0;
    /* right: 15px; */
    border: 3px solid #f1f1f1;
    z-index: 9;
    float: left;
  }

  .form-popup2 {
    display: none;
    position: fixed;
    bottom: 0;
    margin-left: 28%;
    center: 5px;
    border: 3px solid #f1f1f1;
    z-index: 9;
  }

  .form-popup3 {
    display: none;
    position: fixed;
    bottom: 10px;
    right: 10%;
    /* margin-left: 28%; */
    center: 5px;
    border: 3px solid #333;
    z-index: 9;
    width: 400px;
  }

  /* Add styles to the form container */
  /* .form-container {
        max-width: 500px;
        padding: 10px;
        background-color: white;
      } */

  /* Add some hover effects to buttons */
  .form-container .btn:hover,
  .open-button:hover {
    opacity: 1;
  }

  /* POP UP FORM STYLE END */



  body,
  .card {
    background-color: #D6DBDF;
  }

  input[type=text] {
    width: 100%;
    height: 25px;
    padding: 0px 0px 0px 0px;
    margin: 0px 0;
    box-sizing: border-box;
  }

  input[type=date] {
    width: 60%;
    height: 25px;
    padding: 0px 0px 0px 0px;
    margin: 0px 0;
    box-sizing: border-box;
  }

  #abc .form-group {
    margin-bottom: 5px !important;
  }

  #saves {
    margin-bottom: 10px !important;
    margin-left: 275px !important;
  }

  #headers {
    height: 45px !important;
    background: white !important;
    /*border-bottom: hidden;*/
  }

  #headers h5 {
    float: left !important;
  }

  #savee {
    height: 100px !important;
  }

  #modal-size {
    max-width: inherit;
    width: auto;
    height: auto;
  }

  #supply {
    width: 80%;
    margin: auto;
  }

  #GoodsRcptDate,
  #InvoiceDate,
  #LRDate {
    background-color: #FFB6C1;
    width: 60%;
    height: 25px;
    padding: 0px 0px 0px 0px;
    margin: 0px 0;
    box-sizing: border-box;
  }

  #RefIDNumber,
  #PartyName,
  #BrokerName,
  #GdnDate,
  #BillNo,
  #BillDate,
  #BillDue,
  #Settled,
  #BillAmt,
  #PartyCode,
  #BrokerCode,
  #SPartyName,
  #SBrokerName,
  #SBillNo,
  #SBillDate,
  #SBillDue,
  #SSettled,
  #SBillAmt,
  #SPartyCode,
  #Name,
  #SBrokerCode {
    background-color: #AED6F1
  }

  .fsize {
    font-size: 12px;
    background-color: #FFD28D;
  }

  .bgblue {
    background-color: #AED6F1;
  }

  .blue {
    color: #3b5998;
  }

  #lefts {
    padding-bottom: 10px !important;
    float: right !important;
  }

  .yellow {
    background-color: #FFD28D;
  }

  #areas {
    margin-left: 15px;
    padding-left: 5px;
    padding-right: 5px;
    padding-top: 0px;
    padding-bottom: 0px;
    height: 22px;
  }

  .stylish-input-group .input-group-addon {
    background: white !important;
  }

  .stylish-input-group .form-control {
    border-right: 0;
    box-shadow: 0 0 0;
    border-color: #ccc;
  }

  .stylish-input-group button {
    border: 0;
    background: transparent;
  }

  #jqxWidgets {
    font-size: 50px;
  }

  #areas1 {
    margin-top: 5px;
    padding-top: 2px !important;
    padding-left: 5px !important;
    padding-right: 5px !important;
    padding-bottom: 0px !important;
  }

  #Leftside {
    padding-right: 5px;
  }

  .yellow {
    background-color: #FFD28D;
  }

  .ui-autocomplete {
    height: 200px;
    overflow-y: scroll;
    overflow-x: hidden;
  }

  table,
  td,
  th {
    border: 1px solid #808B96;
  }

  table {
    text-align: right;
    border-collapse: collapse;
  }

  /* Updated Code End */

  #ADD,
  #DEL {
    width: 100px;
    height: 30px;

  }
</style>

<script type=text/javascript>
  $(document).ready(function() {
    $("#Amount").hide();
    $("#Nature").hide();
    $("#LAmount").hide();
    $("#LNature").hide();
    $("#Balance").hide();
    $("#LBalance").hide();
    $IDN = $("#IDNumber").val();
    updateref($IDN);
    $('#BookFrom').DataTable();
    $('#AccountFrom').DataTable();

    //       $('#BCode').click(function() 
    // {
    //     ShowHide();
    //     ClosingBal();
    // });

  });


  // END
  function ClosingBal() {
    var BCode = $('#BCode').val();
    $IDN = $("#IDNumber").val();

    updateamt($IDN);
    var url = "<?php echo base_url('index.php/RojmelController/getClosingBal/') ?>" + BCode;

    $.ajax({
      url: url,

      type: "POST",
      data: $('form').serialize(),
      success: function(data) {
        var x = "";
        var size = data.length;

        for (i = 11; i < (size - 3); i++) {
          x = x + data[i];
        }
        $("#Balance").val(x);

      },
      error: function(jqXHR, textStatus, errorThrown) {

        alert(errorThrown);
        // updateref(Idnumber);
      }

    });

    var BCodevalue = $("#BCode").val();
    if (BCodevalue == 0) {
      $("#Amount").hide();
      $("#Nature").hide();
      $("#LAmount").hide();
      $("#LNature").hide();
      $("#Balance").val("");
    }
  }



  function ShowHide() {
    $K = "BB";
    $Z = "BZ";

    var BCodevalue = $("#GroupCode1").val();
    if (BCodevalue == $K) {
      $("#Amount").show();
      $("#Nature").show();
      $("#LAmount").show();
      $("#LNature").show();
      $("#Balance").show();
      $("#LBalance").show();
      var select = $('#Nature');
      select.empty().append('<option></option><option value="Withdraw">Withdraw</option><option value="Deposit">Deposit</option>');
    } else if (BCodevalue == $Z) {
      $("#Amount").show();
      $("#Nature").show();
      $("#LAmount").show();
      $("#LNature").show();
      $("#Balance").show();
      $("#LBalance").show();
      var select = $('#Nature');
      select.empty().append('<option value=Payment"">Payment</option><option value="Receipt">Receipt</option>');
    } else {
      $("#Amount").hide();
      $("#Nature").hide();
      $("#LAmount").hide();
      $("#LNature").hide();
      $("#Balance").hide();
      $("#LBalance").hide();

      var select = $('#Nature');
      select.empty().append('<option value=""></option>');

      $("#Amount").val("");
      $("#Balance").val("");

    }

  }

  // Add rojmel start

  function insert_rojmel() {
    document.getElementById("ACCode").focus();
    var ACCode = $('#ACCode').val();
    var ACTitle = $('#ACTitle').val();
    var Group = $('#Group').val();
    var Amount = $('#Amount').val();
    var Amount1 = $('#Amount1').val();
    var DebitCredit = $('#DRCR').val();
    var Cheque_No = $('#Cheque_No').val();
    var Lot_No = $('#Lot_No').val();
    var IDNumber = $('#IDNumber').val();
    var CNarration = $('#CNarration').val();
    var RefIDNum = $('#RefIDNum');

    var UPid = $('#UPid').val();
    if (parseFloat(Amount1) <= parseFloat(Amount)) {
      var url = "<?php echo base_url('index.php/RojmelController/Update/') ?>" + IDNumber;

      $.ajax({
        url: url,
        type: "POST",
        data: $('form').serialize(),
        success: function(data) {
          // alert("Added Successfully!!");
          // alert("Data"+data);

          var Idnumber = document.getElementById("IDNumber").value;
          var ACCode = document.getElementById("ACCode").value = "";
          var ACTitle = document.getElementById("ACTitle").value = "";
          var Group = document.getElementById("Group").value = "";
          var Amount1 = document.getElementById("Amount1").value = "";
          // var DebitCredit = document.getElementById("DRCR").value = "";
          var Cheque_No = document.getElementById("Cheque_No").value = "";
          var Lot_No = document.getElementById("Lot_No").value = "";
          var UPid = document.getElementById("UPid").value = "";


          updateref(Idnumber);
          alert("Entry Added")

        },
        error: function(jqXHR, textStatus, errorThrown) {

          alert(errorThrown);
          // updateref(Idnumber);
        }

      });
    } else {
      alert("Entered Amount is greater than Header Amount!!!");
      $("#Amount1").focus();

    }


  }
  // ADD ROJMEL END


  // UPDATE ROJMEL START
  function updateref(Idnumber) {
    var Idnumber = Idnumber;
    var url = "<?php echo base_url('index.php/RojmelController/GetIDNumber/') ?>";
    $.ajax({
      url: url,
      dataType: "JSON",
      type: "POST",
      success: function(data) {

        //var obj = JSON.parse(data); 
        updateamt(Idnumber);
        display(Idnumber);
        table.ajax.reload();

      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert(textStatus);
      }
    });
  }

  // UPDATE ROJMEL END

  //UPDATE AMT START
  function updateamt(Idnumber) {
    var Amtval = $('#Amount').val();
    var Idnumber = Idnumber;

    var Nature = $('#Nature').val();

    $.ajax({
      url: "<?= base_url() ?>index.php/RojmelController/UpdateAmount/" + Idnumber,
      dataType: "json",
      type: "post",

      cache: false,
      success: function(result) {


        if (Nature == "Deposit") {
          //alert("1"+Nature);
          // $("#Total_DR").val(parseFloat(result[0]['Debit']) + parseFloat(Amtval));
          $("#Total_DR").val(parseFloat(result[0]['Debit']));
          $("#Total_CR").val(parseFloat(result[0]['Credit']));
          $amtval = Amtval - $("#Total_DR").val() - $("#Total_CR").val();

          if ($amtval < 0) {
            $amtval = $amtval * -1;
            $("#DRCR").val("DR");
            $("#Amount1").val($amtval);
          } else {
            $("#DRCR").val("CR");
            $("#Amount1").val($amtval);
          }
        } else if (Nature == "Withdraw") {
          //alert("2"+Nature);
          $("#Total_DR").val(parseFloat(result[0]['Debit']));
          // $("#Total_CR").val(parseFloat(result[0]['Credit']) + parseFloat(Amtval));
          $("#Total_CR").val(parseFloat(result[0]['Credit']));
          $amtval = Amtval - $("#Total_DR").val() - $("#Total_CR").val();

          if ($amtval < 0) {
            $amtval = $amtval * -1;
            $("#DRCR").val("DR");
            $("#Amount1").val($amtval);
          } else {
            $("#DRCR").val("CR");
            $("#Amount1").val($amtval);
          }

        } else {
          //alert("3"+Nature);
          $("#Total_DR").val(parseFloat(result[0]['Debit']));
          $("#Total_CR").val(parseFloat(result[0]['Credit']));

          $amtval = Amtval - $("#Total_DR").val() - $("#Total_CR").val();

          if ($amtval < 0) {
            $amtval = $amtval * -1;
            $("#DRCR").val("DR");
            $("#Amount1").val($amtval);
          } else {
            $("#DRCR").val("CR");
            $("#Amount1").val($amtval);
          }
        }


      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert(textStatus);
      }
    });
  }
  //UPDATE AMT END

  // TEMP START

  function display(Idnumber) {
    var Idnumber = Idnumber;
    table = $('#Rojmel1').DataTable();
    table.destroy();
    // var btn = '<a class="btn btn-warning btn-xs" accesskey="e" onclick="isupdateconfirm('+Idnumber+')" href= ""><i class="glyphicon glyphicon-pencil"></i></a><a class="btn btn-danger btn-xs" accesskey="d" onclick="deleteRecord('+Idnumber+')" href= ""><i class="glyphicon glyphicon-remove"></i></a>';

    table = $('#Rojmel1').DataTable({
      "ajax": {
        "type": "POST",
        "url": "<?php echo base_url('index.php/RojmelController/AddedRecord1/') ?>/" + Idnumber,
        "dataSrc": "Users",

      },
      "columns": [
        null,
        //{"data": ["IDNumber"] },
        {
          "data": ["ACCode"]
        },
        {
          "data": ["ACTitle"]
        },
        {
          "data": ["GroupCode"]
        },
        {
          "data": ["BookCode"]
        },
        {
          "data": ["ACCAmount"]
        },
        {
          "data": ["DRCR"]
        },
        {
          "data": ["ChqNo"]
        },
        {
          "data": ["LotNo"],
        }
      ],
      columnDefs: [{
        'orderable': false,
        'targets': 0,
        "data": null,
        "render": function(data, type, row) {
          return '<a class="btn btn-warning btn-xs" onclick="isupdateconfirm(' + row.IDNumber + ');"><i class="glyphicon glyphicon-pencil"></i></a><a class="btn btn-danger btn-xs" onclick="deleteRecord(' + row.IDNumber + ');"><i class="glyphicon glyphicon-remove"></i></a>';
        }
      }],
      select: {
        'style': 'multi',
        'selector': 'td:first-child'
      },
      order: [
        [1, 'asc']
      ]
    });
    table.ajax.reload();
  }


  function isupdateconfirm(Idnumber) {
    // focusnext();
    var Idnumber = Idnumber;
    var abc = document.getElementById("UPid").value = Idnumber;
    var url = '<?php echo base_url() . "index.php/RojmelController/UpdateRecord1/"; ?>' + Idnumber;

    $.ajax({
      type: "post",
      url: url,
      dataType: "json",
      success: function(data, text) {

        var ACCode = document.getElementById("ACCode").value = data[0].ACCode;
        var ACTitle = document.getElementById("ACTitle").value = data[0].ACTitle;
        var Group = document.getElementById("Group").value = data[0].GroupCode;
        var Amount1 = document.getElementById("Amount1").value = data[0].ACCAmount;
        var Cheque_No = document.getElementById("Cheque_No").value = data[0].ChqNo;
        var Lot_No = document.getElementById("Lot_No").value = data[0].LotNo;
        var DRCR = document.getElementById("DRCR").value = data[0].DRCR;

        window.stop();
        // deleteRecord(Idnumber);
        table.ajax.reload();
      },
      //add this error handler you'll get alert
      error: function(request, status, error) {
        alert(error.responseText + "gjvjh");
      }
    });

  }

  function deleteRecord(Idnumber) {
    IDNumber = document.getElementById("IDNumber").value;
    var Idnumber = Idnumber;

    var url = '<?php echo base_url() . "index.php/RojmelController/deleteRecord/"; ?>' + Idnumber;

    $.ajax({
      type: "post",
      url: url,
      success: function(data) {
        alert("Deleted Successfully");
        updateref(IDNumber);
        table.ajax.reload();
        //var id=document.getElementById("IDNumber").value=parseInt(data[0].IDNumber);

      },
      //add this error handler you'll get alert
      error: function(request, status, error) {
        alert(error);

      }
    });


  }


  function saved() {
    var DebitCredit = $('#DRCR').val();
    var codeval1 = $('#GroupCode1').val();
    var TDR = $('#Total_DR').val();
    var TCR = $('#Total_CR').val();

    if (TDR != TCR) {
      alert("Value of debit and credit not matched");
    } else {
      alert("Entries Saved Successfully");
      location.href = '<?php echo base_url(); ?>index.php/RojmelController/rojshow/'

    }

  }

  function Back() {
    var sid = $('#IDNumber').val();
    saved();

    backval = confirm("Discard all the entries(Entries will be deleted parmanentely)");
    if (backval != true) {
      return false;
    } else {
      location.href = '<?php echo base_url(); ?>index.php/RojmelController/DeleteRojmel/' + sid;
    }

  }

  function BookCodeFrom($BookCode, $BookTitle, $GroupCode, $OpeningBal, $ClosingBal) {

    document.getElementById("BCode").value = $BookCode;
    document.getElementById("BTitle").value = $BookTitle;
    document.getElementById("GroupCode1").value = $GroupCode;
    //document.getElementById("Amount").value = $OpeningBal;
    document.getElementById("Balance").value = $ClosingBal;
    ShowHide();
    ClosingBal();
  }

  function ACCodeFrom($ACCode, $ACTitle, $GroupCode) {
    document.getElementById("ACCode").value = $ACCode;
    document.getElementById("ACTitle").value = $ACTitle;
    document.getElementById("Group").value = $GroupCode;

  }


  function openCommonNarrationForm() {
    document.getElementById("CommonNarrationForm").style.display = "block";

  }

  function closeCommonNarrationForm() {
    document.getElementById("CommonNarrationForm").style.display = "none";
  }

  function closePForm() {
    document.getElementById("PForm").style.display = "none";
  }

  function closeSForm() {
    document.getElementById("SForm").style.display = "none";
  }

  function openNarrationForm() {
    document.getElementById("NarrationForm").style.display = "block";

  }

  function closeNarrationForm() {
    document.getElementById("NarrationForm").style.display = "none";
  }


  function openBankForm() {
    document.getElementById("BankForm").style.display = "block";

  }

  function closeBankForm() {
    document.getElementById("BankForm").style.display = "none";
  }


  function focusnext(e) {
    $groupcode = document.getElementById("GroupCode1").value;
    if ($groupcode == "J") {
      var idarray = ["RojDate", "BCode", "ACCode", "DRCR", "Amount1", "Cheque_No", "ADD"];

    } else {
      var idarray = ["RojDate", "BCode", "Amount", "Nature", "ACCode", "DRCR", "Amount1", "Cheque_No", "Bank_but", "Narr_but", "PS_but", "ADD"];

    }

    try {
      for (var i = 0; i < idarray.length; i++) {
        if (e.keyCode === 13 && e.target.id === idarray[i]) {
          document.querySelector(`#${idarray[i + 1]}`).focus();
          // document.querySelector('#${idarray[i + 1]}').focus();
        }
      }
    } catch (error) {
      alert("Error:" + error);
    }
  }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

<body>

  <div class="container-fluid">
    <div class="card border-dark">
      <div class="card-header border-dark">
        <a style="float: right;" id="cancel" accesskey="b" class="btn btn-danger" tabindex="13" onClick="Back()">Back (Alt+B)</a>

        &nbsp;
        <input style="float: right;" type="reset" accesskey="x" tabindex="13" class="btn btn-danger  mr-2" name="Cancel" value="Clear (Alt+X)">
        &nbsp;
        <!-- <a style="float: right;" class="btn btn-success  mr-2" accesskey="a" disabled>Add Item (Alt+A)</a> -->

        <input style="float: right;" class="btn btn-success  mr-2" accesskey="s" tabindex="13" type="button" name="Save" id="Save" value="Save (Alt+S)" onclick="saved();">
        &nbsp;
        <h4 style="float: left;">Rojmel</h4>
      </div>
    </div>


    <div class="card-body" id="abc" style="font-size: 14px; text-align: left">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-8" style="margin-left:-15%">

              <div class="form-group row">
                <label class="control-label col-md-4" for="IDNumber">ID Number</label>
                <div class="col-md-4">

                  <input type="text" class="form-control" id="IDNumber" tabindex="1" onkeydown="focusnext(event)" name="IDNumber" value="<?php echo $maxid ?>" placeholder="Id">
                  <span class="text-danger"><?php echo form_error('IDNumber'); ?>
                  </span>


                </div>
                <div class="col-md-1">
                  <input type="text" class="form-control" id="UPid" hidden name="UPid">
                </div>
              </div>

              <div class="form-group row">
                <label class="control-label col-md-4" for="RojDate">Date</label>
                <div class="col-md-4">
                  <input style="width: 100%;" type="date" class="form-control" id="RojDate" tabindex="2" onkeydown="focusnext(event)" name="RojDate" value="<?php echo set_value('RojDate', $today); ?>" placeholder="RojDate" autofocus>
                  <span class="text-danger"><?php echo form_error('RojDate'); ?>
                  </span>
                </div>


              </div>

              <div class="form-group row">
                <label class="control-label col-md-4" for="BCodeLab">Book Code</label>
                <a id="BHelp" type="button" class="btn btn-info" data-toggle="modal" data-target="#BookModalFrom">
                  <i class="glyphicon glyphicon-th"></i>
                </a>

                <div class="col-md-2">
                  <input style="width: 100%;" type="text" class="form-control" id="BCode" name="BCode" tabindex="5" placeholder="">
                  <span class="text-danger"><?php echo form_error('BCode'); ?>
                  </span>
                </div>


                <div class="col-md-3">
                  <input style="margin-left:-25px; width: 100%;" type="text" class="form-control" id="BTitle" name="BTitle" tabindex="5" onkeydown="focusnext(event)" placeholder="" readonly>
                  <span class="text-danger"><?php echo form_error('BTitle'); ?>
                  </span>
                </div>

                <div class="col-md-2">
                  <input style="margin-left:-50px;width: 100%;" type="text" class="form-control" id="GroupCode1" name="GroupCode1" tabindex="6" onkeydown="focusnext(event)" placeholder="" readonly>
                  <span class="text-danger"><?php echo form_error('GroupCode'); ?>
                  </span>
                </div>

              </div>


            </div>
            <!-- New Change -->
            <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->

            <script>
              function moveCursorTo(e) {
                var Amount = $('#Amount').val();
                if (e.keyCode == 13) {
                  $('#Nature').focus();
                  $('#Amount1').val(Amount);
                }
              }

              function getval(select) {
                $('#PS_but').removeAttr('Disabled');
                if (select.value == 'Withdraw') {
                  $('#DRCR option[value=CR]').removeAttr('selected');
                  $('#DRCR option[value=DR]').attr('selected', 'selected');
                  $('#PS_but').val('P');
                  $('#ACCode').focus();
                } else if (select.value == 'Deposit') {
                  $('#DRCR option[value=DR]').removeAttr('selected');
                  $('#DRCR option[value=CR]').attr('selected', 'selected');
                  $('#PS_but').val('S');
                  $('#ACCode').focus();
                }
              }
            </script>
            <div class="col-md-4">

              <div class="form-group row" style="margin-right: -50%; align-content: right">
                <label class="control-label col-md-3 blue" id="LAmount" for="Amount">Amount</label>


                <div class="col-md-3">
                  <input type="text" class="form-control" id="Amount" tabindex="7" name="Amount" onkeydown="moveCursorTo(event)" value="" placeholder="Amount">
                  <span class="text-danger"><?php echo form_error('Amount'); ?>
                  </span>
                </div>
              </div>
              <!-- New Change end -->

              <div class="form-group row" style="margin-right: -50%; align-content: right">
                <label class="control-label col-md-3 blue" id="LNature" for="Nature">Nature</label>


                <div class="col-md-3">
                  <select name="Nature" id="Nature" onkeydown="focusnext(event)" onchange="getval(this);" value="<?php echo set_value('DRCR'); ?>" tabindex="8" placeholder="Nature">
                    <option value="1">Receipt</option>
                    <option value="2">Payment</option>
                  </select>
                </div>
              </div>
              <? //third part
              ?>

              <div class="form-group row" style="margin-right: -50%; align-content: right">
                <label class="control-label col-md-3 blue" id="LBalance" for="Balance">Balance</label>
                <div class="col-md-3">
                  <input type="text" class="form-control" id="Balance" onkeydown="focusnext(event)" name="Balance" tabindex="9" onblur="moveCursorBroker()" value="" placeholder="Balance" readonly>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label class="control-label col-md-1 blue" for="Total_DR">Transaction DR</label>
        <div class="col-md-1">
          <input type="text" class="form-control" id="Total_DR" tabindex="10" name="Total_DR" readonly>
        </div>

        <label class="control-label col-md-1 blue" for="Total_CR">Transaction CR</label>
        <div class="col-md-1">
          <input type="text" class="form-control" id="Total_CR" tabindex="12" name="Total_CR" value="" readonly>
        </div>


        <div class="col-md-2">
          <input type="button" id="Show_Narr" onclick="openCommonNarrationForm()" tabindex="14" name="Show_Narr" onblur="moveCursorSupplier()" value="Show Narration[F2]">
        </div>

      </div>

      <!-- Area1 List Modal -->
      <div class="modal fade" id="BookModalFrom" role="dialog">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" style="float: right;">Book List</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

              <table id="BookFrom" class="display" border="1">
                <thead>

                  <tr>
                    <th width="100">Book Code</th>
                    <th width="500">Account Title</th>
                    <th width="100">Group</th>
                    <th width="5">Select</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (!empty($BookList)) {
                    foreach ($BookList as $List) {
                  ?>

                      <tr>

                        <td class="text-left"><?php echo $List->ACCode; ?></td>
                        <td class="text-left"><?php echo $List->ACTitle; ?></td>
                        <td class="text-left"><?php echo $List->GroupCode; ?></td>


                        <td>
                          <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="BookCodeFrom('<?php echo $List->ACCode; ?>','<?php echo $List->ACTitle; ?>','<?php echo $List->GroupCode; ?>','<?php echo $List->OpeningBal; ?>','<?php echo $List->ClosingBal; ?>');">
                            <i class="glyphicon glyphicon-check"></i></a>
                        </td>
                      </tr>

                  <?php
                    }
                  } else {
                    echo "No Data found";
                  } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th width="100">Book Code</th>
                    <th width="500">Book Title</th>
                    <th width="100">Group</th>
                    <th width="5">Select</th>
                  </tr>
                </tfoot>
              </table>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>
      <!-- Area1 List Modal End -->

      &nbsp;
      <div id="bodys" class="card-body" style="margin-top: -25px;">
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered" style="border: none;">
              <thead>
                <tr class="yellow">
                  <th style="border: none;">Code</th>
                  <th class="blue" style="border: none;"></th>
                  <th class="blue" style="border: none;">Account title</th>
                  <th style="border: none;">Group</th>
                  <th class="blue" style="border: none;">DR/CR</th>
                  <th style="border: none;">Amount</th>
                  <th class="blue" style="border: none;">Cheque No</th>
                  <!-- <th style="border: none;">Lot No.</th> -->
                  <th class="blue" style="border: none;">Bank</th>
                  <th style="border: none;">Narr</th>
                  <th class="blue" style="border: none;">P/S</th>
                  <!-- <th style="border: none;">D/C</th> -->
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="border: none;">
                    <div class=row1>
                      <div class="column" style="float: left;">
                        <input type="text" class="form-control" id="ACCode" name="ACCode" value="<?php echo set_value('ACCode'); ?>">
                      </div>

                    </div>
          </div>
          </td>


          <td style="border: none;">
            <a id="BHelp" type="button" class="btn btn-info" data-toggle="modal" data-target="#AccountModal">
              <i class="glyphicon glyphicon-th"></i>
            </a>

          </td>


          <td style="border: none;"><input type="text" class="form-control" id="ACTitle" name="ACTitle" onkeydown="focusnext(event)" value="<?php echo set_value('ACTitle'); ?>" readonly>
            <span class="text-danger"><?php echo form_error('ACTitle'); ?></span>
          </td>
          <td style="border: none;">
            <div class=row1>
              <div class="column" style="float: left;">
                <input type="text" class="form-control" id="Group" name="Group" onkeydown="focusnext(event)" value="<?php echo set_value('Group'); ?>" readonly>
              </div>

            </div>
        </div>
        </td>
        <td style="border: none;">
          <select name="DRCR" id="DRCR" value="<?php echo set_value('DRCR'); ?>" onkeydown="focusnext(event)" onchange="apmcChange();">
            <option value="DR">DR</option>
            <option value="CR">CR</option>
        </td>
        <script>
          function CheckAmt(e) {
            var DetAmount = $('#Amount1').val();
            var HeadAmount = $('#Amount').val();
            if (e.keyCode == 13) {
              if (parseFloat(DetAmount) > parseFloat(HeadAmount)) {
                alert("Entered Amount is greater than Header Amount!!!");
                $("#Amount1").focus();
              } else {
                $("#Cheque_No").focus();
              }
            }
          }
        </script>
        <td style="border: none;"><input type="text" class="form-control" id="Amount1" name="Amount1" onkeydown="CheckAmt(event)" value="<?php echo set_value('Amount'); ?>">
          <span class="text-danger"><?php echo form_error('Amount'); ?></span>
        </td>
        <td style="border: none;"><input type="text" class="form-control" id="Cheque_No" name="Cheque_No" onblur="focusnext(event)" onkeydown="focusnext(event)" value="<?php echo set_value('Cheque_No'); ?>">
          <span class="text-danger"><?php echo form_error('Cheque_No'); ?></span>
        </td>

        <input type="hidden" class="form-control" id="Lot_No" name="Lot_No" onkeydown="focusnext(event)" value="<?php echo set_value('Lot_No'); ?>">
        <span class="text-danger"><?php echo form_error('Lot_No'); ?></span>

        <td style="border: none;">
          <div class="column" style="float: left;">
            <input type="button" id="Bank_but" name="Bank_but" onkeydown="focusnext(event)" onclick="openBankForm()" value="B">
          </div>
        </td>

        <td style="border: none;">
          <div class="column" style="float: left;">
            <input type="button" id="Narr_but" name="Narr_but" onclick="openNarrationForm()" onkeydown="focusnext(event)" value="N">
          </div>
        </td>
        <!-- 05-10-21 -->
        <script>
          function openPSForm(PS) {
            if (PS.value == "P") {
              $('#SForm').hide();
              $('#PForm').show();
            } else if (PS.value == "S") {
              $('#PForm').hide();
              $('#SForm').show();
            }
          }
        </script>

        <td style="border: none;">
          <div class="column" style="float: left;">
            <input disabled type="button" id="PS_but" name="PS_but" onclick="openPSForm(this)" onkeydown="focusnext(event)" value="P/S">
          </div>
        </td>


        <td style="border: none;">
          <div class="column" style="float: left;">
            <input type="button" id="ADD" accesskey="a" name="ADD" onkeydown="focusnext(event)" onclick="insert_rojmel()" value="ADD(ALT+A)">
            <a id="DEL" class="btn btn-default" accesskey="d" href="">DEL(Alt+D)</a>

          </div>
        </td>

        </tr>

        </tbody>
        </table>

        <table id="Rojmel1" class="cell-border" style="width:100%">
          <thead>
            <tr class="fsize yellow">
              <th>Action</th>
              <th>ACCode</th>
              <th>Account Title</th>
              <th>Group</th>
              <th>Book Code</th>
              <th>Amount</th>
              <th>DR/CR</th>
              <th>Cheque No</th>
              <th>Lot No.</th>
              <!-- <th>Bank</th>
                  <th>Narr</th>
                  <th>P/S</th>
                  <th>D/C</th> -->

            </tr>
          </thead>

          <!-- AJAX TABLE START -->
          <tbody>


          </tbody>

          <!-- AJAX TABLE END -->

        </table>
      </div>
    </div>
  </div>

  <div class="form-popup" id="NarrationForm">
    <form action="" class="form-container">
      <h4>[ Individual Narration ]</h4>
      <textarea id="Narration" rows="5" cols="50" name="Narration" form="NarrationForm" placeholder="Enter Narration here"></textarea>

      <div>
        <button type="button" class="btn" onclick="closeNarrationForm()">ADD</button>
        <button type="button" class="btn cancel" onclick="closeNarrationForm()">Close</button>
      </div>

    </form>
  </div>

  <div class="form-popup1" id="BankForm">
    <form action="" class="form-container">
      <h4>[ Cheque Bank Details ]</h4>
      <table border="0">
        <tr>
          <td>Bank code &nbsp;</td>
          <td><input type="text" id="BankCode" class="form-control" id="Bank_code" name="Bank code"></td>
        </tr>
        <tr>
          <td>Bank Title &nbsp;</td>
          <td><input type="text" id="BankTitle" class="form-control" id="Bank_Title" name="Bank Title"></td>
        </tr>
        <tr>
          <td>Branch &nbsp;</td>
          <td><input type="text" id="Branch" class="form-control" id="Branch" name="Branch"></td>
        </tr>
        <tr>
          <td>UTR No. &nbsp;</td>
          <td><input type="text" id="UTRNo" class="form-control" id="UTR_no" name="UTR Number"></td>
        </tr>
        <tr>
          <td>Slip No. &nbsp;</td>
          <td><input type="text" id="SlipNo" class="form-control" id="SlipNo" name="Slip Number"></td>
        </tr>
      </table>

      <div>
        <button type="button" class="btn" onclick="closeBankForm()">ADD</button>
        <button type="button" class="btn cancel" onclick="closeBankForm()">Close</button>
      </div>

    </form>
  </div>


  <div class="form-popup2" id="CommonNarrationForm">
    <h4>[ Common Narration ]</h4>
    <textarea id="CNarration" rows="5" cols="50" name="CommonNarration" form="CommonNarrationForm" placeholder="Enter Common Narration here"></textarea>

    <div>
      <button type="button" class="btn" onclick="closeCommonNarrationForm()">ADD</button>
      <button type="button" class="btn cancel" onclick="closeCommonNarrationForm()">Close</button>
    </div>

    </form>
  </div>


  <div class="form-popup3" id="PForm">
    <h4>[Purchase Details]</h4>
    <div>
      <div>
        <label for="RefNum" class="col-md-3">Ref ID</label>
        <input style="width: 70px;" type="text" id="RefIDNum" name="RefIDNum">
        <input id="SupplyHelp" type="hidden" class="btn btn-info" data-toggle="modal" data-target="#SupplyModal" />


        &nbsp;
        <label for="GdnDate">Gdn Date.</label>
        <input style="width: 70px;" size="4" type="text" id="GdnDate" name="GdnDate" readonly>
      </div>
      <div>
        <label class="col-md-3" for="BillNo">Bill No.</label>
        <input style="width: 70px;" size="4" type="text" id="BillNo" name="BillNo" readonly>
        &nbsp;
        <label for="BillDate">Bill Date.</label>
        <input style="width: 70px;" size="4" type="text" id="BillDate" name="BillDate" readonly>
      </div>
      <div>
        <label for="Party" class="col-md-3">Party</label>
        <input style="width: 70px;" size="4" type="text" id="PartyCode" name="PartyCode" readonly>
        <input style="width: 200px;" size="10" type="text" id="PartyName" name="PartyName" readonly>
      </div>
      <div>
        <label for="Broker" class="col-md-3">Broker</label>
        <input style="width: 70px;" size="4" type="text" id="BrokerCode" name="BrokerCode" readonly>
        <input style="width: 200px;" size="10" type="text" id="BrokerName" name="BrokerName" readonly>
      </div>
      <div>
        <label class="col-md-3" for="BillAmt">Bill Amt</label>
        <input style="width: 70px;" size="4" type="text" id="BillAmt" name="BillAmt" readonly>
        &nbsp;
        <label for="Settled">Settled Amt</label>
        <input style="width: 70px;" size="4" type="text" id="Settled" name="Settled" readonly>
      </div>
      <div>
        <label class="col-md-3" for="BillDue">Bill Due</label>
        <input style="width: 70px;" size="4" type="text" id="BillDue" name="BillDue" readonly>
        &nbsp;
        <button type="button" class="btn cancel" onclick="closePForm()">Close</button>
      </div>
    </div>

  </div>

  <script>
    $('#RefIDNum').click(function() {
      $('#SupplyHelp').click();
    });
    $(document).ready(function() {
      $('#SupplyHelp').on('click', function() {
        var Party = $('#ACCode').val();
        table = $('#supply').DataTable({
          "ajax": {
            "type": "post",
            "url": "<?= base_url() ?>index.php/RojmelController/GetFilteredDataParty/" + Party,
            "dataSrc": "Users"
          },
          "columns": [
            null,
            {
              "data": ["RefIDNumber"]
            },
            {
              "data": ["GoodsRcptDate"]
            },
            {
              "data": ["PartyCode"]
            },
            {
              "data": ["BrokerCode"]
            },
            {
              "data": ["InvoiceNo"]
            },
            {
              "data": ["InvoiceDate"]
            },
            {
              "data": ["NetPayable"]
            },
            {
              "data": ["TP"]
            },
            {
              "data": ["BalanceDue"]
            }
          ],
          columnDefs: [{
            'orderable': false,
            'className': 'select-checkbox',
            'targets': 0
          }],
          select: {
            'style': 'multi',
            'selector': 'td:first-child'
          },
          order: [
            [1, 'asc']
          ]

        });


        let SelectedTotal = 0;
        table.on('select', function(e, dt, type, indexes) {
          var rowData = table.rows(indexes).data().toArray();

          for (var i = 0; i < rowData.length; i++) {
            var x = parseFloat(rowData[i].BalanceDue);
            SelectedTotal = SelectedTotal + x;
            var y = document.getElementById("SelectedTotal").value = SelectedTotal.toFixed(2);
          }

          setTimeout(function() {
            $('#buttonsdsd').click();
            $('#SupplyModal .close').click();
          }, 500);
        }).on('deselect', function(e, dt, type, indexes) {
          var rowData = table.rows(indexes).data().toArray();
          for (var i = 0; i < rowData.length; i++) {
            var x = parseFloat(rowData[i].BalanceDue);
            SelectedTotal = SelectedTotal - x;
            var y = document.getElementById("SelectedTotal").value = SelectedTotal.toFixed(2);
          }

        })
      });


      $('#buttonsdsd').click(function() {
        var oData = table.rows('.selected').data();
        for (var i = 0; i < oData.length; i++) {
          var id = document.getElementById("Refid").value = oData[i].RefIDNumber;
          var date = oData[i].InvoiceDate;
          var PartyCode = document.getElementById("PartyCode1").value = oData[i].PartyCode;
          var PartyName = document.getElementById("PartyName").value = oData[i].PartyName;
          var Billno = document.getElementById("BillNo").value = oData[i].InvoiceNo;
          var Billdate = document.getElementById("BillDate").value = oData[i].InvoiceDate;
          var Transdate = document.getElementById("BillGdnDateDate").value = oData[i].GoodsRcptDate;

          var BillAmount = document.getElementById("BillAmt").value = oData[i].NetPayable;

          var AmountSettled = document.getElementById("Settled").value = oData[i].TotalPaid;
          var BalanceDue = document.getElementById("BillDue").value = oData[i].BalanceDue;

          var SelectedTotal = document.getElementById("SelectedTotal").value = "";

          table.clear().draw();
        }
      });

    });
  </script>


  <div class="form-popup3" id="SForm">
    <h4>[Sales Details]</h4>
    <div>
      <div>
        <label for="SaleBillNO" class="col-md-3">BillNo</label>
        <input style="width: 70px;" type="text" id="SBillNO" name="SBillNO">
        &nbsp;
        <label for="SaleBillDate">Bill Date.</label>
        <input style="width: 70px;" size="4" type="text" id="SBillDate" name="SBillDate" readonly>
      </div>
      <div>
        <label for="SParty" class="col-md-3">Party</label>
        <input style="width: 70px;" size="4" type="text" id="SPartyCode" name="SPartyCode" readonly>
        <input style="width: 200px;" size="10" type="text" id="SPartyName" name="SPartyName" readonly>
      </div>
      <div>
        <label class="col-md-3" for="Name">Name</label>
        <input style="width: 270px;" size="4" type="text" id="Name" name="Name" readonly>
      </div>
      <div>
        <label for="SBroker" class="col-md-3">Broker</label>
        <input style="width: 70px;" size="4" type="text" id="SBrokerCode" name="SBrokerCode" readonly>
        <input style="width: 200px;" size="10" type="text" id="SBrokerName" name="SBrokerName" readonly>
      </div>
      <div>
        <label class="col-md-3" for="SBillAmt">Bill Amt</label>
        <input style="width: 70px;" size="4" type="text" id="SBillAmt" name="SBillAmt" readonly>
        &nbsp;
        <label for="SSettled">Settled Amt</label>
        <input style="width: 70px;" size="4" type="text" id="SSettled" name="SSettled" readonly>
      </div>
      <div>
        <label class="col-md-3" for="SBillDue">Bill Due</label>
        <input style="width: 70px;" size="4" type="text" id="SBillDue" name="SBillDue" readonly>
        &nbsp;
        <button type="button" class="btn cancel" onclick="closeSForm()">Close</button>
      </div>
    </div>

  </div>
  <script type="text/javascript" src=" https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.min.js"></script>


  <!-- Account List Modal -->
  <div class="modal fade" id="AccountModal" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="float: right;">Account List</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">

          <table id="AccountFrom" class="display" border="1">
            <thead>

              <tr>
                <th width="100">Account Code</th>
                <th width="500">Account Title</th>
                <th width="100">Group</th>
                <th width="5">Select</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (!empty($ACList)) {
                foreach ($ACList as $List) {
              ?>

                  <tr>

                    <td class="text-left"><?php echo $List->ACCode; ?></td>
                    <td class="text-left"><?php echo $List->ACTitle; ?></td>
                    <td class="text-left"><?php echo $List->GroupCode; ?></td>
                    <td>
                      <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="ACCodeFrom('<?php echo $List->ACCode; ?>','<?php echo $List->ACTitle; ?>','<?php echo $List->GroupCode; ?>');">
                        <i class="glyphicon glyphicon-check"></i></a>
                    </td>
                  </tr>

              <?php
                }
              } else {
                echo "No Data found";
              } ?>
            </tbody>
            <tfoot>
              <tr>
                <th width="100">Account Code</th>
                <th width="500">Account Title</th>
                <th width="100">Group</th>
                <th width="5">Select</th>
              </tr>
            </tfoot>
          </table>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <!-- Area1 List Modal End -->



  <!-- Dropdown Code for Book  Code-->
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
  <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
  </link>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script type='text/javascript'>
    $(document).ready(function() {
      $("#BCode").autocomplete({
        source: function(request, cb) {
          console.log(request);

          $.ajax({
            url: "<?= base_url() ?>index.php/RojmelController/RojmelData/" + request.term,
            method: 'POST',
            dataType: 'json',
            success: function(res) {
              var result;
              result = [{
                label: '',
                value: ''
              }];

              console.log("Before format", res);
              // alert(res);

              if (res.length) {
                result = $.map(res, function(obj) {
                  return {
                    label: obj.ACCode + " / " + obj.ACTitle + "/" + obj.GroupCode,
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
            $('#BTitle').val(data.ACTitle);
            $('#GroupCode1').val(data.GroupCode); //AC Title

            ShowHide();
            ClosingBal();
          }
        }
      });
      $("#BCode").keydown(function(event) {
        if (event.keyCode == 13)
          var BCodevalue = $("#GroupCode1").val();
        if (BCodevalue == "J") {
          $("#ACCode").focus();

        } else {
          $("#Amount").focus();

        }
      });
    });
  </script>
  <!-- DropDown Code end for Book  Code-->


  <!-- Dropdown Code for ACCOUNT  Code-->
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
  <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
  </link>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script type='text/javascript'>
    $(document).ready(function() {
      $("#ACCode").autocomplete({
        source: function(request, cb) {
          console.log(request);

          $.ajax({
            url: "<?= base_url() ?>index.php/RojmelController/RojmelAccountData/" + request.term,
            method: 'POST',
            dataType: 'json',
            success: function(res) {
              var result;
              result = [{
                label: '',
                value: ''
              }];

              console.log("Before format", res);
              // alert(res);

              if (res.length) {
                result = $.map(res, function(obj) {
                  return {
                    label: obj.ACCode + " / " + obj.ACTitle + "/" + obj.GroupCode,
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
            $('#ACTitle').val(data.ACTitle);
            $('#Group').val(data.GroupCode); //AC Title

          }

        }
      });
      $("#ACCode").keydown(function(event) {
        if (event.keyCode == 13)
          $("#Amount1").focus();
      });


    });
  </script>
  <!-- DropDown Code end for ACCOUNT  Code-->

  <div class="modal fade" id="SupplyModal" role="dialog">
    <div id="modal-size" class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="float: right;">Supplier List</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">

          <table id="supply" class="display" border="1">
            <thead>
              <tr>
                <th>Select</th>
                <th>RefNo</th>
                <th>Rcptdate</th>
                <th>Party</th>
                <th>Broker</th>
                <th>Invoice no</th>
                <th>Invoice date</th>
                <th>Net Payable</th>
                <th>Total Paid</th>
                <th>Bal Due</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group row">
              <div class="col-sm-3">
                <button style="margin-left:15px;" id="buttonsdsd" class="btn btn-default" data-dismiss="modal">Submit</button>
              </div>

              <div class="col-sm-4"></div>
              <label class="control-label col-sm-2" for="SelectedTotal">Selected Total.</label>
              <div class="col-sm-2">
                <input type="text" name="SelectedTotal" class="form-control" id="SelectedTotal" value="" placeholder="Selected Total">
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group row">
              <div class="col-sm-3">
                <!-- <button type="button" style="margin-left:15px;" class="btn btn-default" data-dismiss="modal">Close</button> -->
              </div>

              <div class="col-sm-4"></div>
            </div>
          </div>
        </div>

        <div id="footer" class="modal-footer"></div>
      </div>
    </div>
  </div>
</body>

</html>