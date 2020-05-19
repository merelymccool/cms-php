<?php include("includes/init.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>

<?php 
if(empty($_GET['id'])) {
    redirect('comments.php');
} 

$comment = Comment::find_id($_GET['id']);

if ($comment) {
    $comment->delete();
    $session->message("Comment ID {$comment->id} successfully deleted!");
    redirect('comments.php');
} else {
    $session->message("Comment ID {$comment->id} successfully deleted!");
    redirect('comments.php');
}

?>