<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Imports\BeasiswaImport;
use App\Exports\BeasiswaExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class BeasiswaController extends Controller
{
    public function index()
    {
        $beasiswas = Beasiswa::latest()->get();
        
        return view('admin.beasiswa.index', compact('beasiswas'));
    }


    public function upload(Request $request)
    {
        // Validasi file
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv|max:2048', // max 2MB
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
            Excel::import(new BeasiswaImport, $request->file('file'));

            return redirect()->route('admin.beasiswa.index')
                ->with('success', 'Data beasiswa berhasil diupload dan disimpan ke database!');

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
            'jenis_beasiswa' => 'required|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'tahun_ajaran' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $beasiswa = Beasiswa::findOrFail($id);
            $beasiswa->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Data beasiswa berhasil diupdate',
                'data' => $beasiswa
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
            $beasiswa = Beasiswa::findOrFail($id);
            $beasiswa->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data beasiswa berhasil dihapus'
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
            $fileName = 'Data_Beasiswa_' . date('Y-m-d_His') . '.xlsx';
            
            return Excel::download(new BeasiswaExport, $fileName);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mendownload Excel: ' . $e->getMessage());
        }
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