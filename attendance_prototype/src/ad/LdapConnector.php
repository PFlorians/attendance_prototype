<?php
    namespace attendance;
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    class LdapConnector
    {
        private $ldap;

        function __construct($ldp)
        {
            $this->ldap=$ldp;
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
        public function login($uname, $pwd)
        {
            ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7);
            ldap_set_option($this->ldap['connection'], LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($this->ldap['connection'], LDAP_OPT_REFERRALS, 0);
            $bind=ldap_bind($this->ldap['connection'], $uname.'@'.$this->ldap['domain'], $pwd);
            $res=ldap_search($this->ldap['connection'], "OU=Users,OU=GOC,OU=GIT,DC=grouphc,DC=net",
            "(&(objectClass=User)(samAccountName=".$uname."))", array("displayName"));
            $pars=ldap_get_entries($this->ldap['connection'], $res);

            if($bind)
            {
                return $pars[0]["displayname"][0];
            }
            else
            {
                throw new Exception("chyba logovania: ".$uname.'@'.$this->ldap['domain']." pwd: ".$pwd);
            }
        }
        public function getConnection()
        {
            return $this->connection;
        }
    }

 ?>
