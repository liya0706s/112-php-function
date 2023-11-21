<?php

// 全域變數
$globalVar = "I'm a global variable.";

function exampleFunction() {
    // 區域變數
    $localVar = "I'm a local variable.";

    // 使用全域變數
    global $globalVar;

    // 在函式內部使用區域變數和全域變數
    echo "Local Variable: " . $localVar . "<br>";
    echo "Global Variable: " . $globalVar . "<br>";
}

// 呼叫函式
exampleFunction();

// 嘗試在函式外部訪問區域變數（會導致錯誤）
// $localVar 的作用範圍僅限於 exampleFunction() 函式內部，所以在函式外部使用它會導致錯誤
// echo "Trying to access local variable outside the function: " . $localVar;

// 在函式外部訪問全域變數
echo "Accessing global variable outside the function: " . $globalVar;
