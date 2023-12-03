<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        button {
            background-color: #2196f3;
            color: #fff;
            border: none;
            padding: 8px 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    
    <form action="register_process.php" method="post">
        <h2>회원가입</h2>
        <label for="username">사용자명:</label>
        <input type="text" name="username" required><br>

        <label for="password">비밀번호:</label>
        <input type="password" name="password" required><br>

        <label for="email">이메일:</label>
        <input type="email" name="email" required><br>

        <label>성별:</label>
        <input type="radio" name="gender" value="male" required>
        <label for="male">남성</label>
        <input type="radio" name="gender" value="female" required>
        <label for="female">여성</label><br>

        <input type="submit" value="가입하기">
        <button onclick="goToLoginPage()">로그인</button>
    </form>

    <script>
        function goToLoginPage() {
            window.location.href = 'login.php';
        }
    </script>
</body>
</html>
