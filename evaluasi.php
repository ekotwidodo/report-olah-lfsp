<?php
include './autoload.php';
include './config/database.php';
include './functions/query-evaluasi.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Progress Report | Kesalahan</title>
        <link rel="shortcut icon" href="https://bpslampung.id/landing/img/logo.png" type="image/png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>

<body>
        <?php include './includes/navbar.php' ?>
        <div class="container">
                <div class="row">
                        <h1 class="text-center">Evaluasi Hasil Pengolahan C2 dan V</h1>
                        <h5 class="text-center">Kondisi: <?php echo date('d-m-Y')?></h5>
                        <hr/>
                </div>
        </div>
        <div class="container">
                <h3>Evaluasi Wajib</h3>
                <?php 
                        $mainTitles = [
                                'Q1-Pengecekan jumlah ART pada rincian 112 tidak sama dengan jumlah ART pada blok 3',
                                'Q2-Pastikan umur terisi dan isian umur harus diantara 0-95 tahun',
                                'Q3-Pastikan konsistensi isian umur dengan bulan dan tahun lahir',
                                'Q4-Pastikan jenis kelamin terisi',
                                'Q5-Konsistensi jenis kelamin suami istri berdasarkan status hubungan dengan KRT'
                        ]
                ?>
                <div class="row mb-3">
                        <div class="list-group">
                                <?php 
                                        $idx = 0;
                                        foreach ($mainTitles as $title) { ?>
                                               <a href="hasil-evaluasi.php?q=<?php echo ($idx + 1);?>&title=<?php echo $title ?>" class="list-group-item list-group-item-action">
                                                        <?php echo $title; ?>
                                                </a>
                                <?php 
                                                $idx++;
                                        } ?>
                        </div>
                </div>
                <h3>Evaluasi Tambahan</h3>
                <div class="row mb-3">
                        <div class="list-group">
                        </div>
                </div>
                <h3>Penghitungan Indikator</h3>
                <div class="row mb-3">
                        <div class="list-group">
                        </div>
                </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script>
                $(document).ready(function() {
                        $('#reportEvaluasi').DataTable({
                                "pageLength": 50
                        });
                });
        </script>
</body>

</html>