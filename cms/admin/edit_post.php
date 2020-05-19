<?php include("includes/header.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>
<?php //$blogs = Blog::find_all(); ?>

<?php 
$message = "";
if(empty($_GET['id'])) {
    redirect('posts.php');
} else {
    $blog = Blog::find_id($_GET['id']);

    if(isset($_POST['submit'])) {
        if($blog) {
            $blog->blog_cat = $_POST['category'];
            $blog->blog_author = $_POST['author'];
            $blog->blog_title = $_POST['title'];
            $blog->blog_cap = $_POST['caption'];
            $blog->blog_body = $_POST['body'];
            $blog->blog_tags = $_POST['tags'];

            if(empty($_FILES['file_upload']['name'])){
                $blog->blog_photo = $blog->blog_photo;
                if ($blog->save_all()) {
                    redirect('posts.php');
                }
            } else {
                $blog->set_blog_file($_FILES['file_upload']);
                $blog->save_blog_photo();
                redirect('posts.php');
            }
        }
    }
}

include('modal-blog.php');
?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <!-- Brand and toggle get grouped for better mobile display -->
        <!-- Top Menu Items -->
        <?php include("includes/top_nav.php"); ?>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <?php include("includes/sidenav.php"); ?>

        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">
        <?php $blog = Blog::find_id($_GET['id']); ?>
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Edit User
                        <small>ID <?php echo $blog->id; ?></small>
                    </h1>
                    <h3> <?php echo $message; ?></h3>

                    <div class="col-md-6 form-group">
                        <a class="thumbnail" href="" data-toggle="modal" data-target="#library"><img class="user_image_box" src="<?php echo $blog->default_blog_photo(); ?>" alt=""></a>
                    </div> <!-- end col 6 -->

                    <div class="col-md-6">
                        <form action="" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" type="text" name="title" class="form-control" value="<?php echo $blog->blog_title; ?>">
                            </div>
                            <div class="form-group">
                                <label for="file_upload">Feature Image</label>
                                <input class="form-control" type="file" name="file_upload">
                            </div>
                            <div class="form-group">
                                <label for="caption">Caption</label>
                                <input id="caption" type="text" name="caption" class="form-control" value="<?php echo $blog->blog_cap; ?>">
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <input id="tags" type="text" name="tags" class="form-control" value="<?php echo $blog->blog_tags; ?>">
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="author" id="author">
                                    <option value="<?php echo $blog->blog_author ?>">Update Author</option>
                                    <?php $users = User::find_all();
                                    foreach($users as $user): ?>
                                    <option value="<?php echo $user->id; ?>"><?php echo $user->user_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="category" id="category">
                                    <option value="<?php echo $blog->blog_cat ?>">Update Category</option>
                                    <?php $cats = Category::find_all();
                                    foreach($cats as $cat): ?>
                                    <option value="<?php echo $cat->id; ?>"><?php echo $cat->cat_title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                    </div> <!-- end col 6 -->
                </div> <!-- end col 12 -->
            </div> <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea class="form-control" name="body" id="body" cols="30" rows="20"><?php echo $blog->blog_body; ?></textarea>
                            </div>
                            <div class="info-box-footer clearfix">
                                <div class="info-box-delete pull-left">
                                    <a id="user-id" href="delete_user.php?id=<?php echo $_GET['id']; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                                </div>
                                <div class="info-box-update pull-right ">
                                    <input id="update-post-btn" type="submit" name="submit" value="Update" class="btn btn-primary btn-lg ">
                                </div>   
                            </div>
                        </form>
                </div> <!-- end col 12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->
  <?php   include("includes/footer.php"); ?>