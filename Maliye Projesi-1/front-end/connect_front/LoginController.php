<?php
session_start();
class LoginController
{
    private $conn;

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

    function kisiGiris($username,$password){
        $sth = $this->conn->prepare("SELECT * FROM kisi WHERE kisi_giris_adi=? and kisi_sifre=?");
        $sth->execute([$username,$password]);
        $result = $sth->fetch();
        if ( $sth->rowCount() == 1) {
            $_SESSION['kisi_giris_adi'] = $result['kisi_ad'];
            $_SESSION['id'] = $result['id'];
            header("Location:index.php?durum=ok");
        } else {
            header("Location:login.php?durum=basarisiz");
            exit;
        }
    }
}