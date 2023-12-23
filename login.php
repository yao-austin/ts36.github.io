<?php 

include 'inc/header.php'; //套件檔案
include 'config.php'; //連結資料庫
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));


   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_name'] = $row['name'];
      echo "<script>alert('帳號登入成功!!!'); location.href = 'index.php';</script>";
   }
   else
   {
      $message[] = 'Email或密碼輸入錯誤!';
   }

}
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">

	<title>使用者登入頁面</title>
</head>
<body background="background.jpg" style="background-repeat: no-repeat; background-size: 100% 100%;">

<nav class="navbar navbar-expand-lg navbar-expand-md navbar-dark bg-gradient bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">學餐訂餐系統</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="login.php">用戶登入頁面</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            登入
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="login.php">用戶</a></li>
            <li><a class="dropdown-item" href="Admin_login.php">管理員</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="register.php">註冊</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="form-container">

  <form action="" method="post" enctype="multipart/form-data">
    <h3>用戶登入</h3>
    <?php
    if(isset($message))
    {
        foreach($message as $message)
        {
            echo '<div class="message">'.$message.'</div>';
        }
    }
    ?>
    <input type="email" name="email" placeholder="輸入Email" class="box" required>
    <input type="password" name="password" placeholder="輸入密碼" class="box" required>
    <input type="submit"  name="submit" value="立即登入" class="btn">
    <p>還沒有帳號?<a href="register.php">立即註冊</a></p>
    
  </form>

</div>

</body>
</html>