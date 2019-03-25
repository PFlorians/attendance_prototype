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
        private $dbInitiatorInstance;
        private $ldapInitiatorInstance;

        function __construct($lgr, $rdr, $dbc, $ldap)
        {
            $this->logger=$lgr;
            $this->renderer=$rdr;
            $this->dbconn=$dbc;
            $this->ldap=$ldap;
        }

        //init everything here
        public function init($request, $response, $args)//creates instances of main objects - program components
        {
            $x=new DBinit($this->dbconn);
            $x->mapperInitializer();
            $this->dbInitiatorInstance=$x;
            $x=new LdapConnector($this->ldap);
            $this->ldapInitiatorInstance=$x;
        }
        public function getDbInitiator()
        {
            return $this->dbInitiatorInstance;
        }
        public function getLdapInitiator()
        {
            return $this->ldapInitiatorInstance;
        }
    }
 ?>
