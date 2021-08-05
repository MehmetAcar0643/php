<?php


class İletisimController extends DBController
{
    function mesajlar_getir($baslangic,$bitis)
    {
        $sth = $this->conn->prepare("SELECT * FROM mesajlar ORDER BY id DESC LIMIT ".$baslangic.",".$bitis );
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }


    function mesajlar_sayisi_getir()
    {
        $sth = $this->conn->prepare("SELECT count(id) AS toplam FROM mesajlar");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function mesajlar_durum_getir()
    {
        $sth = $this->conn->prepare("SELECT durum FROM mesajlar ORDER BY id DESC ");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function mesajlar_secilen_getir($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM mesajlar WHERE id=? ");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

    function mesaj_sil($id)
    {
        $sth = $this->conn->prepare("DELETE FROM mesajlar WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }
    function mesaj_durum_guncelle($id)
    {
        $sth = $this->conn->prepare("UPDATE mesajlar SET durum=0 WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }


    function mail_ayar_getir()
    {
        $sth = $this->conn->prepare("SELECT mail_ayar.id AS smtp_id,
mail_ayar.smtp_host AS smtp_host,
mail_ayar.smtp_gonderen AS smtp_gonderen,
mail_ayar.smtp_mail AS smtp_mail,
mail_ayar.smtp_sifre AS smtp_sifre,
mail_ayar.smtp_secure_id AS smtp_secure_id,
smtp_secure.id AS stmp_secure_id,
smtp_secure.smtp_secure AS smtp_secure
FROM mail_ayar
INNER JOIN smtp_secure ON smtp_secure.id=mail_ayar.smtp_secure_id ");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function mail_smtp_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM smtp_secure ");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }
    function mesaj_ayar_guncelle($host,$gonderen,$mail,$sifre,$secure_id)
    {
        $sth = $this->conn->prepare("UPDATE mail_ayar SET smtp_host=?,smtp_gonderen=?,smtp_mail=?,smtp_sifre=?,smtp_secure_id=? WHERE id=22");
        $flag = $sth->execute([$host,$gonderen,$mail,$sifre,$secure_id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }




}