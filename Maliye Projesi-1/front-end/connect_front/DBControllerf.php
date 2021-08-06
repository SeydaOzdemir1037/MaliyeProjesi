<?php
session_start();
class DBControllerf
{
    protected $conn;

    function __construct()
    {
        $dsn = 'mysql:dbname=dene;host=localhost;charset=utf8';
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