<?php include("includes/header.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>
<?php 
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per = 25; // or set LIMIT in sql
$total = User::count_all();
$paginate = new Paginate($page, $items_per, $total);

$sql = "SELECT * FROM users LIMIT " . $items_per . " OFFSET " . $paginate->offset();
$users = User::find_query($sql);

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
                        Users
                        <small>View All</small>
                    </h1>
                    <p class="bg-success">
                        <?php echo $msg; ?>
                    </p>
                    <a class="btn btn-primary" href="create_user.php">Create New</a>
                    <!-- Pagination -->
                    <div class="row">
                        <ul class="pager">
                            <?php 
                            if($paginate->total_pages() > 1) {
                                if($paginate->has_next()) {
                                    echo "<li class='next'><a href='users.php?page={$paginate->next()}'>Next</a></li>";
                                }

                                if($paginate->has_previous()) {
                                    echo "<li class='previous'><a href='users.php?page={$paginate->previous()}'>Previous</a></li>";
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
                                <th>Avatar</th>
                                <th>Username</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach ($users as $user): ?>
                             <tr>
                                        <td><?php echo$user->id; ?></td>
                                        <td>
                                            <img class="admin-thumb" src='<?php echo$user->avatar_path(); ?>' >
                                            <div class="manage_links">
                                                <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a> | 
                                                <a class="delete-link" href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                                            </div>
                                        </td>
                                        <td><?php echo$user->user_name; ?></td>
                                        <td><?php echo$user->last_name; ?></td>
                                        <td><?php echo$user->first_name; ?></td>
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