<?php

/**use Slim\Http\Request;
use Slim\Http\Response;**/
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Routes
$app->get('/abc', function ($req, $res, $args)
{
    //$l=$this->get('logger');
    $d=$this->db;
    var_dump($d);
    return $d;
});
$app->get('/xyz', '\attendance\Init:init');

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    $info=new \attendance\Util();
    // Render index view
    return $this->renderer->render($response, 'index.phtml', ['info' => $info]);
});
