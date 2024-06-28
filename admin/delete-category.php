<?php

if ($_SESSION["user_role"] == 0) {

    header("location: post.php");
}

include "config.php";

$id = $_GET['id'];

$sql = "DELETE FROM category WHERE category_id = {$id}";
$res = mysqli_query($conn, $sql) or die("QUERY FAILED");

if ($res) {

    header("location: category.php");
} else {
    echo "<p style = 'color:red; text-align:center; margin: 10px 0' >CANT DELETE! </p>";
}
