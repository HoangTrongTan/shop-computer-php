<?php include_once("header.php");  ?>
<?php
$sql = "SELECT * FROM `taikhoan_user`"; 
$result =  $db->thucthi($sql);
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
                                            <th>Tên đăng nhập</th>
                                            <th>mật khẩu</th>
                                            <th>tên tài khoản</th>
                                            <th><i class="fa fa-cogs"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_assoc($result)){  ?>
                                        <tr>
                                            <td><?php echo $row['taikhoan'] ?></td>
                                            <td><?php echo $row['matkhau_user'] ?></td>
                                            <td><?php echo $row['tenkhachhang'] ?></td>
                                            <td><a href="taikhoan_edit.php?key=<?php echo $row['taikhoan'] ?>"><i class="fa fa-wrench" style="color:darkblue"></i> </a> | 
                                            <a onclick="return confirm('bạn có chắc muốn xóa')" href="taikhoan_delete.php?key=<?php echo $row['taikhoan'] ?>"> <i class="fa fa-trash" style="color: red;"></i></a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <!-- <a href="../LoaiSP/SanPham/login_user.php"  class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</a> -->
                            </div>
                        </div>
                    </div>
                    <!-- disabled -->
                    <!-- alert(); -->
<!-- window.location.href='' -->
<?php include_once("footer.php");  ?>