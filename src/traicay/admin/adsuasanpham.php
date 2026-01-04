<?php
session_start();
include "../ketnoi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Bạn không có quyền!");
}

// Lấy ID sản phẩm
$id = $_GET['id'];

// Lấy dữ liệu sản phẩm
$result = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetch_assoc();

if (!$product) die("Sản phẩm không tồn tại!");

// Khi nhấn nút cập nhật
if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $origin = $_POST['origin'];
    $description = $_POST['description'];
    $qr_link = $_POST['qr_link'];

    // Xử lý ảnh
    if (!empty($_FILES['image']['name'])) {
        $imageName = $_FILES['image']['name'];
        $targetPath = "../images/" . $imageName;

        move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);

        $imageDB = "images/" . $imageName;
    } else {
        $imageDB = $product['image']; // giữ ảnh cũ
    }

    // CẬP NHẬT DỮ LIỆU — đã sửa lỗi thiếu dấu phẩy!
    $sql = "UPDATE products SET 
                name='$name',
                price='$price',
                image='$imageDB',
                origin='$origin',
                description='$description',
                qr_link='$qr_link'
            WHERE id=$id";

    $conn->query($sql);

    echo "<script>alert('Cập nhật thành công!'); window.location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="../bootstrap cdn/KT2/css/bootstrap.min.css">
</head>
<body class="container p-4">

<h3 class="mb-3">Sửa sản phẩm</h3>

<form method="POST" enctype="multipart/form-data">

    Tên sản phẩm:
    <input type="text" name="name" class="form-control mb-2" 
           value="<?= $product['name'] ?>" required>

    Giá:
    <input type="number" name="price" class="form-control mb-2" 
           value="<?= $product['price'] ?>" required>

    Ảnh hiện tại:<br>
    <img src="../<?= $product['image'] ?>" width="120" class="mb-2"><br>

    Chọn ảnh mới:
    <input type="file" name="image" class="form-control mb-2">

    Xuất xứ:
    <input type="text" name="origin" class="form-control mb-2" 
           value="<?= $product['origin'] ?>" required>

    Mô tả:
    <textarea name="description" class="form-control mb-2" required><?= $product['description'] ?></textarea>

    <!-- Ô nhập QR đã sửa: có value -->
    <div class="mb-3">
        <label>Link thông tin xuất xứ (QR):</label>
        <input type="text" name="qr_link" class="form-control" 
               value="<?= $product['qr_link'] ?>"
               placeholder="Nhập link nguồn để tạo mã QR">
    </div>

    <button class="btn btn-primary" name="update">Cập nhật</button>
</form>

</body>
</html>
