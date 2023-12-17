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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // 在這裡將資料插入到資料庫
    $sql = "INSERT INTO YourTableName (Name, Email, Message) VALUES ('$name', '$email', '$message')";
    $result = $conn->query($sql);
    
    // 檢查是否成功插入資料
    if ($result === TRUE) {
        echo "資料插入成功";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// 關閉連線
$conn->close();

// 回傳成功訊息
echo json_encode(['status' => 'success']);
?>
