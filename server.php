<?php
session_start();

// PHP code to log the user out
if (isset($_GET['logout'])) {
    unset($_SESSION['id']);
    setcookie('id', "", time() - 60*60);
    $_COOKIE ="";
}

$error = "";

if (isset($_POST['signUp'])) {
    include("connection.php");
    
    // Sanitize and validate user input
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $repeatPassword = mysqli_real_escape_string($mysqli, $_POST['repeatpassword']);

    // Perform data validation
    if (empty($username)) {
        $error .= "Username is required<br>";
    }
    if (empty($email)) {
        $error .= "Email field is empty<br>";
    }
    if (empty($password)) {
        $error .= "Password field is empty<br>";
    }
    if ($password !== $repeatPassword) {
        $error .= "Passwords do not match!<br>";
    }
    echo "<br/>";
	echo "<a href='register.php'>Go back</a>";
    // Check if there are any errors
    if (!empty($error)) {
        $error = "<b>There were the following error(s) in your form:</b><br>" . $error;
    } else {
        // Check if the email already exists in the database
        $query = "SELECT id FROM login WHERE email = '$email'";
        $result = mysqli_query($mysqli, $query);

        if (mysqli_num_rows($result) > 0) {
            $error = "Email already exists<br>";
        } else {
            // Password encryption
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert the user into the database
            $query = "INSERT INTO login (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
            $result = mysqli_query($mysqli, $query);
            
            if (!$result) {
                $error = "Error creating user account. Please try again later.";
            } else {
                $_SESSION['id'] = mysqli_insert_id($mysqli);
                $_SESSION['username'] = $username;
                // echo "You have signed up successfully.<br>";
                echo "Registration successfully";
		        echo "<br/>";
		        echo "<a href='login.php'>Login</a>";

                if ($_POST['stayLoggedIn'] == 1) {
                    setcookie('id', mysqli_insert_id($mysqli), time() +  60*60*365);
                }
                header("Location: view.php");
            }
        }
    }
}

// !PHP Code for user log in
$error2 = "";

if (isset($_POST['logIn'])) {
    include("connection.php");
    
    // validate user input
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);

    // Perform data filters
    if (empty($email)) {
        $error2 .= "Email field is empty<br>";
    }
    if (empty($password)) {
        $error2 .= "Password field is empty<br>";
    }
    echo "<br/>";
	echo "<a href='register.php'>Go back</a>";
    // Check if there are any errors
    if (!empty($error2)) {
        $error2 = "<b>There were the following error(s) in your form:</b><br>" . $error2;
    } else {
        // password and Email matching
        $query = "SELECT id FROM login WHERE email = '$email' AND password= password_hash('$password')";
        $result = mysqli_query($mysqli, $query);
        $row = mysqli_fetch_array($result);  //Get user data form database

        if (isset($row)) {
            # code...
            if (password_verify($password,  $row['password'])){ // If password Matched
                $validuser = $row['username'];
                $_SESSION['valid'] = $validuser;
                $_SESSION['name'] = $row['username'];
                $_SESSION['id'] = $row['id'];
                // echo "You have signed up successfully.<br>";
                echo "Login successfully";
		        echo "<br/>";
		        echo "<a href='login.php'>Login</a>";

                if ($_POST['stayLoggedIn'] == 1) {
                    setcookie('id', mysqli_insert_id($mysqli), time() +  60*60*365);
                }
                header("Location: view.php");
            }else{
                $error2 = "Combination of email/password doesn't matched";
            }
        }else {
            # code...
            $error2 = "Combination of email/password doesn't matched";
        }
    }
}
?>
