

<nav class="navbar navbar-expand-lg navbar-expand-md navbar-dark bg-gradient bg-dark">
   <div class="container-fluid">
      <a class="navbar-brand text-light text-center bg-gradient bg-light bg-opacity-25 rounded-pill px-4"
      href="user_info.php"><span class="fa fa-user"></span> 用戶</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link active" aria-current="page" href="index.php"><span class="fa fa-home"></span>首頁</a>
            </li>
            <li class="nav-item">
               <a class="nav-link active" aria-current="page" href="food_order.php"><span class="fa fa-cutlery"></span>開始點餐</a>
            </li>
    
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">我的帳戶</a>
               <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="user_info.php">個人檔案</a></li>
                  <li><a class="dropdown-item" href="order_info.php">訂單紀錄</a></li>
                         
               </ul>
            </li>
            <li class="nav-item">

               <a class="nav-link" href="login.php" onclick="return confirm('確定要登出嗎?');"><i class="fa fa-sign-out-alt"></i>登出</a>
            </li>
            </ul>
      </div>
   </div>
</nav>