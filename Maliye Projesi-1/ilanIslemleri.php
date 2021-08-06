<?php include 'header.php';

?>

<div class="row container-fluid" style="margin-top: 100px ; margin-left: 100px">
    <div class="card" style="width:300px">
        <img class="card-img-top" src="front-end/public/img/ev1.png" alt="Card image">
        <div class="card-img-overlay">
            <h4 class="card-title"><?php echo $_SESSION['kisi_giris_adi'] ?></h4>
            <p class="card-text"><?php echo $_SESSION['id'] ?></p>
            <a href="#" class="btn btn-primary">See Profile</a>
        </div>
    </div>

    <div class="card" style="width:300px">
        <img class="card-img-top" src="front-end/public/img/ev1.png" alt="Card image">
        <div class="card-img-overlay">
            <h4 class="card-title"><?php echo $_SESSION['kisi_giris_adi'] ?></h4>
            <p class="card-text"><?php echo $_SESSION['id'] ?></p>
            <a href="#" class="btn btn-primary">See Profile</a>
        </div>
    </div>


</div>
