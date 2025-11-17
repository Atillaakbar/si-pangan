<?php namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table      = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    
    // Pastikan kolom ini sesuai dengan nama kolom di tabel 'pengguna'
    protected $allowedFields = ['nama', 'email', 'password', 'role'];

    // =========================================================================
    // CODE BARU UNTUK HASHING OTOMATIS
    // =========================================================================
    
    // Panggil fungsi hashPassword sebelum INSERT dan UPDATE
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        // Cek apakah kolom 'password' ada dalam data yang akan disimpan
        if (isset($data['data']['password'])) {
            // Hashing password menggunakan algoritma BCRYPT (PASSWORD_DEFAULT)
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    // =========================================================================
    // END HASHING OTOMATIS
    // =========================================================================

    // Note: Anda bisa menambahkan validation rules di sini
}