<?php 
define('BASE_DIR', './');
define('PUBLIC_DIR', BASE_DIR.'public/');
define('PROTECTED_DIR', BASE_DIR.'protected/');
define('BASE_PATH',__DIR__);

define('DATABASE_CONTROLLER', PROTECTED_DIR.'database.php');
define('USER_MANAGER', PROTECTED_DIR.'userManager.php');
define('DOMAIN', 'http://localhost:80/EB6SAR_Beadando/index.php');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost:3308');
define('DB_NAME', 'eb6sar');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');
?>