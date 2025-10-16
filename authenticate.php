<?php
session_start();
require 'admin/conn.php';  // ไฟล์เชื่อมต่อฐานข้อมูล PDO

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Please fill in both username and password.";
        header("Location: login.php");
        exit();
    }

    // ดึงข้อมูล user จากฐานข้อมูล
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $user['password'])) {
            // เข้าสู่ระบบสำเร็จ สร้าง session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;

            header("Location: admin");
            exit();
        } else {
            $_SESSION['error'] = "Invalid password.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "User not found.";
        header("Location: login.php");
        exit();
    }
} else {
    // หากเข้าหน้านี้โดยตรงไม่ผ่าน POST
    header("Location: login.php");
    exit();
}
