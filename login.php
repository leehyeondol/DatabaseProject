<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
</head>
<body>
    <form action="login_process.php" method="post">
        <h2>로그인</h2>
        <label for="username">사용자명:</label>
        <input type="text" name="username" required>
        <br>

        <label for="password">비밀번호:</label>
        <input type="password" name="password" required>
        <br>


        <input type="submit" value="로그인">
        <button onclick="goToRegisterPage()">회원가입</button>
    </form>

    <!-- 버튼을 클릭하면 회원가입 페이지로 이동하는 JavaScript 코드 -->
    <script>
        // JavaScript 함수: 회원가입 페이지로 이동
        function goToRegisterPage() {
            // Replace 'register.php' with the actual URL of your register page
            window.location.href = 'register.php';
        }
    </script>
</body>
</html>
