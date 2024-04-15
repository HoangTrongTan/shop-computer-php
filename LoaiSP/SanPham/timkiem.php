<?php include_once("header.php"); 

if(isset($_POST['text_tim'])){
    $tensp = $_POST['text_tim'];
    $result1 = $db->thucthi("SELECT * FROM `sanpham` WHERE `tensp` LIKE '%$tensp%'");
}
if(isset($_GET['gia1'])){
    $gia1 = $_GET['gia1'];
    if(isset($_GET['gia2'])){
        $gia2 = $_GET['gia2'];
        $result1 = $db->thucthi("SELECT * FROM `sanpham`  WHERE dongia BETWEEN $gia1 AND $gia2 ORDER BY dongia");
    }else{
        $result1 = $db->thucthi("SELECT * FROM `sanpham`  WHERE dongia > $gia1 ORDER BY dongia");
    }
    
}

$dem = mysqli_num_rows($result1);

?> 
<?php include_once("submenu.php") ?>
<?php include_once("slider.php") ?>
<div class="main">
<div class="content">
    <div class="content_top">
        <div class="heading">
        <h3>Có <?php echo $dem; ?> sản phẩm</h3>
        </div>
        <div class="see">
            <p><a href="index.php">See all Products</a></p> 
        </div>
        <div class="clear"></div>
    </div>
    
      <div class="section group">
      <div style="width:300px; height: 440px;" class="grid_1_of_4 images_1_of_4">
      <h2>Các mặt hàng theo giá tiền</h2>
      <a type="button" class="btn btn-primary" href="timkiem.php?gia1=0&gia2=5000000">dưới 5 triệu</a><br><br>
      <a type="button" class="btn btn-success" href="timkiem.php?gia1=5000000&gia2=10000000">từ 5 triệu đến 10 triệu</a><br><br>
      <a type="button" class="btn btn-info" href="timkiem.php?gia1=10000000&gia2=20000000">từ 10 triệu đến 20 triệu</a><br><br>
      <a type="button" class="btn btn-warning" href="timkiem.php?gia1=20000000&gia2=30000000">từ 20 triệu đến 30 triệu</a><br><br>
      <a type="button" class="btn btn-danger" href="timkiem.php?gia1=30000000">trên 30 triệu</a><br><br>
      </div>
        <?php while($row1 = mysqli_fetch_assoc($result1)) { ?>
            <div style="width:300px; height: 440px;" class="grid_1_of_4 images_1_of_4">
                 <a  href="chitietSP.php?masp=<?php echo $row1['masp']; ?>"><img style="width:180px; height:180px;" src="../../upload/<?php echo $row1['image'] ?>"  /></a>
                 <h2><?php echo $row1['tensp']; ?></h2>
                <div class="price-details"> 
                        <h6><span class="rupees"> giá: <?php $gia = $row1['dongia']; echo number_format($gia); ?> $</h6>
                        <h6>Số lượng: <?php echo $row1['soluong'];  if($row1['soluong'] == 0) { echo '( '.'hết hàng'.' )'; }?></h6>
                        <h6>Hãng: <?php echo $row1['maloai']; ?></h6>
                                                        
                                <h4><a class="button" style="text-decoration: none; font-size: 20px;" href="chitietSP.php?masp=<?php echo $row1['masp']; ?> ">mua</a></h4>
                          
                </div>

                               
                </div>
                 
            <?php } ?>
            
        </div>
            
</div>
</div>
</div>
<?php include_once("footer.php"); ?>



