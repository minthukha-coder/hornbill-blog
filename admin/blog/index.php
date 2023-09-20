<?php

//Get Blogs

// Three Table Join blogs categories users 
$stmt = $db->prepare("SELECT blogs.id, blogs.title, blogs.content, blogs.image, blogs.created_at, categories.name as category_name , users.name as user_name
 FROM blogs
 INNER JOIN categories ON blogs.category_id = categories.id 
 INNER JOIN users ON blogs.user_id = users.id");
$stmt->execute();

$blogs = $stmt->fetchAll(PDO::FETCH_OBJ);

// DElETE blog
if (isset($_POST['blogDeleteBtn'])) {
    $blogId = $_POST['blog_id'];

    $selectStmt = $db->prepare("SELECT image FROM blogs WHERE id=$blogId");
    $selectStmt->execute();
    $blog = $selectStmt->fetchObject();

    $stmt = $db->prepare("DELETE FROM blogs WHERE id=$blogId");
    $result = $stmt->execute();

    if ($result) {
        unlink("../assets/blog-images/$blog->image");
        echo "<script>sweetAlert('deleted a blog','blogs')</script>";
    }
}
?>

<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Blog List</h6>
                    <a href="index.php?page=blogs-create" class=" btn-primary btn-sm "><i class="fas fa-plus"></i> Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Content</th>
                                    <th>Author</th>
                                    <th>Created_at</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($blogs as $blog) :
                                ?>
                                    <tr>
                                        <td><?php echo $blog->id ?></td>
                                        <td>
                                            <img src="../assets/blog-images/<?php echo $blog->image ?>" alt="" style="width:100px"">
                                        </td>
                                        <td><?php echo $blog->title ?></td>
                                        <td><?php echo $blog->category_name ?></td>
                                        <td>
                                            <div style = " max-width:300px;max-height:200px;overflow:auto;">
                                            <?php echo $blog->content ?>
                    </div>
                    </td>
                    <td><?php echo $blog->user_name ?></td>
                    <td><?php echo $blog->created_at ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="blog_id" value="<?php echo $blog->id ?>">
                            <a href="index.php?page=blogs-edit&blog_id=<?php echo $blog->id ?>" class="btn btn-danger btn-sm m-1" title="edit"><i class="far fa-edit"></i></a>
                            <button name="blogDeleteBtn" class="btn btn-success btn-sm m-1" onclick="return confirm('Are you sure to delete?')" title="delete"><i class="fas fa-trash-alt"></i></button>
                            <a href="index.php?page=blogs-comments&blog_id=<?php echo $blog->id ?>" class="btn btn-info btn-sm m-1" title="comments">
                                <i class="far fa-comment-dots"></i>
                            </a>
                        </form>
                    </td>
                    </tr>
                <?php
                                endforeach
                ?>

                </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>


</div>