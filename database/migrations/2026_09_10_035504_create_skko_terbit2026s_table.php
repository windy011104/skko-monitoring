<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skko_terbit2026s', function (Blueprint $table) {

            $table->id();

            $table->integer('NO')->nullable();

            $table->string('POS_ANGGARAN')->nullable();
            $table->string('TYPE_SKKO')->nullable();
            $table->string('JENIS_BIAYA_OPERASI')->nullable();
            $table->string('FUNGSI')->nullable();
            $table->string('UNSUR')->nullable();
            $table->string('SUB_UNSUR')->nullable();

            $table->string('NO_SKKO')->nullable();

            $table->text('URAIAN')->nullable();
            $table->string('NO_PRK_LKAO')->nullable();

            // SKKO Awal
            $table->date('AWAL_TERBIT_TANGGAL')->nullable();
            $table->decimal('AWAL_TERBIT_NILAI', 20, 2)->nullable();

            // Revisi 1
            $table->string('REV_1_NO_SKKO')->nullable();
            $table->date('REV_1_TANGGAL')->nullable();
            $table->decimal('REV_1_NILAI', 20, 2)->nullable();

            // Revisi 2
            $table->string('REV_2_NO_SKKO')->nullable();
            $table->date('REV_2_TANGGAL')->nullable();
            $table->decimal('REV_2_NILAI', 20, 2)->nullable();

            // Revisi 3
            $table->string('REV_3_NO_SKKO')->nullable();
            $table->date('REV_3_TANGGAL')->nullable();
            $table->decimal('REV_3_NILAI', 20, 2)->nullable();

            // Revisi 4
            $table->string('REV_4_NO_SKKO')->nullable();
            $table->date('REV_4_TANGGAL')->nullable();
            $table->decimal('REV_4_NILAI', 20, 2)->nullable();

            // SKKO Terbit Final
            $table->string('SKKO_TERBIT_NO_SKKO')->nullable();
            $table->date('SKKO_TERBIT_TANGGAL')->nullable();
            $table->decimal('SKKO_TERBIT_NILAI', 20, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skko_terbit2026s');
    }
};
