<?php include "user/ostatic/header.php";
include "enüst-saat.php";
?>
    <div class="container arkaplantasarım">
        <div style="margin: 15px 0;" class="row animated fadeInUpBig">
            <div class="col-md-9 orta_alan">
                <section class="p-3">
                    <div style="margin-left: -15px; width: 104%;">
                        <h4 class="p-2 mt-3">İLETİŞİM</h4>
                        <hr>
                        <p>Benimle İletişime geçmek , soru sormak için lütfen aşağıdaki formu doldurun ya da sosyal
                            medya
                            hesaplarını kullanın</p>
                        <p class="text-muted">* içeren alanların doldurulması zorunludur.</p>
                        <form class="iletisim" action="">
                            <div class="form-group ml-5">
                                <label for="">Ad Ve Soyadınız <span>*</span></label>
                                <input type="text" placeholder="Ad Ve Soyadınız" required="required"
                                       class=" col-md-7 col-xs-12">
                            </div>
                            <div class="form-group ml-5">
                                <label for="">Mail Adresinizi Giriniz <span>*</span></label>
                                <input type="email" placeholder="Mail Adresiniz" required="required"
                                       class=" col-md-7 col-xs-12">
                            </div>
                            <div class="form-group ml-5">
                                <label for="">Mesaj Konusu <span>*</span></label>
                                <input type="text" placeholder="Konu" maxlength="50" required="required"
                                       class=" col-md-7 col-xs-12">
                            </div>
                            <div class="form-group ml-5">
                                <label for="">Telefon Numarası <span>*</span></label>
                                <input type="tel" maxlength="50" placeholder="(----)--- -- --" required="required"
                                       class=" col-md-7 col-xs-12">
                            </div>
                            <div class="form-group ml-5">
                                <label for="">Yaşadığınız İl</label>
                                <input type="text" maxlength="50"
                                       class=" col-md-7 col-xs-12">
                            </div>
                            <div class="form-group ml-5">
                                <label for="">İletiecek Mesajı Yazınız <span>*</span></label>
                                <textarea type="text" required="required" rows="7" maxlength="1000"
                                          class=" col-md-7 col-xs-12"></textarea>
                            </div>
                            <div class="col-md-12">
                                <a href="">
                                    <button class="btn btn-dark">Gönder</button>
                                </a>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
            <?php include "medya-sabit.php";
            include "kategori.php"; ?>
        </div>
    </div>


<?php include "user/ostatic/footer.php" ?>