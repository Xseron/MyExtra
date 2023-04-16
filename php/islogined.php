<?php 
    header('Access-Control-Allow-Origin: http://localhost:5500');
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=='true'){ echo "true"; } else { echo "false"; }
?>