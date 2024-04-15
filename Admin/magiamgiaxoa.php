<?php 
    include_once("header.php");
    // $db = new Database();

    $magiam = isset($_GET['key'])? $_GET['key'] : '';
    $sql = "DELETE FROM `magiamgia` WHERE magiam='$magiam' " ;
    $check = $db->thucthi($sql);
    echo"<script> window.location.href='magiamgia.php';</script>";
    if($check){
            echo "<scrip>alert('xóa thành công')</scrip>";
    }

?>