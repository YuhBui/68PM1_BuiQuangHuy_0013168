<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Xác thực tài khoản')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        :root {
            --c-header: #1e3a5f;
            --c-sidebar: #2c4a7c;
            --c-content: #ffffff;
            --c-page: #eef2f7;
            --c-text: #333333;
            --c-accent: #f5a623;
        }
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #eef2f7 0%, #dbe5f1 100%);
            color: var(--c-text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
        }
        .auth-container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="auth-container">
        @yield('content')
    </div>
</body>
</html>
