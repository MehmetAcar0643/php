<?php


class AnaSayfaController extends DBController
{
    function anasayfa_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM anasayfa");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function anasayfa_logo_getir()
    {
        $sth = $this->conn->prepare("SELECT site_logo FROM anasayfa");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function site_logo_guncelle($site_logo)
    {
        $sth = $this->conn->prepare("UPDATE anasayfa SET site_logo=? WHERE id =22");
        $flag = $sth->execute([$site_logo]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function site_resim_guncelle($site_resim)
    {
        $sth = $this->conn->prepare("UPDATE anasayfa SET site_resim=? WHERE id =22");
        $flag = $sth->execute([$site_resim]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }
    function panel_bilgi_guncelle($isim,$site_adi,$footer_yazi){
        $sth = $this->conn->prepare("UPDATE anasayfa SET isim = ?,site_adi=?,footer_yazi=? WHERE id =22");
        $flag = $sth->execute([$isim,$site_adi,$footer_yazi]);
        if($flag){
            return true;
        }
        else{
            return false;
        }
    }

    function sosyal_medya_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM sosyal_medya");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function sosyal_medya_guncelle($twitter,$facebook,$instagram,$linkedin){
        $sth = $this->conn->prepare("UPDATE sosyal_medya SET twitter=?,facebook=?,instagram=?,linkedin=? WHERE id =11");
        $flag = $sth->execute([$twitter,$facebook,$instagram,$linkedin]);
        if($flag){
            return true;
        }
        else{
            return false;
        }
    }
}