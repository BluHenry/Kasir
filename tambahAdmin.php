<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $NamaProduk = $_POST['product'];
    $Harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO produk (Nama_produk, harga, stok) VALUES (?,?,?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sii", $NamaProduk, $Harga, $stok);
    $result = $stmt->execute();

    if ($result) {
        header("Location: admin.php");
    } else {
        echo "ada yang salah tuh";
    }

}
?>



<!DOCTYPE html>
<html>
    <head>
<style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #3498db, #3599db);
    margin: 0;
    padding: 0;
}
.data {
    padding: 25px;
}
a {
    margin: 25px;

}
</style>
    </head>
    <body>
        <h1> Tambah produk </h1>
        <div class="container">
            <form method="post" action="">
                <div class="data">
                    <label for=""> Nama Produk </label>
                    <input type="text" name="product" required>
                </div>
                <div class="data">
                    <label for=""> Harga </label>
                    <input type="number" name="harga" required>
                </div>
                <div class="data">
                    <label for=""> stok </label>
                    <input type="number" name="stok" required>
                </div>
                <button type="submit"> Tambah produk </button>
                <a href="admin.php">kembali</a>
            </form>

        </div>
    </body>
</html>
