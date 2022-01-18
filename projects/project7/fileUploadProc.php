<?php
    class FileUploadProc{
        // constraits
        private const MAX_FILE_SIZE = 100000;
        private const FILE_TYPE = "application/pdf";
        private const UP_LOAD_DIR = "files";

        // errors array
        private $errs = [];
        // attributes
        public $message = null;
        public $file_name = null;
        public $file_path = null;


        /*
            Purpose: Creates an array of setting errors 
            Pre:   
            Post: array errs
        */
        private function setErrs(){
            $this->errs['added'] ="File has been added";
            $this->errs['noname'] ="You must enter a name for your file!";
            $this->errs['missing'] ="You have not uploaded a file!";
            $this->errs['big'] = "File is too big";
            $this->errs['type'] = "File must be a pdf file";
            $this->errs['failed'] ="File has NOT been added";
            $this->errs['noTemp'] ="Failed temp file";
        }

        /*
            Purpose: set the $file_name for the upload file 
            Pre:   non empty argument $fname, assumes user enters proper file name
            Post:  $file_name is set
        */
        private function setFileName($fname){
            $this->file_name = $fname;
            return;
        }

        /*
            Purpose: set the $file_path for the upload file 
            Pre:   files directory exist on server
            Post:  $file_path is set
        */
        private function setFilePath($folderName){
            if(! (is_dir($folderName))){
                if (! (@mkdir($folderName) === false)){
                    // change permissions
                    chmod($folderName,0777);
                } else {
                    echo("<br>error making files folder");
                }
            }
            $currentPath = getcwd();
           //  $this->file_path = $currentPath ."/". $folderName;
           $this->file_path =  $folderName;
            return;
        }
        
        /*
            Purpose: move the uploaded file to the proper directory 
            Pre:   $tempFile exist on server
            Post:  success  depends on true returned for moving file
        */
        private function uploadFile($tempFile){
            chmod($tempFile, 0744);
            return(rename($tempFile, $this->file_path ."/".$this->file_name.".pdf"));
        }

        /*
            Purpose: Process data submitted in form, the uploaded file and new name
            Pre: $file uploaded to temp location
            Post: $file renamed and moved to file directory
        */
        function addFiles($post, $file){
            $this->setErrs();
            if( (! (empty($post['fname'])) ) &&  (! ($file['uploadFile']['size'] === 0) ) ){
                // constraint file type                
                if( (strcmp ( self::FILE_TYPE , $file['uploadFile']['type']) ) !== 0 ){
                    $this->message = ( $this->errs['type']."<br>");
                    return;
                }

                // constraint file size
                if($file['uploadFile']['size'] > self::MAX_FILE_SIZE ){
                    $this->message = ( $this->errs['big']."<br>");
                    return;
                }
                // If the file is the right size and right mime type, then the
                // file will be placed in a directory named "files"

                // set file names $file['uploadFile']['tmp_name'], 
                $this->setFileName($post['fname']);
                $this->setFilePath(self::UP_LOAD_DIR);

                // upload file to files directory
                if(isset($file['uploadFile']['tmp_name'])){
                    if($this->uploadFile($file['uploadFile']['tmp_name'])){
                        $this->message = ( $this->errs['added']."<br>");
                    } else {
                        $this->message = ( $this->errs['failed']."<br>");
                    }
                    
                } else {
                        $this->message = ( $this->errs['noTemp']."<br>");
                }
            }  else {
                // missing file name or the file to upload
                $this->message = empty($post['fname']) ? $this->errs['noname'] :  $this->errs['missing'];
            }
            return;
        }
    }
?>