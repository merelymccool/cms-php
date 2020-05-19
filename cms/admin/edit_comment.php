<?php include("includes/header.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>
<?php $comments = Comment::find_all(); ?>

<?php 
$message = "";
if(empty($_GET['id'])) {
    redirect('comments.php');
} else {
    $comment = Comment::find_id($_GET['id']);

    if(isset($_POST['update'])) {
        if($comment) {
            $comment->author = $_POST['author'];
            $comment->body = $_POST['body'];
            $comment->save_all();
            $session->message("Comment ID {$comment->id} successfully updated!");
            redirect("comments.php");
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
                        Edit Comments
                        <small>ID <?php echo $_GET['id']; ?></small>
                    </h1>
                    <h3> <?php echo $message; ?></h3>

                    <div class="col-md-8">
                        <form action="" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="title">Author</label>
                        <input type="text" name="author" class="form-control" value="<?php echo $comment->author; ?>">
                    </div>
                    <div class="form-group">
                        <label for="caption">Comment</label>
                        <textarea name="body" id="body" cols="30" rows="10"><?php echo $comment->body; ?></textarea>
                    </div>
                    </div>

                    <div class="col-md-4" >
                            <div  class="photo-info-box">
                                <div class="info-box-header">
                                   <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                </div>
                            <div class="inside">
                              <div class="box-inner">
                                 <p class="text">
                                   <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                                  </p>
                                  <p class="text ">
                                    Photo Id: <span class="data photo_id_box">34</span>
                                  </p>
                                  <p class="text">
                                    Filename: <span class="data">image.jpg</span>
                                  </p>
                                 <p class="text">
                                  File Type: <span class="data">JPG</span>
                                 </p>
                                 <p class="text">
                                   File Size: <span class="data">3245345</span>
                                 </p>
                              </div>
                              <div class="info-box-footer clearfix">
                                <div class="info-box-delete pull-left">
                                    <a class="delete-link" href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                                </div>
                                <div class="info-box-update pull-right ">
                                    <input type="submit" name="submit" value="Update" class="btn btn-primary btn-lg ">
                                </div>   
                              </div>
                            </div>          
                        </div>
                    </div>
                        </form>

                </div>
            </div>
            <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>