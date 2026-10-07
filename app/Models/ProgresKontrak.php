<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bidang;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgresKontrak extends Model
{
    protected $table = 'progres_kontrak';

    protected $fillable = [
        'bidang_id',
        'skko',
        'prk_uid',
        'prk_lkao',
        'pekerjaan',
        'lokasi',
        'status_pekerjaan',
        'status_bayar',
        'waktu',

        'no_kontrak',
        'pelaksana',
        'nilai_material_kontrak',
        'nilai_jasa_kontrak',
        'total_nilai_kontrak',
        'volume_kontrak',
        'tgl_mulai',
        'tgl_selesai',

        'nilai_material_realisasi',
        'nilai_jasa_realisasi',
        'total_nilai_realisasi',
        'volume_realisasi',

        'amandemen_waktu_nomor',
        'amandemen_waktu_tanggal',
        'amandemen_nilai_nomor',
        'amandemen_nilai_tanggal',

        'usul_bayar_100_no_bapp',
        'usul_bayar_100_tgl_bapp',
        'usul_bayar_100_no_bast',
        'usul_bayar_100_tgl_bast',
        'usul_bayar_100_no_submission_id',
        'usul_bayar_100_tgl_submission',
        'usul_bayar_100_nilai',
        'usul_bayar_100_persentase',

        'giro_100_tanggal',
        'giro_100_nilai',

        'usul_bayar_95_no_bapp',
        'usul_bayar_95_tgl_bapp',
        'usul_bayar_95_no_bast',
        'usul_bayar_95_tgl_bast',
        'usul_bayar_95_no_submission_id',
        'usul_bayar_95_tgl_submission',
        'usul_bayar_95_nilai',
        'usul_bayar_95_persentase',

        'giro_95_tanggal',
        'giro_95_nilai',

        'usul_bayar_5_no_bapp',
        'usul_bayar_5_tgl_bapp',
        'usul_bayar_5_no_bast',
        'usul_bayar_5_tgl_bast',
        'usul_bayar_5_no_submission_id',
        'usul_bayar_5_tgl_submission',
        'usul_bayar_5_nilai',
        'usul_bayar_5_persentase',

        'giro_5_tanggal',
        'giro_5_nilai',

        'keterangan',
        'nilai_sisa',
        'kendala',
        'tindak_lanjut',
        'persentase_fisik',

        'no_po',
        'total_usul_bayar',
        'total_giro',
        'total_outstanding',

        'sap_100_no_invoice',
        'sap_100_tanggal',
        'sap_100_no_doc',

        'sap_95_no_invoice',
        'sap_95_tanggal',
        'sap_95_no_doc',

        'sap_5_no_invoice',
        'sap_5_tanggal',
        'sap_5_no_doc',

        'pengawas',
        'jenis_jtl',
        'metode_kontrak',

        'total_material_terkontrak',
        'total_jasa_terkontrak',
        'total_terkontrak',
        'terkontrak_belum_realisasi',
        'total_realisasi_material',
        'total_realisasi_jasa',
        'total_realisasi_kontrak',

        'tgl_bulan_kontrak',
        'tgl_bulan_usul_bayar_100',
        'tgl_bulan_usul_bayar_95',
        'tgl_bulan_usul_bayar_5',
        'selisih_kontrak_realisasi',
        'persentase_pencapaian_kontrak',

        'rencana_kontrak_rp',
        'rencana_kontrak_bulan',

        'rencana_usul_bayar_95_rp',
        'rencana_usul_bayar_95_bulan',

        'rencana_usul_bayar_5_rp',
        'rencana_usul_bayar_5_bulan',

        'rencana_usul_bayar_100_rp',
        'rencana_usul_bayar_100_bulan',
    ];

    protected $casts = [
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date',

        'amandemen_waktu_tanggal' => 'date',
        'amandemen_nilai_tanggal' => 'date',

        'usul_bayar_100_tgl_bapp' => 'date',
        'usul_bayar_100_tgl_bast' => 'date',
        'usul_bayar_100_tgl_submission' => 'date',
        'giro_100_tanggal' => 'date',

        'usul_bayar_95_tgl_bapp' => 'date',
        'usul_bayar_95_tgl_bast' => 'date',
        'usul_bayar_95_tgl_submission' => 'date',
        'giro_95_tanggal' => 'date',

        'usul_bayar_5_tgl_bapp' => 'date',
        'usul_bayar_5_tgl_bast' => 'date',
        'usul_bayar_5_tgl_submission' => 'date',
        'giro_5_tanggal' => 'date',

        'sap_100_tanggal' => 'date',
        'sap_95_tanggal' => 'date',
        'sap_5_tanggal' => 'date',

        'tgl_bulan_kontrak' => 'date',
        'tgl_bulan_usul_bayar_100' => 'date',
        'tgl_bulan_usul_bayar_95' => 'date',
        'tgl_bulan_usul_bayar_5' => 'date',

        'nilai_material_kontrak' => 'decimal:2',
        'nilai_jasa_kontrak' => 'decimal:2',
        'total_nilai_kontrak' => 'decimal:2',
        'volume_kontrak' => 'decimal:2',

        'nilai_material_realisasi' => 'decimal:2',
        'nilai_jasa_realisasi' => 'decimal:2',
        'total_nilai_realisasi' => 'decimal:2',
        'volume_realisasi' => 'decimal:2',

        'usul_bayar_100_nilai' => 'decimal:2',
        'usul_bayar_100_persentase' => 'decimal:2',
        'giro_100_nilai' => 'decimal:2',

        'usul_bayar_95_nilai' => 'decimal:2',
        'usul_bayar_95_persentase' => 'decimal:2',
        'giro_95_nilai' => 'decimal:2',

        'usul_bayar_5_nilai' => 'decimal:2',
        'usul_bayar_5_persentase' => 'decimal:2',
        'giro_5_nilai' => 'decimal:2',

        'nilai_sisa' => 'decimal:2',
        'persentase_fisik' => 'decimal:2',

        'total_usul_bayar' => 'decimal:2',
        'total_giro' => 'decimal:2',
        'total_outstanding' => 'decimal:2',

        'total_material_terkontrak' => 'decimal:2',
        'total_jasa_terkontrak' => 'decimal:2',
        'total_terkontrak' => 'decimal:2',
        'terkontrak_belum_realisasi' => 'decimal:2',
        'total_realisasi_material' => 'decimal:2',
        'total_realisasi_jasa' => 'decimal:2',
        'total_realisasi_kontrak' => 'decimal:2',

        'selisih_kontrak_realisasi' => 'decimal:2',
        'persentase_pencapaian_kontrak' => 'decimal:2',

        'rencana_kontrak_rp' => 'decimal:2',
        'rencana_usul_bayar_95_rp' => 'decimal:2',
        'rencana_usul_bayar_5_rp' => 'decimal:2',
        'rencana_usul_bayar_100_rp' => 'decimal:2',
    ];
    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class);
    }
}
