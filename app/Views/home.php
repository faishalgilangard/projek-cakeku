<?php helper('form');
helper('number'); ?>
<!DOCTYPE html>
<html lang="en">
<link href="<?= base_url() ?>img/icon_cakeku.ico" rel="icon">
<link href="<?= base_url() ?>img/apple-touch-icon.png" rel="apple-touch-icon">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CakeKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #ff6b6b;
            --secondary-color: #ff8e8e;
            --light-color: #fff4f4;
            --dark-color: #4a4a4a;
        }

        body {
            background-color: #f9f9f9;
            font-family: 'Poppins', sans-serif;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
        }

        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .product-card .card-img-top {
            height: 180px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .stats-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .btn-cakeku {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 50px;
        }

        .btn-cakeku:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        .welcome-section {
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url('https://images.unsplash.com/photo-1578985545062-69928b1d9587');
            background-size: cover;
            border-radius: 15px;
            padding: 40px;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="fas fa-birthday-cake me-2"></i>CakeKu
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url() ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('katalog') ?>">Katalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('keranjang') ?>">Keranjang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <!-- Welcome Section -->
        <div class="welcome-section text-center">
            <img src="<?= base_url('img/logo_cakeku.png') ?>" alt="Logo CakeKu" style="max-width:180px; margin-bottom:20px;">
            <h1 class="display-4 fw-bold mb-3">Selamat Datang di CakeKu!</h1>
            <p class="lead mb-4">Temukan kue lezat untuk setiap momen spesial Anda</p>
            <a href="<?= base_url('katalog') ?>" class="btn btn-cakeku btn-lg">
                <i class="fas fa-utensils me-2"></i>Lihat Katalog
            </a>
        </div>

        <!-- Stats Section -->
        <div class="row mb-5">
            <div class="col-md-4 mb-3">
                <div class="card stats-card h-100">
                    <div class="card-body text-center py-4">
                        <h3><i class="fas fa-shopping-bag me-2"></i><?= $stats['total_orders'] ?></h3>
                        <p class="mb-0">Total Pesanan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stats-card h-100">
                    <div class="card-body text-center py-4">
                        <h3><i class="fas fa-chart-line me-2"></i><?= $stats['monthly_sales'] ?></h3>
                        <p class="mb-0">Penjualan Bulan Ini</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stats-card h-100">
                    <div class="card-body text-center py-4">
                        <h3><i class="fas fa-crown me-2"></i><?= $stats['popular_product'] ?></h3>
                        <p class="mb-0">Produk Terlaris</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Products -->
        <h2 class="mb-4 fw-bold"><i class="fas fa-star me-2"></i>Produk Unggulan</h2>
        <div class="row">
            <?php foreach ($featured_products as $product): ?>
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 product-card">
                        <div class="card-body d-flex flex-column align-items-center">
                            <img src="<?= base_url('img/' . $product['foto']) ?>" alt="<?= $product['nama'] ?>" width="300px" class="mb-3">
                            <h5 class="card-title text-center"><?= $product['nama'] ?><br><?= number_to_currency((float)$product['harga'], 'IDR') ?></h5>
                            <p class="card-text text-muted text-center"></p>
                            <a href="<?= base_url('katalog') ?>" class="btn btn-info rounded-pill mt-auto">Beli</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-5">
            <h3 class="mb-3">Temukan lebih banyak pilihan kue lezat di katalog kami</h3>
            <a href="<?= base_url('katalog') ?>" class="btn btn-cakeku btn-lg">
                <i class="fas fa-book-open me-2"></i>Buka Katalog Lengkap
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <h4><i class="fas fa-birthday-cake me-2"></i>CakeKu</h4>
            <p class="mb-3">Kue lezat untuk momen spesial Anda</p>
            <div class="mb-3">
                <a href="https://www.instagram.com/cake_ku_?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="text-white mx-2"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="https://wa.me/081542374955" class="text-white mx-2"><i class="fab fa-whatsapp fa-lg"></i></a>
                <a href="https://www.facebook.com/cakeku" class="text-white mx-2"><i class="fab fa-facebook fa-lg"></i></a>
            </div>
            <p class="mb-0">&copy; <?= date('Y') ?> CakeKu. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>