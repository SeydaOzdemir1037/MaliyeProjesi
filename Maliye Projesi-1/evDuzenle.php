<?php
include "header.php";
require_once("front-end/connect_front/IlControllerf.php");

$ilcont = new IlControllerf();
$iller = $ilcont->illeriGetir();
require_once("front-end/connect_front/KisiControllerf.php");
$kisicont = new KisiControllerf();
$kisiler = $kisicont->kisiBul($_SESSION['id']);

require_once("front-end/connect_front/IlceControllerf.php");
$ilcecont = new IlceControllerf();
$ilceler = $ilcecont->ilceleriGetir();


require_once("front-end/connect_front/EvControllerf.php");
$evcont = new EvControllerf();

if ($_GET['id']) {
    $id = $_GET['id'];
    $ev = $evcont->evGetir($id);
    $kisi = $kisicont->kisiBul($_SESSION['id']);
    $il = $ilcont->ilBilgileri($ev['il_id']);
    $ilce = $ilcecont->ilceBilgileri($ev['ilce_id']);

}

$error = [];
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    if (empty(trim($_POST["il_id"]))) {
        array_push($error, "İl Seçiniz");
    } else {
        $il_id = trim($_POST["il_id"]);
    }
    if (empty(trim($_POST["ilce_id"]))) {
        array_push($error, "İlçe Seçiniz");
    } else {
        $ilce_id = trim($_POST["ilce_id"]);
    }
    if (empty(trim($_POST["adres"]))) {
        array_push($error, "Adresinizi Giriniz");
    } else {
        $adres = trim($_POST["adres"]);
    }
    if (empty(trim($_POST["durum"]))) {
        array_push($error, "Durum Giriniz");
    } else {
        $durum = trim($_POST["durum"]);
    }
    if (empty(trim($_POST["m2"]))) {
        array_push($error, "M² Giriniz");
    } else {
        $m2 = trim($_POST["m2"]);
    }
    if (count($error) == 0) {
        $flag = $evcont->evGuncelle($il_id, $ilce_id, $adres,$durum,$m2,$id);
        if ($flag) {
            $message = "Ev Başarıyla Güncellendi";

        } else {
            array_push($error, "Hata");
        }
    }

    $ev = $evcont->evGetir($id);
    $kisi = $kisicont->kisiBul($_SESSION['id']);
    $il = $ilcont->ilBilgileri($ev['il_id']);
    $ilce = $ilcecont->ilceBilgileri($ev['ilce_id']);

}

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-users-cog mr-1" style="font-size:30px; color: orange"></i>
                    Ev Düzenle
                </div>
                <div class="card-body">
                    <?php if (count($error) > 0) { ?>
                        <div class="alert alert-danger">
                            <?php foreach ($error as $er) { ?>
                                - <?php echo $er; ?><br>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if ($message != '') { ?>
                        <div class="alert alert-warning"><?php echo $message; ?></div>
                    <?php } ?>
                    <div class="container" style="margin-bottom: 55px; width:45%">
                        <form action="evDuzenle.php" method="POST">
                            <div class="form-group">
                                <label for="">Ad Ve Soyad</label>
                                <select name="kisi_id" id="kisi_id" class="form-control">
                                    <option value="<?php echo $_SESSION['id'] ?>"><?php echo $kisi['kisi_ad'] . " " . $kisi['kisi_soyad'] ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">İl</label>

                                <select name="il_id" id="il" class="form-control">
                                    <option value="<?php echo $ev['il_id'] ?>"><?php echo $ev['il'] ?></option>
                                    <?php foreach ($iller as $il) { ?>
                                        <option value="<?php echo $il['id']; ?>"><?php echo $il['il'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="">İlce</label>
                                <select name="ilce_id" id="ilce" class="form-control">
                                    <option value="<?php echo $ev['ilce_id'] ?>"><?php echo $ev['ilce'] ?></option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="">Adres</label>
                                <input type="text" class="form-control" name="adres" id="adres"
                                       value="<?php echo $ev['adres'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Durum</label>
                                <input type="text" class="form-control" name="durum" id="durum"
                                       value="<?php echo $ev['durum'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">M2</label>
                                <input type="text" class="form-control" name="m2" id="m2"
                                       value="<?php echo $ev['m2'] ?>">
                            </div>
                            <input type="hidden" name="id" value="<?php echo $ev['id'] ?>">

                            <div align="right">
                                <button type="submit" class="btn btn-danger">Güncelle</button>
                                <a href="varlikListele.php">
                                    <button type="button" class="btn btn-info ">Geri Dön</button>
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2020</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
<script>
    $(document).ready(function (e) {
        $("#il").on('change', (function (e) {
            $("#ilce").empty();
            e.preventDefault();
            var ilid = $(this).val();
            $.ajax({
                type: "POST",
                url: "ilcebul.php",
                data: {'ilid': ilid},
                success: function (data) {
                    $('#ilce').append('<option value="">İlçe Seçiniz...</option>');
                    var opts = $.parseJSON(data);
                    $.each(opts, function (i, d) {
                        $('#ilce').append('<option value="' + d.id + '">' + d.ilce + '</option>');
                    });
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("ilçeler yüklenemedi");
                }
            });
        }));
    });
</script>