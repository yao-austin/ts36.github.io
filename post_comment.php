<?php
// 假設你的 MySQL 連線資訊
$serverName = "travel98.database.windows.net";
$database = "travel";
$uid = "tsouadmin";
$pass = "Qq0989260287";

$connectionInfo = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass,
];
$conn = sqlsrv_connect($serverName, $connectionInfo);


// 檢查連線是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 解析 POST 資料
$data = json_decode(file_get_contents("php://input"));

// 取得用戶輸入的留言內容和用戶ID
$Name = $data->Name;
$Message = $data->Message;
$Email = $data->Email;

// 將留言存儲到資料庫的 comments 表中
$sql = "INSERT INTO Comments (Name, Message,Email) VALUES ('$Name', '$Message','$Email')";
$result = $conn->query($sql);

// 關閉連線
$conn->close();

// 回傳成功訊息
echo json_encode(['status' => 'success']);
?>
