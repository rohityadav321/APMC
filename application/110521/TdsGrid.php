<?php
include 'header.php';
?>

<!DOCTYPE html>
<html>

<head>
  <title>TDS</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>

  <style>
    #numericCol {
      align-content: flex-end;
      text-align: right;
    }

    #textCol {
      text-align: left;
    }

    table {
      width: 100%;
      margin: 0 auto;
      clear: both;
      border-collapse: collapse;
      table-layout: auto;
      word-wrap: break-word;
    }
  </style>

  <script type="text/javascript">
    $(document).ready(function() {
      // Setup - add a text input to each footer cell
      $('#example tfoot th').each(function() {
        var title = $(this).text();
        $(this).html('<input type="text" style="width:150px; float:left;" placeholder="Search " />');
      });
      $('#example tfoot tr').appendTo('#example thead');

      // DataTable

      var table2 = $('#example').DataTable({

        initComplete: function() {
          responsive: true
          // Apply the search
          var api = this.api();
          api.columns().every(function() {
            var that = this;

            $('input', this.header()).on('keyup change clear', function() {
              if (that.search() !== this.value) {
                that
                  .search(this.value)
                  .draw();
              }
            });
          });

        },
        responsive: true,
      });

    });

    function isdeleteconfirm() {

      if (!confirm('Are you sure you want to delete ?')) {
        event.preventDefault();
        return;
      }
      return true;
    }

    function isupdateconfirm() {

      if (!confirm('Are you sure you want to Update ?')) {
        event.preventDefault();
        return;
      }
      return true;
    }

    // function changePage() {
    //   location.href = 'garuPurchaseHeader.php';

    // }
  </script>

</head>


<body>

  <div class="container-fluid">
    <!-- <center>
               <?php
                $CoName =  str_ireplace("%20", " ", $this->session->userdata('CoName'));
                $WorkYear = $this->session->userdata('WorkYear');
                ?>
          <legend><?php echo  $CoName . ' - ' . $WorkYear; ?> - Sales</legend>
        </center>
 -->
    <div class="col-lg-12 text-right">
      <a class="btn btn-success" accesskey="a" href="<?php echo base_url() ?>index.php/PaymentTdsController/Tds">
        <i class="glyphicon glyphicon-plus"></i>
        Insert TDS (Alt+A)
      </a>
    </div>

    <table id="example" class="display">
      <thead>
        <tr>
          <th style="width:20%;">Action</th>
          <th style="width:20%;">ID Number</th>
          <th style="width:20%;">Broker</th>
          <th style="width:20%;">Gross Amt</th>
          <th style="width:20%;">Total TDS</th>
          <th style="width:20%;">Totsl Paid</th>
          <th style="width:20%;">Cash/Bank Name</th>
        </tr>
      </thead>

      <tbody>
        <?php for ($i = 0; $i < count($Item_List); $i++) { ?>
          <tr>
            <td>
              <a onclick="isupdateconfirm();" href="<?php echo base_url() . "index.php/PaymentTdsController/Updateview/" . $Item_List[$i]->IDNumber; ?>">
                <button class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></button>
              </a>

              <a onclick="isdeleteconfirm();" href="<?php echo base_url() . "index.php/PaymentTdsController/DeleteEntry/" . $Item_List[$i]->IDNumber; ?>">
                <button class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button>
              </a>

              <a href="<?php echo base_url() . "index.php/PaymentTdsController/printoutward/" . $Item_List[$i]->IDNumber; ?>">
                <button class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-print"></i></button>
              </a>
            </td>
            <td id="textCol"><?php echo $Item_List[$i]->IDNumber; ?></td>
            <td id="textCol"><?php echo $Item_List[$i]->BrokName; ?></td>
            <td id="textCol"><?php echo $Item_List[$i]->GrossAmt; ?></td>
            <td id="textCol"><?php echo $Item_List[$i]->TotTDSAmt; ?></td>
            <td id="textCol"><?php echo $Item_List[$i]->TotalPaid; ?></td>
            <td id="textCol"><?php echo $Item_List[$i]->CashBankName; ?></td>
          </tr>
        <?php } ?>
      </tbody>

      <tfoot>
        <tr>
          <th style="width:20%;">Action</th>
          <th style="width:20%;">ID Number</th>
          <th style="width:20%;">Broker</th>
          <th style="width:20%;">Gross Amt</th>
          <th style="width:20%;">Total TDS</th>
          <th style="width:20%;">Totsl Paid</th>
          <th style="width:20%;">Cash/Bank Name</th>
        </tr>
      </tfoot>
    </table>
  </div>
</body>

</html>

<?php
include 'footer.php';
?>