<?php
include './config/database.php';
include './functions/report-operator.php';

$c1 = new Database();
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Progress Report</title>
        <link rel="shortcut icon" href="https://bpslampung.id/landing/img/logo.png" type="image/png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>

<body>
        <div class="container">
                <div class="row">
                        <h1 class="text-center">Report Ruta Hasil Pengolahan C2 dan V</h1>
                        <h5 class="text-center">Kondisi: <?php echo date('d-m-Y')?></h5>
                        <hr/>
                </div>
                <div class="row">
                        <div class="col">
                                <h6>BPS Kabupaten Lampung Barat</h6>
                                <ul>
                                        <li>Jumlah Ruta Belum Olah:</li>
                                        <li>Jumlah Ruta Clean Olah:</li>
                                        <li>Jumlah Ruta Error Olah:</li>
                                </ul>
                        </div>
                        <div class="col">

                        </div>
                        <div class="col">
                                <h6>BPS Kabupaten Pesisir Barat</h6>
                                <ul>
                                        <li>Jumlah Ruta Belum Olah:</li>
                                        <li>Jumlah Ruta Clean Olah:</li>
                                        <li>Jumlah Ruta Error Olah:</li>
                                </ul>
                        </div>
                </div>
        </div>
        <div class="container">
                <hr/>
                <table id="reportOperator" class="display" style="width:100%">
                        <thead>
                                <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">IDBS</th>
                                        <th class="text-center">NUS</th>
                                        <th class="text-center">Operator</th>
                                        <th class="text-center">Status (Belum)</th>
                                        <th class="text-center">Status (Clean)</th>
                                        <th class="text-center">Status (Error)</th>
                                </tr>
                        </thead>
                        <tbody>
                        </tbody>
                </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script>
                $(document).ready(function() {
                        $('#reportOperator').DataTable({
                                "pageLength": 50
                        });
                });
        </script>
</body>

</html>