<?php 

include '../lib/func.php';
sessionControl();
$veri = kategoriList();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="assets/func.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<form id="create" method="post" action="blogcontrol.php" enctype="multipart/form-data">
    <div class="container">
        <div class="form-floating my-3">
             <input type="text" class="form-control" id="baslik" name="baslik" placeholder="Başlık" required>
             <label>Başlık</label>
        </div>

        <div class="form-floating mb-3">
            <textarea class="form-control" id="summernote" name="summernote" style="height: 100px"></textarea>
            <label>Yazı</label>
        </div>

        <div class="mb-3">
            <label for="resim" class="form-label">Resim Yükle</label>
            <input class="form-control" type="file" accept="image/png, image/jpeg, image/jpg" id="resim" name="resim">
        </div>

        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="aktif" name="aktif" checked>
            <label class="form-check-label">Aktif</label>
        </div>

        <div class="form-floating">
            <select class="form-select" id="kategori" name="kategori" required>
            <?php
                while($row = $veri['data']->fetch_assoc()){
                    echo "<option value=".$row['id'].">".$row['baslik']."</option>";
                }
             ?>
            </select>
            <label for="floatingSelect">Kategori Seç</label>
        </div>
        <input value="kaydet" name="cmd" type="hidden"></input>
        <button type="submit" class="btn btn-success">Gönder</button>
    </div>
</form>
<script>
      $('#summernote').summernote({
        placeholder: 'Blog yazısı....',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture']],
          ['view', ['fullscreen', 'codeview']]
        ]
      });

    
    
    $("#create").submit(function(event){
        event.preventDefault(); 

        var baslik = $('#baslik').val();
        var yazi = $('#summernote').val();
        if(baslik == ''){
            swal('HATA','Başlık yeri boş.','warning');
            return false;
        }
        else if(yazi == ''){
            swal('HATA','Yazı yeri boş','warning');
            return false;
        }
        else{
            var file         = $('#resim').prop('files')[0];
            var formResponse = formAjaxCall("FORM#create",file);
            if(formResponse.status == 'ok'){
                window.location.href = "adminhome.php?id="+formResponse.data;
                
            }
            else{
                swal('HATA',formResponse.message,'warning');
            }
        } 
    });
    

    
    </script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>