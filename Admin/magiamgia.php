<?php include_once("header.php"); 
    $result = $db->thucthi("SELECT * FROM `magiamgia`");
    if(isset($_POST['add'])){
        $magia = $_POST['magiam'];
        $phantram = $_POST['phantram'];
        $check = $db->thucthi("INSERT INTO `magiamgia`VALUES ('$magia','$phantram')");
        if($check){
            echo "<script>alert('theem thanh cong')</script>";
            echo "<script>window.location.href='magiamgia.php'</script>";
        }
    }
?>
<table class="table table-bordered">
    <thead>
      <tr>
        <th>mã</th>
        <th>%</th>
        <th><i class="fa fa-cogs"></i></th>
      </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($result)){  ?>
        <tr>
            <td><?php echo $row['magiam'] ?></td>
            <td><?php echo $row['phantram'] ?></td>
            <td><a href="magiamgiasua.php?key=<?php echo $row['magiam'] ?>"><i class="fa fa-wrench" style="color:darkblue"></i> </a> | 
                <a href="magiamgiaxoa.php?key=<?php echo $row['magiam'] ?>"> <i class="fa fa-trash" style="color: red;"></i></a></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        thêm mã
        </button>

    <!-- The Modal -->
    <div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- Modal body -->
        <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="pwd">Mã giảm</label>
                    <input type="text" class="form-control"  name = "magiam" >
                </div>
                <div class="form-group">
                    <label for="pwd">giảm ? %</label>
                    <input type="text" class="form-control"  name = "phantram" >
                </div>

                <button type="submit"  class="btn btn-primary" name="add"><i class="fa fa-check" aria-hidden="true"></i>chấp nhận</button>
            </form>
<?php include_once("footer.php"); ?>