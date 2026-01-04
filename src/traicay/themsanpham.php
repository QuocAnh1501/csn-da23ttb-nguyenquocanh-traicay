<?php
session_start();
include "ketnoi.php";  // Kết nối CSDL

// Kiểm tra ID sản phẩm
if (!isset($_GET['id'])) {
    die("Không tìm thấy ID sản phẩm!");
}

$id = intval($_GET['id']);

// Nếu chưa có giỏ hàng → tạo
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Lấy sản phẩm từ database
$sql = "SELECT * FROM products WHERE id = $id LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Sản phẩm không tồn tại!");
}

$product = $result->fetch_assoc();

// Nếu sản phẩm đã có trong giỏ → tăng số lượng
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['qty'] += 1;

} else {
    // Nếu chưa có → thêm mới
    $_SESSION['cart'][$id] = [
        "name"  => $product['name'],
        "price" => $product['price'],
        "img"   => $product['image'],  // đúng tên cột trong DB
        "qty"   => 1
    ];
}

// Quay lại giỏ hàng
header("Location: giohang.php");
exit();
?>
