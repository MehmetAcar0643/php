<?php
session_start();

class LoginController
{
    private $conn;

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
    function kullanicigiris($username,$password){
        $kullanicisor = $this->conn->prepare("SELECT * FROM login WHERE mail=:username and sifre=:password");
        $kullanicisor->execute(array(
            'username' => $username,
            'password' => md5($password)
        ));
        $say = $kullanicisor->rowCount();

        if ($say == 1) {
            $_SESSION['kullanici_nickname'] = $username;
            header("Location:../pages/index.php");
        } else {
            header("Location:../pages/login.php?durum=no");
            exit;
        }
    }

    function kullanici_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM login");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function kullanici_guncelle($sifre){
        $sth = $this->conn->prepare("UPDATE login SET sifre = ? WHERE id =22");
        $flag = $sth->execute([$sifre]);
        if($flag){
            return true;
        }
        else{
            return false;
        }
    }
}

?>
