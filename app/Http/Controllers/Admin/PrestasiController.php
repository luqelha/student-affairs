<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Imports\PrestasiImport;
use App\Exports\PrestasiExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasis = Prestasi::latest()->get();
        
        return view('admin.prestasi.index', compact('prestasis'));
    }

    public function upload(Request $request)
    {
        // Validasi file
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ], [
            'file.required' => 'File wajib diupload',
            'file.mimes' => 'File harus berformat Excel (.xlsx, .xls) atau CSV (.csv)',
            'file.max' => 'Ukuran file maksimal 2MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', $validator->errors()->first());
        }

        try {
            Excel::import(new PrestasiImport, $request->file('file'));

            return redirect()->route('admin.prestasi.index')
                ->with('success', 'Data prestasi berhasil diupload dan disimpan ke database!');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = "Baris {$failure->row()}: " . implode(', ', $failure->errors());
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan validasi: ' . implode(' | ', $errorMessages));

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengupload file: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_mahasiswa' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'nim' => 'nullable|string|max:50',
            'jenis_prestasi' => 'required|string|max:255',
            'tingkat' => 'nullable|string|max:50',
            'penyelenggara' => 'nullable|string|max:255',
            'tahun' => 'nullable|digits:4',
            'jurusan' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $prestasi = Prestasi::findOrFail($id);
            $prestasi->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Data prestasi berhasil diupdate',
                'data' => $prestasi
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $prestasi = Prestasi::findOrFail($id);
            $prestasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data prestasi berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function downloadExcel()
    {
        try {
            $fileName = 'Data_Prestasi_' . date('Y-m-d_His') . '.xlsx';
            
            return Excel::download(new PrestasiExport, $fileName);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mendownload Excel: ' . $e->getMessage());
        }
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