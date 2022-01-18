<?php

    /*
        Author: Brenda J Anderson
        Class Purpose: 
            To process the form based upon the button pressed on the
            form and the data received.
            If the "Clear Names" button is pressed, the textarea names are cleared.  
            If the "Add Name" button is pressed:
                -- the name input has a space, then the name entered is added to the
                list of names in the textarea in alphabetical order.
                == the name input is blank or only one name (no space), then
                the current list of names are re-displayed and the text
                input ready for new name entry
    */
    class AddNamesProc{
        /* Variable Definitions */
        private static $results = null;             // string of input from name and client textarea
        private static $name = [];                  // array for user added name split
        private static $names =[];                  // array of names first name and last name
        private static $result = [];                // array of strings to output to textarea
        private static $output = null;              // string of output for the client textarea


        /* CONSTRUCTOR */
        public function __construct(){
        }

        /*
            Purpose: Split user input $nameStr into first and last name 
            Pre: $nameStr is a name string with at least one space
            Post: First name is $name['fname'] and $name['lname'] is the last name
        */
        private function setName($nameStr){
            //split name into first and last name            
                $getName= explode(" ", $nameStr);
                if(isset($getName[0]) && isset($getName[1])){
                    self::$name['fname'] = $getName[0];
                    self::$name['lname'] = $getName[1];
                }
            return; 
        }

        /*
            Purpose: return the first name $name['fname']
            Pre: function call made prior to setName($nameStr)
            Post: returns $name['fname']
        */
        public function getFn(){            
            return(self::$name['fname']);            
        }

        /*
            Purpose: return the last name $name['lname']
            Pre: function call made prior to setName($nameStr)
            Post: returns $name['lname']
        */
        public function getLn(){
                return(self::$name['lname']);
        }

        /*
            Purpose: Sorts an array of first and last names
            Pre: usort function call    
            Post: returns comparison value for sort
        */
        private static function  cmp($a, $b){
            $cmpVal = strnatcasecmp($a['lname'], $b['lname']);
            // if last names are the same sort by first name
            if($cmpVal === 0){
                return( strnatcasecmp($a['fname'], $b['fname']));
            }
            return( $cmpVal);
        }

        /*
            Purpose: To alphabetize the array of names, and return the 
                sorted names as a string for output to the textarea
            Pre: $nameStrsArr an arry of strings of names with a comma delimeter
            Post: $output string of sorted names, ordered by last name where
                each name pair ends with and end of line character for output
                to textarea.
        */
        private function getSortedNames($nameStrsArr){   
            $output = null;
            $delimiter = ", ";         
            if(isset($nameStrsArr)){  
                foreach ($nameStrsArr as $nameStr) {
                    if(isset($nameStr)){
                        $getName = explode($delimiter, $nameStr);                            
                        if(isset($getName[0]) && isset($getName[1])){
                            self::$name['fname'] = $getName[1];
                            self::$name['lname'] = $getName[0];
                            self::$names[] = self::$name;
                            }
                    }
                }
                // sort 2 or more names only     
                if(count(self::$names) >= 2){
                    usort(self::$names, array('AddNamesProc','cmp')); 
                } 
                // CREATE ordered return output
                foreach (self::$names as $nm) {
                    # code...
                    $output .= $nm['lname'].", ". $nm['fname']."\n";
                }
              
               return($output);
            }
             
        }
        
        /*
            Purpose: To take a $namesStr, one string of multiple names, and
            create an array of $nameStr, a single full name, as each element in the array
            Pre: String of full names delimited by the end of line character 
            Post: Returns an array of full names as strings with a comma
        */
        private function getNameStrArr($namesStr){
            $fullName =  [];   // array of full name strings from textarea and entry
            $delimiter  = "\n";
            // explode string on the $delimiter
            $fullName =  explode ($delimiter , $namesStr );
            return($fullName);
        }

        /*
            Purpose: Receive user input name and add to alphabetized name list
            Pre: $_POST submission from form name input containing first
                name, a space, and last name for succes to add name to list
                or submission to clear the name list.
            Post: A sorted name list, or a cleared form
        */
        public function addClearNames($post){
            // clear textarea if clear button pressed
            if(isset($post['clear'])){
                self::$results = null;
            }else if(isset($post['add'])){  // add names to textarea when add button pressed
                if(isset($post['name'])){
                    // if space in name, process
                    if(strpos ( $post['name'] ,' ') !== FALSE){
                        $this->setName($post['name']);
                        if(isset(self::$name)){
                            self::$results = $this->getLn().", ". $this->getFn()."\n";
                            if(isset($post['namelist'])){
                                self::$results .= $post['namelist'];
                            }
                        }
                     // ... no space in name
                     // ... re-post the current namelist
                    }elseif(isset($post['namelist'])){
                        self::$results  = $post['namelist'];
                    // ... or empty field
                    }else{
                        self::$results = null;
                    }
                }
                // put nameStr(s) into an array
                self::$result = $this->getNameStrArr(self::$results);

                // sort and format names for output to client
                self::$output = $this->getSortedNames(self::$result);
        }
        return self::$output;
    }
}
?>