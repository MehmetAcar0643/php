<?php


class HakkimdaController extends DBController
{
    function hakkimda_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM hakkimda");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function hakkimda_guncelle($baslik,$hakkimda,$web_site,$mail)
    {
        $sth = $this->conn->prepare("UPDATE hakkimda SET baslik=?,hakkimda=?,web_site=?,mail=? WHERE id =22");
        $flag = $sth->execute([$baslik,$hakkimda,$web_site,$mail]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function hakkimda_resim_guncelle($resim)
    {
        $sth = $this->conn->prepare("UPDATE hakkimda SET resim=? WHERE id =22");
        $flag = $sth->execute([$resim]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

}