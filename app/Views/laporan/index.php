<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <h3 class="fw-bold mb-4">Laporan Transaksi</h3>
    <a href="<?= base_url('laporan/cetak') ?>" target="_blank" class="btn btn-success mb-3"><i class="ri-printer-line"></i> Cetak Laporan</a>
    <div class="alert alert-info">Klik tombol di atas untuk mencetak seluruh laporan transaksi.</div>
</div>
<?= $this->endSection() ?>