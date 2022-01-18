<?php
	$heading = 'My Web Page';
	$myName = 'Brenda J Anderson';
	$paragraph = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus feugiat mollis dolor at bibendum. 
	 Nullam ut enim id erat bibendum finibus nec ac eros. Nulla malesuada ex facilisis ultrices rhoncus. Nullam in 
	 euismod nisl. Donec pulvinar ex sit amet aliquet egestas.';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>&lt;inject title here&gt;</title>
	<style>
		* {margin: 0; padding: 0;}
		body {font: 120%/1.5 sans-serif;}
		#wrapper {width: 1000px; margin: 0 auto; border: 1px solid black;}
		header {background: green; height: 150px; padding: 20px;}
		header h1 {color: white;}
		main {padding: 10px;}
		main h2 {margin: 15px 0;}
		main p {margin-bottom: 15px;}
		footer {background: #eee; padding: 10px 0; text-align: center}
		footer p {font-size: .8em;}
	</style>
</head>
<body>
	<div id="wrapper">
		<header>
			<h1><?php echo($heading); ?></h1>
		</header>
		<main>
			<h2>My name is <?php echo($myName); ?></h2>
			<?php 
				for ($i=0; $i < 3; $i++) { 
					# code...
					echo('<p>'.$paragraph.$paragraph.'</p>');
				}
			?>			
		</main>
		<footer>
			<p><?php echo($heading);?> &copy;<?php echo date('Y');?></p>
		</footer>
	</div>
	
</body>
</html>