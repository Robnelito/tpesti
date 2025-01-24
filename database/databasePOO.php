<?php

class DatabaseConnection
{
    private $host = "localhost";
    private $dbName = "testEsti";
    private $username = "root";
    private $password = "";
    protected $conn;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO(
                    "mysql:host={$this->host};dbname={$this->dbName}",
                    $this->username,
                    $this->password
                );
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                error_log("Database connection failed: " . $e->getMessage());
                die("Database connection error. Please try again later.");
            }
        }
    }

    protected function executeQuery($sql, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Query execution failed: " . $e->getMessage());
            return [];
        }
    }

    protected function executeNonQuery($sql, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Non-query execution failed: " . $e->getMessage());
            return false;
        }
    }
}
