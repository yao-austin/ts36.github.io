<?php 

include 'inc/header.php'; //套件檔案


?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>所有會員</title>
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
	<h2 class="text-center" style="font-weight: bold;"><i class="fa-solid fa-user"></i>所有用戶</h2>
<?php

include 'config.php'; //連結資料庫
session_start();

$select = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');


?>
<div class="table-responsive">
<table class="table table-bordered" style="background-color: white;">
	<thead class="table-dark">
		<tr>
			<th> <i class="fas fa-id-card" style="font-size:25px"></i>ID</th>
			<th> <i class="fas fa-user" style="font-size:25px"></i>名字</th>
			<th> <i class="fas fa-envelope" style="font-size:25px"></i>Email</th>
			<th> <i class="fas fa-phone" style="font-size:25px"></i>電話號碼</th>
		</tr>
	</thead>
<?php
if($select)
{
	while($row =mysqli_fetch_array($select))
	{		
	?>
					
	<tbody>
		<tr>
			<th><?php echo $row['id']; ?></th>
			<th><?php echo $row['name']; ?></th>
			<th><?php echo $row['email']; ?></th>
			<th><?php echo $row['phone']; ?></th>
		</tr>
	</tbody>
<?PHP
	}	
}
else
{
	echo "沒有資料";
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