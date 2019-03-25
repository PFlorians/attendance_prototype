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
            "(&(objectClass=User)(samAccountName=pflorian))", array("displayName"));
            $pars=ldap_get_entries($this->ldapConn, $res);
            var_dump($pars);
        }
        public function searchUser($uname)
        {
            $res=ldap_search($this->ldapConn, "OU=Users,OU=GOC,OU=GIT,DC=grouphc,DC=net",
            "(&(objectClass=User)(samAccountName=".$uname."))", array("displayName"));
            $pars=ldap_get_entries($this->ldapConn, $res);
            return $pars[0]["displayname"][0];
        }
        public function getConnection()
        {
            return $this->connection;
        }
    }

 ?>
