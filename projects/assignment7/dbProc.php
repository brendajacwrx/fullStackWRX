<?php
    class DbProc{
        public $db = null;

        public $remoteDatabase = null;
         
        public function getPDO() {
            global $db;
            if ($db != null) {
                return $db;
            }
            try {
                // credentials
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

        public function dbEntry($file_name, $file_path){
            $sql = "INSERT INTO a7 (file_path, file_name) VALUES (?,?)";
            $arr = [];
            $arr[] = $file_path;
            $arr[] = $file_name;
            //$sql = "INSERT player1,player2 FROM matches WHERE player1 = '$name' AND player1Elo = $elo AND round = '$round'";
            $results = $this->execute($sql,false, $arr);

            return;
        }
    }
?>