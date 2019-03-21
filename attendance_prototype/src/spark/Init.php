<?php
    namespace attendance;
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    class Init
    {
        private $logger;
        private $renderer;
        private $dbconn;
        private $ldap;
        function __construct($lgr, $rdr, $dbc, $ldap)
        {
            $this->logger=$lgr;
            $this->renderer=$rdr;
            $this->dbconn=$dbc;
            $this->ldap=$ldap;
        }
        //init everything here
        public function init($request, $response, $args)
        {
            //$x=new DBinit($this->dbconn);
            //$x->mapperInitializer('pflorian', 2);
            $x=new LdapConnector($this->ldap);
            $x->tstSearch();
            return $x;//DBInit instance
        }
    }
 ?>
