<?php
require_once("../../connect/DBController.php");
require_once("../../connect/ProjelerimController.php");
$projelercont = new ProjelerimController();
$proje_video_sira = $projelercont->proje_video_sira_cek();
$proje_baslik = $projelercont->proje_baslik_getir($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sira = $_POST['sira'];
    $sira++;
    $id = $_POST['proje_id'];

    if (empty(trim($_POST["video"]))) {
        header("Location:proje-videolar.php?id=$id&&durum=hata");
    } else {
        $id = $_POST['proje_id'];
        $refimgyol = $_POST['video'];
        $flag = $projelercont->proje_video_ekle($refimgyol, $id, $sira);
        header("Location:proje-videolar.php?id=$id&&durum=ok");
    }
}

