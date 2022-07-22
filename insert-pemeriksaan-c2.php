<?php
include './autoload.php';
include './config/database2.php';
include './functions/common.php';

// set ke jakarta time
date_default_timezone_set('Asia/Jakarta');

try {
    $idbs = $_POST['idbs'];
    $nus = $_POST['nus'];
    $nama_krt = $_POST['nama_krt'];
    $operator = $_POST['operator'];
    $pemeriksa = $_POST['pemeriksa'];
    $temuan = $_POST['temuan'];
    $no_box = $_POST['no_box'];
    $data = array(
        'idbs' => $idbs,
        'nus' => $nus,
        'nama_krt' => $nama_krt,
        'operator' => $operator,
        'pengawas' => $pemeriksa,
        'no_box' => $no_box,
        'temuan' => $temuan
    );

    $conn = new Database2();
    $result = createPemeriksaan($conn, $data);
    $conn->close();
    echo json_encode(
        array(
            'status' => TRUE,
            'message' => 'Data berhasil disimpan!'
        )
    );
} catch (Exception $e) {
    echo json_encode(
        array(
            'status' => FALSE,
            'message' => $e->getMessage()
        )
    );
}
?>