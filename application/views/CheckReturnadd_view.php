<!DOCTYPE html>
<html>
<?php
$date = date('Y-m-d');
?>

<head>
  <title>Check Return</title>

  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
      <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

  <!-- Autofocus in Modal -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


  <style type="text/css">
    #collectionHeader,
    #collectionHeaderTotal {
      opacity: 0.6;
      pointer-events: none;
    }

    .ui-autocomplete {
      height: 200px;
      overflow-y: scroll;
      overflow-x: hidden;
    }

    .control-label {
      word-wrap: normal;
    }

    .ui-front {
      z-index: 1500 !important;
    }

    #DebtorCode,
    #DebtorName,
    #Name,
    #BrokerCode,
    #BrokerName,
    #RcptAmt,
    #SaleType,
    #CheqReturn,
    #BillAmt,
    #SalesReturn,
    #BIllDate1,
    #DebtorAmt,
    #SettledAmt,
    #ItemAmt,
    #CreditAmt,
    #Balance,
    #SUG,
    #BazarInd,
    #PartyCode,
    #PartyName,
    #Customer,
    #Area,
    #SalesMan,
    #BrokerCode1,
    #BrokerName1 {
      background-color: #AED6F1;
    }

    .pink {
      background-color: #FFB6C1;
    }

    .blue {
      background-color: #AED6F1;
    }

    .yellow {
      background-color: #FFD28D;
    }

    #extraBillNo {
      color: red;
      font-weight: bold;
      font-size: 20x;
    }

    @media (min-width: 992px) {
      .modal-xl {
        width: 100%;
      }
    }

    .tableData1 td input {
      font-size: inherit;
      padding: 0px;
    }

    .tableData1,
    .tableData2 {
      margin: 0 auto;
      width: 100%;
      clear: both;
      border-collapse: collapse;
      table-layout: auto;
      word-wrap: break-word;
    }

    .modal-dialog {
      overflow-y: initial !important
    }

    .modal-body {
      height: 80vh;
      overflow-y: auto;
      overflow-x: hidden;
    }

    .readonly {
      background-color: lightgrey;
    }
  </style>
</head>
<script>
  // $("#AddCheque").click(function() {
  // alert("Clicked");
  function insertData() {
    // alert("Clicked");
    var RefIDNumber = $('#refer_no').val();
    var ReturnDate = $('#return_date').val();
    var CRChrg = $('#returnChrg').val();
    var ReturnAmt = $('#return_amt').val();
    var CheqNo = $('#cheque_no').val();
    var BankCode = $('#deposite_code').val();

    $.ajax({
      method: "POST",
      url: "<?= base_url('index.php/CheckReturnController/InsertCheque/'); ?>",
      data: {
        RefIDNumber: RefIDNumber,
        ReturnDate: ReturnDate,
        ReturnAmt: ReturnAmt,
        CRChrg: CRChrg,
        CheqNo: CheqNo,
        BankCode: BankCode
      },
      dataType: 'json',
      success: function(result) {
        // console.log(result);
        // for (var i = 0; i < result.length; i++) {
        //   alert(result[i]['BillNo']);
        // }
        alert('Cheque Return Entered...');
        $('#debtor_code').val('');
        $('#debtor_name').val('');
        $('#broker_code').val('');
        $('#broker_name').val('');
        $('#bank_code').val('');
        $('#check_amt').val('');
        $('#cheque_no').val('');
        $('#bill_no').val('');
        $('#deposite_code').val('');
        $('#deposite_name').val('');
        $('#party_name').val('');
        $('#return_amt').val('');
        $('#receipt_date').val('');
        $('#return_date').val('<?php echo $date; ?>');
        $('#refer_no').val('');
        $('#returnChrg').val('');
        $('#extraBillNo').html('');
      }
    });
    // 
  }
</script>
<script>
  function focusnext(e) {
    var idarray = ["return_date", "refer_no", "returnChrg", "AddCheque"];
    for (var i = 0; i < idarray.length; i++) {
      if (e.keyCode === 13 && e.target.id === idarray[i]) {
        document.querySelector(`#${idarray[i + 1]}`).focus();
      }
    }
  }
</script>

