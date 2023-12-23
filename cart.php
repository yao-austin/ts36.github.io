<?php

include 'inc/header.php';
session_start();
include 'config.php';


if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:cart.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:cart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:cart.php');
}



?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>購物車</title>
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

<?php include 'user_top_menu.php'?>

<div class="container">
   
      <?php
            
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>
            
      <h1 class="text-center text-primary" style="font-weight: bold;"><i class="fas fa-shopping-cart"></i>我的購物車<span> (<?php echo $row_count; ?>樣餐點)</span></h1>
      <?php
      if($row_count == 0){
         ?>
         <h1 class="text-center" style="color:darkred;">您的購物車是空的!!! 請選擇餐點~<input type="button" class="btn-warning" value="菜單" onclick="location.href='food_order.php'"></h1>
         <?php
      }
      else{
      ?> 
      <div class="col-md-12 text-center table-responsive">
         
         <table class="table">
            <thead>
               <tr>
                  <th scope="col">餐點照片</th>
                  <th scope="col">餐點名稱</th>
                  <th scope="col">餐點價格</th>
                  <th scope="col">餐點數量</th>
                  <th scope="col">餐點總金額</th>
                  <th scope="col">編輯</th>
               </tr>
            </thead>
            <tbody>
         <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><img src="<?php echo $fetch_cart['image']; ?>" height="100" width="150" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>NT$<?php echo number_format($fetch_cart['price']); ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="修改" name="update_update_btn" class="btn btn-warning">
               </form>   
            </td>
            <td>NT$<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('確定要移除此餐點?')" class="btn btn-danger"> <i class="fas fa-trash"></i> 移除</a></td>

         </tr>
         <?php
            };
         };
         $count_grand_total = "SELECT SUM(price*quantity) AS sum_price FROM `cart` ";
         $query_run = mysqli_query($conn, $count_grand_total);
         while($row = mysqli_fetch_assoc($query_run)){
            $grand_total = $row['sum_price'];
         }
         ?>

         <tr class="table-bottom">
            <td><a href="food_order.php" class="btn btn-warning" style="margin-top: 0;">繼續點餐</a></td>
            <td colspan="3">訂單總金額</td>
            <td>NT$<?php echo $grand_total; ?>/-</td> 
            <td><a href="cart.php?delete_all" onclick="return confirm('確定要清空購物車嗎?');" class="btn btn-danger"> <i class="fas fa-trash"></i> 清空購物車 </a></td>
         </tr>
            </tbody>
         </table>
      
      </div> 
   </div>
   <div class="row">
      <div style="text-align:center;">
      <input type="button" value="確認餐點" style="width:120px;height:40px;font-size:20px;" class="btn btn-success" onclick="location.href='checkout.php'">
      
      </div>
   </div>
   
   
   
   <?php

   }
   ?>
   
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