<?php include_once("header.php");  
    $tendangnhap = isset($_GET['key'])? $_GET['key'] : '';
    $sql = "SELECT * FROM `taikhoan_user` WHERE taikhoan ='$tendangnhap'";
    $result = $db->thucthi($sql);
    $row = mysqli_fetch_array($result);
?>
<?php
    if(isset($_POST['add'])){
        $matkhau = isset($_POST['matkhau']) ? password_hash($_POST['matkhau'],PASSWORD_DEFAULT) : '';
        $hoten = isset($_POST['hoten']) ? $_POST['hoten'] : '';

        $str = "UPDATE `taikhoan_user` SET matkhau_user = '$matkhau',`tenkhachhang`='$hoten' WHERE `taikhoan`='$tendangnhap'";
        $kq = $db->thucthi($str);
        if(!$kq){
            echo "failds";
        }else{
            echo "successfull";
            echo"<script> window.location.href='taikhoan.php';</script>";
        }
    }
?>
<div class="container-fluid col-6">

        <form  method="post">
            <div class="form-group">
                <label for="email">Tài khoản:</label>
                <input disabled type="text" value="<?php echo $row['taikhoan'] ?>" class="form-control" name = "tendangnhap">
            </div>
            
            <div class="form-group">
                <label for="pwd">mật khẩu:</label>
                <input type="password" placeholder="mật khẩu"  value="<?php echo $row['matkhau_user'] ?>"  class="form-control" name = "matkhau">
            </div>
            <div class="form-group">
                <label for="pwd">tên tài khoản:</label>
                <input type="text" placeholder="tên tài khoản"  value="<?php echo $row['tenkhachhang'] ?>"  class="form-control" name = "hoten">
            </div>
            <button type="submit"  class="btn btn-primary" name="add"><i class="fa fa-check" aria-hidden="true"></i>Sửa</button>
        </form>
    </div>
    <?php include_once("footer.php");  ?>