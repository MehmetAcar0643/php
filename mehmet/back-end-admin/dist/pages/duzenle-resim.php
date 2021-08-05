<?php
require_once("../../connect/DBController.php");
require_once("../../connect/ProjelerimController.php");
$projelercont=new ProjelerimController();

if($_GET['proje-duzenle']){
    $id=$_GET['proje-duzenle'];
    echo $id;
}





?>