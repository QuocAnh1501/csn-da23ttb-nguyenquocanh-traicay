<?php
$servername = "localhost";
$username = "root"; // mặc định XAMPP
$password = ""; // để trống
$dbname = "traicay_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>