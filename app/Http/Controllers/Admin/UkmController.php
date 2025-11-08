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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

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

    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data UKM');
        
        // Set header columns sesuai dengan struktur tabel UKM
        $headers = [
            'A1' => 'nama_mahasiswa',
            'B1' => 'email',
            'C1' => 'nim',
            'D1' => 'nama_ukm',
            'E1' => 'posisi',
            'F1' => 'tahun_bergabung',
            'G1' => 'jurusan'
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
                'startColor' => ['rgb' => '4299E1'] // Blue
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
        
        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);
        
        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(18);
        $sheet->getColumnDimension('G')->setWidth(25);
        
        // Add sample data (contoh)
        $sampleData = [
            ['Budi Santoso', 'budi@example.com', '2101001', 'UKM Robotika', 'Ketua', '2023', 'Teknik Informatika'],
            ['Siti Aminah', 'siti@example.com', '2101002', 'UKM Musik', 'Anggota', '2024', 'Seni Musik'],
            ['Ahmad Rizki', 'ahmad@example.com', '2101003', 'UKM Olahraga', 'Sekretaris', '2023', 'Pendidikan Jasmani'],
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
        
        $sheet->getStyle('A2:G' . ($row - 1))->applyFromArray($dataStyle);
        
        // Add instruction sheet
        $instructionSheet = $spreadsheet->createSheet();
        $instructionSheet->setTitle('Petunjuk');
        
        $instructions = [
            ['PETUNJUK PENGGUNAAN TEMPLATE UKM'],
            [''],
            ['1. Isi data pada sheet "Data UKM" sesuai dengan kolom yang tersedia'],
            ['2. Kolom yang WAJIB diisi:'],
            ['   - nama_mahasiswa: Nama lengkap mahasiswa'],
            ['   - email: Email aktif mahasiswa'],
            ['   - nim: Nomor Induk Mahasiswa'],
            ['   - nama_ukm: Nama Unit Kegiatan Mahasiswa'],
            ['   - posisi: Jabatan dalam UKM (Ketua, Wakil, Sekretaris, Bendahara, Anggota)'],
            ['   - tahun_bergabung: Tahun bergabung dalam format YYYY (contoh: 2024)'],
            ['   - jurusan: Program studi mahasiswa'],
            [''],
            ['3. PENTING:'],
            ['   - JANGAN mengubah nama kolom header (baris pertama)'],
            ['   - Hapus data contoh (baris 2-4) sebelum mengisi data sebenarnya'],
            ['   - Pastikan tidak ada kolom yang kosong'],
            ['   - Posisi yang valid: Ketua, Wakil, Sekretaris, Bendahara, Anggota'],
            ['   - Tahun bergabung dalam format 4 digit (contoh: 2024)'],
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
                'color' => ['rgb' => '4299E1']
            ]
        ]);
        
        $instructionSheet->getColumnDimension('A')->setWidth(80);
        
        // Set active sheet back to data sheet
        $spreadsheet->setActiveSheetIndex(0);
        
        // Generate file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Template_UKM_' . date('Ymd_His') . '.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        
        $writer->save($tempFile);
        
        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}