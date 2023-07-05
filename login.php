<?php 
// session_start(); 
// if (array_key_exists('signUp', $_POST)) {
	# code...
	// include("connection.php");

	// echo "<br>sign Up button pressed";
// }
?>
<!-- // <html>
// <head>
// 	<title>Login</title>
// 	<style>
// 		.container{
// 			text-align: center;
// 			justify-content: center;
// 			align-items: center;
// 		}
// 		input{
// 			text-align: center;
// 			padding: 5px;
// 		}
// 	</style>
// </head> -->
<!-- 
<body>
<a href="index.php">Home</a> <br /> -->
<?php

// if (isset($_POST['submit'])) {
// 	$username = mysqli_real_escape_string($mysqli, $_POST['username']);
// 	$password = mysqli_real_escape_string($mysqli, $_POST['password']);

// 	if ($username == "" || $password == "") {
// 		echo "Either username or password field is empty.";
// 		echo "<br/>";
// 		echo "<a href='login.php'>Go back</a>";
// 	} else {
// 		$result = mysqli_query($mysqli, "SELECT * FROM login WHERE username='$username' AND password= password_hash('$password')")
// 			or die("Could not execute the select query.");

// 		$row = mysqli_fetch_assoc($result);

// 		if (is_array($row) && !empty($row)) {
// 			$validuser = $row['username'];
// 			$_SESSION['valid'] = $validuser;
// 			$_SESSION['name'] = $row['username'];
// 			$_SESSION['id'] = $row['id'];
// 		} else {
// 			echo "Invalid username or password.";
// 			echo "<br/>";
// 			echo "<a href='login.php'>Go back</a>";
// 		}

// 		if (isset($_SESSION['valid'])) {
// 			header('Location: index.php');
// 		}
// 	}
// } else {
	?>
	<!-- <div class="container">
		<p><font size="+2">Login</font></p>
		<form name="form1" method="post" action="">
				
				<label>Username:</label>
				<input type="text" name="username" placeholder="Username"><br><br>
				<label>Password:</label>
				<input type="password" name="password" placeholder="Password"><br><br>
				&nbsp;
				<input type="submit" name="submit" value="Submit">
		</form>
	</div> -->
<?php
// }
// ?>
<!-- </body> -->
<!-- </html> -->

<?php
include("server.php");
?>
<!DOCTYPE html>
<head>
	<title>Register</title>
	<style>
		.container{
			text-align: center;
			justify-content: center;
			align-items: center;
			margin: 50px 50px;
			padding: 30px 30px;
			border: 2px solid  #d34970; 
			background-color:  antiquewhite;
			border-radius: 9px;
		}
		.form-group input{
			font-family: 'Fira Sans', 'sans-serif';
			text-align: center;
			display: block;
			width: 400px;
			padding:  8px;
			border: 2px solid black;
			border-radius: 9px;
			margin:  11px auto;
			font-size: 20px;
			
		}
		.error{
			background-color:pink;
			color: red;
			width: 300px;
			margin: 0 auto;
		}

		.btn{
			font-family: 'Fira Sans', 'sans-serif';
			margin: 0px 9px;
			background-color: black;
			color: aliceblue;
			padding: 4px, 14px;
			border: 2px solid grey;
			border-radius: 10px;
			fomt-size: 15px;
			cursor: pointer;
		}
		.btn:hover{
			background-color: grey;
		}


		.active a{
			text-decoration: none;
			
		}
	</style>
</head>
<body>
	<div class ="active">
		<a href="index.php">Home</a>
	</div>
	<div class="container">
		<h1>Login</h1>
		<h2><a href="loggedInPage.php">Homepage</a></h2>
		<form name="form1" method="post" action="">
			<div class="error"><?php echo $error2; ?></div>
				<div class = "form-group">
					<input type="text" name="email" placeholder ="Email">
				</div>
				<div class = "form-group">
					<input type="password" name="password" placeholder="Password">
				</div>
				<div class = "form-group">
					<label>Keep me logged in</label>
					<input type="checkbox" name="stayLoggedIn" />
				</div>
				<div class = "form-group">
					<input class = "btn" type="submit" name="logIn" value="Log In">
				</div>		
					<p>Not Registerd?<a href="register.php">Register</a></p>
				</div>
	</form>
</div>
</body>
</html>
