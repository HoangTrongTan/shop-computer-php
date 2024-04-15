<?php 
    if(isset($_GET['trang'])){
        $page = $_GET['trang'];
    }else{
        $page = '';
    }
    if($page == '' || $page == 1){
        $begin = 0;
    }else{
        $begin = ($page * 3)-3;
    }
?>


<?php include_once("header.php");  ?>
<?php
$sql = "SELECT * FROM `sanpham` LIMIT $begin,3"; 
$result =  $db->thucthi($sql);

$gg = $db->thucthi("SELECT * FROM `sanpham`");

//  echo '<br>Tên đăng nhập: '.$SESSION['user'][0].' </br>'

            if(isset($_POST['add'])){
                $masanpham = isset($_POST['masanpham']) ? $_POST['masanpham'] : "";
                $anh     = isset($_FILES['anh']['name']) ? $_FILES['anh']['name'] : "";

                $sql = "INSERT INTO `images` VALUES ('$masanpham','$anh ')";
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

              //------------------- phân trang php------------------  
              
              
?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                            
                                        <tr>
                                            <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Image</th>
                                            <th>Số lượng</th>
                                            <th><i class="fa fa-cogs"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_assoc($result)){   ?>
                                            
                                        <tr>
                                            <td><?php echo $row['maloai'] ?></td>
                                            <td><?php echo $row['tensp'] ?></td>
                                            <td><?php $dongia = $row['dongia']; echo number_format(($dongia)).' đ'; ?></td>
                                            <td><img src="../upload/<?php echo $row['image'] ?>" width="80px" height="60px" ></td>
                                            <td>
                                                <?php echo  $row['soluong']; ?>
                                            </td>
                                            <td><a href="sanpham_edit.php?key=<?php echo $row['masp'] ?>"><i class="fa fa-wrench" style="color:darkblue"></i> </a> | 
                                            <a onclick="return confirm('Bạn có chắc muốn xóa ')" href="sanpham_delete.php?key=<?php echo $row['masp'] ?>"> <i class="fa fa-trash" style="color: red;"></i></a></td>
                                            <!-- nút ẩn -->
                                            
                                        </tr>

                                        <?php } ?>
                                    </tbody>
                                </table>
                                <a href="sanpham_insert.php"  class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</a>
                                
                                <!-- Button to Open the Modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Thêm ảnh cho sản phẩm
                                    </button>

                                <!-- The Modal -->
                                <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4  class="modal-title">Thêm ảnh phụ liên quan</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                       <form method="post" enctype="multipart/form-data">
                                       <div class="form-group">
                                                <label for="pwd">Loại sản phẩm: </label>
                                                <select class="form-control"  name="masanpham">
                                                    <?php while($r = mysqli_fetch_assoc($gg)) { ?>
                                                        <option value=<?php echo $r['masp']; ?> ><?php echo $r['tensp']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="pwd">Image:</label>
                                                <input type="file" class="form-control-file border" name="anh">
                                            </div>

                                            <button type="submit"  class="btn btn-primary" name="add"><i class="fa fa-check" aria-hidden="true"></i>chấp nhận</button>
                                       </form>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                          
 
                                    </div>
                                </div>


                                
                                </div><br><br>
                                
                                <!--  ----------------------phân trang -------------------- -->
                                <?php 
                                    $sql_trang = $db->thucthi("SELECT * FROM `sanpham`");
                                    $row_count = mysqli_num_rows($sql_trang);
                                    // echo  ceil($row_count/3).'------'.$page;
                                    $trang = ceil($row_count/3);
                                ?>
                                <ul class="pagination">
                                    <?php for($i = 1 ; $i <= $trang; $i++) {?>
                                        <li class="page-item"><a class="page-link" href="sanpham.php?trang=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php } ?>
                                </ul>



                            </div>
                        </div>
                    </div>
                    <!-- disabled -->
<?php include_once("footer.php");  ?>