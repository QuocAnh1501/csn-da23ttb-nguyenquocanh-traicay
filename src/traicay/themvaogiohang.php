<?php
session_start();
include "ketnoi.php";

// Nếu chưa đăng nhập → bắt đăng nhập
if (!isset($_SESSION['user'])) {
    header("Location: dangnhap.php");
    exit();
}

// Lấy ID sản phẩm từ form
$id = $_POST['id'];

// Lấy thông tin sản phẩm từ database
$sql = "SELECT * FROM products WHERE id = $id LIMIT 1";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if (!$product) {
    die("Sản phẩm không tồn tại!");
}

// Nếu giỏ hàng chưa tồn tại → tạo mới
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Nếu sản phẩm đã tồn tại trong giỏ → tăng số lượng
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['qty'] += 1;
} else {
    // Nếu chưa có thì thêm mới
    $_SESSION['cart'][$id] = [
        'name'  => $product['name'],
        'price' => $product['price'],
        'img'   => $product['image'],
        'qty'   => 1
    ];
}

// Quay về giỏ hàng
header("Location: giohang.php");
exit();
?>
