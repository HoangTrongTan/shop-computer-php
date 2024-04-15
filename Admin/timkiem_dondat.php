<?php include_once("header.php");
    $result = $db->thucthi("SELECT * FROM `taikhoan_user`");
    if(isset($_GET['magiohang'])){
        $magiohang = $_GET['magiohang'];
        $okchua = $db->thucthi("UPDATE `dathang` SET `check` = 0 WHERE magiohang = $magiohang");
        if($okchua){
            echo "<script>alert('đổi thành công')</script>";
        }
    }
?>
            <!-- Nav Item - Pages Collapse Menu -->
            <?php while($row = mysqli_fetch_assoc($result)){ 
                $taikhoan = $row['taikhoan'];
                ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target=<?php echo "#".$row['taikhoan'] ?>
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span><?php echo 'tài khoản '.$row['tenkhachhang'] ?></span>
                </a>
                <div id=<?php echo $row['taikhoan'] ?> class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- ----------PHP----------- -->
                    <?php $result1 = $db->thucthi("SELECT * FROM `dathang` WHERE taikhoan_user = '$taikhoan'"); 
                            
                    ?>
                    <table class="table">
                    <thead>
                    <tr>
                        <th style="color: violet;">Thông tin khách hàng</th>
                        <th style="color: violet;">sản phẩm - số lượng</th>
                        
                        <th style="color: violet;">Tổng tiền</th>
                        <th style="color: violet;">Ngày đặt</th>
                        <th style="color: violet;">trang thai</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php while($r = mysqli_fetch_assoc($result1)){ ?>
                    <tr>
                        <td><?php echo $r['thongtingiohang'] ?></td>
                        <td><?php echo $r['sanpham'] ?></td>
                        <td><?php $tongtien = $r['tongtien']; echo number_format($tongtien).'  $'; ?></td>
                        <td><?php echo $r['ngaydat'] ?></td>
                        <td><?php echo $r['trangthai'] == 0 ? 'dang xu ly' : 'xy ly thanh cong' ?></td>
                        <td><a class="btn btn-primary mb-2" href="huygiohang.php?magiohang=<?php echo $r['magiohang'] ?>">Hủy giỏ hàng</a></td>
                        <td><a class="btn btn-primary mb-2" href="xoagiohang.php?magiohang=<?php echo $r['magiohang'] ?>">Đã nhận hàng</a></td>
                        <td><a class="btn btn-primary mb-2" href="danhsachdathang.php?magiohang=<?php echo $r['magiohang'] ?>">đơn đã đến nơi</a></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                    </table>
                    
                    </div>
                </div>
            </li>
            <?php } ?>


<?php include_once("footer.php") ?>
