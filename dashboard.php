<?php
// Start the session and check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

include 'db.php'; // Include DB connection

$userId = $_SESSION['user_id']; // Get logged-in user ID

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // File validation
    $fileName = basename($file['name']);
    $fileTmpName = $file['tmp_name'];
    $uploadDir = 'uploads/';
    $filePath = $uploadDir . $fileName;

    // Move the uploaded file to the 'uploads' folder
    if (move_uploaded_file($fileTmpName, $filePath)) {
        // Insert file info into the database
        $stmt = $conn->prepare("INSERT INTO files (user_id, file_name, file_path) VALUES (?, ?, ?)");
        if ($stmt->execute([$userId, $fileName, $filePath])) {
            echo "<p>File uploaded successfully!</p>";
        } else {
            echo "<p>Error uploading file to the database.</p>";
        }
    } else {
        echo "<p>Error uploading file.</p>";
    }
}

// Fetch files uploaded by the logged-in user
$stmt = $conn->prepare("SELECT id, file_name, file_path FROM files WHERE user_id = ?");
$stmt->execute([$userId]);
$files = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="styledashboard.css"> <!-- Link to CSS -->
</head>
<body>
    <div class="dashboard">
        <h1>Welcome to your Dashboard!</h1>

        <!-- Navigation links to Upload and Available Files pages -->
        <nav>
            <ul>
                <li><a href="upload-form.html">Upload a New File</a></li>
                <li><a href="available-files.php">View Available Files</a></li>
            </ul>
        </nav>

        <!-- File Upload Form -->
        <section class="upload-section">
            <h2>Upload a New File</h2>
            <form action="dashboard.php" method="POST" enctype="multipart/form-data">
                <label for="file">Choose a file:</label>
                <input type="file" name="file" id="file" required>
                <button type="submit">Upload</button>
            </form>
        </section>

        <!-- Available Files Section -->
        <section class="available-files-section">
            <h2>Your Files</h2>
            <?php if (count($files) > 0): ?>
                <ul>
                    <?php foreach ($files as $file): ?>
                        <li>
                            <a href="<?php echo $file['file_path']; ?>" target="_blank"><?php echo $file['file_name']; ?></a>
                            <a href="share_file.php?file_id=<?php echo $file['id']; ?>" class="share-link">Share</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No files found. Please upload some files.</p>
            <?php endif; ?>
        </section>

        <!-- Logout Section -->
        <section class="logout-section">
            <a href="logout.php" class="logout-btn">Logout</a>
        </section>
    </div>
</body>
</html>
