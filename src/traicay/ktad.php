<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Bạn không có quyền truy cập trang admin!'); 
    window.location='traicay/index.php';</script>";
    exit();
}
?>
