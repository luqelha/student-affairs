<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ukm;
use App\Imports\UkmImport;
use App\Exports\UkmExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class UkmController extends Controller
{
    public function index()
    {
        $ukms = Ukm::latest()->get();
        
        return view('admin.ukm.index', compact('ukms'));
    }

    public function upload(Request $request)
    {
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
            Excel::import(new UkmImport, $request->file('file'));

            return redirect()->route('admin.ukm.index')
                ->with('success', 'Data UKM berhasil diupload dan disimpan ke database!');

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
            'nama_ukm' => 'required|string|max:255',
            'posisi' => 'nullable|string|max:100',
            'tahun_bergabung' => 'nullable|digits:4',
            'jurusan' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $ukm = Ukm::findOrFail($id);
            $ukm->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Data UKM berhasil diupdate',
                'data' => $ukm
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
            $ukm = Ukm::findOrFail($id);
            $ukm->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data UKM berhasil dihapus'
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
            $fileName = 'Data_UKM_' . date('Y-m-d_His') . '.xlsx';
            
            return Excel::download(new UkmExport, $fileName);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mendownload Excel: ' . $e->getMessage());
        }
    }

    public function downloadPdf()
    {
        try {
            $ukms = Ukm::all();
            
            $pdf = Pdf::loadView('admin.ukm.pdf', compact('ukms'))
                ->setPaper('a4', 'landscape');
            
            $fileName = 'Data_UKM_' . date('Y-m-d_His') . '.pdf';
            
            return $pdf->download($fileName);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mendownload PDF: ' . $e->getMessage());
        }
    }
}