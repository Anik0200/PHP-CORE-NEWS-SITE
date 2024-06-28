<?php include 'header.php'; ?>
<style>
    .post_ing {
        width: 40%;
    }
</style>

<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

                    <?php

                    include "config.php";

                    $limit = 3;

                    if (isset($_GET['page'])) {

                        $page = $_GET['page'];
                    } else {

                        $page = 1;
                    }

                    $offset = ($page - 1) * $limit;
                    $sql = "SELECT 
                    post.post_id, post.title, post.description, post.post_date, post.category, post.post_img, post.author,
                    category.category_name, user.username
                    FROM post 
                    LEFT JOIN category ON post.category = category.category_id
                    LEFT JOIN user ON post.author = user.user_id
                    LIMIT {$offset}, {$limit}";

                    $res = mysqli_query($conn, $sql) or die("QUERY FAILED");

                    if (mysqli_num_rows($res) > 0) {

                        while ($row = mysqli_fetch_assoc($res)) {

                    ?>

                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post_ing" href='single.php?id=<?php echo $row['post_id'] ?>'><img src="admin/upload/<?php echo $row['post_img'] ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a class="text-uppercase" href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a><?php echo $row['category_name'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?aid=<?php echo $row['author'] ?>'>
                                                        <?php echo $row['username'] ?>
                                                    </a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row['post_date'] ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($row['description'], 0, 181) . "..." ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php }
                    } else {

                        echo "<p style = 'color:red; text-align:center; margin: 10px 0' >NO DATA! </p>";
                    }

                    $sqlP = "SELECT * FROM post";
                    $resP =  mysqli_query($conn, $sqlP) or die("QUERY FAILED");

                    if (mysqli_num_rows($resP) > 0) {

                        $total_rec = mysqli_num_rows($resP);
                        $total_page = ceil($total_rec / $limit);
                    }

                    echo '<ul class="pagination">';

                    if ($page > 1) {

                        echo '<li><a href = "index.php?page= ' . ($page - 1) . ' ">PREV</a></li>';
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

                            echo '<li  class = ' . $active . '><a href="index.php?page= ' . $i . ' "> ' . $i . ' </a></li>';
                        }

                        if ($total_page > $page) {
                            echo '<li><a href = "index.php?page= ' . ($page + 1) . ' ">NEXT</a></li>';
                        }
                    }

                    echo '</ul>';

                    ?>

                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>