<?php
session_start();

$conn = new mysqli("localhost", "root", "", "Lab_5b");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Store user info in session
            $_SESSION['user'] = [
                'matric' => $row['matric'],
                'name' => $row['name'],
                'role' => $row['role']
            ];
            // Redirect to the table page
            header("Location: read.php");
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with this matric!";
    }

    $conn->close();
}
?>
