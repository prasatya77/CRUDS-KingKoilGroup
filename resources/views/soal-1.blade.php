<?php
function funSameText($string1, $string2) {
    // NOTE Untuk menghapus spasi dan mengubah text menjadi huruf kecil
    $string1 = strtolower(str_replace(' ', '', $string1));
    $string2 = strtolower(str_replace(' ', '', $string2));

    // NOTE Hitung kemunculan setiap huruf
    $count1 = array_count_values(str_split($string1));
    $count2 = array_count_values(str_split($string2));

    // NOTE Cek Apakah memiliki elemnt yang sama
    return $count1 == $count2;
}

// NOTE Menjalankan Fungsi dengan Nilai
$input1a = "Race";
$input1b = "Care";
echo ('Input : '.$input1a.' & '.$input1b);
echo "<br>";
echo funSameText($input1a, $input1b) ? 'True' : 'False';
echo "<br><br>";

$input1a = "Robert";
$input1b = "Terobs";
echo ('Input : '.$input1a.' & '.$input1b);
echo "<br>";
echo funSameText($input1a, $input1b) ? 'True' : 'False';
echo "<br><br>";

$input1a = "Astronomer";
$input1b = "Moon starer";
echo ('Input : '.$input1a.' & '.$input1b);
echo "<br>";
echo funSameText($input1a, $input1b) ? 'True' : 'False';
echo "<br>";

?>