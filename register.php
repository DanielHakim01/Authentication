<?php
// Connect to the database
$database_host = "localhost";  // MySQL server address
$database_user = "root";         // MySQL username
$database_password = "";             // MySQL password
$database_name = "user";           // MySQL database name

$conn = mysqli_connect("localhost", "root", "", "user");

// Check if the connection was successful
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if (isset($_POST["submit"])) {
	// Sanitize and validate the form data
	$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
	$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
	$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
	$confirm_password = filter_var($_POST["confirm_password"], FILTER_SANITIZE_STRING);

	if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
		die("Please fill in all the required fields");
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		die("Invalid email format");
	}

	if ($password !== $confirm_password) {
		die("Passwords do not match");
	}

	// Hash the password
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	// Check if the user already exists in the database
	$query = "SELECT * FROM user_info WHERE email='$email'";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
		die("User already exists");
	}

	// Insert the user data into the database
	$query = "INSERT INTO user_info (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
	$result = mysqli_query($conn, $query);

	if ($result) {
		// Registration successful
		header("Location: login.html");
		exit();
	} else {
		die("Could not register user: " . mysqli_error($conn));
	}
}

// Close the database connection
mysqli_close($conn);
?>
