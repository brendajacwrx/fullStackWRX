<?php
    class DateTimeProc{
        public function getDbTime($dbDate){
            $sqlTime = date('Y-m-d H:i:00', strtotime($dbDate));
            return($sqlTime);
        }

        public function getDbStartTime($dbDate){
            $startT = $this->getDbTime($dbDate);
            return ($startT);
        }

        public function getDbEndTime($dbDate){
            $endT = $this->getDbTime($dbDate);
            $dateObject = date_create_from_format('Y-m-d H:i:00', $endT);
            $nextDay = $dateObject->modify('+1 day');
            $sqlTime = $nextDay->format('Y-m-d 00:00:00');
            return($sqlTime);
        }
        
        public function getPrettyDate($dbDate){
            $prettyDateObj = date_create_from_format('Y-m-d H:i:00', $dbDate);
            $prettyDate = $prettyDateObj->format('m/d/Y g:i a');
            return($prettyDate);
        }
    }