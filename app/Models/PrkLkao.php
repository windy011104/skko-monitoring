<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrkLkao extends Model
{
    protected $table = 'prk_lkao';
    protected $fillable = [
        'skko',
        'prk_lkao',
        'no_prk',
        'unsur_1',
        'nilai_prk_terbit_awal',
        'kegiatan',
        'bidang',
        'nota_dinas_nilai',

        'kontrak_persen',
        'kontrak_nilai',
        'realisasi_kontrak_persen',
        'realisasi_kontrak_nilai',
        'sisa_anggaran_nilai',
        'sisa_anggaran_persen',

        'total_usul_bayar',
        'total_giro_terbayar',
        'total_outstanding',

        'uraian_rencana_kontrak',

        'rencana_jan',
        'rencana_feb',
        'rencana_mar',
        'rencana_apr',
        'rencana_mei',
        'rencana_jun',
        'rencana_jul',
        'rencana_ags',
        'rencana_sep',
        'rencana_okt',
        'rencana_nov',
        'rencana_des',

        'prognosa_terkontrak_nilai',
        'prognosa_terkontrak_persen',
        'proyeksi_sisa_nilai',
        'proyeksi_sisa_persen',
    ];

    protected $casts = [
        'nilai_prk_terbit_awal' => 'decimal:2',
        'nota_dinas_nilai' => 'decimal:2',

        'kontrak_persen' => 'decimal:2',
        'kontrak_nilai' => 'decimal:2',

        'realisasi_kontrak_persen' => 'decimal:2',
        'realisasi_kontrak_nilai' => 'decimal:2',

        'sisa_anggaran_nilai' => 'decimal:2',
        'sisa_anggaran_persen' => 'decimal:2',

        'total_usul_bayar' => 'decimal:2',
        'total_giro_terbayar' => 'decimal:2',
        'total_outstanding' => 'decimal:2',

        'rencana_jan' => 'decimal:2',
        'rencana_feb' => 'decimal:2',
        'rencana_mar' => 'decimal:2',
        'rencana_apr' => 'decimal:2',
        'rencana_mei' => 'decimal:2',
        'rencana_jun' => 'decimal:2',
        'rencana_jul' => 'decimal:2',
        'rencana_ags' => 'decimal:2',
        'rencana_sep' => 'decimal:2',
        'rencana_okt' => 'decimal:2',
        'rencana_nov' => 'decimal:2',
        'rencana_des' => 'decimal:2',

        'prognosa_terkontrak_nilai' => 'decimal:2',
        'prognosa_terkontrak_persen' => 'decimal:2',
        'proyeksi_sisa_nilai' => 'decimal:2',
        'proyeksi_sisa_persen' => 'decimal:2',
    ];
}
