<?php
    namespace attendance;
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    class TableGenerator
    {
        private $parser;
        private $month;
        function __construct($par,$mon)
        {
            $this->parser=$par;
            $this->month=$mon;
        }
        public function generateTables()
        {
            $att=$this->parser->fillAttendanceTable();
            $absen=$this->parser->fillAbsencesTable();
            $summa=$this->parser->fillSummaryTable();
            $bonu=$this->parser->fillBonusesTable();

            $n= '<div class="limiter"> <!-- attendance table -->
                <div class="container-table100">
                    <button id="prevMonth" onclick="getPrevMonth()" class="btn btn-primary marginRight marginBottom-10"><span class="fas fa-angle-left"></span>Previous Month</button>
                    <h3 id="att" class="marginAuto marginBottom-10 dynamicFont clr">'.$this->month.' Attendance</h3>
                    <button id="nxtMonth" onclick="getNextMonth()" class="btn btn-primary marginLeft marginBottom-10">Next Month<span class="fas fa-angle-right"></span></button>
                    <div class="wrap-table100">
                        <div class="table100">
                            <table id="attendanceTab">
                                <thead>
                                    <tr class="table100-head">
                                        <th class="column1">Day</th>
                                        <th class="column2">Arrival</th>
                                        <th class="column3">Departure</th>
                                        <th class="column4">Hours Worked</th>
                                        <th class="column5">Shift</th>
                                        <!--<th class="column6">Total</th>-->
                                    </tr>
                                </thead>
                                <tbody>'.$att["data"].'
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- end of attendance table -->
            <div class="container">
                <div class="row"><!-- row -->
                    <div class="col-md-7 col-sm-12">
                        <div class="limiter">
                            <div class="container-table100">
                                <h3 class="clr">Monthly Absences</h3>
                                <div class="wrap-table100">
                                    <div class="table100">
                                        <table id="absenceTab">
                                            <thead>
                                                <tr class="table100-head">
                                                    <th class="column1">Day</th>
                                                    <th class="column2">Type</th>
                                                    <th class="column3">Hours absent</th>
                                                    <th class="column4">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>'.$absen.'
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- col 2 -->
                    <div class="col-md-5 col-sm-12">
                        <div class="limiter">
                            <div class="container-table100">
                                <h3 class="clr">Monthly Summary</h3>
                                <div class="wrap-table100">
                                    <div class="table100">
                                        <table id="summaryTable">
                                            <thead>
                                                <tr class="table100-head">
                                                    <th class="column1">Worked</th>
                                                    <th class="column2">Bonus</th>
                                                    <th class="column3">Absent</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                '.$summa.'
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row -->
            </div>
            <div class="limiter"> <!-- bonuses table -->
                <div class="container-table100">
                    <h3 class="clr">Monthly Bonuses</h3>
                    <div class="wrap-table100">
                        <div class="table100">
                            <table id="bonusTab">
                                <thead>
                                    <tr class="table100-head">
                                        <th class="column1">Day</th>
                                        <th class="column2">ID</th>
                                        <th class="column3">Bonus Hours</th>
                                        <th class="column4">Description</th>
                                        <!--<th class="column6">Total</th>-->
                                    </tr>
                                </thead>
                                <tbody>'.$bonu.'
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- end of bonuses table -->
            ';
            return array("data"=>$n, "ids"=>$att["ids"]);
        }
    }

?>
