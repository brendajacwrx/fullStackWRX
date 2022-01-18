<?php  
   // process form when upload button pressed
    if(isset($_POST['upload'])){
        require_once 'fileUploadProc.php'; 
        require_once 'dbProc.php'; 
        $filesUpload = new FileUploadProc();       
        $filesUpload->addFiles($_POST, $_FILES);

        // connect to database and enter file_name at file_path directory
        if(isset($filesUpload->file_name)){
           $fileDb = new DbProc();
           $fileDb->dbEntry($filesUpload->file_name, $filesUpload->file_path);
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <title>Anderson Assignment 7: File Upload</title>
    </head>
    <body>
        <div class="container mt-3 ">
            <div>
                <h1 class="w-100 p-2">File Upload</h1>
                <a href="listFilesProc.php">Show file List</a>
            </div>
            <div><?php if(isset($filesUpload->message) ){echo($filesUpload->message);} ?></div>
            <div class="mt-3">
                <form method="post" enctype="multipart/form-data"  action="index.php">
                    <div class="mb-2">
                        <label for="fname">File Name</label><br>
                        <input type="text" placeholder="Name file to upload" id="fname"  name="fname"  class="w-100 p-1 border border-info" maxlength=100>
                        <!-- the appearance of input type="file" will differ between browsers -->
                    </div>                
                    <div class=" mt-2" >
                        <input accept="application/pdf" type="file" id="uploadFile" name="uploadFile"/>
                    </div>
                    <div class="pt-3">
                        <button type="submit" id="upload" name="upload" class="btn btn-primary" >Upload File</button>
                    </div>
                </form>
            </div>
        </div> <!-- container -->
    </body>
</html>