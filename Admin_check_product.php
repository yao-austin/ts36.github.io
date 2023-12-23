<?php

include 'config.php';
include 'inc/header.php';

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:Admin_check_product.php');
      $message[] = 'product has been deleted';
   }else{
      header('location:Admin_check_product.php');
      $message[] = 'product could not be deleted';
   };
};

?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>管理餐點列表</title>
   
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

<div class="container">
   <a href="Admin_add_product.php" class="btn btn-warning"><span class="spinner-border spinner-border-sm"></span>新增餐點</a>
   <h1 class="text-center" style="font-weight: bold;"><i class="fa-solid fa-utensils"></i>所有餐點</h4>
   <div class="table-responsive">
   <table class="table" style="text-align:center;">

      <thead class="table-dark">
         <th>餐點圖片</th>
         <th>餐點名稱/餐廳</th>
         <th>餐點價格</th>
         <th>編輯/刪除</th>
      </thead>

      <tbody>
         <?php
         
            $select_products = mysqli_query($conn, "SELECT * FROM `products`");
            if(mysqli_num_rows($select_products) > 0){
               while($fetch_product = mysqli_fetch_assoc($select_products)){
         ?>
         <tr>
            <tr>
               <td rowspan="2" align='center' valign="middle"><img src="<?php echo $fetch_product['image']; ?>" height="100" width="120" alt=""></td>
               <td align='center' valign="middle" height="90"><?php echo $fetch_product['name']; ?></td>
               <td rowspan="2" align='center' valign="middle">NT$<?php echo $fetch_product['price']; ?>/-</td>
               <td rowspan="2" align='center' valign="middle">
                  <a href="Admin_edit_product.php?edit=<?php echo $fetch_product['id']; ?>" class="btn btn-outline-primary "> <i class="fas fa-edit"></i> 編輯 </a>
                  <a href="Admin_check_product.php?delete=<?php echo $fetch_product['id']; ?>" class="btn btn-outline-danger" onclick="return confirm('確定要刪除此餐點');"> <i class="fas fa-trash"></i> 刪除 </a>
            
               </td>
            </tr>
            <tr>
               <td align='center' valign="middle" height="90"><?php echo $fetch_product['category']; ?></td>
            </tr>
            <tr>
               
            </tr>

         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>沒有加入餐點</div>";
            };
         ?>
      </tbody>
   </table>

   </div>

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