<?php
include("server.php");

// if(isset($_POST['submit'])) {
// 	$name = $_POST['name'];
// 	$email = $_POST['email'];
// 	$user = $_POST['username'];
// 	$pass = $_POST['password'];

// 	if($user == "" || $pass == "" || $name == "" || $email == "") {
// 		echo "All fields should be filled. Either one or many fields are empty.";
// 		echo "<br/>";
// 		echo "<a href='register.php'>Go back</a>";
// 	} else {
// 		mysqli_query($mysqli, "INSERT INTO login(name, email, username, password) VALUES('$name', '$email', '$user', md5('$pass'))")
// 			or die("Could not execute the insert query.");
			
// 		echo "Registration successfully";
// 		echo "<br/>";
// 		echo "<a href='login.php'>Login</a>";
// 	}
// } 
?>
<!DOCTYPE html>
<head>
	<title>Register</title>
	<style>
		.container{
			text-align: center;
			justify-content: center;
			align-items: center;
		}
		input{
			padding:  5px;
			text-align: center;
		}
		.error{
			background-color:pink;
			color: red;
			width: 300px;
			margin: 0 auto;
		}
	</style>
</head>
<body>
<a href="index.php">Home</a> <br />
	<div class="container">
		<h1>Registration</h1>
		<h2><a href="loggedInPage.php">Homepage</a></h2>
		<form name="form1" method="post" action="">
			<div class="error"><?php echo $error; ?></div>

			
			<input type="text" name="username" placeholder = "Username"><br><br>
			
			<input type="text" name="email" placeholder ="Email"><br><br>
			
				
				<input type="password" name="password" placeholder="Password"><br><br>


				<input type="password" name="repeatpassword" placeholder="Re-Password"><br><br>

				<label for="checkbox">Keep me loggedd in</label>

				<input type="checkbox" name="stayLoggedIn" value="1"/><br><br>

				<input type="submit" name="signUp" value="Submit"><br><br>
				<p>Have an account already?<a href="login.php">Log in</a></p>

	</form>
</div>
</body>
</html>
