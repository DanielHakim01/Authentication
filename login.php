<?php

$database_host = "localhost";  // MySQL server address
$database_user = "root";         // MySQL username
$database_password = "";             // MySQL password
$database_name = "user";           // MySQL database name

$conn = mysqli_connect("localhost", "root", "", "user");

// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Sanitize and validate form data
$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

// Check if the user exists in the database
$sql = "SELECT * FROM user_info WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
  // Verify the password
  $row = mysqli_fetch_assoc($result);
  if (password_verify($password, $row['password'])) {
    // Password is correct, start the session and redirect to the home page
    session_start();
    $_SESSION['email'] = $email;
    header('Location: studentForm.html');
  } else {
    // Password is incorrect, show an error message
    echo "Invalid email or password";
  }
} else {
  // User does not exist in the database, show an error message
  echo "Invalid email or password";
}

// Close the database connection
mysqli_close($conn);
