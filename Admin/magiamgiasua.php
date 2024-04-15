<?php include_once("header.php"); 
    $magiam = $_GET['key'];
    $result = $db->thucthi("SELECT * FROM `magiamgia` WHERE magiam = '$magiam'");
    $row = mysqli_fetch_array($result);

    if(isset($_POST['sua'])){
        $magia1 = $_POST['magiam'];
        $phantram = $_POST['phantram'];
        $check = $db->thucthi("UPDATE `magiamgia` SET `magiam`='$magia1',`phantram`='$phantram' WHERE magiam = '$magiam'");
        if($check){
            echo "<script>window.location.href='magiamgia.php'</script>";
        }
    }
?>
<form method="post">
<div class="form-group">
    <label for="pwd">Mã giảm</label>
    <input type="text" class="form-control"  name = "magiam" value="<?php echo $row['magiam'] ?>">
</div>
<div class="form-group">
    <label for="pwd">giảm ? %</label>
    <input type="text" class="form-control"  name = "phantram" value="<?php echo $row['phantram'] ?>">
</div>
<button type="submit"  class="btn btn-primary" name="sua"><i class="fa fa-check" aria-hidden="true"></i>chấp nhận</button>
</form>
<?php include_once("footer.php"); ?>