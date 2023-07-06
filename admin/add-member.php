<?php
require('./includes/nav.inc.php');

if (isset($_POST['member_name'])) {
  $member_name = $_POST['member_name'];
  $member_desc = $_POST['member_desc'];
  $role_id = $_POST['role_id'];
  $member_sub = $_POST['member_sub'];

  $member_name = str_replace('"', '\"', $member_name);

  $name   = 'member-' . $role_id . '-' . time();
  $extension  = pathinfo($_FILES["member_img"]["name"], PATHINFO_EXTENSION);
  $basename   = $name . "." . $extension;

  $tempname = $_FILES["member_img"]["tmp_name"];
  $folder = "../assets/images/members/{$basename}";

  $sql = "INSERT INTO members 
        (member_role, member_name, member_desc, member_image, member_sub_role) 
        VALUES 
        (?, ?, ?, ?, ?)";

  // Prepare the statement
  $stmt = $con->prepare($sql);

  // Bind parameters
  $stmt->bind_param("issss", $role_id, $member_name, $member_desc, $basename, $member_sub);

  // Execute the statement
  if ($stmt->execute()) {
    move_uploaded_file($tempname, $folder);
    alert("Member added.");
  } else {
    echo "Failed to upload Data";
  }
}

if(isset($_POST['role_name'])){
  $role_name = $_POST['role_name'];

  $sql = "INSERT INTO roles (role_name) VALUES (?)";

  $stmt = $con->prepare($sql);

  $stmt->bind_param("s", $role_name);

  if ($stmt->execute()) {
    alert("Role added.");
  } else {
    echo "Failed to upload Data";
  }
}
?>

<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./index.php">Dashboard</a></li>
      <li><a href="./articles.php">Member</a></li>
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
            <h3 class="panel-title">Add Member</h3>
          </div>
          <div class="panel-body">
            <form method="post" id="add_form" enctype="multipart/form-data">
              <div class="form-group">
                <label>Member Name</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Member Name" name="member_name" id="member_name" required />
                <p id="error-title" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea id="member_desc" name="member_desc" class="form-control" placeholder="Member Description" rows="4" cols="50"></textarea>
                <p id="error-dedline" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Role</label>
                <select name="role_id" class="form-control" id="role">
                  <option value="0" selected>Choose Any Role...</option>
                  <?php
                  $cat_sql = "SELECT role_id, role_name FROM roles ORDER BY role_name ASC";
                  $cat_res = mysqli_query($con, $cat_sql);
                  $cat_row = mysqli_num_rows($cat_res);

                  while ($cat_data = mysqli_fetch_assoc($cat_res)) {
                    $cat_id = $cat_data['role_id'];
                    $cat_name = $cat_data['role_name'];
                    echo '
                        <option value="' . $cat_id . '">' . $cat_name . '</option>
                      ';
                  }
                  ?>
                </select>
                <br>
                <input type="text" name="" id="new_role" placeholder="New Role Name"/><button id="create_new_role">Add role</button>
                <p id="error-cat" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Member Subrole</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Member Subrole" name="member_sub" id="member_sub" required />
                <p id="error-title" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Member Image</label>
                <input type="file" class="form-control" placeholder="Member Image" name="member_img" id="Member_img" accept="image/*" required />
                <p id="error-img" class="error-msg text-danger"></p>
              </div>
              <div class="form-group text-center">
                <img src="../assets/images/articles/choose.png" class="image_preview" id="image_preview" />
              </div>
              <br>
              <div class="text-center">
                <button id="btn-submit" type="submit" name="submit" class="btn btn-success">Create Member</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    Member_img.onchange = evt => {
      const [file] = Member_img.files
      if (file) {
        image_preview.src = URL.createObjectURL(file)
      }
    }
  </script>
  <script src="../assets/js/admin/add-form-validate.js"></script>
  <script>
    $('#create_new_role').click(function(){
        let name = $("#new_role").val();

        console.log(name);
      
        $.ajax({
          url: 'add-member.php',
          type: 'POST',
          data: {"role_name":name},
          traditional: true,
          success: function(response) {
            console.log('POST request successful');
            console.log(response);
            window.location.href = "./add-member.php";
          },
          error: function(xhr, status, error) {
            console.log('POST request failed');
            console.log(xhr.responseText);
          }
        });
    });

    // Handle form submission
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      const formData = new FormData(this);

      $.ajax({
        url: 'add-member.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          console.log('POST request successful');
          console.log(response);
          window.location.href = "./add-member.php";
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