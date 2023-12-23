<?php 
include 'inc/header.php'; 

include 'config.php'; //連結資料庫

$count_order = "SELECT id FROM orders WHERE status='訂單已取消'";
$query_run = mysqli_query($conn, $count_order);
$row = mysqli_num_rows($query_run);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>取消的訂單</title>
	<style>

	.back-to-top {

	display: none; /* 默認是隱藏的，這樣在第一屏才不顯示 */
	position: fixed; /* 位置是固定的 */

	bottom: 20px; /* 顯示在頁面底部 */

	right: 30px; /* 顯示在頁面的右邊 */

	z-index: 99; /* 確保不被其他功能覆蓋 */

	border: 1px solid #ff8c00; /* 顯示邊框 */

	outline: none; /* 不顯示外框 */

	background-color: #fff; /* 設置背景背景顏色 */

	color: #ff8c00; /* 設置文本顏色 */

	cursor: pointer; /* 滑鼠移到按鈕上顯示手型 */

	padding: 10px 15px 15px 15px; /* 增加一些內邊距 */

	border-radius: 10px; /* 增加圓角 */

	}

	.back-to-top:hover {

	background-color: #ff8c00; /* 滑鼠移上去時，反轉顏色 */
	color: #fff;

	}

	</style>
</head>
<body background="background.jpg" style="background-repeat: no-repeat; background-size: 100% 100%; background-size:1920px 1080px;
background-position:center 0;">
	
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mt-5">
            <div class="card-header">
                <h1 class="text-center">取消的訂單共<i class="text-info"><?php echo $row;?></i> 筆</h1>
            </div>
            <div class="card-body">
				<div class="row">
					<div class="col-md-8">
                        <div class="form-group">
                            <div class="btn-group">
								<button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">訂單分類</button>
								<ul class="dropdown-menu">
											    
    								<li><a class="dropdown-item" href="Admin_check_order.php">查看訂單</a></li>
    								<li><hr class="dropdown-divider"></li>
									<li><a class="dropdown-item" href="pending_order.php">等待處理的訂單</a></li>
									<li><a class="dropdown-item" href="processing_order.php">正在處理中的訂單</a></li>
									<li><a class="dropdown-item" href="completed_order.php">完成的訂單</a></li>
								</ul>
							</div>
                        </div>
                    </div>
                </div>
                        
            </div>
        </div>
<div class="table-responsive">
<table class="table table-bordered" style="background-color: white;">
	<thead class="table-dark">
		<tr>
			<th> <i style="font-size:20px"></i>訂單ID</th>
			<th> <i class="fas fa-user" style="font-size:20px"></i>名字</th>
			<!--
			<th> <i class="fas fa-phone" style="font-size:20px"></i>電話號碼</th>
		-->
			<th> <i class="fas fa-receipt" style="font-size:20px"></i>訂單品項</th>
			<th> <i class="fas fa-sack-dollar" style="font-size:20px"></i>訂單總金額</th>
			<th> <i class="fas fa-clock" style="font-size:20px"></i>訂餐時間</th>
		</tr>
	</thead>

<?php

$select_order = mysqli_query($conn, "SELECT * FROM `orders` where status='訂單已取消' ORDER BY id DESC");
if($select_order)
{
	while($fetch_order =mysqli_fetch_array($select_order))
	{		
	?>	
	<tbody>
		<tr>
			<th><?php echo $fetch_order['id']; ?></th>
			<th><?php echo $fetch_order['name']; ?></th>
			<!--
			<th><?php echo $fetch_order['phone']; ?></th>
		-->
			<th><?php echo $fetch_order['total_products']; ?></th>
			<th>NT$<?php echo $fetch_order['total_price']; ?></th>
			<th><?php echo $fetch_order['order_time']; ?></th>
			
		</tr>
	</tbody>
<?PHP
	}	
}
else
{
	echo "沒有訂單紀錄";
}

?>
</table>
</div>
<button class="js-back-to-top back-to-top" title="回到頂部">&#65085;</button>

<script src="https://cdn.staticfile.org/jquery/2.2.4/jquery.min.js"></script>

<script>

$(function () {

var $win = $(window);

var $backToTop = $('.js-back-to-top');

// 當用戶滾動到離頂部100像素時，顯示回到頂部按鈕

$win.scroll(function () {

if ($win.scrollTop() > 100) {

$backToTop.show();

} else {

$backToTop.hide();

}

});

// 當用戶點擊按鈕時，通過動畫效果返回頭部

$backToTop.click(function () {

$('html, body').animate({scrollTop: 0}, 200);

});

});

</script>
</body>
</html>