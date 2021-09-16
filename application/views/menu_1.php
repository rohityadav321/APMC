<!DOCTYPE html>
<html lang="en">

<head>
    <title>APMCTraders - Client : <?php echo $this->session->userdata('clientName'); ?> - INFOWAY, Software for APMC Traders </title>

    <meta charset="utf-8">
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

    <style type="text/css">
        /*        #mycarousel {
            margin-top: 10px;
            min-height: 200px;
            min-width: 100%;
        }
        #mycarousel img {
            min-height: 100px;
            min-width: 100%;
        }
        #mycarousel > .carousel-indicators > li {
            border-radius: 0px;
            min-width: 25px;
            background-color: #9d9d9d;
            border: 1px solid black;
            margin-right: 10px;;
            margin-left: 10px;;
        }
        #mycarousel > .carousel-indicators > .active {
            background-color: yellow;
        }

        #mycarousel .carousel-caption {
            color: yellow;
            right: 40%;
            text-align: center;
            max-width: 500px;
            left: auto;
            top: 10px;
        }
*/
        @-webkit-keyframes scroll {
            0% {
                -webkit-transform: translate(0, 0);
            }

            100% {
                -webkit-transform: translate(-100%, 0);
            }
        }


        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: -100%;
            max-width: 140px;
            margin-top: -6px;
            margin-right: px;
            -webkit-border-radius: 6px 6px 6px 6px;
            -moz-border-radius: 6px 6px 6px 6px;
            border-radius: 6px 6px 6px 6px;
        }

        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
        }

        .dropdown-submenu>a:after {
            display: block;
            content: " ";
            float: left;
            width: 0;
            height: 0;
            border-color: transparent;
            border-style: solid;
            border-width: 5px 5px 5px 0;
            border-right-color: #999;
            margin-top: 5px;
            margin-right: 10px;
        }

        .dropdown-submenu:hover>a:after {
            border-left-color: #ffffff;
        }

        .dropdown-submenu.pull-left {
            float: none;
        }

        .dropdown-submenu.pull-left>.dropdown-menu {
            left: -100%;
            margin-left: 10px;
            -webkit-border-radius: 6px 6px 6px 6px;
            -moz-border-radius: 6px 6px 6px 6px;
            border-radius: 6px 6px 6px 6px;
        }

        .dropdown-menu-right {
            margin-left: 0;
        }
    </style>

    <style type="text/css">
        .colbox {
            margin-left: 10px;
            margin-right: 10px;
        }

        label {
            color: white;
        }
    </style>


</head>

