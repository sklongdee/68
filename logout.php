<?php
session_start();

// ล้าง session ทั้งหมด
session_unset();
session_destroy();

// รีไดเรกต์กลับไปหน้า login
header("Location: login.php");
exit();
