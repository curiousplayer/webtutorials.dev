
# PHP Image Upload to MySQL

This project demonstrates how to upload and store images in a MySQL database using PHP.

## Features

- Upload image via HTML form
- Store image as BLOB in MySQL
- Display images directly from the database

## Prerequisites

- PHP 7+
- MySQL 5.7+
- Web server (e.g., Apache, Nginx)
- php-pdo extension

## Setup

1. Create a MySQL database and run the SQL:
```sql
CREATE DATABASE image_upload_db;
USE image_upload_db;

CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    mime_type VARCHAR(50) NOT NULL,
    image_data MEDIUMBLOB NOT NULL,
    uploaded_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

2. Modify the database credentials in `upload.php` and `display_images.php`.

3. Place files in your web server root and visit `index.html` to upload images.

## License

MIT
