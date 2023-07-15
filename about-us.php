<?php
  // Fetching all the Navbar Data
  require('./includes/nav.inc.php');
?>

<?php
    $titles = array("Founder", "Developers", "Managers", "Designers", "Copywriters");
?>
<section class="py-1 about-us">
    <div class="container">
        <div class="about-us-content">
            <div class="our-team">
                <h2>OUR TEAM</h2>
                <ul>
                    <?php 
                        foreach ($titles as $title) {
                            $memberQuery = "SELECT * FROM members WHERE member_position = '$title'"; 
                            $result = mysqli_query($con, $memberQuery);
                            if (mysqli_num_rows($result) > 0) {
                                echo
                                "<li>
                                    <h3>- $title</h3>
                                    <ul class='member-names'>
                                ";
                                while ($data = mysqli_fetch_assoc($result)) {
                                $member_name = $data['member_name'];
                                $member_id = $data['member_id'];
                                
                                echo "<li><a href='about-us.php?id=$member_id'>$member_name</a></li>";
                                }
                                echo "</ul>
                                </li>";
                        }
                        }
                    ?>
                </ul>
            </div>
            <?php
                if (isset($_GET['id'])) {
                    $memberId = $_GET['id'];
            
                    // Fetch the member's information based on the provided ID
                    $memberQuery = "SELECT * FROM members WHERE member_id = '$memberId'"; 
                    $result = mysqli_query($con, $memberQuery);
            
                    if (mysqli_num_rows($result) > 0) {
                        // Display the member's information
                        $data = mysqli_fetch_assoc($result);
                        $member_name = $data['member_name'];
                        $member_title = $data['member_title'];
                        $member_desc = $data['member_desc'];
                        $member_photo = $data['member_photo'];
                    }
                    echo 
                    "
                    <div class='member-info'>
                        <div class='member-abstract'>
                            <img src='assets/images/category/Courses1685039166.png' alt='$member_name'>
                            <h2>$member_name</h2>
                            <h4>$member_title</h4>
                            <h5>$member_desc</h5>
                        </div>
                        <p><b>Описание деятельности в проекте.</b> Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam corrupti iusto quasi itaque? Distinctio, quod.</p>
                        <p><b>Статистика.</b> Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam corrupti iusto quasi itaque? Distinctio, quod.</p>
                        <ul>
                            <h4>Related works</h4>
                        </ul>
                        <a>Контакт в соцсетях</a>
                        <a>Поделиться ссылкой</a>
                        <a>Создать PDF</a>
                    </div>
                    ";
                }
                else {
                    echo "<div class='members'>";
                    $titles = array("Founder", "Developers", "Managers", "Designers", "Copywriters");
                    foreach ($titles as $title) {
                        $memberQuery = "SELECT * FROM members WHERE member_position = '$title'"; 
                        $result = mysqli_query($con, $memberQuery);
                        if (mysqli_num_rows($result) > 0) {
                            echo "<h2>$title</h2>
                                    <ul>";
                            while ($data = mysqli_fetch_assoc($result)) {
                                $member_name = $data['member_name'];
                                $member_title = $data['member_title'];
                                $member_desc = $data['member_desc'];
                                $member_photo = $data['member_photo'];
                                
                                echo "<li class='member-abstract'>
                                        <img src='assets/images/category/Courses1685039166.png' alt='$member_name'>
                                        <h2>$member_name</h2>
                                        <h4>$member_title</h4>
                                        <h5>$member_desc</h5>
                                    </li>";
                            }
                            
                            echo "</ul>";
                    }
                    }

                }
            ?>
        </div>
    </div>
</section>

<script src="assets/js/list-opener.js"></script>
<?php

  // Fetching all the Footer Data
  require('./includes/footer.inc.php');
?>