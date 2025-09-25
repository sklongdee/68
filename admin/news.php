<div class="container-fluid px-4">
    <h1 class="mt-4">จัดการข่าวสาร</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">จัดการข่าวสาร</li>
        </ol>
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
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>   
                        <?php
                            }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
</div> 
