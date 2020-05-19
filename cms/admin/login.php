<?php ob_start(); ?>
<?php require_once("includes/header.php"); ?> 

<?php 
if($session->get_signed_in()){
    redirect('index.php');
}

if(isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Method to check database
    $user_found = User::verify_user($username, $password);
    if ($user_found) {
        $success = $session->sign_in($user_found);
        redirect('index.php');
    } else {
        $message = "Login Failed";
    }
} else {
    $username = "";
    $password = "";
    $message = "";
}
?>

<div class="col-md-4 col-md-offset-2">

<div class="row" id="login-id"> 
    <h1>Login</h1>
    <h4 class="bg-danger"><?php echo $message; ?></h4>
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input id="login-box" type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password-box" type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">
        </div>
        <div class="form-group">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </div>
    </form>
    <hr>
    <p style="margin-left: 15px;"><a href="">Register Here</a> | <a href="">Forgot Password?</a></p>
</div>


  <?php include("includes/footer.php"); ?>