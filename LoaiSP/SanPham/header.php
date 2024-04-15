<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php if(!isset($_SESSION)){
		session_start();
	} ?>
<?php
	include_once("../Class/database.class.php"); $db = new Database();  
	if(!isset($_SESSION['taikhoan_user'])) 
	{ 
		$taikhoan = "";
	}
	else
	{
		$taikhoan = $_SESSION['taikhoan_user'];
	} 

	$fp = 'dem.txt';
	$fo = fopen($fp,'r');
	$count = fread($fo, filesize($fp));
	$count ++;
	$fc = fclose($fo);
	$fo = fopen($fp, 'w');
	$fw = fwrite($fo,$count);
	$fc = fclose($fo);
?>
<!DOCTYPE HTML>
<head>
<title>Trọng tần computer</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/slider.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript" src="js/startstop-slider.js"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <div class="wrap">
	<div class="header">
		<div class="headertop_desc">
			<div class="call">
				 <p><span>Cần trợ giúp</span> call us <span class="number">0397346930</span></span></p>
				 <p>Lượt truy cập người xem: <?php echo $count ?></p>
			</div>
			<div class="account_desc">
				<ul>
					<!-- PHP -->
					<li><a href="#">Register</a></li>
					<?php if(isset($_SESSION['customer'])){ ?>
					<li><a href="logout.php">Logout</a></li>
					<?php } ?>
					<!-- <li><a href="../../Admin/index.php">manager</a></li> -->
					<?php if(!isset($_SESSION['customer'])) { ?> 
					<li><a href="login_user.php">Đăng nhập</a></li>
					<?php } ?>
					</ul>
			</div>
			<div class="clear"></div>
		</div>
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img style="width: 500px; height: 120px;" src="../../upload/header.jpg" alt="" /></a>
			</div>
			  <div class="cart">
			  	   <p style="color: rebeccapurple;">Welcome <?php echo isset($_SESSION['customer']) ? $_SESSION['customer']: "?" ?> <span></span><div id="dd" class="wrapper-dropdown-2">
			  	   	<ul class="dropdown">
							<li>you have no items in your Shopping cart</li>
					</ul></div></p>
			  </div>
			  <script type="text/javascript">
			function DropDown(el) {
				this.dd = el;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						event.stopPropagation();
					});	
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					$('.wrapper-dropdown-2').removeClass('active');
				});

			});
		</script>
	 <div class="clear"></div>
  </div>
  <?php 
  	// if(!isset($_SESSION)){ session_start();} echo isset($_SESSION['hoadon']) ? $_SESSION['hoadon'] : 'không tồn tại';
// 	if(isset($_SESSION['hoadon'])){
// 	if($_SESSION['hoadon'] == 1){
//    ?>
<!-- // 		<a class="button"  href="hoadon.php" class="">Trở về hóa đơn</a> -->
		
	<?php //}else{ echo '';}}?>

		<!-- PHP -->
		<?php 
			if(isset($taikhoan)){
				$manggiohang = $db->thucthi("SELECT * FROM `giohang` WHERE taikhoan = '$taikhoan' ");
				$demgiohang = mysqli_num_rows($manggiohang);
				$mangdonhang = $db->thucthi("SELECT * FROM `dathang` WHERE taikhoan_user = '$taikhoan' AND trangthai = 0");
				$demdonhang = mysqli_num_rows($mangdonhang);
			}
				
		?>
		<?php 
		?>
	<br><div class="header_bottom">
	     	<div class="menu">
	     		<ul>
			    	<li class="active"><a href="index.php">Home</a></li>
			    	<li><a href="giohang.php">Giỏ hàng ( <?php echo isset($demgiohang) ? $demgiohang : ''; ?> )</a></li>
			    	<li><a href="hangcho.php">Đang vận chuyển ( <?php echo isset($demdonhang) ? $demdonhang : ''; ?> )</a></li> 
					<li><a href="information.php">Thông tin tác giả</a></li>
					<li><a href="contact.php">Contact</a></li>
			    	<div class="clear"></div>
     			</ul>
	     	</div>
	     	<div class="search_box">
	     		<form action="timkiem.php" method="post">
	     			<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';} " name="text_tim"><input type="submit" value="" name="tim">
	     		</form>
	     	</div>
	     	<div class="clear"></div>
	     </div>	     
         <!-- Loai san pham  -->