<?php
include "header.php";

require_once("../connect/KisiController.php");
$kisicont = new KisiController();
$kisiler=$kisicont->kisileriGetir();

require_once("../connect/ArabaController.php");
$carcont = new ArabaController();

if($_GET['id']){
    $id=$_GET['id'];
    $araba=$carcont->arabaBul($id);
    $kisi=$kisicont->kisiBul($araba['kisi_id']);
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
    if (empty(trim($_POST["marka"]))) {
        array_push($error, "Marka Seçiniz");
    } else {
        $marka = trim($_POST["marka"]);
    }
    if (empty(trim($_POST["yil"]))) {
        array_push($error, "Yıl Giriniz");
    } else {
        $yil = trim($_POST["yil"]);
    }
    if (empty(trim($_POST["km"]))) {
        array_push($error, "KM'yi Giriniz");
    } else {
        $km = trim($_POST["km"]);
    }
    if (count($error) == 0) {
        $flag = $carcont->arabaGuncelle($kisi_id, $marka, $yil, $km, $id);
        if ($flag) {
            $message = "Araç Başarıyla Güncellendi";

        } else {
            array_push($error, "Hata");
        }
    }

    $araba=$carcont->arabaBul($id);
    $kisi=$kisicont->kisiBul($araba['kisi_id']);
}

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-users-cog mr-1" style="font-size:30px; color: orange"></i>
                    Araba Düzenle
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
                        <form action="arabaDuzenle.php" method="POST">
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
                                <label for="">Marka</label>
                                <input type="text" class="form-control" name="marka" id="marka"
                                       value="<?php echo $araba['marka'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Yıl</label>
                                <input type="text" class="form-control" name="yil" id="yil"
                                       value="<?php echo $araba['yil'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Km</label>
                                <input type="text" class="form-control" name="km" id="km"
                                       value="<?php echo $araba['km'] ?>">
                            </div>
                            <input type="hidden" name="id" value="<?php echo $araba['id'] ?>">

                            <div align="right">
                                <button type="submit" class="btn btn-danger">Güncelle</button>
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
