<?php

include ('dbconn.php');

function login($data){

	$userResult = array('status' => 'error', 'message' => 'Kullanıcı mail veya şifresi yanlış.');
	$conn = db();

	$sql = "SELECT * FROM kullanicilar WHERE kullanici_mail ='".$data['mail']."' AND kullanici_sifre='".$data['sifre']."'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		

  		while($row = $result->fetch_assoc()) {

			if($row['kullanici_onay'] == 1){
  				$userResult['status'] = 'ok';
				$userResult['message'] = 'Hesabına giriş yaptın!';
				ss();
  				$_SESSION['id']            = $row['id'];
  				$_SESSION['kullanici_adi'] = $row['kullanici_adi'];
  			}

  			else if($row['kullanici_onay'] == 0){
  				$userResult['message'] = 'Kullanıcı onaylanmamıştır lütfen daha sonra tekrar deneyiniz.';
  			}
			
  		}
	}
	$conn->close();
	return $userResult;
}

function register($data)
{
	$conn = db();
		$userResult = array('status' => 'error', 'message' => 'Kullanıcı mail veya şifresi yanlış.aa');

		$sql = "SELECT * FROM kullanicilar WHERE kullanici_mail ='".$data['mail']."'";
		$result = $conn->query($sql);
		
		if ($result->num_rows != 0)
		{
	  		while($row = $result->fetch_assoc())
	  		{
				$userResult['message'] = 'Bu mail adresiyle bir kullanıcı kayıtlı.';
	  		}
		}
		else
		{
			$userResult['status'] = 'ok';
			$userResult['message'] = 'Kayıt başarılı';
			$sql = "INSERT INTO kullanicilar( kullanici_adi, kullanici_sifre, kullanici_mail) 
					VALUES ('".$data['ad']."', '".$data['sifre']."', '".$data['mail']."')";
			//$result = $conn->query($sql);
			if ($conn->query($sql) === TRUE) 
			{
	   			print_r($conn->error);
			}
		}
	$conn->close();
	return $userResult;
}



function sessionControl(){
	ss();
	if(!isset($_SESSION['id']) || $_SESSION['id']== ''){
		logout();
	}
}

function logout(){
	ss();
	session_unset();
	session_destroy();
	header("Location: /staj_masasi/login.php");
}


function ss(){
	if (!isset($_SESSION)) {
		session_start();
	}
}


function blogList(){
	$userResult = array('status' => 'error', 'message' => '', 'data' => '');
	$conn = db();

	$sql = "SELECT * FROM blog WHERE aktif_mi=1 order by id desc";
	$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
			$userResult['data'] = $result;
		}
		else{
			$userResult['message'] = 'yazı yok';
		}
		return $userResult;
}

function blogIdList($id){
	$userResult = array('status' => 'error', 'message' => '', 'data' => '');
	$conn = db();

	$sql = "SELECT * FROM blog WHERE aktif_mi=1 AND id='".$id."'";
	$result = $conn->query($sql);
  		if ($result->num_rows > 0)
		{ 
			$userResult['status'] = 'ok';
			$userResult['data'] = $result;
   		}
  		else if($result->num_rows < 0)
  		{
    		$userResult['status'] = 'yazı yok';
  		}
		return $userResult;
		
}

function blogDelete($id){
	$userResult = array('status' => 'error', 'message' => 'Hata', 'data' => '');
	$conn = db();

	$sql = "DELETE FROM blog WHERE id=".$id;
	
  		if ($conn->query($sql) === TRUE)
		{ 
			$userResult['status'] = 'ok';
			$userResult['message'] = 'Başarılı';
   		}
  		else
  		{
			$userResult['status'] = 'error';
    		$userResult['message'] = 'silinemedi';
  		}
		$conn->close();
		return $userResult;
}

function kategoriList($data){
	$conn = db();
	if($data == 0){
		$veri = "WHERE aktif_mi=0";
	}
	else if($data == 1){
		$veri = "WHERE aktif_mi=1";
	}
	else if($data == 2){
		$veri = "";
	}
	$sql = "SELECT * FROM kategori ".$veri." ORDER BY id ASC";
	$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
			$userResult['data'] = $result;
		}
		else{
			$userResult['message'] = 'yazı yok';
		}
		return $userResult;
}

