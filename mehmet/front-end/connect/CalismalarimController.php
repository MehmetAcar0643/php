<?php


class CalismalarimController extends DBController
{
    function calismalarim_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM calismalar WHERE durum='1' ORDER BY calismalar.sira ASC");
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

}