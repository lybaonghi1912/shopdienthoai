<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once(__DIR__ . "/../Model/mUser.php");

class cUser {
    // 1. XỬ LÝ ĐĂNG NHẬP
    public function login($u, $p){
        $m = new modelUser();
        $user = $m->checkLogin($u, $p);

        if($user){
            $_SESSION['user'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Nếu role là 1 (Admin) hoặc 2 (Nhân viên) thì vào trang quản trị
            if($user['role'] == 1 || $user['role'] == 2){
                header("Location: ../admin.php");
            } else {
                // Khách hàng (role = 0) về trang chủ
                header("Location: ../index.php");
            }
            exit();
        } else {
            echo "<script>alert('Tài khoản hoặc mật khẩu không chính xác!');</script>";
        }
    }

    // 2. XỬ LÝ ĐĂNG KÝ
    public function register($u, $p){
        $m = new modelUser();
        if($m->register($u, $p)){
            echo "<script>alert('Đăng ký thành công!'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Đăng ký thất bại!');</script>";
        }
    }
    // 3. HIỂN THỊ DANH SÁCH THÀNH VIÊN TRONG ADMIN
    public function getAllUserAdmin(){
        $m = new modelUser();
        $result = $m->selectAllUser(); 
        
        if($result && mysqli_num_rows($result) > 0){
            echo "<table border='1' width='100%' style='border-collapse: collapse; text-align: center;'>";
            // Đã xóa <th>Hình</th>
            echo "<tr><th>ID</th><th>Username</th><th>Quyền (Role)</th><th>Thao tác</th></tr>";
            while($row = mysqli_fetch_assoc($result)){
                $roleName = ($row['role'] == 1) ? "Admin" : (($row['role'] == 2) ? "Nhân viên" : "Khách hàng");
                
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                // Đã xóa <td> chứa thẻ <img>
                echo "<td>".$row['username']."</td>";
                echo "<td>".$roleName."</td>";
                echo "<td>
                        <a href='?action=editUser&id=".$row['id']."'>Sửa</a> | 
                        <a href='?action=deleteUser&id=".$row['id']."' onclick='return confirm(\"Bạn thật sự muốn xóa người dùng này?\")'>Xóa</a>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Chưa có dữ liệu thành viên.</p>";
        }
    }

    // 4. LẤY 1 NGƯỜI DÙNG ĐỂ ĐỔ VÀO FORM SỬA
    public function getOneUser($id){
        $m = new modelUser();
        return $m->selectOneUser($id);
    }

    // 5. XỬ LÝ CẬP NHẬT (CÓ VÀ KHÔNG CẬP NHẬT HÌNH)
    public function suaUser($id, $username, $password, $role, $file){
        $m = new modelUser();
        $kq = false;

        if(!empty($file['name'])){ // Trường hợp có chọn file mới
            // Đặt tên file theo thời gian để tránh trùng lặp
            $hinh = time()."_".$file['name'];
            if(move_uploaded_file($file['tmp_name'], "image/user/".$hinh)){
                $kq = $m->updateUserWithImg($id, $username, $password, $role, $hinh);
            }
        } else { // Trường hợp không cập nhật hình
            $kq = $m->updateUserNoImg($id, $username, $password, $role);
        }
        
        if($kq){
            echo "<script>alert('Cập nhật thành công!'); window.location.href='admin.php?action=user';</script>";
        } else {
            echo "<script>alert('Cập nhật thất bại!');</script>";
        }
    }

    // 6. XỬ LÝ XÓA VÀ THÔNG BÁO
    public function xoaUser($id){
        $m = new modelUser();
        if($m->deleteUser($id)){
            echo "<script>alert('Xóa thành công!'); window.location.href='admin.php?action=user';</script>";
        } else {
            echo "<script>alert('Xóa thất bại!');</script>";
        }
    }
    // XỬ LÝ THÊM NGƯỜI DÙNG (TỪ ADMIN)
    public function themUserAdmin($username, $password, $role){
        $m = new modelUser();
        if($m->insertUserAdmin($username, $password, $role)){
            echo "<script>alert('Thêm người dùng thành công!'); window.location.href='admin.php?action=user';</script>";
        } else {
            echo "<script>alert('Thêm thất bại! (Có thể tên đăng nhập đã tồn tại)');</script>";
        }
    }
}
?>