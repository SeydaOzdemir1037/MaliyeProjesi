<?php
include "header.php";
require_once("../connect/IlController.php");

$ilcont = new IlController();
$iller = $ilcont->illeriGetir();

require_once("../connect/IlceController.php");

$ilcecont = new IlceController();
$ilceler = $ilcecont->ilceleriGetir();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = [];
    $message = "";
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
        require_once("../connect/KisiController.php");
        $kisicont = new KisiController();
        $flag = $kisicont->kisiEkle($kisi_ad, $kisi_soyad, $il_id, $ilce_id, $tc_no);
        if ($flag) {
            $message = "Kişi Başarıyla Eklendi";
        } else {
            array_push($error, "Hata");
        }
    }
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-users-cog mr-1" style="font-size:30px; color: orange"></i>
                    Kişi Ekle
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
                        <form action="kisiEkle.php" method="POST">
                            <div class="form-group">
                                <label for="">Ad</label>
                                <input type="text" class="form-control" name="kisi_ad" placeholder="Adınızı giriniz..">

                            </div>
                            <div class="form-group">
                                <label for="">Soyad</label>
                                <input type="text" class="form-control" name="kisi_soyad" id="soyad"
                                       placeholder="Soyadınızı giriniz..">

                            </div>

                            <div class="form-group">
                                <label for="">İl</label>

                                <select name="il_id" id="il" class="form-control">
                                    <option value="">İl Seçiniz</option>
                                    <?php foreach ($iller as $il) { ?>
                                        <option value="<?php echo $il['id']; ?>"><?php echo $il['il'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="">İlce</label>

                                <select name="ilce_id" id="ilce" class="form-control">

                                </select>

                            </div>
                            <div class="form-group">
                                <label for="">TC Kimlik No</label>
                                <input type="text" class="form-control" name="tc_no" id="tc_no"
                                       placeholder="TC kimlik numaranızı giriniz..">
                            </div>
                            <div align="right">
                                <button type="submit" class="btn btn-secondary">Kişiyi Ekle</button>
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