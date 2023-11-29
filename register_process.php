<?php
// 데이터베이스 연결 정보
$servername = "192.168.56.101";
$username = "guseh5634";
$password = "gmlakd5634!";
$dbname = "databasePJ";
$port=4567;

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// POST로 전송된 데이터 받기
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // 비밀번호 암호화
$email = $_POST['email'];
$gender = $_POST['gender'];



// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 사용자 등록 쿼리
$sql = "INSERT INTO users (username, password, email, gender) VALUES ('$username', '$password', '$email', '$gender')";

if ($conn->query($sql) === TRUE) {
    // 회원가입이 정상적으로 완료되면 로그인 페이지로 이동
    header("Location: login.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 데이터베이스 연결 종료
$conn->close();
?>
