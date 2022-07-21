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
    <title>Progress Report | Lapor Pemeriksaan</title>
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
                        $no_box = isset($_GET['no_box']) ? $_GET['no_box'] : '';
                        $operator = isset($_GET['operator']) ? $_GET['operator'] : '';
                        $pengawas = isset($_GET['pengawas']) ? $_GET['pengawas'] : '';
                        $operator_pemeriksa = $operator . ' # ' . $pengawas;
                    ?>
                    <form id="form-pemeriksaan" action="insert.php" method="post">
                        <div class="mt-3 mb-3" id="error-message"></div>
                        <div class="mt-3 mb-3">
                            <label for="no_box" class="form-label">Nomor Box Besar</label>
                            <input type="text" id="no_box" name="no_box" class="form-control" value="<?php echo $no_box;?>" disabled>
                        </div>
                        <div class="mt-3 mb-3">
                            <label for="idbs" class="form-label">ID Wilayah (idbs) </label>
                            <input type="text" id="idbs" name="idbs" class="form-control" value="<?php echo $idbs; ?>" disabled>
                        </div>
                        <div class="mt-3 mb-3">
                            <label for="nus" class="form-label">No. Sampel</label>
                            <select id="nus" name="nus" class="form-control">
                                <option value="0">- Pilih No. Sampel Rumah Tangga -</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                            </select>
                        </div>
                        <div class="mt-3 mb-3">
                            <label for="nama_krt" class="form-label">Nama KRT</label>
                            <input type="text" id="nama_krt" name="nama_krt" class="form-control">
                        </div>
                        <div class="mt-3 mb-3">
                            <label for="operator_pemeriksa" class="form-label">Operator # Pemeriksa</label>
                            <input type="text" id="operator_pemeriksa" name="operator_pemeriksa" class="form-control" value="<?php echo $operator_pemeriksa;?>" disabled>
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

                let idbs = $('#idbs').val()
                let operator_pemeriksa = $('#operator_pemeriksa').val()
                let operator = operator_pemeriksa.split(' # ')[0]
                let pemeriksa = operator_pemeriksa.split(' # ')[1]
                let nus = $('#nus').val()
                let nama_krt = $('#nama_krt').val()
                let no_box = $('#no_box').val()
                let temuan = $('#temuan').val()
                let errors = []

                if (no_box=='') {
                    errors.push('Nomor Box Besar masih kosong')
                }
                if (nus=='0') {
                    errors.push('Nomor Sampel belum dipilih')
                }
                if (nama_krt=='') {
                    errors.push('Nama KRT Besar masih kosong')
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

                    $.ajax({
                        type: 'POST',
                        url: 'insert-pemeriksaan.php',
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
                                    window.location.href = 'pemeriksaan.php'
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
                                    window.location.href = `pemeriksaan.php`
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