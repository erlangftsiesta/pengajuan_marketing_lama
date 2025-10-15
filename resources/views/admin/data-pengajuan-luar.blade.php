@extends('layouts.parent-layout')

{{-- @section('breadcrumb-title', 'Pengajuan') --}}
@section('page-title', 'Data Pengajuan Luar')

@section('content')

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center border-bottom mb-3">
                        <h6 class="card-title mb-3">Daftar Pengajuan Nasabah Luar</h6>
                    </div>

                    <form method="GET" action="{{ route('admin.data.pengajuan.luar') }}" class="mb-4">
                        <div class="row">
                            <!-- Filter Waktu -->
                            <div class="col-md-3">
                                <label for="filter_time" class="form-label">Pilih Waktu</label>
                                <select name="filter_time" id="filter_time" class="form-control">
                                    <option value="">Semua Waktu</option>
                                    <option value="today" {{ request('filter_time') == 'today' ? 'selected' : '' }}>Hari
                                        Ini</option>
                                    <option value="this_month"
                                        {{ request('filter_time') == 'this_month' ? 'selected' : '' }}>Bulan Ini
                                    </option>
                                    <option value="this_year" {{ request('filter_time') == 'this_year' ? 'selected' : '' }}>
                                        Tahun Ini
                                    </option>
                                </select>
                            </div>

                            <!-- Filter Bulan -->
                            <div class="col-md-3">
                                <label for="month" class="form-label">Pilih Bulan</label>
                                <select name="month" id="month" class="form-control">
                                    <option value="">Semua Bulan</option>
                                    @for ($m = 1; $m <= 12; $m++)
                                        @php
                                            $namaBulan = \Carbon\Carbon::createFromFormat('m', $m)->translatedFormat(
                                                'F',
                                            );
                                        @endphp
                                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                            {{ $namaBulan }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Filter Tahun -->
                            <div class="col-md-3">
                                <label for="year" class="form-label">Pilih Tahun</label>
                                <select name="year" id="year" class="form-control">
                                    <option value="">Semua Tahun</option>
                                    @for ($y = now()->year; $y >= now()->year - 10; $y--)
                                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-sm w-100">Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive mt-2">
                        <table id="myTable" class="table table-striped nowrap" style="width:100%;">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center align-middle">No</th>
                                    <th rowspan="2" class="align-middle">Nama Nasabah</th>
                                    <th rowspan="2" class="align-middle">Jenis Pembiayaan</th>
                                    <th rowspan="2" class="align-middle">Nominal Pinjaman</th>
                                    <th rowspan="2" class="align-middle">Marketing</th>
                                    <th colspan="3" class="text-center">Status</th>
                                    {{-- <th colspan="1" class="text-center">isBanding?</th> --}}
                                    <th rowspan="2" class="align-middle">Keterangan</th>
                                    <th rowspan="2" class="text-center align-middle">Aksi</th>
                                </tr>
                                <tr>
                                    <th class="status-header">SPV</th>
                                    <th class="status-header">CA</th>
                                    <th class="status-header">HM</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($pengajuan)
                                    @php $index = 1; @endphp
                                    @foreach ($pengajuan as $data)
                                        @foreach ($data->pengajuanLuar as $pengajuan)
                                            <tr class="align-middle nowrap">
                                                <td class="align-middle nowrap">{{ $index }}</td>
                                                <td class="align-middle nowrap">
                                                    {{ $data->nama_lengkap }}
                                                    @if ($data->pengajuanLuar->count() > 1 && !$loop->first)
                                                        <br>
                                                        <small>Repeat Order</small>
                                                    @endif
                                                </td>
                                                <td class="align-middle nowrap">{{ $pengajuan->jenis_pembiayaan }}</td>
                                                <td class="align-middle nowrap">
                                                    <div class="mb-1">
                                                        Rp. {{ number_format($pengajuan->nominal_pinjaman, 0, ',', '.') }}
                                                    </div>
                                                    <small>{{ $pengajuan->tenor }} Bulan</small>
                                                </td>
                                                <td class="align-middle nowrap">
                                                    <div class="mb-1">
                                                        {{ Str::title($data->user->name) ?? 'Marketing Tidak Ditemukan' }}
                                                    </div>
                                                    <small>
                                                        {{ $pengajuan->created_at->translatedFormat('d F Y') }}
                                                    </small>
                                                </td>
                                                @php
                                                    $hmStatus = $pengajuan->approval
                                                        ->where('role', 'hm')
                                                        ->pluck('status')
                                                        ->last();

                                                    // Ambil data approval CA terakhir
                                                    $lastCAApproval = $pengajuan->approval->where('role', 'ca')->last();
                                                    $spvApproval = $pengajuan->approval->where('role', 'spv')->last();

                                                    $ca =
                                                        $lastCAApproval && $lastCAApproval->user
                                                            ? explode(' ', trim($lastCAApproval->user->name))[0]
                                                            : 'Unknown';

                                                    $spv =
                                                        $spvApproval && $spvApproval->user
                                                            ? explode(' ', trim($spvApproval->user->name))[0]
                                                            : 'Unknown';

                                                    // Status approval
                                                    $caStatus = $lastCAApproval ? $lastCAApproval->status : null;
                                                    $spvStatus = $spvApproval ? $spvApproval->status : null;
                                                @endphp
                                                <td class="status-cell text-center">
                                                    {!! $spvStatus === 'checked'
                                                        ? '<i class="mdi mdi-check-circle text-success"></i>'
                                                        : ($spvStatus === 'rejected'
                                                            ? '<i class="mdi mdi-close-circle text-danger"></i>'
                                                            : '<i class="mdi mdi-clock-outline text-info"></i>') !!}
                                                    <br>
                                                    <div class="mt-1">
                                                        {{ $spv }}
                                                    </div>
                                                </td>
                                                <td class="status-cell text-center">
                                                    {!! $caStatus === 'approved'
                                                        ? '<i class="mdi mdi-check-circle text-success"></i>'
                                                        : ($caStatus === 'rejected'
                                                            ? '<i class="mdi mdi-close-circle text-danger"></i>'
                                                            : '<i class="mdi mdi-clock-outline text-info"></i>') !!}
                                                    <br>
                                                    <div class="mt-1">
                                                        {{ $ca }}
                                                    </div>
                                                </td>
                                                <td class="status-cell">
                                                    {!! $hmStatus === 'approved'
                                                        ? '<i class="mdi mdi-check-circle text-success"></i>'
                                                        : ($hmStatus === 'rejected'
                                                            ? '<i class="mdi mdi-close-circle text-danger"></i>'
                                                            : '<i class="mdi mdi-clock-outline text-info"></i>') !!}
                                                </td>
                                                {{-- <td class="status-cell">
                                                    {!! $hmStatus === 'approved'
                                                        ? '<i class="mdi mdi-check-circle text-success"></i>'
                                                        : ($hmStatus === 'rejected'
                                                            ? '<i class="mdi mdi-close-circle text-danger"></i>'
                                                            : '<i class="mdi mdi-clock-outline text-info"></i>') !!}
                                                </td> --}}
                                                @php
                                                    $hmApproval = $pengajuan->approval->where('role', 'hm');
                                                    $caApproval = $pengajuan->approval->where('role', 'ca');

                                                    $hmApprovalStatus =
                                                        $hmApproval->where('is_banding', 0)->last()->status ?? null;
                                                    $caApprovalStatus =
                                                        $caApproval->where('is_banding', 0)->last()->status ?? null;

                                                    $hmBandingStatus =
                                                        $hmApproval->where('is_banding', 1)->last()->status ?? null;
                                                    $caBandingStatus =
                                                        $caApproval->where('is_banding', 1)->last()->status ?? null;

                                                    $hmCatatan = $hmApproval->last()->catatan ?? null;
                                                @endphp

                                                <td class="align-middle nowrap">
                                                    <button class="btn btn-gradient-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#detailKeteranganModal"
                                                        data-keterangan="{{ $hmCatatan }}"
                                                        data-status-pengajuan="{{ $pengajuan->status_pengajuan ?? 'Tidak ada status' }}"
                                                        data-status-ca="{{ $caApprovalStatus ?? '-' }}"
                                                        data-status-hm="{{ $hmApprovalStatus ?? '-' }}"
                                                        data-ca-banding-status="{{ $caBandingStatus ?? '-' }}"
                                                        data-hm-banding-status="{{ $hmBandingStatus ?? '-' }}">
                                                        Keterangan
                                                    </button>
                                                </td>

                                                <td class="align-middle nowrap">
                                                    <div class="button-group d-flex gap-2">
                                                        <a href="{{ route('admin.data.pengajuan.luar.detail', $pengajuan->id) }}"
                                                            class="btn btn-outline-success btn-sm">Detail <i
                                                                class="mdi mdi-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $index++; @endphp
                                        @endforeach
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailKeteranganModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Detail Keterangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalKeterangan">Memuat...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const detailKeteranganModal = document.getElementById('detailKeteranganModal');
            const modalKeterangan = document.getElementById('modalKeterangan');

            detailKeteranganModal.addEventListener('show.bs.modal', function(event) {
                // Ambil button yang memicu modal
                const button = event.relatedTarget;

                // Ambil data dari atribut data
                const keterangan = button.getAttribute('data-keterangan') || 'Tidak ada catatan';
                const statusPengajuan = button.getAttribute('data-status-pengajuan') || 'Tidak ada status';
                const statusCa = button.getAttribute('data-status-ca') || 'Tidak ada status';
                const statusHm = button.getAttribute('data-status-hm') || 'Tidak ada status';
                const statusCaBanding = button.getAttribute('data-ca-banding-status');
                const statusHmBanding = button.getAttribute('data-hm-banding-status');

                // Gabungkan teksnya
                modalKeterangan.innerHTML = `
            <strong>Keterangan:</strong> ${keterangan}<br>
            <strong>Status Pengajuan:</strong> ${statusPengajuan}<br> <br>
            <strong>Status CA - Appr:</strong> ${statusCa}<br>
            <strong>Status HM - Appr:</strong> ${statusHm}<br>
            <strong>Status CA - Banding:</strong> ${statusCaBanding}<br>
            <strong>Status HM - Banding:</strong> ${statusHmBanding}
        `;
            });
        });
    </script>


    {{-- </main> --}}
@endsection
