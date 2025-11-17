<?= $this->extend('layout/user_template') ?>

<?= $this->section('content') ?>
    <style>
        /* CSS Konsistensi untuk Form */
        .input-panen-container {
            background-color: white; 
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .input-header {
            color: #2e7d32; 
            font-size: 1.8rem;
            margin-bottom: 25px;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 10px;
        }
        .form-group {
            margin-bottom: 20px;
            width: 100%; 
        }
        .form-group label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
            display: block;
        }
        .form-control-styled {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        .btn-submit {
            background-color: #2e7d32;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-batal {
            color: #555;
            text-decoration: none;
            padding: 12px 25px;
            margin-left: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: background-color 0.2s;
        }
    </style>

    <div class="input-panen-container">
        <h2 class="input-header"><i class="fas fa-edit" style="margin-right: 10px;"></i> Edit Laporan Panen</h2>

        <!-- FORM MENGARAH KE USER/PANEN/UPDATE (POST) -->
        <form action="<?= site_url('user/panen/update') ?>" method="post">
            <?= csrf_field() ?>
            <!-- Field ID Panen yang Disembunyikan (WAJIB untuk Update) -->
            <input type="hidden" name="id_panen" value="<?= esc($laporan['id_panen']) ?>">

            <!-- 1. Komoditas -->
            <div class="form-group">
                <label for="komoditas">1. Komoditas / Nama Tanaman*</label>
                <input type="text" id="komoditas" name="komoditas" 
                       class="form-control-styled" value="<?= esc($laporan['komoditas']) ?>" required>
            </div>
            
            <!-- 2. Tanggal Panen -->
            <div class="form-group">
                <label for="tanggal_panen">2. Tanggal Panen*</label>
                <input type="date" id="tanggal_panen" name="tanggal_panen" 
                       class="form-control-styled" value="<?= esc($laporan['tanggal_panen']) ?>" required>
            </div>

            <!-- 3. Luas Lahan (Hektar) -->
            <div class="form-group">
                <label for="luas_lahan">3. Luas Lahan (Hektar)*</label>
                <input type="number" step="0.01" id="luas_lahan" name="luas_lahan" 
                       class="form-control-styled" value="<?= esc($laporan['luas_lahan']) ?>" required min="0">
            </div>

            <!-- 4. Berat Total Produksi (Kg) -->
            <div class="form-group">
                <label for="berat_total_produksi">4. Berat Total Produksi (Kg)*</label>
                <input type="number" step="0.01" id="berat_total_produksi" name="berat_total_produksi" 
                       class="form-control-styled" value="<?= esc($laporan['berat_total_produksi']) ?>" required min="0">
            </div>

            <!-- 5. Biaya Operasional Total (Rp) -->
            <div class="form-group">
                <label for="biaya_operasional">5. Biaya Operasional Total (Rp)*</label>
                <input type="number" id="biaya_operasional" name="biaya_operasional" 
                       class="form-control-styled" value="<?= esc($laporan['biaya_operasional']) ?>" required min="0">
            </div>
            
            <!-- 6. Harga Jual / Kg (Rp) -->
            <div class="form-group">
                <label for="harga_jual_kg">6. Harga Jual / Kg (Rp)*</label>
                <input type="number" step="0.01" id="harga_jual_kg" name="harga_jual_kg" 
                       class="form-control-styled" value="<?= esc($laporan['harga_jual_kg']) ?>" required min="0">
            </div>
            
            <!-- 7. Catatan (Rincian Biaya & Keterangan Tambahan) -->
            <div class="form-group">
                <label for="catatan">7. Catatan (Rincian Biaya & Keterangan Tambahan)</label>
                <textarea id="catatan" name="catatan" 
                          class="form-control-styled" rows="4"><?= esc($laporan['catatan']) ?></textarea>
            </div>
            
            <!-- 8. Status -->
            <div class="form-group">
                <label for="status">8. Kondisi Hasil (Status)*</label>
                <select id="status" name="status" class="form-control-styled" required>
                    <option value="Baik" <?= $laporan['status'] == 'Baik' ? 'selected' : '' ?>>Baik</option>
                    <option value="Cukup" <?= $laporan['status'] == 'Cukup' ? 'selected' : '' ?>>Cukup</option>
                    <option value="Kurang" <?= $laporan['status'] == 'Kurang' ? 'selected' : '' ?>>Kurang</option>
                </select>
            </div>


            <div class="form-group text-right" style="margin-top: 30px; text-align: right;">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-check-circle"></i> Simpan Perubahan
                </button>
                <a href="<?= site_url('user/panen') ?>" class="btn-batal">
                    Batal
                </a>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>