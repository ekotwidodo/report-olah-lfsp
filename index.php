<?php
include './autoload.php';
include './config/database.php';
include './functions/report-operator.php';

$c1 = new Database();
$r1 = getReportOperators($c1);
$c1->close();

$c2 = new Database();
$r2 = getReportTotal($c2);
$c2->close();
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
        <?php include './includes/navbar.php' ?>
        <div class="container">
                <div class="row">
                        <h1 class="text-center">Report Petugas Pengolahan C2 dan V</h1>
                        <h5 class="text-center">Kondisi: <?php echo date('d-m-Y')?> (<i>passing BS minimal 95%</i>)</h5>
                        <hr/>
                </div>
                <div class="row">
                        <div class="col">
                                <h6>BPS Kabupaten Lampung Barat</h6>
                                <ul>
                                        <li>Jumlah BS Selesai Olah: <?php echo $r2[0]['total_entri_bs']; ?> BS</li>
                                        <li>Jumlah Ruta Selesai Olah: <?php echo $r2[0]['total_entri_ruta']; ?> Ruta</li>
                                </ul>
                        </div>
                        <div class="col"></div>
                        <div class="col">
                                <h6>BPS Kabupaten Pesisir Barat</h6>
                                <ul>
                                        <li>Jumlah BS Selesai Olah: <?php echo $r2[1]['total_entri_bs']; ?> BS</li>
                                        <li>Jumlah Ruta Selesai Olah: <?php echo $r2[1]['total_entri_ruta']; ?> Ruta</li>
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
                                        <th class="text-center">Kode</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Jumlah BS Selesai Olah</th>
                                        <th class="text-center">Jumlah Ruta Selesai Olah</th>
                                        <th class="text-center">Jumlah Ruta (Clean)</th>
                                        <th class="text-center">Jumlah Ruta (Error)</th>
                                        <th class="text-center">Target Total</th>
                                </tr>
                        </thead>
                        <tbody>
                        <?php 
                                if (count($r1) > 0) {
                                        $i = 0;
                                        foreach ($r1 as $list => $row) {
                                                $color = '';
                                                if (round($row['jml_entri_bs']/30*100, 2) < 95) {
                                                        $color = 'style="background-color: #FFB4B4"';
                                                }
                                                if (round($row['jml_entri_bs']/30*100, 2) >= 100) {
                                                        $color = 'style="background-color: #3CCF4E"';
                                                }
                                ?>   
                                <tr <?php echo $color ?> >
                                        <td class="text-center"><?php echo ($i + 1) ?></td>
                                        <td class="text-center"><?php echo $row['kode_operator'] ?></td>
                                        <td><?php echo $row['nama_operator'] ?></td>
                                        <td class="text-center"><?php echo $row['jml_entri_bs'] ?> BS</td>
                                        <td class="text-center"><?php echo $row['jml_entri_ruta'] ?> Ruta</td>
                                        <td class="text-center"><?php echo $row['jml_entri_ruta_clean'] ?> Ruta</td>
                                        <td class="text-center"><?php echo $row['jml_entri_ruta_error'] ?> Ruta</td>
                                        <td>Asumsi 30BS [<?php echo round($row['jml_entri_bs']/30*100, 2)?>%]</td>
                                </tr> 
                                        <?php 
                                        $i++;
                                        } ?>
                                <?php } ?>
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