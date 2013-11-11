<?php
return CMap::mergeArray(
                require(dirname(__FILE__) . '/main.php'), array('components' => array(
                'db' => array(
                    'connectionString' => 'mysql:host=altadmin.mysql.ukraine.com.ua;dbname=altadmin_recepti',
                    'emulatePrepare' => true,
                    'username' => 'altadmin_recepti',
                    'password' => 'ztf7buq4',
                    'charset' => 'utf8',
                ),    
                'loger' => array(
                    'class'=>'system.db.CDbConnection',
                    'connectionString' => 'mysql:host=localhost;dbname=upline24org_loger',
                    'emulatePrepare' => true,
                    'username' => 'log_upline24org',
                    'password' => 'ZcDs4cDs',
                    'charset' => 'utf8',
                ),
            ),
                    'params' => array(
                        'host'=>'server',
                        ),
                )
);
?>