<?php include_once('header_chitiet.php');
	
	if(!isset($_SESSION)){
		session_start();
	}
	// echo $taikhoan;
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="back-links">
    		<p><a href="index.php">Home</a> >>>> <a href="#">Thông tin chi tiết</a></p>
    	    </div>
    		<div class="clear"></div>
    	</div>
		<?php 
			$masp = isset($_GET['masp']) ? $_GET['masp'] : ''; 
			$sql = "SELECT * FROM `sanpham` WHERE masp = '$masp' " ;

			$result = $db->thucthi($sql);
			$row = mysqli_fetch_array($result);


			// item_anh
			$row_anh_item = $db->thucthi("SELECT anh FROM `images` WHERE masp = '$masp'");
			$row_anh_phu = $db->thucthi("SELECT anh FROM `images` WHERE masp = '$masp'");
			$soluongkhohang = $row['soluong'];
			if(isset($_POST['add'])){
				if(!isset($_SESSION['customer'])){
					// header('Location: login_user.php');
					echo "<script>window.location.href='login_user.php'</script>";
				}else{

					$soluong = isset($_POST['soluong']) ? $_POST['soluong'] : '';
					if($soluongkhohang < 0 || $soluongkhohang == 0){
						echo "<script>alert('hết sạch nó hàng rùi ( 0 . 0)')</script>";
					}else{
						if(  $soluong > $row['soluong']){
							echo "<script>alert('mua quá số lượng rồi e ạ !!')</script>";
						}else{
							$thuchien = true;
							$kq1 = '';
							$masp = $row['masp'];
							$tensp = $row['tensp'];
							$anh = $row['image'];
							$thanhtien = $soluong * $row['dongia'];
							$_SESSION['hoadon'] = 1;
							$kiemtra = $db->thucthi("SELECT * FROM `order`");
							while($gop = mysqli_fetch_assoc($kiemtra)){
								if($masp == $gop['masp']){
									$soluongsp = $gop['soluong'];
									$thanhtiensp = $gop['thanhtien'];
									$kq1 = $db->thucthi("UPDATE `order` SET  soluong = ($soluong + $soluongsp) , thanhtien = ($thanhtien + $thanhtiensp)  WHERE masp = $masp" );
									$thuchien = false;	
								}
							}
							if($thuchien == true){
								$kq1 = $db->thucthi("INSERT INTO `order`( `masp`, `tensp`, `soluong`, `anh`, `thanhtien`,`taikhoan`) VALUES ('$masp','$tensp','$soluong','$anh','$thanhtien','$taikhoan')");
							}
							
							if(!$kq1 ){
								echo 'không thêm đc ';
							}else{
								echo "<script>window.location.href = 'hoadon.php' </script>";
							}
						}
					}
				}
			}
			if(isset($_POST['addgiohang'])){
				if(!isset($_SESSION['customer'])){
					// header('Location: login_user.php');
					echo "<script>window.location.href='login_user.php'</script>";
				}else{

				 $soluong = isset($_POST['soluong']) ? $_POST['soluong'] : '';
				if($soluongkhohang < 0 || $soluongkhohang == 0){
					echo "<script>alert('hết sạch nó hàng rùi ( 0 . 0)')</script>";
				}else{
						if(  $soluong > $row['soluong']){
							echo "<script>alert('mua quá số lượng rồi e ạ !!')</script>";
						}else{
							$masp = $row['masp'];
							$tensp = $row['tensp'];
							$anh = $row['image'];
							$thanhtien = (int)$soluong * (int)$row['dongia'];
							
							$kq = $db->thucthi("INSERT INTO `giohang`( `masp`, `tensp`, `soluong`, `anh`, `thanhtien`,`taikhoan`) VALUES ('$masp','$tensp','$soluong','$anh',$thanhtien,'$taikhoan')");
							if(!$kq){
								echo 'không thêm đc ';
							}else{
								echo "<script>alert('thêm thành công')</script>";
							}
						}
						
					}
				}
			}
			// <!-- ----------BINH LUAN---------- -->
			if(isset($_POST['gui_binh_luan'])){
				$binhluan = $_POST['binhluan'];
				$taikhoan_binhluan = isset($taikhoan) ? $taikhoan : '';
				$star = $_POST['star'];

				$check = $db->thucthi("INSERT INTO `binhluan`(`masp`, `noidung`, `taikhoan`,`star`) VALUES('$masp','$binhluan','$taikhoan_binhluan',$star)");
				// echo ($check)? "<script>alert('ok')</script>" : "<script>alert('lỗi')</script>";
			}
		?>
    	<div class="section group">
				<div class="cont-desc span_1_of_2">
				  <div class="product-details">				
					<div class="grid images_3_of_2">
						<div id="container">
						   <div id="products_example">
							   <div id="products">
								<div class="slides_container">
									<a href="#" target="_blank"><img src="../../upload/<?php echo $row['image']; ?>" alt=" " /></a>
										<?php while($row_anh = mysqli_fetch_assoc($row_anh_item)) { ?>
											<a href="#" target="_blank"><img src="../../upload/<?php echo $row_anh['anh'] ?>" alt="" /></a>
										<?php } ?>
								</div>
								<ul class="pagination">
									<li><a href="#"><img src="../../upload/<?php echo $row['image']; ?>" alt=" " /></a></li>
									<?php while($row_anh = mysqli_fetch_assoc($row_anh_phu)) { ?>
									<li><a href="#"><img src="../../upload/<?php echo $row_anh['anh'] ?>" ></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $row['tensp']; ?></h2> 
									
					<div class="price">
						<p>Price: <span><?php $dongia = $row['dongia']; echo number_format("$dongia"); ?> $</span></p>
					</div>
					
					<div style="display: flex;"><p style="font-size: 20px;"> <b>Số lượng:</b></p> <p style="font-size: 20px;"><?php echo $row['soluong'] ?></p></div>
					<div style="display: flex;"><p style="font-size: 20px;">	  <b>SPU:</b></p> <p style="font-size: 20px;"><?php echo $row['SPU'] ?></p></div>
					<div style="display: flex;"><p style="font-size: 20px;">	  <b>RAM:</b></p> <p style="font-size: 20px;"><?php echo $row['RAM'] ?></p></div>
					<div style="display: flex;"><p style="font-size: 20px;"><b>HardDrive:</b></p> <p style="font-size: 20px;"><?php echo $row['HardDrive'] ?></p></div>
					<div style="display: flex;"><p style="font-size: 20px;">	 <b>card:</b></p> <p style="font-size: 20px;"><?php echo $row['card'] ?></p></div>
					<div style="display: flex;"><p style="font-size: 20px;>">   <b>screen:</b></p> <p style="font-size: 20px;"><?php echo $row['screen'] ?></p></div>
					<div class="available">
					
						<!-- -------  Số lượng  ------ -->
					<form method="post" >
					<ul>
						<input type="text" class="form-control form-control-sm" placeholder="nhập số lượng" name="soluong">
						<br>
						<button  type="submit"  class="btn btn-primary" name="add">Mua</button>
						<button type="submit"  class="btn btn-primary" name="addgiohang">thêm vào giỏ</button>
					</ul>
					</form>
					</div>
			</div>
			<div class="clear"></div>
		  </div>
		<div class="product_desc">	
			<div id="horizontalTab">
				<ul class="resp-tabs-list">
					<li>Mô tả</li>
					<li>Các bình luận</li>
					<li>bình luận</li>
					<div class="clear"></div>
				</ul>
				<div class="resp-tabs-container">
					<div class="product-desc">
						<p><?php echo $row['mota'] ?></p>					
					</div>
				<!-- -------Cac binh luan---------- -->
				<?php 
					$rs = $db->thucthi("SELECT noidung,thoigian,`lienhe`.`gioitinh`,`lienhe`.`anhdaidien`,`lienhe`.`hoten`,star
										FROM `binhluan` INNER JOIN `lienhe` ON `binhluan`.`taikhoan` = `lienhe`.`taikhoan` 
										WHERE masp = $masp");
					$rs_trong = $db->thucthi("SELECT * FROM `binhluan` WHERE taikhoan = '' AND masp = $masp");
				?>
				 <div class="product-tags">
					<p>Tất cả bình luận</p>
					<?php while($all_com = mysqli_fetch_assoc($rs)){ ?>	 
						<p><?php echo $all_com['thoigian'] ?></p>
						<img style="width: 120px; height:20px;" src="../../upload/<?php echo $all_com['star'] ?>.jpg" ><br><br>
						<img style="width: 70px; height:70px;" src="../../upload/<?php if($all_com['anhdaidien']){
														echo $all_com['anhdaidien'];
						}else{
							echo ($all_com['gioitinh'] == 1) ? 'nam.jpg':'nu.jpg';
						} ?>"><h3><?php echo isset($all_com['hoten']) ? $all_com['hoten'] : '?' ?></h3>
				  	  	<p><?php echo $all_com['noidung'] ?></p>
					<?php } ?>
					<?php while($all_com = mysqli_fetch_assoc($rs_trong)){ ?>
						<p><?php echo $all_com['thoigian'] ?></p>
						<img style="width: 120px; height:20px;" src="../../upload/<?php echo $all_com['star'] ?>.jpg" ><br><br>
						<img style="width: 70px; height:70px;" src="../../upload/trong.jpg">
						<h3>( khách )</h3>
				  	  	<p><?php echo $all_com['noidung'] ?></p>
					<?php } ?>
			    </div>	
				

				<div class="review">
					
					 
				  <div class="your-review">
				  	 <h3>Bạn thấy sản phẩm thế nào ?</h3>
				  	  <p>Xin vui lòng để lại đánh giá </p>
				  	  <form method="post">
						<div class="stars">
							<input class="star star-5" id="star-5" type="radio" value="5" name="star"/>
							<label class="star star-5" for="star-5"></label>
							<input class="star star-4" id="star-4" type="radio" value="4" name="star"/>
							<label class="star star-4" for="star-4"></label>
							<input class="star star-3" id="star-3" type="radio" value="3" name="star"/>
							<label class="star star-3" for="star-3"></label>
							<input class="star star-2" id="star-2" type="radio" value="2" name="star"/>
							<label class="star star-2" for="star-2"></label>
							<input class="star star-1" id="star-1" type="radio" value="1" name="star"/>
							<label class="star star-1" for="star-1"></label>
							<!-- <input type="submit" value="xem kết quả" name="gui_binh_luan"/> -->
						</div>				
						    <div>
						    	<span><label>Bình luận<span class="red">*</span></label></span>
						    	<span><textarea name="binhluan"> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" value="SUBMIT REVIEW" name="gui_binh_luan"></span>
						  </div>
					    </form>
				  	 </div>				
				</div>
			</div>
		 </div>
	 </div>
	    <script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true   // 100% fit in a container
        });
    });
   </script>		
   <div class="content_bottom">
    		<div class="heading">
    		<h3>Related Products</h3>
    		</div>
    		<div class="see">
    			<p><a href="#">See all Products</a></p>
    		</div>
    		<div class="clear"></div>
    	</div>
   <div class="section group">
		<?php	
				// $masp = isset($_GET['masp']) ? $_GET['masp'] : ''; 
				$maloai = $row['maloai'];
				$loai = $db->thucthi("SELECT * FROM `sanpham` WHERE maloai = '$maloai'");
				
		    	while($t = mysqli_fetch_assoc($loai)){ ?>
				<div style="width:220px; height:270px;" class="grid_1_of_4 images_1_of_4">
					 <p><span class="rupees"><?php $ten = $t['tensp']; echo (strlen($ten) > 20) ? substr($ten,0,20).'...' : $ten; ?></span></p>
					 <a href="#"><img style="width:150px; height:100px;" src="../../upload/<?php echo $t['image'] ?>" ></a>
					 <p><span class="rupees"><?php $dongia = $t['dongia'];  echo number_format($dongia)?>$</span></p>			
					<div class="price" style="border:none">
					       		<div class="add-cart" style="float:none">								
									<h4><a style="font-size: 10px;" href="chitietSP.php?masp=<?php echo $t['masp'] ?>" >Bought</a></h4>
							    </div>
							 <div class="clear"></div>
					</div>
				</div>
				<?php } ?>
			</div>
        </div>
				<div class="rightsidebar span_3_of_1">
					<h2>Tin tức</h2>
					<ul class="side-w3ls">
				      <li><a href="https://cellphones.com.vn/mobile.html">điện thoại</a></li>
				      <li><a href="https://www.thegioididong.com/laptop/">máy tính</a></li>
				      <li><a href="https://vnexpress.net/the-thao/world-cup-2022/tran-dau/979139/argentina-phap">wolcup pháp với angentina</a></li>
				      <li><a href="https://viblo.asia/p/lich-su-cua-ngon-ngu-lap-trinh-V3m5W0YxKO7">tiểu sử ngôn ngữ lập trình</a></li>
				      <li><a href="https://www.techtarget.com/searchcloudcomputing/13thGenIntelCore?utm_source=google&int=off&pre=off&utm_medium=cpc&utm_term=GAW&utm_content=sy_lp12152022GOOGOTHR_GsidsCloudComputing_Intel_Embed_IO175373_LI2625371&utm_campaign=Intel_Embed_sCC_APAC&Offer=sy_lp12152022GOOGOTHR_GsidsCloudComputing_Intel_Embed_IO175373_LI2625371">Software</a></li>
				       <li><a href="https://www.prudential.com.vn/vi/blog-nhip-song-khoe/the-duc-the-thao-nang-cao-suc-khoe-the-chat-va-tinh-than/">Thể thao &amp; sức khỏe</a></li>
				       <li><a href="https://thanhnien.vn/suc-khoe/lam-dep/">làm đẹp</a></li>
				       <li><a href="https://vnexpress.net/giai-tri">giải trí</a></li>
				       <li><a href="https://univn.vn/?gclid=EAIaIQobChMIqrOfq6mK_AIV-NdMAh1PqwhCEAAYASAAEgJxf_D_BwE">nhà đất</a></li>
				       <li><a href="https://vneconomy.vn/tai-chinh.htm">tài chính</a></li>
				       <li><a href="https://stp.thuathienhue.gov.vn/?gd=25&cn=589&tc=433">hôn nhân &amp; pháp luật</a></li>
				       
    				</ul>
    				
    
 				</div>
 		</div>
 	</div>
    </div>
 </div>
<?php include_once('footer_chitiet.php') ?>