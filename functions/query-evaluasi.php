<?php

    function readQuery($idx)
    {
        $queries = [];

        if ($file = fopen("query.txt", "r")) {
            $queries = [];
            while (!feof($file)) {
                $queries[] = fgets($file);
            }
            fclose($file);
        }
        return $queries[$idx];
    }

    function queryUtama($connection, $q)
    {
        $sql = readQuery($q - 1);
        $results = $connection->get_rows_v2($sql);
        return $results;
    }

?>