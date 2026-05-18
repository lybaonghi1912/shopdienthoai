<?php
include_once("Controller/cThuongHieu.php");

$p = new controlThuongHieu();
$kq = $p->getAllThuongHieu();

if($kq){
    while($r = mysqli_fetch_assoc($kq)){
      
        echo "<a href='index.php?idTH=".$r["MaTH"]."#content' style='text-decoration:none; color:inherit;'>";
        echo "<div class='menu-item'>".$r["TenTH"]."</div>";
        echo "</a>";
    }
}
?>