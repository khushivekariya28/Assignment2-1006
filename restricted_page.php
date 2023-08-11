<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: sign_in.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Restricted Page</title>
</head>
<body>
    <h1>Welcome to the Restricted Page</h1>
    <p>This content is visible only to logged-in users.</p>
    <p><a href="logout.php">Log Out</a></p>
</body>
</html>
