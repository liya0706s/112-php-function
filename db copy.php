<h1>自訂函式CRUD</h1>
<?php

date_default_timezone_set('Asia/Taipei');
$dsn = "mysql:host=localhost;charset=utf8;dbname=school";
$pdo = new PDO($dsn, 'root', '');

// 2023-11-17 定義函式all()
// $rows = all('students', ['dept' => '1', 'graduate_at' => '23']);

// find()-會回傳資料表 指定id的資料，因為很常使用
// 指定條件之後的那一筆資料還有，例如唯一特定的帳號密碼
// 2023-11-20 find() 指定id的函式
// 指定條件中，只要一筆資料的還有什麼???-->帳號密碼，或是比較私人資料庫中只有唯一性的
$row = find('students', ['dept' => '1', 'graduate_at' => '23']);

// echo "<h3>相同條件使用 all()</h3>";
// 呼叫函式輸出
// dd($rows);
echo "<hr>";
echo "<h3>相同條件使用 find()</h3>";
dd($row);



function all($table = null, $where = '', $other = ''){
    
    global $pdo;
    $sql = "select * from `$table`";

    
    if (isset($table) && !empty($table)) {

        if (is_array($where)) {
            

            if (!empty($where)) {
                foreach ($where as $col => $value) {
                    $tmp[] = "`$col`='$value'";
                }
                $sql .= " where " . join(" && ", $tmp);

            }
            } else {
                $sql .= " $where";
            }
        $sql .= $other;

        echo 'all=>' . $sql;

        $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    } else {
        echo "錯誤:沒有指定的資料表名稱";
    }
}


function find($table, $id)
{
    global $pdo;
    $sql = "select * from `$table` ";

    if (is_array($id)) {
        foreach ($id as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
        $sql .= " where " . join(" && ",$tmp);
    } else if (is_numeric($id)) {
        $sql .= " where `id`='$id'";
    } else {
        echo "錯誤:參數的資料型態必須是數字或陣列";
    }
    echo 'find=>' . $sql;
    $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    return $row;
}


function update($table, $id, $cols)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
    $pdo = new PDO($dsn, 'root', '');

    $sql = "update `$table` set ";

    if (!empty($cols)) {
        foreach ($cols as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
    } else {
        echo "錯誤:缺少要編輯的欄位陣列";
    }

    $sql .= join(",", $tmp);
    $tmp = [];
    if (is_array($id)) {
        foreach ($id as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
        $sql .= " where " . join(" && ", $tmp);
    } else if (is_numeric($id)) {
        $sql .= " where `id`='$id'";
    } else {
        echo "錯誤:參數的資料型態必須是數字或是陣列";
    }

    return $pdo->exec($sql);
    
}

function insert($table, $values)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
    $pdo = new PDO($dsn, 'root', '');

    $sql = "insert into `$table` ";
    $cols = "(`" . join("`,`", array_keys($values)) . "`)";

    $vals = "('" . join("','", $values) . "')";


    $sql = $sql . $cols . " values " . $vals;


    return $pdo->exec($sql);
}

function del($table, $id)
{
    include "pdo.php";

    $sql = "delete from `$table` where";
    

    if (is_array($id)) {
        
        foreach ($id as $col => $value) {
            $tmp[] = "`$col`='$value'";
            
        }
        $sql .= join(" && ", $tmp);
    } else if (is_numeric($id)) {
        $sql .= " `id`='$id'";
    } else {
        echo "錯誤:參數的資料型態必須是數字或陣列";
    }
    

    return $pdo->exec($sql);


}

// directDump 秀出陣列 用成函式
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
