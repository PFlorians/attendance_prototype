<?php
    namespace attendance;
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    class Init
    {
        private $logger;
        private $renderer;
        private $dbconn;
        function __construct($lgr, $rdr, $dbc)
        {
            $this->logger=$lgr;
            $this->renderer=$rdr;
            $this->dbconn=$dbc;
        }
        //init everything here
        public function init($request, $response, $args)
        {
            $x=new DBinit($this->dbconn);
            $x->tst();
        }
    }
 ?>
