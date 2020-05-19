<?php require_once("admin/includes/init.php");

$blogs = Blog::find_all();

include("includes/header.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <h1>miaBlogs</h1>

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->
                <?php foreach($blogs as $blog): ?>
                <!-- Title -->
                <h2><a href="post.php?id=<?php echo $blog->id ?>"><?php echo $blog->blog_title; ?></a></h2>

                <!-- Author -->
                <p class="lead">
                    <?php $user = User::find_id($blog->blog_author); ?>
                    by <a href="author.php?id=<?php echo $user->id ?>"><?php echo $user->user_name; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <!-- <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr> -->

                <!-- Preview Image -->
                <a href="post.php?id=<?php echo $blog->id ?>"><img class="img-responsive" src="admin/<?php echo $blog->default_blog_photo(); ?>" alt=""></a>

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $blog->blog_cap; ?></p>
                <p><?php 
                $blog->blog_body = (strlen($blog->blog_body) > 300) ? substr($blog->blog_body,0,300).'...' : $blog->blog_body;
                echo $blog->blog_body; ?></p>
                <p><a href="post.php?id=<?php echo $blog->id ?>">Read More</a></p>
                <hr>
                <?php endforeach; ?>
            </div>


            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

            <?php include("includes/sidebar.php"); ?>



</div>
<!-- /.row -->

<?php include("includes/footer.php"); ?>
