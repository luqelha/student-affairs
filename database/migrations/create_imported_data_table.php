<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('imported_data', function (Blueprint $table) {
            $table->id();
            $table->string('import_session')->index();
            $table->json('columns');
            $table->json('data');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('imported_data');
    }
};