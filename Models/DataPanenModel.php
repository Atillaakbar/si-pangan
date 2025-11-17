<?php namespace App\Models;

use CodeIgniter\Model;

class DataPanenModel extends Model
{
    protected $table      = 'data_panen';
    protected $primaryKey = 'id_panen';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    // PASTIKAN SEMUA KOLOM YANG DIINPUT TERDAFTAR DI SINI
    protected $allowedFields = [
        'id_pengguna', 
        'komoditas',          // <-- WAJIB ADA UNTUK MENGATASI ERROR #1048
        'tanggal_panen',      
        'luas_lahan',         
        'berat_total_produksi', 
        'biaya_operasional',  
        'harga_jual_kg',      
        'status',             
        'catatan'           
    ];

    protected $useTimestamps = true; 
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}