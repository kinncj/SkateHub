<?php
if (defined('APPLICATION_SALT')) {
    return; // Prevent (PHPUnit) from loading this file again and again
}
date_default_timezone_set('UTC');

// Include Composer's Autoload -------------------------------------------------
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
define('PS', PATH_SEPARATOR);
define('APPLICATION_VERSION', '0.1.0');
define('APPLICATION_ROOT', realpath(__DIR__.DS.'..'));
define('APPLICATION_LIBRARY', APPLICATION_ROOT.DS.'src');
define('APPLICATION_CONF', APPLICATION_ROOT.DS.'conf');
define('APPLICATION_COMPOSER',APPLICATION_ROOT.DS.'vendor');
define('APPLICATION_DOCTRINE_BIN', APPLICATION_COMPOSER.DS.'doctrine'.DS.'orm'.DS.'bin');
if (!file_exists($l=APPLICATION_COMPOSER.DS.'autoload.php')) {
    throw new RuntimeException('Dependencies not installed. See README.md.');
}
require $l;
unset($l);

// Configuration ---------------------------------------------------------------
$env = new APPLICATION\Enviroment();
define('APPLICATION_ENVIROMENT', $env->getName());
define('APPLICATION_SALT', $env->getSalt());
//                                                                      Database
define('APPLICATION_DB_HOST', $env->getDatabaseHost());
define('APPLICATION_DB_USER', $env->getDatabaseUser());
define('APPLICATION_DB_PASSWD', $env->getDatabasePasswd());
define('APPLICATION_DB_NAME', $env->getDatabaseName());
define('APPLICATION_DB_DRIVER', $env->getDatabaseDriver());
define('APPLICATION_DOCTRINE_PROXY_DIR', APPLICATION_LIBRARY.DS.'APPLICATION'.DS.'Proxy');

// Enviroment-aware configurations ---------------------------------------------
ini_set('register_globals', 0);
switch (APPLICATION_ENVIROMENT) {
    case 'development':
        ini_set('display_errors', 1);
        break;
    case 'production':
    default:
        ini_set('display_errors', 0);
        break;
}