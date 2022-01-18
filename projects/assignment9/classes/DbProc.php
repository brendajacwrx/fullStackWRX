<?php
    require_once '../classes/DateTimeProc.php';
    class DbProc{
        public $db = null;

        // If you cannot connect to your local mysql,
        // set $remoteDatabase = 'CPS276', and it will query the instructors database instead 
        public $remoteDatabase = null;
         
        public function getPDO() {
            global $db;
            if ($db != null) {
                return $db;
            }
            try {
                // This is the instructors connection string.
                // Substitute your own string if you wish to connect to your database.
                $db = new PDO('mysql:host=localhost;port=3306;dbname=CPS276','bande363','1328');
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
                $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC); 
                return $db;
            }
            catch (Exception $e2) {
                echo('DB Connection Error - ' . $e2->getMessage());
                exit();
            }
        }
        
        public function execute($sql,$returnResults=true,$bindingValues=null) {
        
            global $remoteDatabase;
            if (!empty($remoteDatabase)) {
                return remoteExecute($sql,$returnResults,$bindingValues);
            }
            $db = $this->getPDO();
            try {
                $statement = $db->prepare($sql);
                if (!$statement) {
                    echo('DB Prepare Error - ' . $sql);
                    exit();
                }
                if ($statement===false) {
                    echo('DB Prepare Error - ' . $sql);
                    exit();
                }
                if ($bindingValues != null) {
                    for ($counter=0; $counter < sizeof($bindingValues); $counter++) {
                        $statement->bindParam($counter + 1, $bindingValues[$counter]);
                    }
                }
                $statement->execute();
                $results = array();
                if ($returnResults) {
                    $results = $statement->fetchAll();
                }
                $statement->closeCursor();
                return $results;
            }
            catch (Throwable $e2) {
                echo('DB Error - ' . $sql);
                echo('<br>' . $e2->getMessage());
                exit();
            }
        }
        
        
        function remoteExecute($sql,$returnResults=true,$bindingValues=null) {
            global $remoteDatabase;
            $returnResults = !!$returnResults;
            $params['query'] = $sql;
            $params['db'] = $remoteDatabase;
            $params['returnResults'] = $returnResults ? 1 : 0;
            if (!empty($bindingValues)) {
                $params['binding'] = $bindingValues;
            }
            $params = json_encode($params);
            $params = base64_encode($params);
            $url = 'http://161.35.120.113/CPS276/shared/api.php?params=' . $params;
            $results = @file_get_contents($url);
            $results = @base64_decode($results);
            $results = @json_decode($results,true);        
            return $results;
        }

        public function getNotes($beginTime, $endTime){
            // Now select all the records from the a8 table.
            $dateHandle = new DateTimeProc();
            $beginTime = $dateHandle->getDbStartTime($beginTime);
            $endTime = $dateHandle->getDbEndTime($endTime);
            $sql = "SELECT * FROM a9 WHERE entryDate >= (?) AND entryDate < (?) ORDER BY entryDate DESC" ;
            $arr = [];
            $arr[] = $beginTime;
            $arr[] = $endTime;
            $noteStr = null;
            // get results
            $results = $this->execute($sql, true, $arr);
            // count the number of rows results received
            $count = 0;
            if(! empty($results)){
                foreach ($results as $result) {
                # code...
                $count++;
                }
                // output data to a table       
                $noteStr = '<h2>Notes</h2><table class="table table-striped">
                    <thead><tr><th>Entry Date</th><th>Note</th></tr></thead>
                    <tbody>';
                for ($i=0; $i < $count; $i++) { 
                    # code...
                    $day = $results[$i]['entryDate'];  
                    $prettyDate = $dateHandle->getPrettyDate($day);                      
                    $noteStr .= '<tr><td>'.$prettyDate.'</td><td>'.$results[$i]['note'].'</td></tr>';                         
                } 
                $noteStr .= '</tbody></table>';
            } else {
                $noteStr = "No Data";
            }
            return($noteStr);
        }
    
        public function dbEntry($entryDate, $note){
            $dateHandle = new DateTimeProc();
            $entryDate = $dateHandle->getDbTime($entryDate);
                    
            $sql = "INSERT INTO a9(entryDate, note) VALUES (?,?)";
            $arr = [];
            $arr[] = $entryDate;
            $arr[] = $note;
            $this->execute($sql, false, $arr);
            return;
        }
    }
    ?>