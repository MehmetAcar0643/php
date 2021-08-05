<?php
require_once 'config.php';


class Database extends dbConfig
{
    protected $connection;

    function __construct()
    {
        parent::createConfig();
        try {
            $dsn = 'mysql:host=' . $this->dbConfig['host'] . ';dbname=' . $this->dbConfig['dbname'];
            $this->connection = new PDO($dsn, $this->dbConfig['username'], $this->dbConfig['password'], $driver_options = array());
            $this->connection->query("SET NAMES utf8");
            $this->connection->query("SET CHARACTER SET utf8");
            $this->connection->query("SET COLLATION_CONNECTION = 'utf8_turkish_ci");
            $this->confirmUser();
            return true;
        } catch (PDOException $error) {
            $errorMesage = 'Hata : Veritabanı bağlantısı kurulamadı !<br>Hata Mesajı =>' . $error->getMessage();
            echo $errorMesage;
        }
    }

    public function confirmUser(){
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $user = $_POST['username'];
            $pass = md5($_POST['password']);
            $result = $this->connection->prepare("SELECT * FROM `kullanicilar` WHERE username = :username AND password = :password AND  act= 1");
            $result->bindParam(':username', $user, PDO::PARAM_STR);
            $result->bindParam(':password', $pass, PDO::PARAM_STR);
            $result->execute();
            $obj = $result->fetch(PDO::FETCH_OBJ);
            $userid = $obj->id;
            $username = $obj->username;
            $password = $obj->password;
            $_SESSION["kutuphane"]['userid'] = $userid;
            $_SESSION["kutuphane"]['username'] = $username;
            $_SESSION["kutuphane"]['password'] = $password;
        }
        if (isset($_SESSION["kutuphane"]["username"]) && isset($_SESSION["kutuphane"]["password"])) {
            $username = $_SESSION["kutuphane"]["username"];
            $password = $_SESSION["kutuphane"]["password"];
            $result = $this->connection->prepare("SELECT COUNT(*) FROM `kullanicilar` WHERE username = :username AND password = :password AND act = 1");
            $result->bindParam(':username', $username, PDO::PARAM_STR);
            $result->bindParam(':password', $password, PDO::PARAM_STR);
            $result->execute();
            $varmi = $result->fetchColumn();
            if ($varmi == 0) {
                header("Refresh:0; url=login.php");
                die();
            }
        } else {
            header("Refresh:0; url=login.php");
            die();
        }}

    public function user()
    {
        $username = $_SESSION["kutuphane"]["username"];
        $password = $_SESSION["kutuphane"]["password"];
        $result = $this->connection->prepare("SELECT * FROM `kullanicilar` WHERE username = :username AND password = :password AND act = 1");
        $result->bindParam(':username', $username, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        $obj = $result->fetch(PDO::FETCH_OBJ);
        return $obj;
    }

    public function changepass($sifre, $username)
    {
        $result = $this->connection->prepare("UPDATE `kullanicilar` SET password = :password WHERE username = :username");
        $result->bindParam(':username', $username, PDO::PARAM_STR);
        $result->bindParam(':password', $sifre, PDO::PARAM_STR);
        if ($result->execute()) {
            $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-success">Güncellendi.</div></div>';
            $_SESSION["kutuphane"]["username"] = $username;
            $_SESSION["kutuphane"]["password"] = $sifre;
        } else {
            $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-danger">Başarısız.</div></div>';
        }
    }

    public function arama($key)
    {

        $result = $this->connection->prepare("SELECT *, `kategori`.kategori AS kategoriad, `kitaplar`.id AS id FROM kitaplar
    INNER JOIN kategori ON (`kitaplar`.kategori = `kategori`.id)
    WHERE (`kitaplar`.yazar LIKE :part) OR 
      (`kitaplar`.kitapadi LIKE :part) OR 
      (`kitaplar`.yayinevi LIKE :part) OR 
      (`kitaplar`.aciklama LIKE :part) OR 
      (`kitaplar`.isbn LIKE :part) AND `kitaplar`.act = 1 ORDER BY `kitaplar`.id ");
        $result->bindParam(':part', $part, PDO::PARAM_STR);
        $result->execute();
        $kitap = $result->fetchAll();
        return array( $kitap);
    }

    public function mesaj()
    {
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
    }

    public function meta()
    {
        $result = $this->connection->prepare("SELECT * FROM ayarlar");
        $result->execute();
        $obj = $result->fetch(PDO::FETCH_OBJ);
        return $obj;
    }

    //KITAP ISLEMLERI
    public function kitapislemleri($sayfa, $kacadet)
    {
        if ($sayfa == '') {
            $burdan = 0;
        } else {
            $burdan = ($kacadet * $sayfa) - $kacadet;
        }

        $result = $this->connection->prepare("SELECT * FROM kitapislemleri WHERE act = 1 ORDER BY gelecektar DESC LIMIT :burdan, :buraya");
        $result->bindParam(':burdan', $burdan, PDO::PARAM_INT);
        $result->bindParam(':buraya', $kacadet, PDO::PARAM_INT);
        $result->execute();
        return $result;
    }

    public function arakitapislemleri($ara, $sayfa, $kacadet)
    {
        if ($sayfa == '') {
            $burdan = 0;
        } else {
            $burdan = ($kacadet * $sayfa) - $kacadet;
        }
        $key = htmlspecialchars(trim($ara));
        $part = "%" . $key . "%";

        $result = $this->connection->prepare("SELECT 
		kitapislemleri.gelecektar AS gelecektar, 
		kitapislemleri.alinistar AS alinistar, 
		kitapislemleri.verilistar AS verilistar, 
		kitapislemleri.kitapid AS kitapid, 
		kitapislemleri.kimde AS kimde, 
		kitapislemleri.tc AS tc, 
		kitapislemleri.unvan AS unvan, 
		kitapislemleri.iletisim AS iletisim, 
		kitapislemleri.id AS id 
		FROM kitapislemleri INNER JOIN kitaplar ON (kitapislemleri.kitapid = kitaplar.id)
		 WHERE ((`kitaplar`.yazar LIKE :part) OR (`kitaplar`.kitapadi LIKE :part) OR (`kitapislemleri`.kimde LIKE :part) OR (`kitapislemleri`.tc LIKE :part)) AND `kitaplar`.act = 1 ORDER BY `kitapislemleri`.gelecektar DESC LIMIT :burdan, :buraya");
        $result->bindParam(':part', $part, PDO::PARAM_STR);
        $result->bindParam(':burdan', $burdan, PDO::PARAM_INT);
        $result->bindParam(':buraya', $kacadet, PDO::PARAM_INT);
        $result->execute();
        return $result;
    }

    public function suresigecen()
    {
        $result = $this->connection->prepare("SELECT * FROM kitapislemleri WHERE act = 1 AND gelecektar < CURDATE() AND alinistar is null ORDER BY gelecektar DESC");
        $result->execute();
        return $result;
    }

    public function suresigecensay()
    {
        $result = $this->connection->prepare("SELECT COUNT(*) FROM kitapislemleri WHERE act = 1 AND gelecektar < CURDATE() AND alinistar is null ORDER BY gelecektar DESC");
        $result->execute();
        return $result->fetchColumn();
    }

    public function getkitapislemleri($id)
    {
        $result = $this->connection->prepare("SELECT * FROM kitapislemleri WHERE id = :id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $obj = $result->fetch(PDO::FETCH_OBJ);
        return $obj;
    }

    public function disaridaki()
    {
        $result = $this->connection->prepare("SELECT * FROM kitapislemleri WHERE act = 1 AND alinistar is null ORDER BY id DESC");
        $result->execute();
        return $result;
    }

    public function kitapmusait($id)
    {
        $flag = "true";
        $result1 = $this->connection->prepare("SELECT COUNT(*) FROM kitaplar WHERE act = 1 AND id = :id");
        $result1->bindParam(':id', $id, PDO::PARAM_INT);
        $result1->execute();
        $say = $result1->fetchColumn();
        if ($say == 0) {
            $flag = "false";
            $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-danger">Kütüphanede kitap bulunamadı.</div></div>';
        }
        $result2 = $this->connection->prepare("SELECT COUNT(*) FROM kitapislemleri WHERE act = 1 AND kitapid=:kitapid AND alinistar is null");
        $result2->bindParam(':kitapid', $id, PDO::PARAM_INT);
        $result2->execute();
        $say2 = $result2->fetchColumn();
        if ($say2 > 0) {
            $flag = "false";
            $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-danger">Bu kitap başkasında bulunmaktadır.</div></div>';
        }
        return $flag;
    }

    public function getAuthor($username)
    {
        $result = $this->connection->prepare("SELECT * FROM kullanicilar WHERE username = :username");
        $result->bindParam(':username', $username, PDO::PARAM_STR);
        $result->execute();
        $obj = $result->fetch(PDO::FETCH_OBJ);
        return $obj;
    }

    public function kitapver($kitap)
    {
        $result = $this->connection->prepare("INSERT INTO kitapislemleri (`kitapid`, `kimde`, `tc`, `unvan`, `verilistar`, 
            `gelecektar`, `iletisim`, `veren`) 
            VALUES (:kitapid, :kimde, :tc, :unvan, :verilistar, :gelecektar, :iletisim, :veren)");
        $result->bindParam(':kitapid', $kitap['kitapid'], PDO::PARAM_INT);
        $result->bindParam(':kimde', $kitap['kimde'], PDO::PARAM_STR);
        $result->bindParam(':tc', $kitap['tc'], PDO::PARAM_STR);
        $result->bindParam(':unvan', $kitap['unvan'], PDO::PARAM_STR);
        $result->bindParam(':verilistar', $kitap['verilistar'], PDO::PARAM_STR);
        $result->bindParam(':gelecektar', $kitap['gelecektar'], PDO::PARAM_STR);
        $result->bindParam(':iletisim', $kitap['iletisim'], PDO::PARAM_STR);
        $result->bindParam(':veren', $kitap['veren'], PDO::PARAM_STR);
        if ($result->execute()) {
            $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-success">Kitap teslimi başarılı.</div></div>';
            $stmt = $this->connection->query("SELECT LAST_INSERT_ID() FROM kitapislemleri");
            $lastId = $stmt->fetch(PDO::FETCH_NUM);
            $lastId = $lastId[0];
            $_SESSION['islemid'] = $lastId;
        } else {
            $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-danger">Kitap teslimi başarısız.</div></div>';
        }
    }

    public function kitapal($id, $alinistar, $author)
    {
        $islem = $this->getkitapislemleri($id);
        $verilistar = $islem->verilistar;
        if ($alinistar > $verilistar) {
            $result = $this->connection->prepare("UPDATE kitapislemleri SET `alinistar`=:alinistar, 
                `alan`=:alan WHERE `id`=:id");
            $result->bindParam(':alinistar', $alinistar, PDO::PARAM_STR);
            $result->bindParam(':alan', $author, PDO::PARAM_STR);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            if ($result->execute()) {
                $_SESSION['message'] = '<div id="message"><div class="col-md-12 alert alert-success" style="padding:10px">Kitap alındı.</div></div>';
                $_SESSION['islemid'] = $id;
            } else {
                $_SESSION['message'] = '<div id="message"><div class="col-md-12 alert alert-danger" style="padding:10px">Başarısız.</div></div>';
            }
        } else {
            $_SESSION['message'] = '<div id="message"><div class="col-md-12 alert alert-danger" style="padding:10px">Kitabın alınış tarihi veriliş tarihinden önce olamaz.</div></div>';
        }
    }

    public function kitapislemact($id, $act)
    {
        $result = $this->connection->prepare("UPDATE kitapislemleri SET `act`=:act WHERE `id`=:id");
        $result->bindParam(':act', $act);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result->execute()) {
            $_SESSION['message'] = '<div id="message"><div class="col-md-12 alert alert-success" style="padding:10px">Silindi.</div></div>';
        } else {
            $_SESSION['message'] = '<div id="message"><div class="col-md-12 alert alert-danger" style="padding:10px">Başarısız.</div></div>';
        }
    }

    public function kitapislemsayisi()
    {
        $result = $this->connection->prepare("SELECT COUNT(*) FROM kitapislemleri WHERE act='1'");
        $result->execute();
        return $result->fetchColumn();
    }

    public function arakitapislemsayisi($ara)
    {
        $key = htmlspecialchars(trim($ara));
        $part = "%" . $key . "%";
        $result = $this->connection->prepare("SELECT COUNT(*) FROM kitapislemleri INNER JOIN kitaplar ON (kitapislemleri.kitapid = kitaplar.id)
		 WHERE ((`kitaplar`.yazar LIKE :part) OR (`kitaplar`.kitapadi LIKE :part) OR (`kitapislemleri`.kimde LIKE :part) OR (`kitapislemleri`.tc LIKE :part)) AND `kitaplar`.act = 1");
        $result->bindParam(':part', $part, PDO::PARAM_STR);
        $result->execute();
        return $result->fetchColumn();
    }

    public function disaridakikitap()
    {
        $result = $this->connection->prepare("SELECT COUNT(*) FROM kitapislemleri WHERE act='1' AND alinistar is NULL ");
        $result->execute();
        return $result->fetchColumn();
    }
    //KITAP ISLEMLERI
    //KITAP MENUSU
    public function kitapsayisi()
    {
        $result = $this->connection->prepare("SELECT COUNT(*) FROM kitaplar WHERE act='1'");
        $result->execute();
        return $result->fetchColumn();
    }

    public function kitapget($id)
    {
        $result = $this->connection->prepare("SELECT * FROM kitaplar WHERE `id`=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $obj = $result->fetch(PDO::FETCH_OBJ);
        return $obj;
    }

    public function kitaplar($sayfa, $kacadet)
    {
        if ($sayfa == '') {
            $burdan = 0;
        } else {
            $burdan = ($kacadet * $sayfa) - $kacadet;
        }

        $result = $this->connection->prepare("SELECT * FROM kitaplar ORDER BY id DESC LIMIT :burdan, :buraya");
        $result->bindParam(':burdan', $burdan, PDO::PARAM_INT);
        $result->bindParam(':buraya', $kacadet, PDO::PARAM_INT);
        $result->execute();
        return $result;
    }

    public function kitapSave($kitap)
    {
        $result = $this->connection->prepare("INSERT INTO kitaplar (`yazar`, `kitapadi`, `kategori`, `basimtar`, 
            `yayinevi`, `konum`, `aciklama`, `isbn`, `author`, `resim`, `act`) 
            VALUES (:yazar, :kitapadi, :kategori, :basimtar, :yayinevi, :konum, :aciklama, :isbn, :author, :resim, :act)");
        $result->bindParam(':yazar', $kitap['yazar'], PDO::PARAM_STR);
        $result->bindParam(':kitapadi', $kitap['kitapadi'], PDO::PARAM_STR);
        $result->bindParam(':kategori', $kitap['kategori'], PDO::PARAM_INT);
        $result->bindParam(':basimtar', $kitap['basimtar'], PDO::PARAM_STR);
        $result->bindParam(':yayinevi', $kitap['yayinevi'], PDO::PARAM_STR);
        $result->bindParam(':konum', $kitap['konum'], PDO::PARAM_STR);
        $result->bindParam(':aciklama', $kitap['aciklama'], PDO::PARAM_STR);
        $result->bindParam(':isbn', $kitap['isbn'], PDO::PARAM_STR);
        $result->bindParam(':author', $kitap['author'], PDO::PARAM_STR);
        $result->bindParam(':resim', $kitap['resim'], PDO::PARAM_STR);
        $result->bindParam(':act', $kitap['act'], PDO::PARAM_INT);
        if ($result->execute()) {
            $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-success">Kitap başarıyla eklendi.</div></div>';
            $stmt = $this->connection->query("SELECT LAST_INSERT_ID() FROM kitaplar");
            $lastId = $stmt->fetch(PDO::FETCH_NUM);
            $lastId = $lastId[0];
            $_SESSION['kitapid'] = $lastId;
        } else {
            $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-danger">Kitap ekleme başarısız.</div></div>';
        }
    }

    public function kitapUpdate($kitap)
    {
        $result = $this->connection->prepare("UPDATE kitaplar SET 
            `yazar`=:yazar, 
            `kitapadi`=:kitapadi, 
            `kategori`=:kategori, 
            `basimtar`=:basimtar, 
            `yayinevi`=:yayinevi, 
            `konum`=:konum, 
            `aciklama`=:aciklama, 
            `isbn`=:isbn, 
            `author`=:author, 
            `resim`=:resim, `act`=:act WHERE `id`=:id");
        $result->bindParam(':yazar', $kitap['yazar'], PDO::PARAM_STR);
        $result->bindParam(':kitapadi', $kitap['kitapadi'], PDO::PARAM_STR);
        $result->bindParam(':kategori', $kitap['kategori'], PDO::PARAM_INT);
        $result->bindParam(':basimtar', $kitap['basimtar'], PDO::PARAM_STR);
        $result->bindParam(':yayinevi', $kitap['yayinevi'], PDO::PARAM_STR);
        $result->bindParam(':konum', $kitap['konum'], PDO::PARAM_STR);
        $result->bindParam(':aciklama', $kitap['aciklama'], PDO::PARAM_STR);
        $result->bindParam(':isbn', $kitap['isbn'], PDO::PARAM_STR);
        $result->bindParam(':author', $kitap['author'], PDO::PARAM_STR);
        $result->bindParam(':resim', $kitap['resim'], PDO::PARAM_STR);
        $result->bindParam(':id', $kitap['id'], PDO::PARAM_INT);
        $result->bindParam(':act', $kitap['act'], PDO::PARAM_INT);

        if ($result->execute()) {
            $_SESSION['message'] = '<div id="message"><div class="col-md-12 alert alert-success">Kitap Düzenlendi.</div></div>';
        } else {
            $_SESSION['message'] = '<div id="message"><div class="col-md-12 alert alert-danger">Kitap düzenleme başarısız.</div></div>';
        }
    }

    public function kitapact($id, $act)
    {
        $result = $this->connection->prepare("UPDATE kitaplar SET `act`=:act WHERE `id`=:id");
        $result->bindParam(':act', $act);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result->execute()) {
            $_SESSION['message'] = '<div id="message"><div class="col-md-12 alert alert-success" style="padding:10px">Düzenlendi.</div></div>';
        } else {
            $_SESSION['message'] = '<div id="message"><div class="col-md-12 alert alert-danger" style="padding:10px">Başarısız.</div></div>';
        }
    }
//KITAP MENUSU
    //KATEGORILER
    public function kategoriEkle($kategori)
    {
        $result = $this->connection->prepare("INSERT INTO `kutuphane`.`kategori` (`kategori`, `act`) VALUES (:kategoriad, 1)");

        if ($result->execute($kategori)) {
            $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-success">Kategori eklendi.</div></div>';
        } else {
            $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-danger">Kategori eklenirken bir hata oluştu.</div></div>';
        }
    }

    public function kategoriUpdate($kategori)
    {
        $result = $this->connection->prepare("UPDATE `kutuphane`.`kategori` SET `kategori`= :kategoriad WHERE `id`= :id");

        if ($result->execute($kategori)) {
            $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-success">Kategori düzenlendi.</div></div>';
        } else {
            $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-danger">Kategori düzenlenirken bir hata oluştu.</div></div>';
        }
    }

    public function kategoriDurum($kategori)
    {
        $result = $this->connection->prepare("UPDATE `kutuphane`.`kategori` SET `act`= :act WHERE `id`= :id");

        if ($result->execute($kategori)) {
            $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-success">Kategorinin durumu değiştirildi.</div></div>';
        } else {
            $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-danger">Kategorinin durumu değiştirilirken bir hata oluştu.</div></div>';
        }
    }

    public function kategoriSil($kategori)
    {
        $result = $this->connection->prepare("DELETE FROM `kutuphane`.`kategori` WHERE `id`= :id");

        if ($result->execute($kategori)) {
            $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-success">Kategori silindi.</div></div>';
        } else {
            $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-danger">Kategori silinirken bir hata oluştu.</div></div>';
        }
    }

    public function categories()
    {
        $sth = $this->connection->prepare("SELECT * FROM kategori ORDER BY id ASC");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function kategoriad($id)
    {
        $result = $this->connection->prepare("SELECT kategori FROM kategori WHERE id=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $obj = $result->fetch(PDO::FETCH_ASSOC);
        $ad = $obj['kategori'];
        return $ad;
    }

    //KATEGORILER
    public function aybul($tarih)
    {
        switch ($tarih) {
            case 1:
            {
                $ay = 'Ocak';
                break;
            }
            case 2:
            {
                $ay = 'Şubat';
                break;
            }
            case 3:
            {
                $ay = 'Mart';
                break;
            }
            case 4:
            {
                $ay = 'Nisan';
                break;
            }
            case 5:
            {
                $ay = 'Mayıs';
                break;
            }
            case 6:
            {
                $ay = 'Haziran';
                break;
            }
            case 7:
            {
                $ay = 'Temmuz';
                break;
            }
            case 8:
            {
                $ay = 'Ağustos';
                break;
            }
            case 9:
            {
                $ay = 'Eylül';
                break;
            }
            case 10:
            {
                $ay = 'Ekim';
                break;
            }
            case 11:
            {
                $ay = 'Kasım';
                break;
            }
            case 12:
            {
                $ay = 'Aralık';
                break;
            }
        }
        return $ay;
    }


    public function tarihci($tarih)
    {
        $tarihArr = explode("-", $tarih);
        $donen['gun'] = $tarihArr[2];
        $donen['ay'] = $tarihArr[1];
        $donen['ayyazi'] = $this->aybul($tarihArr[1]);
        $donen['yil'] = $tarihArr[0];
        $donen['tarihyazili'] = $donen['gun'] . ' ' . $donen['ayyazi'] . ' ' . $donen['yil'];
        return $donen['tarihyazili'];
    }

    public function pagination($sayfa, $toplam, $kacadet)
    {
        $toplamsayfa = ceil($toplam / $kacadet);
        if ($sayfa == '') {
            $burdan = 0;
        } else {
            $burdan = ($kacadet * $sayfa) - $kacadet;
        }

        $geri = $sayfa - 1;
        $ileri = $sayfa + 1;
        $geri = '?sayfa=' . $geri;
        $ileri = '?sayfa=' . $ileri;
        $sayfa_goster = 20; // gösterilecek sayfa sayısı
        $en_az_orta = ceil($sayfa_goster / 2);
        $en_fazla_orta = ($toplamsayfa + 1) - $en_az_orta;
        $sayfa_orta = $sayfa;
        if ($sayfa_orta < $en_az_orta) $sayfa_orta = $en_az_orta;
        if ($sayfa_orta > $en_fazla_orta) $sayfa_orta = $en_fazla_orta;
        $sol_sayfalar = round($sayfa_orta - (($sayfa_goster - 1) / 2));
        $sag_sayfalar = round((($sayfa_goster - 1) / 2) + $sayfa_orta);
        if ($sol_sayfalar < 1) $sol_sayfalar = 1;
        if ($sag_sayfalar > $toplamsayfa) $sag_sayfalar = $toplamsayfa;

        if ($sayfa == 0 || $sayfa == 1) {
            $geri = "#";
        } elseif ($sayfa == $toplamsayfa || $toplamsayfa == 1 || $toplamsayfa == 0) {
            $ileri = "#";
        }
        echo '
            <center>
                <nav>
                    <ul class="pagination">
                        <li><a href="' . $geri . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
            ';
        for ($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
            if ($sayfa == $s) {
                echo '<li class="active"><a href="#">' . $s . '<span class="sr-only"></span></a></li>';
            } else {
                echo '<li><a href="?sayfa=' . $s . '">' . $s . '</a> </li>';
            }
        }
        echo '
                        <li><a href="' . $ileri . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                    </ul>
                </nav>
            </center>
        ';
    }

    function __destruct()
    {
        $this->connection = NULL;
    }
}

$run = new Database;
?>