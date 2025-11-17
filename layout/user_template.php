<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-Pangan | <?= isset($title) ? esc($title) : 'Dashboard User' ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="sidebar-header">
                <h3 style="margin: 0;">SI-Pangan</h3>
            </div>
            <ul class="sidebar-menu">
                <li><a href="<?= site_url('user/dashboard') ?>"><i class="fas fa-chart-bar"></i> <span>Dashboard</span></a></li>
                <li><a href="<?= site_url('user/panen/new') ?>"><i class="fas fa-plus-circle"></i> <span>Input Data Panen</span></a></li>
                <li><a href="<?= site_url('user/panen') ?>"><i class="fas fa-box-open"></i> <span>Manajemen Panen</span></a></li>
                
                <li><a href="<?= site_url('user/monitoring') ?>"><i class="fas fa-desktop"></i> <span>Monitoring Produksi</span></a></li>
                
                <li><a href="#"><i class="fas fa-layer-group"></i> <span>Grafik Perkembangan</span></a></li>
                <li><a href="#"><i class="fas fa-file-alt"></i> <span>Laporan & Analisis</span></a></li>
            </ul>
        </nav>

        <div class="main-content">
            <header class="header">
                <div class="header-left">
                    <strong>SI-Pangan</strong> | Sistem Informasi Monitoring Tanaman Pangan
                </div>
                <div class="header-right">
                    <span>Halo <?= esc(session()->get('nama')) ?>!</span>
                    <a href="<?= site_url('logout') ?>" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </header>
            <main class="content">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>
    <?= $this->renderSection('script') ?>
</body>
</html>