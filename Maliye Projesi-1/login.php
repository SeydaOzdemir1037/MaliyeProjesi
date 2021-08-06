<?php
require_once("front-end/connect_front/LoginController.php");
if ($_POST['kisi_giris_adi']) {
    $username = $_POST['kisi_giris_adi'];
    $password = md5($_POST['kisi_sifre']);

    $logincont = new LoginController();
    $logincont->kisiGiris($username, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Admin Page</title>
    <link href="admin/dist/css/styles.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
            crossorigin="anonymous"></script>
</head>
<body class="bg-info">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                            <div class="card-body">
                                <form action="login.php" method="POST">
                                    <div class="form-group">
                                        <label class="small mb-1" id="inputAdi">Kullanıcı Adı</label>
                                        <input class="form-control py-4" id="kisi_id" name="kisi_giris_adi" type="text"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="">Şifre</label>
                                        <input class="form-control py-4" name="kisi_sifre" id="inputPassword"
                                               type="password"/>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="rememberPasswordCheck"
                                                   type="checkbox"/>
                                            <label class="custom-control-label" for="rememberPasswordCheck">Şifreyi
                                                Hatırla</label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button class="btn btn-primary ml-auto" name="" type="submit">Giriş</button>
                                    </div>
                                    <div>
                                        <a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>  
                                            Login via Twitter</a>
                                        <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>
                                              Login via facebook</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="admin/dist/js/scripts.js"></script>
</body>
</html>
