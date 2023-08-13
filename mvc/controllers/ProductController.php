<?php
require_once 'controllers/Controller.php';
require_once 'models/product.php';
// controller xử lý sp
class ProductController extends Controller {
    public function create(){

//      -   xử lí form :
//        debug
        echo'<pre>';
        print_r($_POST);
        echo '</pre>';
        if(isset($_POST['submit'])){
            $name=$_POST['name'];
            $price = $_POST['price'];
//            validate:
        if(empty($name)||empty($price)){
            $this->error='phải nhập tên và  giá ';
        }
        elseif(!is_numeric($price)){
            $this->error='giá phải là số';
        }
//         nếu ko  có lỗi thì xử lí lỗi logic chính
        if(empty($this->error)){
//            controller gọi model để insert vào csdl
        $product_model= new Product();
        $is_insert=$product_model->InsertData($name, $price);
        var_dump($is_insert);
        if($is_insert){
            $_SESSION['success']='thêm mới thành công';
            header('location:index.php?controller=product&action=index');
            exit();
        }
        }
        }






//        echo'  tạo mới sp';
//    - gọi view để hiển thị
//        +gán giá trị tương ứng cho tt cần thiết trong controller cha
        $this->page_title='trang thêm mới sp ';
        $this->content= $this->render('views/products/create.php');
//        var_dump($this->content);
//    - gọi layout để hiển thị các giá trị trên
        require_once 'views/layouts/main.php';

    }
    public function index(){
//        - controler gọi Model
        $product_Model= new Product();
        $products= $product_Model->getList();
//        echo'<pre>';
//        print_r($products);
//        echo'</pre>';
//       - controller  gọi view
        $this->page_title='trang danh sách sp';
        $this->content=$this->render('views/products/index.php',['products'=>$products]);
        require_once 'views/layouts/main.php';


    }
    public function update(){

    }
    public function delete(){
//    validate id
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])){
            $_SESSION['error']='tham số id ko hợp lệ';
            header('location:index.php?controller=product&action=index');
            exit();
        }
        $id = $_GET['id'];
//        controller gọi model
        $product_model=new Product();
        $is_delete=$product_model->deleteData($id);
        var_dump($is_delete);
        if($is_delete){
            $_SESSION['success']='xóa thành công';}
            else{
                $_SESSION['error']='xóa thất bại';

            }
            header('location:index.php?controller=product&action=index');
            exit();
        }

}


?>
