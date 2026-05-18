<?php
include_once("mConnect.php"); // Kết nối tới cơ sở dữ liệu qlbh

class modelUser {

    /**
     * Kiểm tra đăng nhập
     * Trả về mảng thông tin người dùng nếu thành công, ngược lại trả về false
     */
    public function checkLogin($u, $p){
        $db = new connectDB();
        $conn = $db->connect();

        // Truy vấn lấy toàn bộ thông tin user dựa trên username và password
        // SQL này bao gồm cả cột 'role' bạn vừa thêm trong phpMyAdmin
        $sql = "SELECT * FROM user WHERE username = '$u' AND password = '$p' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if($result && mysqli_num_rows($result) > 0){
            // Trả về mảng dữ liệu (id, username, password, role)
            return mysqli_fetch_assoc($result);
        }
        
        return false;
    }

    /**
     * Đăng ký tài khoản mới
     * Mặc định role sẽ là 0 (người dùng thường)
     */
    public function register($u, $p){
        $db = new connectDB();
        $conn = $db->connect();

        // Thêm user mới vào bảng, cột role sẽ nhận giá trị DEFAULT (thường là 0)
        $sql = "INSERT INTO user (username, password, role) VALUES ('$u', '$p', 0)";
        return mysqli_query($conn, $sql);
    }
    public function selectAllUser(){
    $db = new connectDB();
    $conn = $db->connect();
    // Lấy tất cả người dùng từ bảng user
    $sql = "SELECT * FROM user ORDER BY role DESC";
    return mysqli_query($conn, $sql);
}
// Lấy thông tin 1 user để sửa
public function selectOneUser($id){
    $db = new connectDB();
    $conn = $db->connect();
    $sql = "SELECT * FROM user WHERE id = $id";
    return mysqli_query($conn, $sql);
}

// Trường hợp 1: Sửa có cập nhật hình mới
public function updateUserWithImg($id, $username, $password, $role, $hinh){
    $db = new connectDB();
    $conn = $db->connect();
    $sql = "UPDATE user SET username='$username', password='$password', role=$role, hinh='$hinh' WHERE id=$id";
    return mysqli_query($conn, $sql);
}

// Trường hợp 2: Sửa KHÔNG cập nhật hình (giữ ảnh cũ)
public function updateUserNoImg($id, $username, $password, $role){
    $db = new connectDB();
    $conn = $db->connect();
    $sql = "UPDATE user SET username='$username', password='$password', role=$role WHERE id=$id";
    return mysqli_query($conn, $sql);
}

// Xóa user
public function deleteUser($id){
    $db = new connectDB();
    $conn = $db->connect();
    $sql = "DELETE FROM user WHERE id = $id";
    return mysqli_query($conn, $sql);
}
// Thêm người dùng từ trang Quản trị (Có chọn phân quyền)
    public function insertUserAdmin($username, $password, $role){
        $db = new connectDB();
        $conn = $db->connect();
        
        // Tránh lỗi SQL Injection cơ bản
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $role = intval($role);

        $sql = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', $role)";
        return mysqli_query($conn, $sql);
    }
}
?>