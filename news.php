    <!-- ข่าวสาร -->
    <div class="container py-3">
        <?php
            include_once "admin/conn.php";
            $sql_type = "SELECT * FROM news_type";
            $stmt_type = $conn->prepare($sql_type);
            $stmt_type->execute();
            $result_type = $stmt_type->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result_type as $row_type) {
                $news_type_id=$row_type['news_type_id'];
        ?>

        <h2><?=$row_type['news_type_name']?></h2>
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
            <div class="col">
                <div class="card h-100">
                <img src="news/21.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">โครงการนักศึกษาร่วมใจอาสาพัฒนามหาวิทยาลัย</h5>
                </div>
                <div class="card-footer">
                    <small class="text-body-secondary">Last updated 3 mins ago</small>
                </div>
                </div>
            </div>
        </div>
        <?php
            }
        ?>


    </div>
 