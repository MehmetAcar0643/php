<?php

ob_start();
session_start();
if ($_SESSION['kullanici_nickname'] == null) {
    header("Location:dist/pages/login.php");
}
else{
    header("Location:dist/pages/index.php");
}

?>