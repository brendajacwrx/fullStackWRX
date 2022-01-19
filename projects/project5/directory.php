<?php
    /*
        Author: Brenda J Anderson

        Class Purpose: 
            To create a readme.txt file of user entered content in the specified folder entered by the user
            
    */
    class Directories{
        public $output = null;
        public $message = null;
        public $fldrName = null;
        private $errs = [];

        
        /* CONSTRUCTOR */
        public function __construct(){
            
        }

        /*
            Purpose: Set the folder the user entered 
            Pre: 
            Post: $fldrName has the user inputed folder name
        */
        private function setfldrName($nameStr){
            // check that the folder name does not contain spaces
            $spaces = strpos( $nameStr ,' '); // want it to be FALSE
            // check for invalid backward slashes
            $backSlash = strpos( $nameStr ,'\\'); // want it to be FALSE
            // check all characters are alpha-numeric
             $allAlphaNum = ctype_alnum($nameStr); //  want it to be TRUE  
                if(($spaces === FALSE) && ($backSlash === FALSE) && ($allAlphaNum)){
                    $this->fldrName = "directories/".$nameStr;
                }
            return; 
        }

        /*
            Purpose: Creates an array of setting errors 
            Pre:   
            Post: array errs
        */
        private function setErrs(){
            $this->errs['noname'] ="You must enter a directory name for your file!";
            $this->errs['invalid'] ="Invalid directory name for your file!";
            $this->errs['duplicate'] = "A directory already exist with that name!";
            $this->errs['failed'] = "This file or directory failed to be created!";
            $this->errs['blank'] = "You are creating an empty file which is not allowed.";
        }

        /*
            Purpose: Input err
            Pre: errs array exist
            Post: returns the err by the $errName
        */
        private function getErrs($errName){
            if(isset($this->errs[$errName])){
                return $this->errs[$errName];
            }
        }

        /*
            Purpose: Pretty error message displayed
            Pre: errs exist in an array
            Post: formatted red text with the err message
        */
        private function showErr($errName){
            $this->message = '<p class="text-danger">'.$this->errs[$errName].'</p>';
            return;
        }

        /*
            Purpose: Take user entered content and write it to a file
            Pre: User has created file content $fileContent
            Post: readme.txt created
        */
        private function writeFile($fileContent){
            $success = FALSE;
            if($file = fopen($this->fldrName.'/readme.txt' ,"w")){
                $success = TRUE;
                fwrite($file,$fileContent);
                fclose($file);
            }
            return($success);
        }

        /*
            Purpose: Pressent logic for the user submitted content
            Pre: User has submited form throght submit button
            Post: Upon successful data in the post, creates user entered folder
            name with a readme.txt file containing the user entered content
        */
        public function addDirFile($post){            
            $this->setErrs();
            if(! empty($post['fname'])){
                $this->setfldrName($post['fname']);
                if(isset($this->fldrName)){ 
                    if(is_dir($this->fldrName)){
                        // no duplicates allowed
                        $this->showErr('duplicate');
                    }elseif(@mkdir($this->fldrName)){
                        if(! empty($post['content'])){
                            //set directory permissions
                            chmod($this->fldrName, 0777);
                            // create file and write content
                            if($this->writeFile($post['content'])){
                                $this->message = "<p>File and directory were created.</p>";                   
                                $this->message .= "<a href=". $this->fldrName."/readme.txt" . "> ". $this->fldrName."/readme.txt " ."</a></p>";
                            } else {
                                // failed to create file in directory
                                $this->showErr('failed');
                            }                            
                        } else {         
                            // remove the new empty folder                    
                            @rmdir($this->fldrName);
                            // display message     
                            $this->showErr('blank');                     
                        }
                    } else {
                        //total failure creating directory
                        $this->showErr('failed');
                    }
                } else {
                    // invalid directory name
                    $this->showErr('invalid');
                }
            } else {
                // missing directory name
                $this->showErr('noname');                
            }   
            return;
        }
    }
?>