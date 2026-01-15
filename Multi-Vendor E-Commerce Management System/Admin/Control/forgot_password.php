<?php
session_start();
include "../Model/logindb.php";

$email = "";
$message = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    
    if (empty($email)) {
        $error = "Email is required";
    } else {
        $sql = "SELECT id, username, email FROM users WHERE LOWER(email) = LOWER(?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $reset_token = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', time() + 3600);
            
            $update_sql = "UPDATE users SET reset_token = ?, reset_expires = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ssi", $reset_token, $expires, $user['id']);
            $update_stmt->execute();
            
            $reset_link = "http://localhost/WT_FALL25-26/Multi-Vendor%20E-Commerce%20Management%20System/Admin/Control/reset_password.php?token=" . $reset_token;
            $message = "Password reset link: <a href='$reset_link'>Click here to reset</a>";
        } else {
            $error = "Email not found";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../CSS/login.css">
</head>
<body>

<form method="post" action="">
    <h1>Forgot Password</h1>
    
    <?php if($message) echo "<div style='color: green; margin: 10px 0;'>$message</div>"; ?>
    <?php if($error) echo "<div class='error'>$error</div>"; ?>

    <div>
        Email:
        <input type="email" name="email" placeholder="Enter Your Email" value="<?php echo htmlspecialchars($email); ?>" required>
    </div>

    <div id="button">
        <button type="submit">Send Reset Link</button>
    </div>

    <div class="register-link">
        <a href="login.php">Back to Login</a>
    </div>
</form>

</body>
</html>
