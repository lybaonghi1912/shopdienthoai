<div class="product-container">
<?php
if(mysqli_num_rows($tbl) > 0){
    while($row = mysqli_fetch_assoc($tbl)){
?>
    <div class="product">
        <img src="img/<?php echo $row['HinhAnh']; ?>">
        <h4><?php echo $row['TenSP']; ?></h4>

        <p class="price">
            <?php echo number_format($row['Gia'])." VND"; ?>
        </p>

        <?php if(!empty($row['GiaCu'])){ ?>
            <p class="old-price">
                <?php echo number_format($row['GiaCu'])." VND"; ?>
            </p>
        <?php } ?>

    </div>
<?php
    }
} else {
    echo "Không có sản phẩm";
}
?>
</div>