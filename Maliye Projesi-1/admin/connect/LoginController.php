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

    function kullanicigiris($username,$password){
        $kullanicisor = $this->conn->prepare("SELECT * FROM kullanici WHERE  kullanici_giris_adi=:a and kullanici_password=:b");
        $kullanicisor->execute(array(
            'a' => $username,
            'b' => md5($password)
        ));
        $say = $kullanicisor->rowCount();

        if ($say > 0) {
            $_SESSION['kullanici_giris_adi'] = $username;
            header("Location:../dist/index.php");
        } else {
            header("Location:../dist/login.php?durum=no");
            exit;
        }
    }







}
?>