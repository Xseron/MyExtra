<?php
  require('./includes/nav.inc.php');  
?>

<script>
function deleteConfirm(id) {
  if (confirm("Are you sure you want to delete this member ?")) {
    var url = "./delete-member.php?id=" + id;
    document.location = url;
  }
}
</script>

<!-- BREADCRUMB -->
<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./index.php">Dashboard</a></li>
      <li class="active">Members</li>
    </ol>
  </div>
</section>


<section id="main">
  <div class="container">
    <div class="col-md-12">
      <?php
        $limit = 10;
        if(isset($_GET['page'])) {
          $page = $_GET['page'];
        }else {
          $page = 1;
        }
        $offset = ($page - 1) * $limit;
        // $sql = "SELECT article.article_title, 
        //         article.article_id, 
        //         article.article_date, 
        //         author.author_name, 
        //         article.article_image, 
        //         article.article_trend, 
        //         article.article_active, 
        //         article.article_description, 
        //         category.category_name 
        //         FROM article, category, author
        //         WHERE article.category_id = category.category_id
        //         AND article.author_id = author.author_id
        //         ORDER BY article.article_date DESC
        //         LIMIT {$offset},{$limit}";
        $sql = "SELECT members.member_id,
                roles.role_name,
                members.member_name,
                members.member_desc,
                members.member_image,
                members.member_sub_role
                FROM members, roles
                WHERE roles.role_id = members.member_role
                ORDER BY members.member_name DESC
                LIMIT {$offset},{$limit}";
        $result = mysqli_query($con,$sql);
        $row = mysqli_num_rows($result);

      ?>
      <div class="panel panel-default">
        <div class="panel-heading main-color-bg">
          <h3 class="panel-title">Members</h3>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover article-table">
            <tr>
              <th style="min-width: 200px">Nmae</th>
              <th style="min-width: 120px">Role</th>
              <th style="min-width: 120px">Sub_role</th>
              <th style="min-width: 250px">Description</th>
              <th style="min-width: 90px">Image</th>
              <th style="min-width: 150px">Actions</th>
            </tr>
            <?php
                if($row > 0) {
                  while($data = mysqli_fetch_assoc($result)) {
                    $member_id = $data['member_id'];
                    $member_name = $data['member_name'];
                    $role_name = $data['role_name'];
                    $member_desc = $data['member_desc'];
                    $member_image = $data['member_image'];
                    $member_sub_role = $data['member_sub_role'];

                    $member_desc = substr($member_desc,0,100);

                    echo '
                      <tr>
                        <td>
                          '.$member_name.'
                        </td>
                        <td>
                          '.$role_name.'
                        </td>
                        <td>
                          '.$member_sub_role.'
                        </td>
                        <td>
                          '.$member_desc.'
                        </td>
                        <td>
                          <img src="../assets/images/members/'.$member_image.'" />
                        </td>
                        <td>';
                        echo '
                          <a class="btn btn-danger" href="javascript:deleteConfirm('.$member_id.')" title="Delete Member">
                            <span class="glyphicon glyphicon-trash"></span>
                          </a>
                        </td>
                      </tr>
                    ';
                  }
                }
                else {
                  echo '
                    <td colspan="7" align="center" style="padding-top: 28px; color: var(--active-color);">
                      <h4>
                        No members
                      </h4>
                    </td>
                  ';
                }
              ?>
          </table>
        </div>
        <!-- <div class="text-center">
          <ul class="pagination pg-red">
            <?php
            //   $paginationQuery = "SELECT * FROM article";
            //   $paginationResult = mysqli_query($con, $paginationQuery);
            //   if(mysqli_num_rows($paginationResult) > 0) {
            //     $total_articles = mysqli_num_rows($paginationResult);
            //     $total_page = ceil($total_articles / $limit);

            //     if($page > $total_page) {
            //       redirect('./articles.php');
            //     }
            //     if($page > 1) {
            //       echo '
            //         <li class="page-item">
            //           <a href="articles.php?page='.($page - 1).'" class="page-link">
            //             <span>&laquo;</span>
            //           </a>
            //         </li>';
            //     }
            //     for($i = 1; $i <= $total_page; $i++) {
            //       $active = "";
            //       if($i == $page) {
            //         $active = "active";
            //       }
            //       echo '<li class="page-item '.$active.'"><a href="./articles.php?page='.$i.'" class="page-link">'.$i.'</a></li>';
            //     }
            //     if($total_page > $page){
            //       echo '
            //         <li class="page-item">
            //           <a href="articles.php?page='.($page + 1).'" class="page-link">
            //             <span>&raquo;</span>
            //           </a>
            //         </li>';
            //     }
            //   }
            ?>
          </ul>
        </div> -->
      </div>
    </div>
  </div>
</section>

<?php
  require('./includes/footer.inc.php')
?>