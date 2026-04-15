







<?php
session_start();
include dirname(__DIR__) . '/koneksi.php';

// hitung total
$total = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $total += $item['subtotal'];
}

// 1. SIMPAN KE TABEL penjualan
$koneksi->query("INSERT INTO penjualan (TanggalPenjualan, TotalHarga) VALUES (NOW(), '$total')");

// ambil id terakhir
$penjualan_id = $koneksi->insert_id;


// 2. SIMPAN KE detailpenjualan
foreach ($_SESSION['keranjang'] as $item) {

    $koneksi->query("INSERT INTO detailpenjualan 
    (PenjualanID, ID, JumlahProduk, SubTotal)
    VALUES 
    ('$penjualan_id', '{$item['id']}', '{$item['qty']}', '{$item['subtotal']}')");

    // 3. UPDATE STOK
    $koneksi->query("UPDATE produk SET stok = stok - {$item['qty']} WHERE id = {$item['id']}");}


// 4. KOSONGKAN KERANJANG
unset($_SESSION['keranjang']);

echo "<script>alert('Transaksi berhasil!');window.location='penjualan_Petugas.php';</script>";
?>