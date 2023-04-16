<?php   
        $time=time();
        $db = true;
        $show_system = false;
        $gzip = true;
        $functions = true;

        if($db){
                $user="root";
                $password="OOcrcP1P4nt**";
                $database="knowledgebase";
                $host="localhost:3306";
                // $user="u1264_base1";
                // $password="mxMo25%13";
                // $database="u1264642_base";
                // $host="localhost:3306";

                $link = mysqli_connect($host, $user, $password, $database);
                if (!$link) {die('Connection error: (' . mysqli_connect_errno() . ') '. mysqli_connect_error());}
        }                  
        mysqli_set_charset($link, "utf8");
?>