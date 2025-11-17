<?= $this->extend('layout/user_template') ?>

<?= $this->section('content') ?>
    <div class="content-box">
        <div class="content-box-header">
            <i class="fas fa-desktop"></i>
            Monitoring Produksi
        </div>

        <div style="padding: 15px 0; border-bottom: 1px solid #ddd; margin-bottom: 20px; display: flex; align-items: center;">
            <strong style="font-size: 1.1rem; margin-right: 15px;">Filter Laporan</strong>
            
            <select style="padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                <option>Pilih tanggal</option>
            </select>
            <input type="date" style="padding: 8px; border-radius: 4px; border: 1px solid #ccc; margin-left: 10px;">

            <select style="padding: 8px; border-radius: 4px; border: 1px solid #ccc; margin-left: 10px;">
                <option>Jenis tanaman</option>
            </select>

            <select style="padding: 8px; border-radius: 4px; border: 1px solid #ccc; margin-left: 10px;">
                <option>Dosen Pembimbing</option>
            </select>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Komoditas</th>
                    <th>Luas (Ha)</th>
                    <th>Produksi (Kg)</th>
                    <th>Biaya (Rp)</th>
                    <th>PENDAPATAN KOTOR (Rp)</th>
                    <th>Status & Progres</th>
                    <th>Margin Keuntungan (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($laporan)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">Belum ada data produksi yang dicatat.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($laporan as $row) : 
                        $margin = $row['margin'] ?? 0;
                        $margin_style = ($margin >= 0) ? 'color: green; font-weight: bold;' : 'color: red; font-weight: bold;';
                    ?>
                    <tr>
                        <td><?= esc($row['komoditas']) ?></td>
                        <td><?= esc($row['luas_lahan']) ?></td>
                        <td><?= esc($row['berat_total_produksi']) ?></td>
                        <td>Rp<?= number_format(esc($row['biaya_operasional']), 0, ',', '.') ?></td>
                        
                        <td>Rp<?= number_format($row['pendapatan_kotor'] ?? 0, 0, ',', '.') ?></td>

                        <td style="width: 200px;">
                            <?php 
                            $progress = $row['progress_percent'];
                            $statusText = $row['status_tampil'];

                            $color = '#2e7d32'; 
                            if ($progress < 100) $color = '#4CAF50'; 
                            if ($statusText == 'Data Perencanaan/Aktif') $color = '#757575'; 
                            ?>
                            
                            <div title="<?= esc($statusText) ?>" style="background-color: #f1f1f1; border-radius: 5px; height: 20px; width: 100%;">
                                <div style="width: <?= esc($progress) ?>%; background-color: <?= $color ?>; height: 100%; border-radius: 5px; text-align: right; color: white; padding-right: 5px; box-sizing: border-box; transition: width 0.5s;">
                                    <small><?= esc($progress) ?>%</small>
                                </div>
                            </div>
                            <small style="display: block; margin-top: 5px; font-weight: bold;"><?= esc($statusText) ?></small>
                        </td>

                        <td style="<?= $margin_style ?>">
                            Rp<?= number_format($margin, 0, ',', '.') ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?= $this->endSection() ?>