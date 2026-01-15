<?php
include "../Model/logindb.php";

echo "<h3>Users Table Structure:</h3>";
$result = $conn->query("DESCRIBE users");
while ($row = $result->fetch_assoc()) {
    echo $row['Field'] . " - " . $row['Type'] . "<br>";
}

echo "<br><h3>Sample User Data:</h3>";
$users = $conn->query("SELECT * FROM users LIMIT 1");
if ($users->num_rows > 0) {
    $user = $users->fetch_assoc();
    foreach ($user as $key => $value) {
        echo "$key: $value<br>";
    }
}
?>
