<?php
include "header.php";

require_once("front-end/connect_front/EvControllerf.php");
$evcont = new EvControllerf();

require_once("front-end/connect_front/KisiControllerf.php");
$kisicont = new KisiControllerf();


require_once("front-end/connect_front/IlControllerf.php");

$ilcont = new IlControllerf();
$iller = $ilcont->illeriGetir();

require_once("front-end/connect_front/IlceControllerf.php");

$ilcecont = new IlceControllerf();
$ilceler = $ilcecont->ilceleriGetir();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kisi_ad = trim($_POST["kisi_ad"]);
    $kisi_soyad = trim($_POST["kisi_soyad"]);
    $adres = trim($_POST["adres"]);
    $il = trim($_POST["il_id"]);
    $ilce = trim($_POST["ilce_id"]);
    $m2 = trim($_POST["m2"]);
    $odasayisi = trim($_POST["odasayisi"]);
    $durum = trim($_POST["durum"]);

    $message = "";
    $evler = $evcont->evAra($kisi_ad, $kisi_soyad, $adres, $il, $ilce,$m2,$odasayisi,$durum);
    if (count($evler) > 0) {
        $message = count($evler) . " sonuç bulundu.";
    } else {
        $message = "Sonuç bulunamadı";
    }
} else {
    $evler = $evcont->evleriGetir();
}
?>

<div class="row container-fluid" style="margin-top:20px ; margin-left:30px ; margin-right:30px">
    <div class="card col-md-2" style="background-color: beige">
        <div class="alert" style="background-color: #fff3cd "> <?php echo $message; ?> </div>
        <form action="evListele.php" method="POST">
            <div class="form-group">
                <label for="">Ad</label>
                <input type="text" class="form-control" name="kisi_ad" placeholder="İsim giriniz..">

            </div>
            <div class="form-group">
                <label for="">Soyad</label>
                <input type="text" class="form-control" name="kisi_soyad" id="soyad"
                       placeholder="Soyisim giriniz..">

            </div>
            <div class="form-group">
                <label for="">Adres</label>
                <input type="text" class="form-control" name="adres" id="adres"
                       placeholder="Adres giriniz..">
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
                <label for="">M²</label>
                <input type="text" class="form-control" name="m2" id="m2"
                       placeholder="M² giriniz..">
            </div>
            <div class="form-group">
                <label for="">Oda Sayısı</label>
                <input type="text" class="form-control" name="odasayisi" id="odasayisi"
                       placeholder="Oda Sayısını giriniz..">
            </div>

            <div class="form-group">
                <label for="">Durum</label>
                <input type="text" class="form-control" name="durum" id="durum"
                       placeholder="Satılık Mı Kiralık Mı?">
            </div>

            <div align="right">
                <button type="submit" class="btn btn-secondary">Ara</button>

            </div>
        </form>
    </div>
    <div class="col-md-9">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr style="background-color:powderblue">
                <th style="color: darkmagenta">S.No</th>
                <th style="color: darkmagenta">Kişi Ad</th>
                <th style="color: darkmagenta">Kişi Soyad</th>
                <th style="color: darkmagenta">İl</th>
                <th style="color: darkmagenta">İlçe</th>
                <th style="color: darkmagenta">Adres</th>
                <th style="color: darkmagenta">M²</th>
                <th style="color: darkmagenta">Oda Sayısı</th>
                <th style="color: darkmagenta">Durum</th>
                <th></th>


            </tr>
            </thead>
            <tbody>
            <?php
            $say = 0;
            foreach ($evler as $ev) {
                $say++ ?>
                <tr style="background-color:aliceblue">
                    <td><?php echo $say ?></td>
                    <td><?php echo $ev['kisi_ad'] ?></td>
                    <td><?php echo $ev['kisi_soyad'] ?></td>
                    <td><?php echo $ev['il'] ?></td>
                    <td><?php echo $ev['ilce'] ?></td>
                    <td><?php echo $ev['adres'] ?></td>
                    <td><?php echo $ev['m2'] ?></td>
                    <td><?php echo $ev['odasayisi'] ?></td>
                    <td><?php echo $ev['durum'] ?></td>
                    <td>
                        <a href="evozellikleri.php">
                            <button type="submit" class="btn btn-secondary">Evi İncele
                            </button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
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