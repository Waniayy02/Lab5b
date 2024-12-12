<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Users Table</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['user']['name']; ?>!</h2>
    <a href="logout.php">Logout</a>
    <h2>Users Table</h2>
    <table border="1">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Role</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
        $conn = new mysqli("localhost", "root", "", "Lab_5b");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT matric, name, role FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['matric'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['role'] . "</td>";
                echo "<td><a href='update_form.php?matric=" . $row['matric'] . "'>Update</a></td>";
                echo "<td><a href='delete.php?matric=" . $row['matric'] . "' onclick=\"return confirm('Are you sure?')\">Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
