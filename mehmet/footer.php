
<?php
require_once("front-end/connect/AnaSayfaController.php");
$anaSayfacont=new AnaSayfaController();
$anasayfa=$anaSayfacont->anasayfa_getir();
?>

<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="container">
        <div class="copyright">
           <?php echo $anasayfa['footer_yazi']?> <strong><span></span></strong>
        </div>
        <div class="credits">
            <!--        Mehmet Acar <a href="index.php">tarafından dizayn edilmiştir.</a>-->
        </div>
    </div>
</footer><!-- End  Footer -->

<a href="../mehmet" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="front-end/assets/vendor/jquery/jquery.min.js"></script>
<script src="front-end/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="front-end/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="front-end/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="front-end/assets/vendor/counterup/counterup.min.js"></script>
<script src="front-end/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="front-end/assets/vendor/venobox/venobox.min.js"></script>
<script src="front-end/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="front-end/assets/vendor/typed.js/typed.min.js"></script>
<script src="front-end/assets/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="front-end/assets/js/main.js"></script>

</body>

</html>