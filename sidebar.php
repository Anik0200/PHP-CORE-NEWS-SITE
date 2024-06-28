<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php

        include "config.php";

        $limit = 3;


        $sql = "SELECT 
                post.post_id, post.title, post.description, post.post_date, post.category, post.post_img, post.author,
                category.category_name
                FROM post 
                LEFT JOIN category ON post.category = category.category_id
                ORDER BY post.post_id DESC LIMIT {$limit}";

        $res = mysqli_query($conn, $sql) or die("QUERY FAILED");

        if (mysqli_num_rows($res) > 0) {

            while ($row = mysqli_fetch_assoc($res)) {

        ?>
                <div class="recent-post">
                    <a class="post-img" href='single.php?id=<?php echo $row['post_id'] ?>'>
                        <img src="admin/upload/<?php echo $row['post_img'] ?>" alt="" />
                    </a>
                    <div class="post-content">
                        <h3><a class="text-lowercase" href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo substr($row['title'], 0, 16) . "..." ?></a></h3>
                        <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <span><?php echo $row['category_name'] ?></span>
                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo $row['post_date'] ?>
                        </span>
                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>
                    </div>
                </div>

        <?php }
        } else {

            echo "<p style = 'color:red; text-align:center; margin: 10px 0' >NO DATA! </p>";
        }

        ?>

    </div>
    <!-- /recent posts box -->
</div>