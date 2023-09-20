<?php


require_once('layout/header.php');
require_once('layout/navbar.php');

//get blog all



if (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];
    $stmt = $db->prepare("SELECT blogs.id, blogs.title, blogs.content, blogs.image, blogs.created_at, users.name FROM blogs INNER JOIN users ON blogs.user_id = users.id WHERE blogs.category_id=$categoryId ORDER by blogs.id DESC ");
} else {
    $stmt = $db->prepare("SELECT blogs.id, blogs.title, blogs.content, blogs.image, blogs.created_at, users.name FROM blogs INNER JOIN users ON blogs.user_id = users.id ORDER by blogs.id DESC");
}

$stmt->execute();
$blogs = $stmt->fetchAll(PDO::FETCH_OBJ);



//get blogs depending on category

?>


<!-- Nav -->

<!-- Header -->
<header class="pt-5">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-6 text-center">
                <img src="assets/images/header.jpg" class="img-fluid rounded" alt="" data-aos="zoom-in" data-aos-duration="1000">
            </div>
            <div class="col-md-6 py-5 text-center" data-aos="zoom-in" data-aos-duration="1000">
                <h1>Today a reader, tomorrow a leader :)</h1>
                <h5>Focus on your dream & fight for it, then become the king</h5>
            </div>
        </div>
    </div>
</header>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#6366f1" fill-opacity="1" d="M0,128L60,138.7C120,149,240,171,360,165.3C480,160,600,128,720,138.7C840,149,960,203,1080,208C1200,213,1320,171,1380,149.3L1440,128L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
</svg>

<!-- Main Content -->
<div id="blog">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3 data-aos="fade-right" data-aos-duration="1000">Read Our Blogs</h3>
                <div class="heading-line" data-aos="fade-left" data-aos-duration="1000"></div>
                <?php foreach ($blogs as $blog) : ?>
                    <div class="card my-3" data-aos="zoom-in" data-aos-duration="1000">
                        <div class="card-body p-0">
                            <div class="img-wrapper">
                                <img src="assets/blog-images/<?php echo $blog->image  ?>" class="img-fluid" alt="">
                            </div>
                            <div class="content p-3">
                                <h5 class="fw-semibold"><?php echo $blog->title ?></h5>
                                <div class="mb-3"><?php echo $blog->created_at ?> | by <?php echo $blog->name ?></div>
                                <p><?php echo substr($blog->content, 0, 200) ?>
                                    <a href="blog-detail.php?blog_id=<?php echo $blog->id ?>" class="text-decoration-none">See More </a>
                                </p>
                            </div>
                        </div>
                    </div>

                <?php endforeach ?>

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