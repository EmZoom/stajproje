<?php
session_start();


?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hello, world!</title>
  </head>
  <body>
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="img/login/login.svg"
          class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form action='postkontrol.php' method='post'>
          <div>
            <div class="text-center mb-5 display-1">CENGİZ</div>
          </div>
          <div class="form-outline mb-4">
            <input type="text" id="form1Example13" name="kullanici_adi" class="form-control form-control-lg" />
            <label class="form-label" for="form1Example13">Kullanıcı Adı</label>
          </div>
          <div class="form-outline mb-4">
            <input type="password" id="form1Example23" name="sifre" class="form-control form-control-lg" />
            <label class="form-label" for="form1Example23">Şifre</label>
          </div>
          <div class="d-flex justify-content-around align-items-center mb-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox"  value="" id="form1Example3"/>
              <label class="form-check-label" for="form1Example3"> Beni hatırla </label>
            </div>
            <a href="#!">Şifreni mi unuttun?</a>
          </div>
          <div class="w-100 text-center">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Giriş yap</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>