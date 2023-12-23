<?php

include 'config.php';
include 'inc/header.php';

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_category = $_POST['update_p_category'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = $update_p_image;

   $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price',image = '$update_p_image',category= '$update_p_category' WHERE id = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $alert = "餐點資訊修改成功";
      echo "<script type='text/javascript'>alert('$alert');</script>";
      
   }else{
      $alert = "餐點資訊修改失敗";
      echo "<script type='text/javascript'>alert('$alert');</script>";
      
   }
   
}

?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>管理員編輯餐點</title>
	
</head>

<body background="background.jpg" style="background-repeat: no-repeat; background-size: 100% 100%; background-size:1920px 1080px;background-position:center 0;">
		<h1 class="text-center" style="font-weight: bold;"><i class="fas fa-edit"></i>編輯餐點</h1>
        <?php
   
   		if(isset($_GET['edit'])){
	      	$edit_id = $_GET['edit'];
	      	$edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
	      	if(mysqli_num_rows($edit_query) > 0){
	         	while($fetch_edit = mysqli_fetch_assoc($edit_query)){
	      	?>
	      	<div class="container d-flex justify-content-center align-items-center">
	      	<form action="" method="post" enctype="multipart/form-data">
	         	<div class="card" style="width: 25rem;">
	            	<img src="<?php echo $fetch_edit['image']; ?>" class="card-img-top" alt="...">
		            <div class="card-body">
		            	
		               	<input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
		               	<div class="mb-3">
		               		<label style="font-size: 25px">餐點名稱 </label>
		               		<input type="text" class="form-control" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
		               	</div>
		               	<div class="mb-3">
		               		<label style="font-size: 25px">餐點價格 </label>
		               		<input type="number" min="0" class="form-control" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
		               	</div>
		               	<div class="mb-3">
		               		<label style="font-size: 25px">餐廳名字 </label>
		               		<input type="category" min="0" class="form-control" required name="update_p_category" value="<?php echo $fetch_edit['category']; ?>">
		               	</div>
		               	<div class="mb-3">
		               		<input type="file" class="form-control" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
		               	</div>
		               	<input type="submit" value="更新" name="update_product" class="btn btn-success ">
		               	<input type="reset" value="取消" id="close-edit" class="btn btn-warning" onclick="location.href='Admin_check_product.php'" >
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

</body>
</html>