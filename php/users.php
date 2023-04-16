<?php 
    require_once('../config/db.php');
    session_start();
    $id = $_SESSION['id'];
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $url = $protocol . $host;

    if (isset($_GET['type']) && $_GET['type'] == "get") {
        $result = mysqli_query($link, "SELECT * FROM `users` WHERE user_id = {$id}");
        $res = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($res, $row);
        }
        print_r(json_encode($res));
    }
    
    else if(isset($_GET['type']) && $_GET['type'] == "set"){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $result = mysqli_query($link, " INSERT INTO users(name,password) VALUES ('$name','$password');");
        echo '<script>window.location.href = "'.$url.'/cabinet/users";</script>';
    }

    else if(isset($_GET['type']) && $_GET['type'] == "delete"){
        $id = $_GET['id'];
        $query = mysqli_query($link, "DELETE FROM `users` WHERE id = {$id};") or die("ERROR CONNECTION TO DB!!! #1");
        echo '<script>window.location.href = "'.$url.'/cabinet/users";</script>';
    }

    else if(isset($_GET['type']) && $_GET['type'] == "save"){
        $id = $_GET['id'];
        $name = $_POST['name'];
        $password = $_POST['password'];

        $sql = "UPDATE `users` SET name = '{$name}', password = '{$password}' WHERE id = {$id}";
        $query = mysqli_query($link, $sql) or die("ERROR CONNECTION TO DB!!! #1");
        echo '<script>window.location.href = "'.$url.'/cabinet/users";</script>';
    }
?>