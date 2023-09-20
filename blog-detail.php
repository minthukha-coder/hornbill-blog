<?php
require_once('layout/header.php');
require_once('layout/navbar.php');

// Get Blog

$blogId = $_GET['blog_id'];

$stmt = $db->prepare("SELECT blogs.id, blogs.title, blogs.content, blogs.image, blogs.created_at, users.name FROM blogs INNER JOIN users ON blogs.user_id = users.id WHERE blogs.id=$blogId");
$result = $stmt->execute();
if ($result) {
    $blog = $stmt->fetchObject();
}

// Create Comment

if (isset($_POST['createCommentBtn'])) {
    $text = $_POST['text'];
    $userId = $_SESSION['user']->id;
    $date = date('Y-m-d H:i:s');
    $stmt = $db->prepare("INSERT INTO comments(text,blog_id,user_id,created_at)VALUES('$text',$blogId,$userId,'$date')");
    $result = $stmt->execute();
    if ($result) {
        echo "<script>sweetAlert('created a comment','blog-detail.php?blog_id=" . $blogId . "')</script>";
    }
}

//Get Comment Depending on Blog


$commentStmt = $db->prepare("SELECT comments.text ,comments.created_at ,users.name FROM comments INNER JOIN users ON comments.user_id= users.id WHERE blog_id=$blogId");
$commentStmt->execute();
$comments = $commentStmt->fetchAll(PDO::FETCH_OBJ);


?>

<!-- Nav -->


<!-- Main Content -->
<div id="blog-detail">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8">
                <h3 data-aos="fade-right" data-aos-duration="1000">Blog Detail</h3>
                <div class="heading-line" data-aos="fade-left" data-aos-duration="1000"></div>
                <div class="card my-3" data-aos="zoom-in" data-aos-duration="1000">
                    <div class="card-body p-0">
                        <div class="img-wrapper">
                            <img src="assets/blog-images/<?php echo $blog->image ?>" class="img-fluid" alt="">
                        </div>
                        <div class="content p-3">
                            <h5 class="fw-semibold"><?php echo $blog->title ?></h5>
                            <div class="mb-3"><?php echo $blog->created_at ?> | by <?php echo $blog->name ?></div>
                            <p>
                                <?php echo $blog->content ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Comment Section -->

                <div class="comment">
                    <?php if (isset($_SESSION['user'])) : ?>
                        <h5 data-aos="fade-right" data-aos-duration="1000">Leave a Comment</h5>
                        <form action="" method="post" data-aos="fade-left" data-aos-duration="1000">
                            <div class="mb-2">
                                <textarea name="text" rows="5" class="form-control" required></textarea>
                            </div>
                            <button type="submit" name="createCommentBtn" class="btn btn-primary">Submit</button>
                        </form>

                    <?php else : ?>
                        <a class="btn btn-primary" href="#signIn" data-bs-toggle="offcanvas" aria-controls="staticBackdrop">Sign in to comment</a>

                    <?php endif; ?>


                    <h6 class="fw-bold mt-5">User's Comments</h6>
                    <div class="card card-body my-3" data-aos="fade-right" data-aos-duration="1000">

                        <?php if (count($comments) >= 1) : ?>
                            <?php foreach ($comments as $comment) : ?>
                                <h6><?php echo $comment->name ?></h6>
                                <?php echo  $comment->text ?>
                                <div class="mt-3">
                                    <span class="float-end"><?php echo $comment->created_at ?></span>
                                </div>
                            <?php endforeach ?>

                        <?php else : ?>
                            <p>No Comment</p>

                        <?php endif; ?>


                    </div>

                </div>
            </div>
            <!-- right side -->
            <?php
            require_once('layout/right-side.php');
            ?>
        </div>
    </div>
</div>

<!-- footer -->
<?php
require_once('layout/footer.php');
?>