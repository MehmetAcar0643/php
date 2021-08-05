<?php include "includes/functions.php"; ?>
<!DOCTYPE html>
<html dir="ltr" lang="tr-TR">
<head>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta property="og:locale" content="tr_TR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Dumlupınar Üniversitesi Kütüphane" />
    <meta name="robots" content="noodp"/>
    <meta name="generator" content="Mehmet Acar" />
    <title>Kütüphane | Dumlupınar Üniversitesi</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/datepicker.css">
    <link rel="stylesheet" type="text/css" href="css/lightbox.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script   src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
    <style type="text/css">
    .rotate {
        transform: rotate(180deg);
        /*transform: rotate(180deg);*/
        transition: .3s cubic-bezier(.17,.67,.21,1.69);
    }
    .rotate3{
        transform: rotate(180deg);
        /*transform: rotate(180deg);*/
        transition: .3s cubic-bezier(.17,.67,.21,1.69);
    }
    </style>
    <script type="text/javascript">
    $(document).ready(function(){
        $(".kapakFoto").show();
        $(".kapak").click(function() {
            if($(this).is(":checked")) {
                $(".kapakFoto").fadeIn();
            } else {
                $(".kapakFoto").fadeOut();
            }
        });
    });
    </script>
</head>
<body>
<div id="wrapper">
    <div class="container-fluid">
        <header>
            <div class="row ustserit"></div>
            <div class="row logolar">
                <div class="container">
                    <a href="index.php"><img style="border-radius: 50%" src="images/dpu.png" width="120" class="img-responsive logo "></a>
                </div>
            </div>
        </header>
    </div>
    <div class="container">
        <hr>
        <h2 style="margin-top:70px;"><center> Dumlupınar Üniversitesi Kütüphanesi</center></h2>