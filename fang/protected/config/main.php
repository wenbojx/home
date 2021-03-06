<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Application',
    'defaultController' => 'home/list',
    'charset'=>'utf-8',
    // preloading 'log' component
    'preload'=>array('log'),
    // autoloading model and component classes
    'import'=>array(
        'application.models.*',

    	'application.models.member.*',

    	'application.components.*',
    ),

    'modules'=>array(
        // uncomment the following to enable the Gii tool

        'gii'=>array(
            //'class'=>'system.gii.GiiModule',
            //'password'=>'222',
             // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
        'my',
    ),

    // application components
    'components'=>array(
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'loginUrl' => array('member/login'),
        ),
        // uncomment the following to enable URLs in path-format

        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'rules'=>array(
                '/m'=>'/member/login/a/',
                '/a/<id:\d+>/*'=>'/home/basic/a/',
                '/<id:\d+>/*'=>'/home/list/a/',
                //'gpic/<.*>'=>'home/pictrue/index',
            ),
        ),
/*         'session' => array(
        		'savePath' => '/some/writeable/path',
        		'cookieMode' => 'allow',
        		'cookieParams' => array(
        				'path' => '/',
        				'domain' => '.yiluhao.com',
        				'httpOnly' => true,
        		),
        ), */
        'image'=>array(
        		'class'=>'application.extensions.image.CImageComponent',
        		// GD or ImageMagick
        		'driver'=>'GD',
        		// ImageMagick setup path
        		//'params'=>array('directory'=>'D:/Program Files/ImageMagick-6.4.8-Q16'),
        ),

        /*'db'=>array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        ),*/
        // uncomment the following to use a MySQL database
        'db'=>array(
                'connectionString' => 'mysql:host=localhost;dbname=fang',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
                'tablePrefix' => 'f_',
        ),

        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
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
    'params'=>array(
        'file_pic_folder'=>'upload',
        'pano_static_path' => 'pp',
        'pic_path_prefix' => 'yiluhaocomwbli', //鍥剧墖闈欐�鍦板潃鍔犲瘑鐮�
        'google_map_key'=>'AIzaSyAWd726eNuCfeGNmFPyC43jv9Swdg8JivI',
        'encrypt_prefix'=>'WY#yiluhao&WB',
        'img_domain_1'=>'http://img.dev.yiluhao.com',
        'img_domain_2'=>'http://img1.dev.yiluhao.com',
    ),
);
