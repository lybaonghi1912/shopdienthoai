<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['role']) || !in_array($_SESSION['role'], [1, 2])){
    header("Location: index.php");
    exit();
}

include_once("Controller/cSanPham.php");
include_once("Controller/cThuongHieu.php"); 
include_once("Controller/cUser.php"); 

// ================= NÚT XỬ LÝ SẢN PHẨM =================
if(isset($_POST['btnThemSP'])){
    $ten = $_POST['txtTenSP'];
    $giaGoc = $_POST['txtGiaGoc'];
    $giaBan = $_POST['txtGiaBan'];
    $maTH = $_POST['cboThuongHieu'];
    $file = $_FILES['fHinhAnh'];
    (new cSanPham())->themSanPham($ten, $giaGoc, $giaBan, $maTH, $file);
}
if(isset($_POST['btnSuaSP'])){
    $id = $_POST['txtMaSP'];
    $ten = $_POST['txtTenSP'];
    $giaGoc = $_POST['txtGiaGoc'];
    $giaBan = $_POST['txtGiaBan'];
    $maTH = $_POST['cboThuongHieu'];
    $file = $_FILES['fHinhAnh'];
    (new cSanPham())->suaSanPham($id, $ten, $giaGoc, $giaBan, $maTH, $file);
}

// ================= NÚT XỬ LÝ THƯƠNG HIỆU =================
if(isset($_POST['btnThemTH'])){
    $ten = $_POST['txtTenTH'];
    $diachi = $_POST['txtDiaChi'];
    $web = $_POST['txtWebsite'];
    $sdt = $_POST['txtSDT'];
    (new controlThuongHieu())->themThuongHieu($ten, $diachi, $web, $sdt);
}
if(isset($_POST['btnSuaTH'])){
    $id = $_POST['txtMaTH'];
    $ten = $_POST['txtTenTH'];
    $diachi = $_POST['txtDiaChi'];
    $web = $_POST['txtWebsite'];
    $sdt = $_POST['txtSDT'];
    (new controlThuongHieu())->suaThuongHieu($id, $ten, $diachi, $web, $sdt);
}

