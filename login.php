<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <label>Matric:</label><br>
        <input type="text" name="matric" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" name="submit" value="Login">
    </form>

    <p><a href="register.php">Register here</a> if you have not.</p>
</body>
</html>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form input
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "Lab_5b");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to check if matric exists in the database
    $sql = "SELECT * FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Fetch user data
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            echo "<p>Login successful! Welcome, " . $row['name'] . ".</p>";
            // Redirect to another page (optional)
            // header("Location: display.php");
        } else {
            echo "<p style='color:red;'>Invalid password. Try again.</p>";
        }
    } else {
        echo "<p style='color:red;'>Invalid matric number. Try again.</p>";
    }

    // Close the database connection
    $conn->close();
}
?>
