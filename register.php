<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
</head>
<body>
    <h2>회원가입</h2>
    <form action="register_process.php" method="post">
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
        <button onclick="goToRegisterPage()">로그인</button>
    </form>
    <script>
    
        function goToRegisterPage() {
            window.location.href = 'login.php';
        }
    </script>
</body>
</html>
