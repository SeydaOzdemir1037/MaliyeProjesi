<?php
include "header.php";

require_once("front-end/connect_front/ArsaControllerf.php");
$arsacont = new ArsaControllerf();

require_once("front-end/connect_front/KisiControllerf.php");
$kisicont = new KisiControllerf();
$kisiler = $kisicont->kisileriGetir();

require_once("front-end/connect_front/IlControllerf.php");

$ilcont = new IlControllerf();
$iller = $ilcont->illeriGetir();

require_once("front-end/connect_front/IlceControllerf.php");

$ilcecont = new IlceControllerf();
$ilceler = $ilcecont->ilceleriGetir();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kisi_ad = trim($_POST["kisi_ad"]);
    $kisi_soyad = trim($_POST["kisi_soyad"]);
    $parsel = trim($_POST["parsel"]);
    $il = trim($_POST["il_id"]);
    $ilce = trim($_POST["ilce_id"]);

    $message = "";
    $arsalar = $arsacont->arsaAra($kisi_ad, $kisi_soyad, $parsel, $il, $ilce);
    if (count($arsalar) > 0) {
        $message = count($arsalar) . " sonuç bulundu.";
    } else {
        $message = "Sonuç bulunamadı";
    }
} else {
    $arsalar = $arsacont->arsalariGetir();
}

?>

?>
<div class="row container-fluid" style="margin-top:20px ; margin-left:30px ; margin-right:30px">
    <div class="card col-md-2 shadow3"style=" background-color: #cce5ff ">
        <div class="alert" style="background-color: #9fcdff "> <?php echo $message; ?> </div>
        <form action="arsaListele.php" method="POST">
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
                <label for="">Parsel</label>
                <input type="text" class="form-control" name="parsel" id="parsel"
                       placeholder="Parsel değeri giriniz..">
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

            <div align="right">
                <button type="submit" class="btn btn-secondary">Ara</button>

            </div>
        </form>
    </div>

    <div class="col-md-9 shadow4" >

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr style="background-color:powderblue">
                <th style="color: darkmagenta">S.No</th>
                <th style="color: darkmagenta">Kişi Ad</th>
                <th style="color: darkmagenta">Kişi Soyad</th>
                <th style="color: darkmagenta">Parsel</th>
                <th style="color: darkmagenta">İl</th>
                <th style="color: darkmagenta">İlçe</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $say = 0;
            foreach ($arsalar as $arsa) {
                $say++ ?>
                <tr style="background-color:aliceblue">
                    <td><?php echo $say; ?></td>
                    <td><?php echo $arsa['kisi_ad'] ?></td>
                    <td><?php echo $arsa['kisi_soyad'] ?></td>
                    <td><?php echo $arsa['parsel'] ?></td>
                    <td><?php echo $arsa['il'] ?></td>
                    <td><?php echo $arsa['ilce'] ?></td>
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
