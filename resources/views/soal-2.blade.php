<!DOCTYPE html>
<html>
<body>

<?php
function funcFreqText($input) {
    // NOTE Untuk menghapus spasi dan mengubah text menjadi huruf kecil
    $input = str_replace(' ', '', strtolower($input));

    // NOTE Hitung kemunculan setiap huruf
    $letterCounts = array_count_values(str_split($input));

    // NOTE Menetukan Huruf yang terbanayak
    $maxCount = 0;
    $mostFrequentLetter = '';
    foreach ($letterCounts as $letter => $count) {
        if ($count > $maxCount) {
            $maxCount = $count;
            $mostFrequentLetter = $letter;
        }
    }

    return "Huruf '$mostFrequentLetter' muncul sebanyak $maxCount kali";
}

// NOTE Menjalankan Fungsi dengan Nilai
$input1 = "giffari";
echo funcFreqText($input1) . "<br>";

$input2 = "gunung arjuno";
echo funcFreqText($input2) . "<br>";

$input2 = "andika prasatya";
echo funcFreqText($input2) . "<br>";
?>



</body>
</html>
