<?php
include "header.php";

require_once("../connect/KisiController.php");
$kisicont = new KisiController();
$kisiler = $kisicont->kisiadsoyad();


require_once("../connect/IlController.php");
$ilcont = new IlController();
$iller = $ilcont->illeriGetir();

require_once("../connect/IlceController.php");
$ilcecont = new IlceController();
$ilceler = $ilcecont->ilceleriGetir();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = [];
    $message = "";

    if (empty(trim($_POST["kisi_id"]))) {
        array_push($error, "Ad Soyad Seciniz");
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
        array_push($error, "Parsel Değeri Giriniz");
    } else {
        $parsel = trim($_POST["parsel"]);
    }

    if (count($error) == 0) {
        require_once("../connect/ArsaController.php");
        $arsacont = new ArsaController();
        $flag = $arsacont->arsaEkle($parsel, $kisi_id, $il_id, $ilce_id);
        if ($flag) {
            $message = "Arsa Başarıyla Eklendi";
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
                    <i class="fa fa-layer-group mr-1" style="font-size: 30px;font-style: oblique;color:greenyellow"></i>
                    Arsa Ekle
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
                        <form action="arsaEkle.php" method="post">
                            <div class="form-group">
                                <label for="">Ad Soyad</label>
                                <select name="kisi_id" id="" class="form-control">
                                    <option value="">Kişi Seçiniz</option>
                                    <?php foreach ($kisiler as $kisi) { ?>
                                        <option value="<?php echo $kisi['id']; ?>"><?php echo $kisi['kisi_ad'] . " " . $kisi['kisi_soyad'] ?></option>
                                    <?php } ?>
                                </select>
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
                                <label for="">Parsel</label>
                                <input type="text" class="form-control" name="parsel" id="parsel"
                                       placeholder="Evin parsel değerini m2 cinsinden rakamla giriniz.." >
                            </div>
                            <div align="right">
                                <button type="submit" class="btn btn-secondary">Arsayı Ekle</button>
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
