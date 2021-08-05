<?php
include "includes/header.php";
include "includes/navbarleft.php";

if($_POST){
    $sifre=$_POST['sifre'];
    $sifre=sha1(md5($sifre));
    $ysifre=sha1(md5($_POST['yenisifre']));
    $ysifre2=sha1(md5($_POST['yenisifre2']));
    $user=$run->user(); 
        if($sifre==$user->password){
            $change=$run->changepass($ysifre,$user->username);
        }
        else{
            $_SESSION['message']='<div class="row" id="message"><div class="col-md-12 alert alert-danger">Şifre yanlış girildi.</div></div>';
        }
    }
    ?>    
     <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
            <div class="col-lg-12">
                    <h1 class="page-header">Şifre Güncelleme</h1>
                </div>
                <?php if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                } ?>
                <div class="row">
                    <div class="col-md-12" style="padding-top:20px;">
                        <form class="form-horizontal" name="user" id="user" enctype="multipart/form-data" action="" method="POST">
                            <?php 
                            $user=$run->user(); 
                             ?>
                            <div class="form-group">
                                <label for="ad" class="col-md-2 control-label">Ad-Soyad</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="ad" value="<?php echo $user->adsoyad ;?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ad" class="col-md-2 control-label">Kullanıcı Adı</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="kad" value="<?php echo $user->username ;?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ad" class="col-md-2 control-label">Eski Şifre</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="sifre" placeholder="Kullandığınız şifreyi giriniz" maxlength="8">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ad" class="col-md-2 control-label">Yeni Şifre</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="yenisifre" placeholder="Yeni şifre giriniz" maxlength="8">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ad" class="col-md-2 control-label">Yeni Şifre (tekrar)</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="yenisifre2" placeholder="Yeni şifre tekrar giriniz" maxlength="8">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-2">
                                <input type="submit" value="Güncelle" class="btn btn-success btn-block">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include "includes/footer.php"; ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#user').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            sifre: {
                validators: {
                    notEmpty: {
                        message: 'Şifre Giriniz...'
                    }
                }
            },
            yenisifre: {
                validators: {
                    notEmpty: {
                        message: 'Yeni Şifre Giriniz...'
                    },
                    stringLength: {
                        max:8,
                        min:4,
                        message: 'minimum uzunluk:4, max:8',
                    }
                }
            },
            yenisifre2: {
                validators: {
                    notEmpty: {
                        message: 'Yeni Şifre Tekrar Giriniz...'
                    },
                    identical: {
                    field: 'yenisifre',
                    message: 'Şifreler aynı olmalı'
                    }   
                }
            }
        }
    });
});
</script>
