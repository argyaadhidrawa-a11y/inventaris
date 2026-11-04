<?php
// SOAL 1: Konversi nilai ke grade
function grade(int $nilai): string {
    if ($nilai < 0 || $nilai > 100) return "tidak valid";
    if ($nilai >= 85) return "A";
    if ($nilai >= 70) return "B";
    if ($nilai >= 55) return "C";
    return "D";
}

// SOAL 2: Diskon belanja bertingkat
function totalBelanja(float $total): float {
    if ($total >= 500000) {
        return $total * 0.90; // Diskon 10%
    } elseif ($total >= 200000) {
        return $total * 0.95; // Diskon 5%
    }
    return $total; // Diskon 0%
}

// SOAL 3: Nilai terbesar tanpa max()
function terbesar(array $angka): int|float {
    $max = $angka[0]; // Ambil elemen pertama sebagai pembanding awal
    for ($i = 1; $i < count($angka); $i++) {
        if ($angka[$i] > $max) {
            $max = $angka[$i];
        }
    }
    return $max;
}

// === UJI COBA ===
echo "=== Soal 1 ===\n";
echo "90: " . grade(90) . "\n";
echo "85: " . grade(85) . "\n";
echo "70: " . grade(70) . "\n";
echo "54: " . grade(54) . "\n";
echo "101: " . grade(101) . "\n";

echo "\n=== Soal 2 ===\n";
echo "150000: " . totalBelanja(150000) . "\n";
echo "200000: " . totalBelanja(200000) . "\n";
echo "300000: " . totalBelanja(300000) . "\n";
echo "600000: " . totalBelanja(600000) . "\n";

echo "\n=== Soal 3 ===\n";
echo "[7, 21, 3, 15]: " . terbesar([7, 21, 3, 15]) . "\n";
echo "[-4, -9, -2]: " . terbesar([-4, -9, -2]) . "\n";