<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('nama_data');
            $table->string('kode')->unique();
            $table->string('alamat')->nullable();
            $table->integer('jumlah_tersedia')->default(0);
            $table->integer('jumlah_terpakai')->default(0);
            $table->integer('total')->storedAs('jumlah_tersedia + jumlah_terpakai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
