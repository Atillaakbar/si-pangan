<?php namespace App\Controllers;

use App\Models\PenggunaModel;
use App\Models\DataPanenModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time; 

class Admin extends BaseController
{
    protected $penggunaModel;
    protected $dataPanenModel;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
        $this->dataPanenModel = new DataPanenModel();
        setlocale(LC_TIME, 'id_ID.utf8', 'id_ID', 'Indonesia');
        
        // Memastikan hanya role 'Admin' yang bisa mengakses controller ini
        if (session()->get('role') != 'Admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // =========================================================================
    // 1. DASHBOARD
    // =========================================================================
    public function dashboard()
    {
        // Ambil jumlah data untuk statistik di dashboard admin
        $data['total_users'] = $this->penggunaModel->where('role', 'User')->countAllResults();
        $data['total_laporan'] = $this->dataPanenModel->countAllResults();
        $data['total_panen'] = $this->dataPanenModel->selectSum('berat_total_produksi')->get()->getRow()->berat_total_produksi;
        
        $data['title'] = "Dashboard Admin";
        return view('admin/dashboard', $data);
    }

    // =========================================================================
    // 2. MANAJEMEN PENGGUNA (CRUD)
    // =========================================================================
    public function users()
    {
        $data['users'] = $this->penggunaModel->where('role', 'User')->findAll();
        $data['title'] = "Manajemen Pengguna";
        // Asumsi nama view: manajemen_pengguna.php (Jika Anda menggunakan user_management, ubah nama view ini)
        return view('admin/manajemen_pengguna', $data); 
    }

    public function newUser()
    {
        $data['title'] = "Tambah Pengguna Baru";
        return view('admin/new_user_form', $data);
    }

    public function createUser()
    {
        // Logika Create User
        if (!$this->validate([
            'nama' => 'required',
            'email' => 'required|valid_email|is_unique[pengguna.email]',
            'password' => 'required|min_length[5]',
            'confirm_password' => 'required|matches[password]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->penggunaModel->save([
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'User',
        ]);

        return redirect()->to(site_url('admin/users'))->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // FUNGSI INI SUDAH DIKOREKSI UNTUK MENGATASI ERROR UNDEFINED VARIABLE $DATA
    public function editUser($id_pengguna = null) 
    {
        // Inisialisasi variabel $data
        $data = [];
        
        if ($id_pengguna === null) {
            return redirect()->to(site_url('admin/users'))->with('error', 'ID Pengguna tidak valid.');
        }
        
        $user = $this->penggunaModel->find($id_pengguna);
        
        if (!$user) {
            return redirect()->to(site_url('admin/users'))->with('error', 'Data Pengguna tidak ditemukan.');
        }

        $data['user'] = $user;
        $data['title'] = "Edit Pengguna";
        
        return view('admin/edit_user_form', $data);
    }

    public function updateUser()
    {
        $id_pengguna = $this->request->getPost('id_pengguna');
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
        ];

        $currentUser = $this->penggunaModel->find($id_pengguna);
        if ($currentUser && $currentUser['email'] != $this->request->getPost('email') && !$this->validate(['email' => 'is_unique[pengguna.email]'])) {
            return redirect()->back()->withInput()->with('error', 'Email sudah digunakan pengguna lain.');
        }

        if ($this->request->getPost('password')) {
            if (!$this->validate(['password' => 'required|min_length[5]', 'confirm_password' => 'required|matches[password]'])) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        
        $this->penggunaModel->update($id_pengguna, $data);
        return redirect()->to(site_url('admin/users'))->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function deleteUser($id_pengguna)
    {
        $this->dataPanenModel->where('id_pengguna', $id_pengguna)->delete(); 
        $this->penggunaModel->delete($id_pengguna); 
        
        return redirect()->to(site_url('admin/users'))->with('success', 'Pengguna dan semua laporannya berhasil dihapus.');
    }

    // =========================================================================
    // 3. MONITORING PANEN (SINKRON DENGAN berat_total_produksi)
    // =========================================================================
    public function monitoring()
    {
        $currentYear = date('Y');
        $currentMonth = date('m');

        // 1. Ambil data panen untuk tabel
        $data['laporan'] = $this->dataPanenModel
                                ->join('pengguna', 'pengguna.id_pengguna = data_panen.id_pengguna') 
                                ->select('data_panen.*, pengguna.nama as nama_pengguna, pengguna.email') 
                                ->orderBy('tanggal_panen', 'DESC')
                                ->findAll();
        
        // --- LOGIKA UNTUK 3 BOX STATISTIK ---
        // Koreksi: Menggunakan berat_total_produksi
        $totalBulanIni = $this->dataPanenModel->selectSum('berat_total_produksi')
                              ->where('YEAR(tanggal_panen)', $currentYear)
                              ->where('MONTH(tanggal_panen)', $currentMonth)->get()->getRow()->berat_total_produksi;
        $data['total_bulan_ini'] = $totalBulanIni ? number_format($totalBulanIni, 2) : 0; 

        $laporanTerbaru = $this->dataPanenModel->selectMax('tanggal_panen')->get()->getRow()->tanggal_panen;
        if ($laporanTerbaru) {
            $formatter = new \IntlDateFormatter('id_ID', \IntlDateFormatter::LONG, \IntlDateFormatter::NONE, 'Asia/Jakarta', \IntlDateFormatter::GREGORIAN, 'd MMMM yyyy');
            $data['laporan_terbaru'] = $formatter->format(strtotime($laporanTerbaru));
        } else {
            $data['laporan_terbaru'] = 'Belum ada data';
        }

        // Koreksi: Menggunakan berat_total_produksi
        $totalTahunIni = $this->dataPanenModel->selectSum('berat_total_produksi')->where('YEAR(tanggal_panen)', $currentYear)->get()->getRow()->berat_total_produksi;
        $bulanBerjalan = (int)date('m');
        if ($totalTahunIni > 0 && $bulanBerjalan > 0) {
            $rataRata = $totalTahunIni / $bulanBerjalan;
            $data['rata_rata'] = round($rataRata, 1);
        } else {
            $data['rata_rata'] = 0;
        }

        // --- LOGIKA UNTUK DATA CHART ---
        // Koreksi: Menggunakan berat_total_produksi
        $monthlyData = $this->dataPanenModel
                            ->select("MONTH(tanggal_panen) as bulan, SUM(berat_total_produksi) as total_panen")
                            ->where('YEAR(tanggal_panen)', $currentYear)
                            ->groupBy('bulan')
                            ->orderBy('bulan', 'ASC')
                            ->findAll();
        
        $panenPerBulan = array_fill(1, 12, 0); 
        
        foreach ($monthlyData as $item) {
            $panenPerBulan[(int)$item['bulan']] = (float)$item['total_panen'];
        }

        $data['chart_data'] = array_values($panenPerBulan); 

        $data['title'] = "Monitoring Hasil Panen";
        return view('admin/monitoring_panen', $data);
    }
}