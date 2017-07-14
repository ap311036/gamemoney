<?php

//var_dump($viewData['topDeposit']);

echo '<tr>
    <th>名次</th>
    <th>暱稱</th>
    <th>等級</th>
    <th>聯盟點數</th>
</tr>';

//var_dump($viewData['topDeposit'][0]['name']);
if (@$viewData['topDeposit'][0] != NULL) {
    for ($i = 0; $i < 15; $i++) {
        if (isset($viewData['topDeposit'][$i])) {
            $name = $viewData['topDeposit'][$i]['name'];
            $sum = number_format($viewData['topDeposit'][$i]['point']);
            $lv = 1;
            $rank = $i + 1;
           
        } else {
            $name = '';
            $sum = '';
            $lv = '';
            $rank = '';
        }

echo "<tr style=overflow:hidden;height:23px>
    <td>$rank</td>
    <td>$name</td>
    <td>$lv</td>
    <td>$sum</td>
</tr>";
    }
} else {
    echo "<tr style=overflow:hidden;height:23px>
    <td></td>
    <td>無資訊</td>
    <td></td>
    <td></td>
</tr>";
}



