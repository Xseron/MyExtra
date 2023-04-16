<?php 
    require_once('../config/db.php');
    session_start();
    $name = $_POST['form-login'];
    $password = $_POST['form-password'];
    $result = mysqli_query($link, "SELECT * FROM `users` WHERE name = '{$name}' AND password = '{$password}'");
    $num = mysqli_num_rows($result);
    if($num>0){ 
        session_regenerate_id();
        $_SESSION['loggedin'] = 'true';
        $_SESSION['id'] = mysqli_fetch_assoc($result)['id'];
    } 
    if(!isset($_GET['cabinet'])){
        echo '<script>window.location.href = "/";</script>';
    }else{
        echo '<script>window.location.href = "/cabinet";</script>';
    }
?>