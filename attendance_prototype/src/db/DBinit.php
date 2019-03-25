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
        private $dbRequestHandler;
        function __construct($dbc)
        {
            $this->dbconn = $dbc;
        }
        //this function intializes all mappers -> who will fetch data using stored procedures, so the front-end objects can
        //parse this and insert it into the view
        public function mapperInitializer()
        {
            //instantiation
            $this->basicMapper=new \attendance\SummaryBasicMapper($this->dbconn);
            $this->bonusMaper=new \attendance\BonusMapper($this->dbconn);
            $this->absenceMapper=new \attendance\AbsenceMapper($this->dbconn);
            $this->summaryMapper=new \attendance\MonthlySummaryMapper($this->dbconn);
            $this->dbRequestHandler=new \attendance\DBRequestHandler($this->dbconn);//initiator is called elsewhere
        }
        public function map($uname, $monthAtt)//maps data according to given username and month
        {
            $this->basicMapper->getMonthlyAttendanceOfUser($uname, $monthAtt);
            $this->bonusMaper->getMonthlyBonusesOfUser($uname, $monthAtt);
            $this->absenceMapper->getMonthlyAbsencesOfUser($uname, $monthAtt);
            $this->summaryMapper->getMonthlySummaryOfUser($uname, $monthAtt);
        }
        //getters and setters go here
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
        public function getDBRequestHandler()
        {
            return $this->dbRequestHandler;
        }
    }
 ?>
