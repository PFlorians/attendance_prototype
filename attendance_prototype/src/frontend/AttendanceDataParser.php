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
            for ($i=0;$i<sizeof($attendance);$i++)
            {
                echo "<tr>";
                for($j=0;$j<sizeof($attendance[$i]);$j++)
                {
                    echo "<td class='column".($j+1)."'>".$attendance[$i][$j]."</td>";
                }
                echo "</tr>";
            }
        }
        public function fillBonusesTable()
        {
            $attendance=$this->bomapper->getMonthlyBonuses();
            for ($i=0;$i<sizeof($attendance);$i++)
            {
                echo "<tr>";
                for($j=0;$j<sizeof($attendance[$i]);$j++)
                {
                    echo "<td class='column".($j+1)."'>".$attendance[$i][$j]."</td>";
                }
                echo "</tr>";
            }
        }
        public function fillAbsencesTable()
        {
            $attendance=$this->absmapper->getMonthlyAbsences();
            for ($i=0;$i<sizeof($attendance);$i++)
            {
                echo "<tr>";
                for($j=0;$j<sizeof($attendance[$i]);$j++)
                {
                    echo "<td class='column".($j+1)."'>".$attendance[$i][$j]."</td>";
                }
                echo "</tr>";
            }
        }
        public function fillSummaryTable()
        {
            $attendance=$this->summapper->getMonthlySummary();
            for ($i=0;$i<sizeof($attendance);$i++)
            {
                echo "<tr>";
                for($j=0;$j<sizeof($attendance[$i]);$j++)
                {
                    echo "<td class='column".($j+1)."'>".$attendance[$i][$j]."</td>";
                }
                echo "</tr>";
            }
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
