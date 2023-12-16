// Google 登錄初始化
gapi.load('auth2', function() {
    gapi.auth2.init({
        client_id: '231540754766-c64d15ska7q6c9qqo9mjf7cjujuoatan.apps.googleusercontent.com',
    });
});

// 動態設定 apiUrl，可以根據應用的環境配置進行更改
const apiUrl = process.env.NODE_ENV === 'production' ? '/api' : 'http://localhost:3000/api';


// 檢查用戶登錄狀態
function checkLoginStatus() {
    const auth2 = gapi.auth2.getAuthInstance();
    const isSignedIn = auth2.isSignedIn.get();

    if (isSignedIn) {
        // 取得用戶資訊，這裡假設將用戶資訊發送到伺服器端進行處理
        const user = auth2.currentUser.get();
        const profile = user.getBasicProfile();
        
        // 這裡可使用 AJAX 將用戶資訊發送到伺服器端，存儲到資料庫
        // 例如使用 fetch 函數
        fetch(apiUrl + '/store_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: profile.getId(),
                name: profile.getName(),
                email: profile.getEmail(),
            }),
        })
        .then(response => response.json())
        .then(data => {
            console.log('User data stored:', data);
            // 在此處執行其他相應的操作
        })
        .catch(error => console.error('Error storing user data:', error));
    } else {
        console.log('User is not signed in.');
    }
}

// 發表留言
function postComment() {
    const commentInput = document.getElementById('comment-input');
    const commentText = commentInput.value;

    // 假設你有一個 API endpoint '/api/post_comment.php' 用於處理留言
    fetch(apiUrl + '/post_comment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            user_id: 123,  // 假設這是已登錄用戶的 ID
            comment: commentText,
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Comment posted:', data);
        // 在此處執行其他相應的操作，例如刷新留言列表
    })
    .catch(error => console.error('Error posting comment:', error));
}

// 初始化畫面
checkLoginStatus();
