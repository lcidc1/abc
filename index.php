const express = require('express');
const app = express();
const PORT = 3000;

// 处理 /abc/ 路径
app.get('/abc/:id?', (req, res) => {
    const id = req.params.id;
    let targetUrl, message;
    
    if (!id) {
        targetUrl = 'http://B域名.com';
        message = '正在跳转到B域名首页';
    } else {
        targetUrl = `http://B域名.com/${id}`;
        message = `正在跳转到B域名/${id}`;
    }
    
    res.send(`
    <!DOCTYPE html>
    <html>
    <head>
        <title>跳转中...</title>
        <meta http-equiv="refresh" content="2;url=${targetUrl}">
        <style>
            body { 
                font-family: Arial, sans-serif; 
                margin: 0; 
                padding: 40px; 
                text-align: center;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .container { 
                max-width: 500px; 
                background: rgba(255,255,255,0.1);
                padding: 40px;
                border-radius: 15px;
                backdrop-filter: blur(10px);
            }
            .loading { 
                font-size: 18px; 
                margin: 20px 0;
            }
            .url { 
                background: rgba(255,255,255,0.2);
                padding: 10px;
                border-radius: 5px;
                margin: 15px 0;
                word-break: break-all;
            }
            .btn {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background: white;
                color: #667eea;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>🚀 跳转中...</h1>
            <div class="loading">
                <p>${message}</p>
                <div class="url">
                    <strong>目标地址:</strong><br>
                    ${targetUrl}
                </div>
                <p>页面将在 2 秒后自动跳转</p>
            </div>
            <a href="${targetUrl}" class="btn">立即跳转</a>
        </div>
        
        <script>
            // 3秒后自动跳转（备用）
            setTimeout(() => {
                window.location.href = '${targetUrl}';
            }, 3000);
            
            // 记录访问（可选）
            console.log('跳转记录:', {
                from: '${req.originalUrl}',
                to: '${targetUrl}',
                timestamp: new Date().toISOString()
            });
        </script>
    </body>
    </html>
    `);
});

// 根路径和其他路径处理
app.get('/', (req, res) => {
    res.redirect('/abc');
});

app.get('*', (req, res) => {
    res.redirect('/abc');
});

app.listen(PORT, () => {
    console.log(`🚀 服务器已启动`);
    console.log(`📍 访问地址: http://localhost:${PORT}`);
    console.log(`📝 测试用例:`);
    console.log(`   http://localhost:${PORT}/abc/`);
    console.log(`   http://localhost:${PORT}/abc/000`);
    console.log(`   http://localhost:${PORT}/abc/001`);
    console.log(`   http://localhost:${PORT}/abc/任何内容`);
});
