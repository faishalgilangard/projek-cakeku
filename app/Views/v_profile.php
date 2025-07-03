<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php helper('form'); ?>

<div class="container mt-5">
    <h4>Edit Profil</h4>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?= form_open_multipart('profile/update') ?>
    <div class="mb-3">
        <label for="username" class="form-label">Nama</label>
        <input type="text" name="username" value="<?= esc($user['username']) ?>" class="form-control">
    </div>

    <div class="mb-3">
        <label for="profile_picture" class="form-label">Foto Profil</label><br>
        <?php if ($user['foto']): ?>
            <img src="<?= base_url('uploads/' . $user['foto']) ?>" alt="Profile" class="img-thumbnail mb-2" width="120">
        <?php endif; ?>
        <input type="file" name="foto" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <?= form_close() ?>
</div>

<?= $this->endSection() ?>