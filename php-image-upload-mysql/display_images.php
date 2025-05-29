
<?php
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

$sql = "SELECT id, title, mime_type, image_data FROM images ORDER BY uploaded_on DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Uploaded Images</title>
</head>
<body>
    <h2>Uploaded Images</h2>
    <?php if ($images): ?>
        <?php foreach ($images as $image): ?>
            <div>
                <h3><?php echo htmlspecialchars($image['title']); ?></h3>
                <img src="data:<?php echo $image['mime_type']; ?>;base64,<?php echo base64_encode($image['image_data']); ?>" alt="<?php echo htmlspecialchars($image['title']); ?>" width="300">
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No images found.</p>
    <?php endif; ?>
</body>
</html>
