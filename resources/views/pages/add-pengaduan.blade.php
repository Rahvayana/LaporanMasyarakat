@extends('layouts.layout')
@section('title', 'Tambah Pengaduan')
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
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
    </div>
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Pengaduan</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">PIHAK YANG DILAPORKAN </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Pihak Yang Dilaporkan" required value="{{old('terlapor')}}" name="terlapor">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">PROYEK YANG DILAPORKAN </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Proyek Yang Dilaporkan" required value="{{old('proyek')}}" name="proyek">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">SUMBER ANGGARAN YANG DILAPORKAN </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Sumber Anggaran Yang Dilaporkan" required value="{{old('anggaran')}}" name="anggaran">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">DESKRIPSI LAPORAN </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="4" id="comment" name="deskripsi" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">DOKUMEN LAMPIRAN <span style="font-size: 10px; color: red">jika ada</span></label>
                            <div class="col-sm-7" id="inputFile">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file[]" accept="application/pdf, image/*">
                                    <label class="custom-file-label">Pilih File PDF atau Image</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-rounded btn-dark" onclick="addInputFile()"><i class="fa fa-plus color-dark"></i></button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Laporkan!</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function addInputFile(){
            $("#inputFile").append('<div class="custom-file mt-2">\
                <input type="file" class="custom-file-input" name="file[]">\
                <label class="custom-file-label">Pilih File PDF atau Image</label>\
            </div>')
        }
    </script>
@endsection