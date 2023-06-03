<?php
require('./includes/nav.inc.php');

if (isset($_POST['article_title'])) {
  $author_id = 1;

  $article_title = $_POST['article_title'];
  $article_dedline = $_POST['article_dedline'];
  $article_desc = $_POST['article_desc_ru'];
  $article_descENG = $_POST['article_desc_eng'];
  $article_descKZ = $_POST['article_desc_kz'];
  $article_cat_id = $_POST['category_id'];

  $article_title = str_replace('"', '\"', $article_title);

  $name   = 'article-' . $article_cat_id . '-' . time();
  $extension  = pathinfo($_FILES["article_img"]["name"], PATHINFO_EXTENSION);
  $basename   = $name . "." . $extension;

  $tempname = $_FILES["article_img"]["tmp_name"];
  $folder = "../assets/images/articles/{$basename}";

  $article_date = date("Y-m-d");

  $sql = "INSERT INTO article 
        (category_id, author_id, article_title, article_image, article_description, article_date, article_trend, article_active, article_dedline,article_description_eng, article_description_kz) 
        VALUES 
        (?, ?, ?, ?, ?, ?, 0, 0, ?, ?, ?)";

  // Prepare the statement
  $stmt = $con->prepare($sql);

  // Bind parameters
  $stmt->bind_param("iisssssss", $article_cat_id, $author_id, $article_title, $basename, $article_desc, $article_date, $article_dedline, $article_descENG, $article_descKZ);

  // Execute the statement
  if ($stmt->execute()) {
    move_uploaded_file($tempname, $folder);
    alert("Article posted. Please wait for Admin to activate it.");
  } else {
    echo "Failed to upload Data";
  }
}
?>

<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./index.php">Dashboard</a></li>
      <li><a href="./articles.php">Articles</a></li>
      <li class="active">Add</li>
    </ol>
  </div>
</section>

<section id="main">
  <div class="container">
    <div class="row">
      <?php
      require('./includes/quick-links.inc.php');
      ?>
      <div class="col-md-9">
        <div class="panel panel-default">
          <div class="panel-heading main-color-bg">
            <h3 class="panel-title">Add Article</h3>
          </div>
          <div class="panel-body">
            <form method="post" id="add_form" enctype="multipart/form-data">
              <div class="form-group">
                <label>Article Title</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Article Title" name="article_title" id="article_title" required />
                <p id="error-title" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Deadline</label>
                <input type="date" id="article_dedline" name="article_dedline" class="form-control" value="2023-06-26" min="2023-01-01" required>
                <p id="error-dedline" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control" id="category">
                  <option value="0" selected>Choose Any Category...</option>
                  <?php
                  $cat_sql = "SELECT category_id, category_name FROM category ORDER BY category_name ASC";
                  $cat_res = mysqli_query($con, $cat_sql);
                  $cat_row = mysqli_num_rows($cat_res);

                  while ($cat_data = mysqli_fetch_assoc($cat_res)) {
                    $cat_id = $cat_data['category_id'];
                    $cat_name = $cat_data['category_name'];
                    echo '
                        <option value="' . $cat_id . '">' . $cat_name . '</option>
                      ';
                  }
                  ?>
                </select>
                <p id="error-cat" class="error-msg text-danger"></p>
              </div>

              <label>Article Description</label>
              <div class="form-group">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#rusdesc" data-toggle="tab">RUS</a></li>
                  <li><a href="#endesc" data-toggle="tab">EN</a></li>
                  <li><a href="#kzdesc" data-toggle="tab">KZ</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="rusdesc">
                    <textarea name="article_desc_ru" class="form-control" id="editorRU" placeholder="Article Description RU" rows="20" min="150"></textarea>
                  </div>
                  <div class="tab-pane fade" id="endesc">
                    <textarea name="article_desc_eng" class="form-control" id="editorENG" placeholder="Article Description ENG" rows="20" min="150"></textarea>
                  </div>
                  <div class="tab-pane fade" id="kzdesc">
                    <textarea name="article_desc_kz" class="form-control" id="editorKZ" placeholder="Article Description KZ" rows="20" min="150"></textarea>
                  </div> 
                </div>
              </div>
              
              <div class="form-group">
                <label>Article Image</label>
                <input type="file" class="form-control" placeholder="Article Image" name="article_img" id="article_img" accept="image/*" required />
                <p id="error-img" class="error-msg text-danger"></p>
              </div>
              <div class="form-group text-center">
                <img src="../assets/images/articles/choose.png" class="image_preview" id="image_preview" />
              </div>
              <br>
              <div class="text-center">
                <button id="btn-submit" type="submit" name="submit" class="btn btn-success">Post Article</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/js/admin/add-form-validate.js"></script>
  <script src="../assets/js/admin/create-editor.js"></script>
  <script>
    var myEditorRU, myEditorENG, myEditorKZ;

    myEditorRU = create_editor("editorRU");
    myEditorENG = create_editor("editorENG");
    myEditorKZ = create_editor("editorKZ");

    const form = document.getElementById('add_form');

    // Handle form submission
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      const formData = new FormData(this);

      $.ajax({
        url: 'add-article.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          console.log('POST request successful');
          console.log(response);
          window.location.href = "./articles.php";
        },
        error: function(xhr, status, error) {
          console.log('POST request failed');
          console.log(xhr.responseText);
        }
      });
    });
  </script>
</section>

<?php
require('./includes/footer.inc.php')
?>