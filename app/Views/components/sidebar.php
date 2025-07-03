<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == '') ? "" : "collapsed" ?>" href="/">
                <i class="bi bi-grid"></i>
                <span>Home</span>
            </a>
        </li><!-- End Home Nav -->

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'katalog') ? "" : "collapsed" ?>" href="katalog">
                <i class="bi bi-card-list"></i>
                <span>Katalog</span>
            </a>
        </li><!-- End Katalog Nav -->

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'keranjang') ? "" : "collapsed" ?>" href="keranjang">
                <i class="bi bi-cart-check"></i>
                <span>Keranjang</span>
            </a>
        </li><!-- End Keranjang Nav -->
        <?php
        if (session()->get('role') == 'admin') {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (uri_string() == 'dashboard-toko') ? "" : "collapsed" ?>" href="dashboard-toko">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard Toko</span>
                </a>
            </li><!-- End Dashboard Toko Nav -->
            <li class="nav-item">
                <a class="nav-link <?php echo (uri_string() == 'produk') ? "" : "collapsed" ?>" href="produk">
                    <i class="bi bi-receipt"></i>
                    <span>produk</span>
                </a>
            </li><!-- End produk Nav -->
        <?php
        }
        ?>
        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'history') ? "" : "collapsed" ?>" href="history">
                <i class="bi bi-person"></i>
                <span>History</span>
            </a>
        </li><!-- End Profile Nav -->

    </ul>

</aside><!-- End Sidebar-->