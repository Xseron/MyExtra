<?php
// Fetching all the Functions and DB Code
require('./includes/functions.inc.php');
require('./includes/database.inc.php');

// Creates a session or resumes the current one based on a session identifier. 
// session_start();

// Getting the URI From the Web
$uri = $_SERVER['REQUEST_URI'];

// Variable to store the page title used in title tag
$page_title = "";

// Flag variables to know which Page we are at
$home = true;
$login = false;
$bookmark = false;
$changePass = false;
$category = false;
$search = false;
$about_us = false;

// Strpos returns the position of the search string in the main string or returns 0 (false)
// Checking if the page is Home Page
if (strpos($uri, "index.php") != false) {
  $page_title = " Home";
}

// Checking if the page is Login Page
if (strpos($uri, "login.php") != false) {
  $page_title = " Login";
  $home = false;
  $login = true;
}

// Checking if the page is Bookmarks Page
if (strpos($uri, "bookmarks.php") != false) {
  $page_title = " Bookmarks";
  $home = false;
  $bookmark = true;
}

// Checking if the page is Bookmarks Page
if (strpos($uri, "user-change-password.php") != false) {
  $page_title = " Change Password";
  $home = false;
  $changePass = true;
}

// Checking if the page is Home Page
if (strpos($uri, "categories.php") != false) {
  $page_title = " Categories";
  $home = false;
  $category = true;
}

// Checking if the page is Search Page
if (strpos($uri, "search.php") != false) {
  $page_title = " Search";
  $home = false;
  $search = true;
}

// Checking if the page is Articles Page
if (strpos($uri, "articles.php") != false) {
  $home = false;
  $page_title = " Articles";
}

// Checking if the page is New Article Page
if (strpos($uri, "news.php") != false) {
  $home = false;
  $page_title = " Article";
}

if (strpos($uri, "about-us.php") != false) {
  $page_title = " About Us";
  $home = false;
  $about_us = true;
}

