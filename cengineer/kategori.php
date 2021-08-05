
<section>
    <header class=" p-3">
        <h4 style="font-style: italic; ">İlginizi Çekebilecek İçerikler</h4>
    </header>
    <nav class="list-group ">
        <?php
        $kategorisor = $db->prepare("SELECT * FROM kategori where kategori_durum=:durum order by kategori_sira ASC ");
        $kategorisor->execute(array(
            'durum' => 1
        ));
        while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <a href="kategori-<?=seo($kategoricek['kategori_ad'])?>" class="list-group-item"><?php echo $kategoricek['kategori_ad'] ?></a>
        <?php } ?>

    </nav>
</section>
<!--            <section class="reklam2">-->
<!--                <img width="100%" height="200" src="https://via.placeholder.com/350x150" alt="">-->
<!--            </section>-->
</div>