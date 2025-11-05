<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\Prestasi;
use App\Models\Ukm;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBeasiswa = Beasiswa::count();
        $totalPrestasi = Prestasi::count();
        $totalUkm = Ukm::count();

        return view('user.dashboard', compact('totalBeasiswa', 'totalPrestasi', 'totalUkm'));
    }
}