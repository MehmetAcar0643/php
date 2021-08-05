<?php include "header.php";


if (!$yetkiler['mailler']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
}

require_once("../../controller/IletisimController.php");
$mailcont = new IletisimController();
$mailler = $mailcont->mailListele();
?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1>
                    <i class="fa fa-envelope-o"></i>
                    Mailler
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="mailbox-controls pull-right">
                        <!--                        <div class="animated-checkbox">-->
                        <!--                            <label>-->
                        <!--                                <input type="checkbox"><span class="label-text"></span>-->
                        <!--                            </label>-->
                        <!--                        </div>-->
                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover">
                            <tbody>
                            <?php $say = 0;
                            foreach ($mailler as $mail) { ?>
                                <tr>
                                    <td><?= $mail['ad soyad'] ?></td>
                                    <td><?= $mail['mail'] ?></td>
                                    <td class="mail-subject">
                                        <?php if ($yetkiler['mailler']['duzenleme']) { ?>

                                            <a href="mail-<?= seo($mail['id']) ?>">
                                                <b><?= $mail['konu'] ?>&nbsp;&nbsp</b>
                                            </a>
                                        <?php }else{ ?>
                                            <b><?= $mail['konu'] ?>&nbsp;&nbsp</b>
                                        <?php }?>
                                    </td>
                                    <td><?= date("d/m/Y H:m:s", strtotime($mail['tarih'])) ?></td>
                                    <?php if ($yetkiler['mailler']['duzenleme']) { ?>
                                        <td><a href="mail-<?= seo($mail['id']) ?>" class="btn btn-primary">Göster</a>
                                        </td>
                                    <?php } ?>
                                    <? $say++; ?>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </main>
<?php include "footer.php";
?>