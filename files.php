<?php
$uploadDir = 'uploads/';

// Fetch files in the upload directory
$files = array_diff(scandir($uploadDir), ['.', '..']);

if (count($files) > 0) {
    echo "<h2>Available Files:</h2><ul>";
    foreach ($files as $file) {
        $fileUrl = $uploadDir . $file;
        echo "<li><a href='$fileUrl' target='_blank'>$file</a></li>";
    }
    echo "</ul>";
} else {
    echo "No files available for sharing.";
}
