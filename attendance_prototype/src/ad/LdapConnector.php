<?php
    namespace attendance;
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    class LdapConnector
    {
        private $ldapConn;

        function __construct($conn)
        {
            $this->ldapConn=$conn;
        }
        public function tstSearch()
        {
            $res=ldap_search($this->ldapConn, "OU=Users,OU=GOC,OU=GIT,DC=grouphc,DC=net",
            "(&(objectClass=User)(samAccaountName=pflorian))");
            var_dump($res);
        }
        public function searchUser($uname)
        {

        }
        public function getConnection()
        {
            return $this->connection;
        }
    }

 ?>
