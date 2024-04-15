<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php if(!isset($_SESSION)){session_start();} ?>
<?php include_once('../Class/database.class.php'); $db = new Database(); 
	if(!isset($_SESSION['taikhoan_user'])){
		$taikhoan = "";
	}else{
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
<title>Trọng Tần Computer</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
<link rel="stylesheet" href="css/star.css">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" 
        rel="stylesheet">
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
<link href="css/easy-responsive-tabs.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="css/global.css">
<script src="js/slides.min.jquery.js"></script>
<script>
		$(function(){
			$('#products').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				effect: 'slide, fade',
				crossfade: true,
				slideSpeed: 350,
				fadeSpeed: 500,
				generateNextPrev: true,
				generatePagination: false
			});
		});
	</script>
</head>
<body>
  <div class="wrap">
	<div class="header">
		<div class="headertop_desc">
			<div class="call">
				 <p><span>Need help?</span> call us <span class="number">1-22-3456789</span></span></p>
			</div>
			<div class="account_desc">
				<ul>
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
				<a href="index.html"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="cart">
			  	   <p style="color: rebeccapurple;">Welcome <?php echo isset($_SESSION['customer']) ? $_SESSION['customer'] : "?" ?> <span>Cart:</span><div id="dd" class="wrapper-dropdown-2"> 0 item(s) - $0.00
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
					// all dropdowns
					$('.wrapper-dropdown-2').removeClass('active');
				});

			});

		</script>
	 <div class="clear"></div>
  </div>
  <?php 
			if(isset($taikhoan)){
				$manggiohang = $db->thucthi("SELECT * FROM `giohang` WHERE taikhoan = '$taikhoan'");
				$demgiohang = mysqli_num_rows($manggiohang);
				$mangdonhang = $db->thucthi("SELECT * FROM `dathang` WHERE taikhoan_user = '$taikhoan'");
				$demdonhang = mysqli_num_rows($mangdonhang);
			}
				
		?>
	<div class="header_bottom">
	     	<div class="menu">
	     		<ul>
			    	<li><a href="index.php">Home</a></li>
			    	<li><a href="giohang.php">Giỏ hàng ( <?php echo isset($demgiohang) ? $demgiohang : ''; ?> )</a></li>
			    	<li><a href="hangcho.php">Đang vận chuyển ( <?php echo isset($demdonhang) ? $demdonhang : ''; ?> )</a></li>
					<li><a href="information.php">thông tin tác giả</a></li>
			    	<li><a href="contact.php">contact</a></li>
			    	<div class="clear"></div>
     			</ul>
	     	</div>
	     	<div class="search_box">
	     		<form>
	     			<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}"><input type="submit" value="">
	     		</form>
	     	</div>
	     	<div class="clear"></div>
	     </div>	     	
   </div>