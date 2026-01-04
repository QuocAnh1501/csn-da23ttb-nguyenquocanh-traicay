<!--bắt đầu get started-->
<?php
include "ketnoi.php";
session_start();
// Lọc + tìm kiếm
$sql = "SELECT * FROM products WHERE 1";

// Tìm kiếm theo tên
if (!empty($_GET['search'])) {
    $keyword = $conn->real_escape_string($_GET['search']);
    $sql .= " AND name LIKE '%$keyword%'";
}

// Lọc theo giá
if (isset($_GET['price']) && $_GET['price'] != "") {
    $price = $_GET['price'];

    switch ($price) {
        case 1:
            $sql .= " AND price < 100000";
            break;
        case 2:
            $sql .= " AND price BETWEEN 100000 AND 200000";
            break;
        case 3:
            $sql .= " AND price BETWEEN 200000 AND 300000";
            break;
        case 4:
            $sql .= " AND price > 300000";
            break;
    }
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <title>Website bán trái cây nhập khẩu</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap cdn/KT2/css/bootstrap.min.css">
        <script src="bootstrap cdn/KT2/js/bootstrap.bundle.js"></script>

    </head>
<!--kết thúc get started-->
    <body>
    <!--bắt đầu header-->
       <div class="container-fluid py-4 my-2 bg-dark text-white text-center">
            <img src="images/logotraicay.png" alt="Logo website" width="100">
            <h1>Chào mừng đến với website bán trái cây của chúng tôi</h1>
            <p>Cam kết đem đến chất lượng tuyệt vời cho khách hàng!</p>
        </div>
    <!--end header-->

    <!--bắt đầu navs(thanh menu)-->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container justify-content-end ">
        <ul class="navbar-nav">
            <form class="d-flex align-items-center me-auto ms-3" method="GET" action="index.php">

    <!-- Ô tìm kiếm -->
    <input class="form-control me-2"
           type="search"
           name="search"
           placeholder="Tìm sản phẩm..."
           value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>"
           style="width:230px; height:45px;">

    <!-- Lọc theo giá -->
    <select name="price"
            class="form-select me-2"
            style="width:200px; height:45px;"
            onchange="this.form.submit()">
        <option value="">Lọc theo giá</option>
        <option value="1" <?= (isset($_GET['price']) && $_GET['price']==1) ? 'selected' : '' ?>>Dưới 100.000đ</option>
        <option value="2" <?= (isset($_GET['price']) && $_GET['price']==2) ? 'selected' : '' ?>>100.000đ - 200.000đ</option>
        <option value="3" <?= (isset($_GET['price']) && $_GET['price']==3) ? 'selected' : '' ?>>200.000đ - 300.000đ</option>
        <option value="4" <?= (isset($_GET['price']) && $_GET['price']==4) ? 'selected' : '' ?>>Trên 300.000đ</option>
    </select>

    <!-- Nút tìm -->
    <button class="btn btn-success" style="width:90px; height:45px;" type="submit">
        Tìm
    </button>

</form>
<!-- Hết lọc và tìm kiếm  -->
    <!-- Hết lọc giá -->
<!-- HẾT THANH TÌM KIẾM -->

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

    <!--end navs-->
    <!-- BANNER SLIDER ------------------------------------------------------------------->
<style>
.slider-container {
    width: 100%;
    max-width: 1300px;
    height: 380px;
    margin: 20px auto;
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.slider-wrapper {
    display: flex;
    height: 100%;
    transition: transform 0.6s ease;
}

.slider-slide {
    width: 100%;
    flex-shrink: 0;
}

.slider-slide img {
    width: 100%;
    height: 380px;
    object-fit: cover;
    border-radius: 15px;
}

.slider-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0,0,0,0.4);
    color: white;
    border: none;
    font-size: 28px;
    padding: 8px 15px;
    cursor: pointer;
    border-radius: 50%;
    transition: 0.3s;
}

.slider-btn:hover {
    background: rgba(0,0,0,0.7);
}

#prevBtn {
    left: 10px;
}

#nextBtn {
    right: 10px;
}

.dot-box {
    text-align: center;
    margin-top: 10px;
}

.dot {
    height: 12px;
    width: 12px;
    margin: 0 5px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    cursor: pointer;
}

.dot.active {
    background-color: #4285F4;
}
</style>

<div class="slider-container">
    <div class="slider-wrapper" id="sliderWrapper">

        <div class="slider-slide">
            <img src="images/banner4.jpg">
        </div>

        <div class="slider-slide">
            <img src="images/banner13.jpg">
        </div>

        <div class="slider-slide">
            <img src="images/banner5.jpg">
        </div>

    </div>

    <!-- Nút chuyển -->
    <button id="prevBtn" class="slider-btn">&#10094;</button>
    <button id="nextBtn" class="slider-btn">&#10095;</button>
</div>

<!-- Chấm chuyển slide -->
<div class="dot-box">
    <span class="dot" onclick="goToSlide(0)"></span>
    <span class="dot" onclick="goToSlide(1)"></span>
    <span class="dot" onclick="goToSlide(2)"></span>
</div>

<script>
let currentIndex = 0;
const sliderWrapper = document.getElementById("sliderWrapper");
const dots = document.querySelectorAll(".dot");
const totalSlides = 3;

function showSlide(index) {
    currentIndex = index;
    sliderWrapper.style.transform = "translateX(" + (-index * 100) + "%)";
    dots.forEach(dot => dot.classList.remove("active"));
    dots[index].classList.add("active");
}

document.getElementById("nextBtn").onclick = () => {
    currentIndex = (currentIndex + 1) % totalSlides;
    showSlide(currentIndex);
};

document.getElementById("prevBtn").onclick = () => {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    showSlide(currentIndex);
};

// Tự chạy slide 4 giây
setInterval(() => {
    currentIndex = (currentIndex + 1) % totalSlides;
    showSlide(currentIndex);
}, 4000);

function goToSlide(n) {
    showSlide(n);
}

// Khởi tạo slide đầu tiên
showSlide(0);
</script>
<!--Kết thúc banner--------------------------------------------------------------------->
    <!------------------bắt đầu content---------------------------------->
        <div class="container my-2">
            <h2 class="text-center mb-4">Những sản phẩm trái cây đang hot</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
            


<?php
// Không có sản phẩm
if ($result->num_rows === 0) {
    echo "<h4 class='text-center text-danger'>Không tìm thấy sản phẩm!</h4>";
}

// Có sản phẩm → hiển thị
while ($row = $result->fetch_assoc()) {
?>
    <div class="col">
        <div class="card h-100">
            <img src="<?= $row['image']; ?>" class="card-img-top" width="1450px" height="450px" style="object-fit:cover;">
            
            <div class="card-body">
                <h5 class="card-title"><?= $row['name']; ?></h5>
                <p class="card-text">Xuất xứ: <?= $row['origin']; ?></p>
                <p class="text-danger fw-bold"><?= number_format($row['price']); ?> VNĐ/kg</p>

                <!-- Nút xem chi tiết -->
                <a href="chitiet.php?id=<?= $row['id']; ?>" class="btn btn-primary">
                    Xem chi tiết
                </a>
            </div>
        </div>
    </div>
<?php
}
?>
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