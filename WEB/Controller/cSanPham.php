<?php
include_once("Model/mSanPham.php");

class cSanPham {
    // 1. HIỂN THỊ TRANG CHỦ 
    public function getAllSanPham(){
        $m = new mSanPham();
        $result = $m->getAll();
        $this->displayGrid($result);
    }

    // 2. TÌM KIẾM SẢN PHẨM
    public function timKiem($keyword){
        $m = new mSanPham();
        $result = $m->timKiemSanPham($keyword);
        $this->displayGrid($result);
    }

    private function displayGrid($result){
        if($result && mysqli_num_rows($result) > 0){
    
            echo "<div class='product-grid'>"; 
            while($row = mysqli_fetch_assoc($result)){
                echo "
                <div class='product-card'>
                    <div class='product-img-box'>
                        <img src='image/sanpham/".$row['HinhAnh']."'>
                    </div>
                    <div class='product-info'>
                        <h4 class='product-name'>".$row['TenSP']."</h4>
                        <p class='product-price'>".number_format($row['GiaBan'], 0, ',', '.')."đ</p>
                        <button class='btn-buy'>Mua ngay</button>
                    </div>
                </div>";
            }
            echo "</div>";
        } else {
            echo "<p style='text-align:center; padding:50px;'>Không tìm thấy sản phẩm!</p>";
        }
    }
    // Bổ sung 
public function getSanPhamByBrand($brand_id){
    $m = new mSanPham();
    $result = $m->getByBrand($brand_id);
    $this->displayGrid($result);
}
    // admin.php
    public function getAllSanPhamAdmin(){
        $m = new mSanPham();
        $result = $m->getAll(); 
        if($result && mysqli_num_rows($result) > 0){
            echo "<table border='1' width='100%' style='border-collapse: collapse; text-align: center;'>";
            echo "<tr style='background: #f2f2f2; height: 40px;'>
                    <th>Mã SP</th>
                    <th>Hình ảnh</th>
                    <th>Tên SP</th>
                    <th>Giá Gốc</th>
                    <th>Giá Bán</th>
                    <th>Thương Hiệu</th>
                    <th>Thao tác</th>
                  </tr>";
            
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr style='height: 50px;'>";
                echo "<td>".$row['MaSP']."</td>";
                
                // Hiển thị hình ảnh sản phẩm, nếu không có thì để trống hoặc dùng ảnh mặc định
                $hinhAnh = !empty($row['HinhAnh']) ? $row['HinhAnh'] : 'no-image.png';
                echo "<td><img src='image/sanpham/".$hinhAnh."' width='50' height='50' style='object-fit: cover; border-radius: 5px;'></td>";
                
                echo "<td style='text-align: left; padding-left: 10px;'>".$row['TenSP']."</td>";
                echo "<td>".number_format($row['GiaGoc'], 0, ',', '.')."đ</td>";
                echo "<td><b style='color: red;'>".number_format($row['GiaBan'], 0, ',', '.')."đ</b></td>";
                echo "<td>".($row['TenTH'] ?? 'N/A')."</td>";
                echo "<td>
                        <a href='?action=edit&id=".$row['MaSP']."' class='btn-edit'>Sửa</a> | 
                        <a href='?action=delete&id=".$row['MaSP']."' class='btn-delete' onclick='return confirm(\"Xóa sản phẩm này?\")'>Xóa</a>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='text-align:center; padding: 20px;'>Chưa có dữ liệu sản phẩm.</p>";
        }
    }

    // 5. XỬ LÝ XÓA
    public function xoaSanPham($id){
        $m = new mSanPham();
        if($m->deleteSanPham($id)){
            echo "<script>alert('Đã xóa sản phẩm thành công!'); window.location.href='admin.php?action=sanpham';</script>";
        }
    }
    public function getOneSanPham($id){
    $m = new mSanPham();
    return $m->getOne($id);
}

public function suaSanPham($id, $ten, $giaGoc, $giaBan, $maTH, $file){
    $m = new mSanPham();
    $kq = false;

    if(!empty($file['name'])){ // Có chọn ảnh mới
        $hinh = time()."_".$file['name'];
        if(move_uploaded_file($file['tmp_name'], "image/sanpham/".$hinh)){
            $kq = $m->updateWithImg($id, $ten, $giaGoc, $giaBan, $maTH, $hinh);
        }
    } else { // Không chọn ảnh mới
        $kq = $m->updateNoImg($id, $ten, $giaGoc, $giaBan, $maTH);
    }
    
    if($kq){
        echo "<script>alert('Cập nhật sản phẩm thành công!'); window.location.href='admin.php?action=sanpham';</script>";
    } else {
        echo "<script>alert('Cập nhật thất bại!');</script>";
    }
}
// Hàm xử lý logic Thêm sản phẩm và Upload ảnh
    public function themSanPham($ten, $giaGoc, $giaBan, $maTH, $file){
        $m = new mSanPham();
        $hinh = "no-image.png"; // Ảnh mặc định nếu người dùng quên chọn file

        if(!empty($file['name'])){
            $hinh = time()."_".$file['name'];
            if(!move_uploaded_file($file['tmp_name'], "image/sanpham/".$hinh)){
                 echo "<script>alert('Lỗi upload ảnh! Vui lòng kiểm tra lại quyền thư mục.');</script>";
                 return;
            }
        }
        
        if($m->insertSanPham($ten, $giaGoc, $giaBan, $maTH, $hinh)){
            echo "<script>alert('Thêm sản phẩm thành công!'); window.location.href='admin.php?action=sanpham';</script>";
        } else {
            echo "<script>alert('Thêm sản phẩm thất bại!');</script>";
        }
    }
}
?>