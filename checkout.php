<?php
include 'inc/header.php';

include 'config.php';

if(isset($_POST['order_btn'])){

  $name = $_POST['name'];
  $number = $_POST['number'];

  $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
  
  if(mysqli_num_rows($cart_query) > 0){
    while($product_item = mysqli_fetch_assoc($cart_query)){
      $product_name[] = $product_item['name'] .' * '. $product_item['quantity'] .' ';
    };
  };
  $count_grand_total = "SELECT SUM(price*quantity) AS sum_price FROM `cart` ";
  $query_run = mysqli_query($conn, $count_grand_total);
  while($row = mysqli_fetch_assoc($query_run)){
    $grand_total = $row['sum_price'];
  }
  $total_product = implode(', ',$product_name);
  $detail_query = mysqli_query($conn, "INSERT INTO `orders`(name, phone, total_products, total_price,order_time) VALUES('$name','$number','$total_product','$grand_total',NOW())");
  mysqli_query($conn, "DELETE FROM `cart`");
  if($cart_query && $detail_query){
      header('location:thanks_for_ordering.php');
   }

}

?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>確認訂單</title>


   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/productlist.css">

</head>
<body background="background.jpg" style="background-repeat: no-repeat; background-size: 100% 100%; background-size:1920px 1080px;background-position:center 0;">



<div class="container">

<section class="checkout-form">
    
    <h2 class="heading">確認您的訂單</h2>

    <form action="" method="post">

    <div class="display-order">
      <h1 class="text-center">訂購的餐點:</h1>
        <?php
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
        
        if(mysqli_num_rows($select_cart) > 0){
          while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            
          $count_grand_total = "SELECT SUM(price*quantity) AS sum_price FROM `cart` ";
          $query_run = mysqli_query($conn, $count_grand_total);
          while($row = mysqli_fetch_assoc($query_run)){
            $grand_total = $row['sum_price'];
          }
          ?>
          <span><?= $fetch_cart['name']; ?>*<?= $fetch_cart['quantity']; ?></span>
          <?php
          }
        }
        else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
        }
        ?>
        <span class="grand-total"> 訂單總金額 : NT$<?= $grand_total; ?> </span>
    </div>
      <?php 

      session_start();
      $user_id =$_SESSION['user_id'];
      $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'");
      $fetch_user = mysqli_fetch_assoc($select_user);

      ?>
      <div class="flex">
         <div class="inputBox">
            <span>您的名字</span>
            <input type="text"  value="<?php echo $fetch_user['name']; ?>" placeholder="確認名字" name="name" required>
         </div>
         <div class="inputBox">
            <span>您的電話</span>
            <input type="text"  value="<?php echo $fetch_user['phone']; ?>" placeholder="確認電話" name="number" required>
         </div>
         
      </div>
      <input type="button" value="返回購物車" class="btn btn-outline-warning" onclick="location.href='cart.php'">
      <input type="submit" value="送出訂單" name="order_btn" onclick="return confirm('訂單送出後就無法更改了喔!!!');" class="btn btn-outline-success" >
      
   </form>
   

</section>

</div>

<!-- custom js file link  
<script src="js/script.js"></script>
-->
</body>
</html>