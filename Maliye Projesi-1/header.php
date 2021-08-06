<?php require_once("front-end/connect_front/DBControllerf.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>

    <link rel="stylesheet" href="front-end/public/css/style.css">
    <link rel="stylesheet" href="front-end/public/css/animate.css">
    <link rel="stylesheet" type="text/css"
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid bg-white row">
    <div class="col-md-7 contrast">
        <img src="front-end/public/img/LOGO.png"
             style="margin-top : -40px ;height: 180px" class="rounded ml-2" id=" ">
    </div>
        <div class="col-md-1" style="margin-top: 50px">
                <a href="evListele.php" class="list-group-item">EMLAK & KONUT</a>
        </div>
    <div class="col-md-1" style="margin-top: 50px">
    <a href="arsaListele.php" class="list-group-item"> ARSA</a>
    </div>
    <div class="col-md-1" style="margin-top: 50px">
    <a href="arabaListele.php" class="list-group-item"> VASITA </a>
    </div>
    <div class="col-md-2 dropdown m-auto">
        <?php if($_SESSION['kisi_giris_adi']==null){ ?>
            <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    GİRİŞ YAP
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="login.php">Üye Girişi</a>
                    <a class="dropdown-item" href="kayitol.php">Üye Ol</a>
                </div>
            </div>
        <?php } else{ ?>
        <h2>Hoş Geldin, <?php echo $_SESSION['kisi_giris_adi']; ?></h2>
            <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">İŞLEMLERİM</button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="varlikListele.php">Mal Varlıklarımı Görüntüle</a>
                    <a class="dropdown-item" href="ilanIslemleri.php">İlan İşlemleri</a>
                    <a class="dropdown-item" href="logout.php">Çıkış Yap</a>
                </div>
            </div>
        <? } ?>
    </div>
</div>
</body>

