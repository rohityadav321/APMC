<?php
include 'header-form.php';

$timezone = "Asia/Colombo";
date_default_timezone_set($timezone);
$today = date("Y-m-d");
?>
<html>

<head>

  <title>Export HTML Table Data to Excel using JavaScript | Tutorialswebsite</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script type="text/javascript">
    function exportToExcel(tableID, filename = '') {
      var downloadurl;
      var dataFileType = 'application/vnd.ms-excel';
      var tableSelect = document.getElementById(tableID);
      var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');

      // Specify file name
      filename = filename ? filename + '.xls' : 'export_excel_data.xls';

      // Create download link element
      downloadurl = document.createElement("a");

      document.body.appendChild(downloadurl);

      if (navigator.msSaveOrOpenBlob) {
        var blob = new Blob(['\ufeff', tableHTMLData], {
          type: dataFileType
        });
        navigator.msSaveOrOpenBlob(blob, filename);
      } else {
        // Create a link to the file
        downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;

        // Setting the file name
        downloadurl.download = filename;

        //triggering the function
        downloadurl.click();
      }
    }
  </script>
  <style>
    td {
      padding: 0 5px;

    }
  </style>
</head>

<body>
  <div>
    <table id="receiptTable" style="margin:10px" border="2">
      <tr style="font-size: 12px;height:20px;">
        <td colspan="10" style="text-align: center;">
          Current A/C Pay-in-Slip
        </td>
      </tr>
      <tr style="font-size: 16px;height:30px;">
        <td colspan="10">
          <div>Bank Name :
            <?php
            foreach ($Slip as $res) {
              $BankName = $res['BankName'];
              $AccountType = $res['AccountType'];
              $AccountNo = $res['AccountNo'];
              break;
            }
            ?>
            <label id="BankName"><?php echo $BankName; ?></label>
          </div>
        </td>
      </tr>
      <tr>
        <td style="font-size: 16px;" colspan="10">
          <div>Paid in the credit of the Current Account of :
            <label id="seller"><?php echo $Company[0]->CoName; ?></label>
          </div>
        </td>
      </tr>
      <tr>
        <td style="font-size: 16px;" colspan="10">
          <div>Mobile Number :
            <Label id="seller"><?php echo $Company[0]->phone ?></Label>
          </div>
        </td>
      </tr>
      <tr>
        <td style="font-size: 15px; border:none;" colspan="2">
          <div>
            Account Type :
            <label><?php echo $AccountType; ?></label>
          </div>
        </td>
        <td style="font-size: 15px; border:none;" colspan="4">
          <div>A/C Number :
            <Label><?php echo $AccountNo; ?></Label>
          </div>
        </td>
        <td style="font-size: 15px; border:none;" colspan="4">
          <div>
            Date :
            <!-- <Label id="date"><?php echo $SlipHead[0]->CollectDate ?></Label> -->
            <Label id="date"><?php echo date_format(date_create($SlipHead[0]->CollectDate), "d/m/Y"); ?></Label>
          </div>
        </td>
        <!-- <td style="font-size: 15px; border:none; " colspan="2">
          <div>
            Page No.
            <Label>1</Label>
          </div>
        </td> -->
      </tr>
      <tr style="height: 40px;font-weight: bold;background-color: aqua;">
        <td style="width: 5%;font-size: 15px; text-align:right;">
          <div>No.</div>
        </td>
        <td style="width: 20%;font-size: 15px;">
          <div>
            Party Name
          </div>
        </td>
        <td style="width: 10%;font-size: 15px;">
          <div>Area</div>
        </td>

        <td style="width: 10%;font-size: 15px;">
          <div>Chq No</div>
        </td>
        <td style="width: 10%;font-size: 15px;">
          <div>Bank Name</div>
        </td>
        <td style="width: 10%;font-size: 15px;">
          <div>Branch</div>
        </td>
        <td style="width: 10%;font-size: 15px; text-align:right;">
          <div>Amount</div>
        </td>
        <td style="width: 10%;font-size: 15px;">
          <div>Entry Type</div>
        </td>
        <td style="width: 10%;font-size: 15px;">
          <div>Cheque Date</div>
        </td>
        <td style="width: 10%;font-size: 15px;">
          <div>UTR No.</div>
        </td>
      </tr>
      <?php


      $i = 1;
      foreach ($Slip as $res) {
        if ($res['ChqDate'] == 'null') {
          $ac = '';
        } else {
          $ac = date_format(date_create($res['ChqDate']), "d/m/Y");
        }
        echo '<tr><td style="width: 5%;font-size: 15px; text-align:right;">' .  $i . '</td>
        <td style="width: 20%;font-size: 15px; ">' . $res['PartyName'] . '</td>
        <td style="width: 10%;font-size: 15px; ">' . $res['PartyArea'] . '</td>
        <td style="width: 10%;font-size: 15px; ">' . $res['CheqNo'] . '</td>
        <td style="width: 10%;font-size: 15px; ">' . $res['BankTitle'] . '</td>
        <td style="width: 10%;font-size: 15px; ">' . $res['BankBranch'] . '</td>
        <td style="width: 10%;font-size: 15px; text-align:right; ">' . $res['ChequeAmt'] . '</td>
        <td style="width: 10%;font-size: 15px; ">' . $ac . '</td></tr>';

        $i++;
      }

      $TotalAmount = 0;
      foreach ($Slip as $res) {
        $TotalAmount += $res['ChequeAmt'];
      }
      ?>

      <tr>
        <td style="text-align:right; border:none; font-size: 15px;" colspan="6">
          Total :
        </td>
        <td style="text-align:right;  border:none; font-size: 15px;">
          <!-- <label id="FinalTotal"><?php echo $SlipHead[0]->TotalChqAmt ?></label> -->
          <label id="FinalTotal"><?php echo sprintf("%.2f", $TotalAmount) ?></label>
        </td>
        <td style="text-align:right; border:none; font-size: 15px;" colspan="3">
        </td>
      </tr>

      <tr>
        <td style=" font-size: 15px;" colspan="10">
          In Words: <b><?php echo $rwords; ?></b>
        </td>
      </tr>


    </table>
    <button style="margin-left:10px" onclick="exportToExcel('receiptTable', 'user-data')" class="btn btn-success">Export Table Data To Excel File</button>
    <button onclick="window.print()" class="btn btn-success">Print</button>
  </div>

</body>

</html>