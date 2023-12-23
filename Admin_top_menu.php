<style >
	@media (max-width: 600px){
		width:100%;32
	}
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
	   	<a class="navbar-brand" href="Admin_index.php"><i class="fa-solid fa-house"></i>首頁</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	   	</button>
	    <div class="collapse navbar-collapse" id="navbarNav">
	      	<ul class="navbar-nav">
	        	<li class="nav-item">
	          		<a class="nav-link active" aria-current="page" href="Admin_check_user.php"><i class="fa-solid fa-user"></i>查看用戶</a>
	        	</li>
	        	<li class="nav-item">
	          		<a class="nav-link" href="Admin_check_product.php"><i class="fa-solid fa-utensils"></i>查看餐點</a>
	        	</li>
	        	<li class="nav-item">
	          		<a class="nav-link" href="Admin_check_order.php"><i class="fa-solid fa-receipt"></i>查看訂單</a>
	        	</li>
	        	<li class="nav-item">
	          		<a class="nav-link" href="Admin_login.php" onclick="return confirm('確定要登出嗎?');"><i class="fa fa-sign-out-alt"></i>登出</a>
	        	</li>
	      	</ul>
	    </div>
	 </div>
</nav>	