<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ImportedData extends Model {
    protected $table = 'imported_data';
    protected $fillable = [
        'import_session',
        'data',
        'columns',
        'uploaded_by',
    ];
    protected $casts = [
        'data' => 'array',
        'columns' => 'array',
    ];

    public function uploader() {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public static function getLatestImport() {
        return self::orderBy('created_at', 'desc')->first();
    }
    
    public static function getImportBySession($session) {
        return self::where('import_session', $session)->get();
    }
}