<?php
session_start();
include dirname(__DIR__) . '/koneksi.php';

$produk = $koneksi->query("SELECT * FROM produk");

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// TAMBAH KE KERANJANG
if (isset($_POST['tambah'])) {
    $id = $_POST['produk_id'];
    $qty = $_POST['qty'];

    $data = $koneksi->query("SELECT * FROM produk WHERE id='$id'")->fetch_assoc();

    $_SESSION['keranjang'][] = [
        'id' => $id,
        'nama' => $data['Nama_produk'],
        'harga' => $data['harga'],
        'qty' => $qty,
        'subtotal' => $data['harga'] * $qty
    ];
}

// HITUNG TOTAL
$total = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $total += $item['subtotal'];
}
?>






<!DOCTYPE html>
<html>
<head>
<style>
body {
    font-family: Arial;
    background: linear-gradient(135deg, #3498db, #85c1e9);
}

.container {
    width: 90%;
    max-width: 900px;
    margin: 30px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
}

/* Form */
select, input, button {
    padding: 10px;
    margin: 5px;
}

button {
    background: #2980b9;
    color: white;
    border: none;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th {
    background: #2980b9;
    color: white;
}

td, th {
    padding: 10px;
    text-align: center;
}

.total {
    font-size: 20px;
    font-weight: bold;
    text-align: right;
}
</style>
</head>

<body>

<div class="container">

<h2>🧾 Transaksi Kasir</h2>

<!-- FORM TAMBAH -->
<form method="POST">
    <select name="produk_id">
        <?php while($p = $produk->fetch_assoc()) { ?>
            <option value="<?= $p['id'] ?>">
                <?= $p['Nama_produk'] ?> - Rp<?= $p['harga'] ?>
            </option>
        <?php } ?>
    </select>

    <input type="number" name="qty" placeholder="jumlah" required>
    <button name="tambah">Tambah</button>
</form>

<!-- KERANJANG -->
<table>
<tr>
    <th>Nama</th>
    <th>Harga</th>
    <th>jumlah</th>
    <th>Subtotal</th>
</tr>

<?php foreach ($_SESSION['keranjang'] as $item) { ?>
<tr>
    <td><?= $item['nama'] ?></td>
    <td><?= $item['harga'] ?></td>
    <td><?= $item['qty'] ?></td>
    <td><?= $item['subtotal'] ?></td>
</tr>
<?php } ?>

</table>

<p class="total">Total: Rp<?= $total ?></p>

<!-- SIMPAN -->
<form method="POST" action="simpan_transaksi.php">
    <button>💾 Simpan Transaksi</button>
</form>
<a href="../admin.php">Data barang</a>

</div>

</body>
</html>