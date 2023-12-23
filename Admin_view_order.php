<?php

include 'config.php';
include 'inc/header.php';

?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>查看訂單明細</title>
</head>
<body background="background.jpg" style="background-repeat: no-repeat; background-size: 100% 100%; background-size:1920px 1080px;background-position:center 0;">
	<h1 class="text-center" style="font-weight: bold;"><i class="fas fa-list"></i>訂單明細</h1>
        <?php
   
   		if(isset($_GET['view_detail'])){
	      	$view_id = $_GET['view_detail'];
	      	$view_order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE id = $view_id");
	      	if(mysqli_num_rows($view_order_query) > 0){
	         	while($fetch_order_detail = mysqli_fetch_assoc($view_order_query)){
	      	?>
	      	<div class="container d-flex justify-content-center align-items-center">
	         	<div class="card" style="width: 30rem;">
	            	<img src="images/訂單.jpg" class="card-img-top" alt="...">
		            <div class="card-body">
		               	<div class="mb-3">
		               		<label style="font-size: 25px">訂餐人名字 </label>
		               		<h3><?php echo $fetch_order_detail['name']; ?></h3>
		               	</div>
		               	<div class="mb-3">
		               		<label style="font-size: 25px">訂餐人電話 </label>
		               		<h3><?php echo $fetch_order_detail['phone']; ?></h3>
		               	</div>
		               	<div class="mb-3">
		               		<label style="font-size: 25px">訂單品項 </label>
		               		<h3 ><?php echo $fetch_order_detail['total_products']; ?></h3>
		               	</div>
		               	<div class="mb-3">
		               		<label style="font-size: 25px">訂單總金額 </label>
		               		<h3>NT$<?php echo $fetch_order_detail['total_price']; ?></h3>
		               	</div>
		               	<div class="mb-3">
		               		<label style="font-size: 25px">訂餐時間 </label>
		               		<h3><?php echo $fetch_order_detail['order_time']; ?></h3>
		               	</div>
		               	
		               	<input type="reset" value="返回" id="close-edit" class="btn btn-warning" onclick="location.href='Admin_check_order.php'" >
		               </div>
		            </div>
	         	</div>
	   
	      	</form>
	  		</div>
	       <?php
               };
            };
            echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
         };
      ?>

</section>

<!-- js檔案連結  -->
<script src="script.js"></script>
</body>
</html>