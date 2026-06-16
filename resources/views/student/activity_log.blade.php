@extends('layouts/admin')

@push('title', 'Aktivitas Log')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Log Aktivitas Sistem</h1>
    <button class="btn btn-secondary btn-sm shadow-sm" onclick="Swal.fire('Sukses', 'Log aktivitas berhasil diekspor (Simulasi)', 'success')">
        <i class="fas fa-file-export mr-1"></i> Ekspor Log (CSV)
    </button>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Riwayat Aktivitas Terbaru</h6>
        <span class="badge badge-info">Menampilkan 5 Data Terkini</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 20%;">Tanggal & Waktu</th>
                        <th style="width: 20%;">Pengguna</th>
                        <th style="width: 35%;">Deskripsi Aktivitas</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 10%;">IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ date('d-m-Y H:i:s', time() - 60) }}</td>
                        <td>{{ Auth::guard('admin')->user()->email }}</td>
                        <td>Mengakses & menggambar pada <strong>Papan Gambar</strong> (Kanvas Sketsa)</td>
                        <td><span class="badge badge-success">Success</span></td>
                        <td>127.0.0.1</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>{{ date('d-m-Y H:i:s', time() - 3600) }}</td>
                        <td>{{ Auth::guard('admin')->user()->email }}</td>
                        <td>Melakukan perubahan rute dashboard utama menuju <strong>/dashboard</strong></td>
                        <td><span class="badge badge-info">Info</span></td>
                        <td>127.0.0.1</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>{{ date('d-m-Y H:i:s', time() - 7200) }}</td>
                        <td>{{ Auth::guard('admin')->user()->email }}</td>
                        <td>Menambahkan mahasiswa baru ke database (NIM: 220103001)</td>
                        <td><span class="badge badge-success">Success</span></td>
                        <td>127.0.0.1</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>{{ date('d-m-Y H:i:s', time() - 86400) }}</td>
                        <td>{{ Auth::guard('admin')->user()->email }}</td>
                        <td>Gagal melakukan login - Password tidak sesuai</td>
                        <td><span class="badge badge-danger">Failed</span></td>
                        <td>192.168.1.5</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>{{ date('d-m-Y H:i:s', time() - 172800) }}</td>
                        <td>{{ Auth::guard('admin')->user()->email }}</td>
                        <td>Mengunduh laporan PDF data mahasiswa</td>
                        <td><span class="badge badge-success">Success</span></td>
                        <td>127.0.0.1</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
