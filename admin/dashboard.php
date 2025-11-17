<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
    <div class="user-header-box" style="background-color: #2e7d32; color: white; padding: 25px; margin-bottom: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h2 style="margin: 0; font-size: 2.5rem;">Dashboard</h2>
        <p style="margin-top: 8px; font-size: 1.2rem;">Selamat datang admin!</p>
    </div>
    
    <div class="stat-boxes" style="display: flex; gap: 20px; margin-bottom: 30px;">
        
        <div class="stat-box" style="flex: 1; text-align: center; padding: 25px;">
            <p style="font-size: 0.9rem; color: #777; margin-bottom: 10px;">Total Pengguna</p>
            <h3 style="font-size: 3rem; color: #007bff; margin: 0;"><?= esc($total_users) ?></h3>
            <small style="display: block; margin-top: 5px; color: #555;">Jumlah pengguna terdaftar</small>
        </div>
        
        <div class="stat-box" style="flex: 1; text-align: center; padding: 25px;">
            <p style="font-size: 0.9rem; color: #777; margin-bottom: 10px;">Total Laporan Panen</p>
            <h3 style="font-size: 3rem; color: #2e7d32; margin: 0;"><?= esc($total_laporan) ?></h3>
            <small style="display: block; margin-top: 5px; color: #555;">Laporan yang sudah tercatat</small>
        </div>
        
        <div class="stat-box" style="flex: 1; text-align: center; padding: 25px;">
            <p style="font-size: 0.9rem; color: #777; margin-bottom: 10px;">Total Produksi Terdata (Kg)</p>
            <h3 style="font-size: 3rem; color: #ffc107; margin: 0;"><?= number_format($total_panen ?? 0, 2) ?>kg</h3>
            <small style="display: block; margin-top: 5px; color: #555;">Akumulasi dari semua laporan</small>
        </div>
    </div>

    <div class="content-box" style="margin-top: 20px;">
        <h3 style="border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 20px;">Menu Administrasi</h3>
        <div style="display: flex; gap: 20px;">
            <a href="<?= site_url('admin/users') ?>" class="btn-primary" style="padding: 15px 30px; font-size: 1.2rem; display: block; text-align: center;">
                <i class="fas fa-users"></i> Manajemen Pengguna
            </a>
            <a href="<?= site_url('admin/monitoring') ?>" class="btn-primary" style="padding: 15px 30px; font-size: 1.2rem; display: block; text-align: center;">
                <i class="fas fa-desktop"></i> Lihat Monitoring Data
            </a>
        </div>
    </div>
<?= $this->endSection() ?>