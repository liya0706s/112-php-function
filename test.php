<?php
// 測試陣列內有值和沒有值，join產生的效果

$tmp1=[];
$tmp2=['aa','bb','cc'];

echo "where ".join(" && ",$tmp1)." order by ....";
echo "<hr>";
echo "where ".join(" && ",$tmp2)." order by ....";

// 驗證陣列裡面有值跟沒有值，比照組和對照組
// join字串有沒有不同的效果
// 陣列中有值的顯示: aa && bb && cc
// 如果是空陣列的話，join根本沒東西
// 空陣列的話，要把where拿掉


?>