<?php
ob_start();
session_start();
include "baglan.php";
include "../production/fonksiyon.php";

if (isset($_POST['dersekle'])) {
    $ders_seourl = seo($_POST['ders_ad']);


    $ayarkaydet = $db->prepare("INSERT INTO ders SET
kategori_id=:kategori_id,
ders_ad=:ad,
ders_detay=:detay,
ders_video=:video,
ders_keyword=:keyword,
ders_durum=:ders_durum,
ders_seourl=:ders_seourl,
ders_sira=:ders_sira");

    $insert = $ayarkaydet->execute(array(
        'kategori_id' => $_POST['kategori_id'],
        'ad' => $_POST['ders_ad'],
        'detay' => $_POST['ders_detay'],
        'video' => $_POST['ders_video'],
        'keyword' => $_POST['ders_keyword'],
        'ders_durum' => $_POST['ders_durum'],
        'ders_seourl' => $ders_seourl,
        'ders_sira' => $_POST['ders_sira']
    ));


    if ($insert) {

        Header("Location:../production/ders.php?durum=ok");

    } else {

        Header("Location:../production/ders.php?durum=no");
    }

}



if (isset($_POST['dersduzenle'])) {

    $ders_id = $_POST['ders_id'];
    $ders_seourl = seo($_POST['ders_ad']);


    $ayarkaydet = $db->prepare("UPDATE ders SET
kategori_id=:kategori_id,
ders_ad=:ad,
ders_detay=:detay,
ders_video=:video,
ders_keyword=:keyword,
ders_durum=:ders_durum,
ders_seourl=:ders_seourl,
ders_sira=:ders_sira
WHERE ders_id={$_POST['ders_id']}");

    $update = $ayarkaydet->execute(array(
        'kategori_id' => $_POST['kategori_id'],
        'ad' => $_POST['ders_ad'],
        'detay' => $_POST['ders_detay'],
        'video' => $_POST['ders_video'],
        'keyword' => $_POST['ders_keyword'],
        'ders_durum' => $_POST['ders_durum'],
        'ders_seourl' => $ders_seourl,
        'ders_sira' => $_POST['ders_sira']
    ));


    if ($update) {

        Header("Location:../production/ders-duzenle.php?durum=ok&ders_id=$ders_id");

    } else {

        Header("Location:../production/ders-duzenle.php?durum=no&ders_id=$ders_id");
    }

}



if ($_GET['derssil'] == "ok") {
    $sil = $db->prepare("DELETE FROM ders where ders_id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['ders_id']
    ));

    if ($kontrol) {
        header("Location:../production/ders.php?sil=ok");
    } else {
        header("Location:../production/ders.php?sil=no");
    }
}



if (isset($_POST['kategoriekle'])) {

    $kategori_seourl = seo($_POST['kategori_ad']);


    $ayarkaydet = $db->prepare("INSERT INTO kategori SET
kategori_ad=:kategori_ad,
kategori_sira=:kategori_sira,
kategori_seourl=:kategori_seourl,
kategori_durum=:kategori_durum");

    $insert = $ayarkaydet->execute(array(
        'kategori_ad' => $_POST['kategori_ad'],
        'kategori_sira' => $_POST['kategori_sira'],
        'kategori_seourl' => $kategori_seourl,
        'kategori_durum' => $_POST['kategori_durum']
    ));


    if ($insert) {

        Header("Location:../production/kategori.php?durum=ok");

    } else {

        Header("Location:../production/kategori.php?durum=no");
    }

}


if ($_GET['kategorisil'] == "ok") {
    $sil = $db->prepare("DELETE FROM kategori where kategori_id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['kategori_id']
    ));

    if ($kontrol) {
        header("Location:../production/kategori.php?sil=ok");
    } else {
        header("Location:../production/kategori.php?sil=no");
    }
}


if (isset($_POST['kategoriduzenle'])) {

    $kategori_id = $_POST['kategori_id'];

    $kategori_seourl = seo($_POST['kategori_ad']);


    $ayarkaydet = $db->prepare("UPDATE kategori SET
kategori_ad=:kategori_ad,
kategori_sira=:kategori_sira,
kategori_seourl=:kategori_seourl,
kategori_durum=:kategori_durum
WHERE kategori_id={$_POST['kategori_id']}");

    $update = $ayarkaydet->execute(array(
        'kategori_ad' => $_POST['kategori_ad'],
        'kategori_sira' => $_POST['kategori_sira'],
        'kategori_seourl' => $kategori_seourl,
        'kategori_durum' => $_POST['kategori_durum']
    ));


    if ($update) {

        Header("Location:../production/kategori-duzenle.php?kategori_id=$kategori_id&durum=ok");

    } else {

        Header("Location:../production/kategori-duzenle.php?kategori_id=$kategori_id&durum=no");
    }

}


if (isset($_POST['adminsifreguncelle'])) {

    $kullanici_eskipassword = trim($_POST['kullanici_eskipassword']);
    $kullanici_passwordone = trim($_POST['kullanici_passwordone']);
    $kullanici_passwordtwo = trim($_POST['kullanici_passwordtwo']);

    $kullanici_password = md5($kullanici_eskipassword);


    $kullanicisor = $db->prepare("select * from kullanici where kullanici_password=:password");
    $kullanicisor->execute(array(
        'password' => $kullanici_password
    ));

    //dönen satır sayısını belirtir
    $say = $kullanicisor->rowCount();


    if ($say == 0) {

        header("Location:../production/admin-hesap?durum=eskisifrehata");

    } else {
        //eski şifre doğruysa başla
        if ($kullanici_passwordone == $kullanici_passwordtwo) {

            if ($kullanici_eskipassword != $kullanici_passwordtwo) {
                if (strlen($kullanici_passwordone) >= 6) {

                    //md5 fonksiyonu şifreyi md5 şifreli hale getirir.
                    $password = md5($kullanici_passwordone);

                    $kullanici_yetki = 1;

                    $kullanicikaydet = $db->prepare("UPDATE kullanici SET
					kullanici_password=:kullanici_password
					WHERE kullanici_id={$_POST['kullanici_id']}");


                    $insert = $kullanicikaydet->execute(array(
                        'kullanici_password' => $password
                    ));
                    if ($insert) {
                        header("Location:../production/sifre-degisti");
                        //Header("Location:../production/genel-ayarlar.php?durum=ok");
                    } else {
                        header("Location:../production/admin-hesap?durum=no");
                    }

                    // Bitiş
                } else {
                    header("Location:../production/admin-hesap?durum=eksiksifre");
                }
            } else {
                header("Location:../production/admin-hesap?durum=eskisifreayni");
            }

        } else {

            header("Location:../production/admin-hesap?durum=sifreleruyusmuyor");

            exit;
        }
    }

    exit;

    if ($update) {

        header("Location:../production/admin-hesap?durum=ok");

    } else {

        header("Location:../production/admin-hesap?durum=no");
    }

}


if (isset($_POST['adminbilgiguncelle'])) {

    $kullanici_id = $_POST['kullanici_id'];

    $ayarkaydet = $db->prepare("UPDATE kullanici SET
		kullanici_adsoyad=:kullanici_adsoyad,
		kullanici_gsm=:kullanici_gsm,
		kullanici_il=:kullanici_il,
		kullanici_ilce=:kullanici_ilce,
		kullanici_adres=:kullanici_adres
		WHERE kullanici_id={$_POST['kullanici_id']}");

    $update = $ayarkaydet->execute(array(
        'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
        'kullanici_gsm' => $_POST['kullanici_gsm'],
        'kullanici_il' => $_POST['kullanici_il'],
        'kullanici_ilce' => $_POST['kullanici_ilce'],
        'kullanici_adres' => $_POST['kullanici_adres']
    ));


    if ($update) {

        Header("Location:../production/admin-hesap.php?durum=ok");

    } else {

        Header("Location:../production/admin-hesap.php?durum=no");
    }

}


if (isset($_POST['adminkayit'])) {

    $kullanici_adsoyad = htmlspecialchars($_POST['kullanici_adsoyad']);
    $kullanici_mail = htmlspecialchars($_POST['kullanici_mail']);
    $kullanici_passwordone = htmlspecialchars($_POST['kullanici_passwordone']);
    $kullanici_passwordtwo = htmlspecialchars($_POST['kullanici_passwordtwo']);
    $kullanici_gsm = htmlspecialchars($_POST['kullanici_gsm']);
    $kullanici_il = htmlspecialchars($_POST['kullanici_il']);
    $kullanici_ilce = htmlspecialchars($_POST['kullanici_ilce']);
    $kullanici_adres = htmlspecialchars($_POST['kullanici_adres']);


    if ($kullanici_passwordone == $kullanici_passwordtwo) {
        if (strlen($kullanici_passwordone) >= 6) {

//           Başlangıç

            $kullanicisor = $db->prepare("select * from kullanici where kullanici_mail=:mail");
            $kullanicisor->execute(array(
                'mail' => $kullanici_mail
            ));

            //dönen satır sayısını belirtir
            $say = $kullanicisor->rowCount();


            if ($say == 0) {

                //md5 fonksiyonu şifreyi md5 şifreli hale getirir.
                $password = md5($kullanici_passwordone);

                $kullanici_yetki = 1;

                //Kullanıcı kayıt işlemi yapılıyor...
                $kullanicikaydet = $db->prepare("INSERT INTO kullanici SET
					kullanici_adsoyad=:kullanici_adsoyad,
					kullanici_mail=:kullanici_mail,
					kullanici_password=:kullanici_password,
					kullanici_gsm=:kullanici_gsm,
					kullanici_il=:kullanici_il,
					kullanici_ilce=:kullanici_ilce,
					kullanici_adres=:kullanici_adres,
					kullanici_durum=:kullanici_durum,
					kullanici_yetki=:kullanici_yetki
					");
                $insert = $kullanicikaydet->execute(array(
                    'kullanici_adsoyad' => $kullanici_adsoyad,
                    'kullanici_mail' => $kullanici_mail,
                    'kullanici_password' => $password,
                    'kullanici_gsm' => $kullanici_gsm,
                    'kullanici_il' => $kullanici_il,
                    'kullanici_ilce' => $kullanici_ilce,
                    'kullanici_adres' => $kullanici_adres,
                    'kullanici_durum' => 8,
                    'kullanici_yetki' => $kullanici_yetki
                ));

                if ($insert) {
                    header("Location:../production/kayit-alindi.php?durum=kayitbasarili");
                    //Header("Location:../production/genel-ayarlar.php?durum=ok");
                } else {
                    header("Location:../production/admin-kayit.php?durum=basarisiz");
                }

            } else {
                header("Location:../production/admin-kayit.php?durum=mukerrerkayit");
            }
//           Bitiş


        } else {
            header("Location:../production/admin-kayit.php?durum=eksiksifre");
        }

    } else {
        header("Location:../production/admin-kayit.php?durum=farklisifre");
    }

}


if (isset($_POST['logoduzenle'])) {


    $uploads_dir = '../../aaimgimages';

    @$tmp_name = $_FILES['ayar_logo']["tmp_name"];
    @$name = $_FILES['ayar_logo']["name"];

    $benzersizsayi4 = rand(20000, 32000);
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizsayi4 . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");


    $duzenle = $db->prepare("UPDATE ayar SET
		ayar_logo=:logo
		WHERE ayar_id=0");
    $update = $duzenle->execute(array(
        'logo' => $refimgyol
    ));


    if ($update) {

        $resimsilunlink = $_POST['eski_yol'];
        unlink("../../$resimsilunlink");

        Header("Location:../production/genel-ayar.php?durum=ok");

    } else {

        Header("Location:../production/genel-ayar.php?durum=no");
    }

}


if (isset($_POST['menuekle'])) {

    $menu_seourl = seo($_POST['menu_ad']);

    $ayarekle = $db->prepare("INSERT INTO menu SET
		menu_ad=:menu_ad,
		menu_detay=:menu_detay,
		menu_url=:menu_url,
		menu_sira=:menu_sira,
		menu_seourl=:menu_seourl,
		menu_durum=:menu_durum
		");

    $insert = $ayarekle->execute(array(
        'menu_ad' => $_POST['menu_ad'],
        'menu_detay' => $_POST['menu_detay'],
        'menu_url' => $_POST['menu_url'],
        'menu_sira' => $_POST['menu_sira'],
        'menu_seourl' => $menu_seourl,
        'menu_durum' => $_POST['menu_durum']
    ));


    if ($insert) {

        Header("Location:../production/menu.php?durum=ok");

    } else {

        Header("Location:../production/menu.php?durum=no");
    }
}


if ($_GET['menusil'] == "ok") {
    $sil = $db->prepare("DELETE FROM menu where menu_id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['menu_id']
    ));

    if ($kontrol) {
        header("Location:../production/menu.php?sil=ok");
    } else {
        header("Location:../production/menu.php?sil=no");
    }
}


if (isset($_POST['menuduzenle'])) {

    $menu_id = $_POST['menu_id'];

    $menu_seourl = seo($_POST['menu_ad']);


    $ayarkaydet = $db->prepare("UPDATE menu SET
		menu_ad=:menu_ad,
		menu_detay=:menu_detay,
		menu_url=:menu_url,
		menu_sira=:menu_sira,
		menu_seourl=:menu_seourl,
		menu_durum=:menu_durum
		WHERE menu_id={$_POST['menu_id']}");

    $update = $ayarkaydet->execute(array(
        'menu_ad' => $_POST['menu_ad'],
        'menu_detay' => $_POST['menu_detay'],
        'menu_url' => $_POST['menu_url'],
        'menu_sira' => $_POST['menu_sira'],
        'menu_seourl' => $menu_seourl,
        'menu_durum' => $_POST['menu_durum']
    ));


    if ($update) {

        Header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=ok");

    } else {

        Header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=no");
    }

}


if ($_GET['kullanicisil'] == "ok") {
    $sil = $db->prepare("DELETE FROM kullanici where kullanici_id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['kullanici_id']
    ));

    if ($kontrol) {
        header("Location:../production/kullanici.php?sil=ok");
    } else {
        header("Location:../production/kullanici.php?sil=no");
    }
}


if (isset($_POST['kullaniciayarkaydet'])) {
    $kullanici_id = $_POST['kullanici_id'];

    $ayarkaydet = $db->prepare("UPDATE kullanici SET
    kullanici_adsoyad=:kullanici_adsoyad,
    kullanici_gsm=:kullanici_gsm,
    kullanici_adres=:kullanici_adres,
    kullanici_il=:kullanici_il,
    kullanici_ilce=:kullanici_ilce,
    kullanici_yetki=:kullanici_yetki,
    kullanici_durum=:kullanici_durum
    WHERE kullanici_id={$_POST['kullanici_id']}");

    $update = $ayarkaydet->execute(array(
        'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
        'kullanici_gsm' => $_POST['kullanici_gsm'],
        'kullanici_adres' => $_POST['kullanici_adres'],
        'kullanici_il' => $_POST['kullanici_il'],
        'kullanici_ilce' => $_POST['kullanici_ilce'],
        'kullanici_yetki' => $_POST['kullanici_yetki'],
        'kullanici_durum' => $_POST['kullanici_durum']
    ));
    if ($update) {
        header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=ok");
    } else {
        header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no");
    }
}


if (isset($_POST['admingiris'])) {

    $kullanici_mail = htmlspecialchars($_POST['kullanici_mail']);
    $kullanici_password = md5($_POST['kullanici_password']);


    $kullanicisor = $db->prepare("SELECT * FROM kullanici WHERE  kullanici_mail=:mail and kullanici_password=:password 
    and kullanici_yetki=:yetki  and kullanici_durum=:durum");
    $kullanicisor->execute(array(
        'mail' => $kullanici_mail,
        'password' => $kullanici_password,
        'yetki' => 5,
        'durum' => 1
    ));
    $say = $kullanicisor->rowCount();

    if ($say == 1) {
        $_SESSION['kullanici_mail'] = $kullanici_mail;
        header("Location:../production/index.php");
    } else {
        header("Location:../production/login.php?durum=no");
        exit;
    }


}


if (isset($_POST['hakkimdaayarkaydet'])) {
    $ayarkaydet = $db->prepare("UPDATE hakkimda SET
    hakkimda_baslik=:hakkimda_baslik,
    hakkimda_icerik=:hakkimda_icerik,
    hakkimda_video=:hakkimda_video,
    hakkimda_vizyonbaslik=:hakkimda_vizyonbaslik,
    hakkimda_misyonbaslik=:hakkimda_misyonbaslik,
    hakkimda_vizyonicerik=:hakkimda_vizyonicerik,
    hakkimda_misyonicerik=:hakkimda_misyonicerik
    WHERE hakkimda_id=0");

    $update = $ayarkaydet->execute(array(
        'hakkimda_baslik' => $_POST['hakkimda_baslik'],
        'hakkimda_icerik' => $_POST['hakkimda_icerik'],
        'hakkimda_video' => $_POST['hakkimda_video'],
        'hakkimda_vizyonbaslik' => $_POST['hakkimda_vizyonbaslik'],
        'hakkimda_misyonbaslik' => $_POST['hakkimda_misyonbaslik'],
        'hakkimda_vizyonicerik' => $_POST['hakkimda_vizyonicerik'],
        'hakkimda_misyonicerik' => $_POST['hakkimda_misyonicerik']
    ));
    if ($update) {
        header("Location:../production/hakkimda.php?durum=ok");
    } else {
        header("Location:../production/hakkimda.php?durum=no");
    }
}


if (isset($_POST['genelayarkaydet'])) {
    $ayarkaydet = $db->prepare("UPDATE ayar SET
    ayar_title=:ayar_title,
    ayar_description=:ayar_description,
    ayar_keyword=:ayar_keyword,
    ayar_author=:ayar_author,
    ayar_sitelogoisim=:ayar_sitelogoisim
    WHERE ayar_id=0");

    $update = $ayarkaydet->execute(array(
        'ayar_title' => $_POST['ayar_title'],
        'ayar_description' => $_POST['ayar_description'],
        'ayar_keyword' => $_POST['ayar_keyword'],
        'ayar_author' => $_POST['ayar_author'],
        'ayar_sitelogoisim' => $_POST['ayar_sitelogoisim']
    ));
    if ($update) {
        header("Location:../production/genel-ayar.php?durum=ok");
    } else {
        header("Location:../production/genel-ayar.php?durum=no");
    }
}


if (isset($_POST['sosyalmedyaayarkaydet'])) {
    $ayarkaydet = $db->prepare("UPDATE ayar SET
    ayar_facebook=:ayar_facebook,
    ayar_twitter=:ayar_twitter,
    ayar_instagram=:ayar_instagram,
    ayar_mail=:ayar_mail
    WHERE ayar_id=0");

    $update = $ayarkaydet->execute(array(
        'ayar_facebook' => $_POST['ayar_facebook'],
        'ayar_twitter' => $_POST['ayar_twitter'],
        'ayar_instagram' => $_POST['ayar_instagram'],
        'ayar_mail' => $_POST['ayar_mail']
    ));
    if ($update) {
        header("Location:../production/sosyalmedya-ayar.php?durum=ok");
    } else {
        header("Location:../production/sosyalmedya-ayar.php?durum=no");
    }
}

?>