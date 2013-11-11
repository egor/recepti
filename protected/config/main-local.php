<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'), array( 'components'=>array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=alt_recepti',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'loger' => array(
            'class'=>'system.db.CDbConnection',
            'connectionString' => 'mysql:host=localhost;dbname=upline24_loger',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ),
    ),
        'params' => array(
            'host'=>'local',
                        ),
        )
);
?>