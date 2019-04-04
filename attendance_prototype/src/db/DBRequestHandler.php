<?php
    // this object should handle all the basic logic of interaction with database
    // that includes authentication, authorization and any kind of input for more data
    namespace attendance;
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    class DBRequestHandler
    {
        private $conn;//connection
        private $uname;
        private $validMonths;
        private $shiftTypes;

        function __construct($con)
        {
            $this->conn=$con;
            $this->validMonths=[];
        }
        public function userInDb($usr)
        {
            $this->uname=$usr;
            $sqlQryRes="";//error variable
            $var=0;
            $paramsArray=array(
                array(&$this->uname, SQLSRV_PARAM_IN),
                array(&$var, SQLSRV_PARAM_IN),
                array(&$sqlQryRes, SQLSRV_PARAM_OUT)
            );
            $res=[];
            $qry="exec userExists @ulogin = ?, @var = ?, @errMsg = ?";
            $stmt = sqlsrv_prepare($this->conn, $qry, $paramsArray);
            if($stmt===false)//error on preparation
            {
                die(print_r(sqlsrv_errors(), true));
            }
            else
            {
                if(sqlsrv_execute($stmt))
                {
                    while($row=sqlsrv_fetch_object($stmt))
                    {
                        //echo $row->day ." ".$row->from." ".$row->until." ".$row->hours_worked_day."<br/>";
                        $res[]=array($row->var);
                    }
                    while(sqlsrv_next_result($stmt))
                    {
                        ;
                    }//needs to be called after fetch
                    if($sqlQryRes!="")
                    {
                        die(print_r($sqlQryRes, true));
                    }
                    else
                    {
                        //this SQL function is supposed to return only 1 value
                        if($res[0][0]==1)
                        {
                            $this->loadValidMonths();
                            $this->loadShiftTypes();
                            return true;//user exists
                        }
                        else
                        {
                            return false;//user not in DB yet
                        }
                    }
                }
                else
                {
                    die(print_r(sqlsrv_errors(), true));
                }
            }
        }
        //this method retrieves all shift types for frontend
        public function loadShiftTypes()
        {
            $sqlQryRes="";//error variable
            $paramsArray=array(
                array(&$sqlQryRes, SQLSRV_PARAM_OUT)
            );
            $res=[];
            $qry="exec getShiftTypes @errMsg = ?";
            $stmt = sqlsrv_prepare($this->conn, $qry, $paramsArray);
            if($stmt===false)
            {
                die(print_r(sqlsrv_errors(), true));
            }
            else
            {
                if(sqlsrv_execute($stmt))
                {
                    while($row=sqlsrv_fetch_object($stmt))
                    {
                        //echo $row->day ." ".$row->from." ".$row->until." ".$row->hours_worked_day."<br/>";
                        $res[]=array($row->type);
                    }
                    while(sqlsrv_next_result($stmt))
                    {
                        ;
                    }//needs to be called after fetch
                    if($sqlQryRes!="")//query returned error, fatal
                    {
                        die(print_r($sqlQryRes, true));
                    }
                    else
                    {
                        for($i=0;$i<sizeof($res);$i++)
                        {
                            for($j=0;$j<sizeof($res[$i]);$j++)
                            {
                                $this->shiftTypes[]=$res[$i][$j];
                            }
                        }
                        //we can start working with data only if there are data to work with
                    }
                }
                else//execution failure
                {
                    die(print_r(sqlsrv_errors(), true));
                }
            }
        }
        public function loadValidMonths()
        {
            $sqlQryRes="";//error variable
            $var=0;
            $paramsArray=array(
                array(&$this->uname, SQLSRV_PARAM_IN),
                array(&$sqlQryRes, SQLSRV_PARAM_OUT)
            );
            $res=[];
            $qry="exec getValidAttMonths @uname = ?, @errMsg = ?";
            $stmt = sqlsrv_prepare($this->conn, $qry, $paramsArray);
            if($stmt===false)//error on preparation
            {
                die(print_r(sqlsrv_errors(), true));
            }
            else
            {
                if(sqlsrv_execute($stmt))
                {
                    while($row=sqlsrv_fetch_object($stmt))
                    {
                        //echo $row->day ." ".$row->from." ".$row->until." ".$row->hours_worked_day."<br/>";
                        $res[]=array($row->month);
                    }
                    while(sqlsrv_next_result($stmt))
                    {
                        ;
                    }//needs to be called after fetch
                    if($sqlQryRes!="")//query returned error, fatal
                    {
                        die(print_r($sqlQryRes, true));
                    }
                    else
                    {
                        for($i=0;$i<sizeof($res);$i++)
                        {
                            for($j=0;$j<sizeof($res[$i]);$j++)
                            {
                                $this->validMonths[]=$res[$i][$j];
                            }
                        }
                        //we can start working with data only if there are data to work with
                    }
                }
                else//execution failure
                {
                    die(print_r(sqlsrv_errors(), true));
                }
            }
        }
        //getters and setters
        public function getValidAttMonths()
        {
            return $this->validMonths;
        }
        public function getShifts()
        {
            return $this->shiftTypes;
        }
        //setters
        public function setUname($uname)
        {
            $this->uname=$uname;
        }
    }
 ?>
