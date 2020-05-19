<?php ob_start(); ?>
<?php require_once("includes/header.php"); ?> 

<?php 

$session->sign_out();

redirect('login.php');

?>