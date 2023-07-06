<?php
  require('./includes/nav.inc.php');
  
  if(isset($_GET['id'])) {
    $member_id = $_GET['id'];
  }else {
    redirect('./members.php');
  }
  if($member_id == '' || $member_id == null) {
    redirect('./members.php');
  } 

  $sql = "SELECT member_image 
          FROM members 
          WHERE member_id = {$member_id}";
          
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  $member_img = $row['member_image'];
  
  unlink("../assets/images/members/{$member_img}");

  $delete_sql = " DELETE FROM members 
                  WHERE member_id = {$member_id}";
  $cat_result = mysqli_query($con, $delete_sql); 
 
  if($cat_result) {
    redirect('./members.php');
  }
?>


<?php
  require('./includes/footer.inc.php')
?>