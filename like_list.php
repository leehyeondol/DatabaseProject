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

// Like_list 조회 쿼리
$sql_like_list = "SELECT l.likelist_id, l.like_time, f.* FROM Like_list l
                  JOIN FashionList f ON l.fashion_id = f.fashion_id";

$result_like_list = $conn->query($sql_like_list);

// 삭제 버튼이 클릭된 경우
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_button'])) {
    $likelist_id_to_delete = $_POST['likelist_id_to_delete'];

    // Like_list에서 데이터 삭제
    $sql_delete_like = "DELETE FROM Like_list WHERE likelist_id = $likelist_id_to_delete";
    $result_delete_like = $conn->query($sql_delete_like);

    if ($result_delete_like) {
        // 삭제 성공 시 리디렉션
        header("Location: like_list.php");
        exit();
    } else {
        // 삭제 실패 시 메시지 출력 또는 다른 동작 수행
        echo "좋아요 삭제에 실패했습니다.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Like List</title>
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

        .main-page-btn {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 20px;
        }

        .logout-btn {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 20px;
        }

        .like-item {
            margin: 10px;
            text-align: center;
            width: 400px;
            border: 1px solid #ddd;
            padding: 10px;
        }

        .delete-btn {
            background-color: #f44336;
            color: #fff;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="header">
        <a class="main-page-btn" href="main.php">MainPage</a>
        <a class="logout-btn" href="logout.php">Logout</a>
    </div>

    <h2>Like List</h2>

    <div class="like-container">
        <?php
        // Like List 출력
        if ($result_like_list->num_rows > 0) {
            while ($row_like = $result_like_list->fetch_assoc()) {
                echo "<div class='like-item'>";
                echo "<p>Fashion ID: " . $row_like['fashion_id'] . "</p>";
                echo "<p>Fashion Info: " . $row_like['fs_info'] . "</p>";
                echo "<p>Like Time: " . $row_like['like_time'] . "</p>";

                // 삭제 버튼 추가
                echo "<form method='post' action='like_list.php'>";
                echo "<input type='hidden' name='likelist_id_to_delete' value='" . $row_like['likelist_id'] . "'>";
                echo "<button type='submit' name='delete_button' class='delete-btn'>삭제</button>";
                echo "</form>";

                echo "</div>";
            }
        } else {
            echo "Like한 항목이 없습니다.";
        }
        ?>
    </div>

    <!-- 데이터베이스 연결 종료 -->
    <?php
    $conn->close();
    ?>
</body>
</html>
