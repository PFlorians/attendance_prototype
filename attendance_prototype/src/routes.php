<?php

use Slim\Http\Request;
use Slim\Http\Response;

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

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
