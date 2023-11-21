<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <h1>全域變數和區域變數</h1>
    <h2>藍色課本範例5-18</h2>
    <?php
    $msg = "Hello, This is outside of Func1().";
    echo $msg . "<br>";
    Func1();
    echo $msg . "<br>";

    function func1()
    {
        global $msg;

        // 修改全域變數 $msg 的值為 "Hello, This is inside of Func1()."
        $msg = "Hello, This is inside of Func1().";
        // 在 HTML 中顯示修改後的全域變數 $msg 的值，顯示的文字是 "Hello, This is inside of Func1()."
        echo $msg . "<br>";
    }
    ?>
    <h2>與chatGPT釐清之範例</h2>
    <h3>函式內沒有加上global全域變數</h3>
    <?php

    // 宣告全域變數 $globalVar，並初始化為 "I'm a global variable."
    $globalVar = "I'm a global variable.";

    // 在全域範圍輸出初始的全域變數 $globalVar 的值
    echo $globalVar . "<br>"; // 輸出：I'm a global variable.

    // 呼叫函式 exampleFunction()，這裡不再在函式內部使用 global 關鍵字
    exampleFunction();

    // 再次在全域範圍輸出修改後的全域變數 $globalVar 的值
    echo $globalVar; // 輸出：I'm changed inside the function.

    // 定義函式 exampleFunction()
    function exampleFunction()
    {
        // 區域變數 $localVar，初始化為 "I'm a local variable."
        $localVar = "I'm a local variable.";


        // 全域變數不變，因為沒有用global所以不影響
        // 修改區域變數 $globalVar
        $globalVar = "I'm changed inside the function.";
    }

    ?>
    <hr>
    <h3>函式內 有加上 global全域變數</h3>
    <?php

    // 宣告全域變數 $globalVar，並初始化為 "I'm a global variable."
    $globalVar = "I'm a global variable.";

    // 在全域範圍輸出初始的全域變數 $globalVar 的值
    echo $globalVar . "<br>"; // 輸出：I'm a global variable.

    // 呼叫函式 exampleFunction()，這裡不再在函式內部使用 global 關鍵字
    exampleFunction2();

    // 再次在全域範圍輸出修改後的全域變數 $globalVar 的值
    echo $globalVar; // 輸出：I'm changed inside the function.

    // 定義函式 exampleFunction()
    function exampleFunction2()
    {
        // 區域變數 $localVar，初始化為 "I'm a local variable."
        $localVar = "I'm a local variable.";
        
        // 使用 global 關鍵字聲明全域變數
        global $globalVar;

        // 修改全域變數的值
        $globalVar = "I'm changed inside the function.";
    }

    ?>

</body>

</html>