<!DOCTYPE html>
    <head>
        <title>FileUpload</title>
        <style>
            #tableNames {
                background-color: white;
                width: 200px;
                height: 600px;
                border: 5px solid black;
                padding: 50px;
                margin: 20px;
                overflow: scroll;
                overflow-x: hidden;
            }

            #rules {
                background-color: white;
                width: 1000px;
                height: 600px;
                border: 5px solid black;
                padding: 50px;
                margin: 20px;
                margin-left: 350px;
                margin-top: -730px;
                overflow: scroll;
                overflow-y: hidden;
            }

			a:link {
  				color: grey;
				text-decoration: none;
			}

			a:visited {
  				color: black;
				text-decoration: none;
			}

			a:hover {
				color: red;
				text-decoration: none;
			}

			a:active {
				color: skyblue;
				text-decoration: none;
			}

        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>


        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">


        <script>

            function showTables(tableName) {
                var url = "<?=base_url()?>index.php/ImportExcelFilesController/displaySampleTable/"+tableName;
                location.href=url;
            }
            
            $(document).ready(function() { 
                $('#sampleTable').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'csv', 'excel'
                    ]
                }); 
            });
        </script>

    </head>
    <body>
        <div id="tableNames">
            <h3 style="margin-top: -20px;text-align: center;">Database Tables</h3>
            <?php
                $i=1;
				//dynamic loading of table names from database
                foreach($tables as $tabs)
                {
                    $var = $tabs['myTables'];
					echo '<a href="#" onClick=showTables("' . $var . '");>' . $i . '.' . '&nbsp;' . $var . '</a> <br>';
                    $i++;
                }
            ?>
        </div>

        <div id="rules">

            <div id="rules-label">
                <h3 style="margin-top: -20px;margin-left: -20px;">Rules for Uploading CSV file</h3>
            </div>
            
            <div id="rules-points" style="margin-left: -50px;">
                <ol id="list">
                    <li>Your CSV data should be in the format below. The first line of your CSV should be the column headers as in the table example. Also make sure that your file is <b>UTF-8</b> to avoid unnecessary <b>encoding problems</b>.</li>
                    <li>If the column <b>you are trying to import is date make sure that it is formatted in the format Y-m-d (2021-02-19)</b>.</li>
                    <li>Make sure you configure the default contact permission in <b style="color: skyblue;">Setup->Settings->Customers</b> to get the best results like auto assigning contact permissions and email notification settings based on the permissions.</li>
                    <li style="color: red;">Duplicate email rows won't be imported.</li>
                </ol>
            </div>

            <div id="demo">
                <?php      
                    function build_table($result) {
                        $html = "<table id='sampleTable' border=1>";
                        $html .= "<thead >";
                        $html .= '<tr>';
                        
                        if (!empty($result)) {
                            foreach($result[0] as $key=>$value) {
                                $html .= '<th style="text-align:center">' . htmlspecialchars($key) . '</th>';
                            }
                            $html .= '</tr>';
                            $html .= '</thead>';
                            $html .= '<tbody>';

                            foreach( $result as $key=>$value) {
                                $html .= '<tr>';
                                foreach($value as $key2=>$value2) {
                                    $html .= '<td>' . htmlspecialchars($value2) . '</td>';
                                }
                                $html .= '</tr>'; 
                            }
                        }

                        else {
                            $html .= '<tr>';     
                            $html .= '<td>' . "" . '</td>';
                            $html .= '</tr>'; 
                        }
                        $html .= '</tbody>';
                        $html .= '</table>';
                        return $html;
                    }   
                    echo build_table($result);
                ?>
            </div>

            <div>
                <form enctype="multipart/form-data" method="post" role="form">
                    <input type="file" name="file" id="file" accept=".csv", application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" ID="fileSelect" runat="server"><br> 
                    <button type="submit" onClick="check()" name="submit" id="uploadExcel" value="submit">Upload</button><br>
                    <input type="text" id="hiddenViewTable" hidden>
                </form>
            </div>

        </div>
    </body>
</html>

