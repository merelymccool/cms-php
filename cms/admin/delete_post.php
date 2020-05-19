<?php include("includes/init.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>

<?php 
if(empty($_GET['id'])) {
    redirect('posts.php');
} 

$post = Blog::find_id($_GET['id']);

if ($post) {
    $post->delete();
    $session->message("Post ID {$post->id} successfully deleted!");
    redirect('posts.php');
} else {
    $session->message("Post ID {$post->id} successfully deleted!");
    redirect('posts.php');
}

?>