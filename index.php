<h1>自訂函式</h1>
<?php
$c = 20;
// $d=50;
function sum($a, $b)
{
    global $c;
    // 要宣告，有一個全域(括號外)的變數$c是可以使用的，以下賦值才成立
    $sum = $a + $b + $c;

    echo "輸入:" . $a . "、" . $b;
    echo "<br>";
    return $sum;
    // sum是一個變數，變數可以被指定值
    // 陣列session/get/post也都是變數，自訂函式本身也是一個變數
    // 變數可以拿來使用
}

$sum = sum(10, 20);
echo "總和是:" . $sum;
echo "<hr>";
$sum = sum(17, 68);
echo "總和是:" . $sum;
echo "<hr>";
echo "總和是:" . sum(56, 77);
?>


<h2>不定參數的用法</h2>
<?php
function sum2(...$arg){
    $sum = 0;
    foreach ($arg as $num) {
        // 當前的陣列元素將被賦值給 $num 變數
        if (is_numeric($num)) {
            $sum += $num;
            // print_r($arg);
            // 列出不定參數陣列
            // $total=array_sum($arg);
            // echo $total;
        }
    }
    return $sum;
}

echo sum2(1, 2);
echo "<hr>";
echo sum2(3, 4, 5);
echo "<hr>";
echo sum2(6, 7, 'djigoijel', 8);
echo "<hr>";

// 不定means(不一定要arg什麼參數)，$arg參數名稱也可自訂命名
// ...$arg 解構賦值(展開運算符)，是個陣列
?>

<h3>用chatgpt查到加總不定參數陣列的方法</h3>
<?php
function sum55(...$arg){
    $total=array_sum($arg);
            echo $total;
            // print_r($arg);
            // 列出不定參數陣列
}

echo sum55(1, 2);
echo "<hr>";
echo sum55(3, 4, 5);
echo "<hr>";
echo sum55(6, 7, 'djigoijel', 8);
echo "<hr>";
?>

<h1>自訂函式預設值</h1>
<?php
function sum3($a,$b,$c=3){
    // 預設值先寫好=3
    $sum = ($a+$b)*$c;
    echo "$a 、 $b , 倍數 $c <br>";
    return $sum;    
}

echo "總和是".sum3(10,15);
echo "<hr>";
echo "總和是".sum3(10,15,10);

?>