<?php include_once("header.php") ?>
<?php 

		$id = $_GET['id'];
		$check = $db->thucthi("DELETE  FROM `giohang` WHERE id = '$id'");
        if(!$check){
            echo '<script>alert("xóa không thành công")</script>';
        }else{
            echo "<script>window.location.href='giohang.php'</script>";
        }
?>