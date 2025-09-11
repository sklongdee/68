<div class="container">
<?php

// กำหนดการเชื่อมต่อฐานข้อมูล
$host = "localhost";    // หรือ IP ของเซิร์ฟเวอร์
$dbname = "it68"; // ชื่อฐานข้อมูล
$username = "root"; 
$password = "";

try {
    // สร้างการเชื่อมต่อ PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // ตั้งค่า Error Mode
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // เขียนคำสั่ง SQL
    $sql = "SELECT * FROM news ORDER BY news_date DESC";

    // เตรียมและ execute
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // ดึงข้อมูลเป็น associative array
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // แสดงผลข้อมูล
    foreach ($result as $row) {
        echo "ID: " . $row['news_id'] . "<br>";
        echo "หัวข้อข่าว: " . $row['news_title'] . "<br>";
        echo "รายละเอียด: " . $row['news_detail'] . "<br>";
        echo "รูปภาพ: " . $row['news_img'] . "<br>";
        echo "ประเภท: " . $row['news_type'] . "<br>";
        echo "วันที่: " . $row['news_date'] . "<br>";
        echo "ผู้เขียน: " . $row['news_admin'] . "<hr>";
    }

} catch(PDOException $e) {
    echo "การเชื่อมต่อล้มเหลว: " . $e->getMessage();
}
?>

</div>