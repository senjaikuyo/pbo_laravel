@extends('layouts/admin')

@push('title', 'Profil Admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profil Admin</h1>
</div>

<div class="row">
    <!-- Profile Card (Left Column) -->
    <div class="col-xl-4 col-md-5 mb-4">
        <div class="card shadow">
            <div class="card-body text-center">
                <img class="img-profile rounded-circle mb-3 border" src="/img/undraw_profile.svg" width="150" height="150">
                <h5 class="font-weight-bold text-gray-800">{{ Auth::guard('admin')->user()->email }}</h5>
                <p class="text-gray-500 small mb-3">Administrator Utama</p>
                <div class="badge badge-success px-3 py-2">Status Aktif</div>
                <hr class="my-4">
                <div class="text-left small">
                    <div class="mb-2"><strong class="text-gray-700">Terdaftar Sejak:</strong> <span class="text-gray-600">June 2026</span></div>
                    <div><strong class="text-gray-700">Zona Waktu:</strong> <span class="text-gray-600">Asia/Jakarta (GMT+7)</span></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Form (Right Column) -->
    <div class="col-xl-8 col-md-7 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Informasi Akun</h6>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold text-gray-700">Email Address</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" value="{{ Auth::guard('admin')->user()->email }}" placeholder="Email" readonly>
                            <span class="small text-gray-500 mt-1 d-block"><i class="fas fa-lock mr-1"></i> Email akun utama tidak dapat diubah secara langsung demi keamanan.</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold text-gray-700">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="Administrator" placeholder="Nama Lengkap">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold text-gray-700">Password Baru</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" placeholder="Masukkan password baru jika ingin mengubah">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold text-gray-700">Ulangi Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row mb-0">
                        <div class="col-sm-12 text-right">
                            <button type="button" class="btn btn-primary px-4 shadow-sm" onclick="Swal.fire('Sukses', 'Informasi profil berhasil diperbarui (Simulasi)', 'success')">
                                <i class="fas fa-save mr-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
