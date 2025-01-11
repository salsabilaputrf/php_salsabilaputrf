<?php

$jml = $_GET['jml'];
// Agar ukuran kolom sama 
echo "<style> td { width: 70px; font-weight: bold; } </style>";

echo "<table border=1>\n";
for ($a = $jml; $a > 0; $a--)
{
     // Karena setiap baris berisi deret angka dari $a hingga 1, 
    // kita dapat menggunakan rumus deret aritmatika untuk menghitung total pada baris tersebut.
    $total = ($a * ($a + 1)) / 2;
    
    // Tampilkan total di atas baris
    echo "<tr><td colspan='$jml'>TOTAL: $total</td></tr>\n";

    // Tampilkan baris angka
    echo "<tr>\n";
    for ($b = $a; $b > 0; $b--) {
        echo "<td>$b</td>";
    }
    echo "</tr>\n";
}
echo "</table>";

?>