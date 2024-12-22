<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $fileName = $_FILES['file']['name'];
    $filePath = "uploads/" . basename($fileName);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
        $stmt = $conn->prepare("INSERT INTO files (user_id, file_name, file_path) VALUES (?, ?, ?)");
        if ($stmt->execute([$userId, $fileName, $filePath])) {
            echo "File uploaded successfully!";
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Failed to upload file.";
    }
}
?>