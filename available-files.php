<?php
$uploadDir = 'uploads/';

// Fetch files in the upload directory
$files = array_diff(scandir($uploadDir), ['.', '..']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Files for Sharing</title>
    <style>
        /* Add your CSS styling here (same as before) */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 8px 0;
            font-size: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background-color: #218838;
        }

        p {
            color: #666;
            font-size: 18px;
            margin-top: 20px;
        }

        .share-form input, .share-form select {
            margin: 8px 0;
            padding: 8px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (count($files) > 0): ?>
            <h2>Available Files for Sharing:</h2>
            <ul>
                <?php
                // Loop through each file and display it with its file ID
                foreach ($files as $index => $file):
                    // Generate a unique file ID for this example (assuming the file ID is its index in the list)
                    $fileId = $index + 1; // This is just an example, adjust based on your DB structure
                    $fileUrl = htmlspecialchars($uploadDir . $file);
                ?>
                    <li>
                        <span><a href="<?= $fileUrl; ?>" target="_blank"><?= htmlspecialchars($file); ?></a> (ID: <?= $fileId; ?>)</span>
                        <form class="share-form" action="share_file.php" method="POST">
                            <input type="hidden" name="file_id" value="<?= $fileId; ?>">
                            
                            <!-- New fields for shared_with and permissions -->
                            <input type="text" name="shared_with" placeholder="Email or Username" required>
                            <select name="permissions" required>
                                <option value="read">Read</option>
                                <option value="write">Write</option>
                            </select>
                            
                            <button type="submit">Share</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No files available for sharing.</p>
        <?php endif; ?>
    </div>
</body>
</html>
