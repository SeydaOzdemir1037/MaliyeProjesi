<?php
include "header.php";
require_once("../connect/IlController.php");

$ilcont = new IlController();
$iller = $ilcont->illeriGetir();

require_once("../connect/IlceController.php");

$ilcecont = new IlceController();
$ilceler = $ilcecont->ilceleriGetir();

require_once("../connect/KisiController.php");
$kisicont = new KisiController();
$kisiler = $kisicont->kisileriGetir();

require_once("../connect/EvController.php");
$evcont = new EvController();

require_once ("../connect/ArsaController.php");
$arsacont= new ArsaController();

if($_GET['id']){
    $id = $_GET['id'];
    $arsa=$arsacont->arsaBul($id);
    $kisi=$kisicont->kisiBul($arsa['kisi_id']);
    $il=$ilcont->ilBilgileri($arsa['il_id']);
    $ilce=$ilcecont->ilceBilgileri($arsa['ilce_id']);

}

$error = [];
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    if (empty(trim($_POST["kisi_id"]))) {
        array_push($error, "Adınızı Ve Soyadınızı Seçiniz");
    } else {
        $kisi_id = trim($_POST["kisi_id"]);
    }
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
    if (empty(trim($_POST["parsel"]))) {
        array_push($error, "Parsel Değerini Giriniz");
    } else {
        $parsel = trim($_POST["parsel"]);
    }
    if (empty(trim($_POST["adres"]))) {
        array_push($error, "Adresinizi Giriniz");
    } else {
        $adres = trim($_POST["adres"]);
    }
    if (count($error) == 0) {
        $flag = $arsacont->arsaGuncelle($kisi_id, $il_id, $ilce_id,$parsel, $adres, $id);
        if ($flag) {
            $message = "Arsa Başarıyla Güncellendi";

        } else {
            array_push($error, "Hata");
        }
    }

    $arsa=$arsacont->arsaBul($id);
    $kisi=$kisicont->kisiBul($arsa['kisi_id']);
    $il=$ilcont->ilBilgileri($arsa['il_id']);
    $ilce=$ilcecont->ilceBilgileri($arsa['ilce_id']);

}

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-users-cog mr-1" style="font-size:30px; color: orange"></i>
                    Arsa Düzenle
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
                    <div class="container" style=";margin-bottom: 55px; width:45%">
                        <form action="arsaDuzenle.php" method="POST">
                            <div class="form-group">
                                <label for="">Ad Ve Soyad</label>
                                <select name="kisi_id" id="kisi_id" class="form-control">
                                    <option value="<?php echo $kisi['id']?>"><?php echo $kisi['kisi_ad']." ". $kisi['kisi_soyad'] ?></option>
                                    <?php foreach ($kisiler as $kisi) { ?>
                                        <option value="<?php echo $kisi['id']; ?>"><?php echo $kisi['kisi_ad'] ?> <?php echo $kisi['kisi_soyad'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>



                            <div class="form-group">
                                <label for="">İl</label>

                                <select name="il_id" id="il" class="form-control">
                                    <option value="<?php echo $il['id']?>"><?php echo $il['il']?></option>
                                    <?php foreach ($iller as $il) { ?>
                                        <option value="<?php echo $il['id']; ?>"><?php echo $il['il'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="">İlce</label>
                                <select name="ilce_id" id="ilce" class="form-control">
                                    <option value="<?php echo $ilce['id']?>"><?php echo $ilce['ilce'] ?></option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="">Parsel</label>
                                <input type="text" class="form-control" name="parsel" id="parsel"
                                       value="<?php echo $arsa['parsel'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Adres</label>
                                <input type="text" class="form-control" name="adres" id="adres"
                                       value="<?php echo $arsa['adres'] ?>">
                            </div>
                            <input type="hidden" name="id" value="<?php echo $arsa['id'] ?>">

                            <div align="right">
                                <button type="submit" class="btn btn-danger">Güncelle</button>
                                <a href="arsalar.php">
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
</div>
<?php include "footer.php"; ?>
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
