<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use Barryvdh\DomPDF\Facade\Pdf;

class BeasiswaController extends Controller
{
    public function index()
    {
        $beasiswas = Beasiswa::latest()->get();
        return view('user.beasiswa.index', compact('beasiswas'));
    }

    public function downloadPdf()
    {
        try {
            $beasiswas = Beasiswa::all();
            
            $pdf = Pdf::loadView('admin.beasiswa.pdf', compact('beasiswas'))
                ->setPaper('a4', 'landscape');
            
            $fileName = 'Data_Beasiswa_' . date('Y-m-d_His') . '.pdf';
            
            return $pdf->download($fileName);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mendownload PDF: ' . $e->getMessage());
        }
    }
}