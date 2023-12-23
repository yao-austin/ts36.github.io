<?php 

include 'inc/header.php'; //套件檔案

?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="manifest" href="manifest.json">
	<title>訂餐首頁</title>
</head>
<body background="background.jpg" style="background-repeat: no-repeat; background-size: 100% 100%; background-size:1920px 1080px;
background-position:center 0;">

<?php include 'user_top_menu.php'; ?>

<h1 class="text-info text-center" style="font-weight: bold;"><i class="fas fa-cutlery"></i>歡迎來到學餐訂餐系統</h1>
<?php

include 'config.php'; //連結資料庫


$select = mysqli_query($conn, "SELECT * FROM `restaurants`") or die('query failed');
?>
<div class="table-responsive">
	<table class="table table-bordered" style="background-color: white;">
		<thead class="table-dark">
			<tr>
				<th> 餐廳id</th>
				<th> 餐廳名稱</th>
				<th> <i class="fas fa-map-marker-alt"  style="font-size:25px"></i>餐廳地點</th>
			</tr>
		</thead>
	<?php
	if($select)
	{
		while($fetch_restaurant =mysqli_fetch_array($select))
		{		
		?>			
		<tbody>
			<tr>
				<th><?php echo $fetch_restaurant['id']; ?></th>
				<th><?php echo $fetch_restaurant['name']; ?></th>
				<th><?php echo $fetch_restaurant['location']; ?></th>
			</tr>
		</tbody>
	<?PHP
		}	
	}

	?>
	</table>
</div>
<figure class="figure">
  <img src="輔大校園地圖.jpg" class="figure-img img-fluid rounded" height="200" width="1400" alt="...">
</figure>

</body>
</html>