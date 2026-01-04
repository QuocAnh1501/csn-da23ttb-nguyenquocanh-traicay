<?php
session_start();
include "ketnoi.php";

// --------------------------
// Giữ lại giỏ hàng trước khi đăng nhập
// --------------------------
$cart_backup = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="bootstrap cdn/KT2/css/bootstrap.min.css">
</head>

<body class="container p-5">

<h2 class="text-center mb-4">Đăng nhập</h2>

<form method="POST">
    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-3" placeholder="Mật khẩu" required>
    <button type="submit" name="login" class="btn btn-primary w-100">Đăng nhập</button>
</form>

<p class="mt-3 text-center">Chưa có tài khoản? <a href="dangky.php">Đăng ký ngay</a></p>

<?php
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Lấy user theo email
    $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        echo "<script>alert('Email không tồn tại!');</script>";
    } else {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            // --------------------------
            // Khởi tạo lại SESSION USER
            // --------------------------
            $_SESSION['user'] = $user['fullname'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // ---------------------------------
            // KHÔI PHỤC GIỎ HÀNG CŨ
            // ---------------------------------
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (!empty($cart_backup)) {
                $_SESSION['cart'] = $cart_backup;
            }

            // Chuyển trang theo role
            if ($user['role'] == 'admin') {
                echo "<script>alert('Đăng nhập quản trị'); 
                window.location='admin/index.php';</script>";
            } else {
                echo "<script>alert('Đăng nhập thành công'); 
                window.location='index.php';</script>";
            }

        } else {
            echo "<script>alert('Sai mật khẩu!');</script>";
        }
    }
}
?>
</body>
</html>
