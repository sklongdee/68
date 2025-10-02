<div class="container-fluid px-4">
    <h1 class="mt-4">จัดการข่าวสาร</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">จัดการข่าวสาร</li>
            
        </ol>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add_news">
            เพิ่มข่าวสาร
        </button>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ภาพข่าว</th>
                            <th>หัวข้อ</th>
                            <th>ประเภท</th>
                            <th>วันที่โพส</th>
                            <th>สถานะ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ภาพข่าว</th>
                            <th>หัวข้อ</th>
                            <th>ประเภท</th>
                            <th>วันที่โพส</th>
                            <th>สถานะ</th>
                            <th>จัดการ</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            include_once "conn.php";
                            $sql_news = "SELECT * FROM news INNER JOIN news_type ON news.news_type=news_type.news_type_id";
                            $stmt_news = $conn->prepare($sql_news);
                            $stmt_news->execute();
                            $result_news = $stmt_news->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result_news as $row_news) {
                        ?>
                        <tr>
                            <td>
                                <img src="../news/<?=$row_news["news_img"]?>" width="40" height="auto"/>
                            </td>
                            <td><?=$row_news["news_title"]?></td>
                            <td><?=$row_news["news_type_name"]?></td>
                            <td><?=$row_news["news_date"]?></td>
                            <td>
                                <?php
                                if($row_news["news_status"]==1){
                                    echo "เปิด";
                                }else{
                                    echo "ปิด";
                                }
                                ?> 
                            </td>
                            <td>แก้ไข ลบ</td>
                        </tr>   
                        <?php
                            }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
</div> 






<!-- Modal เพิ่มข่าวสาร -->
<div class="modal fade" id="add_news" tabindex="-1" aria-labelledby="add_news" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="add_news">เพิ่มข่าวสาร</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        

      <form action=add_news_verify.php method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="news_title" class="form-label">หัวข้อข่าว</label>
            <input type="text" class="form-control" name="news_title" id="news_title" aria-describedby="หัวข้อข่าว">
        </div>
        <div class="mb-3">
            <label for="news_detail" class="form-label">รายละเอียดข่าว</label>
            <textarea class="form-control" name="news_detail" id="news_detail"></textarea>
        </div>
        <div class="mb-3">
            <label for="news_img" class="form-label">ภาพข่าว</label>
            <input class="form-control" type="file" name="news_img" id="news_img">
        </div>
        <div class="mb-3">
            <label for="news_type" class="form-label">ประเภทข่าว</label>
            <select class="form-select" name="news_type" id="news_type" aria-label="Default select example">
                <option selected>เลือกประเภทข่าว</option>

                <?php
                    $sql_type = "SELECT * FROM news_type";
                    $stmt_type = $conn->prepare($sql_type);
                    $stmt_type->execute();
                    $result_type = $stmt_type->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result_type as $row_type) {
                        echo '<option value="'.$row_type["news_type_id"].'">'
                                .$row_type["news_type_name"].'</option>';
                    }
                ?>


            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary">เพิ่มข่าว</button>
      </div>
      </form>
    </div>
  </div>
</div>