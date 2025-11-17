<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        echo "Baris tambahan dari Zahira - Skema 2";  // ← Tambahan skema 2
        return "Edit dari Zahira - Skema 1";          // ← Skema 1 tetap ada
    }
}