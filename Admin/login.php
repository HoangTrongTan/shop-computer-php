<?php
    include_once("../class/database.class.php");
    $db = new Database();
    if(!isset($_SESSION)){
        session_start();
    }
    // if(isset($_SESSION['user'])){
    //     header("Location: index.php");
    // }
    if(isset($_POST['btn_ok'])){
        $tendangnhap     = isset($_POST['tendangnhap']) ? $_POST['tendangnhap'] : "";
        $matkhau = isset($_POST['matkhau']) ? $_POST['matkhau'] : "";


        $sql = "SELECT * FROM `taikhoan` WHERE tendangnhap='$tendangnhap' AND matkhau='$matkhau'";
        $result = $db->thucthi($sql);   
        $row = mysqli_fetch_array($result);
        $count = mysqli_num_rows($result);
        if($count>0){
            
            $_SESSION['user'] = $_POST['tendangnhap'];
            echo "<script>alert('Đăng nhập thành công !!')</script>";
            echo"<script> window.location.href='index.php';</script>";
            // header("Location: taikhoan.php");
        }else{
            echo "<script>alert('tài khoản và mật khẩu không hợp lệ')</script>"; 
        }
    }
    function kiemTraSo($chuoi){
        $check = 0;
        $array_chuoi = str_split($chuoi);
        for($i = 0 ; $i < strlen($chuoi) ; $i ++){
            if($array_chuoi[$i] >= 0 && $array_chuoi[$i] <= 9){
                $check = 1;
                // echo $array_chuoi[$i];
                break;
            }
        }
        return $check;
    } 
    if(isset($_POST['btn_register'])){
        $tendangnhap_resgister = isset($_POST['tendangnhap']) ? $_POST['tendangnhap'] : '';
        $matkhau_register = isset($_POST['matkhau']) ? $_POST['matkhau'] : '';
        $hoten_register = isset($_POST['hoten']) ? $_POST['hoten'] : '';
        $email_register = isset($_POST['Email']) ? $_POST['Email'] : '';

        if(strlen($tendangnhap_resgister) < 8 || KiemTraSo($tendangnhap_resgister) == 0){
            echo "<script>alert('tài khoản ít nhất 8 kí tự và có chữ số nhé cu')</script>";
        }else if(strlen($matkhau_register) < 8 || kiemTraSo($matkhau_register) == 0){
            echo "<script>alert('mật khẩu ít nhất 8 kí tự và có chữ số nữa nha :>')</script>";
        }else if(strlen($hoten_register) < 8){
            echo "<script>alert('Tên tài khoản ít cũng phải 8 kĩ tự nhớ !!')</script>";
        }else{
            $check = $db->thucthi("INSERT INTO `taikhoan` VALUES('$tendangnhap_resgister','$matkhau_register','$hoten_register','$email_register')");
        if($check == null){
            echo "<script>alert('lỗi')</script>";
        }else{
            echo "<script>alert('đăng kí thành công')</script>";
        }
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Đăng nhập admin</h1>
                                    </div>
                                    <form  method="post" >
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                name="tendangnhap" aria-describedby="emailHelp"
                                                placeholder="Tên đăng nhập...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="matkhau" placeholder="Password">
                                        </div>
                                       
                                        <button type="submit" class="bbtn btn-primary btn-user btn-block" name="btn_ok">Login</button>

                                        <hr>
                                    </form>

                                    <button type="submit" class="bbtn btn-primary btn-user btn-block" name="btn_ok" data-toggle="modal" data-target="#myModal">Register</button>
                                    <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form  method="post" >
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user"
                                                    name="tendangnhap" aria-describedby="emailHelp"
                                                    placeholder="Tên đăng nhập...">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                    name="matkhau" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user"
                                                    name="hoten" placeholder="Họ tên">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user"
                                                    name="Email" placeholder="Email">
                                            </div>
                                            <button type="submit" class="bbtn btn-primary btn-user btn-block" name="btn_register">Register</button>

                                            <hr>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                    <hr>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>