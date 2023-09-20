<?php


// get Category

$stmt = $db->prepare("SELECT * FROM categories");
$stmt->execute();

$categories = $stmt->fetchAll(PDO::FETCH_OBJ);


$titleErr = '';
$categoryErr = '';
$contentErr = '';
$imageErr = '';


if (isset($_POST['blogCreateBtn'])) {
    $title = $_POST['title'];
    $categoryId = $_POST['category_id'];
    $content = $_POST['content'];
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageType = $_FILES['image']['type'];

    $userId = $_SESSION['user']->id;
    date_default_timezone_set('Asia/Yangon');
    $created_at = date('Y-m-d H:i:s');
    if ($title == '') {
        $titleErr = "The title field is required";
    } else if ($categoryId == '') {
        $categoryErr = "The category field is required";
    } else if ($content == '') {
        $contentErr = "The content field is required";
    } else if ($imageName == '') {
        $imageErr = "The image field is required";
    } else {
        $imageName = uniqid() . '_' . $imageName;
        if (in_array($imageType, ['image/png', 'image/jpg', 'image/jpeg', 'image/avif'])) {
            move_uploaded_file($imageTmpName, "../assets/blog-images/$imageName");
        }

        $stmt = $db->prepare("INSERT INTO blogs(title,category_id,content,image,user_id,created_at)VALUES('$title',$categoryId,'$content','$imageName','$userId','$created_at')");
        $result = $stmt->execute();

        if ($result) {
            echo "<script>sweetAlert('created a new blog','blogs')</script>";
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
                            <input type="text" name="title" class="form-control">
                            <span class="text-danger"><?php echo $titleErr ?></span>

                        </div>

                        <div class="mb-2">
                            <label for="">Category</label>
                            <select name="category_id" id="" class="form-control">
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="">Content</label>
                            <textarea name="content" rows="10" class="form-control"></textarea>
                            <span class="text-danger"><?php echo $contentErr ?></span>

                        </div>

                        <div class="mb-2">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control">
                            <span class="text-danger"><?php echo $imageErr ?></span>

                        </div>

                        <button name="blogCreateBtn" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>