<h1>自訂函式</h1>
<?php
$c = 20;
// $d=50;
function sum($a, $b){
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

// $sum=sum(17);
// echo "總和是:". $sum;
// 定義函式要有兩個參數(定義函式中參數的數量 和 呼叫函式的參數數量 要一致)
// 網頁會顯示Fetal error:Uncaught ArgCountError:Too few args to func sum()
$sum = sum(10, 20);
echo "總和是:" . $sum;
echo "<hr>";
$sum = sum(17, 68);
echo "總和是:" . $sum;
echo "<hr>";
echo "總和是:" . sum(56, 77);
// sum(56,77) 函式本身就可以放在字串裡面，函式他就是一個變數
?>

<h2>...$arg不定參數是陣列</h2>
<?php
function test(...$arg){
            print_r($arg);
}

test(1,2);
echo "<br>";
test(4,5,6);
echo "<br>";
test("jkfjioek",25,68,73);
echo "<br>";

?>


<h2>不定參數的用法</h2>
 <!-- 不定的意思是，不一定的什麼參數， -->
 <p>不定參數加總</p>
<?php
function sum2(...$arg){
    // $arg參數名稱也可自訂隨便命名，例如:$jhkhidt
    // ...$arg放在宣告函式參數的地方，叫做不定參數，是化作陣列顯示
    // ...$arg放在外面其他地方叫，解構賦值(展開式運算符)，是個陣列
    $sum = 0;
    foreach ($arg as $num) {
        // 當前的陣列內元素值 被賦值給 $num 變數
        // 要先判斷參數是否為數字，只有數字的才會加總，否則不管它
        if (is_numeric($num)) {
            $sum += $num;
            // print_r($arg);
            // 列出不定參數真的是陣列
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

?>

<h3>用chatgpt查到加總不定參數陣列的方法</h3>
<p>無法確認輸入的值如果不是數字會有bug</p>
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