<?php include("includes/header.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>

<?php 
if(empty($_GET['id'])) {
    redirect("photos.php");
}

$comments = Comment::find_comment($_GET['id']);

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
                        Comments
                        <small>for Photo <?php echo $_GET['id']; ?></small>
                    </h1>
                    <p class="bg-success">
                        <?php echo $msg; ?>
                    </p>

                    <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Comment</th>
                                <th>Username</th>
                                <th>Photo</th>
                                <th>Manage</th>
                                <!-- <th>Description</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach ($comments as $comment): ?>
                             <tr>
                                        <td><?php echo$comment->id; ?></td>
                                        <td><?php echo$comment->body; ?></td>
                                        <td><?php echo$comment->author; ?></td>
                                        <td><a href="../photo.php?id=<?php echo$comment->photo_id; ?>">Photo Title</a></td>
                                        <td>
                                            <a href="edit_comment.php?id=<?php echo $comment->id; ?>">Edit</a> | 
                                            <a class="delete-link" href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
                                        </td>
                                    </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>

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
            <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>