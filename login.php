<?php   
session_start();

$database_host = 'localhost';
$database_user = 'root';
$database_password = '';
$database_name = 'user_info';
$conn = mysqli_connect($database_host, $database_user, $database_password, $database_name);

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // retrieve user from database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    // check if user exists in the database
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $db_password = $row['password'];

        // verify password
        if (password_verify($password, $db_password)) {
            // login successful, save user session
            $_SESSION['username'] = $username;

            // redirect to home.php or privilege.php if the user name is "admin"
            if ($username === 'admin') {
                header("Location: privilege.php");
            } else {
                header("Location: studentForm.html");
            }
        } else {
            // login failed, display error message
            header('Location: login.html?error=Invalid username or password.');
        }
    } else {
        // login failed, display error message
        header('Location: login.html?error=Invalid username.');
    }
}
// }
?>
