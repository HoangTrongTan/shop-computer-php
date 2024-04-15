<?php include_once("header.php") ?>
<?php 
    $magiohang = $_GET['magiohang'];
    $db->thucthi("DELETE FROM `dathang` WHERE magiohang = $magiohang");
    echo "<script>alert('xóa thành công')</script>";
    echo "<script>window.location.href='danhsachdathang.php'</script>";
?>