<body>

  <div class="container-fluid">
    <div class="card border-dark">
      <div class="card-header border-dark">
        <div class="row">
          <div class="col-md-10">
            <h4>Check Return</h4>
          </div>
          <div class="col-md-2">
            <a style="float: right;" id="cancel" accesskey="c" class="btn btn-danger" href="<?php echo base_url() . "index.php/CheckReturnController/show" ?>">Back (Alt+C)</a>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="form-group">
        <div class="row" style="margin-left: 10px;">
          <div class="col-md-7" style="border-style: inset;padding: 5px;">
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Debtor Code</label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input type="text" class="form-control readonly" name="debtor_code" id="debtor_code" readonly />
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <input type="text" class="form-control readonly" name="debtor_name" id="debtor_name" readonly />
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Party Name</label>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group">
                  <input type="text" class="form-control readonly" name="party_name" id="party_name" readonly />
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Borker Code</label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input type="text" class="form-control readonly" name="broker_code" id="broker_code" readonly />
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <input type="text" class="form-control readonly" name="broker_name" id="broker_name" readonly />
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Check Amt</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" class="form-control readonly" name="check_amt" id="check_amt" readonly />
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Receipt Date</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" class="form-control readonly" name="receipt_date" id="receipt_date" readonly />
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Cheque Bank</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" class="form-control readonly" name="bank_code" id="bank_code" readonly />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" class="form-control readonly" name="cheque_bank" id="cheque_bank" readonly />
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label>Cheque No</label>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group">
                  <input type="text" class="form-control readonly" name="cheque_no" id="cheque_no" readonly />
                </div>
              </div>
            </div>
            <hr style="margin-top:5px !important;margin-bottom: 15px !important;">
            <div class="row">
              <!-- <div class="col-md-2">
                <div class="form-group">
                  <label>ID Number</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" class="form-control" name="debtor_code" id="debtor_code" />
                </div>
              </div> -->
              <!-- <div class="col-md-6"></div> -->
              <div class="col-md-2">
                <div class="form-group">
                  <label>Return Date</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="date" class="form-control" autofocus onkeydown="focusnext(event)" name="return_date" id="return_date" value="<?php
                                                                                                                                            echo $date; ?>" />
                </div>
              </div>
              <div class="col-md-6"></div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Reference No.</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" class="form-control" name="refer_no" id="refer_no" onblur="getDetOnblur()" onkeydown="getDetails(event)" />
                </div>
              </div>
              <div class="col-md-6"></div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Cheq Return Chrg</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" class="form-control" onkeydown="focusnext(event)" name="returnChrg" id="returnChrg" />
                </div>
              </div>
              <div class="col-md-6"></div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Bill no</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" class="form-control" name="bill_no" id="bill_no" />
                  <span class="form-group" id="extraBillNo"></span>
                </div>

              </div>
              <div class="col-md-6"></div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Return Amt</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" class="form-control" name="return_amt" id="return_amt" />
                </div>
              </div>
              <div class="col-md-6"></div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Deposite Bank</label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input type="text" class="form-control" name="deposite_code" id="deposite_code" />
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <input type="text" class="form-control" name="deposite_name" id="deposite_name" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer" style="background-color: #19469f !important ;border-color:#19469f !important;">
      <div class="form-group">
        <button class="btn btn-success" id="AddCheque" onclick="insertData();">Save</button>
        <!-- <button class="btn btn-danger">Show Naration</button> -->
      </div>
    </div>
</body>

