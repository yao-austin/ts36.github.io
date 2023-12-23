<?php include 'inc/header.php'; ?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>搜尋訂單</title>
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

<body background="background.jpg" style="background-repeat: no-repeat; background-size: 100% 100%; background-size:1920px 1080px;background-position:center 0;">
<?php include 'Admin_top_menu.php' ?>
 	
            <div class="card  text-center" style="font-weight: bold;">
                <div class="card-body">
                	<h4 class="card-title"><i class="fa fa-search" aria-hidden="true"></i>搜尋訂單</h4>
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    	
                                    <button type="submit" class="btn btn-primary">搜尋</button>
                            		<div class="btn-group">
										<button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
											    訂單分類
										</button>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="canceled_order.php">取消的訂單</a></li>
											<li><a class="dropdown-item" href="pending_order.php">等待處理的訂單</a></li>
											<li><a class="dropdown-item" href="processing_order.php">正在處理中的訂單</a></li>
											<li><a class="dropdown-item" href="completed_order.php">已完成的訂單</a></li>
										</ul>
									</div>
                                </div>
                            </div>
                                
                        </div>
                    </form>
                </div>
            </div>
        
	
<?php

include 'config.php'; //連結資料庫

if(isset($_GET['accept'])){

    $update_id = $_GET['accept'];
    $update_query = mysqli_query($conn, "UPDATE `orders` SET status = '訂單準備中' WHERE id = '$update_id'");
    
};
if(isset($_GET['complete'])){

	$update_id = $_GET['complete'];
	$update_query = mysqli_query($conn, "UPDATE `orders` SET status = '訂單已完成' WHERE id = '$update_id'");
	
};
if(isset($_GET['cancel'])){

	$update_id = $_GET['cancel'];
	$update_query = mysqli_query($conn, "UPDATE `orders` SET status = '訂單已取消' WHERE id = '$update_id'");
	
};


?>
<div class="table-responsive">
<table class="table table-bordered" style="background-color: white;">
	<thead class="table-dark">
		<tr>
			<th>訂單ID</th>

			<th> <i class="fas fa-user" ></i>訂餐人名字</th>
			<!--
			<th> <i class="fas fa-phone" ></i>訂餐人電話</th>
			-->
			<th> <i class="fas fa-receipt"></i>訂單品項</th>
			<th> <i class="fas fa-sack-dollar"></i>訂單金額</th>
			<th> <i class="fas fa-clock" ></i>訂餐時間</th>
			<th> <i class="fas fa-spinner fa-pulse" style="font-size:20px"></i>訂單狀態</th>
			<th> <i class="fas fa-edit" style="font-size:20px"></i>訂單編輯</th>
		</tr>
	</thead>

<?php
if(isset($_GET['from_date']) && isset($_GET['to_date']))
{
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];

    $query = "SELECT * FROM `orders` WHERE order_time BETWEEN '$from_date' AND '$to_date' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        while($fetch_order=mysqli_fetch_array($query_run))
        {
            ?>
            <tr>
				<th><?php echo $fetch_order['id']; ?></th>
				<th><?php echo $fetch_order['name']; ?></th>
				<!--
				<th class="d-block"><div><?php echo $fetch_order['phone']; ?></div></th>
				-->
				<th><?php echo $fetch_order['total_products']; ?></th>
				<th>NT<?php echo $fetch_order['total_price']; ?></th>
				<th><?php echo $fetch_order['order_time']; ?></th>
				<th><?php echo $fetch_order['status']; ?></th>
				<th>
					<a href="Admin_check_order.php?complete=<?php echo $fetch_order['id']; ?>" class="btn btn-outline-success" onclick="return confirm('確定要更改訂單資訊?')">  完成訂單</a>
					<a href="Admin_check_order.php?accept=<?php echo $fetch_order['id']; ?>" class="btn btn-outline-warning" onclick="return confirm('確定要更改訂單資訊?')">  接受訂單</a>
					<a href="Admin_check_order.php?cancel=<?php echo $fetch_order['id']; ?>" class="btn btn-outline-danger" onclick="return confirm('確定要更改訂單資訊?')">  取消訂單</a>
				</th>
      		</tr>
            <?php
        }
    }
	else
	{
	    ?><h1 class="text-center">找不到訂單</h1>
	    <?php
	}
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