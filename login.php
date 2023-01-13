<!doctype html>
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
            <div class="text-center mb-5 display-1">Giriş </div>
          </div>
          <div class="form-outline mb-4">
            <label class="form-label" for="form1Example13">Mail</label>
            <input type="email" id="kullanici_mail" class="form-control form-control-lg" />
          </div>
          <div class="form-outline mb-4">
            <label class="form-label" for="kullanici_sifre">Şifre</label>
            <input type="password" id="kullanici_sifre" placeholder="Şifre" class="form-control form-control-lg" />
          </div>
          <div class="d-flex justify-content-around align-items-center mb-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox"  value="" id="form1Example3"/>
              <label class="form-check-label" for="form1Example3"> Beni hatırla </label>
            </div>
            <a href="register.php">Hesabın yok mu? Kayıt olun.</a>
          </div>
          <div class="w-100 text-center">
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
    var kullanici_sifre = $('#kullanici_sifre').val();

    

    if (MailKontrol(kullanici_mail) == false){
        swal('HATA','Yanlış bir biçimde mail girdiniz. ','warning');
        return false;
    }
    else{
        $.ajax({
          
            type: 'POST',
            url: "postkontrol.php",
            data: {
               mail: kullanici_mail,
               sifre: kullanici_sifre,
               'cmd':'login'
            },
            success: function (response) {
                var response = JSON.parse(response);
                if(response.status == 'error'){
                    swal('HATA',response.message,'warning');
                }
                else if(response.status == 'ok'){
                    window.location.href = "admin/adminhome.php";
                    //swal('BAŞARI',response.message,'success');
                }
            }
        });
    }
});
</script>
  
  </body>
</html>