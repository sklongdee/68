<div class="container">
    <h1>รายละเอียดข่าวสาร</h1>
    <?php
    $news_id = $_GET["news_id"];
    include_once "admin/conn.php";
    $sql_news = "SELECT * FROM news WHERE news_id = $news_id";
    $stmt_news = $conn->prepare($sql_news);
    $stmt_news->execute();
    $result_news = $stmt_news->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result_news as $row_news) {
    ?>
<div class="card mb-3">
  <img src="news/<?=$row_news['news_img']?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?=$row_news['news_title']?></h5>
    <p class="card-text"><?=$row_news['news_detail']?></p>
    <p class="card-text"><small class="text-body-secondary">Last updated <?=$row_news['news_date']?></small></p>
  </div>
</div>
    <?php } ?>
</div>