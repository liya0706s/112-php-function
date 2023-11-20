<?php

$dsn = "mysql:host=localhost;charset=utf8;dbname=school";
$pdo = new PDO($dsn, 'root', '');

?>

<!-- 方法二用global:
要取用function外的全域變數時使用global關鍵字
在db.php最上方寫:
$dsn = "mysql:host=localhost;charset=utf8;dbname=school";
$pdo = new PDO($dsn, 'root', '');
在需要的函式裡面寫入 global $pdo; -->

<!-- 三種方式去判斷:
1. 單一變數global
2. 多變數 用function簡化???
3. 很長一大串用include -->

<!-- foreach也可以用function簡化 回傳foreach的結果 -->

