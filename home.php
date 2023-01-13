<?php
include 'lib/func.php';
$veri = blogList();
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
			transition-duration: 1s;
			border-radius: 10px;
			background-color: rgb(102,102,102,0.5);
			transform: scale(0.99);
			overflow: hidden;
			
		}
		.kart:hover{
			text-decoration: none;
			color: white;
			transform: scale(0.8);
			transition-duration: 1s;
		}

		.kart:hover .resim{
			transform: scale(4);
		}

		.kart:hover .yazi,.kart:hover .baslik{
			transform: scale(0.8);
			transition-duration: 1s;
		}

		.kart .resim{
		    border-radius: 5px;
			background-size: cover;
  			transition: transform 1s, filter .5s ease-out;
		}

		.kart .yazi{
			color: black;
			overflow:hidden;
			transition-duration: 1s;

		}
		.kart .baslik{
			color: black;
			overflow: hidden;
			transition-duration: 1s;

		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row p-2">
			<?php
				while ($row = $veri['data']->fetch_assoc()) {
				
					


					echo "
					<a href='blog.php?id=".$row['id']."' class='col-md-6 p-1 kart text-wrap'>
						<div class='row p-0 m-0'>
							<div class='col-md-5 resim 'style='background-image:url(admin/".$row['resim'].");'></div>
							<div class='col-md-6'>
								<div class='col-md-6 fs-2 text-center baslik w-100'>".$row['baslik']."</div>
								<p class='fs-6 yazi text-break'>".substr($row['yazi'], 0,30)."...</p>
							</div>
						</div>
					</a>";
				}
			?>
		</div>
	</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>