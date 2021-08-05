<?php
require_once("../../connect/DBController.php");
require_once("../../connect/ProjelerimController.php");
$projelercont=new ProjelerimController();

$dizi=$_POST['id'];


if($_POST){
    $say=1;
    foreach ($dizi as $row) {
        $flag=$projelercont->proje_video_sira_guncelle($say,$row);
        $say++;
    }
}

?>