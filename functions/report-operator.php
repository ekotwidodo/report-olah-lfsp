<?php

    function getReportTotal($connection)
    {
        $sql = "SELECT t1.kode_kab as kode_kab, t1.total_entri_bs as total_entri_bs, t2.total_entri_ruta as total_entri_ruta
                FROM
                    (SELECT rt.kode_kab as kode_kab, COUNT(*) as total_entri_bs
                    FROM SP2020C2_Validasi.dbo.C2_t_rt rt, SP2020C2_Validasi.dbo.m_operator mo
                    WHERE rt.kode_operator=mo.id_operator AND rt.no_rt=1
                    GROUP BY rt.kode_kab)t1,
                    (SELECT rt.kode_kab as kode_kab, COUNT(*) as total_entri_ruta
                    FROM SP2020C2_Validasi.dbo.C2_t_rt rt, SP2020C2_Validasi.dbo.m_operator mo
                    WHERE rt.kode_operator=mo.id_operator
                    GROUP BY rt.kode_kab)t2
                WHERE t1.kode_kab=t2.kode_kab
                ORDER BY t1.kode_kab";
        $results = $connection->get_rows_v2($sql);
        return $results;
    }

    function getReportOperators($connection)
    {
        $sql = "SELECT 
                    t1.id_operator, t1.kode_operator, t1.nama_operator, t1.jml_entri_bs, t2.jml_entri_ruta, t3.jml_entri_ruta_clean, (t2.jml_entri_ruta - t3.jml_entri_ruta_clean) as jml_entri_ruta_error
                FROM 
                    (SELECT 
                        rt.kode_operator as id_operator, mo.kode_op as kode_operator, mo.realname as nama_operator, COUNT(*) as jml_entri_bs 
                    FROM 
                        SP2020C2_Validasi.dbo.C2_t_rt rt, SP2020C2_Validasi.dbo.m_operator mo 
                    WHERE rt.kode_operator=mo.id_operator AND rt.no_rt=1
                    GROUP BY rt.kode_operator, mo.kode_op, mo.realname)t1,
                    (SELECT 
                        rt.kode_operator as id_operator, mo.kode_op as kode_operator, mo.realname as nama_operator, COUNT(*) as jml_entri_ruta 
                    FROM 
                        SP2020C2_Validasi.dbo.C2_t_rt rt, SP2020C2_Validasi.dbo.m_operator mo 
                    WHERE rt.kode_operator=mo.id_operator
                    GROUP BY rt.kode_operator, mo.kode_op, mo.realname)t2,
                    (SELECT 
                        rt.kode_operator as id_operator, mo.kode_op as kode_operator, mo.realname as nama_operator, COUNT(*) as jml_entri_ruta_clean 
                    FROM 
                        SP2020C2_Validasi.dbo.C2_t_rt rt, SP2020C2_Validasi.dbo.m_operator mo 
                    WHERE rt.kode_operator=mo.id_operator AND rt.status_dok='C'
                    GROUP BY rt.kode_operator, mo.kode_op, mo.realname)t3
                WHERE 
                    t1.id_operator=t2.id_operator AND t1.id_operator=t3.id_operator
                ORDER BY t1.kode_operator";
        $results = $connection->get_rows_v2($sql);
        return $results;
    }
?>