require_once("./languages/lang.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- PARTIAL CSS INCLUSIONS -->
  <link rel="stylesheet" href="./assets/css/partials/0-fonts.css" />
  <link rel="stylesheet" href="./assets/css/partials/1-variables.css" />
  <link rel="stylesheet" href="./assets/css/partials/2-reset.css" />
  <link rel="stylesheet" href="./assets/css/partials/3-typography.css" />
  <link rel="stylesheet" href="./assets/css/partials/4-component.css" />

  <!-- CUSTOM CSS INCLUSIONS -->
  <link rel="stylesheet" href="./assets/css/style.css" />
  <link rel="stylesheet" href="./assets/css/responsivity/modal_changelang.css" />

  <!-- RESPONSIVITY CSS INCLUSIONS -->
  <link rel="stylesheet" href="./assets/css/responsivity/media-queries.css" />

  <!-- FAVICON LINK -->
  <link rel="icon" href="./assets/images/favicon.ico" type="image/x-icon" />

  <!-- TITLE OF THE PAGE -->
  <title>My Extra | <?php echo $page_title; ?></title>

  <!-- FONTAWESOME LINK -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
</head>

<body>

  <!-- ======== BACK TO TOP BUTTON ======== -->
  <button onclick="topFunction()" class="topNavBtn" id="topNavBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>


  <!-- ======== NAVBAR ======== -->
  <nav class="navbar">
    <div class="logo"><a href="./index.php"><img height="50" width="50" src="./assets/images/logo.png" /></a></div>
    <label for="btn" class="icon">
      <span class="fa fa-bars"></span>
    </label>
    <input type="checkbox" id="btn" class="input" />
    <ul class="ul">
      <li>
          <a href="./search.php" class="search <?php if ($search) echo 'current' ?>">
            <i id="search-icon" class="fas fa-search"></i>
          </a>
      </li>
      <!-- We ECHO class current based upon the boolean variables used in above PHP Snippet -->
      <li><a href="./index.php" <?php if ($home) echo 'class="current"' ?>>Home</a></li>
      <li>
        <label for="btn-1" class="show">Categories</label>
        <a href="./categories.php" class="listed <?php if ($category) echo 'current' ?>">Categories</a>
        <input type="checkbox" id="btn-1" class="input" />
        <ul>
          <?php

          // Category Query to fetch random 4 categories
          $categoryQuery = " SELECT  category_id, category_name
                              FROM category 
                              ORDER BY RAND() LIMIT 4";

          // Running Category Query
          $result = mysqli_query($con, $categoryQuery);

          // Returns the number of rows from the result retrieved.
          $row = mysqli_num_rows($result);

          // If query has any result (records) => If there are categories
          if ($row > 0) {

            // Fetching the data of particular record as an Associative Array
            while ($data = mysqli_fetch_assoc($result)) {

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
        <a href="" class="listed <?php if ($changePass) echo 'current' ?>">Language</a>
        <ul>
          <a id="rus-btn" <?php if($_SESSION['lang']=='ru'){?>class="active-lang"<?php }?>>Russian</a>
          <a id="kz-btn" <?php if($_SESSION['lang']=='kz'){?>class="active-lang"<?php }?>>Kazakh</a>
          <a id="eng-btn" <?php if($_SESSION['lang']=='en'){?>class="active-lang"<?php }?>>English</a>
        </ul>
      </li>
      <li><a href="./bookmarks.php" <?php if ($bookmark) echo 'class="current"' ?>>Bookmarks</a></li>
      <li><a href="./about-us.php" <?php if ($about_us) echo 'class="current"' ?>>About Us</a></li>
      <?php
      if (isset($_SESSION['USER_NAME'])) {
      } else {
      ?>
      <li class="nav-login">
        <div>
          <a href="./user-login.php">Login</a>
          <a href="./user-login.php">Sign Up</a>
        </div>
        <a href="./user-login.php">
          <img src="./assets/images/svgs/login.svg" alt="">
        </a>
      </li>
          <!-- <li>
        <label for="btn-2" class="show">Login +</label>
        <a href="./user-login.php" <?php if ($login) echo 'class="current"' ?>>Login</a>
        <input type="checkbox" id="btn-2" class="input" />
        <ul>
          <li><a href="./user-login.php">Reader</a></li>
          <li><a href="./author-login.php">Author</a></li>
        </ul>
      </li> -->
        <?php
      }
        ?>
        <?php

        // If user is logged in
        if (isset($_SESSION['USER_NAME'])) {
          echo '
          <li>
            <label for="btn-2" class="show">Settings</label>
            <a href="#"';

          if ($changePass) {
            echo 'class="current" ';
          }
          echo
          '>Settings</a>
            <input type="checkbox" id="btn-2" class="input" />
            <ul>
              <li><a href="./user-change-password.php">Change Password</a></li>
              <li><a href="./logout.php">Logout</a></li>
              </ul>
          </li>
          ';
          echo '<li><a disabled>Hello ' . $_SESSION["USER_NAME"] . ' !</a></li>';
        }
        ?>
        <!-- <script>
          $("#rus-btn").click(function (e) { 
            e.preventDefault();
            $.ajax({
              type: "GET",
              url: "/languages/lang.php?lang=ru",
              success: function (response) {
                console.log("rus activate");
              }
            });
          });
          $("#kz-btn").click(function (e) { 
            e.preventDefault();
            $.ajax({
              type: "GET",
              url: "/languages/lang.php?lang=kz",
              success: function (response) {
                console.log("kz activate");
              }
            });
          });
          $("#eng-btn").click(function (e) { 
            e.preventDefault();
            $.ajax({
              type: "GET",
              url: "/languages/lang.php?lang=en",
              success: function (response) {
                console.log("eng activate");
              }
            });
          });
          
        
        </script> -->
    </ul>
  </nav>
  <!-- <div class="popup"> <a href="#" class="close Select"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        x="0px" y="0px" width="10px" height="10px" viewBox="215.186 215.671 80.802 80.8"
        enable-background="new 215.186 215.671 80.802 80.8" xml:space="preserve">
            <polygon fill="#FFFFFF" points="280.486,296.466 255.586,271.566 230.686,296.471 215.19,280.964 240.086,256.066 215.186,231.17 
        230.69,215.674 255.586,240.566 280.475,215.671 295.985,231.169 271.089,256.064 295.987,280.96 "
            />
           </svg></a>
    
        <div class="valid">
            <svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0px" y="0px" width="15px" height="15px" viewBox="222.744 227.408 67.744 58.526"
            enable-background="new 222.744 227.408 67.744 58.526" xml:space="preserve">
                <path fill="#39BA6F" d="M250.062,285.934c-9.435-11.111-15.731-18.195-27.318-28.935l5.793-5.357
        c6.778,3.28,11.076,5.774,18.693,11.204c14.32-16.25,23.783-24.495,41.372-35.438l1.886,4.335
        C275.983,244.402,265.359,258.502,250.062,285.934z" />
            </svg>
        </div>
         <h1 class="welcome">Welcome!</h1>
    
        <p class="textChooseYourLanguage">Choose Your Language</p>
        <div class="bottom-popup"> <h1 class="welcome lang">Russian</h1></div>
        <div class="buttons">
            <button class="Kazakh btn">Kazakh</button>
            <button class="Russian btn">Russian</button>
            <button class="English btn">English</button>
        </div>

    </div> -->