function blogRequest($data, $img='')
{

	ss();
	if($img != ''){
		$img = imageSave($img);
		if($img['status'] != 'ok') return $img;
	}

	$resim = $img['data'] .".jpg";

	if($data['aktif'] == 'on'){
		$aktif = 1;
	}
	else{
		$aktif = 0;
	}

	$conn = db();
	$userResult = array('status' => 'error', 'message' => '','data'=>'');

	$baslik    = $data['baslik'];
	$yazi      = $data['summernote'];
	$kategori  = $data['kategori'];
	$kullanici = $_SESSION['id'];
	
	$sql = "INSERT INTO blog( kullanici_id,baslik, yazi, resim, aktif_mi,kategori_id) 
			VALUES ('$kullanici', '$baslik', '$yazi', '$resim', '$aktif','$kategori')";

	$result = $conn->query($sql);
	$id     = $conn->insert_id;
	$conn->close();

	if($id>1){
		$userResult['status']  = 'ok';
		$userResult['message'] = 'Kayıt başarılı';
		$userResult['data']    = $id;

	}
	else{
		$userResult['message'] = 'Kayıt hatası oluştu';
	}
	
	return $userResult;
	
}

function imageSave($img){
	ss();
	$sayi = numGen(0,10000);

	$yeni_ad = "assets/img/blog/" . $_SESSION['kullanici_adi'] . $sayi . ".jpg";

	if(move_uploaded_file($_FILES['file']['tmp_name'], $yeni_ad) == true){
		return array('status' => 'ok','data' => 'assets/img/blog/'. $_SESSION['kullanici_adi'] . $sayi);
	}
	else{
		return array('status' => 'error', 'message' => 'Fotoğraf yüklenmedi');
	}

}

function numGen($min, $max){
	$sayi = rand($min, $max);
	return $sayi;
}


function dd($data,$p=0){
	if($p==0){
		var_dump($data);exit();
	}
	else{
		print_r($data);exit();
	}
}

function blogId($id){
	$userResult = array('status' => 'error', 'message' => '', 'data' => '');
	$conn = db();

	$sql = "SELECT * FROM blog WHERE id='".$id."'";
	$result = $conn->query($sql);
  		if ($result->num_rows > 0)
		{ 
			$userResult['status'] = 'ok';
			$userResult['data'] = $result;
   		}
  		else
  		{
    		$userResult['message'] = 'yazı yok';
  		}
		return $userResult;
		
}

function blogUpdate($data, $img='')
{
	$addParam = '';
	$userResult = array('status' => 'error', 'message' => 'İşlem tamamlanamadı!', 'data' => '');
	if(count($img) > 0){
		$img = imageSave($img);
		if($img['status'] != 'ok') return $img; 
		
		$resim    = $img['data'] .".jpg";
		$addParam = ',resim="'.$resim.'"';
	}

	if($data['aktif'] == 'on'){
		$aktif = 1;
	}
	else{
		$aktif = 0;
	}

	$conn = db();
	$baslik    = $data['baslik'];
	$yazi      = $data['summernote'];
	
	$sql = "UPDATE blog SET baslik='$baslik', yazi='$yazi', aktif_mi=$aktif $addParam WHERE id=".$data['id']."";
	$result = $conn->query($sql);
	if ($result == true){
		$userResult['status'] = 'ok';
		$userResult['data'] = $data['id'];
	}
		$conn->close();
	return $userResult;
}

  function turkceDegistir($data) {
    $bul  = array('ç', 'Ç', 'ğ', 'Ğ', 'ı', 'İ', 'ö', 'Ö', 'ş', 'Ş', 'ü', 'Ü');
    $degistir = array('c', 'C', 'g', 'G', 'i', 'I', 'o', 'O', 's', 'S', 'u', 'U');
    $cikanVeri=str_replace($bul, $degistir, $data);
    return $data;
}


