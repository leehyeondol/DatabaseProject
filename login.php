<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
</head>
<body>
    <h2>로그인</h2>
    <form action="login_process.php" method="post">
        <label for="username">사용자명:</label>
        <input type="text" name="username" required><br>

        <label for="password">비밀번호:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="로그인">
    </form>
</body>
</html>
