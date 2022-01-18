<?php
    require_once "calculator.php";
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <title>Anderson Assignment 3: Calculator </title>
    </head>
    <body>
        <div class="container p-2">
            <div class="container border border-dark rounded mx-auto w-50 p-2">
                <h1 class="text-center border border-dark rounded">CALCULATOR</h1>
                <?php
                    $calculator = new Calculator();
                    echo '$calculator->calc("/", 10, 0)';
                    echo $calculator->calc("/", 10, 0);
                    echo $calculator->calc("*", 10, 2);  
                    echo $calculator->calc("/", 10, 2); 
                    echo $calculator->calc("-", 10, 2);  
                    echo $calculator->calc("+", 10, 2);
                    echo $calculator->calc("*", 10); 
                    echo $calculator->calc(10);
                ?>
            </div>
        </div> <!-- container -->
    </body>
</html>