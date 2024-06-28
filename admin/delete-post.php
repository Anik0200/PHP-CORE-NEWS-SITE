<?php

include "config.php";

$post_id = $_GET['id'];
$cat_id  = $_GET['catid'];

$sql1 = "SELECT * FROM post WHERE post_id = {$post_id}";
$res  = mysqli_query($conn, $sql1) or die("IMAGE DELETE QUERY FAILEd");
$row  = mysqli_fetch_assoc($res);

unlink("upload/" . $row['post_img']);

$sql = "DELETE FROM post WHERE post_id = {$post_id};";
$sql .= "UPDATE category SET post= post - 1 WHERE category_id = {$cat_id}";

if (mysqli_multi_query($conn, $sql)) {

    header("location: post.php");
} else {

    echo "<p style = 'color:red; text-align:center; margin: 10px 0' >QUERY FAILED! </p>";
}
