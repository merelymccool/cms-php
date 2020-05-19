<?php include("includes/init.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>

<?php 
if(empty($_GET['id'])) {
    redirect('photos.php');
} 

$photo = Photo::find_id($_GET['id']);

if ($photo) {
    $photo->delete_photo();
    $session->message("Photo ID {$photo->id} successfully deleted!");
    redirect('photos.php');
} else {
    $session->message("Photo ID {$photo->id} successfully deleted!");
    redirect('photos.php');
}

?>