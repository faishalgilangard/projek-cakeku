<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak Struk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 40px;
            font-family: Arial;
            font-size: 14px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <h4 class="text-center mb-4">Struk Pembelian</h4>
        <p><strong>Username:</strong> <?= esc($trx['username']) ?></p>
        <p><strong>Alamat:</strong> <?= esc($trx['alamat']) ?></p>
        <p><strong>Tanggal:</strong> <?= date('d M Y H:i', strtotime($trx['created_at'])) ?></p>
        <p><strong>Status:</strong>
            <?php
            $statusList = [0 => 'Pending', 1 => 'Selesai', 2 => 'Cancel'];
            echo $statusList[$trx['status']] ?? 'Tidak Diketahui';
            ?>
        </p>
        <hr>
        <h6>Produk:</h6>
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($details as $d): ?>
                    <tr>
                        <td><?= $d['nama'] ?></td>
                        <td><?= $d['jumlah'] ?></td>
                        <td>Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($d['subtotal_harga'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><strong>Ongkir:</strong> Rp <?= number_format($trx['ongkir'], 0, ',', '.') ?></p>
        <h5><strong>Total Bayar:</strong> Rp <?= number_format($trx['total_harga'], 0, ',', '.') ?></h5>
    </div>
</body>

</html>