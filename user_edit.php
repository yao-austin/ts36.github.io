<?php 
include 'inc/header.php'; 
session_start();
include 'config.php';

$id = $_GET['id'];
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];

	$query = "UPDATE `users` SET `name`='$name',`email`='$email',`phone`='$phone' WHERE id='$id' ";
	$update_user_info = mysqli_query($conn,$query);
	if($update_user_info){
		echo "<script>alert('帳號資訊修改成功!!!'); location.href = 'user_info.php';</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>修改個人資訊</title>
</head>
<body background="background.jpg" style="background-repeat: no-repeat; background-size: 100% 100%; background-size:1920px 1080px;background-position:center 0;">
<?php 
include 'user_top_menu.php'; 

$query = "SELECT * FROM `users` WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

?>


	<div class="container d-flex justify-content-center align-items-center">
             
          <div class="card">

              	<div class="upper">

                	<img src="images/user_background.jpg" class="img-fluid" style="height: 350px; width: 750px;">
                
              	</div>
              	<!--
              	<div class="user text-center">

                	<div class="profile">
                  		<img src="images/頭像.jpg" class="rounded-circle" width="150">
                	</div>

              	</div>
				-->
              	<div class="text-center ">
					<h2 style="color: gold; font-size: 45px;"><i class="fas fa-user"></i>修改個人資訊</h2>
				</div>

              	<div class="mt-5 ">
					<form action="" method="post" >
						<div class="mb-3">
							<label class="form-label" style="font-size: 30px; color: cornflowerblue;">名字:</label>
							<input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>" style="height: 50px; ">
						</div>
						<div class="mb-3">
							<label class="form-label" style="font-size: 30px; color:springgreen;">Email:</label>
							<input type="text" class="form-control" name="email" value="<?php echo $row['email'] ?>" style="height: 50px; " >
						</div>
						<div class="mb-3">
							<label class="form-label" style="font-size: 30px; color:orange;">電話號碼:</label>
							<input type="text" class="form-control" name="phone" value="<?php echo $row['phone'] ?>" style="height: 50px; ">
						</div>

						<button type="submit" class="btn btn-success" name="submit">更新</button>
						<a href="user_info.php" class="btn btn-danger">取消</a>
					</form>	
                    
                   	
          	</div>
               
     	</div>

     </div>	

</body>
</html>