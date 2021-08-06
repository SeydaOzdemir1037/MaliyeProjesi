<?php include "header.php";

require_once("front-end/connect_front/EvControllerf.php");
$evcont = new EvControllerf();
$evler = $evcont->kisiEvleri($_SESSION['id']);

require_once("front-end/connect_front/ArabaControllerf.php");
$carcont = new ArabaControllerf();
$arabalar = $carcont->kisiAraba($_SESSION['id']);

require_once("front-end/connect_front/ArsaControllerf.php");
$arsacont = new ArsaControllerf();
$arsalar = $arsacont->kisiArsa($_SESSION['id']);


$message = "";
if ($_GET['evSil']) {
    $id = $_GET['evSil'];
    $flag = $evcont->evSil($id);

    if ($flag) {
        $message = "Silindi..";
    } else {
        $message = "Silinemedi!";
    }
}

$message = "";
if ($_GET['arabaSil']) {
    $id = $_GET['arabaSil'];
    $flag = $carcont->arabaSil($id);

    if ($flag) {
        $message = "Silindi..";
    } else {
        $message = "Silinemedi!";
    }
}


$message = "";
if ($_GET['arsaSil']) {
    $id = $_GET['arsaSil'];
    $flag = $arsacont->arsaSil($id);

    if ($flag) {
        $message = "Silindi..";
    } else {
        $message = "Silinemedi!";
    }
}
$evler = $evcont->kisiEvleri($_SESSION['id']);
$arabalar = $carcont->kisiAraba($_SESSION['id']);
$arsalar = $arsacont->kisiArsa($_SESSION['id']);

?>

<div class="container-fluid mt-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#evler" data-toggle="tab" class="nav-link active" aria-expanded="true">EVLERİM</a>
        </li>
        <li class="nav-item">
            <a href="#arabalar" data-toggle="tab" class="nav-link" aria-expanded="false">ARABALARIM</a>
        </li>
        <li class="nav-item">
            <a href="#arsalar" data-toggle="tab" class="nav-link" aria-expanded="false">ARSALARIM</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="evler" aria-expanded="true">
            <div class="container-fluid mt-5">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div style="font-style: italic;font-size: 30px" class="card-header">
                            <i style="font-size: 30px" class="fa fa-home mr-1"></i>
                            EVLERİM
                            <a style="float: right" href="evEkle.php">
                                <button class="btn btn-success">Yeni Ev Ekle</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Durum</th>
                                        <th>Adres</th>
                                        <th>m²</th>
                                        <th>İl</th>
                                        <th>İlçe</th>
                                        <th></th>
                                        <th></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $say = 0;
                                    foreach ($evler as $ev) {
                                        $say++ ?>
                                        <tr>
                                            <td><?php echo $say ?></td>
                                            <td><?php echo $ev['durum'] ?></td>
                                            <td><?php echo $ev['adres'] ?></td>
                                            <td><?php echo $ev['m2'] ?></td>
                                            <td><?php echo $ev['il'] ?></td>
                                            <td><?php echo $ev['ilce'] ?></td>
                                            <td width="200px">
                                                <center><small>
                                                        <a href="">
                                                            <button class="btn btn-dark btn-sm">Evi Gör</button>
                                                        </a>
                                                    </small>

                                                    <small>
                                                        <a href="evDuzenle.php?id=<?php echo $ev['id'] ?>">
                                                            <button class="btn btn-dark btn-sm">Düzenle</button>
                                                        </a>
                                                    </small>

                                                    <small>
                                                        <a href="varlikListele.php?evSil=<?php echo $ev['id'] ?>">
                                                            <button class="btn btn-dark btn-sm">Sil</button>
                                                        </a>
                                                    </small></center>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle btn-sm"
                                                            type="button"
                                                            id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        İlan Ver
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="">Satılık</a>
                                                        <a class="dropdown-item" href="">Kiralık</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane " id="arabalar" aria-expanded="true">
            <div class="container-fluid mt-5">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div style="font-style: italic;font-size: 30px" class="card-header">
                            <i style="font-size: 30px" class="fa fa-car mr-1"></i>
                            ARABALARIM
                            <a style="float: right" href="arabaEkle.php">
                                <button class="btn btn-success">Yeni Araba Ekle</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Marka</th>
                                        <th>Yil</th>
                                        <th>Km</th>
                                        <th></th>
                                        <th></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $say = 0;
                                    foreach ($arabalar as $araba) {
                                        $say++ ?>
                                        <tr>
                                            <td><?php echo $say ?></td>
                                            <td><?php echo $araba['marka'] ?></td>
                                            <td><?php echo $araba['yil'] ?></td>
                                            <td><?php echo $araba['km'] ?></td>

                                            <td width="200px">
                                                <center><small>
                                                        <a href="">
                                                            <button class="btn btn-dark btn-sm">Aracı Gör</button>
                                                        </a>
                                                    </small>

                                                    <small>
                                                        <a href="arabaDuzenle.php?id=<?php echo $araba['id']?>">
                                                            <button class="btn btn-dark btn-sm">Düzenle</button>
                                                        </a>
                                                    </small>

                                                    <small>
                                                        <a href="varlikListele.php?arabaSil=<?php echo $araba['id'] ?>">
                                                            <button class="btn btn-dark btn-sm">Sil</button>
                                                        </a>
                                                    </small></center>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle btn-sm"
                                                            type="button"
                                                            id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        İlan Ver
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="">Satılık</a>
                                                        <a class="dropdown-item" href="">Kiralık</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane " id="arsalar" aria-expanded="true">
            <div class="container-fluid mt-5">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div style="font-style: italic;font-size: 30px" class="card-header">
                            <i style="font-size: 30px" class="fa fa-truck mr-1"></i>
                            ARSALARIM
                            <a style="float: right" href="arsaEkle.php">
                                <button class="btn btn-success">Yeni Arsa Ekle</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Adres</th>
                                        <th>Parsel</th>
                                        <th>İl</th>
                                        <th>İlçe</th>
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
                                            <td><?php echo $say ?></td>
                                            <td><?php echo $arsa['adres'] ?></td>
                                            <td><?php echo $arsa['parsel'] ?></td>
                                            <td><?php echo $arsa['il'] ?></td>
                                            <td><?php echo $arsa['ilce'] ?></td>


                                            <td width="250px">
                                                <center><small>
                                                        <a href="">
                                                            <button class="btn btn-dark btn-sm">Arsayı Gör</button>
                                                        </a>
                                                    </small>

                                                    <small>
                                                        <a href="arsaDuzenle.php?id=<?php echo $arsa['id'] ?>">
                                                            <button class="btn btn-dark btn-sm">Düzenle
                                                            </button>
                                                        </a>
                                                    </small>

                                                    <small>
                                                        <a href="varlikListele.php?arsaSil=<?php echo $arsa['id'] ?>">
                                                            <button class="btn btn-dark btn-sm">Sil</button>
                                                        </a>
                                                    </small></center>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle btn-sm"
                                                            type="button"
                                                            id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        İlan Ver
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="">Satılık</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

