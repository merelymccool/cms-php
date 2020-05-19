<?php include("includes/header.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>

<?php 
$message = "";
if(isset($_POST['create'])) {
    $blog = new Blog();
    $blog->blog_title = $_POST['title'];
    $blog->blog_author = $_POST['author'];
    $blog->blog_cat = $_POST['category'];
    $blog->blog_cap = $_POST['caption'];
    $blog->blog_body = $_POST['body'];
    $blog->blog_tags = $_POST['tags'];
    $blog->blog_date = date('l jS \of F Y h:i:s A');

    if(!empty($_FILES['file_upload']['name'])){
        $blog->set_blog_file($_FILES['file_upload']);
        $blog->save_blog_photo();
        redirect('posts.php');
    } else {
        if ($blog->save_all()) {
            redirect('posts.php');
        }
    }
}


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

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Create
                        <small>new post</small>
                    </h1>
                    <h3> <?php echo $message; ?></h3>

                    <div class="col-md-6 col-md-offset-3">
                        <form action="create_post.php" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="post-title" class="form-control" type="text" name="title">
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="author" id="author" required>
                                    <option value="0">Select Author</option>
                                    <?php $users = User::find_all();
                                    foreach($users as $user): ?>
                                    <option value="<?php echo $user->id; ?>"><?php echo $user->user_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="category" id="category" required>
                                    <option value="0">Select Category</option>
                                    <?php $cats = Category::find_all();
                                    foreach($cats as $cat): ?>
                                    <option value="<?php echo $cat->id; ?>"><?php echo $cat->cat_title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="caption">Sub Heading</label>
                                <input id="post-caption" class="form-control" type="text" name="caption">
                            </div>
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea class="form-control" name="body" id="post-body" cols="30" rows="20"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <input id="post-tags" class="form-control" type="text" name="tags">
                            </div>
                            <div class="form-group">
                                <label for="file_upload">Feature Image</label>
                                <input id="post-photo" class="form-control" type="file" name="file_upload">
                            </div>
                            <input id="create-post-btn" class="btn btn-primary" type="submit" name="create" value="Create">
                        </form>

                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>