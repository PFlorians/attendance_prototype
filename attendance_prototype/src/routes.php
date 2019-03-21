<?php

/**use Slim\Http\Request;
use Slim\Http\Response;**/
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Routes
$app->get('/abc', function (Request $request, Response $response, array $args)
{
    $x=new \attendance\Init($this->logger, $this->renderer, $this->db, $this->ldap);
    $dbinit=$x->init($request, $response, $args);
    $parser=new \attendance\AttendanceDataParser();
    $parser->setBasicMapper($dbinit->getBasicMapper());
    $parser->setBonusMapper($dbinit->getBonusMapper());
    $parser->setAbsenceMapper($dbinit->getAbsenceMapper());
    $parser->setSummaryMapper($dbinit->getSummaryMapper());
    return $this->renderer->render($response, 'test_index.phtml', ['parser' => $parser]);
});
$app->get('/ldap', function (Request $req, Response $resp, array $args)
{
    $x=new \attendance\Init($this->logger, $this->renderer, $this->db, $this->ldap);
    $x->init();
});
$app->get('/xyz', '\attendance\Init:init');

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    $info=new \attendance\Util();
    // Render index view
    return $this->renderer->render($response, 'index.phtml', ['info' => $info]);
});
?>
