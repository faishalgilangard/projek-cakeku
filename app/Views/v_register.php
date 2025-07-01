<?= $this->extend('layout_clear') ?>
<?= $this->section('content') ?>
<?php
$username = [
    'name' => 'username',
    'id' => 'username',
    'class' => 'form-control',
    'required' => true
];
$email = [
    'name' => 'email',
    'id' => 'email',
    'class' => 'form-control',
    'type' => 'email',
    'required' => true
];
$password = [
    'name' => 'password',
    'id' => 'password',
    'class' => 'form-control',
    'type' => 'password',
    'required' => true
];
?>
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                <div class="d-flex justify-content-center py-4">
                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                        <img src="assets/img/logo.png" alt="">
                        <span class="d-none d-lg-block">Warung Ical</span>
                    </a>
                </div><!-- End Logo -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Register Account</h5>
                            <p class="text-center small">Fill the form to create an account</p>
                        </div>
                        <?php if (session()->getFlashData('failed')): ?>
                            <div class="col-12 alert alert-danger" role="alert">
                                <hr>
                                <p class="mb-0">
                                    <?= session()->getFlashData('failed') ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        <?php if (session()->getFlashData('success')): ?>
                            <div class="col-12 alert alert-success" role="alert">
                                <hr>
                                <p class="mb-0">
                                    <?= session()->getFlashData('success') ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        <?= form_open('register', 'class = "row g-3 needs-validation"') ?>
                        <div class="col-12">
                            <label for="yourUsername" class="form-label">Username</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <?= form_input($username) ?>
                                <div class="invalid-feedback">Please enter your username.</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="yourEmail" class="form-label">Email</label>
                            <?= form_input($email) ?>
                            <div class="invalid-feedback">Please enter a valid email address!</div>
                        </div>
                        <div class="col-12">
                            <label for="yourPassword" class="form-label">Password</label>
                            <?= form_input($password) ?>
                            <div class="invalid-feedback">Please enter your password!</div>
                        </div>
                        <div class="col-12">
                            <?= form_submit('submit', 'Register', ['class' => 'btn btn-success w-100']) ?>
                        </div>
                        <?= form_close() ?>
                        <div class="col-12 mt-2 text-center">
                            <a href="<?= base_url('login') ?>">Sudah punya akun? Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>