<?php include "header.php";

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>
                <!-- /Form End -->

                <?php

                if (isset($_POST['save'])) {

                    include "config.php";

                    $category = mysqli_real_escape_string($conn, $_POST['cat']);

                    $sqlIn = "INSERT INTO category (category_name)
                        VALUES ('{$category}')";

                    $res2 = mysqli_query($conn, $sqlIn);

                    if ($res2) {

                        header("location: category.php");
                    } else {
                        echo "<p style = 'color:red; text-align:center; margin: 10px 0' > CANT LOAD </p>";
                    }
                }

                ?>

            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>