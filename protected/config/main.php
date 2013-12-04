<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');
return array(
    'language' => 'ru',
    'sourceLanguage' => 'ru',
    'theme' => 'bootstrap',
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'recepti.dp.ua',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'generatorPaths' => array(
                'bootstrap.gii',
            ),
            'class' => 'system.gii.GiiModule',
            'password' => 'test',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'altadmin',
        'altadmin.parser',
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
        ),
        'file' => array(
            'class' => 'application.extensions.file.CFile',
        ),
        // uncomment the following to enable URLs in path-format
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                // своё правило для URL
                array(
                    'class' => 'application.components.SiteUrlRule',
                    'connectionID' => 'db',
                ),
                //'recipes/dishesList/<id:\d+>' => 'recipes/dishesList',
                'altadmin/logout' => 'altadmin/default/logout',
                'altadmin/restore' => 'altadmin/default/restore',
                'altadmin/confirmation/<key:\w+>' => 'altadmin/default/confirmation',
                'altadmin/confirmation' => 'altadmin/default/confirmation',
                '<modules:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<modules>/<controller>/<action>',
                //'recipes/dishesList/<id:\d+>' => 'recipes/dishesList',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                //'recipes/<category:\w+-\w+>' => 'recipes/dishesList',
                //'recipes/<category:\w+-\w+-\w+>' => 'recipes/dishesList',
                //'recipes/<category:\w+-\w+-\w+>/' => 'recipes/dishesList',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                //'<controller:\w+>/<action:\w+>/<key:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\S+>' => '<controller>/<action>',
                '/selection-recipes' => 'selectionRecipes/index',
                '/selection-recipes/list' => 'selectionRecipes/list',
            ),
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'egor.developer@gmail.com',
        'extraTitle' => ' | recepti.dp.ua',
        'loger' => '1'
    ),
);