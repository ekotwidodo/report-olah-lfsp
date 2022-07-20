<?php

    function findAll($connection)
    {
        $sql = "SELECT 
                    t0.idbs as idbs, t0.nus as nus, t0.nama_krt as nama_krt, t1.nama_operator as nama_operator, t1.status_dok as status_dokumen, CAST(t1.waktu_entri AS DATE) as waktu_entri
                FROM
                    (SELECT 
                        CONCAT(dsrt.kode_prov,dsrt.kode_kab,dsrt.kode_kec,dsrt.kode_desa,dsrt.nbs,'B') AS idbs, dsrt.no_dsrt as nus, dsrt.b3k6 as nama_krt
                    FROM SP2020C2_Validasi.dbo.m_dsrt dsrt)t0
                LEFT JOIN 
                    (SELECT 
                        CONCAT(rt.kode_prov,rt.kode_kab,rt.kode_kec,rt.kode_desa,rt.nbs,'B') AS idbs, rt.no_rt as nus, mo.realname as nama_operator, rt.status_dok as status_dok, rt.time_locked as waktu_entri
                    FROM 
                        SP2020C2_Validasi.dbo.C2_t_rt rt, SP2020C2_Validasi.dbo.m_operator mo
                    WHERE 
                        rt.kode_operator=mo.id_operator
                    GROUP BY 
                        rt.kode_prov,rt.kode_kab,rt.kode_kec,rt.kode_desa,rt.nbs,rt.no_rt, mo.realname, rt.status_dok, rt.time_locked)t1
                ON t0.idbs=t1.idbs AND t0.nus=t1.nus
                ORDER BY t0.idbs, t0.nus";
        $results = $connection->get_rows_v2($sql);
        return $results;
    }

    function findByIdBSAndNUS($connection, $idBS, $nus)
    {
        $sql = "SELECT 
                    t0.idbs as idbs, t0.nus as nus, t0.nama_krt as nama_krt, t1.nama_operator as nama_operator, t1.status_dok as status_dokumen, CAST(t1.waktu_entri AS DATE) as waktu_entri
                FROM
                    (SELECT 
                        CONCAT(dsrt.kode_prov,dsrt.kode_kab,dsrt.kode_kec,dsrt.kode_desa,dsrt.nbs,'B') AS idbs, dsrt.no_dsrt as nus, dsrt.b3k6 as nama_krt
                    FROM SP2020C2_Validasi.dbo.m_dsrt dsrt)t0
                LEFT JOIN 
                    (SELECT 
                        CONCAT(rt.kode_prov,rt.kode_kab,rt.kode_kec,rt.kode_desa,rt.nbs,'B') AS idbs, rt.no_rt as nus, mo.realname as nama_operator, rt.status_dok as status_dok, rt.time_locked as waktu_entri
                    FROM 
                        SP2020C2_Validasi.dbo.C2_t_rt rt, SP2020C2_Validasi.dbo.m_operator mo
                    WHERE 
                        rt.kode_operator=mo.id_operator
                    GROUP BY 
                        rt.kode_prov,rt.kode_kab,rt.kode_kec,rt.kode_desa,rt.nbs,rt.no_rt, mo.realname, rt.status_dok, rt.time_locked)t1
                ON t0.idbs=t1.idbs AND t0.nus=t1.nus AND t0.idbs='$idBS' AND t0.nus=$nus
                ORDER BY t0.idbs, t0.nus";
        $results = $connection->get_rows_v2($sql);
        return $results;
    }

    function findStatus($connection, $status, $kabkota)
    {
        $sql = "SELECT COUNT(*) AS jumlah
                FROM
                    (SELECT 
                        t0.idbs as idbs, t0.nus as nus, t0.nama_krt as nama_krt, t1.nama_operator as nama_operator, t1.status_dok as status_dokumen, CAST(t1.waktu_entri AS DATE) as waktu_entri
                    FROM
                        (SELECT 
                            CONCAT(dsrt.kode_prov,dsrt.kode_kab,dsrt.kode_kec,dsrt.kode_desa,dsrt.nbs,'B') AS idbs, dsrt.no_dsrt as nus, dsrt.b3k6 as nama_krt
                        FROM SP2020C2_Validasi.dbo.m_dsrt dsrt)t0
                    LEFT JOIN 
                        (SELECT 
                            CONCAT(rt.kode_prov,rt.kode_kab,rt.kode_kec,rt.kode_desa,rt.nbs,'B') AS idbs, rt.no_rt as nus, mo.realname as nama_operator, rt.status_dok as status_dok, rt.time_locked as waktu_entri
                        FROM 
                            SP2020C2_Validasi.dbo.C2_t_rt rt, SP2020C2_Validasi.dbo.m_operator mo
                        WHERE 
                            rt.kode_operator=mo.id_operator
                        GROUP BY 
                            rt.kode_prov,rt.kode_kab,rt.kode_kec,rt.kode_desa,rt.nbs,rt.no_rt, mo.realname, rt.status_dok, rt.time_locked)t1
                    ON t0.idbs=t1.idbs AND t0.nus=t1.nus)t
                WHERE 
                    " . $status . " AND SUBSTRING(idbs, 1, 4)='" . $kabkota . "'";
        $results = $connection->get_rows_v2($sql);
        return $results;
    }
?>