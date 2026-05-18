<?php
include_once("../Controller/cUser.php"); 

if(isset($_POST['register'])){
    $u = $_POST['username'];
    $p = $_POST['password'];

    $c = new cUser();
    $c->register($u, $p);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký thành viên</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

<div class="container" style="width: 450px; margin: 60px auto; padding: 30px; text-align: center; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
    <h3 style="color: #333; margin-bottom: 25px;">ĐĂNG KÝ TÀI KHOẢN</h3>
    
    <form method="POST" action="register.php">
        <div style="margin-bottom: 15px;">
            <input type="text" name="username" placeholder="Tên đăng nhập" required 
                   style="width: 90%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; outline: none;">
        </div>
        
        <div style="margin-bottom: 20px;">
            <input type="password" name="password" placeholder="Mật khẩu" required 
                   style="width: 90%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; outline: none;">
        </div>
        
        <button name="register" type="submit" 
                style="width: 95%; padding: 12px; background: #ff5722; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s;">
            Đăng ký ngay
        </button>
    </form>

    <hr style="border: 0; border-top: 1px solid #eee; margin: 25px 0;">
    
    <p style="font-size: 14px; color: #666;">
        Đã có tài khoản? <a href="login.php" style="color: #ff5722; text-decoration: none; font-weight: bold;">Đăng nhập</a>
    </p>
    <p>
        <a href="../index.php" style="font-size: 14px; color: #888; text-decoration: none;">&larr; Quay lại trang chủ</a>
    </p>
</div>

</body>
</html>