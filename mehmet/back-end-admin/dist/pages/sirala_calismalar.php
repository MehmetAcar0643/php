<?php
require_once("../../connect/DBController.php");
require_once("../../connect/CalismalarimController.php");
$calismalarcont=new CalismalarimController();

$dizi=$_POST['id'];


if($_POST){
    $say=1;
    foreach ($dizi as $row) {
        $flag=$calismalarcont->calisma_sira_guncelle($say,$row);
        $say++;
    }
}

?>