<?php
include_once("mConnect.php");

class mSanPham {
    public function getAll(){
        $db = new connectDB();
        $conn = $db->connect();
        
        $sql = "SELECT sp.*, th.TenTH FROM sanpham sp JOIN thuonghieu th ON sp.MaTH = th.MaTH";
        return mysqli_query($conn, $sql);
    }

    public function deleteSanPham($id){
        $db = new connectDB();
        $conn = $db->connect();
        $sql = "DELETE FROM sanpham WHERE MaSP = $id";
        return mysqli_query($conn, $sql);
    }
    public function timKiemSanPham($keyword){
    $db = new connectDB();
    $conn = $db->connect();
    $sql = "SELECT sp.*, th.TenTH FROM sanpham sp 
            JOIN thuonghieu th ON sp.MaTH = th.MaTH 
            WHERE sp.TenSP LIKE '%$keyword%'";
    return mysqli_query($conn, $sql);
}
public function getByBrand($brand_id){
    $db = new connectDB();
    $conn = $db->connect();

    $brand_id = intval($brand_id);

    $sql = "SELECT sp.*, th.TenTH 
            FROM sanpham sp 
            JOIN thuonghieu th ON sp.MaTH = th.MaTH
            WHERE sp.MaTH = $brand_id";

    return mysqli_query($conn, $sql);
}
// Lấy 1 sản phẩm để đổ vào form sửa
public function getOne($id){
    $db = new connectDB();
    $conn = $db->connect();
    $sql = "SELECT * FROM sanpham WHERE MaSP = $id";
    return mysqli_query($conn, $sql);
}

// Trường hợp 1: Cập nhật có kèm ảnh mới
public function updateWithImg($id, $ten, $giaGoc, $giaBan, $maTH, $hinh){
    $db = new connectDB();
    $conn = $db->connect();
    $sql = "UPDATE sanpham SET TenSP='$ten', GiaGoc=$giaGoc, GiaBan=$giaBan, MaTH=$maTH, HinhAnh='$hinh' WHERE MaSP=$id";
    return mysqli_query($conn, $sql);
}

// Trường hợp 2: Cập nhật giữ nguyên ảnh cũ
public function updateNoImg($id, $ten, $giaGoc, $giaBan, $maTH){
    $db = new connectDB();
    $conn = $db->connect();
    $sql = "UPDATE sanpham SET TenSP='$ten', GiaGoc=$giaGoc, GiaBan=$giaBan, MaTH=$maTH WHERE MaSP=$id";
    return mysqli_query($conn, $sql);
}
// Hàm thêm sản phẩm mới vào CSDL
    public function insertSanPham($ten, $giaGoc, $giaBan, $maTH, $hinh){
        $db = new connectDB();
        $conn = $db->connect();
        $sql = "INSERT INTO sanpham (TenSP, GiaGoc, GiaBan, MaTH, HinhAnh) VALUES ('$ten', $giaGoc, $giaBan, $maTH, '$hinh')";
        return mysqli_query($conn, $sql);
    }
}
?>