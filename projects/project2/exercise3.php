<?php
  $num_columns = 5;
  $num_rows = 15;
  $col_limit = $num_columns + 1;
  $row_limint = $num_rows + 1;
  $output = "<table class = \" border p-2 mt-3\" >";

  //table row generation
  for ($i=1; $i < $row_limint ; $i++) { 
    # code...
    $output .= '<tr>';
    // table column generation
    for ($j=1; $j < $col_limit; $j++) { 
      # code...
      $output .= "<td class = \" border p-2 \"> row ".$i.' cell '.$j."</td>";
    }
    $output .=  '</tr>';
  }
  $output .= '</table>';
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Anderson Assignment 2, Exercise 3 </title>
  </head>
    <body>
        <div class="container">
        <?php 
            echo($output);
        ?>
        </div> <!-- end container -->
    </body>
</html>