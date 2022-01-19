<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">


    <title>Database Schema</title>
    <style>
        .container{
            max-width: 1200px;
            width: 85%;
            margin-bottom: 3rem;
        }
        .gridTables{
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
        .tables{
            width: 80%;
            padding: 1rem;
            border: 1px black solid;
        }
        .gridTables h2,
        .tables:last-child  {
            grid-column: span 2;
            justify-self: center;
        }
        .tables:last-child {
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: 50px 2.5fr 50px;
        }
        .tables:last-child h3{
            grid-row: span 1;
            justify-self: center;
        }
    </style>
</head>
<body>
<div class="container mt-3 ">
            <div>
                <h1 class="w-100 border border-info p-2">Creating Database ERD</h1>
                <p>This is a simple database for a basic shopping cart application.</p>
            </div>
            <div class="gridTables">
                <h2>Information</h2>
                <div class="tables">
                    <h3 class="card-title">product group table</h3>
                    <ul>
                        <li>id - int</li>
                        <li>groupname - string</li>
                        <li>imagefolder - string (image folder path)</li>
                    </ul>
                </div>                
                <div class="tables">
                    <h3 class="card-title">product table</h3>
                    <ul>
                        <li>groupid - int</li>
                        <li>productname - string</li>
                        <li>productprice - string</li>
                        <li>image - string (path to image)</li>
                        <li>description - string</li>
                    </ul>
                </div>
                <div class="tables">
                    <h3 class="card-title">orders table</h3>
                    <ul>
                        <li>id - int</li>
                        <li>timestamp - int</li>
                        <li>customerid - int</li>
                    </ul>
                </div>
                <div class="tables">
                    <h3 class="card-title">order info table</h3>
                    <ul>
                        <li>id - int</li>
                        <li>orderid - int</li>
                        <li>productid - int</li>
                        <li>amount - int</li>
                    </ul>
                </div>
                <div class="tables">
                    <h3>Resulting ERD</h3>
                    <img src="../../images/database_ER_diagram800w.png" alt="ERD drawing">
                    <p>Given the information for this project, this is the relation between the records and tables.</p>
                </div>
            </div>
        </div> <!-- container -->
</body>
</html>