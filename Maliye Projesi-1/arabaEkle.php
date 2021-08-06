<?php
include 'header.php';

require_once("front-end/connect_front/KisiControllerf.php");

$kisicont = new KisiControllerf();
$kisiler = $kisicont->kisiBul($_SESSION['id']);




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = [];
    $message = "";
    $kisi_id=$_SESSION['id'];
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
        require_once ("front-end/connect_front/ArabaControllerf.php");
        $carcont = new ArabaControllerf();
        $flag = $carcont->arabaEkle($marka,$yil,$km,$kisi_id);
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
                    <i class="fa fa-home mr-1" style="font-size: 30px; color: blueviolet; font-style: oblique"></i>
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
                    <div class="container" style=";margin-bottom: 55px; width:40% ; height: 100%">
                        <form action="arabaEkle.php" method="POST">
                            <div class="form-group">
                                <label for="">Ad Soyad</label>
                                <select name="kisi_id" id="" class="form-control">
                                    <option value="<?php echo $kisiler['id']; ?>"><?php echo $kisiler['kisi_ad'] . " " . $kisiler['kisi_soyad'] ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Marka</label>
                                <input type="text" class="form-control" name="marka" id="marka"
                                       placeholder="Marka Giriniz..">
                            </div>
                            <div class="form-group">
                                <label for="">Yıl</label>
                                <input type="text" class="form-control" name="yil" id="yil"
                                       placeholder="Yılını giriniz..">
                            </div>
                            <div class="form-group">
                                <label for="">Kilometre</label>
                                <input type="text" class="form-control" name="km" id="km"
                                       placeholder="Kilometresini giriniz..">
                            </div>
                            <div align="right">
                                <button type="submit" class="btn btn-secondary">Arabayı Ekle</button>
                                <a href="varlikListele.php">
                                    <button type="button" class="btn btn-info ">Geri Dön</button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </main>