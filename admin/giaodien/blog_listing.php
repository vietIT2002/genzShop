<?php
    include_once("./connect_db.php");
    if (!empty($_SESSION['nguoidung'])) {
        $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
        $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;
        $totalRecords = mysqli_query($con, "SELECT * FROM `danhmucbaiviet`");
        $totalRecords = $totalRecords->num_rows;
        $totalPages = ceil($totalRecords / $item_per_page);
        $danhmucbv = mysqli_query($con, "SELECT * FROM `danhmucbaiviet` ORDER BY `id_danhmucbv` ASC LIMIT " . $item_per_page . " OFFSET " . $offset);

        mysqli_close($con);
    ?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/admin_style.css">
        <link rel="stylesheet" type="text/css" href="css/style_listProduct.css">
    </head>
    <body>
    <div class="main-content">
<br> 
            <h1>Danh mục bài viết</h1>
            <br> 
            <div class="buttons">
              
              <a href="admin.php?act=adddm">  <i class="fa fa-plus" aria-hidden="true" >  </i> Thêm mới</a>
          </div>
            <div class="product-items">
               
                <div class="table-responsive-sm ">
                    <table class="table table-bordered table-striped table-hover">
                        <thead >
                            <tr>

                                <th>Mã danh mục</th>
                                <th>Tên danh mục bài viết</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                            while ($row = mysqli_fetch_array($danhmucbv)) {
                            ?>
                                <tr>                      
                                    <td><center><?= $row['thutu'] ?><center></td>
                                    <td><?= $row['tendanhmucbv'] ?></td>
                                    <td><center><a class="btn btn-outline-success" href="admin.php?act=suadm&id_danhmucbv=<?= $row['id_danhmucbv'] ?>" > 
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a></center>
                                    </td>
                                    <td>
                                        <center>
                                            <a class="btn btn-outline-danger" href="admin.php?act=xoadm&id_danhmucbv=<?= $row['id_danhmucbv'] ?>" onclick="return confirm('Bạn có chắc muốn xóa danh mục bài viết này không?');">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                        </center>
                                    </td> 
                                     <div class="clear-both"></div>
                                </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
        include './pagination.php';
        ?>
        <div class="clear-both"></div>
        </div>
    <?php
    }
    ?>
    </body>
    </html>