// ================= NÚT XỬ LÝ NGƯỜI DÙNG =================
if(isset($_POST['btnThemUser'])){
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
    $role = $_POST['cboRole'];
    (new cUser())->themUserAdmin($username, $password, $role);
}
if(isset($_POST['btnSuaUser'])){
    $id = $_POST['txtId'];
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
    $role = $_POST['cboRole'];
    (new cUser())->suaUser($id, $username, $password, $role, null);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Quản Trị - Shop Điện Thoại 247</title>
    <link rel="stylesheet" href="style/style.css">
    <style>
        .right table { width: 100%; border-collapse: collapse; margin-top: 20px; table-layout: fixed; }
        .right th { background-color: #f3e5f5; padding: 12px; border: 1px solid #dee2e6; color: #4a148c; }
        .right td { padding: 10px; border: 1px solid #dee2e6; vertical-align: middle; text-align: center; word-wrap: break-word; }
        .right h2 { color: #333; border-bottom: 2px solid #673ab7; padding-bottom: 10px; }
        
        .form-group { margin-bottom: 15px; }
        .form-label { font-weight: bold; display: block; margin-bottom: 5px; color: #333; }
        .form-control { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        .form-control:focus { border-color: #673ab7; outline: none; box-shadow: 0 0 5px rgba(103, 58, 183, 0.2); }

        .main { display: flex; align-items: flex-start; gap: 30px; width: 100%; }
        .right { flex: 1; min-width: 0; }
        .table-form { width: 100%; border-collapse: separate; border-spacing: 0 15px; text-align: left; }
        .table-form td { border: none; padding: 0; vertical-align: middle; }
        .table-form .label-col { width: 150px; font-weight: bold; font-size: 15px; color: #333; }

        /* TONE TRẮNG - TÍM CHO MENU */
        .left {
    width: 250px; flex-shrink: 0; border: 1px solid #eee; background: #fff;
    border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.left h3 {
    padding: 15px 20px; margin: 0; background: #fafafa;
    border-bottom: 1px solid #eee; border-left: 5px solid #673ab7;
    color: #333; text-transform: uppercase; font-weight: bold;
}

.menu-item, .dropdown-title {
    padding: 15px 20px;
    transition: 0.3s;
    display: block;
    text-decoration: none;
    color: #444;
    font-weight: bold;
    border-bottom: 1px solid #eee;
    cursor: pointer;
}

.menu-item:hover, .dropdown-title:hover { background: #f3e5f5; color: #673ab7; }
.menu-item.active { background: #673ab7; color: #fff; }

.dropdown-content {
    display: none;
    background-color: #fff;
    border-left: 3px solid #673ab7;
}
.dropdown-container:hover .dropdown-content {
    display: block;
    animation: slideDown 0.3s;
}

.sub-menu-item {
    display: block;
    padding: 12px 20px 12px 35px;
    text-decoration: none;
    color: #666;
    font-size: 14px;
    border-bottom: 1px solid #f9f9f9;
    position: relative;
}
.sub-menu-item::before {
    color: #673ab7;
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 16px;
}
.sub-menu-item:hover { color: #673ab7; background: #f3e5f5; }
.sub-menu-item.active { color: #673ab7; font-weight: bold; background: #fcf4ff; }

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-5px); }
    to { opacity: 1; transform: translateY(0); }
}

.btn-action {
    background: #4CAF50; color: white; padding: 10px 25px; border: none;
    border-radius: 5px; cursor: pointer; font-weight: bold; transition: 0.2s;
}
.btn-action:hover { background: #388E3C; box-shadow: 0 4px 10px rgba(76,175,80,0.3); }
    </style>
</head>
<body>
<div class="container">
    <div class="header"><img src="image/sanpham/banner.jpg" style="width:100%; height: 150px; object-fit: cover;"></div>
    
    <div class="top">
        <span>
            <a href="index.php">Xem trang chủ</a> | 
            Quyền: <b style="color: #673ab7;"><?php echo ($_SESSION['role'] == 1) ? "Quản trị viên" : "Nhân viên"; ?></b> (<?php echo $_SESSION['user']; ?>)
        </span>
        <span><a href="View/logout.php" style="color: #d32f2f; font-weight: bold;">Đăng xuất</a></span>
    </div>

    <div class="main">
        <div class="left">
            <h3>DANH MỤC</h3>
            
            <?php $act = $_GET['action'] ?? ''; ?>
            
            <div class="dropdown-container">
                <div class="dropdown-title">Quản lý Sản phẩm</div>
                <div class="dropdown-content">
                    <a href="admin.php?action=sanpham" class="sub-menu-item <?php echo ($act == 'sanpham') ? 'active' : ''; ?>">Xem DS Sản phẩm</a>
                    <a href="admin.php?action=add_sanpham" class="sub-menu-item <?php echo ($act == 'add_sanpham') ? 'active' : ''; ?>">Thêm Sản phẩm</a>
                </div>
            </div>

            <div class="dropdown-container">
                <div class="dropdown-title">Quản lý Thương hiệu</div>
                <div class="dropdown-content">
                    <a href="admin.php?action=thuonghieu" class="sub-menu-item <?php echo ($act == 'thuonghieu') ? 'active' : ''; ?>">Xem DS Thương hiệu</a>
                    <a href="admin.php?action=add_thuonghieu" class="sub-menu-item <?php echo ($act == 'add_thuonghieu') ? 'active' : ''; ?>">Thêm Thương hiệu</a>
                </div>
            </div>

            <?php if($_SESSION['role'] == 1): ?>
            <div class="dropdown-container">
                <div class="dropdown-title">Quản lý Người dùng</div>
                <div class="dropdown-content">
                    <a href="admin.php?action=user" class="sub-menu-item <?php echo ($act == 'user') ? 'active' : ''; ?>">Xem DS Người dùng</a>
                    <a href="admin.php?action=add_user" class="sub-menu-item <?php echo ($act == 'add_user') ? 'active' : ''; ?>">Thêm Người dùng</a>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="right">
            <?php
            switch($act){
                // ================== KHỐI SẢN PHẨM ==================
                case 'sanpham':
                    echo "<h2>Danh Sách Sản Phẩm</h2>";
                    (new cSanPham())->getAllSanPhamAdmin(); 
                    break;

                case 'add_sanpham':
                    ?>
                    <h2>Thêm Sản phẩm</h2>
                    <form action="" method="post" enctype="multipart/form-data" style="padding: 25px; background: #fff; border-radius: 8px; border: 1px solid #eee; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                        <table class="table-form">
                            <tr>
                                <td class="label-col">Tên Sản phẩm</td>
                                <td><input type="text" name="txtTenSP" class="form-control" style="width: 80%;" required></td>
                            </tr>
                            <tr>
                                <td class="label-col">Giá gốc</td>
                                <td>
                                    <input type="number" name="txtGiaGoc" class="form-control" style="width: 50%; display: inline-block;" required> 
                                    <span style="font-weight: bold; color: #555;">(VNĐ)</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-col">Giá bán</td>
                                <td>
                                    <input type="number" name="txtGiaBan" class="form-control" style="width: 50%; display: inline-block;" required> 
                                    <span style="font-weight: bold; color: #555;">(VNĐ)</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-col">Ảnh Sản phẩm</td>
                                <td><input type="file" name="fHinhAnh" class="form-control" style="width: 80%; background: #fafafa; border: 1px dashed #ccc;" required></td>
                            </tr>
                            <tr>
                                <td class="label-col">Thương hiệu</td>
                                <td>
                                    <select name="cboThuongHieu" class="form-control" style="width: auto;">
                                        <?php
                                        $th = (new controlThuongHieu())->getAllThuongHieu();
                                        while($rTH = mysqli_fetch_assoc($th)){
                                            echo "<option value='".$rTH['MaTH']."'>".$rTH['TenTH']."</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="padding-top: 15px;">
                                    <button type="submit" name="btnThemSP" class="btn-action">Thêm Sản Phẩm</button>
                                    <button type="reset" style="background: #f5f5f5; color: #555; border: 1px solid #ccc; padding: 10px 25px; border-radius: 5px; cursor: pointer; margin-left: 10px; font-weight: bold; transition: 0.2s;">Nhập lại</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php
                    break;

                case 'edit':
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $res = (new cSanPham())->getOneSanPham($id); 
                        if($res && mysqli_num_rows($res) > 0){
                            $row = mysqli_fetch_assoc($res);
                            ?>
                            <h2>Sửa Sản Phẩm: <span style="color: #673ab7;"><?php echo $row['TenSP']; ?></span></h2>
                            <form action="" method="post" enctype="multipart/form-data" style="padding: 20px; background: #fff; border-radius: 8px; border: 1px solid #eee; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                                <input type="hidden" name="txtMaSP" value="<?php echo $row['MaSP']; ?>">
                                <div class="form-group">
                                    <label class="form-label">Tên sản phẩm:</label>
                                    <input type="text" name="txtTenSP" class="form-control" value="<?php echo $row['TenSP']; ?>" required>
                                </div>
                                <div style="display: flex; gap: 20px;">
                                    <div class="form-group" style="flex: 1;">
                                        <label class="form-label">Giá Gốc (VNĐ):</label>
                                        <input type="number" name="txtGiaGoc" class="form-control" value="<?php echo $row['GiaGoc']; ?>" required>
                                    </div>
                                    <div class="form-group" style="flex: 1;">
                                        <label class="form-label">Giá Bán (VNĐ):</label>
                                        <input type="number" name="txtGiaBan" class="form-control" value="<?php echo $row['GiaBan']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Thương hiệu:</label>
                                    <select name="cboThuongHieu" class="form-control">
                                        <?php
                                        $th = (new controlThuongHieu())->getAllThuongHieu();
                                        while($rTH = mysqli_fetch_assoc($th)){
                                            $sel = ($rTH['MaTH'] == $row['MaTH']) ? "selected" : "";
                                            echo "<option value='".$rTH['MaTH']."' $sel>".$rTH['TenTH']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Hình ảnh hiện tại:</label>
                                    <?php $hinhAnh = !empty($row['HinhAnh']) ? $row['HinhAnh'] : 'no-image.png'; ?>
                                    <img src="image/sanpham/<?php echo $hinhAnh; ?>" width="100" style="border-radius: 5px; border: 1px solid #ddd; margin-bottom: 10px;"><br>
                                    <label class="form-label">Chọn ảnh mới (để trống nếu giữ ảnh cũ):</label>
                                    <input type="file" name="fHinhAnh" class="form-control" style="background: #fafafa;">
                                </div>
                                <button type="submit" name="btnSuaSP" class="btn-action" style="margin-top: 10px;">Lưu cập nhật</button>
                                <a href="admin.php?action=sanpham" style="margin-left: 15px; color: #d32f2f; text-decoration: none; font-weight: bold;">Hủy bỏ</a>
                            </form>
                            <?php
                        }
                    }
                    break;

                case 'delete':
                    if(isset($_GET['id'])) (new cSanPham())->xoaSanPham($_GET['id']);
                    break;

                // ================== KHỐI THƯƠNG HIỆU ==================
                case 'thuonghieu':
                    echo "<h2>Danh Sách Thương Hiệu</h2>";
                    (new controlThuongHieu())->getAllThuongHieuAdmin(); 
                    break;

                case 'add_thuonghieu':
                    ?>
                    <h2>Thêm Thương Hiệu</h2>
                    <form action="" method="post" style="padding: 25px; background: #fff; border-radius: 8px; border: 1px solid #eee; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                        <table class="table-form">
                            <tr>
                                <td class="label-col">Tên Thương hiệu</td>
                                <td><input type="text" name="txtTenTH" class="form-control" style="width: 80%;" required></td>
                            </tr>
                            <tr>
                                <td class="label-col">Địa chỉ</td>
                                <td><input type="text" name="txtDiaChi" class="form-control" style="width: 80%;"></td>
                            </tr>
                            <tr>
                                <td class="label-col">Website</td>
                                <td><input type="text" name="txtWebsite" class="form-control" style="width: 80%;"></td>
                            </tr>
                            <tr>
                                <td class="label-col">Số Điện thoại</td>
                                <td><input type="text" name="txtSDT" class="form-control" style="width: 50%;"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="padding-top: 15px;">
                                    <button type="submit" name="btnThemTH" class="btn-action">Thêm Thương Hiệu</button>
                                    <button type="reset" style="background: #f5f5f5; color: #555; border: 1px solid #ccc; padding: 10px 25px; border-radius: 5px; cursor: pointer; margin-left: 10px; font-weight: bold; transition: 0.2s;">Nhập lại</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php
                    break;

                case 'editTH':
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $res = (new controlThuongHieu())->getOneThuongHieu($id);
                        if($res && mysqli_num_rows($res) > 0){
                            $row = mysqli_fetch_assoc($res);
                            ?>
                            <h2>Sửa Thương Hiệu: <span style="color: #673ab7;"><?php echo $row['TenTH']; ?></span></h2>
                            <form action="" method="post" style="padding: 20px; background: #fff; border-radius: 8px; border: 1px solid #eee; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                                <input type="hidden" name="txtMaTH" value="<?php echo $row['MaTH']; ?>">
                                <div class="form-group">
                                    <label class="form-label">Tên Thương hiệu:</label>
                                    <input type="text" name="txtTenTH" class="form-control" value="<?php echo $row['TenTH']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Địa chỉ:</label>
                                    <input type="text" name="txtDiaChi" class="form-control" value="<?php echo $row['DiaChi']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Website:</label>
                                    <input type="text" name="txtWebsite" class="form-control" value="<?php echo $row['Website']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Số điện thoại:</label>
                                    <input type="text" name="txtSDT" class="form-control" value="<?php echo $row['SoDienThoai']; ?>">
                                </div>
                                <button type="submit" name="btnSuaTH" class="btn-action" style="margin-top: 10px;">Lưu cập nhật</button>
                                <a href="admin.php?action=thuonghieu" style="margin-left: 15px; color: #d32f2f; text-decoration: none; font-weight: bold;">Hủy bỏ</a>
                            </form>
                            <?php
                        }
                    }
                    break;
                
                case 'deleteTH':
                    if(isset($_GET['id'])) (new controlThuongHieu())->xoaThuongHieu($_GET['id']);
                    break;

                // ================== KHỐI NGƯỜI DÙNG ==================
                case 'user':
                    if($_SESSION['role'] == 1){
                        echo "<h2>Quản Lý Thành Viên</h2>";
                        (new cUser())->getAllUserAdmin(); 
                    }
                    break;

                case 'add_user':
                    if($_SESSION['role'] == 1){
                        ?>
                        <h2>Thêm Người Dùng Mới</h2>
                        <form action="" method="post" style="padding: 25px; background: #fff; border-radius: 8px; border: 1px solid #eee; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                            <table class="table-form">
                                <tr>
                                    <td class="label-col">Username</td>
                                    <td><input type="text" name="txtUsername" class="form-control" style="width: 80%;" required></td>
                                </tr>
                                <tr>
                                    <td class="label-col">Mật khẩu</td>
                                    <td><input type="text" name="txtPassword" class="form-control" style="width: 80%;" required></td>
                                </tr>
                                <tr>
                                    <td class="label-col">Phân quyền</td>
                                    <td>
                                        <select name="cboRole" class="form-control" style="width: auto;">
                                            <option value="0">Khách hàng (0)</option>
                                            <option value="2">Nhân viên (2)</option>
                                            <option value="1">Admin (1)</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="padding-top: 15px;">
                                        <button type="submit" name="btnThemUser" class="btn-action">Thêm Người Dùng</button>
                                        <button type="reset" style="background: #f5f5f5; color: #555; border: 1px solid #ccc; padding: 10px 25px; border-radius: 5px; cursor: pointer; margin-left: 10px; font-weight: bold; transition: 0.2s;">Nhập lại</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <?php
                    } else {
                        echo "<script>alert('Bạn không có quyền thực hiện chức năng này!'); window.location.href='admin.php';</script>";
                    }
                    break;

                case 'editUser':
                    if(isset($_GET['id']) && $_SESSION['role'] == 1){
                        $id = $_GET['id'];
                        $res = (new cUser())->getOneUser($id);
                        if($res && mysqli_num_rows($res) > 0){
                            $row = mysqli_fetch_assoc($res);
                            ?>
                            <h2>Sửa Thành Viên: <span style="color: #673ab7;"><?php echo $row['username']; ?></span></h2>
                            <form action="" method="post" style="padding: 20px; background: #fff; border-radius: 8px; border: 1px solid #eee; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                                <input type="hidden" name="txtId" value="<?php echo $row['id']; ?>">
                                <div class="form-group">
                                    <label class="form-label">Tên đăng nhập:</label>
                                    <input type="text" name="txtUsername" class="form-control" value="<?php echo $row['username']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Mật khẩu:</label>
                                    <input type="text" name="txtPassword" class="form-control" value="<?php echo $row['password']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phân quyền:</label>
                                    <select name="cboRole" class="form-control">
                                        <option value="0" <?php echo ($row['role'] == 0) ? 'selected' : ''; ?>>Khách hàng (0)</option>
                                        <option value="2" <?php echo ($row['role'] == 2) ? 'selected' : ''; ?>>Nhân viên (2)</option>
                                        <option value="1" <?php echo ($row['role'] == 1) ? 'selected' : ''; ?>>Admin (1)</option>
                                    </select>
                                </div>
                                <button type="submit" name="btnSuaUser" class="btn-action" style="margin-top: 10px;">Lưu cập nhật</button>
                                <a href="admin.php?action=user" style="margin-left: 15px; color: #d32f2f; text-decoration: none; font-weight: bold;">Hủy bỏ</a>
                            </form>
                            <?php
                        }
                    }
                    break;

                case 'deleteUser':
                    if(isset($_GET['id']) && $_SESSION['role'] == 1){
                        if($_GET['id'] != 1) { 
                            (new cUser())->xoaUser($_GET['id']);
                        } else {
                            echo "<script>alert('Không thể xóa tài khoản Admin gốc!'); window.location.href='admin.php?action=user';</script>";
                        }
                    }
                    break;

                default:
                    echo "<div style='text-align:center; padding:50px;'>
                            <h3 style='color: #673ab7; font-size: 24px; margin-bottom: 10px;'>Chào mừng quay trở lại, " . $_SESSION['user'] . "</h3>
                            <p style='color: #666;'>Vui lòng chọn chức năng quản lý ở menu bên trái.</p>
                          </div>";
                    break;
            }
            ?>
        </div>
    </div>
    <div class="footer" style="margin-top: 20px;">&copy; 2026 - NGHI Admin Dashboard</div>
</div>
</body>
</html>