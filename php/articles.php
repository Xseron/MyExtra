<?php
    require_once('../config/db.php');

    if (isset($_GET['type']) && $_GET['type'] == "get-from-chapter") {
        $chapter_name = $_GET['chaper'];
        $result = mysqli_query($link, "SELECT articles.header, articles.body, chapters.name, chapters.subject, articles.time FROM `articles`
                                        INNER JOIN chapters on chapters.id = articles.chapter_id
                                        WHERE chapters.name = {$chapter_name}");
        $res = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($res, $row);
        }
        print_r(json_encode($res));
    }

    if (isset($_GET['type']) && $_GET['type'] == "get-from-subject") {
        $subject = $_GET['subject'];
        $result = mysqli_query($link, "SELECT articles.header, articles.body, chapters.name, chapters.subject FROM `articles`
                                        INNER JOIN chapters on chapters.id = articles.chapter_id
                                        WHERE chapters.subject = {$subject}");
        $res = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($res, $row);
        }
        print_r(json_encode($res));
    }

    if (isset($_GET['type']) && $_GET['type'] == "get") {
        $result = mysqli_query($link, "SELECT articles.id, articles.header, articles.body, chapters.name, chapters.subject FROM `articles`
                                        INNER JOIN chapters on chapters.id = articles.chapter_id
                                        ORDER BY articles.time DESC");
                                        
        $res = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($res, $row);
        }
        print_r(json_encode($res));
    }

    if (isset($_GET['type']) && $_GET['type'] == "get-from-text") {
        $text = isset($_GET['text']);
        $result = mysqli_query($link, "SELECT articles.id, articles.header, articles.body, chapters.name, chapters.subject FROM `articles`
                                        INNER JOIN chapters on chapters.id = articles.chapter_id
                                        ORDER BY articles.time DESC");
        $res = array();
        while ($row = mysqli_fetch_assoc($result)) {
            if (strpos($row['header'], $text) !== false) {
                array_push($res, $row);
            }
        }
        print_r(json_encode($res));
    }

    else if(isset($_GET['type']) && $_GET['type'] == "add"){
        $header = $_POST['header'];
        $body = mysqli_real_escape_string($link, $_POST['body']);
        $chapter = $_POST['chapter'];
        $subject = $_POST['subject'];
        $time = intval($_POST['time']);
        $result = mysqli_query($link, "SELECT id FROM chapters WHERE name='$chapter' and subject='$subject'");
        $chapter_id = mysqli_fetch_assoc($result)['id'];
        $result = mysqli_query($link, " INSERT INTO articles(header,body,chapter_id,time) VALUES ('$header','$body', $chapter_id, $time);");
        if ($result) {
            $last_id = mysqli_insert_id($link);
        } else {
            echo "Error: " . mysqli_error($link);
        }
        $tags = $_POST['tags'];
        $tag_array = explode(';', $tags);

        foreach ($tag_array as $tag) {
            if($tag!=""){
                mysqli_query($link, "INSERT INTO articles_tags(article_id, tag_name) VALUES ('$last_id', '$tag');");
            }
        }
    }

    else if(isset($_GET['type']) && $_GET['type'] == "save"){
        $id = $_GET['id'];
        $header = $_POST['header'];
        $body = mysqli_real_escape_string($link, $_POST['body']);
        $chapter = $_POST['chapter'];
        $subject = $_POST['subject'];
        $time = intval($_POST['time']);
        $result = mysqli_query($link, "DELETE FROM articles_tags WHERE article_id='$id'");
        $tags = $_POST['tags'];
        $tag_array = explode(';', $tags);

        foreach ($tag_array as $tag) {
            if($tag!=""){
                echo "INSERT INTO articles_tags(article_id, tag_name) VALUES ('$id', '$tag');";
                mysqli_query($link, "INSERT INTO articles_tags(article_id, tag_name) VALUES ('$id', '$tag');");
            }
        }
        $result = mysqli_query($link, "SELECT id FROM chapters WHERE name='$chapter' and subject='$subject'");
        $chapter_id = mysqli_fetch_assoc($result)['id'];
        echo "UPDATE articles SET header='$header',body='$body',chapter_id=$chapter_id WHERE id='$id'";
        $result = mysqli_query($link, "UPDATE articles SET header='$header',body='$body',chapter_id=$chapter_id WHERE id='$id'");
        echo "$subject";
    }

    else if(isset($_GET['type']) && $_GET['type'] == "delete"){
        $id = $_GET['id'];
        $query = mysqli_query($link, "DELETE FROM `articles` WHERE id = {$id};") or die("ERROR CONNECTION TO DB!!! #1");
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
        $host = $_SERVER['HTTP_HOST'];
        $url = $protocol . $host;
        echo '<script>window.location.href = "'.$url.'/cabinet";</script>';
    }
?>
