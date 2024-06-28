<?php

include "config.php";

$page = basename($_SERVER['PHP_SELF']);

switch ($page) {

    case "single.php":

        if (isset($_GET['id'])) {

            $sql_title = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
            $res_title = mysqli_query($conn, $sql_title) or die("TITLE PAGE QUERY");
            $row_title = mysqli_fetch_assoc($res_title);
            $page_title = $row_title['title'];
        } else {

            $page_title = "NO PAGE FOUND";
        }

        break;

    case "category.php":

        if (isset($_GET['cid'])) {

            $sql_title = "SELECT * FROM category WHERE category_id = {$_GET['cid']}";
            $res_title = mysqli_query($conn, $sql_title) or die("TITLE PAGE QUERY");
            $row_title = mysqli_fetch_assoc($res_title);
            $page_title = $row_title['category_name'];
        } else {

            $page_title = "NO PAGE FOUND";
        }

        break;

    case "author.php":

        if (isset($_GET['aid'])) {

            $sql_title = "SELECT * FROM user WHERE user_id = {$_GET['aid']}";
            $res_title = mysqli_query($conn, $sql_title) or die("TITLE PAGE QUERY");
            $row_title = mysqli_fetch_assoc($res_title);
            $page_title = $row_title['username'] . " " . "POST'S";
        } else {

            $page_title = "NO PAGE FOUND";
        }

        break;

    case "search.php":

        if (isset($_GET['search'])) {

            $page_title = $_GET['search'];
        } else {

            $page_title = "NO PAGE FOUND";
        }

        break;

    default:
        $page_title = "BLOG SITE";
        break;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo  $page_title ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <style>
        .lo {
            font-size: 30px;
            color: #FAF9F6;
            font-weight: bold;
            cursor: pointer;
        }

        .lo span {
            font-size: 30px;
            color: #E17228;
        }
    </style>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                    <a href="index.php">
                        <div class="lo">CODERS
                            <span>HUB</span>
                        </div>
                    </a>
                    <!-- <img src="images/news.jpg"> -->
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <?php

                    include "config.php";

                    $sql = "SELECT * FROM category WHERE post > 0";

                    $res = mysqli_query($conn, $sql) or die("QUERY FAIELD : category");

                    if (mysqli_num_rows($res) > 0) {

                    ?>
                        <ul class='menu'>

                            <li><a href='index.php'>HOME</a></li>

                            <?php while ($row = mysqli_fetch_assoc($res)) {  ?>

                                <li>
                                    <a href='category.php?cid=<?php echo $row['category_id'] ?>'>
                                        <?php echo $row['category_name'] ?>
                                    </a>
                                </li>

                            <?php } ?>

                        </ul>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->