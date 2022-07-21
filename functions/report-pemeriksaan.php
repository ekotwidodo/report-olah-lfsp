<?php

    function findPemeriksaan($connection)
    {
        $sql = "SELECT 
                    t0.idbs as idbs, t1.nama_operator as nama_operator, t1.status_dok as status_dokumen, CAST(t1.waktu_entri AS DATE) as waktu_entri
                FROM
                    (SELECT 
                        CONCAT(dsrt.kode_prov,dsrt.kode_kab,dsrt.kode_kec,dsrt.kode_desa,dsrt.nbs,'B') AS idbs
                    FROM SP2020C2_Validasi.dbo.m_dsrt dsrt WHERE dsrt.no_dsrt=1)t0
                LEFT JOIN 
                    (SELECT 
                        CONCAT(rt.kode_prov,rt.kode_kab,rt.kode_kec,rt.kode_desa,rt.nbs,'B') AS idbs, mo.realname as nama_operator, rt.status_dok as status_dok, rt.time_locked as waktu_entri
                    FROM 
                        SP2020C2_Validasi.dbo.C2_t_rt rt, SP2020C2_Validasi.dbo.m_operator mo
                    WHERE 
                        rt.kode_operator=mo.id_operator AND rt.no_rt=1
                    GROUP BY 
                        rt.kode_prov,rt.kode_kab,rt.kode_kec,rt.kode_desa,rt.nbs, mo.realname, rt.status_dok, rt.time_locked)t1
                ON t0.idbs=t1.idbs
                ORDER BY t0.idbs";
        $results = $connection->get_rows_v2($sql);
        return $results;
    }
?>