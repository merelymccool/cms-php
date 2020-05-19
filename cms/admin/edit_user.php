<?php include("includes/header.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>
<?php $users = User::find_all(); ?>

<?php 
$message = "";
if(empty($_GET['id'])) {
    redirect('users.php');
} else {
    $user = User::find_id($_GET['id']);

    if(isset($_POST['submit'])) {
        if($user) {
            $user->user_name = $_POST['username'];
            $user->user_pass = $_POST['password'];
            $user->first_name = $_POST['firstname'];
            $user->last_name = $_POST['lastname'];

            if(empty($_FILES['file_upload'])) {
                $user->save_all();
                $session->message("User ID {$user->id} successfully updated!");
                redirect("users.php");
            } else {
                $user->set_avatar($_FILES['file_upload']);
                $user->save_avatar();
                $user->save_all();
                $session->message("User ID {$user->id} successfully updated!");
                redirect("users.php");
            }
        }
    }
}

$ajax_user = new User();

if(isset($_POST['image_id'])) {
    $ajax_user->ajax_save_avatar($_POST['image_id'], $_POST['user_id']);
}

include('modal.php');
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
        <?php $user = User::find_id($_GET['id']); ?>
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Edit User
                        <small>ID <?php echo $user->id; ?></small>
                    </h1>
                    <h3> <?php echo $message; ?></h3>

                    <div class="col-md-6 form-group">
                        <a class="thumbnail" href="" data-toggle="modal" data-target="#library"><img class="user_image_box" src="<?php echo $user->avatar_path(); ?>" alt=""></a>
                    </div>

                    <div class="col-md-6">
                        <form action="" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="title">Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $user->user_name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="file_upload">Avatar</label>
                        <input class="form-control" type="file" name="file_upload">
                    </div>
                    <div class="form-group">
                        <label for="caption">Password</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $user->user_pass; ?>">
                    </div>
                    <div class="form-group">
                        <label for="alt-text">First Name</label>
                        <input type="text" name="firstname" class="form-control" value="<?php echo $user->first_name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="alt-text">Last Name</label>
                        <input type="text" name="lastname" class="form-control" value="<?php echo $user->last_name; ?>">
                    </div>
                    <div class="info-box-footer clearfix">
                        <div class="info-box-delete pull-left">
                            <a class="delete-link" id="user-id" href="delete_user.php?id=<?php echo $_GET['id']; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                        </div>
                        <div class="info-box-update pull-right ">
                            <input type="submit" name="submit" value="Update" class="btn btn-primary btn-lg ">
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

  <?php   include("includes/footer.php"); ?>