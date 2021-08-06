<?php
include "header.php";
require_once("../connect/KisiController.php");

$kisicont = new KisiController();
$kisiler = $kisicont->kisiadsoyad();

require_once("../connect/ArabaController.php");

$carcont = new ArabaController();
$arabalar = $carcont->arabalar();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = [];
    $message = "";
    if (empty(trim($_POST["kisi_id"]))) {
        array_push($error, "Kişi Giriniz");
    } else {
        $kisi_id = trim($_POST["kisi_id"]);
    }
    if (empty(trim($_POST["marka"]))) {
        array_push($error, "Marka Seçiniz");
    } else {
        $marka = trim($_POST["marka"]);
    }
    if (empty(trim($_POST["yil"]))) {
        array_push($error, "Yılını Seçiniz");
    } else {
        $yil = trim($_POST["yil"]);
    }
    if (empty(trim($_POST["km"]))) {
        array_push($error, "Kilometresini Giriniz");
    } else {
        $km = trim($_POST["km"]);
    }
    if (count($error) == 0) {
        require_once("../connect/ArabaController.php");
        $carcont = new ArabaController();
        $flag = $carcont->arabaEkle($kisi_id, $marka, $yil, $km);
        if ($flag) {
            $message = "Araba Başarıyla Eklendi";
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
                        <i class="fa fa-car mr-1" style="font-size: 30px;font-style: oblique;color: red"></i>
                        Araba Ekle
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
                            <form action="arabaEkle.php" method="post">
                                <div class="form-group">
                                    <label for="">Ad Soyad</label>
                                    <select name="kisi_id" id="" class="form-control">
                                        <option value="">Ad Soyad Seçiniz</option>
                                        <?php foreach ($kisiler as $kisi) { ?>
                                            <option value="<?php echo $kisi['id']; ?>"><?php echo $kisi['kisi_ad'] . " " . $kisi['kisi_soyad'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Marka</label>
                                    <input type="text" class="form-control" name="marka" id="marka"
                                           placeholder="Aracınızın markasını giriniz..">
                                </div>
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Yıl</label>
                                    <input type="text" class="form-control" name="yil" id="yil"
                                            placeholder="Aracınızın yilini giriniz..">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Km</label>
                                    <input type="text" class="form-control" name="km" id="km"
                                           placeholder="Aracın kilometresini giriniz..">
                                </div></div>

                                <div align="right">
                                    <button type="submit" class="btn btn-secondary">Aracı Ekle</button>
                                    <a href="arabalar.php">
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