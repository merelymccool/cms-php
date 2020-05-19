<?php 

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'Applications' . DS . 'XAMPP' . DS . 'xamppfiles' . DS . 'htdocs' . DS . 'php-oop' . DS . 'cms');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'includes');

ob_start();

require_once("functions.php");
require_once("galconfig.php");
require_once("database.php");
require_once("user.php");
require_once("session.php");
require_once("db_object.php");
require_once("photo.php");
require_once("blog.php");
require_once("category.php");



?>