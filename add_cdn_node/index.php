<?php
/*
 * add_edge/index.php - custom hybrid MVC @Yospace
 *
 */

define('ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);

$url = $_GET['url'];
$page_str = '';

require_once(ROOT . DS . 'config'  . DS . 'config.php');
include(ROOT . DS . 'library' . DS . 'shared.php');

?>



