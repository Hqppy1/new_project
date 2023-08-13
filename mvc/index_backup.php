<!--mvc/index.php
- File index gốc của ứng dụng MVC, tên file luôn luôn là
index.php, là file quan trọng nhất trong MVC
- File này là nơi đầu tiên bắt request từ user gửi lên
-> phân tích URL -> gọi đúng Controller tương ứng để xử
lý -> logic vận hành của MVC
- Trong MVC quy định url phải tuân theo 1 format nào đó
Với code MVC này, bắt buộc url phải có format sau:
+ Thêm mới
index.php?controller=product&action=create
+ Sửa sp:
index.php?controller=product&action=update&id=3
+ Tạo danh mục:
index.php?controller=category&action=create
- Tên class controller bắt buộc phải đặt tên theo chuẩn
mà mô hình quy định:
ProductController.php
CategoryController.php
SlideController.php
UserController.php
-->
<?php
session_start();
// Set múi giờ:
date_default_timezone_set('Asia/Ho_Chi_Minh');
echo date('d-m-Y H:i:s');

// - Phân tích URL, demo url thêm mới sp, bằng cách
// lấy ra tham số controller và action từ url
// index.php?controller=product&action=create
// Nếu là trang chủ, là trang ko truyền tham số nào thì
//sẽ gán 1 controller mặc định
$controller = isset($_GET['controller']) ?
	$_GET['controller'] : 'home'; //product
var_dump($controller);
// Lấy action: là tên phương thức trong class controller
$action = isset($_GET['action']) ? $_GET['action'] :
	'default';
var_dump($action); //create
// - Chuyển đổi controller lấy đc thành tên file tương
//ứng của class controller
// product -> ProductController
$controller = ucfirst($controller); //Product
$controller .= "Controller"; //ProductController
// - Nhúng file controller (gọi controller)
// + Quy tắc nhúng file trong MVC: luôn luôn phải tư duy
// đứng từ file index gốc để nhúng file
$controller_path = "controllers/$controller.php";
if (!file_exists($controller_path)) {
	die('Trang bạn tìm ko tồn tại');
}
require_once "$controller_path";
// - Khởi tạo đối tượng từ class controller vừa nhúng
$obj = new $controller();
// - Dùng obj truy cập phương thức lấy từ url để bắt đầu
//thực thi chức năng
if (!method_exists($obj, $action)) {
	die("Phương thức $action ko tồn tại trong
	 class $controller");
}
$obj->$action();
?>
