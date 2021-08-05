<?php


class CalismalarimController extends DBController
{
    function calismalarim_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM calismalar ORDER BY calismalar.sira ASC");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function calisma_aciklama_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM calisma_aciklama ");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function calisma_aciklama_guncelle($aciklama)
    {
        $sth = $this->conn->prepare("UPDATE calisma_aciklama SET aciklama=? WHERE id =1");
        $flag = $sth->execute([$aciklama]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function calisma_bul($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM calismalar WHERE id=?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

    function calisma_guncelle($ad, $yuzde, $durum, $projeler_durum, $seo_url, $id)
    {
        $sth = $this->conn->prepare("UPDATE calismalar SET ad=upper (?),yuzde=?,durum=?,projeler_durum=? ,seo_url=? WHERE id =?");
        $flag = $sth->execute([$ad, $yuzde, $durum, $projeler_durum, $seo_url, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function calisma_sil($id)
    {
        $sth = $this->conn->prepare("DELETE FROM calismalar WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }



    function calisma_resim_klasörden_sil($id)
    {
        $sth = $this->conn->prepare("SELECT kapak_foto FROM calismalar WHERE id=?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

    function calisma_var_mı($ad)
    {
        $sth = $this->conn->prepare("SELECT * FROM calismalar WHERE ad=?");
        $sth->execute([$ad]);
        $result = $sth->fetch();
        return $result;
    }

    function calisma_ekle($ad, $yuzde, $durum, $projeler_durum, $seo_url, $sira)
    {
        $sth = $this->conn->prepare("INSERT INTO calismalar
		(`ad`,`yuzde`,`durum`,`projeler_durum`,`seo_url`,`sira`)
		VALUES (upper(?),?,?,?,?,?)");
        $flag = $sth->execute([$ad, $yuzde, $durum, $projeler_durum, $seo_url, $sira]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function kapak_foto_guncelle($kapak_foto, $id)
    {
        $sth = $this->conn->prepare("UPDATE calismalar SET kapak_foto=? WHERE id =?");
        $flag = $sth->execute([$kapak_foto, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function calisma_sira_cek()
    {
        $sth = $this->conn->prepare("SELECT MAX(sira) AS sira FROM calismalar");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function calisma_sira_guncelle($sira, $id)
    {
        $sth = $this->conn->prepare("UPDATE calismalar SET sira=? WHERE id =?");
        $flag = $sth->execute([$sira, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

}