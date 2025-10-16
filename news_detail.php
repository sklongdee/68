<h1>รายละเอียดข่าวสาร</h1>
<?php
$news_id = $_GET["news_id"];
include_once "admin/conn.php";
$sql_news = "SELECT * FROM news WHERE news_id = $news_id";
$stmt_news = $conn->prepare($sql_news);
$stmt_news->execute();
$result_news = $stmt_news->fetchAll(PDO::FETCH_ASSOC);
foreach ($result_news as $row_news) {
 echo $row_news['news_title'];
}
?>