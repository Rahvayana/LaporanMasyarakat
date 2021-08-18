@extends('layouts.layout')
@section('title', 'Detail Pengaduan')
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <tr>
                            <td>Pelapor</td>
                            <td>:</td>
                            <td>{{$report->name}}</td>
                        </tr>
                        <tr>
                            <td>Terlapor</td>
                            <td>:</td>
                            <td>{{$report->terlapor}}</td>
                        </tr>
                        <tr>
                            <td>Proyek</td>
                            <td>:</td>
                            <td>{{$report->proyek}}</td>
                        </tr>
                        <tr>
                            <td>Anggaran</td>
                            <td>:</td>
                            <td>{{$report->anggaran}}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>:</td>
                            <td><p style="text-align: justify">{{$report->deskripsi}}</p></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>{{$report->status}}</td>
                        </tr>
                        <tr>
                            <td>Dokumen</td>
                            <td>:</td>
                            <td>
                                @foreach (json_decode($report->dokumen) as $key=>$doc)
                                    <a href={{ asset('/assets/files/'.$doc) }}>Dokumen {{$key+=1}}</a><br>
                                @endforeach
                            </td>
                        </tr>
                        <form action="{{ route('pengaduan.penyidik',$report->id ) }}" id="myform" method="POST">@csrf
                            <tr>
                                <td>Pilih Penyidik</td>
                                <td>:</td>
                                <td>
                                    <select name="penyidik" id="penyidik" class="form-control" form="myform">
                                        @foreach ($inspectors as $inspector)
                                        <option value="{{$inspector->id}}">{{$inspector->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <tr>
                                    <td>
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Update!</button>
                                    </td>
                                </tr>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection