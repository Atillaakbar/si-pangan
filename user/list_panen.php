<?= $this->extend('layout/user_template') ?>

<?= $this->section('content') ?>
    <div class="content-box">
        <div class="content-box-header">
            <i class="fas fa-box-open"></i>
            Manajemen Data Hasil Panen
        </div>

        <div class="content-box-body">
            <a href="<?= site_url('user/panen/new') ?>" class="btn-primary" style="margin-bottom: 20px; display: inline-block;">
                <i class="fas fa-plus-circle"></i> Input Data Panen Baru
            </a>

            <!-- Menampilkan pesan feedback (Sukses/Error) -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert-success" style="padding: 10px; margin-bottom: 15px; border-radius: 5px; background-color: #d4edda; color: #155724;"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert-danger" style="padding: 10px; margin-bottom: 15px; border-radius: 5px; background-color: #f8d7da; color: #721c24;"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>KOMODITAS</th>
                        <th>TGL PANEN</th>
                        <th>LUAS (HA)</th>
                        <th>BERAT (KG)</th>
                        <th>BIAYA (RP)</th>
                        <th>STATUS</th>
                        <th style="width: 150px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($laporan_semua)): ?>
                        <tr>
                            <td colspan="7" style="text-align: center;">Anda belum mencatat data panen.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($laporan_semua as $row) : ?>
                        <tr>
                            <td><?= esc($row['komoditas']) ?></td>
                            <td><?= date('d M Y', strtotime($row['tanggal_panen'])) ?></td>
                            <td><?= esc($row['luas_lahan']) ?></td>
                            <td><?= esc($row['berat_total_produksi']) ?></td>
                            <td>Rp<?= number_format(esc($row['biaya_operasional']), 0, ',', '.') ?></td>
                            <td><?= esc($row['status']) ?></td>
                            
                            <!-- KOLOM AKSI (EDIT & HAPUS) -->
                            <td>
                                <!-- Tautan Edit -->
                                <a href="<?= site_url('user/panen/edit/' . $row['id_panen']) ?>" style="color: #007bff; text-decoration: none; margin-right: 10px;">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                
                                <!-- Tautan Hapus dengan Konfirmasi JS -->
                                <a href="<?= site_url('user/panen/delete/' . $row['id_panen']) ?>" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini? Data akan hilang permanen.');" 
                                   style="color: #dc3545; text-decoration: none;">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?= $this->endSection() ?>