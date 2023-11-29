<?php
// 데이터베이스 연결 정보
$servername = "192.168.56.101";
$port=4567;
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

// fashion_id를 받아옴
$fashion_id = $_GET['fashion_id'];

// 해당 fashion_id에 대한 PRODUCT 정보 조회 쿼리
$sql_product = "SELECT * FROM FashionList WHERE fashion_id = $fashion_id";
$result_product = $conn->query($sql_product);

// 결과가 있는지 확인
if ($result_product->num_rows > 0) {
    $row_product = $result_product->fetch_assoc();
    $product_id = $row_product['product_id'];

    // PRODUCT 정보 조회 쿼리
    $sql_product_info = "SELECT * FROM Products WHERE product_id = $product_id";
    $result_product_info = $conn->query($sql_product_info);

    // 결과가 있는지 확인
    if ($result_product_info->num_rows > 0) {
        $row_product_info = $result_product_info->fetch_assoc();
    } else {
        echo "해당 상품 정보가 없습니다.";
    }
} else {
    echo "해당 패션 정보가 없습니다.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion 상세 정보</title>
</head>
<body>
    <h2>Fashion 상세 정보</h2>

    <?php
    // PRODUCT 정보 출력
    if (isset($row_product_info)) {
        echo "<p>상품 ID: " . $row_product_info['product_id'] . "</p>";
        echo "<p>상품명: " . $row_product_info['product_name'] . "</p>";
        echo "<p>판매 사이트: " . $row_product_info['sell_site'] . "</p>";
        echo "<p>상품 정보: " . $row_product_info['p_info'] . "</p>";
        echo "<img src='" . $row_product_info['p_picture'] . "' alt='Product Image'>";
        echo "<p>가격: " . $row_product_info['price'] . "</p>";
    } else {
        echo "상세 정보가 없습니다.";
    }
    ?>

    <!-- 추가적인 디자인 및 레이아웃을 원하시면 여기에 추가하시면 됩니다. -->

    <!-- 데이터베이스 연결 종료 -->
    <?php
    $conn->close();
    ?>
</body>
</html>
