<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
    <div class="content-box">
        <div class="content-box-header">
            <i class="fas fa-user-edit"></i>
            Edit Pengguna: <?= esc($user['nama']) ?>
        </div>
        
        <form action="<?= site_url('admin/users/update') ?>" method="post">
            
            <?= csrf_field() ?> 
            
            <input type="hidden" name="id_pengguna" value="<?= esc($user['id_pengguna']) ?>">

            <style>
                .form-group { margin-bottom: 15px; }
                .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
                .form-group input, .form-group select {
                    width: 100%;
                    padding: 8px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    box-sizing: border-box;
                }
                .small-text { font-size: 0.85rem; color: #555; margin-top: 5px; }
            </style>
            
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" value="<?= old('nama', $user['nama']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?= old('email', $user['email']) ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password" name="password" id="password" placeholder="Biarkan kosong jika tidak ingin diubah">
                <p class="small-text">Isi kolom ini hanya jika Anda ingin mengubah password pengguna.</p>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role">
                    <option value="User" <?= ($user['role'] == 'User') ? 'selected' : '' ?>>User</option>
                    <option value="Admin" <?= ($user['role'] == 'Admin') ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            
            <button type="submit" class="btn-primary">Simpan Perubahan</button>
            <a href="<?= site_url('admin/users') ?>" style="margin-left: 10px; color: #555;">Batal</a>
        </form>
    </div>
<?= $this->endSection() ?>