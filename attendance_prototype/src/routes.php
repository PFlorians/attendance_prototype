<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Routes
$app->get('/tst', function(Request $req, Response $res, array $args){
    $x=new \attendance\Init($this->logger, $this->renderer, $this->db);
    $x->init($req, $res, $args);
    $dbinit=$x->getDbInitiator();
    $handler=$dbinit->getDBRequestHandler();
    $dbinit->map('pflorian', 2);//start from the first
    //prepare parser so the data is available at the front-end
    $parser=new \attendance\AttendanceDataParser();
    $parser->setBasicMapper($dbinit->getBasicMapper());
    $parser->setBonusMapper($dbinit->getBonusMapper());
    $parser->setAbsenceMapper($dbinit->getAbsenceMapper());
    $parser->setSummaryMapper($dbinit->getSummaryMapper());
    return $this->renderer->render($res, "tables.phtml", ['parser'=>$parser]);
});
$app->get('/xyz', '\attendance\Init:init');

$app->post('/month/{nxtMonth}', function(Request $req, Response $res, array $args){
    $data=$req->getParsedBody();
    $usr=filter_var($data['uname'], FILTER_SANITIZE_STRING);

    $val=(int)$args['nxtMonth'];
    $x=new \attendance\Init($this->logger, $this->renderer, $this->db);
    $x->init($req, $res, $args);

    $dbinit=$x->getDbInitiator();
    $handler=$dbinit->getDBRequestHandler();
    $handler->setUname($usr);
    $handler->loadValidMonths();
    $validMonths=$handler->getValidAttMonths();

    $dbinit->map($usr, $validMonths[$val]);//start from the first
    //prepare parser so the data is available at the front-end
    $parser=new \attendance\AttendanceDataParser();
    $parser->setBasicMapper($dbinit->getBasicMapper());
    $parser->setBonusMapper($dbinit->getBonusMapper());
    $parser->setAbsenceMapper($dbinit->getAbsenceMapper());
    $parser->setSummaryMapper($dbinit->getSummaryMapper());
    $gene=new \attendance\TableGenerator($parser, $parser->determineMonth($validMonths[$val]));

    $res->getBody()->write($gene->generateTables());
    return $res;
    /*return $this->renderer->render($res, "userAttendance.phtml", ['uname' => $usr,
    'parser' => $parser, 'month'=>$parser->determineMonth($validMonths[0]), 'months'=>$validMonths,
    'currentMonthIndex'=>0]);*/
});

//site root
$app->post('/', function(Request $req, Response $res, array $args){
    $data=$req->getParsedBody();
    $validMonths;
    $parser;
    $frmData=[];
    $frmData['uname']=filter_var($data['uname'], FILTER_SANITIZE_STRING);
    $frmData['pass']=filter_var($data['pwd'], FILTER_SANITIZE_STRING);
    //call authentication here
    $x=new \attendance\Init($this->logger, $this->renderer, $this->db);
    $x->init($req, $res, $args);
    $dbinit=$x->getDbInitiator();
    $handler=$dbinit->getDBRequestHandler();
    //db user authentication here
    if($handler->userInDb($frmData['uname'])==true) //user exists, authentication success
    {
        if(sizeof($handler->getValidAttMonths())>0)//data exists, load forst available month
        {
            //first available month may not be the first calendar month
            $validMonths=$handler->getValidAttMonths();
            $dbinit->map($frmData['uname'], $validMonths[0]);//start from the first
            //prepare parser so the data is available at the front-end
            $parser=new \attendance\AttendanceDataParser();
            $parser->setBasicMapper($dbinit->getBasicMapper());
            $parser->setBonusMapper($dbinit->getBonusMapper());
            $parser->setAbsenceMapper($dbinit->getAbsenceMapper());
            $parser->setSummaryMapper($dbinit->getSummaryMapper());

            return $this->renderer->render($res, "userAttendance.phtml", ['uname' => $frmData['uname'],
            'parser' => $parser, 'month'=>$parser->determineMonth($validMonths[0]), 'months'=>$validMonths,
            'currentMonthIndex'=>0]);
        }
        else//tere is no data!
        {

        }
    }
    else //user not in DB -> webpage to register user in attendance system
    {
        // code...
    }
});

$app->get('/', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    $info=new \attendance\Util();
    // Render index view
    return $this->renderer->render($response, 'index.phtml', ['info' => $info]);
});
?>
