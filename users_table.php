<!DOCTYPE html>
<html>
<head>
    <title>Users Table</title>
</head>
<body>
    <h2>Users Table</h2>
    <table border="1">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Level</th>
            <th colspan="2">Actions</th>
        </tr>

        <?php
        // Database connection
        $conn = new mysqli("localhost", "root", "", "Lab_5b");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch users data
        $sql = "SELECT matric, name, role FROM users";
        $result = $conn->query($sql);

        // Display rows
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['matric'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['role'] . "</td>";
                // Update and Delete links
                echo "<td><a href='update_form.php?matric=" . $row['matric'] . "'>Update</a></td>";
                echo "<td><a href='delete.php?matric=" . $row['matric'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data available</td></tr>";
        }

        // Close connection
        $conn->close();
        ?>
    </table>
</body>
</html>
