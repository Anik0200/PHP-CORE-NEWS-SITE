
<?php

include "config.php";

if (isset($_FILES['fileToUpload'])) {

    $errors = array();

    $file_name  = $_FILES['fileToUpload']['name'];
    $file_size  = $_FILES['fileToUpload']['size'];
    $file_tmp   = $_FILES['fileToUpload']['tmp_name'];
    $file_type  = $_FILES['fileToUpload']['type'];
    $photo_ex = explode('.', $file_name);
    $file_ext    = end($photo_ex);

    $extensions = array("jpeg", "jpg", "png");


    if (in_array($file_ext, $extensions) === false) {

        $errors[] = "THIS IMG NOT SUPPORRTED";
    }

    if ($file_size > 2097152) {

        $errors[] = "MAXIMUM 2MB SIZE";
    }

    $new_name = time() . "-" . basename($file_name);

    $target = "upload/" . $new_name;

    $image_name = $new_name;

    if (empty($errors) == true) {

        move_uploaded_file($file_tmp, $target);

        session_start();
        $post_title  = mysqli_real_escape_string($conn, $_POST['post_title']);
        $postdesc    = mysqli_real_escape_string($conn, $_POST['postdesc']);
        $category    = mysqli_real_escape_string($conn, $_POST['category']);
        $date        = date("m M, Y");
        $author      = $_SESSION["user_id"];


        $sql = "INSERT INTO post (title, description, category, post_date, author, post_img)

                VALUES ('{$post_title}', '{$postdesc}', {$category}, '{$date}', {$author}, '{$image_name}');";

        $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";


        if (mysqli_multi_query($conn, $sql)) {

            header("location: post.php");
        }
    } else {

        foreach ($errors as $error) {
            echo "<p style = 'color:red; text-align:center; margin: 10px 0' > {$error} </p>";
        }
    }
}


?>

