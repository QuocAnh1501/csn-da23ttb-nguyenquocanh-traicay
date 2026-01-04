<?php
session_start();
include "ketnoi.php";

if (!isset($_GET['id'])) {
    die("Không tìm thấy hóa đơn!");
}

$order_id = intval($_GET['id']);

// -------------------------------
// Lấy thông tin đơn hàng + khách hàng
// -------------------------------
$sql = "
SELECT 
    order_id,
    fullname,
    phone,
    address,
    payment_method,
    total_amount,
    order_date
FROM orders
WHERE order_id = $order_id
";


$order = $conn->query($sql)->fetch_assoc();

if (!$order) {
    die("Không tồn tại hóa đơn!");
}

// -------------------------------
// Lấy danh sách sản phẩm
// -------------------------------
$sql_items = "SELECT * FROM order_items WHERE order_id = $order_id";
$items = $conn->query($sql_items);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn</title>
    <link rel="stylesheet" href="bootstrap cdn/KT2/css/bootstrap.min.css">
</head>

<body class="container py-5">

<h2 class="text-center text-success mb-4">🧾 HÓA ĐƠN THANH TOÁN</h2>

<div class="card p-4 shadow">

    <h5 class="fw-bold">Thông tin khách hàng</h5>
    <p><b>Họ tên:</b> <?= $order['fullname'] ?></p>
    <p><b>Số điện thoại:</b> <?= $order['phone'] ?></p>
    <p><b>Địa chỉ:</b> <?= $order['address'] ?></p>
    <p><b>Phương thức thanh toán:</b> <?= $order['payment_method'] ?></p>

    <hr>

    <h5 class="fw-bold">Thông tin hóa đơn</h5>
    <p><b>Mã hóa đơn:</b> <?= $order_id ?></p>
    <p><b>Ngày thanh toán:</b> <?= $order['order_date'] ?></p>
    <p><b>Tổng tiền:</b> 
        <span class="text-danger fw-bold"><?= number_format($order['total_amount']) ?> VNĐ</span>
    </p>

    <hr>

    <h5 class="mb-3">Danh sách sản phẩm</h5>

    <table class="table table-bordered">
        <tr class="table-dark text-center">
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng</th>
        </tr>

        <?php while ($row = $items->fetch_assoc()) { ?>
            <tr class="text-center">
                <td><?= $row['product_name'] ?></td>
                <td><?= number_format($row['price']) ?> VNĐ</td>
                <td><?= $row['quantity'] ?></td>
                <td><?= number_format($row['price'] * $row['quantity']) ?> VNĐ</td>
            </tr>
        <?php } ?>
    </table>

    <div class="mt-4">
        <a href="lichsu.php" class="btn btn-primary">Xem lịch sử giao dịch</a>
        <a href="index.php" class="btn btn-secondary">Về trang chủ</a>
    </div>

</div>

</body>
</html>
