<?php                  
    if(isset($_POST['submit'])){
        require_once 'directory.php'; 
        $mkDirFile = new Directories();       
        $mkDirFile->addDirFile($_POST);
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

        <title>Project: Files and Directories</title>
    </head>
    <body>
        <div class="container mt-3 ">
            <div>
                <h1 class="w-100 border border-info p-2">File and Directory Project</h1>
                <p>Enter a folder name and the contents of a file. Folder names should contain alphpa numeric characters only.</p>
                <?php if(isset($mkDirFile->message) ){echo($mkDirFile->message);} ?>
            </div>
            <div class="mt-3">
                <form method="post" action="">
                    <div class="mb-2">
                        <label for="fname">Folder Name</label><br>
                        <input type="text" placeholder="Enter folder name" id="fname"  name="fname"  class="w-100 p-1 border border-info" maxlength=100>
                    </div>                
                    <div class="pt-2">
                    <label for="content">File Content</label>
                    <textarea style="height: 500px;" placeholder="Enter file content" class="w-100  p-1 border border-info" id="content" name="content"><?php if(isset($mkDirFile->output)){echo($mkDirFile->output);} ?></textarea>

                    </div>
                    <div class="pt-3">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary" >Submit</button>
                    </div>
                </form>
            </div>
        </div> <!-- container -->
    </body>
</html>