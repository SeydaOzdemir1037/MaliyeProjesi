<?php
session_start();

class DBController
{
    protected $conn;

    function __construct()
    {
        if (!isset($_SESSION["kullanici_giris_adi"])) {
            header("location: http://" . $_SERVER['SERVER_NAME'] . "/admin/index.php");
            exit;
        }
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