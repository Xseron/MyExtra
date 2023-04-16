<?php 
    session_start();
    $_SESSION['loggedin'] = 'false';
    unset($_SESSION['id']);
    if(!isset($_GET['cabinet'])){
        echo '<script>window.location.href = "/";</script>';
    }else{
        echo '<script>window.location.href = "/cabinet";</script>';
    }
?>
<!-- <script>window.location.href = "../";</script> -->