<?php
    include_once "conn.php";
    $news_title = $_POST["news_title"] ?? '';
    $news_detail  = $_POST['news_detail']  ?? '';
    $news_type     = $_POST['news_type']     ?? '';

    $stmt = $conn->prepare("
        INSERT INTO news (news_title, news_detail, news_type)
        VALUES (:news_title, :news_detail, :news_type)
    ");

    $success = $stmt->execute([
        ':news_title'  => $news_title,
        ':news_detail' => $news_detail,
        ':news_type'   => $news_type,
    ]);
    if ($success) {
        header("Location: ./?id=news");
        exit;
    } else {
        echo "เกิดข้อผิดพลาด: ไม่สามารถเพิ่มข้อมูลได้";
    }

?>