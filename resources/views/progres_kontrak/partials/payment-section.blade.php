<div class="form-card">
    <div class="form-card-header">
        <div class="section-icon bg-green-100">
            <svg
                class="w-5 h-5 text-green-700"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-10V5m0 14v-3m9-4a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>
        </div>

        <div>
            <h2 class="section-title">
                {{ $title }}
            </h2>

            <p class="section-description">
                Informasi dokumen dan nilai usul bayar
            </p>
        </div>
    </div>

    <div class="form-card-body">
        <div class="form-grid">

            @include('progres_kontrak.partials.input', [
                'name' => "usul_bayar_{$prefix}_no_bapp",
                'label' => 'No. BAPP',
                'placeholder' => 'Masukkan nomor BAPP'
            ])

            @include('progres_kontrak.partials.date', [
                'name' => "usul_bayar_{$prefix}_tgl_bapp",
                'label' => 'Tanggal BAPP'
            ])

            @include('progres_kontrak.partials.input', [
                'name' => "usul_bayar_{$prefix}_no_bast",
                'label' => 'No. BAST',
                'placeholder' => 'Masukkan nomor BAST'
            ])

            @include('progres_kontrak.partials.date', [
                'name' => "usul_bayar_{$prefix}_tgl_bast",
                'label' => 'Tanggal BAST'
            ])

            @include('progres_kontrak.partials.input', [
                'name' => "usul_bayar_{$prefix}_no_submission_id",
                'label' => 'No. Submission ID',
                'placeholder' => 'Masukkan submission ID'
            ])

            @include('progres_kontrak.partials.date', [
                'name' => "usul_bayar_{$prefix}_tgl_submission",
                'label' => 'Tanggal Submission'
            ])

            @include('progres_kontrak.partials.number', [
                'name' => "usul_bayar_{$prefix}_nilai",
                'label' => "Nilai Usul Bayar {$prefix}%"
            ])

            @include('progres_kontrak.partials.number', [
                'name' => "usul_bayar_{$prefix}_persentase",
                'label' => "Persentase {$prefix}%"
            ])

        </div>
    </div>
</div>
