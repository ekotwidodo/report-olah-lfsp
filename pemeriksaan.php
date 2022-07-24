<?php

include './autoload.php';
include './config/database.php';
include './config/database2.php';
include './functions/report-pemeriksaan.php';
include './functions/common.php';

$c1 = new Database();
$r1 = findPemeriksaan($c1);
$c1->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Progress Report | Pemeriksaan</title>
        <link rel="shortcut icon" href="https://bpslampung.id/landing/img/logo.png" type="image/png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>

<body>
        <?php include './includes/navbar.php' ?>
        <div class="container">
                <div class="row">
                        <h1 class="text-center">Report Pemeriksaan Hasil Pengolahan C2 dan V</h1>
                        <h5 class="text-center">Kondisi: <?php echo date('d-m-Y')?></h5>
                        <div class="col-md-auto mb-2">
                                <a href="detil-pemeriksaan.php" class="btn btn-warning" target="_blank">Lihat Hasil Pemeriksaan</a>
                        </div>
                        <hr/>
                </div>
                <div class="row">
                        <h6>Progress Pemeriksaan Oleh Pengawas</h6>
                        <?php 
                                $x1 = new Database2();
                                $pemeriksaanC2ByNama = getReportPemeriksaanC2($x1);
                                $x1->close();

                                $x2 = new Database2();
                                $pemeriksaanVByNama = getReportPemeriksaanV($x2);
                                $x2->close();
                        
                        ?>
                        <div class="col">
                                <ul>
                                        <li>
                                                <b>Karom:</b> 
                                                </br>C2=<?php echo countResultByPengawas($pemeriksaanC2ByNama, 'Karom') ?> dan 
                                                      V=<?php echo countResultByPengawas($pemeriksaanVByNama, 'Karom') ?>
                                        </li>
                                        <li>
                                                <b>Bayu:</b> 
                                                </br>C2=<?php echo countResultByPengawas($pemeriksaanC2ByNama, 'Bayu') ?> dan 
                                                      V=<?php echo countResultByPengawas($pemeriksaanVByNama, 'Bayu') ?>
                                        </li>
                                        <li>
                                                <b>Jua:</b> 
                                                </br>C2=<?php echo countResultByPengawas($pemeriksaanC2ByNama, 'Jua') ?> dan 
                                                      V=<?php echo countResultByPengawas($pemeriksaanVByNama, 'Jua') ?>
                                        </li>
                                </ul>
                        </div>
                        <div class="col">
                                <ul>
                                        <li>
                                                <b>Dewi:</b> 
                                                </br>C2=<?php echo countResultByPengawas($pemeriksaanC2ByNama, 'Dewi') ?> dan 
                                                      V=<?php echo countResultByPengawas($pemeriksaanVByNama, 'Dewi') ?>
                                        </li>
                                        <li>
                                                <b>Emma:</b> 
                                                </br>C2=<?php echo countResultByPengawas($pemeriksaanC2ByNama, 'Emma') ?> dan 
                                                      V=<?php echo countResultByPengawas($pemeriksaanVByNama, 'Emma') ?>
                                        </li>
                                        <li>
                                                <b>Mudjono:</b> 
                                                </br>C2=<?php echo countResultByPengawas($pemeriksaanC2ByNama, 'Mudjono') ?> dan 
                                                      V=<?php echo countResultByPengawas($pemeriksaanVByNama, 'Mudjono') ?>
                                        </li>
                                </ul>
                        </div>
                        <div class="col">
                                <ul>
                                        <li>
                                                <b>Mukhlis:</b> 
                                                </br>C2=<?php echo countResultByPengawas($pemeriksaanC2ByNama, 'Mukhlis') ?> dan 
                                                      V=<?php echo countResultByPengawas($pemeriksaanVByNama, 'Mukhlis') ?>
                                        </li>
                                        <li>
                                                <b>Poniran:</b> 
                                                </br>C2=<?php echo countResultByPengawas($pemeriksaanC2ByNama, 'Poniran') ?> dan 
                                                      V=<?php echo countResultByPengawas($pemeriksaanVByNama, 'Poniran') ?>
                                        </li>
                                        <li>
                                                <b>Teguh:</b> 
                                                </br>C2=<?php echo countResultByPengawas($pemeriksaanC2ByNama, 'Teguh') ?> dan 
                                                      V=<?php echo countResultByPengawas($pemeriksaanVByNama, 'Teguh') ?>
                                        </li>
                                </ul>
                        </div>
                </div>
        </div>
        <div class="container">
                <hr/>
                <table id="reportPemeriksaan" class="display" style="width:100%">
                        <thead>
                                <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">No. Box Besar</th>
                                        <th class="text-center">IDBS</th>
                                        <th class="text-center">Operator</th>
                                        <th class="text-center">Waktu Pemeriksaan</th>
                                        <th class="text-center">Pemeriksa</th>
                                        <th class="text-center" width=80>Aksi</th>
                                        <th class="text-center">Ruta Sampel Hasil Pemeriksaan</th>
                                </tr>
                        </thead>
                        <tbody>
                        <?php if (count($r1) > 0) {
                                    $i = 0;
                                    foreach ($r1 as $list => $row) {
                            
                            ?>   
                            <tr <?php echo ($row['status_dokumen']==NULL || $row['status_dokumen']=='') ? 'style="background-color: #FFB4B4"' : '' ?> >
                                    <td class="text-center"><?php echo ($i + 1) ?></td>
                                    <td class="text-center">
                                        <?php 
                                        $conn3 = new Database2();
                                        $no_box = getNomorBoxBesar($conn3, $row['idbs']);
                                        $conn3->close();
                                        echo $no_box != NULL ? $no_box[0]['no_box'] : '';
                                        ?></td>
                                    <td class="text-center"><?php echo $row['idbs'] ?></td>
                                    <td><?php echo $row['nama_operator'] ?></td>
                                    <?php 
                                        $conn = new Database2();
                                        $pemeriksaans = getStatusPemeriksaan($conn, $row['idbs']);
                                        $status = count($pemeriksaans);
                                        $conn->close();

                                        $conn2 = new Database2();
                                        $nus_krt = getNUSKRTPemeriksaan($conn2, $row['idbs']);
                                        $conn2->close();

                                        $conn4 = new Database2();
                                        $statusV = getPemeriksaanV($conn4, $row['idbs']);
                                        $conn4->close();
                                    ?>
                                    <td class="text-center"><?php 
                                        echo $pemeriksaans != NULL ? $pemeriksaans[0]['waktu_pemeriksaan'] : '';
                                    ?></td>
                                    <td class="text-center"><?php echo $pemeriksaans != NULL ? $pemeriksaans[0]['pengawas'] : '';?></td>
                                    <td class="text-center d-flex flex-row justify-content-around">
                                    <?php 
                                        if ($status == 3) {
                                            echo "<button class='btn btn-sm btn-secondary' disabled>C2</button>";
                                        } else {
                                            $nobox = $no_box != NULL ? $no_box[0]['no_box'] : '';
                                            echo "<a href='form-pemeriksaan-c2.php?idbs=".$row['idbs']."&operator=".$row['nama_operator']."&no_box=$nobox' class='btn btn-sm btn-success'>C2</a>";
                                        }
                                
                                        if (count($statusV) == 1) {
                                                echo "<button class='btn btn-sm btn-secondary' disabled>V</button>";
                                            } else {
                                                $nobox = $no_box != NULL ? $no_box[0]['no_box'] : '';
                                                echo "<a href='form-pemeriksaan-v.php?idbs=".$row['idbs']."&operator=".$row['nama_operator']."&no_box=$nobox' class='btn btn-sm btn-danger'>V</a>";
                                            }
                                    ?>
                                    </td>
                                    <td>
                                        <?php 
                                                $string = '';
                                                foreach ($nus_krt as $row) {
                                                        $string .= "[" . $row['nus'] . "] " . $row['nama_krt'] . ", ";
                                                }

                                                $string = rtrim($string, ", ");

                                                if ($nus_krt != NULL) {
                                                        echo $string;
                                                } else {
                                                        echo '';
                                                }
                                        ?>
                                    </td>
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
                        $('#reportPemeriksaan').DataTable({
                                "pageLength": 50
                        });
                });
        </script>
</body>

</html>