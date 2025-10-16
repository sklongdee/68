<!-- login.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php
    // แสดงข้อความว่าลงทะเบียนสำเร็จ (ถ้ามี)
    if (isset($_GET['registered']) && $_GET['registered'] == 1) {
        echo '<p style="color:green;">Registration successful! Please login.</p>';
    }

    // แสดงข้อความ error จาก session (ถ้ามี)
    session_start();
    if (isset($_SESSION['error'])) {
        echo '<p style="color:red;">' . htmlspecialchars($_SESSION['error']) . '</p>';
        unset($_SESSION['error']);
    }
    ?>

    <form method="post" action="authenticate.php">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>
