<?php
// Define upload directory
$uploadDir = 'uploads/';

// Ensure the uploads directory exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Allowed file types and size
$allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
$maxSize = 5 * 1024 * 1024; // 5 MB

// Check if a file was uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Check for upload errors
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Validate file type
        if (!in_array($file['type'], $allowedTypes)) {
            die("Invalid file type. Allowed types: JPEG, PNG, PDF.");
        }

        // Validate file size
        if ($file['size'] > $maxSize) {
            die("File is too large. Maximum size is 5 MB.");
        }

        // Sanitize the file name
        $fileName = basename($file['name']);
        $fileName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $fileName);

        // Generate unique file name to prevent overwriting
        $uniqueFileName = uniqid() . '_' . $fileName;
        $targetFile = $uploadDir . $uniqueFileName;

        // Move file to the uploads directory
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            echo "File uploaded successfully: <a href='$targetFile'>$uniqueFileName</a>";
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "File upload error: " . $file['error'];
    }
} else {
    echo "No file uploaded.";
}
