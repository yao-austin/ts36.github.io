<?php

include 'config.php';
include 'inc/header.php';

if(isset($_POST['add_product'])){

   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_category = $_POST['p_category'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = $p_image;
   

   $insert_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image, category) VALUES('$p_name', '$p_price', '$p_image', '$p_category')") or die('query failed');

    if($insert_query){
       move_uploaded_file($p_image_tmp_name, $p_image_folder);
       $alert = "餐點新增成功";
       echo "<script type='text/javascript'>alert('$alert');</script>";
    }else{
	   $alert = "無法新增餐點";
	   echo "<script type='text/javascript'>alert('$alert');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>管理員編輯餐點</title>
	
</head>

<body background="background.jpg" style="background-repeat: no-repeat; background-size: 100% 100%; background-size:1920px 1080px;background-position:center 0;">
	<div class="container">
		<h1 class="text-center" style="font-weight: bold;"><i class="fas fa-plus"></i>新增餐點</h1>
        <div class="container d-flex justify-content-center align-items-center">
	      	<form action="" method="post" enctype="multipart/form-data">
	         	<div class="card" style="width: 25rem;">
		            <div class="card-body">
		               <input type="text" name="p_name" placeholder="輸入餐點名稱" class="form-control" style="margin-bottom: 1rem;" required >
					   	<input type="number" name="p_price" min="0" placeholder="輸入餐點價格" class="form-control" style="margin-bottom: 1rem;" required>
					   	<input type="text" name="p_category" placeholder="輸入餐廳名字" class="form-control" style="margin-bottom: 1rem;" required>
					   	<input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="form-control" style="margin-bottom: 1rem;" required>
			
					   	<input type="submit" value="加入" name="add_product" class="btn btn-outline-primary ">
					   	<a href="Admin_check_product.php" class="btn btn-outline-warning">返回</a>
		               	
		   
		            </div>
		        </div>
	         	
	   
	      	</form>
	  	</div>
	</div>
	

</body>
</html>