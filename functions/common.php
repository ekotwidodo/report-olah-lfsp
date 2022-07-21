<?php

    function getPengawas ($operator)
    {
        $data = [
            'MUHAMMAD DZAKI BISRI' => 'Bayu',
            'SRI MARWATI' => 'Bayu',
            'OTHMAN MAHMUD' => 'Bayu',
            'ADITYA PRATAMA PUTRA' => 'Dewi',
            'ALVIN SAPUTRA' => 'Dewi',
            'WIRANTO IRWAN PALAM' => 'Dewi',
            'AFNI MAISAROH' => 'Emma',
            'GATYA SALMASETRI' => 'Emma',
            'PIGA ANUGERAH PUTRA' => 'Emma',
            'AYU LARASATI' => 'Jua',
            'MUHAMMAD FARID ALFASHA' => 'Jua',
            'PITRI WULANDARI' => 'Jua',
            'MUHAMMAD FAJAR AZHOH' => 'Karom',
            'FATHIYAH ISLAHIYAH' => 'Karom',
            'HAYATUN NUFUS FAUZIAH' => 'Karom',
            'DIAH WULANDARI' => 'Mudjono',
            'SELVI NOVALIANA' => 'Mudjono',
            'RAFID AZIZ DARSONO' => 'Mudjono',
            'IIS YULIANITA' => 'Mukhlis',
            'RIZA UMAMI' => 'Mukhlis',
            'RIZKA MALIA' => 'Mukhlis',
            'ELSA HESTY MIRANI' => 'Poniran',
            'IDA WATI' => 'Poniran',
            'MERRY ASTUTI' => 'Poniran',
            'TABINA HANAN' => 'Poniran',
            'KETUT FITRIANI' => 'Teguh',
            'AJENG SALICHA RAMADANTHYS AJIMA' => 'Teguh',
            'NUR HASANAH' => 'Teguh'
        ];

        return $data[$operator];
    }

    function createPemeriksaan($connection, $data)
    {
        $idbs = $data['idbs'];
        $nus = $data['nus'];
        $no_box = $data['no_box'];
        $nama_krt = $data['nama_krt'];
        $operator = $data['operator'];
        $temuan = $data['temuan'];
        $pengawas = $data['pengawas'];

        $sql = "INSERT INTO hasil_pengawasan (idbs, nus, no_box, nama_krt, operator, temuan, pengawas, waktu_pemeriksaan) VALUES ('$idbs', $nus, $no_box, '$nama_krt', '$operator', '$temuan', '$pengawas', NOW())";

        $results = $connection->get_rows_v2($sql);
        return $results;
    }

    function getStatusPemeriksaan($connection, $idbs)
    {
        $sql = "SELECT * FROM hasil_pengawasan WHERE idbs='$idbs'";
        $results = $connection->get_rows_v2($sql);
        return $results;
    }

    function getPemeriksaanV($connection, $idbs)
    {
        $sql = "SELECT * FROM hasil_pemeriksaan_v WHERE idbs='$idbs'";
        $results = $connection->get_rows_v2($sql);
        return $results;
    }

    function createPemeriksaanV($connection, $data)
    {
        $idbs = $data['idbs'];
        $no_box = $data['no_box'];
        $operator = $data['operator'];
        $temuan = $data['temuan'];
        $pengawas = $data['pengawas'];

        $sql = "INSERT INTO hasil_pemeriksaan_v(idbs, no_box, operator, temuan, pengawas, waktu_pemeriksaan) VALUES ('$idbs', $no_box, '$operator', '$temuan', '$pengawas', NOW())";

        $results = $connection->get_rows_v2($sql);
        return $results;
    }

    function getNUSKRTPemeriksaan($connection, $idbs)
    {
        $sql = "SELECT nus,nama_krt FROM hasil_pengawasan WHERE idbs='$idbs'";
        $results = $connection->get_rows_v2($sql);
        return $results;
    }

    function getNomorBoxBesar($connection, $idbs)
    {
        $sql = "SELECT no_box FROM penerimaan_dokumen WHERE idbs='$idbs'";
        $results = $connection->get_rows_v2($sql);
        return $results;
    }

    function getRandomNUS()
    {
        $result = [];
        $firstRandom = rand($min=1, $max=16);
        $result[] = $firstRandom;
        $idx = 0;
        while ($idx < 3 && count($result) < 3) {
            $lastRandom = $result[count($result) - 1];
            $newRandom = rand($min=1, $max=16);
            if ($lastRandom != $newRandom) {
                $result[] = $newRandom;
            }

            $idx++;
        }

        return $result;
    }
?>