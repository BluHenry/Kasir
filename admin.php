<?php
    // session_start();
    include 'koneksi.php';

    $sql = "SELECT * FROM produk";
    $result = $koneksi->query($sql);
    $produks = $result-> fetch_all(MYSQLI_ASSOC);

?>





<!DOCTYPE html>
<html>
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #3498db, #85c1e9);
            margin: 0;
            padding: 0;
        }

        /* Container utama */
        .container {
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        /* Judul */
        .container p {
            font-size: 18px;
            font-weight: bold;
            color: #555;
        }

        h1 {
            margin-top: 5px;
            color: #2c3e50;
        }

        /* Link tombol */
        a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 6px;
            margin: 5px;
            display: inline-block;
        }

        /* Tombol atas */
        a[href="tambahAdmin.php"] {
            background: #3498db;
            color: white;
        }

        .transaksi {
            background: #5dade2;
            color: white;
        }

        /* Logout */
        a[href="index.php"] {
            background: #e74c3c;
            color: white;
            float: right;
        }

        /* Table */
        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 10px;
        }

        /* Header */
        thead {
            background: #2980b9;
            color: white;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        /* Zebra table */
        tbody tr:nth-child(even) {
            background: #f2f2f2;
        }

        /* Hover efek */
        tbody tr:hover {
            background: #d6eaf8;
        }

        /* Tombol aksi */
        td a {
            padding: 6px 10px;
            border-radius: 5px;
            font-size: 13px;
        }

        /* Edit */
        td a:first-child {
            background: #27ae60;
            color: white;
        }

        /* Delete */
        td a:last-child {
            background: #e74c3c;
            color: white;
        }
</style>
</head>
<body>
    
<div class="body">

    <div class="container">
        <p> Admin dashboard </p>
        <h1> data produk </h1>
        <a href="tambahAdmin.php"> Tambah produk </a>
        <a href="Data_penjualan/penjualan.php" class="transaksi"> Transaksi </a>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nama produk</th>
                    <th>Harga</th>
                    <th>stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=0; foreach ($produks as $produk):?>
                    <tr>
                        <td><?=  ++$no; ?> </td>
                        <td><?= $produk['Nama_produk'] ?></td>
                        <td><?= $produk['harga'] ?></td>
                        <td><?= $produk['stok'] ?></td>
                        <td>
                            <a href="EditAdminProduk.php?id=<?= $produk['id'] ?>">edit</a>
                            <a href="HapusAdminProduk.php?id=<?= $produk['id'] ?>"> Delete </a>
                        </td>
                    </tr>
                    <?php endforeach ?>
            </tbody>
        </table>
        <a href="index.php"> Log out </a>
    </div>
</div>

</body>
</html>