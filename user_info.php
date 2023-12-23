<?php 

include 'inc/header.php'; //套件檔案
session_start();
include 'config.php'; //連結資料庫


?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>用戶資訊</title>

</head>
<body background="background.jpg" style="background-repeat: no-repeat; background-size: 100% 100%; background-size:1920px 1080px;background-position:center 0;">

<?php include 'user_top_menu.php'; ?>

<?php
$user_id = $_SESSION['user_id'];
$select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');

if(mysqli_num_rows($select) > 0){
     $row = mysqli_fetch_assoc($select);
     ?>
     
	<div class="container d-flex justify-content-center align-items-center">
          <div class="card">
              	<div class="upper">
				<img src="images/user_background.jpg" class="img-fluid" style="height: 350px; width: 750px;">
              	</div>

              	<div class="user text-center">
				<div class="profile">
					<img src="images/頭像.jpg" class="rounded-circle" width="150">
                	</div>
              	</div>
              	<div class="mt-5 text-center">
              		<h1 class="mb-0" style="color:gold;"><i class="fas fa-user"></i> 個人檔案</h1>
              		<h2 class="mb-0" style="color:cornflowerblue;">ID: <?php echo $row['id']; ?></h2>
                	<h2 class="mb-0" style="color:midnightblue;">名字: <?php echo $row['name']; ?></h2>
                    <h2 class="mb-0" style="color:springgreen;">Email: <?php echo $row['email']; ?></h2>
                    <h2 class="mb-0" style="color:orange;">電話號碼: <?php echo $row['phone']; ?></h2>
                
                   
          	</div>
     	</div>

     </div>
<?php
}
		
else{
	header('location:please_login.php');
}

?>

</body>
</html>