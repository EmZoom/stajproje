<?php
include '../lib/func.php';
sessionControl();
$veri = blogList();
$id   = (isset($_GET['id'])) ?  $_GET['id'] : '';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title></title>
	<style>
		.kart{
			text-decoration: none;
			color: white;
			border-radius: 10px;
			background-color: rgb(102,102,102,0.5);
			overflow: hidden;
		}

		.kart:hover .yazi,.kart:hover .baslik{
			transform: scale(0.8);
			transition-duration: 1s;
		}

		.kart .resim{
		    border-radius: 5px;
			background-size: cover;
			background-image: url(https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/K2_8611.jpg/800px-K2_8611.jpg);
		}

		.kart .yazi{
			color: black;
			overflow:hidden;

		}
		.kart .baslik{
			color: black;
			overflow: hidden;
		}

		

	</style>
</head>
<body>
	<p><?=$_SESSION['kullanici_adi']?> Merhaba <?php echo session_id();?></p>

	<a href="/staj_masasi/logout.php" class="btn btn-warning">Çıkış Yap</a>
	<a href="createblog.php" class="btn btn-success ">Yeni blog yazısı ekle</a>
	<a href="kategori.php" class="btn btn-danger ">Kategori</a>

	<div class="container-fluid">
		<div class="row p-2">
			<?php
			while ($row = $veri['data']->fetch_assoc()) {
				
				echo "
				<div class='card' id='card".$row['id']."' style='width: 18rem;'>
  				<img class='card-img-top' src='".$row['resim']."'>
  				<div class='card-body'>
    			<h5 class='card-title'>".$row['baslik']."</h5>
    			<p class='card-text'>".substr($row['yazi'], 0,35)."</p>
				<br>
				<div class='btn-group'>

    			<a target='_blank' href='/staj_masasi/blog.php?id=".$row['id']."' class='btn btn-secondary'>Görüntüle</a>
				<a class='btn btn-warning' href='editblog.php?id=".$row['id']."'>Düzenle</a>
				<button class='btn btn-danger' id='sil' data-id='".$row['id']."'>Sil</button>
  				</div>
				</div>
				</div>";
			}
			?>
		</div>
	</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$(document).ready(function() {

	$('button[id^="sil"]').click(function(){
		var blogid = $(this).attr("data-id");
		$.ajax({

			type: 'POST',
			url: "blogcontrol.php",
			data: {
			blogid: blogid,
			'cmd':'sil'
			},
			success: function (response) {
				var response = JSON.parse(response);
				if(response.status == 'error'){
					swal('HATA',response.message,'warning');
				}
				else if(response.status == 'ok'){
					swal('BAŞARI',response.message,'success');
					$( "div#card"+blogid ).hide( 1000 );
				}
			}
			});
	});

	var getId = '<?=$id?>'; 
	//bu kısa yazımı eşitir echo anlamına geliyor tek değer yazdırcaksan.

	if(getId != ''){
		$('#card'+getId).css("background-color","lime"); 
	}

});
</script>
</body>
</html>