<?php
// 데이터베이스 연결 정보
$servername = "192.168.56.101";
$port=4567;
$username = "guseh5634";
$password = "gmlakd5634!";
$dbname = "databasePJ";

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// POST로 전송된 데이터 받기
$username = $_POST['username'];
$password = $_POST['password'];



// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 로그인 쿼리
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 사용자가 존재하는 경우
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        session_start();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        // main.php로 이동
        header("Location: main.php");
    } else {
        echo "비밀번호가 일치하지 않습니다.";
    }
} else {
    echo "사용자가 존재하지 않습니다.";
}

// 데이터베이스 연결 종료
$conn->close();
?>
