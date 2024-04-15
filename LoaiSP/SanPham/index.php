 <?php include_once("header.php"); 

	if(isset($_GET['trang'])){
		$page = $_GET['trang'];
	}else{
		$page = '';
	}
	if($page == '' || $page == 1){
		$begin = 0;
	}else{
		$begin = ($page * 6) - 6;
	}
	$maloai = isset($_GET['masp']) ? $_GET['masp'] : '';
	if($maloai == null){
		$sql = "SELECT * FROM `sanpham` ORDER BY dongia LIMIT $begin,6";
	}else{
		$sql = "SELECT * FROM `sanpham` WHERE maloai='$maloai' ORDER BY dongia LIMIT $begin,6";
	}
    
    $result1 = $db->thucthi($sql);

	
?> 
<?php include_once("submenu.php") ?>
<?php include_once("slider.php") ?>
<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="see">
    			<p><a href="index.php">See all Products</a></p> 
    		</div>
    		<div class="clear"></div>
    	</div>


		
		<div class="container" style="margin-top:30px"></div>
			<div class="row">
				<div class="col-sm-3">
					<div style="width:300px; height: 440px;" class="grid_1_of_4 images_1_of_4">
					<h2>Các mặt hàng theo giá tiền</h2>
					<a type="button" class="btn btn-primary" href="timkiem.php?gia1=0&gia2=5000000">dưới 5 triệu</a><br><br>
					<a type="button" class="btn btn-success" href="timkiem.php?gia1=5000000&gia2=10000000">từ 5 triệu đến 10 triệu</a><br><br>
					<a type="button" class="btn btn-info" href="timkiem.php?gia1=10000000&gia2=20000000">từ 10 triệu đến 20 triệu</a><br><br>
					<a type="button" class="btn btn-warning" href="timkiem.php?gia1=20000000&gia2=30000000">từ 20 triệu đến 30 triệu</a><br><br>
					<a type="button" class="btn btn-danger" href="timkiem.php?gia1=30000000">trên 30 triệu</a><br><br>
					</div>
				</div>
				<div class="col-sm-9">
						<?php while($row1 = mysqli_fetch_assoc($result1)) { ?>
							<div style="width:250px; height: 310px;" class="grid_1_of_4 images_1_of_4">
								<a  href="chitietSP.php?masp=<?php echo $row1['masp']; ?>"><img style="width:160px; height:110px;" src="../../upload/<?php echo $row1['image'] ?>"  /></a>
								<h2 ><?php $ten = $row1['tensp']; echo (strlen($ten) > 20) ? substr($ten,0,20).'...' : $ten;  ?></h2>
							<div class="price-details"> 
							<h6><span class="rupees"> giá: <?php $gia = $row1['dongia']; echo number_format($gia); ?> đ</h6>
							<h6>Số lượng: <?php echo $row1['soluong'];  if($row1['soluong'] == 0) { echo '( '.'hết hàng'.' )'; }?></h6>
							<h6>Hãng: <?php echo $row1['maloai']; ?></h6>
							<h4><a class="button" style="text-decoration: none; font-size: 20px;" href="chitietSP.php?masp=<?php echo $row1['masp']; ?> ">mua</a></h4>	  
							</div>       		
							</div> 
						<?php } ?>
						
				</div>
				</div>
			</div>

				<?php 
					$result2 = $db->thucthi("SELECT * FROM `sanpham`");
					$row_count = mysqli_num_rows($result2);
					$trang = ceil($row_count/6);
				?>
				<br>
				<ul class="pagination">
				<li><p class="page-link">Trang </p></li>
					<?php for( $i = 1; $i <= $trang ; $i ++){ ?>
					<li class="page-item"><a class="page-link" href="index.php?trang=<?php echo $i ?>"><?php echo $i ?></a></li>
					<?php } ?>
				</ul>
    </div>
 </div>
</div>
<?php include_once("footer.php"); ?>



