<?php
require_once 'admin/includes/config.php';

Class Kutuphane extends dbConfig 
{
	protected $connection;

	function __construct() 
	{
		parent::createConfig();
		try
        {
			$dsn = 'mysql:host=' . $this->dbConfig['host'] . ';dbname=' . $this->dbConfig['dbname'];
			$this->connection = new PDO($dsn, $this->dbConfig['username'], $this->dbConfig['password'], $driver_options=array());
            $this->connection->query("SET NAMES utf8");
            $this->connection->query("SET CHARACTER SET utf8");
            $this->connection->query("SET COLLATION_CONNECTION = 'utf8_general_ci");
			return true;
		}
        catch(PDOException $error)
        {
			$errorMesage = 'Hata : Veritabanı bağlantısı kurulamadı !<br>Hata Mesajı =>'.$error->getMessage();
			echo $errorMesage;
		}
    }

    public function arama($key,$kategori)
    {
        $kategori2 ="";
        if($kategori != "")
        {
            $kategori2 = 'AND `kitaplar`.kategori = :kategori ';
        }

		$key =htmlspecialchars(trim($key));
		$key = "%".$key."%";
        $araYazar     = "yazar LIKE :key";
        $araKitapAdi  = "kitapadi LIKE :key";
        $araYayinEvi  = "yayinevi LIKE :key";
        $araAciklama  = "aciklama LIKE :key";

        $result2 = $this->connection->prepare("SELECT * FROM kitaplar 
WHERE (($araYazar) OR ($araKitapAdi) OR ($araYayinEvi) OR ($araAciklama)) 
  AND act = 1 $kategori2 ORDER BY id DESC");
        $result2->bindParam(':key', $key, PDO::PARAM_STR);
        $result2->bindParam(':kategori', $kategori, PDO::PARAM_INT);
        $result2->execute();
        $kitapnum = $result2->rowCount();
        $kitap = $result2->fetchAll();
        return array($kitapnum,$kitap);
    }

    public function kategoriler()
    {
        $result = $this->connection->prepare("SELECT * FROM kategori ORDER BY id ASC");
        $result->execute();
        return $result;
    }

    public function pagination($sayfa,$toplam,$kacadet,$arama,$kategori)
    {
        $toplamsayfa = ceil($toplam / $kacadet);
        if($sayfa == ''){
            $burdan = 0;
        } else {
            $burdan = ($kacadet * $sayfa) - $kacadet;
        }

        $geri           = $sayfa - 1;
        $ileri          = $sayfa + 1;
        $geri           = 'http://' . $_SERVER['HTTP_HOST'] . '/kutuphane/ara.php?aranan='.$arama.'&kategori='.$kategori.'&sayfa='.$geri;
        $ileri          = 'http://' . $_SERVER['HTTP_HOST'] . '/kutuphane/ara.php?aranan='.$arama.'&kategori='.$kategori.'&sayfa='.$ileri;
        $sayfa_goster   = 20; // gösterilecek sayfa sayısı
        $en_az_orta     = ceil($sayfa_goster / 2);
        $en_fazla_orta  = ($toplamsayfa + 1) - $en_az_orta;
        $sayfa_orta     = $sayfa;
        if($sayfa_orta < $en_az_orta) $sayfa_orta = $en_az_orta;
        if($sayfa_orta > $en_fazla_orta) $sayfa_orta = $en_fazla_orta;             
        $sol_sayfalar   = round($sayfa_orta - (($sayfa_goster - 1) / 2));
        $sag_sayfalar   = round((($sayfa_goster - 1) / 2) + $sayfa_orta);  
        if($sol_sayfalar < 1) $sol_sayfalar = 1;
        if($sag_sayfalar > $toplamsayfa) $sag_sayfalar = $toplamsayfa;

        if($sayfa == 0 || $sayfa == 1)
        {
            $geri = "#";
        }
        elseif($sayfa == $toplamsayfa || $toplamsayfa == 1 || $toplamsayfa ==0)
        {
            $ileri = "#";
        }
        echo '
            <center>
                <nav>
                    <ul class="pagination">
                        <li><a href="'.$geri.'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
            ';
                        for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) 
                        {
                           if($sayfa == $s) 
                           { 
                              echo '<li class="active"><a href="#">'.$s.'<span class="sr-only"></span></a></li>'; 
                           } 
                           else 
                           {
                              echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].'/kutuphane/ara.php?aranan='.$arama.'&kategori='.$kategori.'&sayfa='.$s.'">'.$s.'</a> </li>';
                           }
                        }
        echo '
                        <li><a href="'.$ileri.'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                    </ul>
                </nav>
            </center>
        ';
    }

    public function kitapDurum($kitapid)
    {
        $result = $this->connection->prepare("SELECT * FROM kitapislemleri WHERE kitapid = :kitapid AND act= 1 AND alinistar is null ORDER BY id DESC");
        $result->bindParam(':kitapid', $kitapid, PDO::PARAM_INT);
        $result->execute();
        $durum = $result->rowCount();
		
		$result2 = $this->connection->prepare("SELECT * FROM kitaplar WHERE id = :kitapid AND act= 1");
        $result2->bindParam(':kitapid', $kitapid, PDO::PARAM_INT);
        $result2->execute();
        $durum2 = $result2->rowCount();
        
        if($durum != 0)
        {
            echo "Emanette";
        }
        else
        {
			echo "Kütüphanede";
         }
        
    }

    function __destruct()
    {
        $this->connection=NULL;
    } 
}

$run= new Kutuphane;
?>