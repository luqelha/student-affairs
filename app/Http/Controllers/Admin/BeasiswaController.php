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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

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

    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Beasiswa');

        // Set header columns
        $headers = [
            'A1' => 'nama_mahasiswa',
            'B1' => 'email',
            'C1' => 'nim',
            'D1' => 'jenis_beasiswa',
            'E1' => 'jurusan',
            'F1' => 'tahun_ajaran'
        ];

        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Style header
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'ECC94B']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ];

        $sheet->getStyle('A1:F1')->applyFromArray($headerStyle);

        // Column width
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(25);
        $sheet->getColumnDimension('F')->setWidth(15);

        // Sample data
        $sampleData = [
            ['Budi Santoso', 'budi@example.com', '2101001', 'Beasiswa PPA', 'Teknik Informatika', '2024/2025'],
            ['Siti Aminah', 'siti@example.com', '2101002', 'Beasiswa KIP Kuliah', 'Sistem Informasi', '2024/2025'],
            ['Ahmad Rizki', 'ahmad@example.com', '2101003', 'Beasiswa Prestasi', 'Teknik Elektro', '2024/2025'],
        ];

        $row = 2;
        foreach ($sampleData as $data) {
            $col = 'A';
            foreach ($data as $value) {
                $sheet->setCellValue($col . $row, $value);
                $col++;
            }
            $row++;
        }

        // Style sample data
        $dataStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC']
                ]
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER
            ]
        ];

        $sheet->getStyle('A2:F' . ($row - 1))->applyFromArray($dataStyle);

        // Instruction sheet
        $instructionSheet = $spreadsheet->createSheet();
        $instructionSheet->setTitle('Petunjuk');

        $instructions = [
            ['PETUNJUK PENGGUNAAN TEMPLATE BEASISWA'],
            [''],
            ['1. Isi data pada sheet "Data Beasiswa" sesuai dengan kolom yang tersedia'],
            ['2. Kolom yang WAJIB diisi:'],
            ['   - nama_mahasiswa: Nama lengkap mahasiswa'],
            ['   - email: Email aktif mahasiswa'],
            ['   - nim: Nomor Induk Mahasiswa'],
            ['   - jenis_beasiswa: Jenis beasiswa yang diterima'],
            ['   - jurusan: Program studi mahasiswa'],
            ['   - tahun_ajaran: Format YYYY/YYYY (contoh: 2024/2025)'],
            [''],
            ['3. PENTING:'],
            ['   - JANGAN ubah nama kolom header'],
            ['   - Hapus data contoh sebelum diupload'],
            ['   - Pastikan semua kolom terisi dengan benar'],
            [''],
            ['4. Simpan file dengan format .xlsx atau .xls'],
            ['5. Upload file melalui menu Upload File di dashboard admin'],
        ];

        $row = 1;
        foreach ($instructions as $instruction) {
            $instructionSheet->setCellValue('A' . $row, $instruction[0]);
            $row++;
        }

        $instructionSheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => ['rgb' => 'ECC94B']
            ]
        ]);

        $instructionSheet->getColumnDimension('A')->setWidth(80);

        $spreadsheet->setActiveSheetIndex(0);

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Template_Beasiswa_' . date('Ymd_His') . '.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);

        $writer->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}