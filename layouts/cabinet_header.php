<!DOCTYPE html>
<html>

<head>
    <title>Cabinet</title>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/ckeditor.js"></script>
        <link rel="stylesheet" href="<?= URL ?>/css/cabinet.css">
        <link rel="stylesheet" href="<?= URL ?>/css/users.css">
        </link>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </head>
</head>

<body>
    <?php
    session_start();
    require_once('config/db.php');
    if (!isset($_SESSION['id'])) {
        echo '<script>console.log("error")</script>';
        echo '<script>window.location.href = "/cabinet/login";</script>';
    }
    require_once('pages_cabinet/assets/adminHeader.php');
    require_once('pages_cabinet/assets/sidebar.php');
    ?>