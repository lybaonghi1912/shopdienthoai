<?php
class connectDB {
    public function connect(){

        $conn = mysqli_connect(
            "sql305.infinityfree.com",   // host
            "if0_41585043",              // username
            "0916991173",          // password
            "if0_41585043_admin"          // database name (thường có prefix)
        );

        if(!$conn) {
            die("Kết nối thất bại: " . mysqli_connect_error());
        }

        mysqli_set_charset($conn, "utf8");
        return $conn;
    }
}
?>