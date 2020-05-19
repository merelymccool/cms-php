<?php require_once("admin/includes/init.php");
if(empty($_GET['id'])) {
    redirect('blog.php');
}

$blogs = Blog::find_user_posts($_GET['id']);
$user = User::find_id($_GET['id']);

include("includes/header.php"); ?>
    <h1>Journal: <?php echo $user->user_name; ?></h1>
    
    <main id="blog-container">
        <?php foreach($blogs as $blog): ?>
            
        <section class="blog-box">
            <a class="blog-link" href="post.php?id=<?php echo $blog->id ?>"><img class="sc-img" src="admin/<?php echo $blog->default_blog_photo(); ?>" alt=""></a>
            <h3 class="blog-title"><a class="blog-link" href="post.php?id=<?php echo $blog->id ?>"><?php echo $blog->blog_title; ?></a></h3>
            <p class="blog-post blog-link"><?php 
                $blog->blog_body = (strlen($blog->blog_body) > 150) ? substr($blog->blog_body,0,150).'...' : $blog->blog_body;
                echo $blog->blog_body; ?></p>
            <p><a class="blog-link" href="post.php?id=<?php echo $blog->id ?>"><button>Read More</button></a></p>
        </section>
        <?php endforeach; ?>
    </main>

<?php include("includes/footer.php"); ?>
