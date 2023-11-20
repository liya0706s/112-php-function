<h1>自訂函式CRUD</h1>
<?php

// 呼叫 all() 函式，
// 並將函式返回的值（所有學生資料的陣列）賦值給變數 $rows
// 該情況下的像是，假設x=5;

// 2023-11-17 定義函式all()
// $rows = all('students', ['dept' => '1', 'graduate_at' => '23']);

// find()-會回傳資料表 指定id的資料，因為很常使用
// 指定條件之後的那一筆資料還有，例如唯一特定的帳號密碼
// 2023-11-20 find() 指定id的函式
// 指定條件中，只要一筆資料的還有什麼???-->帳號密碼，或是比較私人資料庫中只有唯一性的
// $row = find('students', ['dept' => '1', 'graduate_at' => '23']);

// echo "<h3>相同條件使用 all()</h3>";
// 呼叫函式輸出
// dd($rows);
// echo "<hr>";
// echo "<h3>相同條件使用 find()</h3>";
// dd($row);

// 2023-11-20 用find() 測試pdo.php
$row = find('students', ['dept' => '1', 'graduate_at' => '23']);
dd($row);

// 2023-11-20 update()
// $up=update("students", '3',['dept'=>'16','name'=>'漲明珠']);
// $up = update("students", '3', ['dept' => '16', 'name' => '漲明珠']);
// dd($up);

// 2023-11-20 del()
// del('students',['dept'=>'5','status_code'=>'001']);
// 呼叫帶入參數

// 2023-11-20 insert()
// insert('dept', ['code' => '1112', 'name' => '織品系']);

// 定義函式 all() 用來取得學生資料
// null 是要有參數，可以是空的
function all($table = null, $where = '', $other = ''){
    // where預設為空有彈性，可以不設計where條件空白

    // where中的重複部分
    $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
    $pdo = new PDO($dsn, 'root', '');


    $sql = "select * from `$table`";

    // 要先判斷有這個資料表，且不是空的;若
    if (isset($table) && !empty($table)) {

        // where都有雷同的地方
        // 形成sql句子之前要判斷where是否為陣列
        if (is_array($where)) {
            /**陣列轉換成字串
             * ['dept'=>'2', 'graduate_at'=>12] => where `dept`='2' && `graduate_at` = '12'
             * $sql="select * from `table` from where `dept`='2' && `graduate_at` = '12'"
             */
            if (!empty($where)) {
                // 是陣列而且不是空的
                foreach ($where as $col => $value) {
                    $tmp[] = "`$col`='$value'";
                }
                $sql .= " where " . join(" && ", $tmp);
            }   // 如果不是的話$tmp只是空陣列

        } else {
            // 當他是字串，原句子
            $sql .= " $where";
            // 資料表名稱可以改成$table參數
        }
        $sql .= $other;
        // echo 'all=>' . $sql;
        // echo for測試用
        $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        // 整合所有語句
        // associate"關聯"名稱變成只拿 欄位名稱，不拿索引
        // num 關聯名稱變成，只拿"索引"
        // 預設是both
        return $rows;
    } else {
        echo "錯誤:沒有指定的資料表名稱";
    }
}

// 2023-11-20 find()回傳一筆指定資料
function find($table, $id)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
    $pdo = new PDO($dsn, 'root', '');
    $sql = "select * from `$table`";

    // where後面的id有可能是陣列或是數字(用字串連接)
    // 叫做id但是裡面可能存陣列或是.....?
    if (is_array($id)) {
        foreach ($id as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
        $sql .= " where " . join(" && ", $tmp);
        // $sql .= " where ".join(" && ",[` `=>'',` `=>'' ,` `=>''])
    } else if (is_numeric($id)) {
        $sql .= "where `id`='$id'";
    } else {
        echo "錯誤:參數的資料型態必須是數字或陣列";
    }

    // 把find()語法列出來，測試用而已，真正作品不要顯示出來
    echo 'find=>' . $sql;
        // echo for測試用

    $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    return $row;
    // return定義函式結束，要開始呼叫
}

// 2023-11-20 update()更新資料 有兩大段，比較複雜
// 更新 針對那些欄位
function update($table, $id, $cols)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
    $pdo = new PDO($dsn, 'root', '');

    $sql = "update `$table` set ";

    // 如果不是空的要做成資料;如果是空的顯示缺少...
    if (!empty($cols)) {
        foreach ($cols as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
    } else {
        echo "錯誤:缺少要編輯的欄位陣列";
    }

    $sql .= join(",", $tmp);
    // 上面宣告過$tmp變數，這次要宣告之前要清空，否則會重疊
    $tmp = [];
    if (is_array($id)) {
        foreach ($id as $col => $value) {
            $tmp[] = "`$col`='$value'";
            // 這邊陣列換成字串會是....?
        }
        $sql .= " where " . join(" && ", $tmp);
    } else if (is_numeric($id)) {
        $sql .= " where `id`='$id'";
    } else {
        echo "錯誤:參數的資料型態必須是數字或是陣列";
        // 如果id連數字都不是，顯示錯誤訊息
    }
    // echo $sql;
        // echo for測試用

    return $pdo->exec($sql);
    // return回傳指令影響了...列數
    // 結果只有數字(代表影響了幾列)

    // join...
}

// 2023-11-20 insert() 新增資料 語法: select
function insert($table, $values){
    // $values參數代表，新增欄位的陣列
    $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
    $pdo = new PDO($dsn, 'root', '');

    $sql = "insert into `$table` ";
    // 欄位和值
    $cols = "(`" . join("`,`", array_keys($values)) . "`)";
    // 取鍵的(key)名稱array_keys

    $vals = "('" . join("','", $values) . "')";

    // $cols="(``,``,``,``)";
    // $vals="(``,``,``,``)";

    $sql = $sql . $cols . " values " . $vals;

    // 帶入以上的值展開:
    // $sql = "insert into `$table` " . "(``,``,``,``)" ." values " . "(``,``,``,``)";

    return $pdo->exec($sql);
}

// 2023-11-20 del() 刪除指令 可以刪除一筆或是多筆資料:
// del() 類似find()
function del($table,$id){
    // 判斷參數id是不是陣列

    // $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
    // $pdo = new PDO($dsn, 'root', '');
    // 要抽出來為了程式撰寫和維護方便，不用改很多次
    // pdo function最後要returnc回傳值，才可以再呼叫他
    include "pdo.php";

    $sql="delete from `$table` where";
    // 把共同的部分拆出來
    // 有where

    if(is_array($id)){
        // foreach目的:將陣列的key和value轉成sql需要的字串，
        // 才可以兜成給資料庫執行的指令
        foreach($id as $col => $value){
                $tmp[]="`$col`='$value'";
                // 陣列轉成字串的顯示方式???
                // 這邊為什麼又是撇號??不是單引號
            }
            $sql .= join(" && ",$tmp);
    }else if(is_numeric($id)){
        // 不是陣列，是數字的話
          $sql .= " `id`='$id'";
    }else{
        echo "錯誤:參數的資料型態必須是數字或陣列";
    }
    // echo $sql;
        // echo for測試用

    return $pdo->exec($sql);

    // $sql="delete from `$table` where `id`='?'";
    // $sql="delete from `$table` where `col`='?' && `col2`='?'";

}

// directDump 秀出陣列 用成函式
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
