
<!-- APP CUSTOMIZER -->
<div style="margin-top: 80px;" id="app-customizer" class="app-customizer">
    <a style="" href="javascript:void(0)"
       class="app-customizer-toggle theme-color"
       data-toggle="class"
       data-class="open"
       data-active="false"
       data-target="#app-customizer">
        <i class="fa fa-gear"></i>
    </a>
    <div class="customizer-tabs">
        <!-- tabs list -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#menubar-customizer" aria-controls="menubar-customizer"
                                                      role="tab" data-toggle="tab">Menubar</a></li>
            <li role="presentation"><a href="#navbar-customizer" aria-controls="navbar-customizer" role="tab"
                                       data-toggle="tab">Navbar</a></li>
        </ul><!-- .nav-tabs -->

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane in active fade" id="menubar-customizer">
                <div class="hidden-menubar-top hidden-float">
                    <div class="m-b-0">
                        <label for="menubar-fold-switch">Fold Menubar</label>
                        <div class="pull-right">
                            <input id="menubar-fold-switch" type="checkbox" data-switchery data-size="small"/>
                        </div>
                    </div>
                    <hr class="m-h-md">
                </div>
                <div class="radio radio-default m-b-md">
                    <input type="radio" id="menubar-light-theme" name="menubar-theme" data-toggle="menubar-theme"
                           data-theme="light">
                    <label for="menubar-light-theme">Light</label>
                </div>

                <div class="radio radio-inverse m-b-md">
                    <input type="radio" id="menubar-dark-theme" name="menubar-theme" data-toggle="menubar-theme"
                           data-theme="dark">
                    <label for="menubar-dark-theme">Dark</label>
                </div>
            </div><!-- .tab-pane -->
            <div role="tabpanel" class="tab-pane fade" id="navbar-customizer">
                <!-- This Section is populated Automatically By javascript -->
            </div><!-- .tab-pane -->
        </div>
    </div><!-- .customizer-taps -->
    <hr class="m-0">
    <div class="customizer-reset">
        <button id="customizer-reset-btn" class="btn btn-block btn-outline btn-primary">Reset</button>
    </div>
</div>
<!-- #app-customizer -->


<!-- build:js ../assets/js/core.min.js -->
<script src="../libs/bower/jquery/dist/jquery.js"></script>
<script src="../libs/bower/jquery-ui/jquery-ui.min.js"></script>
<script src="../libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
<script src="../libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
<script src="../libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="../libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="../libs/bower/PACE/pace.min.js"></script>
<script src="../libs/bower/dropzone/dist/min/dropzone.min.js" type="text/javascript"></script>
<!-- endbuild -->

<!-- build:js ../assets/js/app.min.js -->
<script src="../assets/js/library.js"></script>
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/app.js"></script>
<script src="../assets/js/sweetalert2.all.js"></script>
<script src="../assets/js/custom.js"></script>

<!-- endbuild -->
<script src="../libs/bower/moment/moment.js"></script>
<script src="../libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="../assets/js/fullcalendar.js"></script>
</body>
</html>


