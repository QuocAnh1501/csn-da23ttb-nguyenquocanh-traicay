<?php
session_start();
include "../ketnoi.php";
if ($_SESSION['role'] != 'admin') die("Không có quyền!");



if (isset($_POST['add'])) {
    $name   = $_POST['name'];
    $price  = $_POST['price'];
    $origin = $_POST['origin'];
    $description  =$_POST['description']; 
    $qr_link = $_POST['qr_link'];
    $imageName = $_FILES['image']['name'];
    $targetPath = "../images/" . $imageName;  // lưu ảnh vào thư mục image

    move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);

    $imageDB = "images/" . $imageName; // Lưu đường dẫn vào DB

    

    $sql = "INSERT INTO products (name, price, image, origin, description, qr_link)
            VALUES ('$name', '$price', '$imageDB', '$origin', '$description', '$qr_link')";

    $conn->query($sql);
    echo "<script>alert('Thêm sản phẩm thành công'); window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Thêm sản phẩm</title>
<link rel="stylesheet" href="../bootstrap cdn/KT2/css/bootstrap.min.css">
</head>
<body class="container p-4">

<h3>Thêm sản phẩm mới</h3>

<form method="POST" enctype="multipart/form-data">
    Tên sản phẩm:
    <input type="text" name="name" class="form-control mb-2" required>

    Giá:
    <input type="number" name="price" class="form-control mb-2" required>
    Hình ảnh:
    <input type="file" name="image" class="form-control mb-2" required>

    Xuất xứ:
    <input type="text" name="origin" class="form-control mb-2" required>

    Mô tả:
    <input type="text" name="description" class="form-control mb-2" required>

    <div class="mb-3">
            <label>Link thông tin xuất xứ (QR):</label>
            <input type="text" name="qr_link" class="form-control" placeholder="Nhập link nguồn để tạo mã QR">
    </div>

    
    <button class="btn btn-success" name="add">Lưu</button>
     <a href="index.php" class="btn btn-secondary">⬅ Trang chủ</a>
</form>
   
</body>
</html>
