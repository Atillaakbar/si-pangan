<?php namespace App\Controllers;

use App\Models\DataPanenModel; 
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class User extends BaseController
{
    protected $dataPanenModel;

    public function __construct()
    {
        $this->dataPanenModel = new DataPanenModel();
        
        if (session()->get('role') != 'User') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // =========================================================================
    // FUNGSI UMUM & DASHBOARD (PERBAIKAN)
    // =========================================================================

    public function dashboard()
    {
        $userId = session()->get('id_pengguna');
        
        // --- LOGIKA UNTUK DASHBOARD (MENGISI VARIABEL STATISTIK) ---
        
        // 1. Total Laporan (Mengatasi Undefined variable $jumlahLaporan)
        $jumlahLaporan = $this->dataPanenModel->where('id_pengguna', $userId)->countAllResults();
        $data['jumlahLaporan'] = $jumlahLaporan; // <-- Menggunakan nama variabel yang diharapkan oleh View
        
        // 2. Total Produksi (Total Produksi Kg)
        $totalPanen = $this->dataPanenModel->selectSum('berat_total_produksi')->where('id_pengguna', $userId)->get()->getRow()->berat_total_produksi;
        $data['total_panen'] = $totalPanen ? number_format($totalPanen, 2) : 0; 
        
        // 3. Rata-rata Produksi (Rata-rata Kg)
        $rataRata = $this->dataPanenModel->selectAvg('berat_total_produksi')->where('id_pengguna', $userId)->get()->getRow()->berat_total_produksi;
        $data['rata_rata_kg'] = $rataRata ? round($rataRata, 1) : 0;
        
        // --- Akhir Logika Statistik ---
        
        $data['title'] = "Dashboard Pengguna";
        return view('user/dashboard', $data);
    }
    
    public function newPanen()
    {
        $data['title'] = "Input Laporan Panen";
        return view('user/new_panen_form', $data);
    }

    // CREATE PANEN (Sudah ditambahkan Guard Clause dan harga_jual_kg)
    public function createPanen()
    {
        $userId = session()->get('id_pengguna');
        
        // GUARD CLAUSE UNTUK ID PENGGUNA
        if (!$userId) {
            return redirect()->to(site_url('login'))->with('error', 'Sesi login Anda habis. Silakan login kembali.');
        }
        
        $data = [
            'id_pengguna'               => $userId, 
            'komoditas'                 => $this->request->getPost('komoditas'),
            'tanggal_panen'             => $this->request->getPost('tanggal_panen'),
            'luas_lahan'                => $this->request->getPost('luas_lahan'),
            'berat_total_produksi'      => $this->request->getPost('berat_total_produksi'),
            'biaya_operasional'         => $this->request->getPost('biaya_operasional'),
            'harga_jual_kg'             => $this->request->getPost('harga_jual_kg'),
            'status'                    => $this->request->getPost('status'), 
            'catatan'                   => $this->request->getPost('catatan'), 
        ];
        
        if ($this->dataPanenModel->save($data)) {
            return redirect()->to(site_url('user/panen'))
                             ->with('success', 'Laporan panen berhasil dicatat!');
        } else {
            return redirect()->back()->withInput()
                             ->with('error', 'Gagal menyimpan laporan. Pastikan semua field terisi.');
        }
    }

    // =========================================================================
    // MANAJEMEN PANEN (CRUD)
    // =========================================================================
    public function listPanen()
    {
        $userId = session()->get('id_pengguna');
        
        if (!$userId) {
            return redirect()->to(site_url('login'))->with('error', 'Sesi login Anda habis. Silakan login kembali.');
        }

        $data['laporan_semua'] = $this->dataPanenModel
                                      ->where('id_pengguna', $userId)
                                      ->orderBy('tanggal_panen', 'DESC')
                                      ->findAll();
                                      
        $data['title'] = "Manajemen Data Panen";
        return view('user/list_panen', $data); 
    }

    public function editPanen($id_panen)
    {
        $data['laporan'] = $this->dataPanenModel->find($id_panen);
        
        if (!$data['laporan'] || $data['laporan']['id_pengguna'] != session()->get('id_pengguna')) {
            return redirect()->to(site_url('user/panen'))->with('error', 'Data tidak ditemukan atau bukan milik Anda.');
        }

        $data['title'] = "Edit Laporan Panen";
        return view('user/edit_panen_form', $data); 
    }

    public function updatePanen()
    {
        $id_panen = $this->request->getPost('id_panen');
        $userId = session()->get('id_pengguna');
        
        $laporan = $this->dataPanenModel->find($id_panen);
        if (!$laporan || $laporan['id_pengguna'] != $userId) {
             return redirect()->to(site_url('user/panen'))->with('error', 'Akses ditolak.');
        }

        $data = [
            'komoditas'                 => $this->request->getPost('komoditas'),
            'tanggal_panen'             => $this->request->getPost('tanggal_panen'),
            'luas_lahan'                => $this->request->getPost('luas_lahan'),
            'berat_total_produksi'      => $this->request->getPost('berat_total_produksi'),
            'biaya_operasional'         => $this->request->getPost('biaya_operasional'),
            'harga_jual_kg'             => $this->request->getPost('harga_jual_kg'),
            'status'                    => $this->request->getPost('status'), 
            'catatan'                   => $this->request->getPost('catatan'), 
        ];
        
        $this->dataPanenModel->update($id_panen, $data);
        
        return redirect()->to(site_url('user/panen'))
                         ->with('success', 'Laporan panen berhasil diperbarui!');
    }

    public function deletePanen($id_panen)
    {
        $laporan = $this->dataPanenModel->find($id_panen);
        if (!$laporan || $laporan['id_pengguna'] != session()->get('id_pengguna')) {
             return redirect()->to(site_url('user/panen'))->with('error', 'Akses ditolak.');
        }
        
        $this->dataPanenModel->delete($id_panen);
        
        return redirect()->to(site_url('user/panen'))
                         ->with('success', 'Laporan panen berhasil dihapus.');
    }
    
    // =========================================================================
    // MONITORING PRODUKSI
    // =========================================================================
    public function monitoringProduksi()
    {
        $userId = session()->get('id_pengguna');
        
        $laporan = $this->dataPanenModel
                        ->where('id_pengguna', $userId)
                        ->orderBy('tanggal_panen', 'DESC')
                        ->findAll();
        
        foreach ($laporan as &$row) {
            $row['pendapatan_kotor'] = $row['berat_total_produksi'] * $row['harga_jual_kg'];
            $row['margin'] = $row['pendapatan_kotor'] - $row['biaya_operasional'];
            $row['progress_percent'] = 100;
            $row['status_tampil'] = $row['status'];
        }
                            
        $data['laporan'] = $laporan;
        $data['title'] = "Monitoring Produksi";
        return view('user/monitoring_produksi', $data);
    }
}