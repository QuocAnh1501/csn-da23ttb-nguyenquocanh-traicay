<?php
session_start();
include "ketnoi.php";

// Nếu user đã đăng nhập → lấy thông tin
$fullname = "";
$phone = "";
$address = "";

if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];

    $sql = "SELECT fullname, phone, address FROM customers WHERE customer_id = $uid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $fullname = $user['fullname'];
        $phone = $user['phone'];
        $address = $user['address'];
    }
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Thông tin thanh toán</title>
<link rel="stylesheet" href="bootstrap cdn/KT2/css/bootstrap.min.css">

<style>
#qr-box {
    display: none;
    border: 1px solid #ddd;
    padding: 15px;
    margin-top: 15px;
    text-align: center;
    border-radius: 8px;
}
</style>

</head>

<body class="container py-5">

<h2 class="text-center text-primary mb-4">Thông tin khách hàng</h2>

<form action="thanhtoan.php" method="POST" class="card p-4 shadow">

    <label>Họ tên:</label>
    <input type="text" name="fullname"
           class="form-control mb-3"
           value="<?= $fullname ?>"
           required>

    <label>Số điện thoại:</label>
    <input type="text" name="phone"
           class="form-control mb-3"
           value="<?= $phone ?>"
           required>

    <label>Địa chỉ:</label>
    <textarea name="address" class="form-control mb-3" required><?= $address ?></textarea>

    <label>Phương thức thanh toán:</label>
    <select name="payment_method" class="form-control mb-3" id="payment">
        <option value="cod">Thanh toán khi nhận hàng (COD)</option>
        <option value="bank">Chuyển khoản ngân hàng</option>
    </select>

    <!-- form QR -->
    <div id="qr-box">
        <h5 class="text-danger">Quét mã QR để chuyển khoản</h5>
        <img src="images/qrthanhtoan.jpg" width="250">
        <p class="mt-2"><b>Nội dung:</b> Thanh toán đơn hàng</p>
    </div>

    <button type="submit" class="btn btn-success mt-3">Thanh toán</button>

</form>

<script>
// Khi chọn phương thức thanh toán
document.getElementById("payment").addEventListener("change", function () {
    let qrBox = document.getElementById("qr-box");

    if (this.value === "bank") {
        qrBox.style.display = "block";
    } else {
        qrBox.style.display = "none";
    }
});
</script>

</body>
</html>
