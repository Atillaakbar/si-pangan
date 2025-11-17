<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-Pangan | Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="sidebar-header">
                <button class="hamburger-btn" style="background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer;"><i class="fas fa-bars"></i></button>
            </div>
            <ul class="sidebar-menu">
                <li><a href="<?= site_url('admin/dashboard') ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                <li><a href="<?= site_url('admin/users') ?>"><i class="fas fa-users"></i> <span>Manajemen Pengguna</span></a></li>
                <li><a href="<?= site_url('admin/monitoring') ?>"><i class="fas fa-desktop"></i> <span>Monitoring data hasil panen</span></a></li>
            </ul>
        </nav>

        <div class="main-content">
            <header class="header">
                <div class="header-left">
                    <strong>SI-Pangan</strong> | Sistem Informasi Monitoring Tanaman Pangan
                </div>
                <div class="header-right">
                    <span>Halo Admin!</span>
                    <a href="<?= site_url('logout') ?>" style="margin-left: 15px; color: red; text-decoration: none; font-weight: bold;">
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