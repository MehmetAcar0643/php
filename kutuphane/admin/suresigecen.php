<?php
include "includes/header.php";
include "includes/navbarleft.php";
if($_POST){
        $id=$_POST['id'];
        $alinistar=$_POST['alinistar'];
        $alinistar=date("Y-m-d", strtotime($alinistar));
        $author=$_SESSION['kutuphane']['username'];
        $run->kitapal($id,$alinistar,$author);
    }
if($_GET['sil'])
{
    $id=$_GET['sil'];
    $run->kitapislemact($id,0);
}

?>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">İade Tarihi Geçen Kitaplar</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row thumbnail">
            <?php $run->mesaj(); 
            if(isset($_SESSION['islemid'])){
                $url="kitapaltutanak.php?islemid=".$_SESSION['islemid']; ?>
                <div id="message"><button class="btn btn-sm btn-primary" onclick="window.open('<?php echo $url; ?>','popup2','width=500,height=600,top=0,left=20,scrollbars=yes');">Tutanak al</button></div><hr>
                <?php unset($_SESSION['islemid']);
            } ?>
                <table class="table table-responsive table-stripped table-bordered">
                    <tr><th>Resim</th><th>Kitap adı</th><th>ISBN</th><th>Kimde</th><th>TC</th><th>Ünvan</th><th>Tel</th><th>Verilen T.</th><th>Dönecek T.</th><th>Teslim T.</th></tr>
                    <?php $kitapislemleri = $run->suresigecen(); 
                        while($row = $kitapislemleri->fetch()) {?>
                        <form class="form-horizontal" enctype="multipart/form-data" name="kitapform" id="kitapform" action="" method="POST">
                            <tr>
                                <td>
                                    <?php 
                                    $kitapid=$row['kitapid'];
                                    $resim=$run->kitapget($kitapid)->resim;
                                    if($resim==""){?><img class="img-responsive" width="80" src="../kapak/kitap.jpg"><?php }
                                    else{ ?><img class="img-responsive" width="80" src="<?php echo $resim;?>"><?php }?>
                                </td>
                                <td><?php echo $run->kitapget($kitapid)->kitapadi; ?></td>
                                <td><?php echo $run->kitapget($kitapid)->isbn; ?></td>
                                <td><?php echo $row['kimde'];?></td>
                                <td><?php echo $row['tc'];?></td>
                                <td><?php echo $row['unvan'];?></td>
                                <td><?php echo $row['iletisim'];?></td>
                                <td><?php echo $run->tarihci($row['verilistar']);?></td>
                                 <td><?php echo $run->tarihci($row['gelecektar']);?></td>
                                 <td>
                                    <div class="tar">
                                        <input type="text" class="form-control" id="alinistar" name="alinistar" placeholder="Alınan tarihi giriniz.">
                                    </div>
                                </td>
                                <td>
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" class="btn btn-sm btn-primary" value="Kitabı al">
                               </td>
                            </tr>
                        </form>
                       <?php } ?>
                </table>
            </div>
        </div>
    </div>
<?php include "includes/footer.php"; ?>