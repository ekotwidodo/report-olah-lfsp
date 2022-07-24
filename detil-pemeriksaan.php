<?php
include './autoload.php';
include './config/database2.php';
include './functions/common.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Progress Report | Hasil Pemeriksaan</title>
        <link rel="shortcut icon" href="https://bpslampung.id/landing/img/logo.png" type="image/png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
        <?php include './includes/navbar.php' ?>
        <div class="container">
                <div class="row">
                        <h1 class="text-center">Hasil Pemeriksaan C2 dan V</h1>
                        <h5 class="text-center">Kondisi: <?php echo date('d-m-Y')?></h5>
                        <hr/>
                </div>
        </div>
        <div class="container">
            <?php 
                $c2 = new Database2();
                $temuanC2 = getReportPemeriksaanC2($c2);
                $c2->close();

                $v = new Database2();
                $temuanV = getReportPemeriksaanV($v);
                $v->close();

            ?>
            <div class="row">
                <div class="col">
                    <h3 class="text-center">Hasil Pemeriksaan C2 (<?php echo count($temuanC2)?> baris)</h3>
                    <?php foreach ($temuanC2 as $list => $row) { ?>
                        <div class="alert alert-info" role="alert">
                            [<?php echo $row['pengawas'] ?>] <?php echo $row['temuan'] ?>
                    </div>
                    <?php } ?>
                </div>
                <div class="col">
                    <h3 class="text-center">Hasil Pemeriksaan V (<?php echo count($temuanV)?> baris)</h3>
                    <?php foreach ($temuanV as $list => $row) { ?>
                        <div class="alert alert-secondary" role="alert">
                            [<?php echo $row['pengawas'] ?>] <?php echo $row['temuan'] ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
</body>

</html>