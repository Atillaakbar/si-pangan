<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>

    <h2 style="margin: 0 0 20px 0;"><i class="fas fa-desktop" style="margin-right: 10px;"></i>Monitoring data hasil panen</h2>

    <div class="stat-boxes">
        <div class="stat-box">
            <p>Total Panen Bulan Ini</p>
            <h3><?= $total_bulan_ini ?>kg</h3>
        </div>
        <div class="stat-box">
            <p>Rata-rata panen /bulan</p>
            <h3><?= $rata_rata ?>kg</h3>
        </div>
        <div class="stat-box">
            <p>Laporan Terbaru</p>
            <h3><?= esc($laporan_terbaru) ?></h3>
        </div>
    </div>

    <div class="content-box" style="margin-top: 20px;">
        <div class="content-box-header" style="border: none;">Tren produksi panen <?= date('Y') ?></div>
        
        <div style="width: 90%; margin: auto;">
            <canvas id="productionChart"></canvas>
        </div>
    </div>

    <div class="content-box" style="margin-top: 20px;">
        <div class="content-box-header" style="padding-bottom: 0; border: none;">
            Data Laporan Masuk
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Komoditas</th>
                    <th>Tgl Panen</th>
                    <th>Luas (Ha)</th>
                    <th>Berat Total (Kg)</th>
                    <th>Biaya (Rp)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($laporan)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">Belum ada data panen yang masuk.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($laporan as $row) : ?>
                    <tr>
                        <td><?= esc($row['nama_pengguna']) ?></td>
                        <td><?= esc($row['komoditas']) ?></td>
                        <td><?= date('d M Y', strtotime($row['tanggal_panen'])) ?></td>
                        <td><?= esc($row['luas_lahan']) ?></td>
                        <td><?= esc($row['berat_total_produksi']) ?>kg</td>
                        <td>Rp<?= number_format(esc($row['biaya_operasional']), 0, ',', '.') ?></td>
                        <td><?= esc($row['status']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

<script>
    // Data dari Controller Admin
    const panenData = <?= json_encode($chart_data) ?>; 
    
    const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    const data = {
        labels: labels,
        datasets: [{
            label: 'Produksi Panen (Kg)',
            backgroundColor: 'rgba(46, 125, 50, 0.5)', 
            borderColor: '#2e7d32', 
            data: panenData,
            tension: 0.3, 
            fill: true,
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Panen (Kg)'
                    }
                }
            }
        }
    };

    var myChart = new Chart(
        document.getElementById('productionChart'),
        config
    );
</script>
<?= $this->endSection() ?>