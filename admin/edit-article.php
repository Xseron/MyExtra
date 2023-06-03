<?php
require('./includes/nav.inc.php');
$author_id = 1;
if (isset($_GET['id'])) {
  $article_id = $_GET['id'];
} else {
  redirect('./articles.php');
}
if ($article_id == '' || $article_id == null) {
  redirect('./articles.php');
}


if (isset($_POST['article_title'])) {
  $author_id = 1;

  $article_id = $_GET['id'];
  $article_title = $_POST['article_title'];
  $article_desc = $_POST['article_desc_ru'];
  $article_descENG = $_POST['article_desc_eng'];
  $article_descKZ = $_POST['article_desc_kz'];
  $article_cat_id = $_POST['category_id'];
  $article_old_img = $_POST['article_old_img'];
  $article_dedline = $_POST['article_dedline'];

  $article_title = str_replace('"', '\"', $article_title);
  // $article_desc = str_replace('"', '\"', $article_desc);

  $article_date = date("Y-m-d");

  if (empty($_FILES['article_img']['name'])) {
    $sql = "UPDATE article 
        SET category_id = ?, author_id = ?, article_title = ?, article_image = ?, article_description = ?, article_date = ?, article_trend = 0, article_active = 0, article_dedline = ?, article_description_eng = ?, article_description_kz = ? 
        WHERE article_id = ?";
  
    // Prepare the statement
    $stmt = $con->prepare($sql);
  
    // Bind parameters
    $stmt->bind_param("iisssssssi", $article_cat_id, $author_id, $article_title, $article_old_img, $article_desc, $article_date, $article_dedline, $article_descENG, $article_descKZ, $article_id);
  
    // Execute the statement
    if ($stmt->execute()) {
      alert("Article posted. Please wait for Admin to activate it.");
      redirect('./articles.php');
    } else {
      echo "Failed to upload Data";
    }
  } else {
    $name = 'article-' . $article_cat_id . '-' . time();
    $extension = pathinfo($_FILES["article_img"]["name"], PATHINFO_EXTENSION);
    $basename = $name . "." . $extension;
  
    $tempname = $_FILES["article_img"]["tmp_name"];
    $folder = "../assets/images/articles/{$basename}";

    $article_date = date("Y-m-d");
  
    $sql = "INSERT INTO article 
            (category_id, author_id, article_title, article_image, article_description, article_date, article_trend, article_active, article_dedline, article_description_eng, article_description_kz) 
            VALUES 
            (?, ?, ?, ?, ?, ?, 0, 0, ?, ?, ?)";
  
    // Prepare the statement
    $stmt = $con->prepare($sql);
  
    // Bind parameters
    $stmt->bind_param("iisssssss", $article_cat_id, $author_id, $article_title, $basename, $article_desc, $article_date, $article_dedline, $article_desc_eng, $article_desc_kz);
  
    // Execute the statement
    if ($stmt->execute()) {
      move_uploaded_file($tempname, $folder);
      alert("Article posted. Please wait for Admin to activate it.");
      redirect('./articles.php');
    } else {
      echo "Failed to upload Data";
    }
  }
  
}
?>

<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./index.php">Dashboard</a></li>
      <li><a href="./articles.php">Articles</a></li>
      <li class="active">Edit</li>
    </ol>
  </div>
</section>

<section id="main">
  <div class="container">
    <div class="row">
      <?php
      $sql = "SELECT article.article_title, 
                article.article_date, 
                article.article_image, 
                article.article_active, 
                article.article_description, 
                article.article_description_eng, 
                article.article_description_kz, 
                category.category_name,
                article.category_id,
                article.article_dedline
                FROM article, category 
                WHERE article.author_id = {$author_id} 
                AND article.article_id = {$article_id}
                AND article.category_id = category.category_id";

      $result = mysqli_query($con, $sql);
      $row = mysqli_num_rows($result);

      if ($row == 0) {
        redirect('./articles.php');
      }

      $data = mysqli_fetch_assoc($result);
      $article_title = $data['article_title'];
      $article_desc = $data['article_description'];
      $article_desc_eng = $data['article_description_eng'];
      $article_desc_kz = $data['article_description_kz'];
      $article_dedline = $data['article_dedline'];
      $article_cat_id = $data['category_id'];
      $article_image = $data['article_image'];

      require('./includes/quick-links.inc.php');
      ?>
      <div class="col-md-9">
        <!-- Website Overview -->
        <div class="panel panel-default">
          <div class="panel-heading main-color-bg">
            <h3 class="panel-title">Edit Article</h3>
          </div>
          <div class="panel-body">
            <form method="post" id="edit_form" enctype="multipart/form-data">
              <div class="form-group">
                <label>Article Title</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Article Title" value="<?php echo $article_title; ?>" name="article_title" id="article_title" required />
                <p id="error-title" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Deadline</label>
                <input type="date" id="article_dedline" name="article_dedline" class="form-control" value="<?php echo $article_dedline; ?>" min="2023-01-01" required>
                <p id="error-dedline" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control" name="category" id="category">
                  <?php
                  $cat_sql = "SELECT category_id, category_name FROM category ORDER BY category_name ASC";
                  $cat_res = mysqli_query($con, $cat_sql);
                  $cat_row = mysqli_num_rows($cat_res);

                  while ($cat_data = mysqli_fetch_assoc($cat_res)) {
                    // echo "<pre>";
                    // print_r($cat_data); 
                    // echo "</pre>"; 
                    $selected = "";
                    $cat_id = $cat_data['category_id'];
                    $cat_name = $cat_data['category_name'];
                    if ($cat_id == $article_cat_id) {
                      $selected = "selected";
                    }
                    echo '
                        <option value="' . $cat_id . '"' . $selected . '>' . $cat_name . '</option>
                      ';
                  }
                  ?>
                </select>
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
              <!-- <div class="form-group">
                <label>Article Description</label>
                <textarea name="article_desc" class="form-control" id="editor" placeholder="Article Description" rows="20" min="150"></textarea>
                <p id="error-desc" class="error-msg text-danger"></p>
              </div> -->
              <div class="form-group">
                <label>Article Image</label>
                <input type="file" class="form-control" placeholder="Article Image" name="article_img" id="article_img" accept="image/*" />
                <input type="hidden" class="form-control" name="article_old_img" value="<?php echo $article_image; ?>" />
                <br>
              </div>
              <div class="form-group text-center">
                <img src="../assets/images/articles/<?php echo $article_image; ?>" class="image_preview" id="image_preview" />
              </div>
              <br>
              <div class="text-center">
                <button type="submit" name="submit" class="btn btn-success">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/js/admin/edit-form-validate.js"></script>
  <script src="../assets/js/admin/create-editor.js"></script>
  <script>
    var myEditorRU, myEditorENG, myEditorKZ;

    myEditorRU = create_editor_with_data("editorRU", `<?=$article_desc?>`);
    myEditorENG = create_editor_with_data("editorENG", `<?=$article_desc_eng?>`);
    myEditorKZ = create_editor_with_data("editorKZ", `<?=$article_desc_kz?>`);

    const form = document.getElementById('edit_form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      const formData = new FormData(this);

      $.ajax({
        url: 'edit-article.php?id=<?=$article_id?>',
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