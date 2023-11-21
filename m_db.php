<?php
date_default_timezone_set("Asia/Taipei");
$dsn = "mysql:host=localhost;charset=utf8;dbname=school";
$pdo = new PDO($dsn, 'root', '');
$rows=all('students',['dept'=>'3']);
//$rows=all('students',['dept'=>'3']);
//$row=find('students',10);
//$row=find('students',['dept'=>'1','graduate_at'=>'23']);
//$rows=all('students',['dept'=>'1','graduate_at'=>'23']);
//echo "<h3>相同條件使用find()</h3>";
//dd($row);
//echo "<hr>";;
//echo "<h3>相同條件使用all()</h3>";
//dd($rows);
function all($table = null, $where = '', $other = '')
{
    global $pdo;
    $sql = "select * from `$table` ";

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
        //echo 'all=>'.$sql;
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
        $sql .= " where " . join(" && ", $tmp);
    } else if (is_numeric($id)) {
        $sql .= " where `id`='$id'";
    } else {
        echo "錯誤:參數的資料型態比須是數字或陣列";
    }
    //echo 'find=>'.$sql;
    $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function update($table, $id, $cols)
{
    global $pdo;

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
        echo "錯誤:參數的資料型態比須是數字或陣列";
    }
    // echo $sql;
    return $pdo->exec($sql);
}

function insert($table, $values)
{
    global $pdo;

    $sql = "insert into `$table` ";
    $cols = "(`" . join("`,`", array_keys($values)) . "`)";
    $vals = "('" . join("','", $values) . "')";

    $sql = $sql . $cols . " values " . $vals;

    //echo $sql;

    return $pdo->exec($sql);
}

function del($table, $id)
{
    global $pdo;
    $sql = "delete from `$table` where ";

    if (is_array($id)) {
        foreach ($id as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
        $sql .= join(" && ", $tmp);
    } else if (is_numeric($id)) {
        $sql .= " `id`='$id'";
    } else {
        echo "錯誤:參數的資料型態比須是數字或陣列";
    }
    //echo $sql;

    return $pdo->exec($sql);
}

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
