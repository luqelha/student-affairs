<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ukm;
use Barryvdh\DomPDF\Facade\Pdf;

class UkmController extends Controller
{
    public function index()
    {
        $ukms = Ukm::latest()->get();
        return view('user.ukm.index', compact('ukms'));
    }

    public function downloadPdf()
    {
        try {
            $ukms = Ukm::all();
            
            $pdf = Pdf::loadView('user.ukm.pdf', compact('ukms'))
                ->setPaper('a4', 'landscape');
            
            $fileName = 'Data_UKM_' . date('Y-m-d_His') . '.pdf';
            
            return $pdf->download($fileName);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mendownload PDF: ' . $e->getMessage());
        }
    }
}