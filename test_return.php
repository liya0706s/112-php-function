<h2>函式內有return</h2>
<?php
function add($a, $b){
    $sum= $a+$b;
    return $sum;
    // return代表結束函式並返回值，
    // 將指定的值返回給調用該函式的代碼
}
$result=add(3, 5);
echo $result;
echo "<hr>";
?>

<h2>函式內 沒有return</h2>
<?php
function add2($a, $b){
    $sum= $a+$b;
    // return $sum;

    // 沒有明確使用 return，但 add 函式仍然返回了一個值，這個值是 null(空白)。
    // 這可能會導致預期之外的結果，
    // 因此建議在函式中使用 return 語句，以確保明確地指定返回的值。
}
$result=add2(3, 5);
echo $result;

?>

<!-- 同一份檔案中函式function add 聲明名字不能重複 -->