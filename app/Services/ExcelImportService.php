<?php
namespace App\Services;
use App\Models\ImportedData;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelImportService {
    public function import($file, $importSession, $userId) {
        $spreadsheet = IOFactory::load($file->getRealPath());
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        if (empty($rows)) {
            throw new \Exception('File Excel kosong.');
        }

        $columns = array_filter(array_shift($rows));
        $dataToInsert = [];
        $count = 0;

        foreach ($rows as $row) {
            // Skip baris kosong
            if (empty(array_filter($row))) continue;

            $rowData = [];
            foreach ($columns as $index => $column) {
                $rowData[$column] = $row[$index] ?? '';
            }

            $dataToInsert[] = [
                'import_session' => $importSession,
                'data' => json_encode($rowData),
                'columns' => json_encode($columns),
                'uploaded_by' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $count++;
        }

        ImportedData::insert($dataToInsert);

        return ['count' => $count];
    }
}