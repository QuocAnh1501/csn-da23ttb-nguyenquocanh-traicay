<?php
session_start();
include '../ketnoi.php';

// Chỉ admin mới được xem
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Bạn không có quyền truy cập!");
}

// Lấy danh sách đơn hàng
$sql = "SELECT orders.*, users.fullname AS username
        FROM orders
        JOIN users ON orders.user_id = users.id
        ORDER BY order_id DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách hóa đơn</title>
    <link rel="stylesheet" href="../bootstrap cdn/KT2/css/bootstrap.min.css">
</head>
<body class="container mt-4">

<h2 class="mb-4 text-primary">Danh sách hóa đơn</h2>
<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                <li class="nav-item">
                    <a class="nav-link text-info fw-bold" href="index.php">🛠 Quản trị</a>
                </li>
            <?php } ?>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID Hóa Đơn</th>
            <th>Khách hàng</th>
            <th>Tổng tiền</th>
            <th>Ngày đặt</th>
            <th>Chi tiết</th>
        </tr>
    </thead>

    <tbody>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td class="text-danger fw-bold"><?php echo number_format($row['total_amount']); ?>đ</td>
            <td><?php echo $row['order_date']; ?></td>
            <td>
                <a href="chitiethoadon.php?id=<?php echo $row['order_id']; ?>" 
                   class="btn btn-sm btn-primary">
                   Xem
                </a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

</body>
</html>
