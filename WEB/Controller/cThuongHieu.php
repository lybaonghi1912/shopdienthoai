<?php
include_once("Model/mThuongHieu.php");

class controlThuongHieu {
    
    public function getAllThuongHieu(){
        $p = new modelThuongHieu();
        return $p->selectAllThuongHieu();
    }

    public function getAllThuongHieuAdmin(){
        $p = new modelThuongHieu();
        $kq = $p->selectAllThuongHieu();
        
        if($kq && mysqli_num_rows($kq) > 0){
            echo "<table border='1' width='100%' style='border-collapse: collapse; text-align: center;'>";
            echo "<tr style='background: #f2f2f2; height: 40px;'>
                    <th>Mã TH</th>
                    <th>Tên TH</th>
                    <th>Địa chỉ</th>
                    <th>Website</th>
                    <th>Điện thoại</th>
                    <th>Thao tác</th>
                  </tr>";
            
            while($r = mysqli_fetch_assoc($kq)){
                echo "<tr style='height: 50px;'>";
                echo "<td>".$r['MaTH']."</td>";
                echo "<td><b>".$r['TenTH']."</b></td>";
                echo "<td style='text-align: left; padding: 10px;'>".($r['DiaChi'] ?? 'Chưa cập nhật')."</td>";
                echo "<td>".$r['Website']."</td>";
                echo "<td>".$r['SoDienThoai']."</td>";
                echo "<td>
                        <a href='?action=editTH&id=".$r['MaTH']."' class='btn-edit'>Sửa</a> | 
                        <a href='?action=deleteTH&id=".$r['MaTH']."' class='btn-delete' onclick='return confirm(\"Bạn có chắc muốn xóa thương hiệu này?\")'>Xóa</a>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Chưa có dữ liệu thương hiệu.";
        }
    }
    
    public function getOneThuongHieu($id){
        $p = new modelThuongHieu();
        return $p->selectOneThuongHieu($id);
    }

    public function themThuongHieu($ten, $diachi, $web, $sdt){
        $m = new modelThuongHieu();
        if($m->insertThuongHieu($ten, $diachi, $web, $sdt)){
            echo "<script>alert('Thêm thương hiệu thành công!'); window.location.href='admin.php?action=thuonghieu';</script>";
        } else {
            echo "<script>alert('Thêm thất bại!');</script>";
        }
    }

    public function suaThuongHieu($id, $ten, $diachi, $web, $sdt){
        $m = new modelThuongHieu();
        if($m->updateThuongHieu($id, $ten, $diachi, $web, $sdt)){
            echo "<script>alert('Cập nhật thương hiệu thành công!'); window.location.href='admin.php?action=thuonghieu';</script>";
        } else {
            echo "<script>alert('Cập nhật thất bại!');</script>";
        }
    }

    public function xoaThuongHieu($id){
        $m = new modelThuongHieu();
        if($m->deleteThuongHieu($id)){
            echo "<script>alert('Xóa thương hiệu thành công!'); window.location.href='admin.php?action=thuonghieu';</script>";
        } else {
            echo "<script>alert('Xóa thất bại! Vui lòng kiểm tra lại xem có sản phẩm nào đang dùng thương hiệu này không.');</script>";
        }
    }
}
?>