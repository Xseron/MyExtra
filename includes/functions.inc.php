<?php

  // Function For Redirecting
  function redirect($link){
    ?>
<script>
window.location.href = '<?php echo $link ?>';
</script>
<?php
    die();
  }

  // Function For Alert Message
  function alert($message){
    ?>
<script>
alert('<?php echo $message ?>');
</script>
<?php
  }
  
  // Function to get Safe Values from Forms
  function get_safe_value($str){
    global $con;
    $str = mysqli_real_escape_string($con,$str);
      return $str;
  }

  // Function to Create Article Card
  function createArticleCard($title, $img, $data, $category, $cat_id, $id, $color, $new, $trend, $marked, $dedline) {
    echo '
    <article class="card">';
    echo '<div class="card-img">
        <img src="./assets/images/articles/article-16-1685039437.jpg" />
      </div>
      <div class="card-text">
        <h3 class="card-title" href="./article.html">
          '.$title.'
        </h3>
        <div class="tag '.$color.'"><a href="articles.php?id='.$cat_id.'">'.$category.'</a></div>';
        if($new){
          echo '  <div class="tag tag-new">New</div>';
        }
        if($trend) {
          echo '  <div class="tag tag-trend"><a href="search.php?trending=1">Trending</a></div>';
        }
        echo '
        <h6 class="card-dedline">
          Deadline: '.date("d M Y",strtotime($dedline)).'
        </h6>
        <p class="card-data">
          '.strip_tags($data).'
        </p>
        <div class="btn-container">
        <a href="news.php?id='.$id.'" class="btn btn-card">
          Read More
        </a>';
          echo '
          <a href="';
          
          if(isset($_SESSION['USER_LOGGED_IN'])) {
            if($marked) {
              echo 'remove-bookmark.php?id='.$id;
            }
            else {
              echo 'add-bookmark.php?id='.$id;
            }
          }
          else {
            echo 'bookmarks.php';
          }
          echo '" class="bookmark" title="';
          
          if($marked) {
            echo 'Remove from Bookmarks">
            <i class="fas fa-bookmark"></i>
          </a>';
          }
          else {
            echo 'Add to Bookmarks">
            <i class="far fa-bookmark"></i>
          </a>';
          }
          echo '
        </div>
      </div>
    </article>';
  }

  // Function to Create Category Card
  function createCategoryCard($title, $img, $data,$id) {
    echo '
    <article class="card">
      <div class="card-info">
        <div class="card-img">
          <img src="./assets/images/category/code1685039001.jpg" />
        </div>
        <div class="card-text">
          <h3 class="card-title" href="./article.html">
            '.$title.'
          </h3>
          <p class="card-data">
            '.$data.'
          </p>
          </div>
      </div>
      <div class="btn-block">
        <a href="articles.php?id='.$id.'" class="btn btn-card">
          Read More
        </a>
      </div>
    </article>';
  }

  // Function to Create a More Card
  function createMoreCard($link) {
    echo '
    <a href="'.$link.'" class="card card-more d-flex">
      <h3>READ MORE</h3>
    </a>
    ';
  }

  // Function to Create a No Articles Card
  function createNoArticlesCard() {
    echo '
    <div class="d-flex">
      <a href="./categories.php" class="card card-more d-flex" style="height: 300px; max-width: 400px;">
        <h4>Sorry ! No Articles in this Page</h4>
      </a>
    </div>
    ';
  }

  // Function to Create a Slider
  function createSlider($active, $img, $color, $category, $title, $content, $id, $new, $trend) {
    echo '
    <div class="slide '.$active.'">
      <img src="./assets/images/articles/'.$img.'"/>
      <div class="before"></div>
      <div class="info">
        <div class="info-text">
          <h1>'.$title.'</h1>
          <div class=" tag '.$color.'">'.$category.'</div>';
          if($new){
            echo '  <div class="tag tag-new">NEW</div>';
          }
          if($trend) {
            echo '  <div class="tag tag-trend">TRENDING</div>';
          }
        echo
          '
          <p>
            '.$content.'
          </p>
        </div>
        <a href="news.php?id='.$id.'" class="btn btn-primary">Read More</a>
      </div>
      <div class="after"></div>
    </div>';
  }

  // Function to Create Aside Card
  function createAsideCard($img, $id, $title, $author, $date) {
    echo '
      <div class="aside-card">
        <div class="aside-card-img">
          <img src="./assets/images/articles/'.$img.'" />
        </div>
        <div>
          <a class="aside-card-title" href="news.php?id='.$id.'">
          '.$title.'
          </a>
          <div class="aside-card-author">
            <i class="fas fa-user-alt"></i> '.$author.'
          </div>
          <div class="aside-card-date">
            <i class="fas fa-calendar-alt"></i> '.$date.'
          </div>
        </div>
      </div>
    ';
  }

?>