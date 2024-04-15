<?php 
	if(!isset($_SESSION)){
		session_start();
	}
	if(!isset($_SESSION['customer'])){
		echo "<script>window.location.href='login_user.php'</script>";
	}
?>
<?php include_once("header.php") ?>
<?php
 	$result = $db->thucthi("SELECT * FROM `giohang` WHERE taikhoan = '$taikhoan'");

		
?>
<div class="section group">
			<?php while($row1 = mysqli_fetch_assoc($result)) { ?>
				<div style="width:300px; height: 350px;" class="grid_1_of_4 images_1_of_4">
					 <a  href="chitietSP.php?masp=<?php echo $row1['masp']; ?>"><img style="width: 180px; height:120px;" src="../../upload/<?php echo $row1['anh'] ?>"  /></a>
					 <h2><?php echo $row1['tensp']; ?></h2>
					<div class="price-details">
				       <div class="price-number">
							<p>số lượng: <span class="rupees"><?php echo $row1['soluong']; ?></span></p>
							<p>Tổng tiền: <span class="rupees"><?php $thanhtien = $row1['thanhtien'];  echo number_format($thanhtien)?>$</span></p>
					    </div>
					       		<div class="add-cart">								
									<h4><a style="font-size: 10px;" href="chitietSP.php?masp=<?php echo $row1['masp']; ?> " class="btn btn-primary">buy</a></h4>
							     </div>
								 <div class="add-cart">								
									<h4><a style="font-size: 10px;" href="xoakhogiohang.php?id=<?php echo $row1['id'] ?>"  class="btn btn-primary">xóa</a></h4>
							     </div>
							 <div class="clear"></div>
					</div>
					 
				</div>
				<?php } ?>
				
			</div>
<?php include_once('footer.php') ?>