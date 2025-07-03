<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        h2 {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <h2>Laporan Transaksi CakeKu</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Alamat</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Total</th>
                <th>Produk</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($transactions as $trx): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= esc($trx['username']) ?></td>
                    <td><?= esc($trx['alamat']) ?></td>
                    <td><?= date('d-m-Y H:i', strtotime($trx['created_at'])) ?></td>
                    <td><?php
                        $statusList = [0 => 'Pending', 1 => 'Selesai', 2 => 'Cancel'];
                        echo $statusList[$trx['status']] ?? '-';
                        ?></td>
                    <td>Rp <?= number_format($trx['total_harga'], 0, ',', '.') ?></td>
                    <td>
                        <ul style="margin:0; padding-left:18px;">
                            <?php if (!empty($product[$trx['id']])): foreach ($product[$trx['id']] as $p): ?>
                                    <li><?= esc($p['nama']) ?> × <?= $p['jumlah'] ?></li>
                            <?php endforeach;
                            endif; ?>
                        </ul>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>