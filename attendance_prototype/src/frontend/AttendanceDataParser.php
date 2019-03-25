<?php
    namespace attendance;
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    class AttendanceDataParser
    {
        private $bmapper;
        private $bomapper;
        private $absmapper;
        private $summapper;
        function __construct()
        {
            ;
        }
        public function fillAttendanceTable()//regular attendance data
        {
            $attendance=$this->bmapper->getAttendance();
            $tdata="";
            for ($i=0;$i<sizeof($attendance);$i++)
            {
                $tdata=$tdata."<tr>";
                for($j=0;$j<sizeof($attendance[$i]);$j++)
                {
                    $tdata=$tdata."<td class='column".($j+1)."'>".$attendance[$i][$j]."</td>";
                }
                $tdata=$tdata."</tr>";
            }
            return $tdata;
        }
        public function fillBonusesTable()
        {
            $attendance=$this->bomapper->getMonthlyBonuses();
            $tdata="";
            for ($i=0;$i<sizeof($attendance);$i++)
            {
                $tdata=$tdata."<tr>";
                for($j=0;$j<sizeof($attendance[$i]);$j++)
                {
                    $tdata=$tdata."<td class='column".($j+1)."'>".$attendance[$i][$j]."</td>";
                }
                $tdata=$tdata."</tr>";
            }
            return $tdata;
        }
        public function fillAbsencesTable()
        {
            $attendance=$this->absmapper->getMonthlyAbsences();
            $tdata="";
            for ($i=0;$i<sizeof($attendance);$i++)
            {
                $tdata=$tdata."<tr>";
                for($j=0;$j<sizeof($attendance[$i]);$j++)
                {
                    $tdata=$tdata."<td class='column".($j+1)."'>".$attendance[$i][$j]."</td>";
                }
                $tdata=$tdata."</tr>";
            }
            return $tdata;
        }
        public function fillSummaryTable()
        {
            $attendance=$this->summapper->getMonthlySummary();
            $tdata="";
            for ($i=0;$i<sizeof($attendance);$i++)
            {
                $tdata=$tdata."<tr>";
                for($j=0;$j<sizeof($attendance[$i]);$j++)
                {
                    $tdata=$tdata."<td class='column".($j+1)."'>".$attendance[$i][$j]."</td>";
                }
                $tdata=$tdata."</tr>";
            }
            return $tdata;
        }
        //this method simply maps numbers in set {1..12} to their respective month names
        public function determineMonth($monthNum)
        {
            $name="";
            switch ($monthNum)
            {
                case 1:
                    $name="January";
                    break;
                case 2:
                    $name="February";
                    break;
                case 3:
                    $name="March";
                    break;
                case 4:
                    $name="April";
                    break;
                case 5:
                    $name="May";
                    break;
                case 6:
                    $name="June";
                    break;
                case 7:
                    $name="July";
                    break;
                case 8:
                    $name="August";
                    break;
                case 9:
                    $name="September";
                    break;
                case 10:
                    $name="October";
                    break;
                case 11:
                    $name="November";
                    break;
                case 12:
                    $name="December";
                    break;
            }
            return $name;
        }
        //getters&setters
        public function setBasicMapper($basicMapper)
        {
            $this->bmapper=$basicMapper;
        }
        public function setBonusMapper($bonusMapper)
        {
            $this->bomapper=$bonusMapper;
        }
        public function setAbsenceMapper($absenceMapper)
        {
            $this->absmapper=$absenceMapper;
        }
        public function setSummaryMapper($summaryMapper)
        {
            $this->summapper=$summaryMapper;
        }
    }
?>
