<?php
include "header.php";
require_once("../connect/KisiController.php");

$kisicont = new KisiController();


$message = "";
if ($_GET['sil']) {
    $id = $_GET['sil'];
    $flag = $kisicont->kisiSil($id);

    if ($flag) {
        $message = "Silindi..";
    } else {
        $message = "Silinemedi!";
    }
}
$kisiler = $kisicont->kisileriGetir();
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-users-cog mr-1" style="font-size:30px; color: orange"></i>
                    Kişiler
                    <a href="kisiEkle.php" style="float: right">
                        <button class="btn btn-dark" style="font-style: italic">Yeni Kişi Ekle</button>
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
                                <th style="color: darkmagenta">Ad</th>
                                <th style="color: darkmagenta">Soyad</th>
                                <th style="color: darkmagenta">İl</th>
                                <th style="color: darkmagenta">İlçe</th>
                                <th style="color: darkmagenta">TC Kimlik No</th>
                                <th></th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $say = 0;
                            foreach ($kisiler as $kisi) {
                                $say++ ?>
                                <tr>
                                    <td><?php echo $say ?></td>
                                    <td><?php echo $kisi['kisi_ad'] ?></td>
                                    <td><?php echo $kisi['kisi_soyad'] ?></td>
                                    <td><?php echo $kisi['il'] ?></td>
                                    <td><?php echo $kisi['ilce'] ?></td>
                                    <td><?php echo $kisi['tc_no'] ?></td>
                                    <td>
                                        <center><small>
                                                <a href="kisiDuzenle.php?id=<?php echo $kisi['id'] ?>">
                                                    <button class="btn btn-primary"
                                                            style="background-color: palevioletred">Düzenle
                                                    </button>
                                                </a>
                                            </small></center>
                                    </td>
                                    <td>
                                        <center><small>
                                                <a href="kisiler.php?sil=<?php echo $kisi['id'] ?>">
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
<?php include "footer.php"; ?>


