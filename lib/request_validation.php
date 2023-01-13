<?php 
function loginRequest($data){

  $responseArr = array('status'=> 'error', 'message' => '');

  if (strlen($data['mail']) < 4){
    $responseArr['message'] = 'Mail adresi en az 4 karakter olmalıdır.';
  }
  else if(strlen($data['sifre']) < 4){
    $responseArr['message'] = 'Şifreniz en az 4 karakter olmalıdır.';
  }
  else if (filter_var($data['mail'], FILTER_VALIDATE_EMAIL) == false ){
    $responseArr['message'] = 'Mail adresi doğrulanamadı.';
  }
  else{
    $responseArr['status'] = 'ok';
  }

  return $responseArr;

}

function registerRequest($data){

  $responseArr = array('status'=> 'error', 'message' => '');

  if (strlen($data['mail']) < 4){
    $responseArr['message'] = 'Mail adresi en az 4 karakter olmalıdır.';
  }
  else if(strlen($data['ad']) < 5){
    $responseArr['message'] = 'Kullanıcı adı en az 6 karakter olmalıdır.';
  }
  else if(strlen($data['sifre']) < 4){
    $responseArr['message'] = 'Şifreniz en az 4 karakter olmalıdır.';
  }
  else if (filter_var($data['mail'], FILTER_VALIDATE_EMAIL) == false ){
    $responseArr['message'] = 'Mail adresi doğrulanamadı.';
  }
  else if($data['tsifre'] != $data['sifre']){
    $responseArr['message'] = 'Şifreleriniz uyuşmuyor.';
  }
  else{
    $responseArr['status'] = 'ok';
  }

  return $responseArr;

}

function blogVal($data){

  $responseArr = array('status'=> 'error', 'message' => '');

  if (strlen($data['baslik']) < 4){
    $responseArr['message'] = 'Başlık en az 4 karakter olmalıdır.';
  }
  else if(strlen($data['summernote']) < 20){
    $responseArr['message'] = 'Blog yazısı en az 20 karakter olmalıdır.';
  }
  else{
    $responseArr['status'] = 'ok';
  }

  return $responseArr;

}


function specialCharset($text){
    $text =str_replace("`","",$text);
    $text =str_replace(".","",$text);
    $text =str_replace(",","",$text);
    $text =str_replace("-","",$text);
    $text =str_replace("_","",$text);
    $text =str_replace("=","",$text);
    $text =str_replace("&","",$text);
    $text =str_replace("%","",$text);
    $text =str_replace("!","",$text);
    $text =str_replace("#","",$text);
    $text =str_replace("<","",$text);
    $text =str_replace(">","",$text);
    $text =str_replace("*","",$text);
    $text =str_replace("And","",$text);
    $text =str_replace("'","",$text);
    $text =str_replace("chr(34)","",$text);
    $text =str_replace("chr(39)","",$text);
    $text =htmlspecialchars($text);
    return $text;
}
?>