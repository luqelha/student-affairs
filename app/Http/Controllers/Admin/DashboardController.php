<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\Prestasi;
use App\Models\Ukm;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBeasiswa = Beasiswa::count();
        $totalPrestasi = Prestasi::count();
        $totalUkm = Ukm::count();
        $totalUsers = User::where('role', 'user')->count();

        return view('admin.dashboard', compact(
            'totalBeasiswa',
            'totalPrestasi',
            'totalUkm',
            'totalUsers'
        ));
    }
}
