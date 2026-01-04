<?php
session_start();
include "../ketnoi.php";
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Bạn không có quyền truy cập!");
}


$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trang quản trị</title>
    <link rel="stylesheet" href="../bootstrap cdn/KT2/css/bootstrap.min.css">
</head>

<body class="container py-4">

<h2 class="text-center mb-4">👑 QUẢN LÝ SẢN PHẨM</h2>

<a href="adthemsanpham.php" class="btn btn-success mb-3">+ Thêm sản phẩm</a>
<a href="../index.php" class="btn btn-success mb-3">Trang chủ</a>
<a href="danhsachdonhang.php" class="btn btn-success mb-3"> 📄 Xem danh sách hóa đơn</a>
<table class="table table-bordered text-center">
    <tr class="table-dark">
        <th>ID</th>
        <th>Hình</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Xuất xứ</th>
        <th>Mô tả</th>
        <th>QR link</th>
        <th>Hành động</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><img src="../<?= $row['image'] ?>" width="80"></td>
        <td><?= $row['name'] ?></td>
        <td><?= number_format($row['price']) ?> VNĐ</td>
        <td><?= $row['origin'] ?></td>
        <td><?= $row['description'] ?></td>
        <td><?= $row['qr_link'] ?></td>
        <td>
            <a href="adsuasanpham.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Sửa</a>
            <a href="adxoasanpham.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa sản phẩm?')">Xóa</a>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>
