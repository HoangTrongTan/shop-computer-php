<?php 
	if(!isset($_SESSION)){
		session_start();
	}
	if(!isset($_SESSION['customer'])){
		echo "<script>window.location.href='login_user.php'</script>";
	}
?>
<?php include_once('header.php') ?>
<div class="main">
    <div class="content">
    	<div class="section group">
			<?php
				if(isset($_POST['submit'])){
					$name = isset($_POST['name']) ? $_POST['name']: '';
					$sdt = $_POST['sdt'];
					$diachi = $_POST['diachi'];
					$email = $_POST['email'];
					$anh = $_FILES['anh']['name'];
					$ngaysinh = $_POST['bday'];
					$yeuthich = $_POST['yeuthich'];
					$gioitinh = ($_POST['gioitinh'] == 'nam') ? 1 : 0;

					$check = $db->thucthi("INSERT INTO `lienhe`(`taikhoan`,`email`, `hoten`, `sdt`, `anhdaidien`, `diachi`, `ngaysinh`,`gioitinh`, `yeuthich`) VALUES ('$taikhoan','$email','$name','$sdt','$anh','$diachi','$ngaysinh','$gioitinh','$yeuthich')");
					if($check){
						echo "<script>alert('thanh cồng')</script>";
					}else{
						echo "<script>alert('lỗi')</script>";
					}

				//File upload 
				$target_dir = "../../upload/";
				$target_file = $target_dir.basename($_FILES["anh"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// Check if image file is a actual image or fake image
				$check = getimagesize($_FILES["anh"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$uploadOk = 0;
				}

                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"  && $imageFileType != "jfif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["anh"]["tmp_name"], $target_file)) {
                        echo "The file ". htmlspecialchars( basename( $_FILES["anh"]["name"])). " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
					
				}

				$thaydoi = $db->thucthi("SELECT * FROM `lienhe` WHERE taikhoan = '$taikhoan'");
				$dem = mysqli_num_rows($thaydoi);
				$row = mysqli_fetch_array($thaydoi);
				if(isset($_POST['fix'])){
					$id = $row['id'];
					$name = isset($_POST['name']) ? $_POST['name']: '';
					$sdt = $_POST['sdt'];
					$diachi = $_POST['diachi'];
					$email = $_POST['email'];
					$anh = $_FILES['anh']['name'];
					//xóa ảnh
					$path = $row['anhdaidien'];
					unlink("../../upload/$path");
					$ngaysinh = $_POST['bday'];
					$yeuthich = $_POST['yeuthich'];
					$gioitinh = ($_POST['gioitinh'] == 'nam') ? 1 : 0;

					$check = $db->thucthi("UPDATE `lienhe` SET `email`='$email',`hoten`='$name',`sdt`='$sdt',`anhdaidien`='$anh',`diachi`='$diachi',`ngaysinh`='$ngaysinh', `yeuthich` = '$yeuthich' , `gioitinh` = $gioitinh WHERE `id` = $id");
					if($check){
						echo "<script>alert('thanh cồng')</script>";
					}else{
						echo "<script>alert('lỗi')</script>";
					}
					// echo "giới tính là: ".$_POST['gioitinh'];
				}
				
			?>
			
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h2>Contact Us</h2>

					    <form method="post" enctype="multipart/form-data">
					    	<div>
						    	<span><label>Name</label></span>
						    	<span><input value="<?php echo isset($row['hoten']) ? $row['hoten'] : '' ?>" type="text" class="textbox" name="name"></span>
						    </div>
						    <div>
						    	<span><label>Số điện thoại</label></span>
						    	<span><input value="<?php echo isset($row['sdt']) ? $row['sdt'] : '' ?>" type="text" class="textbox" name="sdt"></span>
						    </div>
							<div>
						    	<span><label>địa chỉ</label></span>
						    	<span><input value="<?php echo isset($row['diachi']) ? $row['diachi'] : '' ?>" type="text" class="textbox" name="diachi"></span>
						    </div>
							<div>
						    	<span><label>Giới tính</label></span>
						    	<span><input value="nam" type="radio" class="textbox" checked="gender" name="gioitinh"> nam&nbsp;<input value="nu" type="radio" class="textbox" name="gioitinh"> nữ</span>
						    </div>
							<div>
						    	<span><label>email</label></span>
						    	<span><input value="<?php echo isset($row['email']) ? $row['email'] : '' ?>" type="text" class="textbox" name="email"></span>
						    </div>
							<div>
						    	<span><label>Ảnh đại diện</label></span>
						    	<span><input value="<?php echo isset($row['anhdaidien']) ? $row['anhdaidien'] : '' ?>" type="file" class="textbox" name="anh"></span>
						    	<?php if(isset($row['anhdaidien'])){ ?>
								<img style="width:100px; 100px;" src="../../upload/<?php echo $row['anhdaidien'] ?>" >
								<?php }else{ echo 'vui lòng chọn ảnh';} ?>
							</div>
						    <div>
						     	<span><label>Ngày Sinh</label></span>
						    	<span><input value="<?php echo isset($row['ngaysinh']) ? $row['ngaysinh'] : '' ?>"  type="date" name="bday" max="2020-12-31" ></span>
						    </div>
						    <div>
						    	<span><label>Subject</label></span>
						    	<span><textarea name="yeuthich"><?php echo isset($row['yeuthich']) ? $row['yeuthich'] : '' ?> </textarea></span>
						    </div>
						   <div>
							<?php if($dem == 0 || $dem < 0){ ?>
						   		<span><input type="submit" value="Submit"  class="myButton" name="submit"></span>
							<?php }else {?>
								<span><input type="submit" value="Fix"  class="myButton" name="fix"></span>
							<?php } ?>
							</div>
					    </form>
						
				  </div>
  				</div>
			  </div>		
         </div> 
    </div>
<?php include_once('footer.php') ?>