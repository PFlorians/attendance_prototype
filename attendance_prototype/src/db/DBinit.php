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
        public function tst()
        {
            $qry="declare @errMsg varchar(255); exec getAttendanceSummaryOfUser 'pflorian', 2, @errMsg out;";
            $stmt = sqlsrv_prepare($this->dbconn, $qry);
            if($stmt===false)
            {
                die(print_r(sqlsrv_errors(), true));
            }
            else {
                $n=sqlsrv_execute($stmt);
                while($res=sqlsrv_fetch_array($n, SQLSRV_FETCH_ASSOC))
                {
                    echo $res["bonus_id"]." ".$res["descr"]." ".$res["% bonus"]."<br/>";
                }
            }
        }
    }
 ?>
