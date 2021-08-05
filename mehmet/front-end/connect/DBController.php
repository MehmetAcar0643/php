<?php
session_start();

class DBController
{
    protected $conn;

    function __construct()
    {
        $dsn = 'mysql:dbname=mehmetacar;host=localhost;charset=utf8';
        $user = 'root';
        $password = 'root';

        try {
            $dbh = new PDO($dsn, $user, $password);
            $this->conn = $dbh;
        } catch (PDOException $e) {
            echo 'Bağlantı kurulamadı: ' . $e->getMessage();
        }
    }

}

?>
