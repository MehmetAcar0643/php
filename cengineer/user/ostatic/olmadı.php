<?php

try{
    $db=new PDO("mysql:host=localhost;dbname=blog;charset=utf8",'root','root');
   // "bağlantı başarılı";
}
catch (PDOException $e){
    echo $e->getMessage();
}

?>