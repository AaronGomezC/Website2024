<?php
session_start();

// Database connection
$db_host = "your_database_host";
$db_username = "your_database_username";
$db_password = "your_database_password";
$db_name = "your_database_name";

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Login logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);

    // Hash the password before comparing with database
    $hashed_password = md5($password);

    $sql = "SELECT id FROM accounts WHERE email='$email' AND password='$hashed_password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login successful, start session
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        header("Location: dashboard.php"); // Redirect to dashboard after successful login
        exit;
    } else {
        $error = "Invalid email or password";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Email: <input type="text" name="email"><br><br>
    Password: <input type="password" name="password"><br><br>
    <input type="submit" name="submit" value="Login">
</form>

<?php
if (isset($error)) {
    echo "<div style='color: red;'>$error</div>";
}
?>

</body>
</html>

<?php
// Close database connection
$conn->close();
?>
