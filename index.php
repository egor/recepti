<?php
// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
if($_SERVER['SERVER_ADDR']=='127.0.0.1' && $_SERVER['HTTP_HOST']=='recepti.dp.ua.local'){
    // remove the following lines when in production mode
    defined('YII_DEBUG') or define('YII_DEBUG',true);
    // specify how many levels of call stack should be shown in each log message
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
    $config=dirname(__FILE__).'/protected/config/main-local.php';
} else {
    //defined('YII_DEBUG') or define('YII_DEBUG',true);
    // specify how many levels of call stack should be shown in each log message
    //defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
    $config=dirname(__FILE__).'/protected/config/main-server.php';
}
require_once($yii);
Yii::createWebApplication($config)->run();