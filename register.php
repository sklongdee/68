<?php
session_start();

// ตั้งค่าการเชื่อมต่อ PDO
include_once "admin/conn.php";

// ตรวจสอบการส่งฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // ตรวจสอบความถูกต้องของข้อมูล
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = "Please fill all fields.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // ตรวจสอบว่า username มีอยู่แล้วหรือไม่
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->fetch()) {
            $error = "Username is already taken.";
        } else {
            // เข้ารหัสรหัสผ่าน และเพิ่มผู้ใช้ใหม่
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $success = $stmt->execute([$username, $hashed_password]);

            if ($success) {
                header("Location: login.php?registered=1");
                exit();
            } else {
                $error = "Failed to register. Please try again.";
            }
        }
    }
}
?>

<!-- HTML ส่วนฟอร์มสมัครสมาชิก -->
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="post" action="register.php">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required><br><br>

        <input type="submit" value="Register">
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
