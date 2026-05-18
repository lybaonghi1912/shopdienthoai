<?php
include_once("mConnect.php");

class modelThuongHieu {
    public function selectAllThuongHieu(){
        $p = new connectDB();
        $conn = $p->connect();
        $sql = "SELECT * FROM thuonghieu";
        return mysqli_query($conn,$sql);
    }
    
    public function selectOneThuongHieu($id){
        $p = new connectDB();
        $conn = $p->connect();
        $sql = "SELECT * FROM thuonghieu WHERE MaTH = $id";
        return mysqli_query($conn, $sql);
    }

    // Bổ sung: Thêm Thương Hiệu
    public function insertThuongHieu($ten, $diachi, $web, $sdt){
        $p = new connectDB();
        $conn = $p->connect();
        $sql = "INSERT INTO thuonghieu (TenTH, DiaChi, Website, SoDienThoai) VALUES ('$ten', '$diachi', '$web', '$sdt')";
        return mysqli_query($conn, $sql);
    }

    // Cập nhật Thương Hiệu
    public function updateThuongHieu($id, $ten, $diachi, $web, $sdt){
        $p = new connectDB();
        $conn = $p->connect();
        $sql = "UPDATE thuonghieu SET TenTH='$ten', DiaChi='$diachi', Website='$web', SoDienThoai='$sdt' WHERE MaTH=$id";
        return mysqli_query($conn, $sql);
    }
    
    // Bổ sung: Xóa Thương Hiệu
    public function deleteThuongHieu($id){
        $p = new connectDB();
        $conn = $p->connect();
        $sql = "DELETE FROM thuonghieu WHERE MaTH = $id";
        return mysqli_query($conn, $sql);
    }
}
?>