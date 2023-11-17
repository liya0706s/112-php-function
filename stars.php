<style>
    *{
        font-family: 'Courier New', Courier, monospace;
    }
</style>

<h2>正三角形</h2>
<?php
// echo eq_triangle(5);
// echo eq_triangle(11);
// echo eq_triangle(6);
// echo diamond(5);
// echo rectangle(7);

stars('正三角形',7);
stars('菱形',7);
stars('矩形',7);
stars('矩形對角線',7);

// 宣告一支萬用函式叫做stars裡面的參數有...shape和size
function stars($shape, $size){
switch($shape){
    case '正三角形';
        eq_triangle($size);
    break;
    case '菱形';
        diamond($size);
    break;
    case '矩形';
        rectangle($size);
    break;
    case '矩形對角線';
        rectangle_cross($size);
    break;
}
}


// 宣告function，裡面包星星的程式碼
// 正三角形
function eq_triangle($size){
    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < ($size - 1 - $i); $j++) {
            echo " &nbsp;";
        }
        for ($k = 0; $k < ($i * 2 + 1); $k++) {
            echo "*";
        }
        echo "<br>";
    }
}
// 菱形
function diamond($size){
    $mid = floor(($size * 2 - 1) / 2);
    $tmp = 0;
    for ($i = 0; $i < ($size * 2 - 1); $i++) {

        if ($i <= $mid) {
            $tmp = $i;
        } else {
            $tmp = $tmp - 1;
            // 在函式中有變數要運算
            // tmp要在for迴圈外先宣告
            // 有這個值裡面才可以使用
        }

        for ($j = 0; $j < ($mid - $tmp); $j++) {
            echo "&nbsp";
        }
        for ($k = 0; $k < ($tmp * 2 + 1); $k++) {
            echo "*";
        }
        echo "<br>";
    }
}

// 矩形
function rectangle($size){
    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $size; $j++) {
            if ($i == 0 || $i == ($size-1)) {
                echo "*";
            } elseif ($j == 0 || $j == ($size-1)) {
                echo "*";
            } else {
                echo "&nbsp";
            }
        }
        echo "<br>";
    }
}

// 矩形對角線
function rectangle_cross($size){
    for($i=0;$i<$size;$i++){
        for($j=0;$j<$size;$j++){
            if($i==0 || $i==($size-1)){
                echo "*";
            }elseif($j==0 ||$j==($size-1)||$j==$i||$i+$j==($size-1)){
                echo "*";
            }else{
                echo "&nbsp";
            }
        }
        echo "<br>";
    }
}




?>