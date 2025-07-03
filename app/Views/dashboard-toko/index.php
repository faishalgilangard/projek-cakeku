<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php helper('form'); ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Dashboard Cakeku</h3>
            <small class="text-muted">Statistik pesanan dan penghasilan</small>
        </div>
        <div class="text-muted">
            <i class="ri-calendar-line"></i> <?= date('l, d M Y') ?> <i class="ri-time-line ms-3"></i> <span id="jam"></span>:<span id="menit"></span>:<span id="detik"></span>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card-metric text-center">
                <div><i class="ri-shopping-cart-line metric-icon"></i></div>
                <h4 class="fw-bold mt-3"><?= $totalOrders ?></h4>
                <div class="metric-label">Total Order</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-metric text-center">
                <div><i class="ri-money-dollar-circle-line metric-icon"></i></div>
                <h4 class="fw-bold mt-3">Rp <?= number_format($totalIncome, 0, ',', '.') ?></h4>
                <div class="metric-label">Total Penghasilan</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-metric text-center">
                <div><i class="ri-checkbox-circle-line metric-icon"></i></div>
                <h4 class="fw-bold mt-3">
                    <?= array_filter($transactions, fn($t) => $t['status'] == 1) ? count(array_filter($transactions, fn($t) => $t['status'] == 1)) : 0 ?>
                </h4>
                <div class="metric-label">Selesai</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-metric text-center">
                <div><i class="ri-time-line metric-icon"></i></div>
                <h4 class="fw-bold mt-3">
                    <?= array_filter($transactions, fn($t) => $t['status'] == 0) ? count(array_filter($transactions, fn($t) => $t['status'] == 0)) : 0 ?>
                </h4>
                <div class="metric-label">Pending</div>
            </div>
        </div>
    </div>

    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">Riwayat Transaksi</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Alamat</th>
                        <th>Total Harga</th>
                        <th>Ongkir</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
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
                                $s = (int)$trx['status'];
                                $statusList = [
                                    0 => ['Pending', 'badge-pending'],
                                    1 => ['Selesai', 'badge-selesai'],
                                    2 => ['Cancel', 'badge-cancel']
                                ];
                                ?>
                                <span class="badge badge-status <?= $statusList[$s][1] ?>">
                                    <?= $statusList[$s][0] ?>
                                </span>

                                <?= form_open('dashboard-toko/update-status/' . $trx['id'], ['method' => 'post', 'class' => 'mt-1']) ?>
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="0" <?= $s === 0 ? 'selected' : '' ?>>Pending</option>
                                    <option value="1" <?= $s === 1 ? 'selected' : '' ?>>Selesai</option>
                                    <option value="2" <?= $s === 2 ? 'selected' : '' ?>>Cancel</option>
                                </select>
                                <?= form_close() ?>
                            </td>
                            <td><?= date('d M Y H:i', strtotime($trx['created_at'])) ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal-<?= $trx['id'] ?>">
                                    <i class="ri-eye-line"></i> Detail
                                </button>
                                <a href="<?= base_url('dashboard-toko/cetak?id=' . $trx['id']) ?>" class="btn btn-sm btn-warning">Cetak</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php foreach ($transactions as $trx): ?>
        <div class="modal fade" id="detailModal-<?= $trx['id'] ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow">
                    <div class="modal-header bg-primary bg-opacity-10 border-0">
                        <h5 class="modal-title text-primary">
                            <i class="ri-receipt-2-line me-2"></i>Detail Pesanan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <p><strong>Nama:</strong> <?= esc($trx['username']) ?></p>
                        <p><strong>Alamat:</strong> <?= esc($trx['alamat']) ?></p>
                        <p><strong>Tanggal:</strong> <?= date('d M Y - H:i', strtotime($trx['created_at'])) ?></p>
                        <?php
                        $s = (int)$trx['status'];
                        $statusList = [
                            0 => ['Pending', 'badge-pending'],
                            1 => ['Selesai', 'badge-selesai'],
                            2 => ['Cancel', 'badge-cancel']
                        ];
                        ?>
                        <p><strong>Status:</strong> <span class="badge <?= $statusList[$s][1] ?>"> <?= $statusList[$s][0] ?> </span></p>
                        <hr>
                        <p><strong>Total Harga:</strong> Rp <?= number_format($trx['total_harga'], 0, ',', '.') ?></p>
                        <p><strong>Ongkir:</strong> Rp <?= number_format($trx['ongkir'], 0, ',', '.') ?></p>
                        <h6 class="mt-4">Produk:</h6>
                        <?php if (!empty($product[$trx['id']])): ?>
                            <ul class="list-group">
                                <?php foreach ($product[$trx['id']] as $p): ?>
                                    <li class="list-group-item d-flex align-items-center">
                                        <?php if ($p['foto'] && file_exists('img/' . $p['foto'])): ?>
                                            <img src="<?= base_url('img/' . $p['foto']) ?>" alt="" class="me-2" style="width: 36px; height: 36px; object-fit: cover; border-radius: 6px;">
                                        <?php endif; ?>
                                        <div class="flex-fill">
                                            <?= $p['nama'] ?> × <?= $p['jumlah'] ?> <br>
                                            <small class="text-muted">@ Rp <?= number_format($p['harga'], 0, ',', '.') ?></small>
                                        </div>
                                        <div><strong>Rp <?= number_format($p['subtotal_harga'], 0, ',', '.') ?></strong></div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted">Tidak ada produk.</p>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <a href="<?= base_url('dashboard-toko/cetak?id=' . $trx['id']) ?>" class="btn btn-primary" target="_blank">Cetak Struk</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<style>
    .card-metric {
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        background: #fff;
        transition: 0.3s;
    }

    .card-metric:hover {
        transform: translateY(-4px);
    }

    .metric-icon {
        font-size: 2rem;
        color: #6366f1;
    }

    .metric-label {
        color: #6b7280;
    }

    .badge-status {
        padding: 0.4rem 0.75rem;
        border-radius: 999px;
        font-size: 0.75rem;
    }

    .badge-pending {
        background: #fffbeb;
        color: #b45309;
    }

    .badge-selesai {
        background: #ecfdf5;
        color: #047857;
    }

    .badge-cancel {
        background: #fef2f2;
        color: #b91c1c;
    }
</style>

<script>
    function waktu() {
        const now = new Date();
        document.getElementById("jam").textContent = String(now.getHours()).padStart(2, '0');
        document.getElementById("menit").textContent = String(now.getMinutes()).padStart(2, '0');
        document.getElementById("detik").textContent = String(now.getSeconds()).padStart(2, '0');
        setTimeout(waktu, 1000);
    }
    waktu();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<?= $this->endSection() ?>