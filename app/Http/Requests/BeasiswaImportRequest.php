<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class BeasiswaImportRequest extends FormRequest {
    public function authorize() {
        return auth()->check() && auth()->user()->isAdmin(); // Hanya admin
    }
    public function rules() {
        return [
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240', // 10MB Max
        ];
    }
}