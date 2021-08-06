<?php
include "header.php";

require_once("front-end/connect_front/ArabaControllerf.php");
$carcont = new ArabaControllerf();
$arabalar = $carcont->arabaGetir();

require_once ("front-end/connect_front/KisiControllerf.php");
$kisicont = new KisiControllerf();
$kisiler = $kisicont->kisileriGetir();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kisi_ad = trim($_POST["kisi_ad"]);
    $kisi_soyad = trim($_POST["kisi_soyad"]);
    $marka = trim($_POST["marka"]);
    $yil = trim($_POST["yil"]);
    $km = trim($_POST["km"]);

    $message = "";
    $arabalar = $carcont->arabaAra($kisi_ad, $kisi_soyad, $marka, $yil, $km);
    if (count($arabalar) > 0) {
        $message = count($arabalar) . " sonuç bulundu.";
    } else {
        $message = "Sonuç bulunamadı";
    }
} else {
    $arabalar = $carcont->arabaGetir();

}
?>
<div class="row container-fluid"style="margin-top:20px ; margin-left:30px ; margin-right:30px">
    <div class="card col-md-2 shadow3" style="background-color: #cce5ff ">
        <form action="arabaListele.php" method="POST">
            <div class="form-group">
                <div><?php echo $message ; ?></div>
                <label for="">Ad</label>
                <input type="text" class="form-control" name="kisi_ad" placeholder="İsim giriniz..">

            </div>
            <div class="form-group">
                <label for="">Soyad</label>
                <input type="text" class="form-control" name="kisi_soyad" id="soyad"
                       placeholder="Soyisim giriniz..">

            </div>
            <div class="form-group">
                <label for="">Marka</label>
                <input type="text" class="form-control" name="marka" id="marka"
                       placeholder="Marka giriniz..">
            </div>
            <div class="form-group">
                <label for="">Yıl</label>
                <input type="text" class="form-control" name="yil" id="yil"
                       placeholder="Yıl giriniz..">
            </div>
            <div class="form-group">
                <label for="">Km</label>
                <input type="text" class="form-control" name="km" id="km"
                       placeholder="Kilometre giriniz..">
            </div>
            <div align="right">
                <button type="submit" class="btn btn-secondary">Ara</button>

            </div>
        </form>
    </div>
    <div class="col-md-9 shadow4">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr style="background-color:powderblue">
                <th style="color: darkmagenta">S.No</th>
                <th style="color: darkmagenta">Kişi Ad</th>
                <th style="color: darkmagenta">Kişi Soyad</th>
                <th style="color: darkmagenta">Marka</th>
                <th style="color: darkmagenta">Yıl</th>
                <th style="color: darkmagenta">Kilometre</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $say = 0;
            foreach ($arabalar as $araba) {
                $say++; ?>
                <tr style="background-color:aliceblue">
                    <td><?php echo $say; ?></td>
                    <td><?php echo $araba['kisi_ad'] ?></td>
                    <td><?php echo $araba['kisi_soyad'] ?></td>
                    <td><?php echo $araba['marka'] ?></td>
                    <td><?php echo $araba['yil'] ?></td>
                    <td><?php echo $araba['km'] ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>
<?php include "footer.php"; ?>

