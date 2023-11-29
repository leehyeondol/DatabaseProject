<?php
// 데이터베이스 연결 정보
$servername = "192.168.56.101";
$port = 4567;
$username = "guseh5634";
$password = "gmlakd5634!";
$dbname = "databasePJ";

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 사용자가 로그인되어 있는지 확인하는 코드 (세션 사용)
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // 로그인되어 있지 않으면 로그인 페이지로 이동
    exit();
}

// 패션 목록 조회 쿼리
$sql_fashion = "SELECT fashion_id, fs_info, fs_picture FROM FashionList";
$result_fashion = $conn->query($sql_fashion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인페이지</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: right;
        }

        .logout-btn {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout-btn:hover {
            background-color: #45a049;
        }

        .fashion-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .fashion-item {
            margin: 10px;
            text-align: center;
            width: 400px; /* 설정한 폭에 따라 다음 줄로 넘어감 */
        }
    </style>
</head>
<body>
    <div class="header">
        <a class="logout-btn" href="logout.php">로그아웃</a>
    </div>

    <h2>패션 목록</h2>

    <div class="fashion-container">
        <?php
        // 패션 목록 출력
        if ($result_fashion->num_rows > 0) {
            while ($row_fashion = $result_fashion->fetch_assoc()) {
                echo "<div class='fashion-item'>";
                echo "<a href='view_fashion.php?fashion_id=" . $row_fashion['fashion_id'] . "'>";
                echo "<img src='" . $row_fashion['fs_picture'] . "' alt='Fashion Image'>";
                echo "</a>";
                echo "<p>패션 ID: " . $row_fashion['fashion_id'] . "</p>";
                echo "<p>패션 정보: " . $row_fashion['fs_info'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "등록된 패션이 없습니다.";
        }
        ?>
    </div>

    <!-- 데이터베이스 연결 종료 -->
    <?php
    $conn->close();
    ?>
</body>
</html>
