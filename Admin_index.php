<?php 

include 'inc/header.php'; //套件檔案


?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>管理員首頁</title>
</head>

<body background="background.jpg" style="background-repeat: no-repeat; background-size: 100% 100%; background-size:1920px 1080px;background-position:center 0;">
<?php include 'Admin_top_menu.php' ?>
<h2 class="text-center" style="font-weight: bold;">管理員首頁</h2>
<?php 
include 'config.php';

$count_user = "SELECT id FROM users ORDER BY id";
$query_run = mysqli_query($conn, $count_user);
$row1 = mysqli_num_rows($query_run);

$count_user = "SELECT id FROM restaurants ORDER BY id";
$query_run = mysqli_query($conn, $count_user);
$row2 = mysqli_num_rows($query_run);

$count_user = "SELECT id FROM products ORDER BY id";
$query_run = mysqli_query($conn, $count_user);
$row3 = mysqli_num_rows($query_run);

$count_order = "SELECT id FROM orders WHERE status='訂單已取消'";
$query_run = mysqli_query($conn, $count_order);
$row4 = mysqli_num_rows($query_run);

$count_order = "SELECT id FROM orders WHERE status='等待回應中'";
$query_run = mysqli_query($conn, $count_order);
$row5 = mysqli_num_rows($query_run);

$count_order = "SELECT id FROM orders WHERE status='訂單準備中'";
$query_run = mysqli_query($conn, $count_order);
$row6 = mysqli_num_rows($query_run);

$count_order = "SELECT id FROM orders WHERE status='訂單已完成'";
$query_run = mysqli_query($conn, $count_order);
$row7 = mysqli_num_rows($query_run);
	
$count_total_price = "SELECT SUM(total_price) AS sum_price FROM orders WHERE status='訂單已完成' ";
$query_run = mysqli_query($conn, $count_total_price);
while($row8 = mysqli_fetch_assoc($query_run)){
	$total_price = $row8['sum_price'];
	
}


?>
<div class="row">
	<div class="accordion accordion-flush " id="accordionFlushExample">
		<div class="accordion-item">
		    <h2 class="accordion-header" id="flush-headingOne">
		    <button class="accordion-button collapsed btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
		        <div style="font-size: 50px;"><i class="fas fa-user"></i> 用戶</div>
		    </button>
			</h2>
		    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
		      	<div class="accordion-body"><?php echo "<h1> 註冊的用戶數量: $row1</h1>"; ?></div>
		      	
		    </div>
  		</div>
  		<div class="accordion-item">
    		<h2 class="accordion-header" id="flush-headingTwo">
      		<button class="accordion-button collapsed btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        		<div style="font-size: 50px;"><i class="fa-solid fa-utensils "></i>餐廳</div>
      		</button>
    		</h2>
    		<div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      			<div class="accordion-body"><?php echo "<h1> 餐廳數量: $row2</h1>"; ?></div>
    		</div>
  		</div>
  		<div class="accordion-item">
    		<h2 class="accordion-header" id="flush-headingThree">
      		<button class="accordion-button collapsed btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        		<div style="font-size: 50px;"><i class="fas fa-shopping-cart"></i>餐點</div>
      		</button>
    		</h2>
    		<div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      			<div class="accordion-body"><?php echo "<h1> 餐點數量: $row3</h1>"; ?></div>
      			
    		</div>
  		</div>
  		<div class="accordion-item">
    		<h2 class="accordion-header" id="flush-headingFour">
      		<button class="accordion-button collapsed btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
        		<div style="font-size: 50px;"><i class="fa-solid fa-sheet-plastic"></i>訂單</div>
      		</button>
    		</h2>
    		<div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
      			<div class="accordion-body"><?php echo "<h1> 取消的訂單數量: $row4</h1>"; ?></div>
      			<div class="accordion-body"><?php echo "<h1> 等待處理的的訂單數量: $row5</h1>"; ?></div>
      			<div class="accordion-body"><?php echo "<h1> 正在處理中的訂單數量: $row6</h1>"; ?></div>
      			<div class="accordion-body"><?php echo "<h1> 已完成的訂單數量: $row7</h1>"; ?></div>
      			<div class="accordion-body"><?php echo "<h1> 總營收: NT$$total_price</h1>"; ?></div>
    		</div>
  		</div>
  	</div>
</div>
  



</body>
</html>