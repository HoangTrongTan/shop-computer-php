<?php include_once("header.php"); ?>
<?php 
    $resulul = $db->thucthi("SELECT * FROM `dathang`");

?>
<div class="container">          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>thông tin giỏ hàng</th>
        <th>sản phẩm</th>
        <th>ngày đặt</th>
        <th>Tổng tiền</th>
        <th></th>
        <th><i class="fa fa-cogs"></i></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
      </tr>
    </tbody>
  </table>
</div>

<?php include_once("footer.php") ?>
