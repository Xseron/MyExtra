<!--? ======== FOOTER ======== -->
<footer class="footer">
  <div class="footer-left">
    <a href="./index.php"><img src="./assets/images/logo_light.png" /></a>
    <p style="white-space: pre-line;">
    Мероприятия для школьников
    ❗ Мы не являемся организаторами.
    📢 Мы анонсируем мероприятия для:
    🏅 Развития талантов и навыков
    🎓 Создания портфолио для ВУЗов
    🗨️ Нетворкинга
    </p>
    <div class="socials">
      <a href="https://t.me/extra_curriculum" target="_blank"><i style="color:whitesmoke" class="fab fa-telegram"></i></a>
      <a href="https://www.instagram.com/extra.curriculum/" target="_blank"><i style="color:whitesmoke" class="fab fa-instagram"></i></a>
    </div>
  </div>
  <ul class="footer-right">
    <li>
      <h2>Quick Links</h2>
      <ul class="box">
        <li><a href="./index.php">Home</a></li>
        <li><a href="./categories.php">Categories</a></li>
        <li><a href="./bookmarks.php">Bookmarks</a></li>
        <li><a href="./search.php?trending=1">Trending</a></li>
      </ul>
    </li>
    <li>
      <h2>Categories</h2>
      <ul class="box">
        <?php

          // Category Query to fetch random 3 categories
  	      $categoryQuery= " SELECT  category_id, category_name
                            FROM category 
                            ORDER BY RAND() LIMIT 3";

          // Running Category Query
          $result = mysqli_query($con,$categoryQuery);

          // Returns the number of rows from the result retrieved.
          $row = mysqli_num_rows($result);


          // If query has any result (records) => If there are categories
          if($row > 0) {

          // Fetching the data of particular record as an Associative Array
          while($data = mysqli_fetch_assoc($result)) {

            // Storing the category data in variables
            $category_id = $data['category_id'];
            $category_name = $data['category_name'];
            
        ?>
        <li><a href="articles.php?id=<?php echo $category_id ?>"><?php echo $category_name ?></a></li>
        <?php  
              }
            }
          ?>
        <li><a href="./categories.php">More +</a></li>
      </ul>
    </li>
    <li>
      <h2>Join Us</h2>
      <ul class="box">
        <li>
        Присоединяйтесь к нашей команде, чтобы улучшить свои навыки и достичь новых вершин в своей карьере. Независимо от того, являетесь ли вы новичком или опытным профессионалом, наша команда открыта для всех, кто стремится к постоянному развитию и достижению успеха.
        </li>
        <a href="https://t.me/arkadiyuly" class="my-1 btn btn-secondary">Напишите нам</a>
      </ul>
    </li>
  </ul>
</footer>

<!-- JQUERY SCRIPT -->
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- SCRIPT FOR BACK TO TOP BUTTON -->
<script src="../assets/js/back-to-top.js"></script>

<!-- SCRIPT FOR NAVBAR COLLAPSE -->
<script src="../assets/js/navbar-collapse.js"></script>

<script src="../assets/js/change-lang.js"></script>

<script src="./assets/js/modal_changelang.js"></script>
</body>

</html>