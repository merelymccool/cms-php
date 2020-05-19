<?php include("includes/init.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>

<?php 
if(empty($_GET['id'])) {
    redirect('users.php');
} 

$user = User::find_id($_GET['id']);

if ($user) {
    $user->delete_user();
    $session->message("User ID {$user->id} successfully deleted!");
    redirect("users.php");
} else {
    $session->message("User ID {$user->id} successfully deleted!");
    redirect("users.php");
}

?>