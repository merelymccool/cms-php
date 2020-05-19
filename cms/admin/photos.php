<?php include("includes/header.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>
<?php 
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per = 25; // or set LIMIT in sql
$total = Photo::count_all();
$paginate = new Paginate($page, $items_per, $total);

$sql = "SELECT * FROM photos ORDER BY id DESC LIMIT " . $items_per . " OFFSET " . $paginate->offset();
$photos = Photo::find_query($sql);
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
                        Photos
                        <small>View All</small>
                    </h1>
                    <p class="bg-success">
                        <?php echo $msg; ?>
                    </p>
                    <a class="btn btn-primary" href="upload.php">Upload New</a>

                    <!-- Pagination -->
                    <div class="row">
                        <ul class="pager">
                            <?php 
                            if($paginate->total_pages() > 1) {
                                if($paginate->has_next()) {
                                    echo "<li class='next'><a href='photos.php?page={$paginate->next()}'>Next</a></li>";
                                }

                                if($paginate->has_previous()) {
                                    echo "<li class='previous'><a href='photos.php?page={$paginate->previous()}'>Previous</a></li>";
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
                                <th>Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Comments</th>
                                <th>Size</th>
                                <th>Extension</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach ($photos as $photo): ?>
                             <tr>
                                        <td><?php echo$photo->id; ?></td>
                                        <td>
                                            <img class="admin-thumb" src='<?php echo$photo->photo_path(); ?>' >
                                            <div class="manage_links">
                                            <a href="../image.php?id=<?php echo $photo->id; ?>">View</a> | 
                                            <a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a> | 
                                            <a class="delete-link" href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                                            </div>
                                        </td>
                                        <td><?php echo$photo->photo_title; ?></td>
                                        <td><?php echo$photo->photo_desc; ?></td>
                                        <td>
                                            <?php 
                                            $comments = Comment::find_photo_comment($photo->id);
                                            count($comments);
                                            ?>
                                            <a href="view_comments.php?id=<?php echo $photo->id;?>"><?php echo count($comments) ?></a>
                                        </td>
                                        <td><?php echo$photo->photo_size; ?></td>
                                        <td><?php echo$photo->photo_ext; ?></td>
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