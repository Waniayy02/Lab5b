<?php
include 'Database.php';
include 'User.php';

// Check if matric is provided via GET
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    // Create Database and User instances
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    // Call deleteUser
    if ($user->deleteUser($matric)) {
        echo "User deleted successfully.";
    } else {
        echo "Failed to delete user.";
    }

    // Close connection
    $db->close();
} else {
    echo "Matric ID not provided.";
}
