<?php

namespace App\Models;

use App\Models\Bidang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkkoTerbit2026 extends Model
{
    protected $table = 'skko_terbit2026s';

    protected $fillable = [
        'NO',
        'bidang_id',
        'POS_ANGGARAN',
        'TYPE_SKKO',
        'JENIS_BIAYA_OPERASI',
        'FUNGSI',
        'UNSUR',
        'SUB_UNSUR',
        'NO_SKKO',
        'URAIAN',
        'NO_PRK_LKAO',

        'AWAL_TERBIT_TANGGAL',
        'AWAL_TERBIT_NILAI',

        'REV_1_NO_SKKO',
        'REV_1_TANGGAL',
        'REV_1_NILAI',

        'REV_2_NO_SKKO',
        'REV_2_TANGGAL',
        'REV_2_NILAI',

        'REV_3_NO_SKKO',
        'REV_3_TANGGAL',
        'REV_3_NILAI',

        'REV_4_NO_SKKO',
        'REV_4_TANGGAL',
        'REV_4_NILAI',

        'SKKO_TERBIT_NO_SKKO',
        'SKKO_TERBIT_TANGGAL',
        'SKKO_TERBIT_NILAI',
    ];

    protected $casts = [
        'AWAL_TERBIT_TANGGAL' => 'date',
        'REV_1_TANGGAL' => 'date',
        'REV_2_TANGGAL' => 'date',
        'REV_3_TANGGAL' => 'date',
        'REV_4_TANGGAL' => 'date',
        'SKKO_TERBIT_TANGGAL' => 'date',

        'AWAL_TERBIT_NILAI' => 'decimal:2',
        'REV_1_NILAI' => 'decimal:2',
        'REV_2_NILAI' => 'decimal:2',
        'REV_3_NILAI' => 'decimal:2',
        'REV_4_NILAI' => 'decimal:2',
        'SKKO_TERBIT_NILAI' => 'decimal:2',
    ];
    public function bidang(): BelongsTo
{
    return $this->belongsTo(Bidang::class);
}
}
