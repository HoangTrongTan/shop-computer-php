<?php include_once("header.php");  ?>
<?php 
    if(isset($_POST['add'])){
        $tendangnhap = isset($_POST['tendangnhap']) ? $_POST['tendangnhap'] : "";
        $matkhau     = isset($_POST['matkhau']) ? $_POST['matkhau'] : "";
        $tentaikhoan = isset($_POST['tentaikhoan']) ? $_POST['tentaikhoan'] : "";

        $sql = "INSERT INTO `taikhoan` VALUES ('$tendangnhap','$matkhau ','$tentaikhoan','$email') ";
        $result = $db->thucthi($sql);

       echo "<script> window.location.href='taikhoan.php' </script>";
    }

?>
    <!-- Begin Page Content -->
    <div class="container-fluid col-6">

        <form  method="post" >
            <div class="form-group">
                <label for="email">Tài khoản:</label>
                <input type="text" placeholder="tài khoản" class="form-control" name = "tendangnhap">
            </div>
            <div class="form-group">
                <label for="pwd">mật khẩu:</label>
                <input type="password" placeholder="mật khẩu" class="form-control" name = "matkhau">
            </div>
            <div class="form-group">
                <label for="pwd">tên tài khoản:</label>
                <input type="text" placeholder="tên tài khoản" class="form-control" name = "tentaikhoan">
            </div>
            <div class="form-group">
                <label for="pwd">Email:</label>
                <input type="email" placeholder="Email" class="form-control" name = "email">
            </div>
            <button type="submit"  class="btn btn-primary" name="add"><i class="fa fa-check" aria-hidden="true"></i>chấp nhận</button>
        </form>
    </div>
    <!-- /.container-fluid -->

<?php include_once("footer.php");  ?>