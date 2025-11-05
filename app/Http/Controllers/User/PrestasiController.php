<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Barryvdh\DomPDF\Facade\Pdf;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasis = Prestasi::latest()->get();
        return view('user.prestasi.index', compact('prestasis'));
    }

    public function downloadPdf()
    {
        try {
            $prestasis = Prestasi::all();
            
            $pdf = Pdf::loadView('admin.prestasi.pdf', compact('prestasis'))
                ->setPaper('a4', 'landscape');
            
            $fileName = 'Data_Prestasi_' . date('Y-m-d_His') . '.pdf';
            
            return $pdf->download($fileName);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mendownload PDF: ' . $e->getMessage());
        }
    }
}