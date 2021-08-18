@extends('layouts.layout')
@section('title', 'Detail Profile')
@section('content')
<div class="row">
    @if (\Session::has('error'))
    <div class="col-lg-12">
        <div class="alert alert-danger">
            <ul>
                <li>{!! \Session::get('error') !!}</li>
            </ul>
        </div>
    </div>
    @endif
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
    @if (\Session::has('success'))
    <div class="col-lg-12">
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    </div>
    @endif
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Profileku</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.profile.update') }}">@csrf
                    <div class="form-group">
                        <label class="mb-1"><strong>Nama/Instansi</strong></label>
                        <input type="text" class="form-control" placeholder="Nama/Instansi" name="name" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                        <label class="mb-1"><strong>NIK</strong></label>
                        <input type="text" class="form-control" placeholder="21" value="{{ Auth::user()->umur }}"  name="umur">
                    </div>
                    <div class="form-group">
                        <label class="mb-1"><strong>Email</strong></label>
                        <input type="email" class="form-control" placeholder="hello@example.com" value="{{ Auth::user()->email }}"  name="email">
                    </div>
                    <div class="form-group">
                        <label class="mb-1"><strong>Nomor HP</strong></label>
                        <input type="text" class="form-control" placeholder="08XXXXXXXX" value="{{ Auth::user()->no_hp }}"  name="no_hp">
                    </div>
                    <div class="form-group">
                        <label class="mb-1"><strong>Alamat</strong></label>
                        <input type="text" class="form-control" placeholder="Jalan...." value="{{ Auth::user()->alamat }}"  name="alamat">
                    </div>
                    <div class="form-group">
                        <label class="mb-1"><strong>Password Lama</strong></label>
                        <input type="password" class="form-control"  name="password_lama">
                    </div>
                    <div class="form-group">
                        <label class="mb-1"><strong>Password Baru</strong></label>
                        <input type="password" class="form-control"  name="password_baru">
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /# card -->
    </div>
</div>


@endsection
@section('script')
    
@endsection