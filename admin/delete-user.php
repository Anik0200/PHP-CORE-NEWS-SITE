<?php 

// if ($_SESSION["user_role"] == 0) {

//     header("location: post.php");
// }

include "config.php";

$userid = $_GET['id'];

$sql = "DELETE FROM user WHERE user_id = {$userid}";
$res = mysqli_query($conn, $sql) or die("QUERY FAILED");

if ($res) {

    header("location: users.php");
}else{
    echo "<p style = 'color:red; text-align:center; margin: 10px 0' >CANT DELETE! </p>";
}
