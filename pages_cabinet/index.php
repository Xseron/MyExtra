<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(E_ERROR | E_PARSE);
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cabinet</title>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= URL ?>/css/style.css">
        <link rel="stylesheet" href="<?= URL ?>/css/users.css">
        </link>
    </head>
</head>

<body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<?php
require_once('./assets/adminHeader.php');
require_once('./assets/sidebar.php');
?>
</body>