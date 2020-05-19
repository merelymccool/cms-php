<?php
require_once("init.php");
$ajax_user = new User();

if(isset($_POST['image_id'])) {
    $ajax_user->ajax_save_avatar($_POST['image_id'], $_POST['user_id']);
}

if(isset($_POST['photo_id'])) {
    Photo::ajax_photo_info($_POST['photo_id']);
}

?>