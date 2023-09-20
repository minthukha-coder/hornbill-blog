<?php

// GET Categories
$stmt = $db->prepare("SELECT * FROM categories");
$stmt->execute();

$categories = $stmt->fetchAll(PDO::FETCH_OBJ);


// GET Blogs
$blogStmt = $db->prepare("SELECT blogs.id, blogs.title, blogs.content, blogs.image, blogs.created_at, users.name FROM blogs INNER JOIN users ON blogs.user_id = users.id ORDER by blogs.id DESC LIMIT 4");
$blogStmt->execute();
$blogs = $blogStmt->fetchAll(PDO::FETCH_OBJ);


?>


<div class="col-md-4">
    <h5 data-aos="fade-left" data-aos-duration="1000">Blogs Categories</h5>
    <div class="heading-line" data-aos="fade-right" data-aos-duration="1000"></div>
    <ul class="mb-5" data-aos="zoom-in" data-aos-duration="1000">

        <?php foreach ($categories as $category) : ?>
            <li class="my-2"><a href="index.php?category_id=<?php echo $category->id ?>"><?php echo $category->name ?></a></li>

        <?php endforeach  ?>
    </ul>
    <h5 data-aos="fade-left" data-aos-duration="1000">Blogs You May Like</h5>
    <div class="heading-line" data-aos="fade-right" data-aos-duration="1000"></div>
    <?php foreach ($blogs as $blog) : ?>
        <a href="blog-detail.php?blog_id=<?php echo $blog->id ?>">
            <div class="recent-blog border rounded p-2 my-1 d-flex justify-content-between align-items-center" data-aos="zoom-in" data-aos-duration="1000">
                <img src="assets/blog-images/<?php echo $blog->image ?>" alt="">
                <div class="ms-2">
                    <?php echo substr($blog->content, 0, 50) ?> ...
                </div>
            </div>
        </a>
    <?php endforeach ?>


</div>