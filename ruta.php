<?php

include './autoload.php';
include './config/database.php';
include './functions/report-ruta.php';
include './functions/common.php';
include './config/database2.php';

$c1 = new Database();
$r1 = findAll($c1);
$c1->close();

$c2 = new Database();
$r2 = findStatus($c2, "status_dokumen='C'", '1801');
$c2->close();
$c3 = new Database();
$r3 = findStatus($c3, "status_dokumen='C'", '1813');
$c3->close();
$c4 = new Database();
$r4 = findStatus($c4, "status_dokumen='E'", '1801');
$c4->close();
$c5 = new Database();
$r5 = findStatus($c5, "status_dokumen='E'", '1813');
$c5->close();
$c6 = new Database();
$r6 = findStatus($c6, "status_dokumen IS NULL", '1801');
$c6->close();
$c7 = new Database();
$r7 = findStatus($c7, "status_dokumen IS NULL", '1813');
$c7->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Progress Report | Rumah Tangga</title>
        <link rel="shortcut icon" href="https://bpslampung.id/landing/img/logo.png" type="image/png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>

<body>
        <?php include './includes/navbar.php' ?>
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
                                        <li>Jumlah Ruta Belum Olah: <?php echo $r6[0]['jumlah']; ?></li>
                                        <li>Jumlah Ruta Clean Olah: <?php echo $r2[0]['jumlah']; ?></li>
                                        <li>Jumlah Ruta Error Olah: <?php echo $r4[0]['jumlah']; ?></li>
                                        <li>Jumlah Ruta Total: <?php echo $r2[0]['jumlah'] + $r4[0]['jumlah'] + $r6[0]['jumlah']; ?></li>
                                </ul>
                        </div>
                        <div class="col">

                        </div>
                        <div class="col">
                                <h6>BPS Kabupaten Pesisir Barat</h6>
                                <ul>
                                        <li>Jumlah Ruta Belum Olah: <?php echo $r7[0]['jumlah']; ?></li>
                                        <li>Jumlah Ruta Clean Olah: <?php echo $r3[0]['jumlah']; ?></li>
                                        <li>Jumlah Ruta Error Olah: <?php echo $r5[0]['jumlah']; ?></li>
                                        <li>Jumlah Ruta Total: <?php echo $r3[0]['jumlah'] + $r5[0]['jumlah'] + $r7[0]['jumlah']; ?></li>
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
                                        <th class="text-center">No.Box Besar</th>
                                        <th class="text-center">IDBS</th>
                                        <th class="text-center">NUS</th>
                                        <th class="text-center">Nama KRT</th>
                                        <th class="text-center">Operator</th>
                                        <th class="text-center">Waktu Entri</th>
                                        <th class="text-center">Status Dokumen</th>
                                </tr>
                        </thead>
                        <tbody>
                                <?php if (count($r1) > 0) {
                                        $i = 0;
                                        foreach ($r1 as $list => $row) {
                                                
                                                $status_dok = '';
                                                if ($row['status_dokumen']==NULL || $row['status_dokumen']==''){
                                                        $status_dok = 'style="background-color: #FCE2DB"';
                                                } else if ($row['status_dokumen']=='E') {
                                                        $status_dok = 'style="background-color: #D61C4E"';
                                                } else {
                                                        $status_dok = '';
                                                }
                                ?>   
                                <tr <?php echo $status_dok; ?> >
                                        <td class="text-center"><?php echo ($i + 1) ?></td>
                                        <td class="text-center">
                                        <?php 
                                        $conn3 = new Database2();
                                        $no_box = getNomorBoxBesar($conn3, $row['idbs']);
                                        $conn3->close();
                                        echo $no_box != NULL ? $no_box[0]['no_box'] : '';
                                        ?></td>
                                        <td class="text-center"><?php echo $row['idbs'] ?></td>
                                        <td class="text-center"><?php echo $row['nus'] ?></td>
                                        <td><?php echo $row['nama_krt'] ?></td>
                                        <td><?php echo $row['nama_operator'] ?></td>
                                        <td class="text-center"><?php echo $row['waktu_entri'] ?></td>
                                        <td class="text-center"><?php echo $row['status_dokumen'] ?></td>
                                </tr> 
                                        <?php 
                                        $i++;
                                        } ?>
                                <?php } ?>
                        </tbody>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="laporPemeriksaan" tabindex="-1" role="dialog" aria-labelledby="laporPemeriksaan" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                        <div class="modal-header">
                                                <h5 class="modal-title">Laporan Hasil Pemeriksaan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                
                                </div>
                        </div>
                </div>
                        <!-- End Modal-->
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