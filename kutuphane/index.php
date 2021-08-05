<?php include "includes/header.php"; ?>
<?php 
$kategoriler = $run->kategoriler();
?>
    <form class="form-horizontal col-md-offset-2 col-md-8" method="GET" action="ara.php">
       	<div class="form-group" style="margin-top:100px">
            <input type="text" class="form-control input-lg" id="aranan" autofocus name="aranan" placeholder="Aramak istediğiniz kitap bilgisini giriniz... (Kitap adı, yayın evi, yazar adı, vb.)">
        </div>
        <div class="col-md-12" style="padding:0;margin-top:10px;">
        <a href="#" class="pull-left yesil arrow" id="detay"><i class="fa fa-chevron-down arrow-img "></i> Detaylı Arama </a>
        </div>
         <div class="col-md-12" style="padding:0;margin-top:10px;">
            <div class="jumbotron detay" style="margin-top:10px;display:none;">
                <div class="form-group">
                    <div class="col-md-3"><label for="kategori" class="control-label">Kategori:</label></div>
                    <div class="col-md-8">
                        <select class="form-control input-sm" name="kategori">
                            <option value="">Kategori seçiniz</option>

                            <?php while($row = $kategoriler->fetch()) { ?>
                            <option value="<?php echo $row["id"]; ?>"><?php echo $row["kategori"]; ?></option>
                            <?php } ?>

                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-default col-md-offset-5 col-md-3">Ara</button>
            </div>
        </div>
    </form>
</div>

<?php include "includes/footer.php"; ?>

                
           