<!-- Autocomplete for Party Code, Party Name, Customer Name, Broker Code, Broker Name -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
</link>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  function getDetails(e) {
    if (e.keyCode == 13 || e.keyCode == 9) {
      $('#extraBillNo').html('');
      var refer_no = $('#refer_no').val();
      console.log(refer_no);
      $.ajax({
        method: "POST",
        url: "<?= base_url(); ?>index.php/CheckReturnController/CheckCheque/" + refer_no,
        data: {
          RefIDNumber: refer_no,
        },
        dataType: 'json',
        success: function(result) {
          // console.log();
          if (result[0]['Number'] == 0) {
            $.ajax({
              method: "POST",
              url: "<?= base_url('index.php/CheckReturnController/getdetails'); ?>",
              data: {
                refer_no: refer_no
              },
              dataType: 'json',
              beforeSend: function() {
                $('#btn_change_submit').text('Processing...').attr('disabled', 'disabled');
              },
              success: function(result) {
                console.log(result);
                var response = result[0];
                var BillNos = "";
                $('#debtor_code').val(response.DebtorCode);
                $('#debtor_name').val(response.DebtorName);
                $('#broker_code').val(response.BrokerCode);
                $('#broker_name').val(response.BrokerName);
                $('#bank_code').val(response.CheqBankCode);
                $('#check_amt').val(response.TotalChqAmt);
                $('#cheque_no').val(response.CheqNo);
                $('#bill_no').val(response.BillNo);
                $('#deposite_code').val(response.DepBankcode);
                $('#deposite_name').val(response.BankName);
                $('#party_name').val(response.PartyName);
                $('#return_amt').val(response.TotalChqAmt);
                $('#receipt_date').val(response.CollectDate);
                for (var i = 1; i < result.length; i++) {
                  BillNos = BillNos + ', ' + result[i].BillNo;
                  $('#extraBillNo').html(BillNos);
                }
                $('#returnChrg').focus();

              }
            });
          } else {
            alert("Already Entered!");
            $('#debtor_code').val('');
            $('#debtor_name').val('');
            $('#broker_code').val('');
            $('#broker_name').val('');
            $('#bank_code').val('');
            $('#check_amt').val('');
            $('#cheque_no').val('');
            $('#bill_no').val('');
            $('#deposite_code').val('');
            $('#deposite_name').val('');
            $('#party_name').val('');
            $('#return_amt').val('');
            $('#receipt_date').val('');
            $('#return_date').val('<?php echo $date; ?>');
            $('#refer_no').val('');
            $('#returnChrg').val('');
            $('#extraBillNo').html('');
            $('#refer_no').focus();
          }
        }
      })
    }
  }
</script>
<script>
  function getDetOnblur() {
    $('#extraBillNo').html('');
    var refer_no = $('#refer_no').val();
    console.log(refer_no);
    $.ajax({
      method: "POST",
      url: "<?= base_url(); ?>index.php/CheckReturnController/CheckCheque/" + refer_no,
      data: {
        RefIDNumber: refer_no,
      },
      dataType: 'json',
      success: function(result) {
        // console.log();
        if (result[0]['Number'] == 0) {
          $.ajax({
            method: "POST",
            url: "<?= base_url('index.php/CheckReturnController/getdetails'); ?>",
            data: {
              refer_no: refer_no
            },
            dataType: 'json',
            beforeSend: function() {
              $('#btn_change_submit').text('Processing...').attr('disabled', 'disabled');
            },
            success: function(result) {
              console.log(result);
              var response = result[0];
              var BillNos = "";
              $('#debtor_code').val(response.DebtorCode);
              $('#debtor_name').val(response.DebtorName);
              $('#broker_code').val(response.BrokerCode);
              $('#broker_name').val(response.BrokerName);
              $('#bank_code').val(response.CheqBankCode);
              $('#check_amt').val(response.TotalChqAmt);
              $('#cheque_no').val(response.CheqNo);
              $('#bill_no').val(response.BillNo);
              $('#deposite_code').val(response.DepBankcode);
              $('#deposite_name').val(response.BankName);
              $('#party_name').val(response.PartyName);
              $('#return_amt').val(response.TotalChqAmt);
              $('#receipt_date').val(response.CollectDate);
              for (var i = 1; i < result.length; i++) {
                BillNos = BillNos + ', ' + result[i].BillNo;
                $('#extraBillNo').html(BillNos);

              }
              $('#returnChrg').focus();


            }
          });
        } else {
          alert("Already Entered!");
          $('#debtor_code').val('');
          $('#debtor_name').val('');
          $('#broker_code').val('');
          $('#broker_name').val('');
          $('#bank_code').val('');
          $('#check_amt').val('');
          $('#cheque_no').val('');
          $('#bill_no').val('');
          $('#deposite_code').val('');
          $('#deposite_name').val('');
          $('#party_name').val('');
          $('#return_amt').val('');
          $('#receipt_date').val('');
          $('#refer_no').val('');
          $('#returnChrg').val('');
          $('#extraBillNo').html('');
          $('#refer_no').focus();
        }
      }
    })

  }
</script>

</html>

<!-- CoID,
WorkYear,
IDNumber,
RefIDNumber,
ReturnDate,
CRChrg,
ReturnAmt,
CheqNo,
BankCode -->