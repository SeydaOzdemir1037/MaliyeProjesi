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

if ($_GET['id']) {
    $id = $_GET['id'];
    $kisi = $kisicont->kisiBul($id);
    $il = $ilcont->ilBilgileri($kisi['il_id']);
    $ilce = $ilcecont->ilceBilgileri($kisi['ilce_id']);

}

$error = [];
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    if (empty(trim($_POST["kisi_ad"]))) {
        array_push($error, "Adınızı Giriniz");
    } else {
        $kisi_ad = trim($_POST["kisi_ad"]);
    }
    if (empty(trim($_POST["kisi_soyad"]))) {
        array_push($error, "Soyadınızı Giriniz");
    } else {
        $kisi_soyad = trim($_POST["kisi_soyad"]);
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
    if (empty(trim($_POST["tc_no"]))) {
        array_push($error, "TC'nizi Giriniz");
    } else {
        $tc_no = trim($_POST["tc_no"]);
    }
    if (count($error) == 0) {
        $flag = $kisicont->kisiGuncelle($kisi_ad, $kisi_soyad, $il_id, $ilce_id, $tc_no, $id);
        if ($flag) {
            $message = "Kişi Başarıyla Güncellendi";

        } else {
            array_push($error, "Hata");
        }
    }

    $kisi = $kisicont->kisiBul($id);
    $il = $ilcont->ilBilgileri($kisi['il_id']);
    $ilce = $ilcecont->ilceBilgileri($kisi['ilce_id']);

}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-users-cog mr-1" style="font-size:30px; color: orange"></i>
                    Kişi Güncelle
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
                        <form action="kisiDuzenle.php" method="POST">
                            <div class="form-group">
                                <label for="">Ad</label>
                                <input type="text" class="form-control" name="kisi_ad"
                                       value="<?php echo $kisi['kisi_ad'] ?>">

                            </div>
                            <div class="form-group">
                                <label for="">Soyad</label>
                                <input type="text" class="form-control" name="kisi_soyad" id="soyad"
                                       value="<?php echo $kisi['kisi_soyad'] ?>">

                            </div>

                            <div class="form-group">
                                <label for="">İl</label>

                                <select name="il_id" id="il" class="form-control">
                                    <option value="<?php echo $il['id'] ?>"><?php echo $il['il'] ?></option>
                                    <?php foreach ($iller as $il) { ?>
                                        <option value="<?php echo $il['id']; ?>"><?php echo $il['il'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="">İlce</label>
                                <select name="ilce_id" id="ilce" class="form-control">
                                    <option value="<?php echo $ilce['id'] ?>"><?php echo $ilce['ilce'] ?></option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="">TC Kimlik No</label>
                                <input type="text" class="form-control" name="tc_no" id="tc_no"
                                       value="<?php echo $kisi['tc_no'] ?> ">
                            </div>
                            <input type="hidden" name="id" value="<?php echo $kisi['id'] ?>">

                            <div align="right">
                            <button type="submit" class="btn btn-danger">Güncelle</button>
                            <a href="kisiler.php">
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