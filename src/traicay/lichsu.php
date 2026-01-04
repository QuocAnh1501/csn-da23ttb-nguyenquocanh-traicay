<?php
session_start();
include "ketnoi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: dangnhap.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY order_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head lang="vi">
         <title>Lịch sử hóa đơn</title>
        <link rel="stylesheet" href="bootstrap cdn/KT2/css/bootstrap.min.css">
</head>

<body class="container py-5">
   
<h2 class="text-center text-primary mb-4">📜 Lịch sử giao dịch</h2>

<table class="table table-bordered shadow">
    <tr class="table-dark text-center">
        <th>Mã hóa đơn</th>
        <th>Ngày</th>
        <th>Tổng tiền</th>
        <th>Chi tiết</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr class="text-center">
            <td><?= $row['order_id'] ?></td>
            <td><?= $row['order_date'] ?></td>
            <td class="text-danger"><?= number_format($row['total_amount']) ?> VNĐ</td>
            <td>
                <a href="hoadon.php?id=<?= $row['order_id'] ?>" class="btn btn-info">Xem</a>
            </td>
        </tr>
    <?php } ?>
</table>
 <a href="index.php" class="btn btn-primary mt-3">Quay về trang chủ</a>
</body>
</html>
