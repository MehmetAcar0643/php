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


}