<?php
include "logindb.php";

$sql = "CREATE TABLE IF NOT EXISTS auth_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    selector VARCHAR(32) NOT NULL UNIQUE,
    hashed_validator VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    expires DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";

if ($conn->query($sql) === TRUE) {
    echo "Table auth_tokens created successfully or already exists";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
