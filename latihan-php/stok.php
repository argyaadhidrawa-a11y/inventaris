<?php
// 1. Siapkan data: 4 barang
$barang = [
    ['nama' => 'Mouse USB', 'stok' => 12, 'harga' => 75000],
    ['nama' => 'Kertas A4', 'stok' => 40, 'harga' => 55000],
    ['nama' => 'Spidol', 'stok' => 3, 'harga' => 12000],
    ['nama' => 'Flashdisk', 'stok' => 2, 'harga' => 90000],
];

// --- BAGIAN 1: Menghitung total nilai stok ---
$totalNilai = 0;
foreach ($barang as $b) {
    $totalNilai += $b['stok'] * $b['harga'];
}
echo "Total Nilai Stok: Rp" . number_format($totalNilai, 0, ',', '.') . "\n\n";

// --- BAGIAN 2: Menyaring dan Mengurutkan ---
// Saring: hanya stok 5 ke bawah
$hampirHabis = array_filter($barang, fn($b) => $b['stok'] <= 5);

echo "Barang Hampir Habis:\n";
foreach ($hampirHabis as $b) {
    echo "- {$b['nama']} (sisa {$b['stok']})\n";
}

// Urutkan: harga termahal di atas
usort($barang, fn($a, $b) => $b['harga'] <=> $a['harga']);
echo "\nUrutan Harga Termahal:\n";
foreach ($barang as $b) {
    echo "- {$b['nama']} (Rp" . number_format($b['harga'], 0, ',', '.') . ")\n";
}