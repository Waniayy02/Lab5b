<?php
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "Lab_5b");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch user data
    $sql = "SELECT * FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "<p>User not found.</p>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <form method="POST" action="update_user.php">
        <input type="hidden" name="matric" value="<?php echo $row['matric']; ?>">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>
        <label>Access Level:</label><br>
        <select name="role" required>
            <option value="student" <?php if ($row['role'] == 'student') echo 'selected'; ?>>Student</option>
            <option value="lecturer" <?php if ($row['role'] == 'lecturer') echo 'selected'; ?>>Lecturer</option>
        </select><br><br>
        <input type="submit" name="submit" value="Update">
    </form>
    <a href="manage_users.php">Cancel</a>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    // Update user data in the database
    $sql = "UPDATE users SET name = '$name', role = '$role' WHERE matric = '$matric'";

    if ($conn->query($sql) === TRUE) {
        echo "<p>User updated successfully.</p>";
        // Redirect back to manage users page
        header("Location: manage_users.php");
    } else {
        echo "<p>Error updating user: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>
