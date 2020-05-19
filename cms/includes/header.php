<?php 
ob_start();
// require_once("admin/includes/init.php"); 
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'Applications' . DS . 'XAMPP' . DS . 'xamppfiles' . DS . 'htdocs' . DS . 'php-oop' . DS . 'cms');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'includes');

require_once("admin/includes/functions.php");
require_once("admin/includes/galconfig.php");
require_once("admin/includes/database.php");
require_once("admin/includes/user.php");
require_once("admin/includes/session.php");
require_once("admin/includes/db_object.php");
require_once("admin/includes/photo.php"); 
require_once("admin/includes/paginate.php"); 

?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Merely McCool</title>

        <!-- Bootstrap Core CSS -->
        <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->

        <link href="css/styles.css" rel="stylesheet">

    </head>
<body>

    <!-- Navigation -->
<?php include("navigation.php"); ?>
