<?php include 'header.php'; ?>

<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

                    <?php

                    include "config.php";

                    $post_id = $_GET['id'];

                    $sql = "SELECT 
                        post.post_id, post.title, post.description, post.post_date, post.category, post.post_img,
                        category.category_name, user.username
                        FROM post 
                        LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id
                        WHERE post.post_id = {$post_id}";

                    $res = mysqli_query($conn, $sql) or die("QUERY FAILED");

                    if (mysqli_num_rows($res) > 0) {

                        while ($row = mysqli_fetch_assoc($res)) {

                    ?>
                            <div class="post-content single-post">
                                <h3 class="text-uppercase" ><?php echo $row['title'] ?></h3>
                                <div class="post-information">
                                    <span>
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        <?php echo $row['category_name'] ?>
                                    </span>
                                    <span>
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <a href='author.php'><?php echo $row['username'] ?></a>
                                    </span>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <?php echo $row['post_date'] ?>
                                    </span>
                                </div>
                                <div class="sigle_image">
                                    <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img'] ?>" alt="" />
                                </div>
                                <p class="description">
                                    <?php echo $row['description'] ?>
                                </p>
                            </div>

                    <?php }
                    } else {

                        echo "<p style = 'color:red; text-align:center; margin: 10px 0' >NO DATA! </p>";
                    }

                    ?>

                </div>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>