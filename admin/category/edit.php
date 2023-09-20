<?php

// Select

// Edit Or Get
$categoryId = $_GET['category_id'];

$stmt = $db->prepare("SELECT * FROM categories WHERE id = '$categoryId'");
$stmt->execute();
$category = $stmt->fetchObject();

// Update

$nameErr = "";
if (isset($_POST['categoryUpdateBtn'])) {
    $name = $_POST['name'];
    if ($name === '') {
        $nameErr = "The name field is required";
    } else {
        $stmt = $db->prepare("UPDATE categories SET name = '$name' WHERE id=$categoryId");
        $stmt->execute();
        echo "<script>sweetAlert('Updated a new category','categories')</script>";
    }
}
?>

<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Category Edit Form </h6>
                    <a href="index.php?page=categories" class=" btn-primary btn-sm ">
                        <i class="fas fa-angle-double-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-2">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $category->name ?>">
                        </div>
                        <span class="text-danger"><?php echo $nameErr ?></span>

                        <button name="categoryUpdateBtn" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>