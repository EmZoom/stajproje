<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    $result = array('status' => 'error', 'message' => 'Gönderim methodu yanlıştır.');
    echo json_encode($result);
    exit();
}

include 'lib/request_validation.php';
include 'lib/func.php';
switch ($_POST['cmd']) {
  case 'login':
    $_POST['mail']   = htmlspecialchars($_POST['mail']);
    $_POST['sifre']  = htmlspecialchars($_POST['sifre']);


    $loginRequest = loginRequest($_POST);

    if($loginRequest['status'] != 'ok'){
      $result = $loginRequest;
    }
    else{
      $userResult = login($_POST);
      $result = $userResult;
      }
  break;

  case 'register':

    $_POST['mail']  = htmlspecialchars($_POST['mail']);
    $_POST['ad']    = htmlspecialchars($_POST['ad']);
    $_POST['sifre'] = htmlspecialchars($_POST['sifre']);
    $_POST['tsifre'] = htmlspecialchars($_POST['tsifre']);

    $registerRequest = registerRequest($_POST);
     if($registerRequest['status'] != 'ok'){
      $result = $registerRequest;
    }
    else{
      $userResult = register($_POST);
      $result = $userResult;
      }
  

  break;

  default:
    // code...
    break;
}

  echo json_encode($result);
  exit();

?>