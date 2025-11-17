<?php namespace App\Controllers;

use App\Models\PenggunaModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    // Fungsi untuk menampilkan halaman login
    public function index()
    {
        // Pengecekan sesi untuk mencegah akses ke halaman login jika sudah login
        if (session()->get('is_logged_in')) {
            if(session()->get('role') == 'Admin') {
                return redirect()->to(site_url('admin/dashboard'));
            } else {
                return redirect()->to(site_url('user/dashboard')); 
            }
        }
        
        // --- KOREKSI: Menggunakan nama view yang benar ---
        return view('login_page'); 
        // --------------------------------------------------
    }

    // Fungsi untuk memproses login
    public function login()
    {
        $session = session();
        $model = new PenggunaModel();
        
        $email = (string) trim($this->request->getPost('email'));
        $password = (string) trim($this->request->getPost('password')); // Trim sangat penting!

        // 1. Cari user berdasarkan email
        $user = $model->where('email', $email)->first();

        if ($user) {
            // 2. Verifikasi password (Membandingkan input dengan hash di DB)
            if (password_verify($password, $user['password'])) { 
                
                // 3. Buat Session JIKA PASSWORD BENAR
                $ses_data = [
                    'id_pengguna'   => $user['id_pengguna'],
                    'nama'          => $user['nama'],
                    'email'         => $user['email'],
                    'role'          => $user['role'],
                    'is_logged_in'  => TRUE
                ];
                $session->set($ses_data);

                // 4. Redirect berdasarkan Role
                if ($user['role'] == 'Admin') {
                    return redirect()->to(site_url('admin/dashboard'));
                } else {
                    return redirect()->to(site_url('user/dashboard'));
                }
            } else {
                // Password salah
                $session->setFlashdata('error', 'Password salah!'); // Gunakan 'error'
                return redirect()->to(site_url('login'))->withInput();
            }
        } else {
            // Email tidak ditemukan
            $session->setFlashdata('error', 'Email tidak terdaftar!');
            return redirect()->to(site_url('login'))->withInput();
        }
    }

    // Fungsi untuk Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('/')); // Arahkan ke halaman root (yang akan jadi login)
    }
}