<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
    <div class="content-box">
        <div class="content-box-header">
            <i class="fas fa-users"></i>
            Manajemen Pengguna
        </div>
        
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert-error" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <a href="<?= site_url('admin/users/new') ?>" class="btn-primary" style="margin-bottom: 15px; display: inline-block;">
            <i class="fas fa-plus"></i> Tambah Pengguna
        </a>
        
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= esc($user['nama']) ?></td>
                    <td><a href="mailto:<?= esc($user['email']) ?>"><?= esc($user['email']) ?></a></td>
                    <td><?= esc($user['role']) ?></td>
                    <td>
                        <a href="<?= site_url('admin/users/edit/' . $user['id_pengguna']) ?>" 
                           style="color: blue; text-decoration: none; margin-right: 10px;">
                           <i class="fas fa-edit"></i> Edit
                        </a>
                        
                        <a href="<?= site_url('admin/users/delete/' . $user['id_pengguna']) ?>" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna <?= esc($user['nama']) ?>?')"
                           style="color: red; text-decoration: none;">
                           <i class="fas fa-trash-alt"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?= $this->endSection() ?>