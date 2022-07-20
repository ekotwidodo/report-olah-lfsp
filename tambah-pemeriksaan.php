<?php
include './autoload.php';
include './config/database2.php';

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
    <!-- SweetAlert 2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.min.css">
</head>

<body>
    <?php include './includes/navbar.php' ?>
    <div class="container">
        <div class="row">
            <h1 class="text-center">Laporan Hasil Pemeriksaan C2 dan V</h1>
            <hr />
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h3>Form Pemeriksaan</h3>
                    <?php 
                        $idbs = isset($_GET['idbs']) ? $_GET['idbs'] : '';
                        $nus = isset($_GET['nus']) ? $_GET['nus'] : '';
                        $nama_krt = isset($_GET['nama_krt']) ? $_GET['nama_krt'] : '';
                        $operator = isset($_GET['operator']) ? $_GET['operator'] : '';
                        $pengawas = isset($_GET['pengawas']) ? $_GET['pengawas'] : '';

                        $ruta_sampel = $idbs . ' # ' . $nus . ' # ' . $nama_krt;
                        $operator_pemeriksa = $operator . ' # ' . $pengawas;
                    ?>
                    <form id="form-pemeriksaan" action="insert.php" method="post">
                        <div class="mt-3 mb-3" id="error-message"></div>
                        <div class="mt-3 mb-3">
                            <label for="ruta_sampel" class="form-label">ID Wilayah # NUS # Nama KRT</label>
                            <input type="text" id="ruta_sampel" name="ruta_sampel" class="form-control" value="<?php echo $ruta_sampel; ?>" disabled>
                        </div>
                        <div class="mt-3 mb-3">
                            <label for="operator_pemeriksa" class="form-label">Operator # Pemeriksa</label>
                            <input type="text" id="operator_pemeriksa" name="operator_pemeriksa" class="form-control" value="<?php echo $operator_pemeriksa;?>" disabled>
                        </div>
                        <div class="mt-3 mb-3">
                            <label for="no_box" class="form-label">Nomor Box Besar</label>
                            <input type="text" id="no_box" name="no_box" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="temuan" class="form-label">Hasil Pemeriksaan</label>
                            <textarea name="temuan" id="temuan" name="temuan" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">SIMPAN LAPORAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- SweetAlert 2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#form-pemeriksaan').submit(function(e) {
                e.preventDefault()

                let ruta_sampel = $('#ruta_sampel').val()
                let idbs = ruta_sampel.split(' # ')[0]
                let nus = ruta_sampel.split(' # ')[1]
                let nama_krt = ruta_sampel.split(' # ')[2]
                let operator_pemeriksa = $('#operator_pemeriksa').val()
                let operator = operator_pemeriksa.split(' # ')[0]
                let pemeriksa = operator_pemeriksa.split(' # ')[1]
                console.log(idbs, nus, nama_krt, operator, pemeriksa)
                let no_box = $('#no_box').val()
                let temuan = $('#temuan').val()
                let errors = []

                if (no_box=='') {
                    errors.push('Nomor Box Besar masih kosong')
                }
                
                if (temuan=='') {
                    errors.push('Temuan masih kosong')
                }

                if (errors.length > 0) {

                    let html = ''
                    for (let idx = 0; idx < errors.length; idx++) {
                        html += `<li style="color:red;">${errors[idx]}</li>`
                    }

                    $('#error-message').html(`<ul>${html}</ul>`)

                } else {
                    let data = {
                        idbs, nus, nama_krt, operator, pemeriksa, no_box, temuan
                    }
                    console.log(data)

                    $.ajax({
                        type: 'POST',
                        url: 'insert.php',
                        data: data,
                        dataType: 'json',
                        encode: true,
                        success: function(data) {
                            if (data.status) {
                                Swal.fire(
                                    {
                                        icon: 'success',
                                        title: 'SIMPAN DATA',
                                        text: data.message
                                    }
                                ).then(() => {
                                    window.location.href = 'ruta.php'
                                });
                            }
                        },
                        error: function(err) {
                            if (data.status) {
                                Swal.fire(
                                    {
                                        icon: 'error',
                                        title: 'SIMPAN DATA',
                                        text: data.message
                                    }
                                ).then(() => {
                                    window.location.href = `ruta.php`
                                });
                            }
                        }
                    });

                }
            })

        })
    </script>
</body>

</html>