<?php
session_start();
include "ketnoi.php";

// Nếu chưa đăng nhập → bắt đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: dangnhap.php");
    exit();
}

// Nếu giỏ hàng trống → không cho thanh toán
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<script>alert('Giỏ hàng trống! Không thể thanh toán'); window.location='giohang.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];
$total = 0;

// Lấy dữ liệu từ form
$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$payment_method = $_POST['payment_method'];

// Tính tổng tiền
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['qty'];
}

// ❗ LƯU THẲNG THÔNG TIN KHÁCH + THANH TOÁN VÀO BẢNG ORDERS
$sql_order = "
INSERT INTO orders (user_id, fullname, phone, address, payment_method, total_amount)
VALUES ($user_id, '$fullname', '$phone', '$address', '$payment_method', $total)
";
$conn->query($sql_order);

// Lấy ID đơn hàng vừa tạo
$order_id = $conn->insert_id;

// Lưu từng sản phẩm trong đơn hàng
foreach ($_SESSION['cart'] as $item) {
    $name = $item['name'];
    $price = $item['price'];
    $qty = $item['qty'];

    $sql_item = "
    INSERT INTO order_items (order_id, product_name, price, quantity)
    VALUES ($order_id, '$name', $price, $qty)
    ";
    $conn->query($sql_item);
}

// Xóa giỏ hàng sau thanh toán
unset($_SESSION['cart']);

echo "<script>alert('Thanh toán thành công!'); window.location='hoadon.php?id=$order_id';</script>";
?>
