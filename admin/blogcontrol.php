<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    $result = array('status' => 'error', 'message' => 'Gönderim methodu yanlıştır.');
    echo json_encode($result);
    exit();
}

include '../lib/func.php';
include '../lib/request_validation.php';
sessionControl();
switch ($_POST['cmd']) {
  case 'sil':
    $result = blogDelete($_POST['blogid']);
  break;
  
  case 'kaydet':
    $resultVal = blogVal($_POST);

    if($resultVal['status'] != 'ok'){
      $result = $resultVal;
    }
    else{
      $result = blogRequest($_POST,$_FILES);
    }
  break;

  case 'guncelle':
    $result = blogUpdate($_POST,$_FILES);
  break;

  case 'kategoriekle':
    $result = kategoriEkle($_POST);
    break;

  case 'kategoriackapa':
    $result = kategoriAcKapa($_POST);
    break;
  
  case 'kategoriguncelle':
    $result = kategoriGuncelle($_POST);
    break;
  case 'kategorisil':
    $result = kategoriSil($_POST);
    break;
  default:
    // code...
    break;
}
  echo json_encode($result);
  exit();

?>