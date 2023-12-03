<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion 상세 정보</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        
        h4 {
            text-align: center;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .product-item {
            margin: 10px;
            text-align: center;
            width: 300px;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .no-product-msg {
            text-align: center;
            margin: 20px;
            color: #555;
        }
    </style>
</head>
<body>
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
        echo "<h4>Fashion 스타일링 사진 </h4>";
        echo "<h2>Fashion 상세 정보</h2>";
        echo "<div class='product-container'>";
      
        // 각각의 PRODUCT 정보 출력
        while ($row_product = $result_products->fetch_assoc()) {
            echo "<div class='product-item'>";
            echo "<img src='" . $row_product['p_picture'] . "' alt='Product Image'>";
            echo "<p>상품 ID: " . $row_product['product_id'] . "</p>";
            echo "<p>상품명: " . $row_product['product_name'] . "</p>";
            echo "<p>판매 사이트: " . $row_product['sell_site'] . "</p>";
            echo "<p>상품 정보: " . $row_product['p_info'] . "</p>";
            echo "<p>가격: " . $row_product['price'] . "</p>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p class='no-product-msg'>해당 패션 정보에 대한 상품이 없습니다.</p>";
    }

    // 데이터베이스 연결 종료
    $conn->close();
    ?>
</body>
</html>
