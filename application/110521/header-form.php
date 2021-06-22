<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->


    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/media/js/jquery.dataTables.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/media/css/jquery.dataTables.min.css" rel="stylesheet">




    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        $(document).ready(function() {
            $('#Groups1').DataTable();
        });

        $(document).ready(function() {
            $('#AreaList').DataTable();
        });

        $(document).ready(function() {
            $('#BrokerModal').DataTable();
        });

        $(document).ready(function() {
            $('#TDSAccountCodes').DataTable();
        });

        $(document).ready(function() {
            $('#CGSTAccounts').DataTable();
        });

        $(document).ready(function() {
            $('#CGSTInputCreditRCMs').DataTable();
        });

        $(document).ready(function() {
            $('#CGSTOutputCreditRCMs').DataTable();
        });

        $(document).ready(function() {
            $('#SGSTAccounts').DataTable();
        });

        $(document).ready(function() {
            $('#SGSTOutputCreditRCMs').DataTable();
        });

        $(document).ready(function() {
            $('#SGSTInputCreditRCMs').DataTable();
        });

        $(document).ready(function() {
            $('#IGSTAccounts').DataTable();
        });

        $(document).ready(function() {
            $('#IGSTOutputCreditRCMs').DataTable();
        });

        $(document).ready(function() {
            $('#IGSTInputCreditRCMs').DataTable();
        });
    </script>

    <style>
        fieldset.scheduler-border {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow: 0px 0px 0px 0px #000;
            box-shadow: 0px 0px 0px 0px #000;
        }

        legend.scheduler-border {
            width: inherit;
            /* Or auto */
            padding: 0 10px;
            /* To give a bit of padding on the left and right */
            border-bottom: none;
        }

        .tooltip {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted black;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;

            /* Position the tooltip */
            position: absolute;
            z-index: 1;
            top: 100%;
            left: 50%;
            margin-left: -60px;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
        }

        .card-header {
            background: #5b7ac9;
            color: white;
        }

        .card {
            background: linear-gradient(to top, #003399 0%, #ffffff 100%);
            background-size: 100% 100vh;
            background-position: bottom;
        }

        /* 
color: black; 
background-color: #f9f9f9;
margin: 14px 0 14px 0;
padding: 12px 10px 12px 10px;
border: 1px solid #D0D0D0;
display: block;
 */
        .card-body {
            background: #a6b6e0;
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            color: #011b52;
        }

        input[type=text] {
            height: 25px;
        }
    </style>

    <!-- font-family: "Lucida Console", Courier, monospace; -->
    <!-- font-family: Arial, Helvetica, sans-serif; -->

</head>

<body>
    <!-- &nbsp;
  &nbsp; -->