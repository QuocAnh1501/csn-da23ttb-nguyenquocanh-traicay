<?php
include '../ketnoi.php';

if (!isset($_GET['id'])) {
    die("Không tìm thấy hóa đơn!");
}

$order_id = intval($_GET['id']);

// Lấy thông tin hóa đơn
$sql_order = "
SELECT 
    order_id,
    order_date,
    total_amount,
    fullname,
    phone,
    address,
    payment_method
FROM orders
WHERE order_id = $order_id
";

$order = $conn->query($sql_order)->fetch_assoc();

if (!$order) {
    die("Không tìm thấy hóa đơn!");
}

// Lấy danh sách sản phẩm
$sql_items = "
SELECT 
    product_name,
    quantity,
    price
FROM order_items
WHERE order_id = $order_id
";
$items = $conn->query($sql_items);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Chi tiết hóa đơn</title>
<link rel="stylesheet" href="../bootstrap cdn/KT2/css/bootstrap.min.css">

<style>
.invoice-box {
    max-width: 900px;
    margin: auto;
    padding: 25px;
    border: 1px solid #eee;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.15);
}
.table th {
    background: #198754 !important;
    color: white;
}
.summary-box {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
}
</style>
</head>

<body class="bg-light py-5">

<div class="invoice-box">

    <h2 class="text-center text-success mb-4">🧾 CHI TIẾT HÓA ĐƠN</h2>

    <div class="mb-4">
        <h5 class="text-primary">Thông tin khách hàng</h5>
        <p><b>Họ tên:</b> <?= $order['fullname'] ?></p>
        <p><b>Số điện thoại:</b> <?= $order['phone'] ?></p>
        <p><b>Địa chỉ:</b> <?= $order['address'] ?></p>
        <p><b>Phương thức thanh toán:</b> <?= $order['payment_method'] ?></p>
    </div>

    <hr>

    <div class="mb-4">
        <h5 class="text-primary">Thông tin hóa đơn</h5>
        <p><b>Mã hóa đơn:</b> <?= $order_id ?></p>
        <p><b>Ngày tạo:</b> <?= $order['order_date'] ?></p>
        <p><b>Tổng tiền:</b> 
            <span class="text-danger fw-bold"><?= number_format($order['total_amount']) ?> VNĐ</span>
        </p>
    </div>

    <hr>

    <h5 class="text-primary mb-3">Danh sách sản phẩm</h5>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $items->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['product_name'] ?></td>
                <td><?= $row['quantity'] ?></td>
                <td><?= number_format($row['price']) ?> VNĐ</td>
                <td class="text-danger fw-bold">
                    <?= number_format($row['price'] * $row['quantity']) ?> VNĐ
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="summary-box mt-4">
        <h5 class="text-end">
            Tổng thanh toán: 
            <span class="text-danger fw-bold"><?= number_format($order['total_amount']) ?> VNĐ</span>
        </h5>
    </div>

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-secondary">⬅ Trang chủ</a>
     
    </div>

</div>

</body>
</html>
