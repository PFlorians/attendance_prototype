<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'mode' => 'development',
        //databse connection for srvcattendance
        'db'=>[
            'host'=>'localhost',
            'user'=>'srvcattendance',
            'password'=>'Rdk45fsM1Z',
            'dbname' => 'dev_attendance'
        ],
        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'attendance_proto_log',
            'path' => '../logs/app.log',//bolo to __DIR__.'/..logs/app.log' - ale toto je windows cize...
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
