<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "Lab_5b");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

echo "<h2>Manage Users</h2>";
echo "<table border='1'>
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Level</th>
            <th>Action</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row['matric'] . "</td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['role'] . "</td>
            <td>
                <a href='update_user.php?matric=" . $row['matric'] . "'>Update</a> |
                <a href='delete_user.php?matric=" . $row['matric'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
            </td>
          </tr>";
}
echo "</table>";

$conn->close();
?>
