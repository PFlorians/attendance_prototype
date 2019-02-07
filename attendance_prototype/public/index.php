<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$stgs = require __DIR__ . '/../src/settings.php';//settings matrix is situate here
$app = new \Slim\App($stgs);
$container = $app->getContainer();//vsetky dependencies
//$cont je sam $container
$container['db']=function($cont)
{
    $db=$cont['settings']['db'];
    $pdo=new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'], $db['user'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//throw exception on error
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
echo "tst <br/>";
var_dump($container['db']);
echo "<br/>";
$app->get('/abc', function ($req, $res, $args)
{
    //$l=$this->get('logger');
    $d=$this->db;
    var_dump($d);
    return $d;
});
// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();
