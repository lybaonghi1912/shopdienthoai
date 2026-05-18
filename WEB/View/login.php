<?php
session_start();
include_once("../Controller/cUser.php"); 

if(isset($_POST['login'])){
    $u = $_POST['username'];
    $p = $_POST['password'];
    $c = new cUser();
    $c->login($u, $p);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="container" style="width: 400px; margin: 50px auto; padding: 20px; text-align: center; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h3>ĐĂNG NHẬP</h3>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Username" required style="width: 80%; padding: 10px; margin: 10px 0; border: 1px solid #ccc;">
            <input type="password" name="password" placeholder="Password" required style="width: 80%; padding: 10px; margin: 10px 0; border: 1px solid #ccc;">
            <br>
            <button name="login" style="background: #ff5722; color: white; border: none; padding: 10px 30px; border-radius: 5px; cursor: pointer;">Đăng nhập</button>
        </form>
        <p><a href="../index.php" style="color: #673ab7; text-decoration: none;">Quay lại trang chủ</a></p>
    </div>
</body>
</html>