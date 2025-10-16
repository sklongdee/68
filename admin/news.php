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
                            <td><a href="?id=news_detail&news_id=<?=$row_news["news_id"]?>"><?=$row_news["news_title"]?></a></td>
                            <td><?=$row_news["news_type_name"]?></td>
                            <td><?=$row_news["news_date"]?></td>
                            <td>
                                <?php
                                if($row_news["news_status"]==1){
                                    echo '<a class="text-decoration-none link-dark"
                                     href="update_status_verify.php?news_id='.$row_news["news_id"].'&status=0">
                                     เปิด</a>';
                                }else{
                                    echo '<a class="text-decoration-none link-dark"
                                     href="update_status_verify.php?news_id='.$row_news["news_id"].'&status=1">
                                     ปิด</a>';
                                }
                                ?> 
                            </td>
                            <td>
                                <a type="button" 
                                    data-bs-toggle="modal" data-bs-target="#editNewsModal"
                                    data-news_id="<?=$row_news["news_id"]?>"
                                    data-news_title="<?=$row_news["news_title"]?>"
                                    data-news_detail="<?=$row_news["news_detail"]?>"
                                    data-news_type="<?=$row_news["news_type"]?>"
                                    data-news_img="<?=$row_news["news_img"]?>"
                                >
                                    แก้ไข
                                </a>
                                <a class="text-decoration-none link-dark" href="delete_news.php?news_id=<?=$row_news["news_id"]?>&news_img=<?=$row_news["news_img"]?>">ลบ</a>
                            </td>
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
                    include_once "conn.php";
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


<!-- Modal แก้ไขข่าวสาร -->
<div class="modal fade" id="editNewsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="update_news_verify.php" method="POST" enctype="multipart/form-data" id="editNewsForm">
        <input type="hidden" name="news_id" id="modal_news_id">
        <div class="modal-header">
          <h5 class="modal-title">แก้ไขข่าว</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="modal_news_title" class="form-label">หัวข้อข่าว</label>
            <input type="text" class="form-control" name="news_title" id="modal_news_title">
          </div>
          <div class="mb-3">
            <label for="modal_news_detail" class="form-label">รายละเอียดข่าว</label>
            <textarea class="form-control" name="news_detail" id="modal_news_detail"></textarea>
          </div>
          <div class="mb-3">
            <label for="modal_news_img" class="form-label">ภาพข่าว (ถ้าไม่เปลี่ยนให้เว้นว่าง)</label>
            <input class="form-control" type="file" name="news_img" id="modal_news_img">
            <img src="" alt="ภาพข่าวเก่า" id="modal_news_img_preview" style="max-width: 150px; margin-top: 10px; display: none;">
          </div>
          <div class="mb-3">
            <label for="modal_news_type" class="form-label">ประเภทข่าว</label>
            <select class="form-select" name="news_type" id="modal_news_type">
                <option value="">เลือกประเภทข่าว</option>
                <?php
                    $sql_type = "SELECT * FROM news_type";
                    $stmt_type = $conn->prepare($sql_type);
                    $stmt_type->execute();
                    $result_type = $stmt_type->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result_type as $row_type) {
                        echo '<option value="'.$row_type["news_type_id"].'">'
                                .htmlspecialchars($row_type["news_type_name"]).'</option>';
                    }
                ?>
                </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
    const editNewsModal = document.getElementById('editNewsModal');
    editNewsModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget; // ปุ่มที่เปิด modal
    const newsId = button.getAttribute('data-news_id');
    const newsTitle = button.getAttribute('data-news_title');
    const newsDetail = button.getAttribute('data-news_detail');
    const newsType = button.getAttribute('data-news_type');
    const newsImg = button.getAttribute('data-news_img');

    // กำหนดค่าในฟอร์ม modal
    editNewsModal.querySelector('#modal_news_id').value = newsId;
    editNewsModal.querySelector('#modal_news_title').value = newsTitle;
    editNewsModal.querySelector('#modal_news_detail').value = newsDetail;
    editNewsModal.querySelector('#modal_news_type').value = newsType;

    // แสดงภาพเก่า ถ้ามี
    const imgPreview = editNewsModal.querySelector('#modal_news_img_preview');
    if (newsImg) {
        imgPreview.src = '../news/' + newsImg;
        imgPreview.style.display = 'block';
    } else {
        imgPreview.style.display = 'none';
    }

    // เคลียร์ input file
    editNewsModal.querySelector('#modal_news_img').value = '';
    });

</script>