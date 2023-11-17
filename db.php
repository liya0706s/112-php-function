<?php

// 呼叫 all() 函式，
// 並將函式返回的值（所有學生資料的陣列）賦值給變數 $rows
// ???
$rows=all();

// 函式輸出
dd($rows);

// 定義函式 all() 用來取得學生資料
// 為什麼這邊要=null?
function all($table=null){
    $dsn="mysql:host=localhost;charset=utf8;dbname=school";
    $pdo=new PDO($dsn, 'root', '');

    // table名稱如果被惡搞是空值或是沒有該名稱，要先判斷有這個資料表，且不是空的
    if(isset($table) && !empty($table)){
        $sql="select * from `$table` ";
    // 資料表名稱可以改成$table
    $rows=$pdo->query($sql)->fetchAll();
    return $rows;
    }else{
        echo "錯誤:沒有指定的資料表名稱";
    }    
}

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


?>