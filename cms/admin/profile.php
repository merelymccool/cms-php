<?php include("includes/header.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>
<?php 
// $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
// $items_per = 5; // or set LIMIT in sql
// $total = Photo::count_all();
// $paginate = new Paginate($page, $items_per, $total);

// $sql = "SELECT * FROM photos ORDER BY id DESC LIMIT " . $items_per . " OFFSET " . $paginate->offset();
// // $photos = Photo::find_query($sql);

$photos = User::user_photos($_SESSION['user_id']);
$user = User::find_id($_SESSION['user_id']); ?>

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
                        My Profile
                        <small>User ID <?php echo $_SESSION['user_id']; ?></small>
                    </h1>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <a class="thumbnail" href="" data-toggle="modal" data-target="#library"><img width="200" class="user_image_box" src="<?php echo $user->avatar_path(); ?>" alt=""></a>
                        </div> <!-- End col-md-6 -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Username</label>
                                <p><?php echo $_SESSION['user_name']; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="alt-text">First Name</label>
                                <p><?php echo $_SESSION['first_name']; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="alt-text">Last Name</label>
                                <p><?php echo $_SESSION['last_name']; ?></p>
                            </div>
                        </div> <!-- End col-md-6 -->
                    </div> <!-- End Row -->
                </div> <!-- End col-lg-12 -->
            </div> <!-- End Row -->
            <hr>
            <h3>My Photos</h3>
            <p class="bg-success">
                <?php echo $msg; ?>
            </p>
            <!-- Pagination -->
            <!-- <div class="row">
                <ul class="pager">
                    <?php 
                    // if($paginate->total_pages() > 1) {
                    //     if($paginate->has_next()) {
                    //         echo "<li class='next'><a href='profile.php?page={$paginate->next()}'>Next</a></li>";
                    //     }

                    //     if($paginate->has_previous()) {
                    //         echo "<li class='previous'><a href='profile.php?page={$paginate->previous()}'>Previous</a></li>";
                    //     }
                    // }
                    ?>
                </ul>
            </div> -->
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
                                    <a href="../photo.php?id=<?php echo $photo->id; ?>">View</a> | 
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
            </div> <!-- End of col-md-12 -->


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