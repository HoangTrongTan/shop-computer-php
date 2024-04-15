<?php include_once("header.php"); 
      $giatien = 0;
      $soluong = 1;
      echo $_SESSION['cong'] = 0;
      
      

      $result = $db->thucthi("SELECT * FROM `order` WHERE id = 90");
      $r_order = mysqli_fetch_array($result); 
      
      if(isset($_POST['tru'])){
        // if($r_order['soluong'] > 0){
          $_SESSION['cong'] --;
        // }
      }
      if(isset($_POST['cong'])){
        // if($soluong < 5){
          $_SESSION['cong'] ++;
        // }
      }
?>

<div style="width:210px; height: 310px;" class="grid_1_of_4 images_1_of_4">
  <a  href="chitietSP.php?masp=<?php echo $r_order['masp']; ?>"><img style="width:160px; height:110px;" src="../../upload/<?php echo $r_order['anh'] ?>"  /></a>
  <h2 ><?php $ten = $r_order['tensp']; echo (strlen($ten) > 20) ? substr($ten,0,20).'...' : $ten;  ?></h2>
<div class="price-details">
  <form method="post"> 
    <h6><input type="submit" value=" - " name="tru"><?php echo $_SESSION['cong']; ?> <input type="submit" value=" + " name="cong"></h6>
  </form>
<h6><span class="rupees"> giá: <?php   $gia = $r_order['thanhtien']; echo number_format($gia); ?> $</h6>  
</div>       		
</div> 
<br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>


<?php include_once("footer.php"); ?>



