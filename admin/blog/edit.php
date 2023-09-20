<?php
$blogId = $_GET['blog_id'];

// Get Blog

$blogStmt = $db->prepare("SELECT * FROM blogs WHERE id=$blogId");
$blogStmt->execute();
$blog = $blogStmt->fetchObject();


// Get Category

$stmt = $db->prepare("SELECT * FROM categories");
$stmt->execute();

$categories = $stmt->fetchAll(PDO::FETCH_OBJ);

$titleErr = '';
$categoryErr = '';
$contentErr = '';
$imageErr = '';



if (isset($_POST['blogUpdateBtn'])) {
    $title = $_POST['title'];
    $categoryId = $_POST['category_id'];
    $content = $_POST['content'];
    $userId = $_SESSION['user']->id;

    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageType = $_FILES['image']['type'];

    if ($title == '') {
        $titleErr = "The title field is required";
    } else if ($categoryId == '') {
        $categoryId = "The category field is required";
    } else if ($content == '') {
        $contentErr = "The content field is required";
    } else {
        if ($imageName == '') {
            $stmt = $db->prepare("UPDATE blogs SET title= '$title',category_id = $categoryId, content= '$content' WHERE id='$blogId'");
            $stmt->execute();
            echo "<script>sweetAlert('updated a new blog','blogs')</script>";
        } else {
            //delete old photo
            unlink("../assets/blog-images/$blog->image");
            $imageName = uniqid() . '_' . $imageName;

            if (in_array($imageType, ['image/png', 'image/jpg', 'image/jpeg', 'image/avif'])) {
                move_uploaded_file($imageTmpName, "../assets/blog-images/$imageName");
            }

            $stmt = $db->prepare("UPDATE blogs SET title= '$title',category_id = $categoryId, content= '$content',image= '$imageName' WHERE id='$blogId'");
            $result = $stmt->execute();
            if ($result) {
                echo "<script>sweetAlert('updated a new blog','blogs')</script>";
            }
        }
    }
}
?>

<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Blog Creation Form </h6>
                    <a href="index.php?page=blogs" class=" btn-primary btn-sm ">
                        <i class="fas fa-angle-double-left"></i> Back</a>

                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $blog->title ?>">
                            <span class="text-danger"><?php echo $titleErr ?></span>

                        </div>

                        <div class="mb-2">
                            <label for="">Category</label>
                            <select name="category_id" id="" class="form-control">
                                <option value="">Select Category</option>
                                <!-- Important edit select -->
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category->id ?>" <?php
                                                                                if ($category->id == $blog->category_id) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>><?php echo $category->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="">Content</label>
                            <textarea name="content" rows="10" class="form-control" value="<?php echo $blog->content ?>"><?php echo $blog->content ?></textarea>
                            <span class="text-danger"><?php echo $contentErr ?></span>
                        </div>

                        <div class="mb-2">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control">
                            <img src="../assets/blog-images/<?php echo $blog->image ?>" alt="" style="width:100px" ;>

                        </div>

                        <button name="blogUpdateBtn" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>