@extends('layouts.layout')
@section('title', 'Tambah Penyidik')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Penyidik</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('penyidik.store') }}">@csrf
                    <div class="form-group">
                        <label class="mb-1"><strong>Nama Penyidik</strong></label>
                        <input type="text" class="form-control" placeholder="Nama Penyidik" name="name">
                    </div>
                    <div class="form-group">
                        <label class="mb-1"><strong>Email</strong></label>
                        <input type="email" class="form-control" placeholder="hello@example.com" value="{{ old('email') }}"  name="email">
                    </div>
                    <div class="form-group">
                        <label class="mb-1"><strong>Nomor HP</strong></label>
                        <input type="text" class="form-control" placeholder="08XXXXXXXX" value="{{ old('no_hp') }}"  name="no_hp">
                    </div>
                    <div class="form-group">
                        <label class="mb-1"><strong>Alamat</strong></label>
                        <input type="text" class="form-control" placeholder="Jalan...." value="{{ old('alamat') }}"  name="alamat">
                    </div>
                    <div class="form-group">
                        <label class="mb-1"><strong>NIK</strong></label>
                        <input type="text" class="form-control" placeholder="21" value="{{ old('umur') }}"  name="umur">
                    </div>
                    <div class="form-group">
                        <label class="mb-1"><strong>NRP</strong></label>
                        <input type="text" class="form-control" placeholder="XXXXXXXX" value="{{ old('nrp') }}"  name="nrp">
                    </div>
                    <div class="form-group">
                        <label class="mb-1"><strong>Jabatan</strong></label>
                        <input type="text" class="form-control" placeholder="Jabatan" value="{{ old('jabatan') }}"  name="jabatan">
                    </div>
                    <div class="form-group">
                        <label class="mb-1"><strong>Password</strong></label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label class="mb-1"><strong>Ulangi Password</strong></label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /# card -->
    </div>
</div>
@endsection