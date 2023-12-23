<?php

include 'inc/header.php'; 
session_start();
include 'config.php';
if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      // Sending Alert message using PHP variable.
      $alert = "此餐點已在購物車中";
      echo "<script type='text/javascript'>alert('$alert');</script>";
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      // Sending Alert message using PHP variable.
      $alert = "餐點成功加入到購物車";
      echo "<script type='text/javascript'>alert('$alert');</script>";
   }

}

?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>點餐</title>
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
   
   <nav id="navbar-example2" class="navbar navbar-light bg-light px-3">
      <b style="font-size: 30px; color: indigo;">菜單</b>
      <ul class="nav nav-pills">
         <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">輔園</a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#scrollspyHeading1">八方雲集</a></li>
        <li><a class="dropdown-item" href="#scrollspyHeading2">雲瀚哨子麵</a></li>
      </ul>
      </li>
      <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">心園</a>
         <ul class="dropdown-menu">
           <li><a class="dropdown-item" href="#scrollspyHeading3">巧瑋鬆餅屋</a></li>
         </ul>
      </li>
      <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">理園</a>
         <ul class="dropdown-menu">
           <li><a class="dropdown-item" href="#scrollspyHeading4">阿珠媽</a></li>
           <li><a class="dropdown-item" href="#scrollspyHeading5">熊賀炒飯</a></li>
         </ul>
      </li>

      <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">仁園</a>
         <ul class="dropdown-menu">
           <li><a class="dropdown-item" href="#scrollspyHeading6">快餐</a></li>
         </ul>
      </li>
      <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">文園</a>
         <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#scrollspyHeading7">綠豆冰沙</a></li>
            <li><a class="dropdown-item" href="#scrollspyHeading8">趙班長海苔飯捲</a></li>
            <li><a class="dropdown-item" href="#scrollspyHeading9">COMEBUY</a></li>
         </ul>
      </li>
      <li class="nav-item">
         <?php
      
         $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
         $row_count = mysqli_num_rows($select_rows);

         ?>
         <a class="nav-link active" aria-current="page" href="cart.php"><i class="fa-solid fa-cart-shopping"></i>
         <span><?php echo $row_count; ?></span>
         </a>
      </li>
  </ul>

