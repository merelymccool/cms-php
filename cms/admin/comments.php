<?php include("includes/header.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>

<?php 
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per = 50; // or set LIMIT in sql
$total = Comment::count_all();
$paginate = new Paginate($page, $items_per, $total);

$sql = "SELECT * FROM comments ORDER BY id DESC LIMIT " . $items_per . " OFFSET " . $paginate->offset();
$comments = Comment::find_query($sql);

// $comments = Comment::find_all();
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
                        <small>View All</small>
                    </h1>
                    <p class="bg-success">
                        <?php echo $msg; ?>
                    </p>

                    <!-- Pagination -->
                    <div class="row">
                        <ul class="pager">
                            <?php 
                            if($paginate->total_pages() > 1) {
                                if($paginate->has_next()) {
                                    echo "<li class='next'><a href='comments.php?page={$paginate->next()}'>Next</a></li>";
                                }

                                if($paginate->has_previous()) {
                                    echo "<li class='previous'><a href='comments.php?page={$paginate->previous()}'>Previous</a></li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- End Pagination -->

                    <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Comment</th>
                                <th>Content</th>
                                <th>Manage</th>
                                <!-- <th>Description</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach ($comments as $comment): ?>
                             <tr>
                                        <td><?php echo$comment->id; ?></td>
                                        <td><?php echo$comment->author; ?></td>
                                        <td><?php echo$comment->body; ?></td>
                                        <td>
                                            <?php
                                                if($comment->blog_id != 0){
                                                    echo "<a href='../post.php?id=$comment->blog_id'>View Blog</a>";
                                                } else {
                                                    echo "<a href='../image.php?id=$comment->photo_id'>View Photo</a>";
                                                } ?>
                                        </td>
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