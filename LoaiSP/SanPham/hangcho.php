<?php include_once("header_chitiet.php"); ?>
<?php $result = $db->thucthi("SELECT * FROM `dathang` WHERE taikhoan_user = '$taikhoan' AND trangthai = 0"); 
      //  echo $taikhoan;
?>
<br><br>
 <table class="table">
    <thead>
      <tr>
        <th style="color: red;">Thông tin khách hàng</th>
        <th style="color: red;">Các sản phẩm</th>
        
        <th style="color: red;">Tổng tiền</th>
        <th style="color: red;">Ngày đặt</th>
      </tr>
    </thead>
    <tbody>
        <?php while($r = mysqli_fetch_assoc($result)){ ?>
      <tr>
        <td><?php echo $r['thongtingiohang'] ?></td>
        <td><?php echo $r['sanpham'] ?></td>
        <td><?php $tongtien = $r['tongtien']; echo number_format($tongtien).'  $'; ?></td>
        <td><?php echo $r['ngaydat'] ?></td>
        <?php if($r['check'] == 1){ ?>
        <td><a class="btn btn-primary mb-2" href="huygiohang.php?magiohang=<?php echo $r['magiohang'] ?>">Hủy đơn hàng</a></td>
          <?php } ?>
      </tr>
      <?php } ?>
    </tbody>
  </table>
<br><br>
<?php include_once("footer_chitiet.php"); ?>