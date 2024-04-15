<?php include_once("../Class/database.class.php");
	$db = new Database();
	if(!isset($_SESSION)){
		session_start();
	}
	if(isset($_POST['login_user'])){
		 $taikhoan = isset($_POST['taikhoan']) ? $_POST['taikhoan'] : '';
		 $matkhau = isset($_POST['matkhau']) ? $_POST['matkhau'] : '';
		// echo $matkhau = password_hash($_POST['matkhau'],PASSWORD_DEFAULT);
					
		$check = $db->thucthi("SELECT * FROM `taikhoan_user` WHERE taikhoan = '$taikhoan'");
		$row = mysqli_fetch_array($check);
		if($row){
			if(password_verify($matkhau,$row['matkhau_user']) == 1){
				$_SESSION['customer'] = $row['tenkhachhang'];
				$_SESSION['taikhoan_user'] = $row['taikhoan'];
				echo "<script>alert('đăng nhập thành công')</script>";
				header('Location:index.php');
			}
		}else{
				echo "<script>alert('tài khoản hoặc mật khẩu không hợp lệ')</script>";
			}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> menu</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="screen" style="background-color: white;">
				<div class="screen__content">
					<form class="login" method="post" >
						<div class="login__field">
							<i class="login__icon fas fa-user"></i>
							<input type="text" class="login__input" placeholder="tài khoản" name="taikhoan">
						</div>
					<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" class="login__input" placeholder="mật khẩu" name="matkhau">
				</div>
				<button class="button login__submit" name="login_user">
					<span class="button__text">Login</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>
									
			</form>

		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>	
			<a class="button login__submit" href="index.php">
					<span class="button__text">Trở về trang chủ</span>
					<i class="button__icon fas fa-chevron-right"></i>
			</a>
			<!-- Button to Open the Modal -->
			<button type="button" class="button login__submit" data-toggle="modal" data-target="#myModal">
			<span class="button__text">đăng kí</span>
					<i class="button__icon fas fa-chevron-right"></i>
			</button>
			

			<!-- The Modal -->
			<div class="modal" id="myModal">
			<div class="modal-dialog">
				<div class="modal-content">

					<!-- Modal body -->
					<div class="modal-body">
							<form class="login" method="post" >
								<div class="login__field">
									<i class="login__icon fas fa-user"></i>
									<input type="text" class="login__input" placeholder="tên đăng nhập" name="tendangnhap">
								</div>
								<div class="login__field">
									<i class="login__icon fas fa-lock"></i>
									<input type="text" class="login__input" placeholder="tài khoản" name="taikhoan">
								</div>
								<div class="login__field">
									<i class="login__icon fas fa-lock"></i>
									<input type="password" class="login__input" placeholder="mật khẩu" name="matkhau">
								</div>
								<button class="button login__submit" name="dangki_user">
									<span class="button__text">đăng kí luôn</span>
									<i class="button__icon fas fa-chevron-right"></i>
								</button>			
							</form>
					</div>
				</div>
			</div>
			</div>
			<?php 
				function kiemTraSo($chuoi){
					$check = 0;
					$array_chuoi = str_split($chuoi);
					for($i = 0 ; $i < strlen($chuoi) ; $i ++){
						if($array_chuoi[$i] >= 0 && $array_chuoi[$i] <= 9){
							$check = 1;
							// echo $array_chuoi[$i];
							break;
						}
					}
					return $check;
				}

				if(isset($_POST['dangki_user'])){
					$tendangnhap = isset($_POST['tendangnhap']) ? $_POST['tendangnhap'] : '';
					$taikhoan = isset($_POST['taikhoan']) ? $_POST['taikhoan'] : '';
					$matkhau = isset($_POST['matkhau']) ?$_POST['matkhau'] : '';
					$matkhau = password_hash($_POST['matkhau'],PASSWORD_DEFAULT);
					
					$tk = kiemTraSo($taikhoan);
					$mk = kiemTraSo($matkhau);
					$tdn = kiemTraSo($tendangnhap);

					// echo kiemTraSo($taikhoan);
					if(strlen($taikhoan) < 8 || $tk == 0){
						echo "<script>alert('tài khoản phải đủ 8 kí tự với có số nữa nhé cu')</script>";
					}else if(strlen($matkhau) < 8 || $mk == 0){
						echo "<script>alert('mật khẩu phải đủ 8 kí tự với có số ở trỏng nhé :> ') </script>";
					}else if(strlen($tendangnhap) < 8 ){
						echo "<script> alert('nhập đủ 8 kí tự cho tên người dùng nhé :>')</script>";
					}else{
						md5($matkhau);
						$check = $db->thucthi("INSERT INTO `taikhoan_user` VALUES ('$taikhoan','$matkhau','$tendangnhap')");
						// if($check){
							echo "<script>alert('đăng kí thành công')</script>";
						// }1
					}
					
				}
			?>
		
	</div>
</div>
</body>
</html>