// server.js

const express = require('express');
const app = express();

// 設定一個簡單的端點
app.get('/api/data', (req, res) => {
    const data = { message: 'Hello, this is your API!' };
    res.json(data);
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
