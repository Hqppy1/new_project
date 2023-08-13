<?php
//mvc/index.php
// File index gốc của ứng dụng
// Url thêm mới sp:
// index.php?controller=product&action=create
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
// + Phân tích url:
$controller = isset($_GET['controller']) ?
	$_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] :
	'default';
// + Chuyển đổi controller thành tên class tương ứng
// product -> ProductController
$controller = ucfirst($controller); //Product
$controller .= "Controller"; //ProductController
// + Nhúng file controller:
// Quy tắc nhúng file: luôn tư duy là đứng từ file index
//gốc để nhúng
$controller_path = "controllers/$controller.php";
if (!file_exists($controller_path)) {
	die('Trang bạn tìm ko tồn tại');
}
require_once "$controller_path";
// + Tạo đối tượng từ class bên trong file controller
$obj = new $controller();
// + Dùng obj gọi phương thức lấy từ tham số action từ
// url
if (!method_exists($obj, $action)) {
	die("Ko tồn tại PT $action trong class $controller");
}
$obj->$action();
//index.php?controller=product&action=create
?>
