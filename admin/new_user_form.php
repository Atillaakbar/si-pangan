<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
    <div class="content-box">
        <div class="content-box-header">
            <i class="fas fa-user-plus"></i>
            Tambah Pengguna Baru
        </div>
        
        <form action="<?= site_url('admin/users/create') ?>" method="post">
            
            <?= csrf_field() ?> <style>
                .form-group { margin-bottom: 15px; }
                .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
                .form-group input, .form-group select {
                    width: 100%;
                    padding: 8px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    box-sizing: border-box; /* Agar padding tidak merusak lebar */
                }
            </style>
            
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role">
                    <option value="User" selected>User</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>
            
            <button type="submit" class="btn-primary">Simpan Pengguna</button>
            <a href="<?= site_url('admin/users') ?>" style="margin-left: 10px; color: #555;">Batal</a>
        </form>
    </div>
<?= $this->endSection() ?>