<?php

header('Content-type: text/html; charset=utf-8');
DEFINE('ROOT', realpath(dirname(__FILE__)));
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['loggedin'])) $_SESSION['loggedin'] = 'false';
include("config/db.php");
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title>База знаний</title>
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=no">
    <!-- <style>body{opacity: 0;}</style> -->
    <link rel="shortcut icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;700&display=swap&_v=20230319185830" rel="stylesheet">
    <!-- <meta name="robots" content="noindex, nofollow"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.min.css?_v=12321">
    <link rel="stylesheet" href="css/search.css?_v=12321">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<?php
    session_start();
    require_once('config/db.php');
    $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    if (!isset($_SESSION['id']) && $url!="/" && $url!="/article") {
        echo '<script>console.log("error'.parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH).'")</script>';
        echo '<script>window.location.href = "/";</script>';
    }
    ?>