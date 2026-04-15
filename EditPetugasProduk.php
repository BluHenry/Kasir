<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $sql = "SELECT * FROM produk WHERE id=?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    $result = $stmt->get_result();
    $produk = $result->fetch_assoc();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $NamaProduk = $_POST['product'];
    $Harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $id = $_GET['id'];

    $sql = "UPDATE produk SET Nama_produk=?, harga=?, stok=? WHERE id=?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("siii", $NamaProduk, $Harga, $stok, $id);
    $result = $stmt->execute();

    if ($result) {
        header("Location:petugas.php");
    }
}

?>




<!DOCTYPE html>
<html>
    <head>
        <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #34db7a, #35db75);
            margin: 0;
            padding: 0;
        }

        .w {
            margin: 25px; 
        }
        </style>
    </head>
    <body>
    <h1> Edit Produk </h1>
    <form action="" method="POST">
        <div class="w">
            <label> Nama produk </label>
            <input type="text" name="product" value="<?= $produk['Nama_produk'] ?>" required>
        </div>
        <div class="w">
            <label> Harga </label>
            <input type="number" name="harga" value="<?= $produk['harga'] ?>">
        </div>
        <div class="w">
            <label> Stok </label>
            <input type="number" name="stok" value="<?= $produk['stok'] ?>">
        </div>
        <button class="w" type="submit"> UPDATE produk</button>
        <a href="petugas.php">kembali</a>
    </form>

    </body>
</html>