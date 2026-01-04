<?php
session_start();
include "../ketnoi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Bạn không có quyền!");
}

// Lấy ID từ URL
$id = $_GET['id'];

// Lấy thông tin sản phẩm để biết tên ảnh
$result = $conn->query("SELECT image FROM products WHERE id = $id");
$product = $result->fetch_assoc();

if ($product) {

    // Xóa ảnh trong thư mục (nếu có)
    $imagePath = "../" . $product['image']; // vd: ../images/apple.jpg

    if (file_exists($imagePath)) {
        unlink($imagePath); // Xóa file ảnh
    }

    // Xóa sản phẩm trong database
    $conn->query("DELETE FROM products WHERE id = $id");
}

echo "<script>alert('Xóa sản phẩm thành công'); window.location='index.php';</script>";
?>
