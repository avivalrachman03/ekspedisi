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
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->string('no_resi')->nullable(false);
            $table->string('nama_paket')->nullable(false);
            $table->integer('panjang')->nullable()->default(null);
            $table->integer('lebar')->nullable()->default(null);
            $table->integer('tinggi')->nullable()->default(null);
            $table->integer('volume')->nullable();
            $table->float('berat')->nullable(false);
            $table->date('tanggal_pengiriman')->nullable(false);
            $table->string('nama_penerima')->nullable();
            $table->string('hp_penerima')->nullable();
            $table->text('alamat_penerima')->nullable();
            $table->foreignId('province_id')->constrained('provinces')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('regencies_id')->constrained('regencies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('harga')->nullable()->default(0);
            $table->foreignId('pengirim_id')->constrained('pengirims')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('resi_vendor')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('koli')->nullabnle();
            $table->unsignedBigInteger('tambahan')->nullable();
            $table->unsignedBigInteger('total')->nullable(false);
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
