<?php
// Mật khẩu mà bạn muốn đặt cho admin mới
$plain_password = "123456"; 

// Hàm password_hash() tạo ra chuỗi băm an toàn
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

echo "Mật khẩu băm (HASH) của bạn là: <br>";
echo $hashed_password;
?>