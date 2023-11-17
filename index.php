<?php
// 自訂函式
$c=20;
function sum($a,$b){
    global $c;
    // 要宣告，有一個全域(括號外)的變數$c是可以使用的，以下賦值才成立
    $sum=$a+$b+$c;

    echo "輸入:". $a. "、". $b;
    echo "<br>";
    return $sum;
    // sum是一個變數，變數可以被指定值
    // 陣列session/get/post也都是變數，自訂函式本身也是一個變數
    // 變數可以拿來使用
}

$sum=sum(10,20);
echo "總和是:". $sum;
echo "<hr>";
$sum=sum(17,68);
echo "總和是:". $sum;
echo "<hr>";

echo "總和是:".sum(56,77);

?>