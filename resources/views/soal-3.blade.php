<!DOCTYPE html>
<html>
<body>

<?php
function funcMatrixHelp($n) {
    $matrix = [];

    for ($i = 0; $i < $n; $i++) {
        $row = [];
        for ($j = 0; $j < $n; $j++) {
            if ($i == $j) {
                $row[] = $n;
            } else {
                $row[] = 0;
            }
        }
        $matrix[] = $row;
    }

    return $matrix;
}

function funcShowMatrix($matrix) {
    foreach ($matrix as $row) {
        echo implode(" ", $row) . "<br>";
    }
}

// NOTE Menjalankan Fungsi dengan Nilai
$input = 4;
$matrix = funcMatrixHelp($input);
funcShowMatrix($matrix);
echo("<br>");

$input = 9;
$matrix = funcMatrixHelp($input);
funcShowMatrix($matrix);
echo("<br>");

$input = 7;
$matrix = funcMatrixHelp($input);
funcShowMatrix($matrix);
echo("<br>");
?>


</body>
</html>
