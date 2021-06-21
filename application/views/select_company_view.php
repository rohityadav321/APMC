<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
        <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>

        <title>APMCTraders - Client : <?php echo $this->session->userdata('clientName'); ?> - INFOWAY, Software for APMC Traders </title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <link href=" <?php echo base_url("assets/css/his-erp.css") ?>  " rel="stylesheet">

        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/58abeefeda22730aaccf45af/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->



        <style type="text/css">
            legend.scheduler-border {
                width:inherit; /* Or auto */
                padding:0 10px; /* To give a bit of padding on the left and right */
                border-bottom:none;
            }

            .col-sm-4 {
              height: 50px;
            }

            .colbox {
                margin-left: 10px;
                margin-right: 10px;
            }

            body{
                background: linear-gradient(to top, #003399 0%, #ffffff 100%);                
                background-size:100% 100vh;
                background-position:bottom;
            }

            label {
                color:black;
            }
        </style>


        <script>
            function isdeleteconfirm(){
              if(!confirm('Are you sure you want to delete ?'))
              {
                event.preventDefault();
                return;
              }
              return true;
            }

            function isupdateconfirm() {
              if(!confirm('Are you sure you want to Update ?'))
              {
                event.preventDefault();
                return;
              }
              return true;
            }
        </script>
</head>
<div class="container">
    <br>
    <br>
    <br>
   <center>
     <img src=  " <?php echo base_url('images/apmc-logo.png') ?> " height="90" width="349" alt="apmctraders_logo">
    </center>
    <br>
    <div class="row">
      <!-- <div class="col-sm-6 col-sm-6 col-sm-6"> -->
      <div class="col-md-6 col-md-6 well col-md-offset-3 text-center" >

        <table id="ank" class="table table-striped table-hover responsive">
            <thead>
              <tr class="bg-primary">
              <th style="width:20px; color:white;">#</th>
              <!-- <th>Edit / Delete</th> -->
              <th style="width:200px; color:white;">Company Name</th>
              <th style="width:60px; color:white;">Financial Year</th>              
              </tr>
            </thead>

            <tbody>
              <?php for ($i = 0; $i < count($Item_List); $i++) { ?>
               
              <tr>
                <td><?php echo ($i+1); ?></td>
                <td style="text-align:left">
                    <a href="<?php echo base_url() . "index.php/SelectCompany/show/" .
                                        $Item_List[$i]->CoID . '/'. 
                                        $Item_List[$i]->CoName . '/'. 
                                        $Item_List[$i]->WorkYear ; 
                            ?>" 
                        data-toggle="tooltip"
                        title="Get Details"
                    >
                    <?php echo $Item_List[$i]->CoName;?></td>
                <td>
                    <a href="<?php echo base_url() . "index.php/SelectCompany/show/" .
                                        $Item_List[$i]->CoID . '/'. 
                                        $Item_List[$i]->CoName . '/'. 
                                        $Item_List[$i]->WorkYear ; 
                            ?>" 
                        data-toggle="tooltip"
                        title="Get Details"
                    >

                    <?php echo $Item_List[$i]->WorkYear;?>
                </td>
                
              </tr>

              <?php } ?>

            </tbody>
        </table>
      </div>
    </div>
</div>

<?php
include 'footer.php';
?>
