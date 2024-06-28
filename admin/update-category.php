<?php include "header.php";

if ($_SESSION["user_role"] == 0) {

    header("location: post.php");
}

if (isset($_POST['sumbit'])) {

    include "config.php";


    $id = mysqli_real_escape_string($conn, $_POST['cat_id']);
    $name = mysqli_real_escape_string($conn, $_POST['cat_name']);

    $upSql = "UPDATE category SET category_name = '{$name}' WHERE category_id  = {$id}";
    $result = mysqli_query($conn, $upSql) or die("QUERY FAILED!");

    if ($result) {

        // header("location: category.php");
    }
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">

                <?php

                include "config.php";

                $userId = $_GET['id'];

                $sql = "SELECT * FROM category WHERE category_id = {$userId}";
                $res =  mysqli_query($conn, $sql) or die("QUERY FAILED");

                if (mysqli_num_rows($res) > 0) {

                    while ($row = mysqli_fetch_assoc($res)) {

                ?>

                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="cat_id" class="form-control" value="<?php echo $row['category_id'] ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'] ?>" placeholder="" required>
                            </div>
                            <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                        </form>

                <?php }
                } ?>

            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>