</nav>
<h1 class="text-center" style="font-weight: bold;"><i class="fas fa-cutlery"></i>立即點餐</h1>
<hr size="15px" align="center" width="100%">
<div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example" tabindex="0">
   <h2 id="scrollspyHeading1" class="text-center" style="color: darkred;">八方雲集</h2>
   <div class="row">
      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category='八方雲集'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
         ?>
         <div class="col-md-4 text-center">
            <div class="card" style="width: 22rem;">
               <form action="" method="post">
                  <img src="<?php echo $fetch_product['image']; ?>" class="card-img-top" alt="..." height="300">
                  <div class="card-body">
                     <h4> 餐點名稱: <?php echo $fetch_product['name']?></h4>
                     <h4> 餐點價格: NT$<?php echo $fetch_product['price']?>/-</h4>
                     <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                     <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                     <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                     <input type="submit" class="btn btn-primary" value="加入購物車" name="add_to_cart">
                  </div>
               </form>
            </div>
         </div>
         <?php
         };
      };
      ?>
         
   </div>
   <hr size="15px" align="center" width="100%">
   <h2 id="scrollspyHeading2" class="text-center" style="color: darkred;">雲瀚哨子麵</h2>
   <div class="row">
   <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category='雲瀚哨子麵'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
         ?>
         <div class="col-md-4 text-center">
            <div class="card" style="width: 22rem;">
               <form action="" method="post">
                  <img src="<?php echo $fetch_product['image']; ?>" class="card-img-top" alt="..." height="300">
                  <div class="card-body">
                     <h4> 餐點名稱: <?php echo $fetch_product['name']?></h4>
                     <h4> 餐點價格: NT$<?php echo $fetch_product['price']?>/-</h4>
                     <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                     <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                     <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                     <input type="submit" class="btn btn-primary" value="加入購物車" name="add_to_cart">
                  </div>
               </form>
            </div>
         </div>
         <?php
         };
      };
      ?>
         
   </div>
   <hr size="15px" align="center" width="100%">
   <h2 id="scrollspyHeading3" class="text-center" style="color: darkred;">巧瑋鬆餅屋</h2>
   <div class="row">
   <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category='巧瑋鬆餅屋'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
         ?>
         <div class="col-md-4 text-center">
            <div class="card" style="width: 22rem;">
               <form action="" method="post">
                  <img src="<?php echo $fetch_product['image']; ?>" class="card-img-top" alt="..." height="300">
                  <div class="card-body">
                     <h4> 餐點名稱: <?php echo $fetch_product['name']?></h4>
                     <h4> 餐點價格: NT$<?php echo $fetch_product['price']?>/-</h4>
                     <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                     <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                     <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                     <input type="submit" class="btn btn-primary" value="加入購物車" name="add_to_cart">
                  </div>
               </form>
            </div>
         </div>
         <?php
         };
      };
      ?>
         
   </div>
   <hr size="15px" align="center" width="100%">
   <h2 id="scrollspyHeading4" class="text-center" style="color: darkred;">阿珠媽</h2>
   <div class="row">
   <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category='阿珠媽'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
         ?>
         <div class="col-md-4 text-center">
            <div class="card" style="width: 22rem;">
               <form action="" method="post">
                  <img src="<?php echo $fetch_product['image']; ?>" class="card-img-top" alt="..." height="300">
                  <div class="card-body">
                     <h4> 餐點名稱: <?php echo $fetch_product['name']?></h4>
                     <h4> 餐點價格: NT$<?php echo $fetch_product['price']?>/-</h4>
                     <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                     <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                     <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                     <input type="submit" class="btn btn-primary" value="加入購物車" name="add_to_cart">
                  </div>
               </form>
            </div>
         </div>
         <?php
         };
      };
      ?>
         
   </div>
   <hr size="15px" align="center" width="100%">
   <h2 id="scrollspyHeading5" class="text-center" style="color: darkred;">熊賀炒飯</h2>
   <div class="row">
   <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category='熊賀炒飯'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
         ?>
         <div class="col-md-4 text-center">
            <div class="card" style="width: 22rem;">
               <form action="" method="post">
                  <img src="<?php echo $fetch_product['image']; ?>" class="card-img-top" alt="..." height="300">
                  <div class="card-body">
                     <h4> 餐點名稱: <?php echo $fetch_product['name']?></h4>
                     <h4> 餐點價格: NT$<?php echo $fetch_product['price']?>/-</h4>
                     <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                     <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                     <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                     <input type="submit" class="btn btn-primary" value="加入購物車" name="add_to_cart">
                  </div>
               </form>
            </div>
         </div>
         <?php
         };
      };
      ?>
         
   </div>
   <hr size="15px" align="center" width="100%">
   <h2 id="scrollspyHeading6" class="text-center" style="color: darkred;">快餐</h2>
   <div class="row">
   <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category='快餐'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>
         <div class="col-md-4 text-center">
            <form action="" method="post">
               <div class="card">
                  <img src="<?php echo $fetch_product['image']; ?>" height="300">
                  <h4> 餐點名稱: <?php echo $fetch_product['name']?></h4>
                  <h4> 餐點價格: NT$<?php echo $fetch_product['price']?>/-</h4>
                  <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                  <input type="submit" class="btn-primary" value="加入購物車" name="add_to_cart">
               </div>
            </form>
            
         </div>
      <?php
         };
      };
      ?>
   </div>
   <hr size="15px" align="center" width="100%">
   <h2 id="scrollspyHeading7" class="text-center" style="color: darkred;">綠豆冰沙</h2>
   <div class="row">
   <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category='綠豆冰沙'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
         ?>
         <div class="col-md-4 text-center">
            <div class="card" style="width: 22rem;">
               <form action="" method="post">
                  <img src="<?php echo $fetch_product['image']; ?>" class="card-img-top" alt="..." height="300">
                  <div class="card-body">
                     <h4> 餐點名稱: <?php echo $fetch_product['name']?></h4>
                     <h4> 餐點價格: NT$<?php echo $fetch_product['price']?>/-</h4>
                     <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                     <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                     <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                     <input type="submit" class="btn btn-primary" value="加入購物車" name="add_to_cart">
                  </div>
               </form>
            </div>
         </div>
         <?php
         };
      };
      ?>
         
   </div>
   <hr size="15px" align="center" width="100%">
   <h2 id="scrollspyHeading8" class="text-center" style="color: darkred;">趙班長海苔飯捲</h2>
   <div class="row">
   <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category='趙班長海苔飯捲'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>
         <div class="col-md-4 text-center">
            <form action="" method="post">
               <div class="card">
                  <img src="<?php echo $fetch_product['image']; ?>" height="300" >
                  <h4> 餐點名稱: <?php echo $fetch_product['name']?></h4>
                  <h4> 餐點價格: NT$<?php echo $fetch_product['price']?>/-</h4>
                  <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                  <input type="submit" class="btn-primary" value="加入購物車" name="add_to_cart">
               </div>
            </form>
            
         </div>
      <?php
         };
      };
      ?>
   </div>
   <hr size="15px" align="center" width="100%">
   <h2 id="scrollspyHeading9" class="text-center" style="color: darkred;">COMEBUY</h2>
   <div class="row">
   <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category='COMEBUY'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
         ?>
         <div class="col-md-4 text-center">
            <div class="card" style="width: 22rem;">
               <form action="" method="post">
                  <img src="<?php echo $fetch_product['image']; ?>" class="card-img-top" alt="..." height="300">
                  <div class="card-body">
                     <h4> 餐點名稱: <?php echo $fetch_product['name']?></h4>
                     <h4> 餐點價格: NT$<?php echo $fetch_product['price']?>/-</h4>
                     <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                     <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                     <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                     <input type="submit" class="btn btn-primary" value="加入購物車" name="add_to_cart">
                  </div>
               </form>
            </div>
         </div>
         <?php
         };
      };
      ?>
         
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