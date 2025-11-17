<?= $this->extend('layout/user_template') ?>

<?= $this->section('content') ?>
    <div class="content-box">
        <div class="content-box-header">
            Dashboard
        </div>
        <div class="content-box-body">
            <!-- PENTING: Pastikan Anda login agar session()->get('nama') terisi -->
            <p style="margin-top: 0px; font-size: 1.2rem; margin-bottom: 20px;">Selamat datang, <?= esc(session()->get('nama') ?? 'User') ?>!</p>
            
            <div class="stat-boxes" style="display: flex; gap: 20px; margin-bottom: 30px;">
                
                <!-- 1. STAT BOX: TOTAL LAPORAN -->
                <div class="stat-box" style="flex: 1; text-align: center; padding: 25px; border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <p style="font-size: 0.9rem; color: #777; margin-bottom: 10px;">Total Laporan Panen</p>
                    <h3 style="font-size: 3rem; color: #2e7d32; margin: 0;"><?= esc($jumlahLaporan) ?></h3>
                    <small style="display: block; margin-top: 5px; color: #555;">Input yang sudah tercatat</small>
                </div>
                
                <!-- 2. STAT BOX: TOTAL PRODUKSI -->
                <div class="stat-box" style="flex: 1; text-align: center; padding: 25px; border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <p style="font-size: 0.9rem; color: #777; margin-bottom: 10px;">Total Produksi (Kg)</p>
                    <h3 style="font-size: 3rem; color: #2e7d32; margin: 0;"><?= esc($total_panen) ?>kg</h3>
                    <small style="display: block; margin-top: 5px; color: #555;">Rata-rata: <?= esc($rata_rata_kg) ?>kg/input</small>
                </div>
                
                <!-- 3. STAT BOX: AKSI CEPAT -->
                <div class="stat-box" style="flex: 1; text-align: center; padding: 25px; border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <p style="font-size: 0.9rem; color: #777; margin-bottom: 25px;">Aksi Cepat</p>
                    <a href="<?= site_url('user/panen/new') ?>" class="btn-primary" style="text-decoration: none; padding: 10px 20px; font-weight: bold; border-radius: 5px;">
                        <i class="fas fa-plus-circle"></i> Input Data Panen
                    </a>
                </div>
            </div>
            
            <!-- GRAFIK PERKEMBANGAN (Placeholder) -->
            <div class="grafik-box" style="border: 1px solid #e0e0e0; padding: 20px; border-radius: 8px; min-height: 300px;">
                <h4 style="margin-top: 0; color: #333;">Grafik Hasil Panen Tanaman (5 Panen Terakhir)</h4>
                
                <!-- Placeholder untuk Grafik (Disarankan menggunakan Chart.js atau sejenisnya) -->
                <?php if ($jumlahLaporan > 0): ?>
                    <p style="text-align: center; margin-top: 80px; color: #999;">[Area Grafik Akan Tampil di Sini]</p>
                <?php else: ?>
                    <p style="text-align: center; margin-top: 80px; color: #555;">Silakan input data panen untuk melihat grafik.</p>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
<?= $this->endSection() ?>