<?php

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

$servername = "localhost";
$username = "root";
$password = "";
$db = "kullanici";

$conn = new mysqli($servername, $username, $password, $db);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM kullanicilar WHERE kullanici_adi='".$_POST['kullanici_adi']."' AND kullanici_sifre='".$_POST['sifre']."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  	session_start($_POST);
    echo "id: " . $row["id"]. " - Name: " . $row["kullanici_adi"]. " " . $row["kullanici_sifre"]. "<br>";
    echo "Hoş geldin " . $_POST['kullanici_adi'] . "<br>";
	  echo "<a href='logout.php'> çıkış </a>";
  }
} else {
  echo "bilgilerin yanlış";
  echo "<br> <a href='login.php'>Giriş Yap</a>";
}
$conn->close();
function  genrateWebInfo(){
    echo '<script type="text/javascript"> ';
    echo 'var websitename = prompt("Please enter your Website Name", "");';
    echo 'alert(websitename);';
    echo '</script>';
}

genrateWebInfo();
?>
