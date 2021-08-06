<?php
include 'header.php';

require_once("front-end/connect_front/KisiControllerf.php");

$kisicont = new KisiControllerf();
$kisiler = $kisicont->kisiBul($_SESSION['id']);

require_once("front-end/connect_front/IlControllerf.php");

$ilcont = new IlControllerf();
$iller = $ilcont->illeriGetir();

require_once("front-end/connect_front/IlceControllerf.php");

$ilcecont = new IlceControllerf();
$ilceler = $ilcecont->ilceleriGetir();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = [];
    $message = "";
    $kisi_id=$_SESSION['id'];
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
        array_push($error, "Adres Giriniz");
    } else {
        $adres = trim($_POST["adres"]);
    }
    if (empty(trim($_POST["parsel"]))) {
        array_push($error, "Arsanın parselini giriniz");
    } else {
        $parsel = trim($_POST["parsel"]);
    }

    if (count($error) == 0) {
        require_once("front-end/connect_front/ArsaControllerf.php");
        $arsacont = new ArsaControllerf();
        $flag = $arsacont->arsaEkle($il_id, $ilce_id, $adres,$parsel,$kisi_id);
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
                    <i class="fa fa-home mr-1" style="font-size: 30px; color: blueviolet; font-style: oblique"></i>
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
                    <div class="container" style=";margin-bottom: 55px; width:40% ; height: 100%">
                        <form action="arsaEkle.php" method="POST">
                            <div class="form-group">
                                <label for="">Ad Soyad</label>
                                <select name="kisi_id" id="" class="form-control">
                                    <option value="<?php echo $kisiler['id']; ?>"><?php echo $kisiler['kisi_ad'] . " " . $kisiler['kisi_soyad'] ?></option>
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
                                <label for="">Adres</label>
                                <input type="text" class="form-control" name="adres" id="text"
                                       placeholder="Adresi giriniz..">
                            </div>
                            <div class="form-group">
                                <label for="">Parsel</label>
                                <input type="text" class="form-control" name="parsel" id="text"
                                       placeholder="Arsanın Parselini Giriniz..">
                            </div>
                            <div align="right">
                                <button type="submit" class="btn btn-secondary">Arsayı Ekle</button>
                                <a href="varlikListele.php">
                                    <button type="button" class="btn btn-info ">Geri Dön</button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </main>
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