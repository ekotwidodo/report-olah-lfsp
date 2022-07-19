<?php  

class Database
{
    private $serverName;
    private $userName;
    private $password;
    private $databaseName;
    private $conn = null;

    public function __construct()
    {
        try 
        {
            $this->serverName = $_ENV['DB_HOST'];
            $this->userName = $_ENV['DB_USER'];
            $this->password = $_ENV['DB_PASS'];
            $this->databaseName = $_ENV['DB_NAME'];

            $this->conn = new PDO("sqlsrv:server=$this->serverName;Database=$this->databaseName", $this->userName, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch (Exception $e) 
        {
            die(print_r($e->getMessage()));
        }
        
    }

    public function close()
    {
        $this->conn = null;
    }

    protected function query_executed($sql)
    {
        $s = $this->conn->query($sql);
        return $s;
    }

    public function get_rows_v1($fields, $id = NULL, $tableName = NULL, $groupBy = NULL, $orderBy = NULL)
    {
        $cn = !empty($id) ? " WHERE $id " : " ";
        $fields = !empty($fields) ? $fields : " * ";
        $groupBy = !empty($groupBy) ? "GROUP BY $groupBy" : " ";
        $orderBy = !empty($orderBy) ? "ORDER BY $orderBy" : " ";
        $sql = "SELECT $fields FROM $tableName $cn $groupBy $orderBy";
        $statements = $this->query_executed($sql);
        $rows = $this->get_fetch_data($statements);
        return $rows;
    }

    public function get_rows_v2($query)
    {
        $statements = $this->query_executed($query);
        $rows = $this->get_fetch_data($statements);
        return $rows;
    }

    protected function get_fetch_data($s)
    {
        $array = array();
        while ($rows = $s->fetch(PDO::FETCH_ASSOC)) {
            $array[] = $rows;
        }

        $this->conn = null;
        return $array;
    }
}