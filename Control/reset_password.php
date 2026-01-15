<?php
session_start();
include "../Model/logindb.php";

$token = $_GET['token'] ?? '';
$password = $confirm_password = "";
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);
    $token = $_POST["token"];
    
    if (empty($password)) {
        $error = "Password is required";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match";
    } else {
        $sql = "SELECT id FROM users WHERE reset_token = ? AND reset_expires > NOW()";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $update_sql = "UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $hashed_password, $user['id']);
            $update_stmt->execute();
            
            $success = "Password reset successful! <a href='login.php'>Login now</a>";
        } else {
            $error = "Invalid or expired reset link";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../CSS/login.css">
</head>
<body>

<form method="post" action="">
    <h1>Reset Password</h1>
    
    <?php if($success) echo "<div style='color: green; margin: 10px 0;'>$success</div>"; ?>
    <?php if($error) echo "<div class='error'>$error</div>"; ?>

    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

    <div>
        New Password:
        <input type="password" name="password" placeholder="Enter New Password" required>
    </div>

    <div>
        Confirm Password:
        <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
    </div>

    <div id="button">
        <button type="submit">Reset Password</button>
    </div>

    <div class="register-link">
        <a href="login.php">Back to Login</a>
    </div>
</form>

</body>
</html>
