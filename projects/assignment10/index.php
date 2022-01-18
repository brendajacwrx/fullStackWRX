<?php
	require_once("php/form.php");
	/*
		Brenda J Anderson
		CPS276 Fall 2020
		Washtenaw Community Collge
		Doug Andrews Instructor
		
		Assignment Final Project

	*/
	/* WRITE THE NECESSARY PHP CODE HERE.  YOU WILL NEED TO RETURN AN ARRAY THAT
	CONTAINS TWO INDEXES. FIRST INDEX IS A PLACE FOR A MESSAGE (MAYBE BLANK OR NOT
	DEPENDING ON THE SITUATION) AND THE OTHER IS THE FORM OR THE TABLE DISPLAYING
	THE DATA (SEE $RESULT VARIABLE BELOW). */


	/* data declarations */

	$errMsgs = [];
	$errMsgs['name'] = 'Only upper and lower case alpha characters, hyphens, ';
	$errMsgs['name'] .= 'spaces and periods only (cannot be blank)';
	$errMsgs['address'] = 'Must start with a number then alpha characters, ';
	$errMsgs['address'] .= 'spaces, hyphens and periods only (cannot be blank)';
	$errMsgs['city'] = 'Must be alpha characters only (cannot be blank)';
	$errMsgs['phone'] = 'Must be in format 999.999.999 where 9 is a digit of ';
	$errMsgs['phone'] .= '0 to 9 (cannot be blank)';
	$errMsgs['email'] = 'Valid email address (cannot be blank)';
	$errMsgs['blank'] = '(Cannot be blank)';


	$elementsArr['masterStatus']['type'] = 'masterStatus';
	$elementsArr['masterStatus']['status'] = 'null';

	$elementsArr['name']['type'] = 'text';
	$elementsArr['name']['regex'] = 'name';
	$elementsArr['name']['errorMessage'] = $errMsgs['name'];
	$elementsArr['name']['errorOutput'] = '';
	$elementsArr['name']['value'] = 'Doug';


	$elementsArr['address']['type'] = 'text';
	$elementsArr['address']['regex'] = 'address';
	$elementsArr['address']['errorMessage'] = $errMsgs['address'];
	$elementsArr['address']['errorOutput'] = '';
	$elementsArr['address']['value'] = '2438 Wcc College';

	$elementsArr['city']['type'] = 'text';
	$elementsArr['city']['regex'] = 'city';
	$elementsArr['city']['errorMessage'] = $errMsgs['city'];
	$elementsArr['city']['errorOutput'] = '';
	$elementsArr['city']['value'] = 'Ann Arbor';

	$elementsArr['state']['type'] = 'select';
	$elementsArr['state']['options'] = ["ca" => "California", "ga" => "Georgia", "mi" => "Michigan", "pa" => "Pennslyvania", "wi" => "Wisconsin"];
	$elementsArr['state']['selected'] = 'mi';
	$elementsArr['state']['regex'] = 'name';
	$elementsArr['state']['errorOutput'] = '';
	$elementsArr['state']['errorMessage'] = $errMsgs['blank'];

	$elementsArr['phone']['type'] = 'text';
	$elementsArr['phone']['regex'] = 'phone';
	$elementsArr['phone']['errorMessage'] = $errMsgs['phone'];
	$elementsArr['phone']['errorOutput'] = '';
	$elementsArr['phone']['value'] = '246.354.1018';

	$elementsArr['email']['type'] = 'text';
	$elementsArr['email']['regex'] = 'email';
	$elementsArr['email']['errorMessage'] = $errMsgs['email'];
	$elementsArr['email']['errorOutput'] = '';
	$elementsArr['email']['value'] = 'doug@wcc.net';

	$elementsArr['dob']['type'] = 'text';
	$elementsArr['dob']['regex'] = 'dob';
	$elementsArr['dob']['errorMessage'] = $errMsgs['blank'];
	$elementsArr['dob']['errorOutput'] = '';
	$elementsArr['dob']['value'] = '1990-08-18';

	$elementsArr['contact']['type'] = 'checkbox';
	$elementsArr['contact']['errorOutput'] = '';
	$elementsArr['contact']['action'] = 'notRequired';
	$elementsArr['contact']['status'] = ["c1" => "", "c2" => "", "c3" => ""];

	$elementsArr['age']['type'] = 'radio';
	$elementsArr['age']['errorOutput'] = '';
	$elementsArr['age']['errorMessage'] = $errMsgs['blank'];
	$elementsArr['age']['action'] = 'required';
	$elementsArr['age']['value'] = ["age1" => "", "age2" => "checked", "age3" => "", "age4" => ""];

	$result = [];
	/*  ***************************************************************************** */
	// Page logic
	if (is_null($page)) {
		$result = init($elementsArr);
	} else if (!empty($_REQUEST['page'])) {
		$page = $_REQUEST['page'];

	}
		if (isset($_GET)) {
			if ($_GET['page'] === "form") {
				//CODE GOES HERE TO REQUIRE THE FORM.PHP PAGE AND CALL WHATEVER METHOD
				//YOU WROTE
				
				if (isset($_POST['submit'])) {
				$result = checkForm( $_POST, $elementsArr );
				}
			} else if ($_GET['page'] === "display") {
				//CODE GOES HERE TO REQUIRE THE DISPLAYRECORDS.PHP PAGE AND CALL
				//WHATEVER METHOD YOU WROTE
				require_once("php/displayRecords.php");
				$result = getTable();
			} else {
				//HEADER REDIRECT HERE
				header("Location: index.php?page=form");
			}
		} else {
			//HEADER REDIRECT HERE
			header("Location: index.php?page=form");
		}


		if (isset($_POST['delete'])) {
			//echo('you pressed delete');
			$result = deleteContacts($_POST);
		}
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Final Project</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<style>
			.error {
				color: red;
				margin-left: 5px;
			}

			.space {
				margin-right: 30px;
			}

			nav ul li {
				list-style: none;
			}

			input[type=submit] {
				margin: 10px 0;
			}
		</style>
	</head>

	<body class="container">
		<nav>
			<ul>
				<li><a href="index.php?page=form">Add Contact Information</a></li>
				<li><a href="index.php?page=display">Display All Contacts Information</a></li>
			</ul>
		</nav>

		<?php
		/* THE ACKNOWLEDGEMENT GOES HERE AS THE FIRST INDEX OF THE ARRAY  */
		echo $result[0];

		/* THE FORM GOES HERE.  LOOK AT THE FORM.PHP PAGE TO SEE HOW THE RETURN IN DONE. */
		echo $result[1];
		?>
</body>

</html>