<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'mode' => 'development',
        //databse connection for srvcattendance
        'db'=>[
            'host'=>'SPARROW\\SQLEXPRESS',
            'conn_string' => [
                'Database' => 'attendance_dev',//,
                'ReturnDatesAsStrings' => true
                /*'UID'=>'sparrow\\hackerman',
                'PWD'=>'HeroOfOrion1988',
                'CharacterSet' => 'UTF-8'*/
            ]
        ],
        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'attendance_proto_log',
            'path' => __DIR__.'/../logs/app.log',//bolo to __DIR__.'/..logs/app.log' - ale toto je windows cize...
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
