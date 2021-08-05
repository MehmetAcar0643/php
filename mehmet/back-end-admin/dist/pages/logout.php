
<?
session_start();
unset($_SESSION['kullanici_nickname']);

header("Location:index.php?durum=exit");
?>
