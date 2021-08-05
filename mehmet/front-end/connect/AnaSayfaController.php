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

    function sosyal_medya_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM sosyal_medya");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }


}