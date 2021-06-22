<head>
    <title>Sales Return Entry</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-size: 1em;
            background: rgb(218, 218, 250);
        }

        .idnum {
            font-weight: bold;
            font-size: 1.2em;
        }

        .sectionOne {
            display: flex;
            justify-content: flex-start;
            height: 23vh;
        }

        .sectionTwo {
            display: flex;
            justify-content: space-between;
            height: 23vh;
        }

        .container .sectionOne .s1 {
            width: 60vw;
        }

        .container .sectionOne .s2 {
            width: 40vw;
        }

        .container .sectionOne .s3 {
            width: 60vw;
        }

        .container .sectionOne .s4 {
            width: 40vw;
        }

        label {
            width: 100px;
            display: inline-block;
            padding-left: 5px;
        }

        input {
            display: inline-block;
            width: 140px;
            /* Univ width for the inputs */
            padding: 2px;
            border-color: white;
            box-shadow: inset .1px 0 0 .1px gray;
        }

        .s1 {
            padding: 5px;
        }

        .s2 {
            border: .5px solid rgb(155, 155, 180);
            padding: 5px;
        }

        .s4 {
            padding-right: 10px;
            padding-top: 30px;
        }

        .s1 input {
            background: rgb(165, 165, 255);
        }

        .s2 input {
            background: rgb(165, 165, 255);
            width: 150px;
        }

        .table {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        table {
            width: 97vw;
            text-align: center;
            border: .5px solid gray;
            border-collapse: collapse;

        }

        thead {
            background: lightsalmon;
        }

        .tr td {
            background: rgb(255, 122, 69);
            font-size: 1em;
            padding: 2px;
        }

        th {
            padding: 5px;
        }

        table input {
            width: 70px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sectionOne">
            <div class="s1">
                <label for="">Party</label> <input type="text" readonly> <input type="text" readonly style="width: 350px;"> Bazar Ind <input type="text" readonly style="width: 70px;"> <br>

                <label for="">Broker</label> <input type="text" readonly> <input type="text" readonly style="width: 350px;"> <input type="text" readonly style="width: 135px;"> <br>

                <label for="">Name</label> <input type="text" readonly style="width: 490px;"> <input type="text" readonly> <br>

                <label for="">Bill Date</label> <input type="date" readonly> <label for="">Bill Amount</label> <input type="text" readonly> <label for="">Hel / Majuri</label> <input type="text" readonly> <br>

                <label for="">Amt Recvd</label> <input type="text" readonly> <label for="">Return Amt</label> <input type="text" readonly> <label for="">Other Charges</label> <input type="text" readonly> <br>
            </div>

            <div class="s2">
                <label for="">Gross</label> <input type="text" readonly> <label for="">Taxable Amt</label> <input type="text" readonly> <br>

                <label for="">APMC</label> <input type="text" readonly> <label for="">CGST Amt</label> <input type="text" readonly><br>

                <label for="">LBT</label> <input type="text" readonly> <label for="">SGST Amt</label> <input type="text" readonly> <br>

                <label for="">Add Amt</label> <input type="text" readonly> <label for="">IGST Amt</label> <input type="text" readonly> <br>

                <label for="">Less Amt</label> <input type="text" readonly> <label for="">Total Tax</label> <input type="text" readonly> <br>

                <label for="">Hel / Charges</label> <input type="text" readonly> <label for="">Return Amt</label> <input type="text" readonly> <br>
            </div>
        </div>
        <hr>
        <div class="sectionTwo">
            <div class="s3">
                <label for=""><span class="idnum">ID Number</span></label> <input type="text" readonly style="background:rgb(165, 165, 255);" id="IdNumber" onkeydown="focusnext(event)" name="IdNumber"> <span style="padding-left: 100px; color:rgb(0, 0, 255);
                font-weight: bold;">Last:</span> <br>

                <label for="">Date</label> <input type="date" name="" id=""> <span style="padding-left: 100px;">Tue</span> <br>

                <label for="">Ref Bill No.</label> <input type="text"> <br>

                <label for="" style="width: fit-content;">Return Account</label> <input type="text"> <input type="text" readonly style="width: 350px; background:rgb(165, 165, 255);"> <br>

                <label for="">Tax Code Rate</label> <input type="text" readonly style="width: 70px; background:rgb(165, 165, 255);"> <input type="text" readonly style="width: 170px;background:rgb(165, 165, 255);"> <input type="text" readonly style="width: 70px;background:rgb(165, 165, 255);"> <label for="" style="width: 65px;">Discount</label> <input type="text" readonly style="width: 70px;background:rgb(165, 165, 255);"> <input type="text" readonly style="width: 100px;background:rgb(165, 165, 255);"> <br>
            </div>

            <div class="s4">
                <label for="">Hel / Majuri</label> <input type="text"> <br>
                <label for="">Other Charges</label> <input type="text"> <br>
                <label for="">Round Off</label> <input type="text"> <br>
            </div>
        </div>
        <hr>

        <div class="table">
            <table cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>GDN</th>
                        <th>Lot No.</th>
                        <th>Cr Acc.</th>
                        <th>Item Code</th>
                        <th>Mark</th>
                        <th>Qty</th>
                        <th>Gross Wt.</th>
                        <th>Net Wt.</th>
                        <th>Rate</th>
                        <th>APMC(Old)</th>
                        <th>LBT(Old)</th>
                        <th>APMC(New)</th>
                        <th>LBT(New)</th>
                        <th>Gr. Amt.</th>
                        <th>C. Chrgs</th>
                        <th>Net Amt.</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text"></td>
                        <td><input type="text" style="background:rgb(165, 165, 255);" readonly></td>
                        <td><input type="text" style="background:rgb(165, 165, 255);" readonly></td>
                        <td><input type="text" style="background:rgb(165, 165, 255);" readonly></td>
                        <td><input type="text" style="background:rgb(165, 165, 255);" readonly></td>
                        <td><input type="text"></td>
                        <td><input type="text"></td>
                        <td><input type="text"></td>
                        <td><input type="text" style="background:rgb(165, 165, 255);" readonly></td>
                        <td><input type="text" style="background:rgb(165, 165, 255);" readonly></td>
                        <td><input type="text" style="background:rgb(165, 165, 255);" readonly></td>
                        <td><input type="text"></td>
                        <td><input type="text"></td>
                        <td><input type="text" style="background:rgb(165, 165, 255);" readonly></td>
                        <td><input type="text"></td>
                        <td><input type="text" style="background:rgb(165, 165, 255);" readonly></td>
                        <td><button><b>&check;</b></button> <br>
                            <button><b>X</b></button>
                        </td>

                    </tr>
                    <tr class="tr">
                        <td>GDN</td>
                        <td>Lot No.</td>
                        <td>Cr Acc.</td>
                        <td>Item Code</td>
                        <td>Mark</td>
                        <td>Qty</td>
                        <td>Gross Wt.</td>
                        <td>Net Wt.</td>
                        <td>Rate</td>
                        <td>APMC</td>
                        <td>ETax</td>
                        <td>Gr. Amt.</td>
                        <td>C. Chrgs</td>
                        <td>Net Amt</td>
                        <td>Valid</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td><input type="text"></td>
                        <td><input type="text" style="background:rgb(0, 0, 250); color: white" readonly></td>
                        <td><input type="text" style="background:rgb(0, 0, 250); color: white" readonly></td>
                        <td><input type="text" style="background:rgb(0, 0, 250); color: white" readonly></td>
                        <td><input type="text" style="background:rgb(0, 0, 250); color: white" readonly></td>
                        <td><input type="text" style="background:rgb(0, 0, 250); color: white" readonly></td>
                        <td><input type="text" style="background:rgb(0, 0, 250); color: white" readonly></td>
                        <td><input type="text" style="background:rgb(0, 0, 250); color: white" readonly></td>
                        <td><input type="text" style="background:rgb(0, 0, 250); color: white" readonly></td>
                        <td><input type="text" style="background:rgb(0, 0, 250); color: white" readonly></td>
                        <td><input type="text" style="background:rgb(0, 0, 250); color: white" readonly></td>
                        <td><input type="text" style="background:rgb(0, 0, 250); color: white" readonly></td>
                        <td><input type="text" style="background:rgb(0, 0, 250); color: white" readonly></td>
                        <td><input type="text" style="background:rgb(0, 0, 250); color: white" readonly></td>
                        <td><input type="text" style="background:rgb(0, 0, 250); color: white" readonly></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sample</td>
                        <td>Sample</td>
                        <td>Sample</td>
                        <td>Sample</td>
                        <td>Sample</td>
                        <td>Sample</td>
                        <td>Sample</td>
                        <td>Sample</td>
                        <td>Sample</td>
                        <td>Sample</td>
                        <td>Sample</td>
                        <td>Sample</td>
                        <td>Sample</td>
                        <td>Sample</td>
                        <td>Sample</td>
                        <!-- <td>Sample</td>
                  <td>Sample</td> -->
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>