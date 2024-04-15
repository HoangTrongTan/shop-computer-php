<?php include_once("header_chitiet.php");
        $id = $_GET['id'];
        $xoa = $db->thucthi("DELETE FROM `order` WHERE id = '$id'");
        if($xoa){
            echo "<script>alert('xóa thành công')</script>";
            echo "<script>window.location.href='hoadon.php' </script>";
        }
?>