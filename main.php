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

// 카테고리 조회 쿼리
$sql_category = "SELECT category_id, gender FROM Category";
$result_category = $conn->query($sql_category);

// 선택한 카테고리에 해당하는 패션 목록 조회 쿼리
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql_fashion = "SELECT fashion_id, fs_info, fs_picture FROM FashionList WHERE category_id = $category_id";
} else {
    // 아무 카테고리도 선택하지 않았을 때는 전체 패션 목록 조회
    $sql_fashion = "SELECT fashion_id, fs_info, fs_picture FROM FashionList";
}

$result_fashion = $conn->query($sql_fashion);

// 좋아요 버튼이 클릭된 경우
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['like_button'])) {
    $fashion_id_to_like = $_POST['fashion_id_to_like'];

    // Like_list에 데이터 삽입
    $sql_insert_like = "INSERT INTO Like_list (fashion_id) VALUES ('$fashion_id_to_like')";
    $result_insert_like = $conn->query($sql_insert_like);

    if ($result_insert_like) {
        // 삽입 성공 시 메시지 출력 또는 다른 동작 수행
        echo "좋아요가 등록되었습니다.";
    } else {
        // 삽입 실패 시 메시지 출력 또는 다른 동작 수행
        echo "좋아요 등록에 실패했습니다.";
    }
}
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
            margin-right: 20px;
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
            border: 1px solid #ddd; /* 선 추가 */
            padding: 10px;
        }

        .category-btn {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 10px;
            cursor: pointer;
        }

        .category-btn:hover {
            background-color: #45a049;
        }
        .like-list-btn {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 20px;
            cursor: pointer;
        }

        .like-list-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    
    <div class="header">
        <a class="like-list-btn" href="like_list.php">Like_List</a> <!-- like_list 버튼 추가 -->
        <a class="logout-btn" href="logout.php">Logout</a>   
    </div>

    <h2>카테고리</h2>
    <div>
        <?php
        // 카테고리 버튼 출력
        if ($result_category->num_rows > 0) {
            while ($row_category = $result_category->fetch_assoc()) {
                echo "<a class='category-btn' href='main.php?category_id=" . $row_category['category_id'] . "'>";
                echo $row_category['gender'];
                echo "</a>";
            }
            // 아무 카테고리도 선택하지 않았을 때 전체 보기 버튼
            echo "<a class='category-btn' href='main.php'> All</a>";
        } else {
            echo "등록된 카테고리가 없습니다.";
        }
        ?>
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

                // 좋아요 버튼 추가
                echo "<form method='post' action='main.php'>";
                echo "<input type='hidden' name='fashion_id_to_like' value='" . $row_fashion['fashion_id'] . "'>";
                echo "<button type='submit' name='like_button'>좋아요</button>";
                echo "</form>";

                echo "</div>";
            }
        } else {
            echo "선택한 카테고리에 등록된 패션이 없습니다.";
        }
        ?>
    </div>

    <!-- 데이터베이스 연결 종료 -->
    <?php
    $conn->close();
    ?>
</body>
</html>
