<?php
session_start();

// Tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Nếu chưa đăng nhập → không xóa session cart
if (!isset($_SESSION['user'])) {
    header("Location: dangnhap.php");
    exit();
}

// Xóa sản phẩm trong giỏ hàng
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: giohang.php");
}

// Cập nhật số lượng
if (isset($_POST['update_qty'])) {
    $id = $_POST['product_id'];
    $qty = $_POST['qty'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] = $qty;
    }

    header("Location: giohang.php");
}

// Tổng tiền
function tongTien() {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['qty'] * $item['price'];
    }
    return $total;
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="bootstrap cdn/KT2/css/bootstrap.min.css">
</head>

<body class="bg-light">
 <div class="container-fluid p-5 my-2 bg-dark text-white text-center">
            <img src="images/logotraicay.png" alt="Logo website" width="100">
            <h1>Chào mừng đến với website bán trái cây của chúng tôi</h1>
            <p>Cam kết đem đến chất lượng tuyệt vời cho khách hàng!</p>
        </div>
    <!--end header-->
    <!--bắt đầu navs(thanh menu)-->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
    <div class="container justify-content-end">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="index.php">Trang chủ</a>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="giohang.php">Giỏ hàng</a>
            </li>
             <li class="nav-item">
                    <a class="nav-link" href="lichsu.php">Lịch sử</a>
                </li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                <li class="nav-item">
                    <a class="nav-link text-info fw-bold" href="admin/index.php">🛠 Quản trị</a>
                </li>
            <?php } ?>
<!--code xử lý bắt buộc đăng nhập khi vào-->
            <?php if(isset($_SESSION['user'])) { ?>
                <li class="nav-item">
                    <span class="nav-link text-warning">Xin chào, <?php echo $_SESSION['user']; ?>!</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="dangxuat.php">Đăng xuất</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="dangnhap.php">Đăng nhập</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dangky.php">Đăng ký</a>
                </li>
            <?php } ?>

        </ul>
    </div>
</nav>
<div class="container py-5">
    <h2 class="text-center mb-4 text-success">🛒 Giỏ hàng của bạn</h2>

    <!-- Nếu giỏ hàng rỗng -->
    <?php if (empty($_SESSION['cart'])) { ?>
        <div class="alert alert-warning text-center">
            Giỏ hàng đang trống 😢<br>
            <a href="index.php" class="btn btn-success mt-3">Quay lại mua hàng</a>
        </div>

    <?php } else { ?>

        <div class="table-responsive shadow-sm">
            <table class="table table-bordered table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th>Xóa</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($_SESSION['cart'] as $id => $item) { ?>
                        <tr class="align-middle text-center">
                            <td><img src="<?= $item['img'] ?>" width="90"></td>
                            <td><?= $item['name'] ?></td>
                            <td class="text-danger fw-bold"><?= number_format($item['price']) ?> VNĐ</td>

                            <td>
                                <form method="POST" class="d-flex justify-content-center">
                                    <input type="hidden" name="product_id" value="<?= $id ?>">
                                    <input type="number" name="qty" value="<?= $item['qty'] ?>" min="1"
                                           class="form-control w-50 text-center">
                                    <button name="update_qty" class="btn btn-primary ms-2">Lưu</button>
                                </form>
                            </td>

                            <td class="text-success fw-bold">
                                <?= number_format($item['qty'] * $item['price']) ?> VNĐ
                            </td>

                            <td>
                                <a href="giohang.php?remove=<?= $id ?>" class="btn btn-danger btn-sm">
                                    X
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Tổng tiền -->
        <div class="text-end mt-4">
            <h3 class="text-danger fw-bold">
                Tổng tiền: <?= number_format(tongTien()) ?> VNĐ
            </h3>
            <a href="thongtinthanhtoan.php" class="btn btn-success btn-lg mt-3">
                Tiến hành thanh toán
            </a>
        </div>

    <?php } ?>

</div>
<!-- FOOTER -->
<footer class="bg-dark text-white mt-5 pt-4 pb-2">
     <div class="container">

        <div class="row">

            <!-- Cột 1: Thông tin liên hệ -->
            <div class="col-md-4 mb-3">
                <h5 class="text-success">📞 Thông tin liên hệ</h5>
                <p>Hotline: <b>0382236877</b></p>
                <p>Email: <b>traicaynhapkhau@gmail.com</b></p>
                <p>Địa chỉ: 127, Võ Nguyên Giáp, phường Nguyệt Hóa, tỉnh Vĩnh Long. </p>
            </div>

            <!-- Cột 2: Giới thiệu -->
            <div class="col-md-4 mb-3">
                <h5 class="text-success">🍏 Về FreshFruit</h5>
                <p>
                    Chúng tôi chuyên cung cấp trái cây nhập khẩu chất lượng cao,
                    cam kết tươi – sạch – an toàn và giá tốt nhất thị trường.
                </p>
            </div>

            <!-- Cột 3: Mạng xã hội -->
            <div class="col-md-4 mb-3">
                <h5 class="text-success">🌐 Kết nối với chúng tôi</h5>
                
            </div>

        </div>

        <hr class="border-secondary">

        <!-- Bản quyền -->
        <div class="text-center">
            <p class="mb-0">
                © 2025 FreshFruit Shop. All rights reserved.
            </p>
        </div>

    </div>
</footer>
</body>
</html>
