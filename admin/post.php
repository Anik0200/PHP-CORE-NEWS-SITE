<?php include "header.php"; ?>

<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1 class="admin-heading">All Posts</h1>
      </div>
      <div class="col-md-2">
        <a class="add-new" href="add-post.php">add post</a>
      </div>
      <div class="col-md-12">

        <?php

        include "config.php";

        $limit = 3;

        if (isset($_GET['page'])) {

          $page = $_GET['page'];
        } else {

          $page = 1;
        }

        $offset = ($page - 1) * $limit;

        if ($_SESSION["user_role"] == 1) {

          $sql = "SELECT * FROM post 
          LEFT JOIN category ON post.category = category.category_id
          LEFT JOIN user ON post.author = user.user_id
          ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";
        } elseif ($_SESSION["user_role"] == 0) {

          $sql = "SELECT * FROM post 
          LEFT JOIN category ON post.category = category.category_id
          LEFT JOIN user ON post.author = user.user_id
          WHERE post.author =  $_SESSION[user_id]
          ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";
        }

        $res = mysqli_query($conn, $sql) or die("QUERY FAILED");

        if (mysqli_num_rows($res) > 0) {

        ?>

          <table class="content-table">

            <thead>
              <th>S.No.</th>
              <th>image</th>
              <th>Title</th>
              <th>Category</th>
              <th>Date</th>
              <th>Author</th>
              <th>Edit</th>
              <th>Delete</th>
            </thead>

            <tbody>
              <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                <tr>

                  <td class='id'> <?php echo $row['post_id'] ?> </td>

                  <td><img src="upload/<?php echo $row['post_img'] ?>"  width="40" </td>

                  <td> <?php echo $row['title'] ?> </td>

                  <td> <?php echo $row['category_name'] ?> </td>

                  <td> <?php echo $row['post_date'] ?> </td>

                  <td> <?php echo $row['username'] ?> </td>

                  <td class='edit'>
                    <a href='update-post.php?id=<?php echo $row['post_id'] ?>'>
                      <i class='fa fa-edit'></i>
                    </a>
                  </td>

                  <td class='delete'>
                    <a href='delete-post.php?id=<?php echo $row['post_id'] ?> & catid=<?php echo $row['category_id'] ?>'>
                      <i class='fa fa-trash-o'></i>
                    </a>
                  </td>

                </tr>
              <?php } ?>
            </tbody>

          </table>

        <?php } else {

          echo "<p style = 'color:red; text-align:center; margin: 10px 0' >NO DATA! </p>";
        }

        $sqlP = "SELECT * FROM post";
        $resP =  mysqli_query($conn, $sqlP) or die("QUERY FAILED");

        if (mysqli_num_rows($resP) > 0) {

          $total_rec = mysqli_num_rows($resP);
          $total_page = ceil($total_rec / $limit);
        }

        echo '<ul class="pagination admin-pagination">';

        if ($page > 1) {

          echo '<li><a href = "post.php?page= ' . ($page - 1) . ' ">PREV</a></li>';
        }

        if (!isset($total_page)) {

          echo "";
        } else {

          for ($i = 1; $i <= $total_page; $i++) {

            if ($i == $page) {

              $active = "active";
            } else {

              $active = "deactive";
            }

            echo '<li  class = ' . $active . '><a href="post.php?page= ' . $i . ' "> ' . $i . ' </a></li>';
          }

          if ($total_page > $page) {
            echo '<li><a href = "post.php?page= ' . ($page + 1) . ' ">NEXT</a></li>';
          }
        }

        echo '</ul>';

        ?>

      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>