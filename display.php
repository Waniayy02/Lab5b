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
                echo "<tr><td>" . $row['matric'] . "</td><td>" . $row['name'] . "</td><td>" . $row['role'] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No data available</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
