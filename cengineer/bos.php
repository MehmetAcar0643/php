if (isset($_POST['dersduzenle'])) {

$ders_id = $_POST['ders_id'];
$ders_seourl = seo($_POST['ders_ad']);


$ayarkaydet = $db->prepare("UPDATE ders SET
kategori_id=:kategori_id,
ders_ad=:ad,
ders_detay=:detay,
ders_video=:video,
ders_keyword=:keyword,
ders_durum=:ders_durum,
ders_seourl=:ders_seourl,
ders_sira=:ders_sira
WHERE ders_id={$_POST['ders_id']}");

$update = $ayarkaydet->execute(array(
'kategori_id' => $_POST['kategori_id'],
'ad' => $_POST['ders_ad'],
'detay' => $_POST['ders_detay'],
'video' => $_POST['ders_video'],
'keyword' => $_POST['ders_keyword'],
'ders_durum' => $_POST['ders_durum'],
'ders_seourl' => $ders_seourl,
'ders_sira' => $_POST['ders_sira']
));


if ($update) {

Header("Location:../production/ders-duzenle.php?durum=ok&ders_id=$ders_id");

} else {

Header("Location:../production/ders-duzenle.php?durum=no&ders_id=$ders_id");
}

}