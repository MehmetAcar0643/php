<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Dumlupınar Üniversitesi Kütüphane Yönetim Paneli</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="user.php"><i class="fa fa-user fa-fw"></i> Ayarlar</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Çıkış</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <form class="form-horizontal" onsubmit="return myAra()" enctype="multipart/form-data" name="ara" id="ara" action="ara.php" method="POST">
                                    <input type="text" name="aranan" id="aranan" class="form-control" placeholder="kitap adı, yazar, isbn giriniz...">
                                    <span class="input-group-btn">
                                    <input type="submit" class="btn btn-default" value="Ara">
                                </form>
                            </span>
                            </div>
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Yönetim</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Kitaplar<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="kitapekle.php">Yeni Ekle</a>
                                </li>
                                <li>
                                    <a href="kitapduzenle.php">Tüm Kitaplar</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="kategoriler.php"><i class="fa fa-folder-open-o fa-fw"></i> Kategoriler</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bars fa-fw"></i>Kitap İade/Teslim<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="kitapver.php">Kitap Teslim</a>
                                </li>
                                <li>
                                    <a href="kitapal.php">Kitap İade İşlemleri</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="suresigecen.php"><i class="fa fa-folder-open-o fa-fw"></i> İade Tarihi Geçen Kitaplar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
<script>
function myAra()
{
    var kelime= document.getElementById("aranan").value;
    if(kelime == "" || kelime.length < 3) 
    {
        alert("en az 4 karakter...");
        return false;
    }
}
</script>
