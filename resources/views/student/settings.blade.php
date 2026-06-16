@extends('layouts/admin')

@push('title', 'Pengaturan Aplikasi')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pengaturan Aplikasi</h1>
</div>

<div class="row">
    <!-- Main Configuration Panel -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Konfigurasi Umum</h6>
            </div>
            <div class="card-body">
                <form>
                    <!-- Settings Item: App Name -->
                    <div class="form-group">
                        <label class="font-weight-bold text-gray-700" for="app-name">Nama Aplikasi</label>
                        <input type="text" class="form-control" id="app-name" value="CRUD Siswa & Papan Gambar Admin">
                    </div>

                    <!-- Settings Item: Maintenance Mode -->
                    <div class="form-group d-flex align-items-center justify-content-between py-2">
                        <div>
                            <label class="font-weight-bold text-gray-700 mb-0">Mode Pemeliharaan (Maintenance)</label>
                            <div class="small text-gray-500">Membatasi akses website hanya untuk administrator saja.</div>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="maintenance-toggle">
                            <label class="custom-control-label" for="maintenance-toggle"></label>
                        </div>
                    </div>

                    <!-- Settings Item: Registration Toggle -->
                    <div class="form-group d-flex align-items-center justify-content-between py-2">
                        <div>
                            <label class="font-weight-bold text-gray-700 mb-0">Izinkan Registrasi Pengguna</label>
                            <div class="small text-gray-500">Membuka atau menutup pendaftaran akun admin baru secara publik.</div>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="register-toggle" checked>
                            <label class="custom-control-label" for="register-toggle"></label>
                        </div>
                    </div>

                    <!-- Settings Item: Language -->
                    <div class="form-group">
                        <label class="font-weight-bold text-gray-700" for="lang-select">Bahasa Antarmuka</label>
                        <select class="form-control" id="lang-select">
                            <option value="id" selected>Bahasa Indonesia</option>
                            <option value="en">English (US)</option>
                        </select>
                    </div>

                    <hr>

                    <div class="text-right">
                        <button type="button" class="btn btn-primary px-4 shadow-sm" onclick="Swal.fire('Sukses', 'Konfigurasi umum berhasil disimpan (Simulasi)', 'success')">
                            <i class="fas fa-save mr-1"></i> Simpan Konfigurasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Notification Preferences Card -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Preferensi Notifikasi</h6>
            </div>
            <div class="card-body">
                <form>
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="notif-email" checked>
                        <label class="custom-control-label font-weight-bold text-gray-700 small" for="notif-email">Notifikasi Email</label>
                        <div class="small text-gray-500 ml-4">Kirim surel otomatis ketika ada aktivitas mencurigakan.</div>
                    </div>

                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="notif-report" checked>
                        <label class="custom-control-label font-weight-bold text-gray-700 small" for="notif-report">Laporan Mingguan</label>
                        <div class="small text-gray-500 ml-4">Kirim digest statistik mingguan data mahasiswa.</div>
                    </div>

                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="notif-canvas">
                        <label class="custom-control-label font-weight-bold text-gray-700 small" for="notif-canvas">Sketsa Baru Tersimpan</label>
                        <div class="small text-gray-500 ml-4">Kirim push notification ketika sketch baru diekspor.</div>
                    </div>

                    <hr>

                    <button type="button" class="btn btn-primary btn-block shadow-sm" onclick="Swal.fire('Sukses', 'Preferensi notifikasi berhasil disimpan (Simulasi)', 'success')">
                        Perbarui Notifikasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
