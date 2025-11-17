<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
       
        // SKEMA 2 → Tambah baris berbeda
<<<<<<< HEAD
<<<<<<< HEAD
        

        echo "skema 2 - Tambahan baris dari Zahira";      // Baris untuk Zahira
        

        
        
      

        return "Edit dari Zahira - Skema 1";
=======
      


        
        
echo "Tambahan dari Atila - Skema 2<br>";    // Baris untuk Anggota 2
   
        // SKEMA 1 → Semua edit baris yang sama
     
        return "EDIT SKEMA 1 (semua anggota mengubah tulisan ini)";
>>>>>>> 6f64b7ac84880fbcc8fe6e3e0ca4039b9a8eca2b
=======
  


        echo "Tambahan dari Yogaa - Skema 2<br>";    // Baris untuk Yogaa


        // SKEMA 1 → Semua edit baris yang sama
        

        return "EDIT SKEMA 1 (semua anggota mengubah tulisan ini)";
>>>>>>> 8f93243 (Skema 1: Yogaa mengubah baris yang sama di Home.php)
    }
}