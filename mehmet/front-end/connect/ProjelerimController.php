<?php


class ProjelerimController extends DBController
{
    function projelerim_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM calismalar WHERE projeler_durum='1' ORDER BY calismalar.sira ASC");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function konuya_ait_projeleri_getir($seo_url)
    {
        $sth = $this->conn->prepare("SELECT * FROM calismalar WHERE seo_url=?");
        $sth->execute([$seo_url]);
        $result = $sth->fetch();
        return $result;
    }

    function konuya_ait_proje_basliklarini_getir($alan_id)
    {
        $sth = $this->conn->prepare("SELECT * FROM projeler WHERE alan_id=? ORDER BY projeler.sira ASC ");
        $sth->execute([$alan_id]);
        $result = $sth->fetchAll();
        return $result;
    }

    function proje_icerik_getir($konu_baslik)
    {
        $sth = $this->conn->prepare("SELECT projeler.id AS id, 
calismalar.ad AS ad,
projeler.baslik AS baslik,
projeler.aciklama AS aciklama,
projeler.seo_url AS seo_url,
projeler.alan_id AS alan_id,
projeler.durum AS durum,
projeler.sira AS sira,
calismalar.id AS calisma_id,
proje_resimler.resim AS resim,
proje_resimler.proje_id AS proje_id,
proje_resimler.sira AS sira,
proje_resimler.durum AS proje_resimler_durum
FROM projeler
INNER JOIN calismalar ON calismalar.id=projeler.alan_id
INNER JOIN proje_resimler ON proje_resimler.proje_id=projeler.id 
WHERE projeler.seo_url=? AND proje_resimler.durum='1' ORDER BY proje_resimler.sira ASC");
        $sth->execute([$konu_baslik]);
        $result = $sth->fetchAll();
        return $result;
    }
    function proje_icerik_video_getir($konu_baslik)
    {
        $sth = $this->conn->prepare("SELECT projeler.id AS id,
projeler.seo_url AS seo_url,
proje_video.video AS video,
proje_video.proje_id AS _proje_id,
proje_video.sira AS sira,
proje_video.durum AS durum
FROM projeler
INNER JOIN proje_video ON proje_video.proje_id=projeler.id 
WHERE projeler.seo_url=? AND proje_video.durum='1' ORDER BY proje_video.sira ASC
");
        $sth->execute([$konu_baslik]);
        $result = $sth->fetchAll();
        return $result;
    }

    function proje_baslik_getir($konu_baslik)
    {
        $sth = $this->conn->prepare("SELECT calismalar.ad,projeler.baslik,projeler.aciklama,projeler.alan_id FROM projeler
INNER JOIN calismalar ON calismalar.id=projeler.alan_id WHERE projeler.seo_url=?");
        $sth->execute([$konu_baslik]);
        $result = $sth->fetch();
        return $result;
    }



}