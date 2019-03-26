<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

//database connect
$container['db']=function($cont)
{
    $db=$cont['settings']['db'];
    //sql server
    $conn = sqlsrv_connect($db['host'], $db['conn_string']);
    return $conn;//return connection to database
    /*$pdo=new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'], $db['user'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//throw exception on error
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;*/
};
$container['ldap']=function($c)
{
    $ldap=$c['settings']['ldap'];

    $connector=ldap_connect($ldap['controller_hostname'], $ldap['ldap_port']);
    $ldapData = array("connection" => $connector, "domain"=>$ldap['domain']);
    if(isset($connector))
    {
        return $ldapData;
    }
    else
    {
        return null;
    }
};
//being used in combination with routes /xyz
$container['\attendance\Init']=function($cont)
{
    return new attendance\Init($cont['logger'], $cont['renderer'], $cont['db']);
};
