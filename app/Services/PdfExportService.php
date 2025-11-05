<?php
namespace App\Services;
use App\Models\ImportedData;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfExportService {
    public function exportToPdf() {
        $latestImport = ImportedData::getLatestImport();
        if (!$latestImport) {
            return response('Tidak ada data', 404);
        }

        $data = ImportedData::getImportBySession($latestImport->import_session);
        $columns = $latestImport->columns;

        $pdf = Pdf::loadView('admin.beasiswa.pdf', [
            'data' => $data,
            'columns' => $columns,
        ])->setPaper('a4', 'landscape'); // Atur ke landscape

        return $pdf->download('daftar-beasiswa-'.date('Y-m-d').'.pdf');
    }
}