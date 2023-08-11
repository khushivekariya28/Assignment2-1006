<?php
$servername = "localhost";
$username_db = "root";
$password_db = "Khu@28shi";
$dbname = "Connection1";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        if (password_verify($password, $hashedPassword)) {
            session_start();
            $_SESSION["username"] = $username;
            
            header("Location: login_success.php");
            exit();
        } else {
            // Incorrect password
            $error_message = "Incorrect password. Please try again.";
        }
    } else {
        // Username not found
        $error_message = "Username not found.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Login</h1>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
    <?php if (isset($error_message)) { ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php } ?>
</body>
</html>
