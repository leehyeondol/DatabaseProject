<?php
session_start();
session_unset();  // 세션 변수 모두 삭제
session_destroy();  // 세션 종료
header("Location: login.php");  // 로그인 페이지로 이동
exit();
?>
