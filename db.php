<?php

// 呼叫 all() 函式，
// 並將函式返回的值（所有學生資料的陣列）賦值給變數 $rows
// 該情況下的像是，假設x=5;

$rows = all('students',['dept'=>'1']," order by id desc");

// 函式輸出
dd($rows);

// 定義函式 all() 用來取得學生資料
// null 是要有參數，可以是空的
function all($table=null, $where='',$other=''){
// where預設為空有彈性，可以不設計where條件空白
    $sql= "select * from `$table`";
    // where中的重複部分
    $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
    $pdo = new PDO($dsn, 'root', '');

    // 要先判斷有這個資料表，且不是空的
    if (isset($table) && !empty($table)) {

        // where都有雷同的地方
        // 形成sql句子之前要判斷where是否為陣列
        if(is_array($where)){
            /**陣列轉換成字串
             * ['dept'=>'2', 'graduate_at'=>12] => where `dept`='2' && `graduate_at` = '12'
             * $sql="select * from `table` from where `dept`='2' && `graduate_at` = '12'"
             */
            if(!empty($where)){
                // 是陣列而且不是空的
                foreach($where as $col => $value){
                    $tmp[]="`$col`='$value'";
                }
                $sql .=" where ".join(" && ",$tmp);
            }else{
                // 如果不是的話$tmp只是空陣列
                // $sql="$a";
                // 以上廢話可省略?
                
            }

        }else{
            // 當他是字串，原句子
            $sql .= $where;
            // 資料表名稱可以改成$table參數
        }

        $sql .=$other;

        print_r($sql);
        $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        // associate關聯名稱變成只拿欄位名稱，不拿索引
        // num 關聯名稱變成只拿索引
        // 預設是both
        return $rows;
    } else {
        echo "錯誤:沒有指定的資料表名稱";
    }
}

// directDump
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
