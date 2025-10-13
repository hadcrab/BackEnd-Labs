<?php 
    function drawTable($cols, $rows, $color) {
    echo "<table border='1' cellspacing='0' cellpadding='5'>";

    for ($r = 1; $r <= $rows; $r++) {
        echo "<tr>";
        for ($c = 1; $c <= $cols; $c++) {
            $value = $r * $c;
            if ($r == 1 || $c == 1) {
                echo "<td style='font-weight: bold; text-align: center; background-color: $color;'>$value</td>";
            } else {
                echo "<td>$value</td>";
            }
        }
        echo "</tr>";
    }

    echo "</table>";
} 
?>
