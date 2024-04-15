<?php include_once("header.php");  
    $ketqua = $db->thucthi("SELECT * FROM `loaisanpham` ");
    // $row = mysqli_fetch_assoc($ketqua);
?>
<?php 
    if(isset($_POST['add'])){
        $maloai = isset($_POST['maloai']) ? $_POST['maloai'] : "";
        $tensanpham     = isset($_POST['tensanpham']) ? $_POST['tensanpham'] : "";
        $dongia = isset($_POST['dongia']) ? $_POST['dongia'] : 0;
        $mota       = isset($_POST['mota']) ? $_POST['mota'] : "";
        $image       = isset($_FILES["anh"]["name"]) ? $_FILES["anh"]["name"] : "";
        $soluong = isset($_POST['soluong']) ? $_POST['soluong'] : '';
        $SPU = $_POST['CPU'];
        $RAM = $_POST['RAM'];
        $HardDrive = $_POST['HardDrive'];
        $card = $_POST['card'];
        $screen = $_POST['Screen'];
        
        $sql = "INSERT INTO `sanpham`( `maloai`, `tensp`, `dongia`, `image`, `mota`, `soluong`,`SPU`,`RAM`,`HardDrive`,`card`,`screen`) VALUES ('$maloai','$tensanpham','$dongia','$image','$mota','$soluong','$SPU','$RAM','$HardDrive','$card','$screen') ";
        $result = $db->thucthi($sql);

        echo "<h1>".$image."</h1>";
        //File upload 
            $target_dir = "../upload/";
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
            echo"<script> window.location.href='sanpham.php';</script>";
       
        // header("location :taikhoan.php");
    }
?>
    <!-- Begin Page Content -->
    <div class="container-fluid col-6">

        <form  method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="pwd">Loại sản phẩm: </label>
                <select class="form-control"  name="maloai">
                    <?php while($row = mysqli_fetch_assoc($ketqua)) { ?>
                        <option value=<?php echo $row["maloai"] ?> ><?php echo $row['tenloai'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="pwd">Tên sản phẩm:</label>
                <input type="text"  class="form-control" name = "tensanpham">
            </div>
            <div class="form-group">
                <label for="pwd">Đơn giá:</label>
                <input type="text"  class="form-control" name = "dongia">
            </div>
            <div class="form-group">
                <label for="pwd">Số lượng:</label>
                <input type="text"  class="form-control" name = "soluong">
            </div>
            <div class="form-group">
                <label for="pwd">CPU:</label>
                <input type="text"  class="form-control" name = "CPU">
            </div>
            <div class="form-group">
                <label for="pwd">RAM:</label>
                <input type="text"  class="form-control" name = "RAM">
            </div>
            <div class="form-group">
                <label for="pwd">HardDrive:</label>
                <input type="text"  class="form-control" name = "HardDrive">
            </div>
            <div class="form-group">
                <label for="pwd">Card:</label>
                <input type="text"  class="form-control" name = "Card">
            </div>
            <div class="form-group">
                <label for="pwd">Screen:</label>
                <input type="text"  class="form-control" name = "Screen">
            </div>
            <div class="form-group">
                <label for="pwd">Mô tả:</label>
                <textarea class="form-control" rows="5" name="mota"></textarea>
            </div>
            <div class="form-group">
                <label for="pwd">Image:</label>
                <input type="file" class="form-control-file border" name="anh">
            </div>
            <button type="submit"  class="btn btn-primary" name="add"><i class="fa fa-check" aria-hidden="true"></i>chấp nhận</button>
        </form>
    </div>
    <!-- /.container-fluid -->

<?php include_once("footer.php");  ?>