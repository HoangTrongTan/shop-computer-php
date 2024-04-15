<?php include_once("header_chitiet.php"); ?>
<?php 
    $str_giam='';
    $tien_change = 0;
    $result = $db->thucthi("SELECT * FROM `order`");
      $r_order = mysqli_fetch_array($result); 

      $masp = $r_order['masp'];
      $rs_sp = $db->thucthi("SELECT * FROM `sanpham` WHERE masp = $masp");
      $r_sp = mysqli_fetch_array($rs_sp);


    //----------------------xử lý cộng trừ --------------------
     $tongtien = 0; 
       $lien_array = $db->thucthi("SELECT * FROM `lienhe` WHERE taikhoan = '$taikhoan'");
       $kq_lienhe = mysqli_fetch_array($lien_array);
        if(isset($_POST['tru'])){
          if($r_order['soluong'] > 0){
            echo $gia = ($r_sp['dongia'] * ($r_order['soluong'] - 1));
            $db->thucthi("UPDATE `order` SET soluong = (soluong - 1), thanhtien = $gia");
            header("Location: hoadon.php");
          }
          
        
        }
        if(isset($_POST['cong'])){
          if($r_order['soluong'] < $r_sp['soluong'] )
          echo $gia = ($r_sp['dongia'] * ($r_order['soluong'] + 1));
          $db->thucthi("UPDATE `order` SET soluong = (soluong + 1),thanhtien = $gia"); 
          header("Location: hoadon.php");
        }
          //--------------------------------mã giảm giá--------------------------------------------------------
      if(isset($_POST['fffff'])){
         $tongtien1 = isset($_GET['money'])? $_GET['money']:'';
         $ma = $_POST['ma'];
        $magiam_ar = $db->thucthi("SELECT * FROM `magiamgia` WHERE magiam = '$ma'");
        if($magiam_ar){
          $r_magiam = mysqli_fetch_array($magiam_ar);
          if(isset($r_magiam['phantram'])){
            $str_giam = ' (bạn đc giảm '.$r_magiam['phantram'].' %)*'; 
            $tongtien1 = $tongtien1* ((100 - $r_magiam['phantram'])/100);
            $_SESSION['tongtien'] = $tongtien1;
          }
          
        }else{
          echo "<script>alert('mã sản phẩm không tồn tại')</script>";
        }
        
      }
?>
<div style="width:210px; height: 310px;" class="grid_1_of_4 images_1_of_4">
  <a  href="chitietSP.php?masp=<?php echo $r_order['masp']; ?>"><img style="width:160px; height:110px;" src="../../upload/<?php echo $r_order['anh'] ?>"  /></a>
  <h2 ><?php $ten = $r_order['tensp']; echo (strlen($ten) > 20) ? substr($ten,0,20).'...' : $ten;  ?></h2>
<div class="price-details">
  <form method="post"> 
    <h6><input type="submit" value=" - " name="tru">  <?php echo $r_order['soluong'];?>  <input type="submit" value=" + " name="cong"></h6>
  </form>
<h6><span class="rupees"> giá: <?php $tongtien += $r_order['thanhtien'];  $gia = $r_order['thanhtien']; echo number_format($gia); ?> $</h6>  
</div>       		
</div> 
    
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br>

  <?php  
  
    if(isset($_POST['dathang'])){ 
      $giohang = "";
      $masanpham = "";
      $soluong = "";
      $vv = $db->thucthi("SELECT * FROM `order`");
      
      $t = mysqli_fetch_array($vv);
        $giohang .= '('.$t['tensp'].' - '.$t['soluong'].' )';
        $masanpham .= '-'.$t['masp'];
        $soluong .= '-'.$t['soluong'];
      $thongtinkhachhang = $_POST['hoten'].'   -   '.$_POST['diachinhan'].'   -  '.$_POST['dienthoai'];

      date_default_timezone_set('Asia/Ho_Chi_Minh');
      $date = date('Y-m-d H:i:s');

      if($tongtien == 0){
        echo "<script>alert('đã mua đc cái gì mà đòi đặt hàng :((')</script>";
        echo "<script>window.location.href='index.php'</script>";
      }else{
        if(isset($_SESSION['tongtien'])){
          $tongtien = $_SESSION['tongtien'];
        }
        $check = $db->thucthi("INSERT INTO `dathang`(`thongtingiohang`, `tongtien`, `sanpham`,`ngaydat`, `masp`, `soluong`, `taikhoan_user`,`check`) VALUES ('$thongtinkhachhang','$tongtien','$giohang','$date','$masanpham','$soluong','$taikhoan',1)");
      
       //cập nhật số lượng
      $v = $db->thucthi("SELECT * FROM `order`");
      while($t = mysqli_fetch_assoc($v)){
        $masp = $t['masp'];
        $soluong = $t['soluong'];
        $db->thucthi("UPDATE `sanpham` SET `soluong`= ((SELECT soluong FROM `sanpham` WHERE masp = $masp) - $soluong) WHERE masp = $masp");
      }

      if(!$check){
        echo 'đặt hàng khoogn thành công';
      }else{
        $db->thucthi("DELETE FROM `order`");
        echo "<script>window.location.href='hangcho.php'</script>";
      }
      }
       
   }
   if(isset($_POST['huy'])){
    $db->thucthi("DELETE FROM `order`");
    echo "<script>window.location.href='index.php'</script>";
   }
 
  ?>
  <?php 
     
  ?>
  <br><br>
  <form method="post" action="hoadon.php?money=<?php echo $tongtien ?>">
    <div class="input-group mb-3 col-2">
    <input type="text" class="form-control" placeholder="mã giảm giá" name="ma">
    <div class="input-group-append">
      <button class="btn btn-success" type="submit" name="fffff">+</button>
    </div>
  </div>
  </form>
      
<form method="POST">
  
  <div class="form-group col-4">
    <br><label >Họ tên khách hàng:</label>
    <input type="text" value="<?php echo isset($kq_lienhe['hoten']) ? $kq_lienhe['hoten']: ''; ?>" class="form-control" placeholder="Nhập họ tên" name="hoten">
  </div>
  <div class="form-group col-4">
    <label >Địa chỉ nhận:</label>
    <input type="text" value="<?php echo isset($kq_lienhe['diachi']) ? $kq_lienhe['diachi'] :''; ?>" class="form-control" placeholder="Nhập họ tên" name="diachinhan">
  </div>
  <div class="form-group col-4">
    <label >Điện thoại</label>
    <input type="text" value="<?php echo isset($kq_lienhe['sdt']) ? $kq_lienhe['sdt'] : ''; ?>" class="form-control" placeholder="nhập điện thoại" name="dienthoai">
  </div>
    <label style="color:red">Tổng tiền: <?php $tongtien= isset($tongtien1)? $tongtien1:$tongtien; echo number_format($tongtien).'  $';  echo isset($str_giam) ? $str_giam: '';?></label><br>
    <button type="submit" class="btn btn-primary mb-2" name = "dathang">Đặt hàng</button>
    <button type="submit" class="btn btn-primary mb-2" name = "huy">X</button>
  </form>
<br></br>

<?php include_once("footer_chitiet.php"); ?>
