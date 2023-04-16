<?php 
    require_once('../config/db.php');
    session_start();
    $id = $_SESSION['id'];
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $url = $protocol . $host;

    if (isset($_GET['type']) && $_GET['type'] == "get") {
        $result = mysqli_query($link, "SELECT * FROM `chapters` WHERE chapters.user_id = {$_SESSION['id']}");
        $res = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($res, $row);
        }
        print_r(json_encode($res));
    }
    
    else if(isset($_GET['type']) && $_GET['type'] == "set"){
        $name = $_POST['name'];
        $subject = $_POST['subject'];
        $result = mysqli_query($link, " INSERT INTO chapters(name,subject,user_id) VALUES ('$name','$subject','{$id}');");
        echo '<script>window.location.href = "'.$url.'/cabinet/chapters";</script>';
    }

    else if(isset($_GET['type']) && $_GET['type'] == "delete"){
        $id = $_GET['id'];
        $query = mysqli_query($link, "DELETE FROM `chapters` WHERE id = {$id};") or die("ERROR CONNECTION TO DB!!! #1");
        echo '<script>window.location.href = "'.$url.'/cabinet/chapters";</script>';
    }

    else if(isset($_GET['type']) && $_GET['type'] == "save"){
        $id = $_GET['id'];
        $name = $_POST['name'];
        $subject = $_POST['subject'];

        $sql = "UPDATE `chapters` SET name = '{$name}', subject = '{$subject}' WHERE id = {$id}";
        $query = mysqli_query($link, $sql) or die("ERROR CONNECTION TO DB!!! #1");
        echo '<script>window.location.href = "'.$url.'/cabinet/chapters";</script>';
    }
?>