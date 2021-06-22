<?php
include 'header.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sales</title>
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
            overflow-x: auto;
            white-space: nowrap;
            width: 100%;
            clear: both;
            border-collapse: collapse;
            table-layout: auto;
            word-wrap: break-word;
        }
    </style>

    <!-- table{
  text-align: right;
  margin: 0 auto;
  width: 100%;
  clear: both;
  border-collapse: collapse;
  table-layout: auto; // ***********add this
  word-wrap:break-word; // ***********and this
} -->

    <script type="text/javascript">
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#example tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" style="width:70px; float:left;" placeholder="Search " />');
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
                'responsive': true,
                scrollX: true,
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
        <div class="col-lg-12 text-left">
            <a class="btn btn-success" accesskey="a" href="<?php echo base_url() ?>index.php/SalesReturnController/salesReturnEntry/">
                <i class="glyphicon glyphicon-plus"></i>
                Insert Invoice (Alt+A)
            </a>
        </div>

        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Action</th>
                    <!-- <th>Invoice</th> -->
                    <th>ID Number</th>
                    <th>Return Date</th>
                    <th>Bill No</th>
                    <th>Bill Date</th>
                    <th>Godown ID</th>
                    <th>Party Code</th>
                    <th>Party Name</th>
                    <th>BrokerCode</th>
                    <th>Broker Name</th>
                    <th>Bill Rtn Amt</th>
                </tr>
            </thead>

            <tbody>
                <?php for ($i = 0; $i < count($Item_List); $i++) { ?>
                    <tr>
                        <td>
                            <a onclick="isupdateconfirm();" href="<?php echo base_url() . "index.php/SalesReturnController/updateSalesReturn/" . $Item_List[$i]->IDNumber; ?>">
                                <button class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></button>
                            </a>
                            <a onclick="isdeleteconfirm();" href="<?php echo base_url() . "index.php/SalesReturnController/DeleteFromGrid/" . $Item_List[$i]->IDNumber; ?>">
                                <button class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button>
                            </a>
                            <a target="_blank" href="<?php echo base_url() .
                                                            "index.php/SalesReturnController/getSalesReturnVoucher/" . $Item_List[$i]->IDNumber;   ?>">
                                <button class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-print"></i></button>
                            </a>
                        </td>
                        <td id="textCol"><?php echo $Item_List[$i]->IDNumber; ?></td>
                        <td id="textCol"><?php echo date_format(date_create($Item_List[$i]->CashDate), 'd/m/y'); ?></td>
                        <td id="textCol"><?php echo $Item_List[$i]->BillNo; ?></td>
                        <td id="textCol"><?php echo date_format(date_create($Item_List[$i]->BillDate), 'd/m/y'); ?></td>
                        <td id="textCol"><?php echo $Item_List[$i]->GodownID; ?></td>
                        <td id="textCol"><?php echo $Item_List[$i]->CPName; ?></td>
                        <td id="textCol"><?php echo $Item_List[$i]->PartyTitle; ?></td>
                        <td id="textCol"><?php echo $Item_List[$i]->BrokerID; ?></td>
                        <td id="textCol"><?php echo $Item_List[$i]->BrokerTitle; ?></td>
                        <td id="numericCol"><?php echo $Item_List[$i]->RetAmt; ?></td>
                    </tr>
                <?php } ?>
            </tbody>

            <tfoot>
                <tr>
                    <th>Action</th>
                    <th>Invoice</th>
                    <th>ID Number</th>
                    <th>Bill No</th>
                    <th>Bill Date</th>
                    <th>Godown ID</th>
                    <th>Party Code</th>
                    <th>Party Name</th>
                    <th>Broker Code</th>
                    <th>Broker Name</th>
                    <th>Bill Rtn Amt</th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>