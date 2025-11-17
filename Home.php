<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
       
        // SKEMA 2 → Tambah baris berbeda
  


        echo "Tambahan dari Yogaa - Skema 2<br>";    // Baris untuk Yogaa


        // SKEMA 1 → Semua edit baris yang sama
        

        return "EDIT SKEMA 1 (semua anggota mengubah tulisan ini)";
    }
}