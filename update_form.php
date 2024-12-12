<?php
include 'Database.php';
include 'User.php';

// Fetch the user's details based on matric
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $userDetails = $user->getUser($matric);

    $db->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <form action="update.php" method="post">
        <input type="hidden" name="matric" value="<?php echo $userDetails['matric']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $userDetails['name']; ?>" required><br>
        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="lecturer" <?php echo ($userDetails['role'] == 'lecturer') ? 'selected' : ''; ?>>Lecturer</option>
            <option value="student" <?php echo ($userDetails['role'] == 'student') ? 'selected' : ''; ?>>Student</option>
        </select><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
