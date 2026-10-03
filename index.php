<?php
require_once './services/config.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Sistem Pemesanan Kafe</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Sistem Pemesanan Kafe (Dashboard Data)</h1>

    <div class="grid-container">

        <!-- TABEL MENU -->
        <div class="card">
            <h2>Tabel Menu</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Menu</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_menu = "SELECT * FROM menu";
                    $query_menu = mysqli_query($koneksi, $sql_menu);

                    while ($row = mysqli_fetch_assoc($query_menu)) {
                        echo "<tr>";
                        echo "<td>" . $row['id_menu'] . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_menu']) . "</td>";
                        echo "<td><span class='badge'>" . htmlspecialchars($row['kategori']) . "</span></td>";
                        echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                        echo "<td>" . $row['stok'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- TABEL PESANAN -->
        <div class="card">
            <h2>Tabel Pesanan</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Metode</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_pesanan = "SELECT * FROM pesanan";
                    $query_pesanan = mysqli_query($koneksi, $sql_pesanan);

                    while ($row = mysqli_fetch_assoc($query_pesanan)) {
                        echo "<tr>";
                        echo "<td>" . $row['id_pesanan'] . "</td>";
                        echo "<td>" . $row['tanggal_pesanan'] . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_pelanggan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['metode_pembayaran']) . "</td>";
                        echo "<td>Rp " . number_format($row['total_bayar'], 0, ',', '.') . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- TABEL DETAIL PESANAN -->
        <div class="card">
            <h2>Tabel Detail Pesanan</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Detail</th>
                        <th>ID Pesanan</th>
                        <th>ID Menu</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_detail = "SELECT * FROM detail_pesanan";
                    $query_detail = mysqli_query($koneksi, $sql_detail);

                    while ($row = mysqli_fetch_assoc($query_detail)) {
                        echo "<tr>";
                        echo "<td>" . $row['id_detail'] . "</td>";
                        echo "<td>" . $row['id_pesanan'] . "</td>";
                        echo "<td>" . $row['id_menu'] . "</td>";
                        echo "<td>" . $row['jumlah'] . "</td>";
                        echo "<td>Rp " . number_format($row['subtotal'], 0, ',', '.') . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- TABEL DETAIL PESANAN LENGKAP (JOIN) -->
        <div class="card full-width">
            <h2>Detail Pesanan Lengkap (Query JOIN - ID Pesanan 1)</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Menu</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Metode Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_join = "SELECT 
                                    p.id_pesanan,
                                    p.tanggal_pesanan,
                                    p.nama_pelanggan,
                                    m.nama_menu,
                                    m.harga AS harga_satuan,
                                    d.jumlah,
                                    d.subtotal,
                                    p.metode_pembayaran
                                FROM detail_pesanan d
                                JOIN pesanan p ON d.id_pesanan = p.id_pesanan
                                JOIN menu m ON d.id_menu = m.id_menu
                                WHERE p.id_pesanan = 1";

                    $query_join = mysqli_query($koneksi, $sql_join);

                    while ($row = mysqli_fetch_assoc($query_join)) {
                        echo "<tr>";
                        echo "<td>" . $row['id_pesanan'] . "</td>";
                        echo "<td>" . $row['tanggal_pesanan'] . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_pelanggan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_menu']) . "</td>";
                        echo "<td>Rp " . number_format($row['harga_satuan'], 0, ',', '.') . "</td>";
                        echo "<td>" . $row['jumlah'] . "</td>";
                        echo "<td>Rp " . number_format($row['subtotal'], 0, ',', '.') . "</td>";
                        echo "<td>" . htmlspecialchars($row['metode_pembayaran']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>