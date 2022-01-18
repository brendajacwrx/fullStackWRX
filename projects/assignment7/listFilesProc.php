<?php
    require_once 'dbProc.php';
    // connect to database
    $dbHandle = new DbProc();
    // get all data from the table a7
    $sql = "SELECT * FROM a7";
    // get results
    $results = $dbHandle->execute($sql, true, null);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Anderson Assignment7: List Files</title>
</head>

<body>
    <div class="container mt-3 ">
        <h1 class="w-100 p-2">List Files</h1>
        <div class="p-2 mx-1">
            <!-- link to main page -->
            <a href="index.php">Add File</a>
            <ul>
                <!-- display table a7 as a list -->
                <?php foreach ($results as $result) {
                    $fullPath = $result['file_path'] . "/" . $result['file_name'] . ".pdf";
                ?>
                    <li>
                        <!-- link to open document -->
                        <a target='_blank' href="<?php echo ($fullPath); ?>"><? echo ($result['file_name']);  ?></a>
                    </li>
                <? } ?>
            </ul>

        </div>
    </div>
</body>

</html>