<?php include("includes/header.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>

<?php 
$message = "";
if(isset($_POST['create'])) {
    $user = new User();
    $user->user_name = $_POST['username'];
    $user->user_pass = $_POST['password'];
    $user->first_name = $_POST['firstname'];
    $user->last_name = $_POST['lastname'];
    $user->set_avatar($_FILES['file_upload']);

    if($user->save_all()) {

        if ($user->save_avatar()) {
            $message = "User created successfully!";
            redirect('users.php');
        } 
        redirect('users.php');
        
    } else {
        $message = "Oops! Something went wrong";
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
                        <small>new user</small>
                    </h1>
                    <h3> <?php echo $message; ?></h3>

                    <div class="col-md-6 col-md-offset-3">
                        <form action="create_user.php" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input class="form-control" type="text" name="username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" type="text" name="password">
                            </div>
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input class="form-control" type="text" name="firstname">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input class="form-control" type="text" name="lastname">
                            </div>
                            <div class="form-group">
                                <label for="file_upload">Avatar</label>
                                <input class="form-control" type="file" name="file_upload">
                            </div>
                            <input class="btn btn-primary" type="submit" name="create" value="Create">
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