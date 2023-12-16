<?php
// 假設你的 MySQL 連線資訊
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant_db";

// 建立 MySQL 連線
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連線是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 解析 POST 資料
$data = json_decode(file_get_contents("php://input"));

// 取得用戶輸入的留言內容和用戶ID
$user_id = $data->user_id;
$comment = $data->comment;

// 將留言存儲到資料庫的 comments 表中
$sql = "INSERT INTO comments (user_id, comment_text) VALUES ('$user_id', '$comment')";
$result = $conn->query($sql);

// 關閉連線
$conn->close();

// 回傳成功訊息
echo json_encode(['status' => 'success']);
?>
