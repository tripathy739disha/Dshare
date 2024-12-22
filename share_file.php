<?php
// Include DB connection (make sure to connect to your DB)
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized");
}

// Process the form when the 'Share' button is clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileId = $_POST['file_id'];
    $sharedWith = $_POST['shared_with'];  // User email/username to share with
    $permissions = $_POST['permissions'];  // Permissions (read, write, etc.)

    // Update the file sharing information in the database
    $stmt = $conn->prepare("UPDATE files SET shared_with = ?, permissions = ? WHERE id = ?");
    if ($stmt->execute([$sharedWith, $permissions, $fileId])) {
        echo "File shared successfully!";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>
