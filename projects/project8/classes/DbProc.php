<?php
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

        public function getNames(){
            // Now select all the records from the a8 table.
            $sql = "SELECT * FROM a8 ORDER BY name ASC";

            $nameStr = null;
            // get results
            $results = $this->execute($sql, true, null);
            // count the number of rows results received
            $count = 0;
            if(! empty($results)){
                foreach ($results as $result) {
                # code...
                // $nameStr .= $result['name'] . "\n";
                $count++;

                }
                for ($i=0; $i < $count; $i++) { 
                    # code...
                        if($i === 0){
                            $nameStr = ($results[$i]['name'] ). "\n";
                        } elseif($i === $count){
                            $nameStr .= ($results[$i]['name'] );
                        } else {
                            $nameStr .= ($results[$i]['name'] ). "\n";
                        }
                         
                } 
            } else {
                $nameStr = "No Data";
            }
            return($nameStr);
        }
    
        public function dbEntry($nameStr){
                    
            $sql = "INSERT INTO a8 (name) VALUES (?)";
           $arr = [];
           $arr[] = $nameStr;
           $this->execute($sql, false, $arr);
            return;
        }
    }
    ?>