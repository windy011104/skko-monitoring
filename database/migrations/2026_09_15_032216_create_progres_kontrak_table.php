<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progres_kontrak', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | IDENTITAS SKKO
            |--------------------------------------------------------------------------
            */

            $table->string('skko')->nullable();
            $table->string('prk_uid')->nullable();
            $table->string('prk_lkao')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('status_pekerjaan')->nullable();
            $table->string('status_bayar')->nullable();
            $table->string('waktu')->nullable();

            /*
            |--------------------------------------------------------------------------
            | PROSES KONTRAK
            |--------------------------------------------------------------------------
            */

            $table->string('no_kontrak')->nullable();
            $table->string('pelaksana')->nullable();

            $table->decimal('nilai_material_kontrak', 18, 2)->nullable();
            $table->decimal('nilai_jasa_kontrak', 18, 2)->nullable();
            $table->decimal('total_nilai_kontrak', 18, 2)->nullable();
            $table->decimal('volume_kontrak', 18, 2)->nullable();

            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();

            /*
            |--------------------------------------------------------------------------
            | REALISASI
            |--------------------------------------------------------------------------
            */

            $table->decimal('nilai_material_realisasi', 18, 2)->nullable();
            $table->decimal('nilai_jasa_realisasi', 18, 2)->nullable();
            $table->decimal('total_nilai_realisasi', 18, 2)->nullable();
            $table->decimal('volume_realisasi', 18, 2)->nullable();

            /*
            |--------------------------------------------------------------------------
            | AMANDEMEN WAKTU
            |--------------------------------------------------------------------------
            */

            $table->string('amandemen_waktu_nomor')->nullable();
            $table->date('amandemen_waktu_tanggal')->nullable();

            /*
            |--------------------------------------------------------------------------
            | AMANDEMEN NILAI
            |--------------------------------------------------------------------------
            */

            $table->string('amandemen_nilai_nomor')->nullable();
            $table->date('amandemen_nilai_tanggal')->nullable();

            /*
            |--------------------------------------------------------------------------
            | USUL BAYAR 100%
            |--------------------------------------------------------------------------
            */

            $table->string('usul_bayar_100_no_bapp')->nullable();
            $table->date('usul_bayar_100_tgl_bapp')->nullable();

            $table->string('usul_bayar_100_no_bast')->nullable();
            $table->date('usul_bayar_100_tgl_bast')->nullable();

            $table->string('usul_bayar_100_no_submission_id')->nullable();
            $table->date('usul_bayar_100_tgl_submission')->nullable();

            $table->decimal('usul_bayar_100_nilai', 18, 2)->nullable();
            $table->decimal('usul_bayar_100_persentase', 5, 2)->nullable();

            /*
            |--------------------------------------------------------------------------
            | GIRO 100%
            |--------------------------------------------------------------------------
            */

            $table->date('giro_100_tanggal')->nullable();
            $table->decimal('giro_100_nilai', 18, 2)->nullable();

            /*
            |--------------------------------------------------------------------------
            | USUL BAYAR 95%
            |--------------------------------------------------------------------------
            */

            $table->string('usul_bayar_95_no_bapp')->nullable();
            $table->date('usul_bayar_95_tgl_bapp')->nullable();

            $table->string('usul_bayar_95_no_bast')->nullable();
            $table->date('usul_bayar_95_tgl_bast')->nullable();

            $table->string('usul_bayar_95_no_submission_id')->nullable();
            $table->date('usul_bayar_95_tgl_submission')->nullable();

            $table->decimal('usul_bayar_95_nilai', 18, 2)->nullable();
            $table->decimal('usul_bayar_95_persentase', 5, 2)->nullable();

            /*
            |--------------------------------------------------------------------------
            | GIRO 95%
            |--------------------------------------------------------------------------
            */

            $table->date('giro_95_tanggal')->nullable();
            $table->decimal('giro_95_nilai', 18, 2)->nullable();

            /*
            |--------------------------------------------------------------------------
            | USUL BAYAR 5%
            |--------------------------------------------------------------------------
            */

            $table->string('usul_bayar_5_no_bapp')->nullable();
            $table->date('usul_bayar_5_tgl_bapp')->nullable();

            $table->string('usul_bayar_5_no_bast')->nullable();
            $table->date('usul_bayar_5_tgl_bast')->nullable();

            $table->string('usul_bayar_5_no_submission_id')->nullable();
            $table->date('usul_bayar_5_tgl_submission')->nullable();

            $table->decimal('usul_bayar_5_nilai', 18, 2)->nullable();
            $table->decimal('usul_bayar_5_persentase', 5, 2)->nullable();

            /*
            |--------------------------------------------------------------------------
            | GIRO 5%
            |--------------------------------------------------------------------------
            */

            $table->date('giro_5_tanggal')->nullable();
            $table->decimal('giro_5_nilai', 18, 2)->nullable();

            /*
            |--------------------------------------------------------------------------
            | PROGRESS PEKERJAAN
            |--------------------------------------------------------------------------
            */

            $table->text('keterangan')->nullable();
            $table->decimal('nilai_sisa', 18, 2)->nullable();
            $table->text('kendala')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->decimal('persentase_fisik', 5, 2)->nullable();

            /*
            |--------------------------------------------------------------------------
            | RINGKASAN PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            $table->string('no_po')->nullable();
            $table->decimal('total_usul_bayar', 18, 2)->nullable();
            $table->decimal('total_giro', 18, 2)->nullable();
            $table->decimal('total_outstanding', 18, 2)->nullable();

            /*
            |--------------------------------------------------------------------------
            | NOMOR DOKUMEN SAP - PEMBAYARAN 100%
            |--------------------------------------------------------------------------
            */

            $table->string('sap_100_no_invoice')->nullable();
            $table->date('sap_100_tanggal')->nullable();
            $table->string('sap_100_no_doc')->nullable();

            /*
            |--------------------------------------------------------------------------
            | NOMOR DOKUMEN SAP - PEMBAYARAN 95%
            |--------------------------------------------------------------------------
            */

            $table->string('sap_95_no_invoice')->nullable();
            $table->date('sap_95_tanggal')->nullable();
            $table->string('sap_95_no_doc')->nullable();

            /*
            |--------------------------------------------------------------------------
            | NOMOR DOKUMEN SAP - PEMBAYARAN 5%
            |--------------------------------------------------------------------------
            */

            $table->string('sap_5_no_invoice')->nullable();
            $table->date('sap_5_tanggal')->nullable();
            $table->string('sap_5_no_doc')->nullable();

            /*
            |--------------------------------------------------------------------------
            | DATA PENGAWAS DAN KONTRAK
            |--------------------------------------------------------------------------
            */

            $table->string('pengawas')->nullable();
            $table->string('jenis_jtl')->nullable();
            $table->string('metode_kontrak')->nullable();

            /*
            |--------------------------------------------------------------------------
            | TOTAL KONTRAK DAN REALISASI
            |--------------------------------------------------------------------------
            */

            $table->decimal('total_material_terkontrak', 18, 2)->nullable();
            $table->decimal('total_jasa_terkontrak', 18, 2)->nullable();
            $table->decimal('total_terkontrak', 18, 2)->nullable();
            $table->decimal('terkontrak_belum_realisasi', 18, 2)->nullable();

            $table->decimal('total_realisasi_material', 18, 2)->nullable();
            $table->decimal('total_realisasi_jasa', 18, 2)->nullable();
            $table->decimal('total_realisasi_kontrak', 18, 2)->nullable();

            /*
            |--------------------------------------------------------------------------
            | TANGGAL DAN PERHITUNGAN
            |--------------------------------------------------------------------------
            */

            $table->date('tgl_bulan_kontrak')->nullable();
            $table->date('tgl_bulan_usul_bayar_100')->nullable();
            $table->date('tgl_bulan_usul_bayar_95')->nullable();
            $table->date('tgl_bulan_usul_bayar_5')->nullable();

            $table->decimal('selisih_kontrak_realisasi', 18, 2)->nullable();
            $table->decimal('persentase_pencapaian_kontrak', 5, 2)->nullable();

            /*
            |--------------------------------------------------------------------------
            | RENCANA KONTRAK
            |--------------------------------------------------------------------------
            */

            $table->decimal('rencana_kontrak_rp', 18, 2)->nullable();
            $table->string('rencana_kontrak_bulan')->nullable();

            /*
            |--------------------------------------------------------------------------
            | RENCANA USUL BAYAR 95%
            |--------------------------------------------------------------------------
            */

            $table->decimal('rencana_usul_bayar_95_rp', 18, 2)->nullable();
            $table->string('rencana_usul_bayar_95_bulan')->nullable();

            /*
            |--------------------------------------------------------------------------
            | RENCANA USUL BAYAR 5%
            |--------------------------------------------------------------------------
            */

            $table->decimal('rencana_usul_bayar_5_rp', 18, 2)->nullable();
            $table->string('rencana_usul_bayar_5_bulan')->nullable();

            /*
            |--------------------------------------------------------------------------
            | RENCANA USUL BAYAR 100%
            |--------------------------------------------------------------------------
            */

            $table->decimal('rencana_usul_bayar_100_rp', 18, 2)->nullable();
            $table->string('rencana_usul_bayar_100_bulan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progres_kontrak');
    }
};
