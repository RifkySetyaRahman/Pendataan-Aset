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
        Schema::create('aset', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('serialnumber')->unique();
    $table->string('location');
    $table->date('purchase_date');
    $table->string('category_code');
    $table->string('condition_code');

    $table->string('description')->nullable();
    $table->enum('status', ['baru', 'terpakai'])->default('baru');
    $table->timestamps();

    $table->foreign('category_code')
            ->references('code')
            ->on('kategori_aset')
            ->cascadeOnUpdate()
            ->restrictOnDelete();

    $table->foreign('condition_code')
            ->references('code')
            ->on('kondisi_aset')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset');
    }
};
