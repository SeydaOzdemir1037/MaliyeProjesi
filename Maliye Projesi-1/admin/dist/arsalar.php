<?php
include "header.php";
require_once("../connect/ArsaController.php");

$arsacont = new ArsaController();


$message = "";
if ($_GET['sil']) {
    $id = $_GET['sil'];
    $flag = $arsacont->arsaSil($id);

    if ($flag) {
        $message = "Silindi..";
    } else {
        $message = "Silinemedi!";
    }
}

$arsalar = $arsacont->arsalariGetir();
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-layer-group mr-1" style="font-size: 30px;font-style: oblique;color:greenyellow"></i>
                    Arsalar
                    <a href="arsaEkle.php" style="float: right">
                        <button class="btn btn-dark" style="font-style: italic">Yeni Arsa Ekle</button>
                    </a>
                </div>
                <?php if ($message != '') { ?>
                    <div class="alert alert-warning"><?php echo $message; ?></div>
                <?php } ?>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th style="color: darkmagenta">S.No</th>
                                <th style="color: darkmagenta">Kişi Ad</th>
                                <th style="color: darkmagenta">Kişi Soyad</th>
                                <th style="color: darkmagenta">Parsel</th>
                                <th style="color: darkmagenta">İl</th>
                                <th style="color: darkmagenta">İlçe</th>
                                <th></th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $say = 0;
                            foreach ($arsalar as $arsa) {
                                $say++ ?>
                                <tr>
                                    <td><?php echo $say; ?></td>
                                    <td><?php echo $arsa['kisi_ad'] ?></td>
                                    <td><?php echo $arsa['kisi_soyad'] ?></td>
                                    <td><?php echo $arsa['parsel'] ?></td>
                                    <td><?php echo $arsa['il'] ?></td>
                                    <td><?php echo $arsa['ilce'] ?></td>
                                    <td>
                                        <center><small>
                                                <a href="arsaDuzenle.php?id=<?php echo $arsa['id'] ?>">
                                                    <button class="btn btn-primary"
                                                            style="background-color: palevioletred">Düzenle
                                                    </button>
                                                </a>
                                            </small></center>
                                    </td>
                                    <td>
                                        <center><small>
                                                <a href="arsalar.php?sil=<?php echo $arsa['id'] ?>">
                                                    <button class="btn btn-danger">Sil</button
                                                </a>
                                            </small></center>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
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

