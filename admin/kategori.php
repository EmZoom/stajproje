<?php
 include '../lib/func.php';
 $a = 2;
 $veri = kategoriList($a);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="assets/func.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 border">
            <div class="text-center">Yeni kategori ekle:</div>
            <div class="form-floating my-2 col-6 m-auto">
                <input type="text" class="form-control" id="kategoriad" name="kategoriad" placeholder="Kategori Adi">
                 <label>Kategori Adı</label>
            </div>
            <div class="col-6 w-100 text-center">
                <div class="form-check-label">Aktif mi:</div>
                <div class="form-check form-switch d-flex justify-content-center">  
                    <input class="form-check-input" type="checkbox" id="aktifmi" name="aktifmi" checked>
                </div>
            </div>
            <br>
            <div class="w-100 text-center">
                <a href="#" type="submit" id="kaydet" class="btn btn-secondary  btn-sm">Kategori Ekle</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row kat">
                <?php
                    while ($row = $veri['data']->fetch_assoc()) {
                        $a = "";
                        if($row['aktif_mi'] == 1)
                        {
                            $a= "checked";
                        }
                        if(strlen($row['baslik']) > 10)
                        { 
                            $yazi = substr($row['baslik'], 0,10);
                            $param = $yazi . "..";
                        }
                        else{
                            $param = $row['baslik'];
                        }
                        echo "<div id='katSil".$row['id']."' style='display: flex'><div class='col-md-4 my-2' id='divText".$row['id']."' title='".$row['baslik']."'>".$param. "</div>
                            <div class='col-md-4'>
                            <div class='form-check form-switch'>
                            <input class='form-check-input aktif_mi' type='checkbox' data-id='".$row['id']."' id='aktif_mi' name='aktif_mi' ".$a.">
                            </div>
                            </div>
                            <div class='col-md-2'><button data-id='".$row['id']."' class='btn btn-danger' id='duzenle'>Düzenle</button></div>
                            <div class='col-md-2'><button id='delete' data-id='".$row['id']."' class='btn btn-danger'>Sil</button></div></div>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Kategoriyi Düzenle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <div class="fs-5">Kategorinin ismini değiştir:<br><br></div>
            <input type="text" name="degistir" id="degistir" value="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">İptal</button>
        <button type="button" class="btn btn-success" id="degis">Değiştir</button>
      </div>
    </div>
  </div>
</div>

<script>
    $("#kaydet").click(function(){
    var kategori = $('#kategoriad').val();
    var dataid = $('input[id^="aktif_mi"]').attr("data-id");
    var checkBox = document.getElementById("aktifmi");

    if (checkBox.checked == true){
        var aktif = 1;
    } else {
        var aktif = 0;
    }

    let text = kategori;
    let length = text.length;
    if (length < 2){
        swal('HATA','Minimum iki karakter sınırını geçmediniz','warning');
    }
    else if(length > 18){
        swal('HATA','Maksimum karakter sınırını aştınız','warning');

    }else{
        $.ajax({
          
          type: 'POST',
          url: "blogcontrol.php",
          data: {
             kategori: kategori,
             aktif: aktif,
             'cmd':'kategoriekle'
          },
          success: function (response) {
              var response = JSON.parse(response);
              if(response.status == 'error'){
                  swal('HATA',response.message,'warning');
              }
              else if(response.status == 'ok'){
                  swal('BAŞARI',response.message,'success');
                  $(".kat").append("<div id='katSil"+response.data+"' style='display: flex'><div class='col-md-4 "
                    +"my-2' id='divText"+response.data+"' title='"+kategori+"'>"+kategori+"</div> <div "
                    +"class='col-md-4'> <div class='form-check form-switch'> <input "
                    +"class='form-check-input aktif_mi' type='checkbox' data-id='"+response.data+"' "
                    +"id='aktif_mi' name='aktif_mi' checked=''> </div> </div> <div "
                    +"class='col-md-2'><button data-id='"+response.data+"' class='btn btn-danger' "
                    +"id='duzenle'>Düzenle</button></div> <div class='col-md-2'><button id='delete' "
                    +"data-id='"+response.data+"' class='btn btn-danger'>Sil</button></div></div>");
                    aktifPasif();
              }
          }
      });
    }     
});


$(document).ready(function() {
    aktifPasif();
});

</script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    var editbuttonid="";
    $('button[id^="duzenle"]').click(function(){
        var yazi = $('#divText'+editbuttonid).text();
        editbuttonid = $(this).attr("data-id");
        $("#staticBackdrop").modal('show');
    });

    $('button[id^="degis"]').click(function(){
        $("#staticBackdrop").modal('hide');
        var inputDeger = $('#degistir').val();


        $.ajax({
          
          type: 'POST',
          url: "blogcontrol.php",
          data: {
             kategori_baslik: inputDeger,
             kategori_id: editbuttonid,
             'cmd':'kategoriguncelle'
          },
          success: function (response) {
              var response = JSON.parse(response);
              if(response.status == 'error'){
                  swal('HATA',response.message,'warning');
              }
              else if(response.status == 'ok'){
                $('#divText'+editbuttonid).text(inputDeger);
                  swal('BAŞARI',response.message,'success');
              }
          }
      });
    });


    $('button[id^="delete"]').click(function(){
        deleteid = $(this).attr("data-id");
        console.log(deleteid);

        $.ajax({
          
          type: 'POST',
          url: "blogcontrol.php",
          data: {
             kategori_id: deleteid,
             'cmd':'kategorisil'
          },
          success: function (response) {
              var response = JSON.parse(response);
              if(response.status == 'error'){
                  swal('HATA',response.message,'warning');
              }
              else if(response.status == 'ok'){
                $( "#katSil"+deleteid ).hide( 1000 );

                swal('BAŞARI',response.message,'success');
              }
          }
      });
    });
});

</script>
</body>
</html>