function kategoriEkle($data){
	$userResult = array('status' => 'error', 'message' => 'Kategori Eklenemedi');
	$conn = db();

	$bul  = array('ç', 'Ç', 'ğ', 'Ğ', 'ı', 'İ', 'ö', 'Ö', 'ş', 'Ş', 'ü', 'Ü');
    $degistir = array('c', 'C', 'g', 'G', 'i', 'I', 'o', 'O', 's', 'S', 'u', 'U');
    $cslug =str_replace($bul, $degistir, $data['kategori']);
	$slug = strtolower($cslug);
	
	$sql = "SELECT * FROM kategori WHERE baslik='".$data['kategori']."'";
	$resultValid = $conn->query($sql);
	if ($resultValid->num_rows > 0) {
		$userResult['message'] = 'Zaten böyle bir kategori var';
		return $userResult;
	}

	$uzunluk = strlen($data['kategori']);

	if ($uzunluk <= 2){ 
		
		$userResult['status']='error';
		$userResult['message'] = 'Minimum 2 karakter kullanabilirsiniz.';
		return $userResult;
	}

	$sql = "INSERT INTO kategori( baslik, slug, aktif_mi) 
	VALUES ('".$data['kategori']."', '$slug', ".$data['aktif'].")";
	if ($conn->query($sql) === TRUE)
		{ 
			$userResult['status']   = 'ok';
			$userResult['message']  = 'Başarılıyla kategori eklendi';
			$userResult['data']     = $conn->insert_id;
   		}
  		else
  		{
			$userResult['status'] = 'error';
    		$userResult['message'] = 'silinemedi';
  		}
		$conn->close();
		return $userResult;
}

function kategoriAcKapa($data){
	$userResult = array('status' => 'error', 'message' => 'İşlem sırasında hata oluştu');
	$conn = db();
	
	$sql = "UPDATE kategori SET aktif_mi=".$data['aktif']." WHERE id=".$data['dataid']."";
	if ($conn->query($sql) === TRUE)
		{ 
			$userResult['status'] = 'ok';
			$userResult['message'] = 'Kategori güncellenmiştir';
   		}
  		else
  		{
			$userResult['status'] = 'error';
  		}

		$conn->close();
		return $userResult;
}

function kategoriGuncelle($data){
	$userResult = array('status' => 'error', 'message' => 'İşlem sırasında hata oluştu');
	$conn = db();

	$baslik = $data['kategori_baslik'];

	$sql = "SELECT * FROM kategori WHERE baslik='$baslik'";
	$resultValid = $conn->query($sql);
	if ($resultValid->num_rows > 0) {
		$userResult['message'] = 'Zaten böyle bir kategori var';
		return $userResult;
	}

	$uzunluk = strlen($baslik);

	if ($uzunluk <= 2){ 
		
		$userResult['status']='error';
		$userResult['message'] = 'Minimum 2 karakter kullanabilirsiniz.';
		return $userResult;
	}

	$bul  = array('ç', 'Ç', 'ğ', 'Ğ', 'ı', 'İ', 'ö', 'Ö', 'ş', 'Ş', 'ü', 'Ü');
    $degistir = array('c', 'C', 'g', 'G', 'i', 'I', 'o', 'O', 's', 'S', 'u', 'U');
    $cslug =str_replace($bul, $degistir, $data['kategori_baslik']);
	$slug = strtolower($cslug);
	

	$sql = "UPDATE kategori SET baslik='$baslik', slug='$slug' WHERE id=".$data['kategori_id']."";
	if ($conn->query($sql) === TRUE)
		{ 
			$userResult['status'] = 'ok';
			$userResult['message'] = 'Kategori güncellenmiştir';
   		}
  		else
  		{
			$userResult['status'] = 'error';
  		}

		$conn->close();
		return $userResult;
}

function kategoriSil($data){
	$userResult = array('status' => 'error', 'message' => 'Hata', 'data' => '');
	$conn = db();

	$id = $data['kategori_id'];

	$sql = "DELETE FROM kategori WHERE id=$id";
	
  		if ($conn->query($sql) === TRUE)
		{ 
			$userResult['status'] = 'ok';
			$userResult['message'] = 'Başarılıyla Silindi';
   		}
  		else
  		{
			$userResult['status'] = 'error';
    		$userResult['message'] = 'silinemedi';
  		}
		$conn->close();
		return $userResult;
}