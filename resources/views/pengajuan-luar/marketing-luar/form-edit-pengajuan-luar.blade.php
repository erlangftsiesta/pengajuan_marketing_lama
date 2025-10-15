@extends('layouts.parent-layout')

@section('breadcrumb-title', '/ Detail Pengajuan')
@section('page-title', 'Pengajuan Nasabah Luar')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <style>
        .form-step {
            display: none;
        }

        .form-step-active {
            display: block;
        }
    </style>
    <main id="main" class="main">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <a href="{{ route('marketingLuar.pengajuan') }}" class="btn btn-success btn-sm">Back</a>
                        <h4 class="card-title text-center mt-2 mb-2">Form Edit Pengajuan Pinjaman</h4>
                        <div style="width: 80px;"></div>
                    </div>
                    <div class="card-body">
                        <form id="loanForm" action="{{ route('marketingLuar.form.update', $pengajuan->nasabahLuar->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Step 1: Informasi Nasabah -->
                            <div class="form-step form-step-active">
                                <h5 class="mb-3">Informasi Nasabah</h5>
                                <div class="form-group">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control"
                                        value="{{ old('nama_lengkap', $pengajuan->nasabahLuar->nama_lengkap) }}">
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="text" id="nik" name="nik" class="form-control"
                                            value="{{ old('nik', $pengajuan->nasabahLuar->nik) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="no_kk" class="form-label">No KK</label>
                                        <input type="text" id="no_kk" name="no_kk" class="form-control"
                                            value="{{ old('no_kk', $pengajuan->nasabahLuar->no_kk) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki"
                                            {{ old('jenis_kelamin', $pengajuan->nasabahLuar->jenis_kelamin == 'Laki-laki' ? 'selected' : '') }}>
                                            Laki-laki
                                        </option>
                                        <option value="Perempuan"
                                            {{ old('jenis_kelamin', $pengajuan->nasabahLuar->jenis_kelamin == 'Perempuan' ? 'selected' : '') }}>
                                            Perempuan
                                        </option>
                                    </select>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control"
                                            value="{{ old('tempat_lahir', $pengajuan->nasabahLuar->tempat_lahir) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control"
                                            value="{{ old('tanggal_lahir', $pengajuan->nasabahLuar->tanggal_lahir) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status_nikah" class="form-label">Status Pernikahan</label>
                                    <select name="status_nikah" id="status_nikah" class="form-select">
                                        <option value="">Pilih Status Pernikahan</option>
                                        <option
                                            value="Belum Menikah"{{ old('status_nikah', $pengajuan->nasabahLuar->status_nikah == 'Belum Menikah' ? 'selected' : '') }}>
                                            Belum Menikah</option>
                                        <option value="Menikah"
                                            {{ old('status_nikah', $pengajuan->nasabahLuar->status_nikah == 'Menikah' ? 'selected' : '') }}>
                                            Menikah</option>
                                        <option value="Janda/Duda"
                                            {{ old('status_nikah', $pengajuan->nasabahLuar->status_nikah == 'Janda/Duda' ? 'selected' : '') }}>
                                            Janda/Duda
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="no_hp" class="form-label">Nomor HP/WA</label>
                                        <input type="text" id="no_hp" name="no_hp" class="form-control"
                                            value="{{ old('no_hp', $pengajuan->nasabahLuar->no_hp) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            value="{{ old('email', $pengajuan->nasabahLuar->email) }}">
                                    </div>
                                </div>
                                @php
                                    $namaNasabah = str_replace(
                                        ' ',
                                        '-',
                                        strtolower($pengajuan->nasabahLuar->nama_lengkap),
                                    );
                                    $folderNasabah = $namaNasabah . '-' . $pengajuan->nasabahLuar->id;
                                @endphp
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="foto_ktp" class="form-label">Foto KTP</label>
                                        <a href="{{ asset('storage/dokumen_pendukung_luar/' . $folderNasabah . '/' . $pengajuan->nasabahLuar->foto_ktp) }}"
                                            target="_blank">
                                            <img src="{{ asset('storage/dokumen_pendukung_luar/' . $folderNasabah . '/' . $pengajuan->nasabahLuar->foto_ktp) }}?t={{ time() }}"
                                                alt="Foto KTP" class="img-thumbnail"
                                                style="max-width: 100%; height: auto;">
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="foto_kk" class="form-label">Foto Kartu Keluarga</label>
                                        <br>
                                        <a href="{{ asset('storage/dokumen_pendukung_luar/' . $folderNasabah . '/' . $pengajuan->nasabahLuar->foto_kk) }}"
                                            target="_blank">
                                            <img src="{{ asset('storage/dokumen_pendukung_luar/' . $folderNasabah . '/' . $pengajuan->nasabahLuar->foto_kk) }}?t={{ time() }}"
                                                alt="Foto KTP" class="img-thumbnail"
                                                style="max-width: 100%; height: auto;">
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="dokumen_pendukung" class="form-label">Dokumen Pendukung</label>
                                        <br>
                                        @if ($pengajuan->nasabahLuar && $pengajuan->nasabahLuar->dokumen_pendukung)
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalDokumenPendukung">
                                                Lihat PDF
                                            </button>

                                            <div class="modal fade" id="modalDokumenPendukung" tabindex="-1"
                                                aria-labelledby="modalDokumenPendukungLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalDokumenPendukungLabel">
                                                                Dokumen Pendukung</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <embed
                                                                src="{{ asset('storage/dokumen_pendukung_luar/' . $folderNasabah . '/' . $pengajuan->nasabahLuar->dokumen_pendukung ?? '') }}?t={{ time() }}"
                                                                type="application/pdf" width="100%" height="500px">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <span class="form-text">File :
                                                {{ $pengajuan->nasabahLuar->dokumen_pendukung ?? '' }}</span>
                                        @else
                                            <p class="text-danger">File PDF Dokumen Pendukung tidak tersedia.</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="foto_ktp" class="form-label">Foto KTP</label>
                                    <input type="file" id="foto_ktp" name="foto_ktp" class="file-upload-default"
                                        accept="image/*">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Foto KTP"
                                            value="{{ $pengajuan->nasabahLuar->foto_ktp }}">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-info py-3"
                                                type="button">Pilih File</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="foto_kk" class="form-label">Foto Kartu Keluarga</label>
                                    <input type="file" id="foto_kk" name="foto_kk" class="file-upload-default"
                                        accept="image/*">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Foto Kartu Keluarga"
                                            value="{{ $pengajuan->nasabahLuar->foto_kk }}">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-info py-3"
                                                type="button">Pilih File</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dokumen_pendukung" class="form-label">Dokumen Pendukung</label>
                                    <input type="file" id="dokumen_pendukung" name="dokumen_pendukung"
                                        class="file-upload-default" accept="application/pdf">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Dokumen Pendukung"
                                            value="{{ $pengajuan->nasabahLuar->dokumen_pendukung }}">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-info py-3"
                                                type="button">Pilih File</button>
                                        </span>
                                    </div>
                                </div>
                                @if ($pengajuan->nasabahLuar->validasi_nasabah == 0 || $pengajuan->status_pengajuan == 'revisi spv')
                                    <div class="form-group mt-0" id="catatan-nasabah">
                                        <label for="catatan_nasabah" class="form-label">Catatan</label>
                                        <textarea name="catatan_nasabah" id="catatan_nasabah" class="form-control" cols="30" rows="10" disabled>{{ old('catatan_nasabah', $pengajuan->nasabahLuar->catatan ?? $pengajuan->catatan_spv) }}</textarea>
                                    </div>
                                @endif
                                <div class="text-end">
                                    <button type="button" class="btn btn-primary next-btn">Next</button>
                                </div>
                            </div>

                            <!-- Step 2: Alamat Nasabah -->
                            <div class="form-step">
                                <h5>Alamat Nasabah</h5>
                                <div class="form-group">
                                    <label for="alamat_ktp" class="form-label">Alamat KTP</label>
                                    <input type="text" id="alamat_ktp" name="alamat_ktp" class="form-control"
                                        value="{{ old('alamat_ktp', $pengajuan->nasabahLuar->alamatLuar->alamat_ktp) }}">
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="kelurahan" class="form-label">Kelurahan</label>
                                        <input type="text" id="kelurahan" name="kelurahan" class="form-control"
                                            value="{{ old('kelurahan', $pengajuan->nasabahLuar->alamatLuar->kelurahan) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="rt_rw" class="form-label">RT/RW</label>
                                        <input type="text" id="rt_rw" name="rt_rw" class="form-control"
                                            value="{{ old('rt_rw', $pengajuan->nasabahLuar->alamatLuar->rt_rw) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <input type="text" id="kecamatan" name="kecamatan" class="form-control"
                                        value="{{ old('kecamatan', $pengajuan->nasabahLuar->alamatLuar->kecamatan) }}">
                                </div>
                                <div class="form-group">
                                    <label for="kota" class="form-label">Kabupaten/Kota</label>
                                    <input type="text" id="kota" name="kota" class="form-control"
                                        value="{{ old('kota', $pengajuan->nasabahLuar->alamatLuar->kota) }}">
                                </div>
                                <div class="form-group">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <input type="text" id="provinsi" name="provinsi" class="form-control"
                                        value="{{ old('provinsi', $pengajuan->nasabahLuar->alamatLuar->provinsi) }}">
                                </div>
                                <div class="form-group">
                                    <label for="status_rumah" class="form-label">Status Rumah</label>
                                    <select id="status_rumah" name="status_rumah" class="form-select">
                                        <option value="">Pilih</option>
                                        <option value="kontrak bulanan"
                                            {{ old('status_rumah', $pengajuan->nasabahLuar->alamatLuar->status_rumah) == 'kontrak bulanan' ? 'selected' : '' }}>
                                            Kontrak Bulanan
                                        </option>
                                        <option value="kontrak tahunan"
                                            {{ old('status_rumah', $pengajuan->nasabahLuar->alamatLuar->status_rumah) == 'kontrak tahunan' ? 'selected' : '' }}>
                                            Kontrak Tahunan
                                        </option>
                                        <option value="milik orang tua"
                                            {{ old('status_rumah', $pengajuan->nasabahLuar->alamatLuar->status_rumah) == 'milik orang tua' ? 'selected' : '' }}>
                                            Milik Orang Tua
                                        </option>
                                        <option value="pribadi"
                                            {{ old('status_rumah', $pengajuan->nasabahLuar->alamatLuar->status_rumah) == 'pribadi' ? 'selected' : '' }}>
                                            Milik Pribadi
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group" id="kontrak-bulanan-group" style="display: none;">
                                    <label for="biaya_perbulan" class="form-label">Biaya Perbulan</label>
                                    <input type="number" id="biaya_perbulan" name="biaya_perbulan" class="form-control"
                                        value="{{ old('biaya_perbulan', $pengajuan->nasabahLuar->alamatLuar->biaya_perbulan) }}">
                                </div>

                                <div class="form-group" id="kontrak-tahunan-group" style="display: none;">
                                    <label for="biaya_pertahun" class="form-label">Biaya Pertahun</label>
                                    <input type="number" id="biaya_pertahun" name="biaya_pertahun" class="form-control"
                                        value="{{ old('biaya_pertahun', $pengajuan->nasabahLuar->alamatLuar->biaya_pertahun) }}">
                                </div>

                                <div class="form-group">
                                    <label for="domisili" class="form-label">Alamat Domisili</label>
                                    <select id="domisili" name="domisili" class="form-select">
                                        <option value="">Pilih</option>
                                        <option value="sesuai ktp"
                                            {{ old('domisili', $pengajuan->nasabahLuar->alamatLuar->domisili) == 'sesuai ktp' ? 'selected' : '' }}>
                                            Sesuai KTP
                                        </option>
                                        <option value="tidak sesuai ktp"
                                            {{ old('domisili', $pengajuan->nasabahLuar->alamatLuar->domisili) == 'tidak sesuai ktp' ? 'selected' : '' }}>
                                            Tidak Sesuai KTP
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group" id="alamat-lengkap-group" style="display: none;">
                                    <div class="form-group">
                                        <label for="alamat_domisili" class="form-label">Alamat Lengkap</label>
                                        <textarea name="alamat_domisili" id="alamat_domisili" cols="30" rows="10" class="form-control">{{ old('alamat_domisili', $pengajuan->nasabahLuar->alamatLuar->alamat_domisili) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="rumah_domisili" class="form-label">Status Rumah Domisili</label>
                                        <select id="rumah_domisili" name="rumah_domisili" class="form-select">
                                            <option value="">Pilih</option>
                                            <option value="kontrak bulanan"
                                                {{ old('rumah_domisili', $pengajuan->nasabahLuar->alamatLuar->rumah_domisili) == 'kontrak bulanan' ? 'selected' : '' }}>
                                                Kontrak Bulanan
                                            </option>
                                            <option value="kontrak tahunan"
                                                {{ old('rumah_domisili', $pengajuan->nasabahLuar->alamatLuar->rumah_domisili) == 'kontrak tahunan' ? 'selected' : '' }}>
                                                Kontrak Tahunan
                                            </option>
                                            <option value="milik orang tua"
                                                {{ old('rumah_domisili', $pengajuan->nasabahLuar->alamatLuar->rumah_domisili) == 'milik orang tua' ? 'selected' : '' }}>
                                                Milik Orang Tua
                                            </option>
                                            <option value="pribadi"
                                                {{ old('rumah_domisili', $pengajuan->nasabahLuar->alamatLuar->rumah_domisili) == 'pribadi' ? 'selected' : '' }}>
                                                Milik Pribadi
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="domisili-bulanan-group" style="display: none;">
                                        <label for="biaya_perbulan_domisili" class="form-label">Biaya Perbulan</label>
                                        <input type="number" id="biaya_perbulan_domisili" name="biaya_perbulan_domisili"
                                            class="form-control"
                                            value="{{ old('biaya_perbulan_domisili', $pengajuan->nasabahLuar->alamatLuar->biaya_perbulan_domisili) }}">
                                    </div>
                                    <div class="form-group" id="domisili-tahunan-group" style="display: none;">
                                        <label for="biaya_pertahun_domisili" class="form-label">Biaya Pertahun</label>
                                        <input type="number" id="biaya_pertahun_domisili" name="biaya_pertahun_domisili"
                                            class="form-control"
                                            value="{{ old('biaya_pertahun_domisili', $pengajuan->nasabahLuar->alamatLuar->biaya_pertahun_domisili) }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="lama_tinggal" class="form-label">Lama Tinggal</label>
                                    <input type="text" id="lama_tinggal" name="lama_tinggal" class="form-control"
                                        value="{{ old('lama_tinggal', $pengajuan->nasabahLuar->alamatLuar->lama_tinggal) }}">
                                </div>

                                <div class="form-group">
                                    <label for="share_loc_link" class="form-label">Share Loc Alamat Nasabah</label>
                                    <input type="text" id="share_loc_link" name="share_loc_link" class="form-control"
                                        value="{{ old('share_loc_link', $pengajuan->nasabahLuar->alamatLuar->share_loc_link) }}">
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="atas_nama_listrik" class="form-label">Rekening Listrik Atas
                                            Nama</label>
                                        <input type="text" class="form-control" name="atas_nama_listrik"
                                            id="atas_nama_listrik"
                                            value="{{ old('atas_nama_listrik', $pengajuan->nasabahLuar->alamatLuar->atas_nama_listrik) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="hubungan_rek_listrik">Hubungan dengan Pemilik Rekening Listrik</label>
                                        <input type="text" class="form-control" name="hubungan_rek_listrik"
                                            id="hubungan_rek_listrik"
                                            value="{{ old('hubungan_rek_listrik', $pengajuan->nasabahLuar->alamatLuar->hubungan) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="foto_meteran_listrik">Foto Meteran Listrik Rumah</label>
                                    <br>
                                    @if ($pengajuan->nasabahLuar->alamatLuar->foto_meteran_listrik)
                                        <a href="{{ asset('storage/dokumen_pendukung_luar/' . $folderNasabah . '/' . $pengajuan->nasabahLuar->alamatLuar->foto_meteran_listrik) }}"
                                            target="_blank">
                                            <img src="{{ asset('storage/dokumen_pendukung_luar/' . $folderNasabah . '/' . $pengajuan->nasabahLuar->alamatLuar->foto_meteran_listrik) }}"
                                                alt="Foto Meteran Listrik" class="img-thumbnail"
                                                style="max-width: 100%; height: auto;">
                                        </a>
                                    @else
                                        <p class="text-danger">Foto Meteran Listrik tidak tersedia.</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="foto_meteran_listrik" class="form-label">Foto Meteran Listrik
                                        Rumah</label>
                                    <input type="file" id="foto_meteran_listrik" name="foto_meteran_listrik"
                                        class="file-upload-default" accept="image/*">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Foto KTP"
                                            value="{{ $pengajuan->nasabahLuar->alamatLuar->foto_meteran_listrik }}">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-info py-3"
                                                type="button">Pilih File</button>
                                        </span>
                                    </div>
                                </div>
                                @if ($pengajuan->nasabahLuar->alamatLuar->validasi_alamat == 0)
                                    <div class="form-group mt-0" id="catatan-alamat">
                                        <label for="catatan_alamat" class="form-label">Catatan</label>
                                        <textarea name="catatan_alamat" id="catatan_alamat" class="form-control" cols="30" rows="10" disabled>{{ $pengajuan->nasabahLuar->alamatLuar->catatan }}</textarea>
                                    </div>
                                @endif
                                <div class="text-end">
                                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                                    <button type="submit" class="btn btn-primary next-btn">Next</button>
                                </div>
                            </div>

                            <!-- Step 3: Informasi Pekerjaan -->
                            <div class="form-step">
                                <h5>Informasi Pekerjaan</h5>
                                <div class="form-group">
                                    <label for="perusahaan" class="form-label">Perusahaan</label>
                                    <input type="text" class="form-control" name="perusahaan" id="perusahaan"
                                        value="{{ $pengajuan->nasabahLuar->pekerjaanLuar->perusahaan }}">
                                </div>
                                <div class="form-group">
                                    <label for="alamat_perusahaan" class="form-label">Alamat Perusahaan</label>
                                    <textarea name="alamat_perusahaan" id="alamat_perusahaan" cols="30" rows="10" class="form-control">{{ $pengajuan->nasabahLuar->pekerjaanLuar->alamat_perusahaan }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="kontak_perusahaan" class="form-label">No Telp Perusahaan</label>
                                    <input type="text" class="form-control" name="kontak_perusahaan"
                                        id="kontak_perusahaan"
                                        value="{{ $pengajuan->nasabahLuar->pekerjaanLuar->kontak_perusahaan }}">
                                </div>
                                <div class="form-group">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan" id="jabatan"
                                        value="{{ $pengajuan->nasabahLuar->pekerjaanLuar->jabatan }}">
                                </div>
                                <div class="form-group">
                                    <label for="lama_kerja" class="form-label">Lama Bekerja</label>
                                    <input type="text" class="form-control" name="lama_kerja" id="lama_kerja"
                                        value="{{ $pengajuan->nasabahLuar->pekerjaanLuar->lama_kerja }}">
                                </div>
                                <div class="form-group">
                                    <label for="status_karyawan" class="form-label">Status Karyawan</label>
                                    <select id="status_karyawan" name="status_karyawan" class="form-select">
                                        <option value="">Pilih</option>
                                        <option value="tetap"
                                            {{ $pengajuan->nasabahLuar->pekerjaanLuar->status_karyawan == 'tetap' ? 'selected' : '' }}>
                                            Tetap
                                        </option>
                                        <option value="kontrak"
                                            {{ $pengajuan->nasabahLuar->pekerjaanLuar->status_karyawan == 'kontrak' ? 'selected' : '' }}>
                                            Kontrak</option>
                                    </select>
                                </div>
                                <div class="form-group" id="div-kontrak" style="display: none;">
                                    <label for="lama_kontrak" class="form-label">Lama Kontrak</label>
                                    <input type="text" name="lama_kontrak" id="lama_kontrak" class="form-control"
                                        value="{{ $pengajuan->nasabahLuar->pekerjaanLuar->lama_kontrak }}">
                                </div>
                                <div class="form-group">
                                    <label for="pendapatan_perbulan" class="form-label">Pendapatan Perbulan</label>
                                    <input type="number" name="pendapatan_perbulan" id="pendapatan_perbulan"
                                        class="form-control"
                                        value="{{ $pengajuan->nasabahLuar->pekerjaanLuar->pendapatan_perbulan }}">
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="foto_id_card" class="form-label">Foto ID Card/SKU</label>
                                        <br>
                                        @if ($pengajuan->nasabahLuar->pekerjaanLuar && $pengajuan->nasabahLuar->pekerjaanLuar->id_card)
                                            <a href="{{ asset('storage/dokumen_pendukung_luar/' . $folderNasabah . '/' . $pengajuan->nasabahLuar->pekerjaanLuar->id_card) }}?v={{ time() }}"
                                                target="_blank">
                                                <img src="{{ asset('storage/dokumen_pendukung_luar/' . $folderNasabah . '/' . $pengajuan->nasabahLuar->pekerjaanLuar->id_card) }}?v={{ time() }}"alt="Foto KTP"
                                                    class="img-thumbnail" style="max-width: 100%; height: auto;">
                                            </a>
                                        @else
                                            <p class="text-danger">Foto ID Card/SKU tidak tersedia.</p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="norek" class="form-label">Foto No Rekening</label>
                                        <br>
                                        @if ($pengajuan->nasabahLuar->pekerjaanLuar && $pengajuan->nasabahLuar->pekerjaanLuar->norek)
                                            <a href="{{ asset('storage/dokumen_pendukung_luar/' . $folderNasabah . '/' . $pengajuan->nasabahLuar->pekerjaanLuar->norek) }}?v={{ time() }}"
                                                target="_blank">
                                                <img src="{{ asset('storage/dokumen_pendukung_luar/' . $folderNasabah . '/' . $pengajuan->nasabahLuar->pekerjaanLuar->norek) }}?v={{ time() }}"
                                                    alt="Foto No Rekening" class="img-thumbnail"
                                                    style="max-width: 100%; height: auto;">
                                            </a>
                                        @else
                                            <p class="text-danger">No Rekening tidak tersedia.</p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="foto_slip_gaji" class="form-label">Foto Slip Gaji/Mutasi</label>
                                        <br>
                                        @if ($pengajuan->nasabahLuar->pekerjaanLuar && $pengajuan->nasabahLuar->pekerjaanLuar->slip_gaji)
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalSlipGaji">
                                                Lihat PDF
                                            </button>

                                            <div class="modal fade" id="modalSlipGaji" tabindex="-1"
                                                aria-labelledby="modalSlipGajiLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalSlipGajiLabel">Surat
                                                                Pernyataan Penjamin</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <embed
                                                                src="{{ asset('storage/dokumen_pendukung_luar/' . $folderNasabah . '/' . $pengajuan->nasabahLuar->pekerjaanLuar->slip_gaji) }}?v={{ time() }}"
                                                                type="application/pdf" width="100%" height="500px">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <span class="form-text">File :
                                                {{ $pengajuan->nasabahLuar->pekerjaanLuar->slip_gaji ?? '' }}</span>
                                        @else
                                            <p class="text-danger">File PDF Slip Gaji/Mutasi tidak tersedia.</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="foto_id_card" class="form-label">Foto ID Card/SKU</label>
                                    <input type="file" id="foto_id_card" name="foto_id_card"
                                        class="file-upload-default" accept="image/*">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Foto KTP"
                                            value="{{ $pengajuan->nasabahLuar->pekerjaanLuar->id_card }}">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-info py-3"
                                                type="button">Pilih File</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="norek" class="form-label">Foto No Rekening</label>
                                    <input type="file" id="norek" name="norek" class="file-upload-default"
                                        accept="image/*">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Foto KTP"
                                            value="{{ $pengajuan->nasabahLuar->pekerjaanLuar->norek }}">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-info py-3"
                                                type="button">Pilih File</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="foto_slip_gaji" class="form-label">Foto Slip Gaji/Mutasi</label>
                                    <input type="file" id="foto_slip_gaji" name="foto_slip_gaji"
                                        class="file-upload-default" accept="application/pdf">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Foto KTP"
                                            value="{{ $pengajuan->nasabahLuar->pekerjaanLuar->slip_gaji }}">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-info py-3"
                                                type="button">Pilih File</button>
                                        </span>
                                    </div>
                                </div>
                                @if ($pengajuan->nasabahLuar->pekerjaanLuar->validasi_pekerjaan == 0)
                                    <div class="form-group mt-0" id="catatan-pekerjaan">
                                        <label for="catatan_pekerjaan" class="form-label">Catatan</label>
                                        <textarea name="catatan_pekerjaan" id="catatan_pekerjaan" class="form-control" cols="30" rows="10"
                                            disabled>{{ $pengajuan->nasabahLuar->pekerjaanLuar->catatan }}</textarea>
                                    </div>
                                @endif
                                <div class="text-end">
                                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                                    <button type="submit" class="btn btn-primary next-btn">Next</button>
                                </div>
                            </div>

                            <!-- Step 4: Penjamin Nasabah -->
                            <div class="form-step">
                                <h5>Penjamin Nasabah</h5>

                                <!-- Hubungan Penjamin -->
                                <div class="form-group">
                                    <label for="hubungan_penjamin" class="form-label">Hubungan Keluarga</label>
                                    <select id="hubungan_penjamin" name="hubungan_penjamin" class="form-select">
                                        <option value="">Pilih</option>
                                        @php
                                            $hubunganOptions = [
                                                'orang tua',
                                                'suami',
                                                'istri',
                                                'anak',
                                                'keluarga kandung',
                                                'lainnya',
                                            ];
                                            $currentHubungan = strtolower(
                                                old(
                                                    'hubungan_penjamin',
                                                    $pengajuan->nasabahLuar->penjaminLuar->hubungan_penjamin,
                                                ),
                                            );
                                        @endphp
                                        @foreach ($hubunganOptions as $option)
                                            <option value="{{ $option }}"
                                                {{ $currentHubungan == $option ? 'selected' : '' }}>
                                                {{ ucfirst($option) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Nama Penjamin -->
                                <div class="form-group">
                                    <label for="nama_penjamin" class="form-label">Nama Penjamin</label>
                                    <input type="text" id="nama_penjamin" name="nama_penjamin" class="form-control"
                                        value="{{ old('nama_penjamin', $pengajuan->nasabahLuar->penjaminLuar->nama_penjamin) }}">
                                </div>

                                <!-- Pekerjaan Penjamin -->
                                <div class="form-group">
                                    <label for="pekerjaan_penjamin" class="form-label">Pekerjaan Penjamin</label>
                                    <input type="text" id="pekerjaan_penjamin" name="pekerjaan_penjamin"
                                        class="form-control"
                                        value="{{ old('pekerjaan_penjamin', $pengajuan->nasabahLuar->penjaminLuar->pekerjaan_penjamin) }}">
                                </div>

                                <!-- Penghasilan Penjamin -->
                                <div class="form-group">
                                    <label for="penghasilan_penjamin" class="form-label">Penghasilan</label>
                                    <input type="number" id="penghasilan_penjamin" name="penghasilan_penjamin"
                                        class="form-control"
                                        value="{{ old('penghasilan_penjamin', $pengajuan->nasabahLuar->penjaminLuar->penghasilan_penjamin) }}">
                                </div>

                                <!-- No HP Penjamin -->
                                <div class="form-group">
                                    <label for="no_hp_penjamin" class="form-label">No HP/WA</label>
                                    <input type="text" id="no_hp_penjamin" name="no_hp_penjamin" class="form-control"
                                        value="{{ old('no_hp_penjamin', $pengajuan->nasabahLuar->penjaminLuar->no_hp_penjamin) }}">
                                </div>

                                <!-- Foto KTP Penjamin Preview -->
                                <div class="form-group">
                                    <label for="foto_ktp_penjamin" class="form-label">KTP Penjamin</label>
                                    <br>
                                    @if ($pengajuan->nasabahLuar->penjaminLuar && $pengajuan->nasabahLuar->penjaminLuar->foto_ktp_penjamin)
                                        <a href="{{ asset('storage/dokumen_pendukung_luar/' . $folderNasabah . '/' . $pengajuan->nasabahLuar->penjaminLuar->foto_ktp_penjamin) }}?v={{ time() }}"
                                            target="_blank">
                                            <img src="{{ asset('storage/dokumen_pendukung_luar/' . $folderNasabah . '/' . $pengajuan->nasabahLuar->penjaminLuar->foto_ktp_penjamin) }}?v={{ time() }}"
                                                alt="Foto KTP" class="img-thumbnail"
                                                style="max-width: 100%; height: auto;">
                                        </a>
                                    @else
                                        <p class="text-danger">Foto KTP Penjamin tidak tersedia.</p>
                                    @endif
                                </div>

                                <!-- Upload File Baru -->
                                <div class="form-group">
                                    <label for="foto_ktp_penjamin" class="form-label">Upload Ulang Foto KTP Penjamin (Jika
                                        ingin ganti)</label>
                                    <input type="file" id="foto_ktp_penjamin" name="foto_ktp_penjamin"
                                        class="file-upload-default" accept="image/*">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Foto KTP"
                                            value="{{ $pengajuan->nasabahLuar->penjaminLuar->foto_ktp_penjamin }}">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-info py-3"
                                                type="button">Pilih File</button>
                                        </span>
                                    </div>
                                </div>

                                <!-- Catatan Validasi -->
                                @if ($pengajuan->nasabahLuar->penjaminLuar->validasi_penjamin == 0)
                                    <div class="form-group mt-0" id="catatan-penjamin">
                                        <label for="catatan_penjamin" class="form-label">Catatan</label>
                                        <textarea name="catatan_penjamin" id="catatan_penjamin" class="form-control" cols="30" rows="10"
                                            disabled>{{ $pengajuan->nasabahLuar->penjaminLuar->catatan }}</textarea>
                                    </div>
                                @endif

                                <!-- Navigation Buttons -->
                                <div class="text-end">
                                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                                    <button type="submit" class="btn btn-primary next-btn">Next</button>
                                </div>
                            </div>

                            <!-- Step 5: Data Tanggungan dan Cicilan Lain -->
                            <div class="form-step">
                                <h5>Data Tanggungan dan Cicilan Lain</h5>

                                <!-- Kondisi Tanggungan Nasabah -->
                                <div class="form-group">
                                    <label for="kondisi_tanggungan" class="form-label">Kondisi Tanggungan Nasabah</label>
                                    <textarea name="kondisi_tanggungan" id="kondisi_tanggungan" cols="30" rows="10" class="form-control">{{ old('kondisi_tanggungan', $pengajuan->nasabahLuar->tanggunganLuar->kondisi_tanggungan) }}</textarea>
                                </div>

                                <!-- Dropdown Cicilan Lain -->
                                <div class="form-group">
                                    <label for="cicilan_lain" class="form-label">Cicilan Lain</label>
                                    @php
                                        $selectedCicilanLain = old(
                                            'cicilan_lain',
                                            optional($pengajuan->nasabahLuar->pinjamanLainLuar->first())->cicilan_lain,
                                        );
                                    @endphp
                                    <select name="cicilan_lain" id="cicilan_lain" class="form-select">
                                        <option value="">Pilih</option>
                                        <option value="Ada" {{ $selectedCicilanLain == 'Ada' ? 'selected' : '' }}>Ada
                                        </option>
                                        <option value="Tidak" {{ $selectedCicilanLain == 'Tidak' ? 'selected' : '' }}>
                                            Tidak</option>
                                    </select>
                                </div>

                                <!-- Container Form Cicilan -->
                                <div id="cicilan-container" style="display: none;">
                                    <div id="dynamic-form-container">
                                        @php
                                            $oldNamaPembiayaan = old('nama_pembiayaan', []);
                                            $oldTotalPinjaman = old('total_pinjaman', []);
                                            $oldCicilanPerbulan = old('cicilan_perbulan', []);
                                            $oldSisaTenor = old('sisa_tenor_cicilan', []);
                                            $existingCicilan = $pengajuan->nasabahLuar->pinjamanLainLuar;
                                            $formCount = max(count($oldNamaPembiayaan), $existingCicilan->count());
                                        @endphp

                                        @for ($i = 0; $i < $formCount; $i++)
                                            @php
                                                $cicilanData = $existingCicilan[$i] ?? null;
                                            @endphp
                                            <div class="dynamic-form mb-3" id="form-{{ $i }}">
                                                <h6>Form Cicilan Lain {{ $i + 1 }}</h6>
                                                <div class="form-group">
                                                    <label for="nama_pembiayaan_{{ $i }}"
                                                        class="form-label">Nama Pembiayaan</label>
                                                    <input type="text" id="nama_pembiayaan_{{ $i }}"
                                                        name="nama_pembiayaan[]" class="form-control"
                                                        value="{{ $oldNamaPembiayaan[$i] ?? ($cicilanData->nama_pembiayaan ?? '') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="total_pinjaman_{{ $i }}"
                                                        class="form-label">Total Pinjaman</label>
                                                    <input type="number" id="total_pinjaman_{{ $i }}"
                                                        name="total_pinjaman[]" class="form-control"
                                                        value="{{ $oldTotalPinjaman[$i] ?? ($cicilanData->total_pinjaman ?? '') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="cicilan_perbulan_{{ $i }}"
                                                        class="form-label">Cicilan Perbulan</label>
                                                    <input type="number" id="cicilan_perbulan_{{ $i }}"
                                                        name="cicilan_perbulan[]" class="form-control"
                                                        value="{{ $oldCicilanPerbulan[$i] ?? ($cicilanData->cicilan_perbulan ?? '') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="sisa_tenor_cicilan_{{ $i }}"
                                                        class="form-label">Sisa Tenor</label>
                                                    <input type="number" id="sisa_tenor_cicilan_{{ $i }}"
                                                        name="sisa_tenor_cicilan[]" class="form-control"
                                                        value="{{ $oldSisaTenor[$i] ?? ($cicilanData->sisa_tenor ?? '') }}">
                                                </div>
                                                <hr>
                                            </div>
                                        @endfor
                                    </div>
                                </div>

                                <!-- Catatan Validasi -->
                                @if ($pengajuan->nasabahLuar->tanggunganLuar->validasi_tanggungan == 0)
                                    <div class="form-group mt-0" id="catatan-tanggungan">
                                        <label for="catatan_tanggungan" class="form-label">Catatan</label>
                                        <textarea name="catatan_tanggungan" id="catatan_tanggungan" class="form-control" cols="30" rows="10"
                                            disabled>{{ $pengajuan->nasabahLuar->tanggunganLuar->catatan }}</textarea>
                                    </div>
                                @endif

                                <!-- Navigasi -->
                                <div class="text-end">
                                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                                    <button type="submit" class="btn btn-primary next-btn">Next</button>
                                </div>
                            </div>

                            <!-- Step 6: Informasi Kontak Darurat -->
                            <div class="form-step">
                                <h5>Informasi Kontak Darurat</h5>

                                <div class="form-group">
                                    <label for="nama_kontak_darurat" class="form-label">Nama Saudara Tidak Serumah</label>
                                    <input type="text" name="nama_kontak_darurat" id="nama_kontak_darurat"
                                        class="form-control"
                                        value="{{ old('nama_kontak_darurat', $pengajuan->nasabahLuar->kontakDarurat->nama_kontak_darurat) }}">
                                </div>

                                <div class="form-group">
                                    <label for="hubungan_kontak_darurat" class="form-label">Hubungan</label>
                                    <input type="text" name="hubungan_kontak_darurat" id="hubungan_kontak_darurat"
                                        class="form-control"
                                        value="{{ old('hubungan_kontak_darurat', $pengajuan->nasabahLuar->kontakDarurat->hubungan_kontak_darurat) }}">
                                </div>

                                <div class="form-group">
                                    <label for="no_hp_kontak_darurat" class="form-label">No HP/WA</label>
                                    <input type="text" name="no_hp_kontak_darurat" id="no_hp_kontak_darurat"
                                        class="form-control"
                                        value="{{ old('no_hp_kontak_darurat', $pengajuan->nasabahLuar->kontakDarurat->no_hp_kontak_darurat) }}">
                                </div>

                                @if ($pengajuan->nasabahLuar->kontakDarurat->validasi_kontak_darurat == 0)
                                    <div class="form-group mt-0" id="catatan-kontak_darurat">
                                        <label for="catatan_kontak_darurat" class="form-label">Catatan</label>
                                        <textarea name="catatan_kontak_darurat" id="catatan_kontak_darurat" class="form-control" cols="30"
                                            rows="10" disabled>{{ $pengajuan->nasabahLuar->kontakDarurat->catatan }}</textarea>
                                    </div>
                                @endif

                                <div class="text-end">
                                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                                    <button type="submit" class="btn btn-primary next-btn">Next</button>
                                </div>
                            </div>

                            <!-- Step 7: Pengajuan Pinjaman -->
                            <div class="form-step">
                                <h5>Informasi Pengajuan Pinjaman</h5>

                                <div class="form-group">
                                    <label for="status_pinjaman">Status Pinjaman</label>
                                    <select name="status_pinjaman" id="status_pinjaman" class="form-select">
                                        <option value="">Pilih</option>
                                        <option value="baru"
                                            {{ old('status_pinjaman', $pengajuan->status_pinjaman) == 'baru' ? 'selected' : '' }}>
                                            Baru</option>
                                        <option value="lama"
                                            {{ old('status_pinjaman', $pengajuan->status_pinjaman) == 'lama' ? 'selected' : '' }}>
                                            Lama</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nominal_pinjaman" class="form-label">Nominal Pinjaman</label>
                                    <input type="number" id="nominal_pinjaman" name="nominal_pinjaman"
                                        class="form-control"
                                        value="{{ old('nominal_pinjaman', $pengajuan->nominal_pinjaman) }}">
                                </div>

                                <div class="form-group">
                                    <label for="tenor" class="form-label">Jangka Waktu</label>
                                    <input type="number" name="tenor" id="tenor" class="form-control"
                                        value="{{ old('tenor', $pengajuan->tenor) }}">
                                </div>

                                <div id="riwayat-pinjaman-group" style="display: none;">
                                    <h5>Riwayat Pinjaman</h5>
                                    <div class="form-group">
                                        <label for="pinjaman_ke">Pinjaman Ke</label>
                                        <input type="number" name="pinjaman_ke" id="pinjaman_ke" class="form-control"
                                            value="{{ old('pinjaman_ke', $pengajuan->pinjaman_ke) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="pinjaman_terakhir">Nominal Pinjaman Terakhir</label>
                                        <input type="number" name="pinjaman_terakhir" id="pinjaman_terakhir"
                                            class="form-control"
                                            value="{{ old('pinjaman_terakhir', $pengajuan->pinjaman_terakhir) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="sisa_pinjaman">Sisa Pinjaman</label>
                                        <input type="number" name="sisa_pinjaman" id="sisa_pinjaman"
                                            class="form-control"
                                            value="{{ old('sisa_pinjaman', $pengajuan->sisa_pinjaman) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="realisasi_pinjaman">Realisasi Pinjaman</label>
                                        <input type="text" name="realisasi_pinjaman" id="realisasi_pinjaman"
                                            class="form-control"
                                            value="{{ old('realisasi_pinjaman', $pengajuan->realisasi_pinjaman) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="cicilan_perbulan_pinjaman">Cicilan Perbulan Pinjaman</label>
                                        <input type="number" name="cicilan_perbulan_pinjaman"
                                            id="cicilan_perbulan_pinjaman" class="form-control"
                                            value="{{ old('cicilan_perbulan_pinjaman', $pengajuan->cicilan_perbulan) }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="jenis_pembiayaan">Jenis Pembiayaan</label>
                                    <select name="jenis_pembiayaan" id="jenis_pembiayaan" class="form-select">
                                        <option value="">Pilih</option>
                                        @foreach (['BPJS', 'SHM', 'BPKB', 'UMKM', 'SF', 'Kecamatan', 'Kedinasan'] as $jenis)
                                            <option value="{{ $jenis }}"
                                                {{ old('jenis_pembiayaan', $pengajuan->jenis_pembiayaan) == $jenis ? 'selected' : '' }}>
                                                {{ $jenis }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="berkas_jaminan" class="form-label">Berkas Jaminan</label>
                                    <br>
                                    @if ($pengajuan && $pengajuan->berkas_jaminan)
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modalBerkasJaminan">
                                            Lihat PDF
                                        </button>

                                        <div class="modal fade" id="modalBerkasJaminan" tabindex="-1"
                                            aria-labelledby="modalBerkasJaminanLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalBerkasJaminanLabel">File BPJS
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <embed
                                                            src="{{ asset('storage/dokumen_pendukung_luar/' . $folderNasabah . '/' . $pengajuan->berkas_jaminan) }}"
                                                            type="application/pdf" width="100%" height="500px">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <span class="form-text">File : {{ $pengajuan->berkas_jaminan ?? '' }}</span>
                                    @else
                                        <p class="text-danger">Berkas Jaminan tidak tersedia.</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="berkas_jaminan" class="form-label">Upload Berkas Jaminan</label>
                                    <input type="file" id="berkas_jaminan" name="berkas_jaminan"
                                        class="file-upload-default" accept="application/pdf">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Berkas Jaminan"
                                            value="{{ $pengajuan->berkas_jaminan }}">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-info py-3"
                                                type="button">Pilih File</button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="catatan_marketing" class="form-label">Catatan Marketing</label>
                                    <textarea name="catatan_marketing" id="catatan_marketing" cols="30" rows="10" class="form-control">{{ old('catatan_marketing', $pengajuan->catatan_marketing) }}</textarea>
                                </div>

                                @if ($pengajuan->validasi_pengajuan == 0)
                                    <div class="form-group mt-0" id="catatan-pengajuan">
                                        <label for="catatan_pengajuan" class="form-label">Catatan</label>
                                        <textarea name="catatan_pengajuan" id="catatan_pengajuan" class="form-control" cols="30" rows="10"
                                            disabled>{{ $pengajuan->catatan }}</textarea>
                                    </div>
                                @endif

                                <div class="text-end">
                                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // document.querySelectorAll('.file-upload-browse').forEach(button => {
        //     button.addEventListener('click', function() {
        //         const fileInput = this.closest('.form-group').querySelector('.file-upload-default');
        //         fileInput.click();
        //     });
        // });

        // document.querySelectorAll('.file-upload-default').forEach(input => {
        //     input.addEventListener('change', function() {
        //         const fileName = this.value.split('\\').pop(); // Ambil nama file
        //         const textInput = this.closest('.form-group').querySelector('.file-upload-info');
        //         if (textInput) textInput.value = fileName;
        //     });
        // });

        $(document).ready(function() {

            // Event ketika dropdown berubah
            $('#jenis_pembiayaan').on('change', function() {
                const selectedValue = $(this).val();

                // Sembunyikan semua grup form
                $('#bpjs-group').hide();
                $('#shm-group').hide();
                $('#bpkb-group').hide();
                $('#kedinasan-group').hide();

                // Tampilkan form sesuai dengan pilihan
                if (selectedValue === 'BPJS') {
                    $('#bpjs-group').show();
                } else if (selectedValue === 'SHM') {
                    $('#shm-group').show();
                } else if (selectedValue === 'BPKB') {
                    $('#bpkb-group').show();
                } else if (selectedValue === 'Kedinasan') {
                    $('#kedinasan-group').show();
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen untuk Status Rumah
            const statusRumahSelect = document.getElementById('status_rumah');
            const kontrakBulananGroup = document.getElementById('kontrak-bulanan-group');
            const kontrakTahunanGroup = document.getElementById('kontrak-tahunan-group');

            // Ambil elemen untuk Alamat Domisili
            const domisiliSelect = document.getElementById('domisili');
            const alamatLengkapGroup = document.getElementById('alamat-lengkap-group');
            const rumahDomisiliSelect = document.getElementById('rumah_domisili');
            const domisiliBulananGroup = document.getElementById('domisili-bulanan-group');
            const domisiliTahunanGroup = document.getElementById('domisili-tahunan-group');

            const statusKaryawanSelect = document.getElementById('status_karyawan');
            const divKontrak = document.getElementById('div-kontrak');

            // cicilan lain
            const cicilanLain = document.getElementById('cicilan_lain');
            const cicilanContainer = document.getElementById('cicilan-container');
            const dynamicFormContainer = document.getElementById('dynamic-form-container');
            const addFormButton = document.getElementById('add-form-button');

            const statusPinjamanSelect = document.getElementById('status_pinjaman');
            const riwayatPinjamanGroup = document.getElementById('riwayat-pinjaman-group');

            function toggleRiwayatPinjaman() {
                if (statusPinjamanSelect.value === 'lama') {
                    riwayatPinjamanGroup.style.display = 'block';
                } else {
                    riwayatPinjamanGroup.style.display = 'none';
                }
            }

            // Fungsi untuk toggle grup berdasarkan Status Rumah
            function toggleStatusRumah() {
                // Sembunyikan semua grup
                kontrakBulananGroup.style.display = 'none';
                kontrakTahunanGroup.style.display = 'none';

                // Tampilkan grup sesuai pilihan
                if (statusRumahSelect.value === 'kontrak bulanan') {
                    kontrakBulananGroup.style.display = 'block';
                } else if (statusRumahSelect.value === 'kontrak tahunan') {
                    kontrakTahunanGroup.style.display = 'block';
                }
            }

            // Fungsi untuk toggle grup berdasarkan Alamat Domisili
            function toggleAlamatDomisili() {
                // Tampilkan atau sembunyikan grup Alamat Lengkap
                if (domisiliSelect.value === 'tidak sesuai ktp') {
                    alamatLengkapGroup.style.display = 'block';
                } else {
                    alamatLengkapGroup.style.display = 'none';
                }
            }

            // Fungsi untuk toggle grup berdasarkan Rumah Domisili
            function toggleRumahDomisili() {
                // Sembunyikan semua grup domisili
                domisiliBulananGroup.style.display = 'none';
                domisiliTahunanGroup.style.display = 'none';

                // Tampilkan grup sesuai pilihan
                if (rumahDomisiliSelect.value === 'kontrak bulanan') {
                    domisiliBulananGroup.style.display = 'block';
                } else if (rumahDomisiliSelect.value === 'kontrak tahunan') {
                    domisiliTahunanGroup.style.display = 'block';
                }
            }

            function toggleStatusKaryawan() {
                if (statusKaryawanSelect.value === 'kontrak') {
                    divKontrak.style.display = 'block';
                } else {
                    divKontrak.style.display = 'none';
                }
            }

            function toggleCicilan() {
                if (cicilanLain.value === 'Ada') {
                    cicilanContainer.style.display = 'block';
                } else {
                    cicilanContainer.style.display = 'none';
                }
            }

            // Function to add a new form dynamically
            function addNewForm() {
                const formCount = dynamicFormContainer.childElementCount;
                const newForm = document.createElement('div');
                newForm.className = 'dynamic-form mb-3';
                newForm.id = `form-${formCount}`;
                newForm.innerHTML = `
                    <h6>Form Cicilan Lain ${formCount + 1}</h6>
                    <div class="form-group">
                        <label for="nama_pembiayaan_${formCount}" class="form-label">Nama Pembiayaan</label>
                        <input type="text" id="nama_pembiayaan_${formCount}" name="nama_pembiayaan[]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="total_pinjaman_${formCount}" class="form-label">Total Pinjaman</label>
                        <input type="number" id="total_pinjaman_${formCount}" name="total_pinjaman[]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cicilan_perbulan_${formCount}" class="form-label">Cicilan Perbulan</label>
                        <input type="number" id="cicilan_perbulan_${formCount}" name="cicilan_perbulan[]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="sisa_tenor_cicilan_${formCount}" class="form-label">Sisa Tenor</label>
                        <input type="number" id="sisa_tenor_cicilan_${formCount}" name="sisa_tenor_cicilan[]" class="form-control">
                    </div>
                    <hr>
                `;
                dynamicFormContainer.appendChild(newForm);
            }

            // Panggil fungsi toggle saat halaman dimuat untuk inisialisasi
            toggleRiwayatPinjaman();
            toggleStatusRumah();
            toggleAlamatDomisili();
            toggleRumahDomisili();
            toggleStatusKaryawan();
            toggleCicilan();

            // Tambahkan event listener untuk perubahan dropdown
            statusPinjamanSelect.addEventListener('change', toggleRiwayatPinjaman);
            statusRumahSelect.addEventListener('change', toggleStatusRumah);
            domisiliSelect.addEventListener('change', toggleAlamatDomisili);
            rumahDomisiliSelect.addEventListener('change', toggleRumahDomisili);
            statusKaryawanSelect.addEventListener('change', toggleStatusKaryawan);
            cicilanLain.addEventListener('change', toggleCicilan);
            // Add event listener for the add form button
            addFormButton.addEventListener('click', addNewForm);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const steps = Array.from(document.querySelectorAll('.form-step'));
            const nextBtn = document.querySelectorAll('.next-btn');
            const prevBtn = document.querySelectorAll('.prev-btn');
            const form = document.getElementById('loanForm');
            let currentStep = 0;

            // Fungsi untuk menampilkan langkah tertentu
            function showStep(stepIndex) {
                steps.forEach((step, index) => {
                    step.classList.toggle('form-step-active', index === stepIndex);
                });
            }

            // Event listener untuk tombol Next
            nextBtn.forEach(button => {
                button.addEventListener('click', (event) => {
                    event.preventDefault(); // Cegah pengiriman form saat klik tombol Next
                    const currentFormStep = steps[currentStep];
                    const inputs = currentFormStep.querySelectorAll('input, select, textarea');
                    let isValid = true;

                    // Periksa validitas semua input di langkah saat ini
                    inputs.forEach(input => {
                        if (!input.checkValidity()) {
                            isValid = false;
                            input
                                .reportValidity(); // Menampilkan pesan error bawaan browser
                        }
                    });

                    // Jika validasi berhasil, lanjutkan ke langkah berikutnya
                    if (isValid && currentStep < steps.length - 1) {
                        currentStep++;
                        showStep(currentStep);
                    }
                });
            });

            // Event listener untuk tombol Previous
            prevBtn.forEach(button => {
                button.addEventListener('click', (event) => {
                    event.preventDefault(); // Cegah pengiriman form saat klik tombol Previous
                    if (currentStep > 0) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });
            });

            // Tampilkan langkah pertama
            showStep(currentStep);

            // Cegah pengiriman formulir jika langkah terakhir belum selesai
            form.addEventListener('submit', (event) => {
                if (currentStep < steps.length - 1) {
                    event.preventDefault();
                    alert('Harap selesaikan semua langkah sebelum mengirim formulir.');
                }
            });
        });
    </script>

@endsection
