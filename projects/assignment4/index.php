<?php    
        $output = null;       
    if((isset($_POST['add'])) || (isset($_POST['clear']))){
        require_once 'addNameProc.php'; 
        $addName = new AddNamesProc();       
        $output = $addName->addClearNames($_POST);
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

        <title>Anderson Assignment 4: Add Names </title>
    </head>
    <body>
        <div class="container p-2">
            <h1>Add Names</h1>
            <form method="post" action="">
                <div class="mb-1">
                    <button type="submit" id="add" name="add" class="btn btn-primary" >Add Name</button> 
                    <button  type="submit" id="clear" name="clear" class="btn btn-primary">Clear Names</button>
                </div>
                <div>
                    <input type="text" id="name"  name="name" placeholder='enter first and last name' size = 30 maxlength=20>
                </div>                
                <div class="pt-2">
                 <label class="font-weight-bold" for="namelist">List of Names</label>
                 <textarea readonly style="height: 500px;" class="w-100" id="namelist" name="namelist"><?php if(isset($output)){echo($output);} ?></textarea>

                </div>
            </form>
        </div> <!-- container -->
    </body>
</html>