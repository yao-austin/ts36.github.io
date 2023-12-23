<?php 

include 'inc/header.php'; //套件檔案
include 'config.php'; //連結資料庫

if(isset($_POST['submit']))
{
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
  $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

  $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

  if(mysqli_num_rows($select) > 0){
    $message[] = '會員已註冊'; 
  }
  else{
    if($pass != $cpass){
      $message[] = '兩組密碼不相同!';
    }
    else{
      $insert = mysqli_query($conn, "INSERT INTO `users`(name, email, phone, password) VALUES('$name', '$email','$phone', '$pass')") or die('query failed');
      echo "<script>alert('帳號註冊成功!!!'); location.href = 'login.php';</script>";                     
    }
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
	<title>使用者註冊頁面</title>
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
          <a class="nav-link active" aria-current="page" href="register.php">用戶註冊頁面</a>
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
      </ul>
    
    </div>
  </div>
</nav>
<div class="form-container">

	<form action="" method="post" enctype="multipart/form-data">
		<h3>用戶註冊</h3>
	    <?php
        if(isset($message))
        {
            foreach($message as $message)
            {
                echo '<div class="message">'.$message.'</div>';
            }
        }
      	?>
		<input type="text" name="name" placeholder="輸入名字" class="box" required>
		<input type="email" name="email" placeholder="輸入Email" class="box" required>
    <input type="phone" name="phone" placeholder="輸入電話號碼" class="box" required>
		<input type="password" name="password" placeholder="輸入密碼" class="box" required>
		<input type="password" name="cpassword" placeholder="確認密碼" class="box" required>
		<input type="submit"  name="submit" value="立即註冊" class="btn">
		<p>已經有帳號了嗎?<a href="login.php">立即登入</a></p>
		
	</form>

</div>





</body>
</html>