<?php
include 'header.php';
$today = date('Y-m-d');
?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>

  <style>
    /* body
      {
      overflow: scroll; Scrollbar are always visible 
      overflow: auto;
      } */

    #refresh {
      background-color: #cc9966;
      border-radius: 5px;
      position: absolute;
      margin-left: 460px;
      margin-top: -6px;
    }

    #refresh:hover {
      color: #fff;
      background-color: #86592d;
      border-color: #86592d;
    }

    .btn-success {
      margin-top: -35px;
    }


    #numericCol {
      align-content: flex-end;
      text-align: right;
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


  <script type="text/javascript">
    $(document).ready(function() {
      $('#RojmelTable').DataTable();
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

    function changePage() {
      location.href = 'rojmelHeader.php';
    }
  </script>

  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

</head>

<?php
$total = 0;
$charge1 = 0;
$charge2 = 0;
$taxable = 0;
$gst = 0;
$netp = 0;
?>

<body>
  <div class="container-fluid">
    <!-- <center>
               <?php
                $CoName =  str_ireplace("%20", " ", $this->session->userdata('CoName'));
                $WorkYear = $this->session->userdata('WorkYear');
                ?>
          <legend><?php echo  $CoName . ' - ' . $WorkYear; ?> - Rojmel</legend>
        </center> -->

    <?php
    $fromyear = $Item_List[1];
    $toyear = $Item_List[2];
    if (isset($_POST['submit'])) {
      $fromyear = $_POST['fromYear'];
      $toyear = $_POST['toYear'];
    }
    ?>

    <div style="position:relative; margin-left:175px; margin-top:10px;">
      <form method='post' action='<?php echo base_url() ?>index.php/RojmelController/rojshow'>
        <label style="margin-left:-17%;">ACDate </label>
        <label style="position:absolute;margin-left:10px;">From : </label>
        <input style="position:absolute;margin-left:60px;margin-top:-6px;" type="date" id="fromYear" name="fromYear" value="<?php echo $fromyear; ?>">

        <label style="position:absolute;margin-left:250px;">To : </label>
        <input style="position:absolute;margin-left:278px;margin-top:-6px;" type="date" id="toYear" name="toYear" value="<?php echo $toyear; ?>">

        <input type='submit' name='submit' class="refresh" id="refresh" value="Refresh">
      </form>
    </div>

    <div class="col-lg-12 text-left">
      <a style="float:right;" class="btn btn-success" accesskey="a" href="<?php echo base_url() ?>index.php/RojmelController/rojInsert/">
        <i class="glyphicon glyphicon-plus"></i>
        Insert (Alt+A)
      </a>
    </div>

    &nbsp;

    <table id="RojmelTable" class="display" border="1">
      <thead>
        <tr>
          <th class="text-left">Action</th>
          <th class="text-left">Date</th>
          <th class="text-left">Doc No.</th>
          <th class="text-left">Book Code</th>
          <th class="text-left">Book Name</th>
          <th class="text-left">Nature</th>
          <th class="text-left">Narration</th>
          <th class="text-left">Debit</th>
          <th class="text-left">Credit</th>
          <th class="text-left">Tran Amt</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $totalRecord = count($Item_List[0]);
        // echo $totalRecord;

        if ($Item_List[0][0] == "empty") {
          // echo "No data found";
        } else {
          for ($i = 0; $i < $totalRecord; $i++) {
        ?>
            <tr>
              <td><a onclick="isupdateconfirm();" href="<?php echo base_url() . "index.php/RojmelController/EditTry/" . $Item_List[0][$i]['DocNo']; ?>">
                  <button class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></button>
                </a>

                <a onclick="isdeleteconfirm();" href="<?php echo base_url() . "index.php/RojmelController/DeleteRojmel/" . $Item_List[0][$i]['DocNo']; ?>">
                  <button class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button>
                </a>
                <a href="<?php echo base_url() . "index.php/RojmelController/PrintRoj/" . $Item_List[0][$i]['DocNo']; ?>">
                  <button class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-print"></i></button>
                </a>

              </td>

              <td id="numericCol" class="text-left"><?php echo $Item_List[0][$i]['ACCDateGrid']; ?></td>
              <td id="numericCol" class="text-left"><?php echo $Item_List[0][$i]['DocNo']; ?></td>
              <td id="numericCol" class="text-left"><?php echo $Item_List[0][$i]['BookCode']; ?></td>
              <td id="numericCol" class="text-left"><?php echo $Item_List[0][$i]['ACTitle']; ?></td>
              <td id="numericCol" class="text-left"><?php echo $Item_List[0][$i]['Nature']; ?></td>
              <td id="numericCol" class="text-left"><?php echo $Item_List[0][$i]['Narration']; ?></td>
              <td id="numericCol" class="text-left"><?php echo $Item_List[0][$i]['DR']; ?></td>
              <td id="numericCol" class="text-left"><?php echo $Item_List[0][$i]['CR']; ?></td>
              <td id="numericCol" class="text-left"><?php echo $Item_List[0][$i]['Withdraw']; ?></td>


            </tr>
        <?php
          }
        }
        ?>

      </tbody>
    </table>
  </div>
</body>

<script>
  function fromYear() {
    //Reference the DropDownList.
    var fromYear = document.getElementById("fromYear");

    //Determine the Current Year.
    var currentYear = (new Date()).getFullYear();

    //Loop and add the Year values to DropDownList.
    for (var i = 2000; i <= currentYear - 1; i++) {
      var option = document.createElement("OPTION");
      option.innerHTML = i;
      option.value = i;
      fromYear.appendChild(option);
    }

  };

  fromYear();

  function toYear() {
    //Reference the DropDownList.
    var toYear = document.getElementById("toYear");

    //Determine the Current Year.
    var currentYear = (new Date()).getFullYear();

    //Loop and add the Year values to DropDownList.
    for (var i = 2001; i <= currentYear; i++) {
      var option = document.createElement("OPTION");
      option.innerHTML = i;
      option.value = i;
      toYear.appendChild(option);
    }

  };

  toYear();
</script>

</html>