<?php
    namespace attendance;
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    class AbsenceMapper
    {
        private $dbconn;
        private $monthlyAbsences;
        function __construct($dbc)
        {
            $this->dbconn=$dbc;
        }
        public function getMonthlyAbsencesOfUser($uname, $monthAtt)
        {
            $sqlQryRes="";//error variable
            $paramsArray=array(
                array(&$uname, SQLSRV_PARAM_IN),
                array(&$monthAtt, SQLSRV_PARAM_IN),
                array(&$sqlQryRes, SQLSRV_PARAM_OUT)
            );
            $res=[];
            $qry = "exec getMonthlyAbsencesOfUser @ulogin = ?, @monthAtt=?, @errMsg=?";
            $stmt = sqlsrv_prepare($this->dbconn, $qry, $paramsArray);
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
                        $res[]=array($row->day_of_absence, $row->absence_type, $row->hours_absent, $row->descr);
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
                        $this->monthlyAbsences=$res;
                    }
                }
                else
                {
                    die(print_r(sqlsrv_errors(), true));
                }
            }
        }
        public function getMonthlyAbsences()
        {
            return $this->monthlyAbsences;
        }
    }

 ?>
