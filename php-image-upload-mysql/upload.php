
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $host = 'localhost';
    $db = 'image_upload_db';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    try {
        $pdo = new PDO($dsn, $user, $pass);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }

    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    if (empty($title)) {
        die("Image title is required.");
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $mimeType = mime_content_type($fileTmpPath);
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (in_array($mimeType, $allowedMimeTypes)) {
            $imageData = file_get_contents($fileTmpPath);

            $sql = "INSERT INTO images (title, mime_type, image_data) VALUES (:title, :mime_type, :image_data)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':mime_type', $mimeType);
            $stmt->bindParam(':image_data', $imageData, PDO::PARAM_LOB);

            if ($stmt->execute()) {
                echo "Image uploaded successfully.";
            } else {
                echo "Failed to upload image.";
            }
        } else {
            echo "Only JPG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "Invalid request.";
}
?>
