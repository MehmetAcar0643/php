<?php


class ProjelerimController extends DBController
{
    function projelerim_getir()
    {
        $sth = $this->conn->prepare("SELECT projeler.id AS id ,
projeler.baslik AS baslik,
projeler.aciklama AS aciklama,
projeler.alan_id AS alan_id,
calismalar.ad AS ad,
projeler.durum AS durum,
projeler.sira AS sira
FROM projeler
INNER JOIN calismalar ON calismalar.id=projeler.alan_id ORDER BY projeler.sira ASC; ");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function proje_bul($id)
    {
        $sth = $this->conn->prepare("SELECT *FROM projeler WHERE projeler.id=?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }


    function proje_guncelle($baslik, $aciklama, $alan_id, $durum, $seo_url, $id)
    {
        $sth = $this->conn->prepare("UPDATE projeler SET baslik=?,aciklama=?,alan_id=?,durum=?,seo_url=? WHERE id=?");
        $flag = $sth->execute([$baslik, $aciklama, $alan_id, $durum, $seo_url, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function proje_ekle($baslik, $aciklama, $alan_id, $durum, $sira, $seo_url)
    {
        $sth = $this->conn->prepare("INSERT INTO projeler
		(`baslik`,`aciklama`,`alan_id`,`durum`,`sira`,`seo_url`)
		VALUES (?,?,?,?,?,?)");
        $flag = $sth->execute([$baslik, $aciklama, $alan_id, $durum, $sira, $seo_url]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function proje_sil($id)
    {
        $sth = $this->conn->prepare("DELETE FROM projeler WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function proje_resim_ekle($resim, $proje_id, $sira)
    {
        $sth = $this->conn->prepare("INSERT INTO proje_resimler
		(`resim`,`proje_id`,`sira`)
		VALUES (?,?,?)");
        $flag = $sth->execute([$resim, $proje_id, $sira]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function proje_resim_getir($proje_id)
    {
        $sth = $this->conn->prepare("SELECT * FROM proje_resimler WHERE proje_id=? ORDER BY sira ASC");
        $sth->execute([$proje_id]);
        $result = $sth->fetchAll();
        return $result;
    }

    function proje_resim_sil($id)
    {
        $sth = $this->conn->prepare("DELETE FROM proje_resimler WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function proje_resim_klasörden_sil($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM proje_resimler WHERE id=?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

    function proje_sira_guncelle($sira, $id)
    {
        $sth = $this->conn->prepare("UPDATE projeler SET sira=? WHERE id =?");
        $flag = $sth->execute([$sira, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }


    function proje_sira_cek()
    {
        $sth = $this->conn->prepare("SELECT MAX(sira) AS sira FROM projeler");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function proje_resim_sira_cek()
    {
        $sth = $this->conn->prepare("SELECT MAX(sira) AS sira FROM proje_resimler");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function proje_resim_sira_guncelle($sira, $id)
    {
        $sth = $this->conn->prepare("UPDATE proje_resimler SET sira=? WHERE id =?");
        $flag = $sth->execute([$sira, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }


    function proje_baslik_getir($id)
    {
        $sth = $this->conn->prepare("SELECT baslik FROM projeler WHERE id=?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }


    function proje_resim_bul($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM proje_resimler WHERE id=?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

    function proje_resim_durum_guncelle($durum, $id)
    {
        $sth = $this->conn->prepare("UPDATE proje_resimler SET durum=? WHERE id =?");
        $flag = $sth->execute([$durum, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function proje_video_getir($proje_id)
    {
        $sth = $this->conn->prepare("SELECT * FROM proje_video WHERE proje_id=? ORDER BY sira ASC");
        $sth->execute([$proje_id]);
        $result = $sth->fetchAll();
        return $result;
    }

    function proje_video_sira_guncelle($sira, $id)
    {
        $sth = $this->conn->prepare("UPDATE proje_video SET sira=? WHERE id =?");
        $flag = $sth->execute([$sira, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function proje_video_bul($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM proje_video WHERE id=?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

    function proje_video_guncelle($video,$durum, $id)
    {
        $sth = $this->conn->prepare("UPDATE proje_video SET video=?,durum=? WHERE id =?");
        $flag = $sth->execute([$video,$durum, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function proje_video_sira_cek()
    {
        $sth = $this->conn->prepare("SELECT MAX(sira) AS sira FROM proje_video");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function proje_video_ekle($video, $proje_id, $sira)
    {
        $sth = $this->conn->prepare("INSERT INTO proje_video
		(`video`,`proje_id`,`sira`)
		VALUES (?,?,?)");
        $flag = $sth->execute([$video, $proje_id, $sira]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function proje_video_klasörden_sil($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM proje_video WHERE id=?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

    function proje_video_sil($id)
    {
        $sth = $this->conn->prepare("DELETE FROM proje_video WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }
}