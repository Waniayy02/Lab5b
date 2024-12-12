<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="register.php">
        <label>Matric:</label><br>
        <input type="text" name="matric" required><br><br>
        
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <label>Role:</label><br>
        <select name="role" required>
            <option value="student">Student</option>
            <option value="lecturer">Lecturer</option>
        </select><br><br>
        
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $conn = new mysqli("localhost", "root", "", "Lab_5b");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
