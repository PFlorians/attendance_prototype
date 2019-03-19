<?php
    namespace attendance;
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    class DBinit
    {
        private $dbconn;
        function __construct($dbc)
        {
            $this->dbconn = $dbc;
        }
        public function getAttendanceSummaryOfUser($uname, $monthAtt)
        {
            $sqlQryRes="";//error variable
            $paramsArray=array(
                array(&$uname, SQLSRV_PARAM_IN),
                array(&$monthAtt, SQLSRV_PARAM_IN),
                array(&$sqlQryRes, SQLSRV_PARAM_OUT)
            );
            $res=[];
            $qry="exec getAttendanceSummaryOfUser @ulogin=?, @monthAtt=?, @errMsg=?";//key statement
            $stmt = sqlsrv_prepare($this->dbconn, $qry, $paramsArray);
            if($stmt===false)//error on preparation
            {
                die(print_r(sqlsrv_errors(), true));
            }
            else
            {
                if(sqlsrv_execute($stmt))
                {
                    while($row=sqlsrv_fetch_array($stmt))
                    {
                        //echo $row["Worked together"]." ".$row["Bonus hours"]." ".$row["Absences together"]."<br/>";
                        $res[]=$row;
                    }

                    $res=sqlsrv_next_result($stmt);//needs to be called after fetch
                    if($sqlQryRes!="")
                    {
                        die(print_r($sqlQryRes, true));
                    }
                    else
                    {
                        return $res;
                    }
                }
                else//error on execution
                {
                    die(print_r(sqlsrv_errors(), true));
                }
            }
            sqlsrv_free_stmt($stmt);
        }
        //returns monthly attendance data
        public function getMonthlyAttendanceOfUser($uname, $monthAtt)
        {
            $sqlQryRes="";//error variable
            $paramsArray=array(
                array(&$uname, SQLSRV_PARAM_IN),
                array(&$monthAtt, SQLSRV_PARAM_IN),
                array(&$sqlQryRes, SQLSRV_PARAM_OUT)
            );
            $res=[];
            $qry="exec getMonthlyAttendanceOfUser @ulogin=?, @monthAtt=?, @errMsg=?";//key statement
            $stmt = sqlsrv_prepare($this->dbconn, $qry, $paramsArray);
            if($stmt===false)//error on preparation
            {
                die(print_r(sqlsrv_errors(), true));
            }
            else
            {
                if(sqlsrv_execute($stmt))
                {
                    while($row=sqlsrv_fetch_array($stmt))
                    {
                        //echo $row->Day." ".$row->From." ". $row->Until." ".$row->Worked."<br/>";
                        $res[]=$row;
                    }

                    $res=sqlsrv_next_result($stmt);//needs to be called after fetch
                    if($sqlQryRes!="")
                    {
                        die(print_r($sqlQryRes, true));
                    }
                    else
                    {
                        return $res;
                    }
                }
                else//error on execution
                {
                    die(print_r(sqlsrv_errors(), true));
                }
            }
            sqlsrv_free_stmt($stmt);
        }
        public function getMonthlyBonusOfUser($uname, $monthAtt)
        {
            $sqlQryRes="";//error variable
            $paramsArray=array(
                array(&$uname, SQLSRV_PARAM_IN),
                array(&$monthAtt, SQLSRV_PARAM_IN),
                array(&$sqlQryRes, SQLSRV_PARAM_OUT)
            );
            $res=[];
            
        }
    }
 ?>
