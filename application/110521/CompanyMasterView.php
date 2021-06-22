<?php
include 'header.php';
?>
<!DOCTYPE html>
<html>

<head>
  <title>APMC Traders</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>

  <style type="text/css">
    #numericCol {
      align-content: flex-end;
      text-align: right;
    }

    table {
      text-align: right;
      margin: 0 auto;
      width: 70%;
      clear: both;
      border-collapse: collapse;
      table-layout: auto;
      word-wrap: break-word;
    }
  </style>

  <script>
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


    $(document).ready(function() {
      // Setup - add a text input to each footer cell
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
        'ordering': true,
      });

    });
  </script>

  <div class="container">
    <!-- 
   <center>
       <?php
        $CoName =  str_ireplace("%20", " ", $this->session->userdata('CoName'));
        $WorkYear = $this->session->userdata('WorkYear');
        ?>
      <legend><?php echo  $CoName . ' - ' . $WorkYear; ?> - Company Master</legend>
    </center>
   -->
    <div class="col-lg-12 text-right">
      <!-- 
      <a class="btn btn-success" href="<?php echo base_url() ?>index.php/CompanyMasterController/addCompanyMaster/">
        <i class="glyphicon glyphicon-plus"></i>
          Add Company
      </a>
       -->
    </div>
    <table id="example" class="display text-right" style="width:100%">
      <thead>
        <tr>
          <th style="width:5%;">#</th>
          <th style="width:7%; text-align:left">Action</th>
          <th style="width:40%; text-align:left">Company Name</th>
        </tr>
      </thead>

      <tbody>
        <?php for ($i = 0; $i < count($Item_List); $i++) { ?>

          <tr>
            <td><?php echo ($i + 1); ?></td>

            <td>
              <a onclick="isupdateconfirm();" href="<?php echo base_url() . "index.php/CompanyMasterController/EditCompanyMaster/" . $Item_List[$i]->CoID; ?>">
                <button class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></button>
              </a>
              <!-- 
                    <a   onclick="isdeleteconfirm();" href= "<?php echo base_url() . "index.php/CompanyMasterController/DeleteCompanyMaster/" . $Item_List[$i]->CoID; ?>">
                    <button class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button>
                    </a> -->

            </td>

            <td style="text-align:left"><?php echo $Item_List[$i]->CoName; ?></td>

          </tr>

        <?php } ?>

      </tbody>
    </table>
  </div>

  <?php
  include 'footer.php';
  ?>