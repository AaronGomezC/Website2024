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

// Signup logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);

    // Hash the password before storing in the database
    $hashed_password = md5($password);

    // Check if the email is already registered
    $check_sql = "SELECT id FROM accounts WHERE email='$email'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows == 0) {
        // Email is not registered, proceed with signup
        $signup_sql = "INSERT INTO accounts (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
        if ($conn->query($signup_sql) === TRUE) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header("Location: dashboard.php"); // Redirect to dashboard after successful signup
            exit;
        } else {
            $error = "Error: " . $signup_sql . "<br>" . $conn->error;
        }
    } else {
        $error = "Email is already registered";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
</head>
<body>

<h2>Sign Up</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Name: <input type="text" name="name"><br><br>
    Email: <input type="text" name="email"><br><br>
    Password: <input type="password" name="password"><br><br>
    <input type="submit" name="submit" value="Sign Up">
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
