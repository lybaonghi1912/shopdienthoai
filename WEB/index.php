<?php
session_start();
include_once("Controller/cSanPham.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Shop Điện Thoại</title>
    <link rel="stylesheet" href="style/style.css?v=<?php echo time(); ?>">

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="header">
        <img src="image/sanpham/banner.jpg" alt="Banner">
    </div>
    <div class="notice-banner">
    ⚠️ <strong>Thông báo:</strong> Website này chỉ phục vụ mục đích học tập và nghiên cứu - Không có giá trị mua bán thực tế.
        </div>
    <div class="top">
        <span>
            <a href="index.php">Trang chủ</a> | 
            <?php 
            if(isset($_SESSION['user'])){
                echo "Chào <b style='color: #4CAF50;'>".$_SESSION['user']."</b>";

                // ĐÃ FIX: Cho phép cả role 1 (Admin) và role 2 (Nhân viên) thấy nút Quản lý
                if(isset($_SESSION['role']) && in_array($_SESSION['role'], [1, 2])){
                    echo " | <a href='admin.php'>Quản lý</a>";
                }

                echo " | <a href='View/logout.php'>Thoát</a>";
            } else {
                echo "<a href='View/login.php'>Đăng nhập</a> | <a href='View/register.php'>Đăng ký</a>";
            }
            ?>
        </span>

        <form method="GET" action="index.php">
            <input type="text" name="keyword" placeholder="Tìm sản phẩm..." 
            value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
            <button type="submit">Tìm</button>
        </form>
    </div>

    <div class="main">
        <div class="left">
            <h3>Thương hiệu</h3>
            <?php include_once("View/thuonghieu.php"); ?>
        </div>

        <div class="right">
            <div class="content" id="content">
                <?php 
                $p = new cSanPham();

                if(isset($_GET['idTH'])){
                    $p->getSanPhamByBrand($_GET['idTH']);
                }
                elseif(isset($_GET['keyword'])){
                    $p->timKiem($_GET['keyword']);
                }
                else{
                    $p->getAllSanPham();
                } 
                ?>
            </div>
        </div>
    </div>

    <div class="footer"> &copy; 2026 - Thiết kế bởi Bảo Nghi </div>

</div>
</body>
</html>