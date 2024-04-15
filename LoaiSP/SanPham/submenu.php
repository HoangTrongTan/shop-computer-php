<?php 
                        $sql = "SELECT * FROM `loaisanpham`";
                        $result = $db->thucthi($sql);
                    ?>
<div class="header_bottom_left">				
				<div class="categories">
				  <ul>
				  	<h3>Loại sản phẩm</h3>
                    <?php while($row = mysqli_fetch_assoc($result) ){ ?>
				      <li><a href="index.php?masp=<?php echo $row['maloai'] ?>"><?php echo $row['tenloai']; ?></a></li>
                      <?php } ?>
				  </ul>
				</div>					
	  	     </div>