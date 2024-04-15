<?php 
    include_once("header.php");
    // $db = new Database();

    $tendangnhap = isset($_GET['key'])? $_GET['key'] : '';
    $sql = "DELETE FROM `taikhoan_user` WHERE taikhoan='$tendangnhap' " ;
    $check = $db->thucthi($sql);
    $db->thucthi("DELETE FROM `lienhe` WHERE taikhoan='$tendangnhap'");
    $db->thucthi("DELETE FROM `giohang` WHERE taikhoan='$tendangnhap'");
    $db->thucthi("DELETE FROM `dathang` WHERE taikhoan_user='$tendangnhap'");
    echo"<script> window.location.href='taikhoan.php';</script>";
    if($check){
            echo "<scrip>alert('xóa thành công')</scrip>";
    }

?>