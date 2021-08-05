<?php


class İletisimController extends DBController
{
    function mesaj_gonder($ad,$konu,$mail,$mesaj)
    {
        $sth = $this->conn->prepare("INSERT INTO mesajlar
		(`ad`,`konu`,`mail`,`mesaj`)
		VALUES (upper(?),?,?,?)");
        $flag = $sth->execute([$ad,$konu,$mail,$mesaj]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

}