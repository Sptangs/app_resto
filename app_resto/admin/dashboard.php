<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Restoran</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        table h3{
           margin: auto;
           text-align: center
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Dashboard Restoran</h2>
    
    <h3>Daftar Pesanan</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Tanggal Pesanan</th>
            <th>Nama Pelanggan</th>
            <th>Total Bayar</th>
            <th>Status</th>
        </tr>
        <?php
            // Query untuk mendapatkan daftar pesanan dari database
            $no = 1;
            $pesanan = $dbo->select("tblorder a, tblpelanggan b where a.idpelanggan = b.idpelanggan", "a.*, b.nama_pelanggan");
            foreach ($pesanan as $row) {
                $totalBayar = 0;
                // Menghitung total bayar pesanan
                $orderDetails = $dbo->select("tblorderdetail where idorder= " . $row['idorder']);
                foreach ($orderDetails as $detail) {
                    $totalBayar += $detail['jumlah'] * $detail['harga'];
                }
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['tglorder'] ?></td>
                    <td><?= $row['nama_pelanggan'] ?></td>
                    <td><?= $totalBayar ?></td>
                    <td><?= ($row['total'] == null) ? 'Belum Lunas' : 'Lunas' ?></td>
                </tr>
                <?php
            }
        ?>
    </table>

    <h3>Daftar Menu</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Nama Menu</th>
            <th>Harga</th>
        </tr>
        <?php
            $daftarmenu = $dbo->select("tblmenu a, tblkategori b where a.idkategori=b.idkategori", "a.*, b.kategori ");
            foreach ($daftarmenu as $row) {
                ?>
                <tr>
                    <td><?= $row['idmenu'] ?></td>
                    <td><?= $row['kategori']?></td>
                    <td><?= $row['nama_menu'] ?></td>
                    <td><?= $row['harga'] ?></td>
                </tr>
                <?php
            }
        ?>
    </table>

    <h3>Jumlah Pendapatan</h3>
    <?php
        $totalPendapatan = 0;
        $pesanan = $dbo->select("tblorder");
        foreach ($pesanan as $order) {
            $totalPendapatan += $order['total'];
        }
        echo "<p>Total Pendapatan: $totalPendapatan</p>";
    ?>
</body>
</html>
