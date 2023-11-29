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

// fashion_id를 받아옴
$fashion_id = $_GET['fashion_id'];

// 해당 fashion_id에 대한 PRODUCTS 정보 조회 쿼리
$sql_products = "SELECT Products.* FROM Products
                JOIN FashionList_Products ON Products.product_id = FashionList_Products.product_id
                WHERE FashionList_Products.fashion_id = $fashion_id";
$result_products = $conn->query($sql_products);

// 결과가 있는지 확인
if ($result_products->num_rows > 0) {
    echo "<h2>Fashion 상세 정보</h2>";
    echo "<img src='' alt='Fashion Image'>";
    echo "<br>";
    echo "<br>";
    echo "<hr>";
    echo "<hr>";
    echo "<br>";
    echo "<br>";

    // 각각의 PRODUCT 정보 출력
    echo "<div class='product-container'>";
    while ($row_product = $result_products->fetch_assoc()) {
        echo "<img src='" . $row_product['p_picture'] . "' alt='Product Image'>";
        echo "<div class='product-item'>";
        echo "<p>상품 ID: " . $row_product['product_id'] . "</p>";
        echo "<p>상품명: " . $row_product['product_name'] . "</p>";
        echo "<p>판매 사이트: " . $row_product['sell_site'] . "</p>";
        echo "<p>상품 정보: " . $row_product['p_info'] . "</p>";
        echo "<p>가격: " . $row_product['price'] . "</p>";
        echo "</div>";
        echo "<br>";
        echo "<br>";
    }
    echo "</div>";
} else {
    echo "해당 패션 정보에 대한 상품이 없습니다.";
}

// 데이터베이스 연결 종료
$conn->close();
?>