<body>
    <nav class="navbar navbar-inverse" style="margin: 0 0 0 0;">
        <div class="container-fluid" style="background-color: #06074f">
            <div class="navbar-header">
                <a class="navbar-brand"><?php echo '<img width="100" height="50" src="data:image/jpeg;base64,' . base64_encode($this->session->userdata('clientlogo')) . '" class="" alt="3" srcset="" sizes="(max-width: 900px) 100vw, 900px">'; ?></a>
                <a class="navbar-brand">
                    APMCTraders - <?php echo $this->session->userdata('clientName'); ?>
                    <?php
                    $CoName =  str_ireplace("%20", " ", $this->session->userdata('CoName'));
                    $WorkYear = $this->session->userdata('WorkYear');
                    ?>
                    <p class="tab blink" style="color: #05bca9; font-weight:bold; font-size:12px; ">
                        Subscription Valid till : <?php echo $this->session->userdata('expiry_date') ? date_format(date_create($this->session->userdata('expiry_date')), 'd/m/y') : 'N/A';  ?>
                        &nbsp; &nbsp;
                        <span style="color:yellow;">
                            <?php echo  $CoName . ' - ' . $WorkYear; ?>
                        </span>
                    </p>
                </a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <div class="nav navbar-nav navbar-right">
                    <br>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="glyphicon glyphicon-cog"></span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu">
                            <?php $usertype = $this->session->userdata('usertype'); ?>
                            <?php if ($usertype == 'admin') {
                            ?>

                                <li><a href="<?= site_url('CompanyMasterController/show') ?>">Company</a></li>
                                <li class="divider">
                                <li>
                                <li class="dropdown-submenu dropdown-menu-right"><a>Accounts</a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="<?= site_url('AccountMasterController/show') ?>"> Group</a></li>
                                        <li><a tabindex="-1" href="<?= site_url('AccountLedgerMasterController/show') ?>">Account/Journal</a></li>
                                        <li><a tabindex="-1" href="<?= site_url('AccountSettingController/AccountShow') ?>">Account Settings</a></li>
                                        <!-- <li><a tabindex="-1" href="<?= site_url('apmc_mas/acmas') ?>">Accounts Settings</a></li> -->
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-menu-right"><a>Item</a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="<?= site_url('ItemGroupController/show') ?>"> Group</a></li>
                                        <li><a tabindex="-1" href="<?= site_url('ItemMasterController/show') ?>"> Item</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-menu-right"><a>Other</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= site_url('CustomerMasterController/show') ?>"> Customer Master</a></li>
                                        <li><a href="<?= site_url('ChithiMasterController/show') ?>"> Chithi Master</a></li>
                                        <li><a href="<?= site_url('WorkMasterController/show') ?>"> Work Master</a></li>
                                        <li><a href="<?= site_url('GodownMasterController/show') ?>"> Godown Master</a></li>
                                        <li><a href="<?= site_url('TaxMasterController/show') ?>"> Tax Master</a></li>
                                        <li><a href="<?= site_url('TdsMasterController/show') ?>"> TDS Master</a></li>
                                        <li><a href="<?= site_url('SchemeMasterController/show') ?>"> Scheme Master</a></li>
                                        <li><a href="<?= site_url('AreaMasterController/show') ?>"> Area Master</a></li>
                                        <li><a href="<?= site_url('BankMasterController/show') ?>"> Bank Master</a></li>
                                        <li><a href="<?= site_url('NarrationMasterController/show') ?>"> Narration Master</a></li>
                                    </ul>
                                </li>
                                <li class="divider">
                                <li>
                                <li class="dropdown-submenu dropdown-menu-right"><a>Purchase</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= site_url('NewGaruPurController/show') ?>">Garu Purchase</a></li>
                                        <li><a href="<?= site_url('GaruPaymentController/showGrid') ?>">Payment</a></li>
                                        <li class="divider">
                                        <li>
                                            <!-- <li><a href="<?= site_url('NewGaruPurController/PurDatewise') ?>">Purchase Register</a></li> -->
                                        <li><a href="<?= site_url('NewGaruPurController/TaxablePurDatewise') ?>">Purchase (Taxable)</a></li>
                                        <li><a href="<?= site_url('NewGaruPurController/ItemwisePurDatewise') ?>">Purchase (Itemwise)</a></li>
                                        <li class="divider">
                                        <li>
                                        <li><a href="<?= site_url('GaruPaymentController/PaymentDatewise') ?>">Payment Register</a></li>
                                    </ul>
                                </li>
                                <!-- <li><a href="<?= site_url('apmc_mas/vachhatAavak') ?>">Vachhat Aavak</a></li> -->
                                <li class="dropdown-submenu dropdown-menu-right"><a>Sales</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= site_url('SalesController/show') ?>">Sales</a></li>
                                        <!-- <li><a href="<?= site_url('CollectionController/showTry') ?>">Collection</a></li> -->
                                        <li><a href="<?= site_url('CollectionController/show') ?>">Collection</a></li>
                                        <li class="divider">
                                        <li>
                                        <li><a href="<?= site_url('SalesController/SalesDatewise') ?>">Sales Register</a></li>
                                        <li><a href="<?= site_url('SalesController/BriefSalesDatewise') ?>">Sales Register (B) </a></li>
                                        <li><a href="<?= site_url('ReportController/rateDiffReport') ?>">Rate/Weight Diff</a></li>
                                        <li class="divider">
                                        <li>
                                        <li><a href="<?= site_url('SalesController/TaxableSalesDatewise') ?>">Sales (Taxable)</a></li>
                                        <li class="divider">
                                        <li>
                                        <li><a href="<?= site_url('CollectionController/CollectionDatewise') ?>">Collection Register</a></li>
                                        <li class="divider">
                                        <li>
                                        <li><a href="<?= site_url('ReportController/OSReceivables') ?>">Receivables</a></li>
                                        <li><a href="<?= site_url('ReportController/OSSingleReceivables') ?>">Receivables Single</a></li>
                                        <li><a href="<?= site_url('OrderSalesController/Show') ?>">Sales Order</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?= site_url('RojmelController/rojshow') ?>">Rojmel</a></li>
                                <li class="divider">
                                <li><a href="<?= site_url('BankRecoController/show') ?>">BankReconciliation</a></li>
                                <li class="divider">
                                <li><a href="<?= site_url('CheckReturnController/show') ?>">Cheque Return</a></li>
                                <li class="divider">
                                <li><a href="<?= site_url('GodownTransController/show') ?>">Godown Transfer</a></li>
                                <li class="divider">
                                <li>
                                <li><a href="<?= site_url('LedgerReportController/AccountGroupReportDatewise') ?>">Ledger</a></li>
                                <li><a href="<?= site_url('TBReportController/show') ?>">Trial Balance</a></li>
                                <li class="divider">
                                <li>
                                <li><a href="<?= site_url('TBReportController/stockshow') ?>">Stock Summary</a></li>
                                <li><a href="<?= site_url('TBReportController/Lotwise_Stockshow') ?>">LotWisteStock </a></li>
                                <li><a href="<?= site_url('TBReportController/Itemwise_Stockshow') ?>">Itemwise Stock </a></li>
                                <li><a href="<?= site_url('PaymentTdsController/show') ?>">TDS </a></li>
                                <li><a href="<?= site_url('rtgs/show') ?>">Rtgs </a></li>
                                <li><a href="<?= site_url('SalesReturnController/Show') ?>">salesReturn </a></li>
                                <li><a href="<?= site_url('ReportController/SalesReport') ?>">salesReport </a></li>
                                <li><a href="<?= site_url('GSTReportController/GSTR3B_show') ?>">GSTR3B </a></li>
                                <li><a href="<?= site_url('GSTR1ReportController/GSTR1_show') ?>">GSTR1 </a></li>

                                <!-- 
                                <li><a href="<?= site_url('apmc_mas/vachhatAavak') ?>">Rojmel</a></li>
                                <li class="divider">
                                <li> -->
                                <li class="dropdown-submenu dropdown-menu-right"><a>A</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= site_url('TBReportController/BrokeragePayable') ?>">BrokeragePayable</a></li>

                                    </ul>
                                </li>
                                <!-- 
                            <li class="dropdown-submenu dropdown-menu-right"><a>B</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= site_url('apmc_mas/garuPurchase') ?>">Interest Entry</a></li>
                                        <li><a href="<?= site_url('apmc_mas/garuPurchase') ?>">TDS Payment</a></li>
                                        <li><a href="<?= site_url('apmc_mas/garuPurchase') ?>">TDS Bank Challan</a></li>
                                        <li><a href="<?= site_url('apmc_mas/garuPurchase') ?>">Cheque Return Entry</a></li>
                                        <li><a href="<?= site_url('apmc_mas/garuPurchase') ?>">Passbook Details</a></li>
                                    </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-menu-right"><a>C</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= site_url('apmc_mas/garuPurchase') ?>">Interest in Collection</li>
                                        <li><a href="<?= site_url('apmc_mas/garuPurchase') ?>">Interest Calculation</li>
                                        <li class="divider"><li>
                                        <li><a href="<?= site_url('apmc_mas/garuPurchase') ?>">Stock Shotage Entry</li>
                                        <li class="divider"><li>
                                        <li><a href="<?= site_url('apmc_mas/garuPurchase') ?>">Loan Received</li>
                                        <li><a href="<?= site_url('apmc_mas/garuPurchase') ?>">Loan Repayment</a></li>
                                    </ul>
                            </li> -->

                                <!-- <li class="divider"><li>
                            <li><a href="<?= site_url('ImportExcelFilesController/loadView') ?>">ImportExcel</a></li> -->
                                <!-- <li><a href="<?= site_url('Csv_import/loadView') ?>">Excel</a></li> -->

                                <li class="divider">
                                <li>
                                <li><a href="<?= site_url('login/selcompany') ?>"><em>Select Company</em></a></li>
                                <li class="divider">
                                <li>

                                <li><a onclick="alert('logout')" accesskey="0" href="<?= site_url('login/logout') ?>"><em>Logout (Alt+0)</em></a></li>
                                <!-- 
                            <li>
                                <a href="#"
                                    onclick="alert('Alt+9 is clicked')"
                                    data-hotkey="Alt+9">Press Ctrl+1</a>
                            </li> -->

                            <?php
                            } else {
                            ?>
                                <li><a href="<?= site_url('login/logout') ?>"><em>Logout</em></a></li>
                            <?php
                            }
                            ?>

                            <!-- <li class="divider"><li>
                            <li><a href="<?= site_url('sales/dbexport/show') ?>"><em>DB Export</em></a></li> -->
                        </ul>
                    </li>
                </div>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= site_url('login/logout') ?>">
                        UserName : <?php echo $this->session->userdata('username'); ?>
                        <span class="glyphicon glyphicon-log-in"></span>
                        </br>
                        Last Login Time : <?php echo $this->session->userdata('lastlogindt'); ?>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <marquee class='marquee' style="background-color:#e0ffff; font-size:12px; " behavior="scroll" direction="right to left">
        <?php echo $this->session->userdata('impMessage'); ?>
    </marquee>

    <div class="container">
    </div>

</body>

</html>