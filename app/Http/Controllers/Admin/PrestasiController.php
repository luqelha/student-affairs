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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

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

    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Prestasi');
        
        // Set header columns sesuai dengan struktur tabel prestasi
        $headers = [
            'A1' => 'nama_mahasiswa',
            'B1' => 'email',
            'C1' => 'nim',
            'D1' => 'jenis_prestasi',
            'E1' => 'tingkat',
            'F1' => 'penyelenggara',
            'G1' => 'tahun',
            'H1' => 'jurusan'
        ];
        
        // Set headers
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
                'startColor' => ['rgb' => 'ED8936'] // Orange
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
        
        $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);
        
        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(10);
        $sheet->getColumnDimension('H')->setWidth(25);
        
        // Add sample data (contoh)
        $sampleData = [
            ['Budi Santoso', 'budi@example.com', '2101001', 'Lomba Coding', 'Nasional', 'Kemendikbud', '2024', 'Teknik Informatika'],
            ['Siti Aminah', 'siti@example.com', '2101002', 'Olimpiade Matematika', 'Internasional', 'IMO', '2024', 'Matematika'],
            ['Ahmad Rizki', 'ahmad@example.com', '2101003', 'Hackathon', 'Lokal', 'Universitas ABC', '2024', 'Sistem Informasi'],
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
        
        $sheet->getStyle('A2:H' . ($row - 1))->applyFromArray($dataStyle);
        
        // Add instruction sheet
        $instructionSheet = $spreadsheet->createSheet();
        $instructionSheet->setTitle('Petunjuk');
        
        $instructions = [
            ['PETUNJUK PENGGUNAAN TEMPLATE PRESTASI'],
            [''],
            ['1. Isi data pada sheet "Data Prestasi" sesuai dengan kolom yang tersedia'],
            ['2. Kolom yang WAJIB diisi:'],
            ['   - nama_mahasiswa: Nama lengkap mahasiswa'],
            ['   - email: Email aktif mahasiswa'],
            ['   - nim: Nomor Induk Mahasiswa'],
            ['   - jenis_prestasi: Nama lomba/kompetisi/prestasi'],
            ['   - tingkat: Nasional / Internasional / Lokal'],
            ['   - penyelenggara: Nama lembaga/institusi penyelenggara'],
            ['   - tahun: Tahun prestasi diraih (format: YYYY)'],
            ['   - jurusan: Program studi mahasiswa'],
            [''],
            ['3. PENTING:'],
            ['   - JANGAN mengubah nama kolom header (baris pertama)'],
            ['   - Hapus data contoh (baris 2-4) sebelum mengisi data sebenarnya'],
            ['   - Pastikan tidak ada kolom yang kosong'],
            ['   - Tingkat hanya diisi: Nasional, Internasional, atau Lokal'],
            ['   - Tahun dalam format 4 digit (contoh: 2024)'],
            [''],
            ['4. Simpan file dengan format .xlsx atau .xls'],
            ['5. Upload file melalui menu "Upload File" di dashboard admin'],
        ];
        
        $row = 1;
        foreach ($instructions as $instruction) {
            $instructionSheet->setCellValue('A' . $row, $instruction[0]);
            $row++;
        }
        
        // Style instruction title
        $instructionSheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => ['rgb' => 'ED8936']
            ]
        ]);
        
        $instructionSheet->getColumnDimension('A')->setWidth(80);
        
        // Set active sheet back to data sheet
        $spreadsheet->setActiveSheetIndex(0);
        
        // Generate file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Template_Prestasi_' . date('Ymd_His') . '.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        
        $writer->save($tempFile);
        
        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}