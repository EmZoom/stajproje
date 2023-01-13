<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Cengiz Delibaşı">
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

          <div>
            <div class="text-center mb-2 display-1">Kayıt ol</div>
          </div>
          <div class="form-outline mb-2">
            <label class="form-label required" for="kullanici_mail">Mail Adresi *</label>
            <input type="email" id="kullanici_mail" class="form-control form-control-lg" />
          </div>
          <div class="form-outline mb-2">
            <label class="form-label" for="kullanici_adi"> Ad Soyad</label>
            <input type="email" id="kullanici_adi" class="form-control form-control-lg" />
          </div>
          <div class="form-outline mb-2">
            <label class="form-label" for="kullanici_sifre">Şifre</label>
            <input type="password" id="kullanici_sifre" placeholder="Şifre" class="form-control form-control-lg" />
          </div>
          <div class="form-outline mb-2">
            <label class="form-label" for="kullanici_tsifre">Tekrar Şifre</label>
            <input type="password" id="kullanici_tsifre" placeholder="Şifre" class="form-control form-control-lg" />
          </div>
          <div class="d-flex justify-content-around align-items-center mb-4">
            <a href="login.php">Hesabınız varsa giriş yapın.</a>
          </div>
          <div class="w-100 text-center mb-2">
            <button class="btn btn-primary btn-lg btn-block" id="btnClick">Giriş yap</button>
          </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  function MailKontrol(mail){
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
        {
        return (true)
         }
        return (false)
  }


$("#btnClick").click(function(){
    var kullanici_mail = $('#kullanici_mail').val();
    var kullanici_adi = $('#kullanici_adi').val();
    var kullanici_sifre = $('#kullanici_sifre').val();
    var kullanici_tsifre = $('#kullanici_tsifre').val();

    

    if (MailKontrol(kullanici_mail) == false){
        swal('HATA','mail adresi yanlıs','warning');
        return false;
    }
    else{
        $.ajax({

            type: 'POST',
            url: "postkontrol.php",
            data: {
               mail: kullanici_mail,
               ad: kullanici_adi,
               sifre: kullanici_sifre,
               tsifre: kullanici_tsifre,
               'cmd':'register'
            },
            success: function (response) {
                var response = JSON.parse(response);
                if(response.status == 'error'){
                    swal('HATA',response.message,'warning');
                    
                }
                else if(response.status == 'ok'){
                    //swal('BAŞARI',response.message,'success');
                    swal({
                      title: 'BAŞARI',
                      text: response.message,
                      type: 'success'
                      }).then(function() {
                        window.location = "login.php";
                      });
                }
            }
        });
    }
});
</script>
  
  </body>
</html>