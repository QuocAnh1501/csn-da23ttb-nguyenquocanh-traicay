<?php include "ketnoi.php"; session_start()?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký tài khoản</title>
    <link rel="stylesheet" href="bootstrap cdn/KT2/css/bootstrap.min.css">
</head>
<body class="container p-5">

<h2 class="text-center mb-4">Đăng ký tài khoản</h2>

<form method="POST">
    <input type="text" name="fullname" class="form-control mb-3" placeholder="Họ và tên" required>
    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-3" placeholder="Mật khẩu" required>
    <button type="submit" name="register" class="btn btn-success w-100">Đăng ký</button>
</form>

<p class="mt-3 text-center">Đã có tài khoản? <a href="dangnhap.php">Đăng nhập</a></p>

<?php
if(isset($_POST['register'])){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(fullname, email, password) VALUES('$fullname', '$email', '$password')";

    if($conn->query($sql) === TRUE){
        echo "<script>alert('Đăng ký thành công'); window.location='dangnhap.php';</script>";
    } else {
        echo "<script>alert('Email đã tồn tại');</script>";
    }
}
?>

</body>
</html>


