<?php

$veri = $_POST= [
        'username' => $_POST['username'],
        'password' => $_POST['password']
                    ];


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    print_r($veri);
}
?>