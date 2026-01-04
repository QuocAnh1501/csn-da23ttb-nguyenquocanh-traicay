<?php
session_start();
include "ketnoi.php";

// Lấy ID sản phẩm
$id = $_GET['id'];

// Lấy sản phẩm từ database
$sql = "SELECT * FROM products WHERE id = $id LIMIT 1";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if (!$product) {
    echo "Không tìm thấy sản phẩm";
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="bootstrap cdn/KT2/css/bootstrap.min.css">
</head>

<body class="container py-5">

<div class="row">
    <div class="col-md-5">
        <img src="<?php echo $product['image']; ?>" class="img-fluid rounded shadow">
    </div>

    <div class="col-md-7">
        <h2><?php echo $product['name']; ?></h2>

        <h4 class="text-danger fw-bold">
            <?php echo number_format($product['price']); ?> VNĐ/Kg
        </h4>
       <p><strong>Xuất xứ:</strong><?php echo $product['origin']; ?></p>
        <p><?php echo $product['description']; ?></p>

        <!-- QR xuất xứ nếu có -->
        <?php if (!empty($product['qr_link'])) { ?>
            <h5 class="mt-3">📌 QR thông tin xuất xứ:</h5>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?php echo urlencode($product['qr_link']); ?>" 
                 alt="QR Code" 
                 class="border p-2 rounded">
        <?php } ?>

        <div class="mt-3">
            <a href="themsanpham.php?id=<?php echo $id; ?>" class="btn btn-success btn-lg">
                🛒 Thêm vào giỏ
            </a>
            <a href="index.php" class="btn btn-secondary btn-lg">Quay lại</a>
        </div>
    </div>
</div>

</body>
</html>
