<div class="footerspace"></div>
</div>
<footer>
  
</footer>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
	<script src="http://code.jquery.com/ui/1.12.0/jquery-ui.min.js"   integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="   crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/html5shiv.min.js"></script>
    <script type="text/javascript" src="js/respond.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/js/lightbox.min.js"></script>
    <script type="text/javascript" src="js/datepicker.js"></script>
    <script type="text/javascript" src="js/datepicker.tr.js"></script>
    <script type="text/javascript">
        //<![CDATA[
        $(window).load(function(){
            $('.arrow').on("click", function (event) {
                $('.arrow-img').toggleClass('rotate');
            });
        });//]]> 

    </script>
    <script type="text/javascript">
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();
            if(dd<10) {
                dd='0'+dd
            } 
            if(mm<10) {
                mm='0'+mm
            } 
            today = mm+'-'+dd+'-'+yyyy; //bugunun tarihi
        $('.tar input').datepicker({
            format: "dd-mm-yyyy",
            endDate: "today", //bugunun tarihi girilecek
            startView: 2,
            weekStart: 1,
            language: "tr",
            autoclose: true,
            todayHighlight: true,
        });
        $("#detay").click(function(){
            $(".detay").toggle("fast");
        });
    </script>

    
</body>
</html>      
                