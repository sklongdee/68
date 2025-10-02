<?php
if (isset($_FILES['news_img']) && $_FILES['news_img']['error'] === UPLOAD_ERR_OK) {
    echo $_POST["news_id"];
    echo $_POST["news_title"];
    echo $_POST["news_detail"];
    echo $_FILES["news_img"]["name"];
    echo $_POST["news_type"];
} else {
    echo $_POST["news_id"];
    echo $_POST["news_title"];
    echo $_POST["news_detail"];
    echo $_POST["news_type"];
}





?>