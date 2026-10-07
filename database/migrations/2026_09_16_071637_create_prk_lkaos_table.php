<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prk_lkao', function (Blueprint $table) {
            $table->id();

            // Data utama PRK
            $table->string('skko')->nullable();
            $table->string('prk_lkao')->nullable();
            $table->string('no_prk')->nullable();
            $table->text('unsur_1')->nullable();
            $table->decimal('nilai_prk_terbit_awal', 18, 2)->default(0);
            $table->text('kegiatan')->nullable();
            $table->string('bidang')->nullable();
            $table->decimal('nota_dinas_nilai', 18, 2)->default(0);

            // Kontrak dan anggaran sementara
            $table->decimal('kontrak_persen', 8, 2)->default(0);
            $table->decimal('kontrak_nilai', 18, 2)->default(0);

            $table->decimal('realisasi_kontrak_persen', 8, 2)
                ->default(0);

            $table->decimal('realisasi_kontrak_nilai', 18, 2)
                ->default(0);

            $table->decimal('sisa_anggaran_nilai', 18, 2)
                ->default(0);

            $table->decimal('sisa_anggaran_persen', 8, 2)
                ->default(0);

            // Pembayaran sementara
            $table->decimal('total_usul_bayar', 18, 2)->default(0);
            $table->decimal('total_giro_terbayar', 18, 2)->default(0);
            $table->decimal('total_outstanding', 18, 2)->default(0);

            // Rencana kontrak
            $table->text('uraian_rencana_kontrak')->nullable();

            $table->decimal('rencana_jan', 18, 2)->default(0);
            $table->decimal('rencana_feb', 18, 2)->default(0);
            $table->decimal('rencana_mar', 18, 2)->default(0);
            $table->decimal('rencana_apr', 18, 2)->default(0);
            $table->decimal('rencana_mei', 18, 2)->default(0);
            $table->decimal('rencana_jun', 18, 2)->default(0);
            $table->decimal('rencana_jul', 18, 2)->default(0);
            $table->decimal('rencana_ags', 18, 2)->default(0);
            $table->decimal('rencana_sep', 18, 2)->default(0);
            $table->decimal('rencana_okt', 18, 2)->default(0);
            $table->decimal('rencana_nov', 18, 2)->default(0);
            $table->decimal('rencana_des', 18, 2)->default(0);

            // Prognosa dan proyeksi sementara
            $table->decimal('prognosa_terkontrak_nilai', 18, 2)
                ->default(0);

            $table->decimal('prognosa_terkontrak_persen', 8, 2)
                ->default(0);

            $table->decimal('proyeksi_sisa_nilai', 18, 2)
                ->default(0);

            $table->decimal('proyeksi_sisa_persen', 8, 2)
                ->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prk_lkao');
    }
};
