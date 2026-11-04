<?php
// 1. Fungsi hitungDiskon
function hitungDiskon(float $harga, float $persen): float {
    if ($persen < 0 || $persen > 100) {
        return $harga; // Kembalikan harga asli jika persen tidak valid
    }
    $potongan = $harga * $persen / 100;
    return $harga - $potongan;
}

// 2. Fungsi cariBarang
function cariBarang(array $daftar, string $kata): ?array {
    $kata = strtolower($kata);
    foreach ($daftar as $b) {
        if (str_contains(strtolower($b['nama']), $kata)) {
            return $b;
        }
    }
    return null;
}

// 3. Fungsi stokPerKategori
function stokPerKategori(array $daftar): array {
    $result = [];
    foreach ($daftar as $b) {
        $kat = $b['kategori'];
        if (!isset($result[$kat])) {
            $result[$kat] = 0;
        }
        $result[$kat] += $b['stok'];
    }
    return $result;
}

// === UJI COBA (Simulasi Masukan) ===
$barang = [
    ['nama' => 'Mouse USB', 'stok' => 12, 'harga' => 75000, 'kategori' => 'Elektronik'],
    ['nama' => 'Kertas A4', 'stok' => 40, 'harga' => 55000, 'kategori' => 'ATK'],
    ['nama' => 'Spidol', 'stok' => 3, 'harga' => 12000, 'kategori' => 'ATK'],
    ['nama' => 'Flashdisk', 'stok' => 2, 'harga' => 90000, 'kategori' => 'Elektronik'],
];

echo "=== Uji hitungDiskon ===\n";
echo "Diskon 10%: " . hitungDiskon(100000, 10) . "\n"; // 90000
echo "Diskon 150%: " . hitungDiskon(100000, 150) . "\n"; // 100000

echo "\n=== Uji cariBarang ===\n";
$cari = cariBarang($barang, 'MOUSE');
echo $cari ? $cari['nama'] : "Tidak ada"; // Mouse USB

echo "\n=== Uji stokPerKategori ===\n";
print_r(stokPerKategori($barang)); // Elektronik 14, ATK 43