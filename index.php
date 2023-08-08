<?php session_start(); ?>
<html>
<head>
	<title>Homepage</title>
	<style>
body {
	margin: auto;
	/* background-color: #d34970; */
}
#container{
	height: 657px;
	justify-content: center;
	text-align:center;
	background-color: antiquewhite;
}
#header {
	width: auto;
	color: maroon;
	font-size: 32px;
	padding: 10px 10px 10px 0px;
	margin-bottom: 25px;
	/* border-bottom: 1px solid green; */
}

#footer {
	/* border-top: 1px solid green; */
	margin-top: 20px;
	color: #336699;
	padding: 10px;	

}

	</style>
</head>

<body>
	<div id= "container">
		<div id="header">
			Welcome to my project !
		</div>
	<?php
	if(isset($_SESSION['valid'])) {			
		include("connection.php");					
		$result = mysqli_query($mysqli, "SELECT * FROM login");
	?>
		Welcome <?php echo $_SESSION['name'] ?> ! <a href='logout.php'>Logout</a><br/>
		<br/>
		<a href='view.php'>View and Add Products</a>
		<br/><br/>
	<?php	
	} else {
		echo "You must be logged in to view this page.<br/><br/>";
		echo "<a href='auth/login.php'>Login</a> | <a href='auth/register.php'>Register</a>";
	}
	?>
	<div id="footer">
		Created by Rohan Maharjan 
	</div>
</div>
</body>
</html>
