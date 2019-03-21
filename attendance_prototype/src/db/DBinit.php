<?php
    namespace attendance;
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    class DBinit
    {
        private $dbconn;
        private $basicMapper;
        private $bonusMapper;
        private $absenceMapper;
        private $summaryMapper;
        function __construct($dbc)
        {
            $this->dbconn = $dbc;
        }
        //this function intializes all mappers -> who will fetch data using stored procedures, so the front-end objects can
        //parse this and insert it into the view
        public function mapperInitializer($uname, $monthAtt)
        {
            //instantiation
            $this->basicMapper=new \attendance\SummaryBasicMapper($this->dbconn);
            $this->bonusMaper=new \attendance\BonusMapper($this->dbconn);
            $this->absenceMapper=new \attendance\AbsenceMapper($this->dbconn);
            $this->summaryMapper=new \attendance\MonthlySummaryMapper($this->dbconn);

            $this->basicMapper->getMonthlyAttendanceOfUser($uname, $monthAtt);
            $this->bonusMaper->getMonthlyBonusesOfUser($uname, $monthAtt);
            $this->absenceMapper->getMonthlyAbsencesOfUser($uname, $monthAtt);
            $this->summaryMapper->getMonthlySummaryOfUser($uname, $monthAtt);
        }
        public function getMonthlyAttendanceOfUser($uname, $monthAtt)
        {
            $sqlQryRes="";//error variable
            $paramsArray=array(
                array(&$uname, SQLSRV_PARAM_IN),
                array(&$monthAtt, SQLSRV_PARAM_IN),
                array(&$sqlQryRes, SQLSRV_PARAM_OUT)
            );
            $res=[];
            $qry = "exec getMonthlyAttendanceOfUser @ulogin = ?, @monthAtt=?, @errMsg=?";
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
                        $res[]=array($row->day, $row->from, $row->until, $row->hours_worked_day, $row->shifttype);
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
                        var_dump($res);
                        return $res;
                    }
                }
                else
                {
                    die(print_r(sqlsrv_errors(), true));
                }
            }
        }
        public function getBasicMapper()
        {
            return $this->basicMapper;
        }
        public function getBonusMapper()
        {
            return $this->bonusMaper;
        }
        public function getAbsenceMapper()
        {
            return $this->absenceMapper;
        }
        public function getSummaryMapper()
        {
            return $this->summaryMapper;
        }
    }
 ?>
