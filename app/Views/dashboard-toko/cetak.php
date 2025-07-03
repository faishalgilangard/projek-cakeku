<?php helper('form'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 40px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        h4 {
            margin-bottom: 20px;
        }

        @media print {

            nav,
            header,
            footer,
            .btn,
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="container">
        <h4 class="text-center mb-4">Laporan Transaksi</h4>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Alamat</th>
                    <th>Total Harga</th>
                    <th>Ongkir</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($transactions as $trx): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= esc($trx['username']) ?></td>
                        <td><?= esc($trx['alamat']) ?></td>
                        <td>Rp <?= number_format($trx['total_harga'], 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($trx['ongkir'], 0, ',', '.') ?></td>
                        <td>
                            <?php
                            $statusText = 'Belum Diketahui';
                            switch ((int)$trx['status']) {
                                case 0:
                                    $statusText = 'Pending';
                                    break;
                                case 1:
                                    $statusText = 'Selesai';
                                    break;
                                case 2:
                                    $statusText = 'Cancel';
                                    break;
                            }
                            ?>
                            <?= $statusText ?>
                        </td>
                        <td><?= date('d M Y H:i', strtotime($trx['created_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>