<?php

// 呼叫 all() 函式，
// 並將函式返回的值（所有學生資料的陣列）賦值給變數 $rows
$rows=all();

// 函式輸出
dd($rows);

// 定義函式 all() 用來取得學生資料
function all(){
    $dsn="mysql:host=localhost;charset=utf8;dbname=school";
    $pdo=new PDO($dsn, 'root', '');

    $sql="select * from `students` ";
    $rows=$pdo->query($sql)->fetchAll();
    return $rows;
}

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


?>