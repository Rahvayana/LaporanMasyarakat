@extends('layouts.layout')
@section('title', 'List Pengaduan')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tabel Pengaduan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pelapor</th>
                                <th>Terlapor</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                <td>{{$report->name}}</td>
                                <td>{{$report->terlapor}}</td>
                                <td>{{date('d-m-Y',strtotime($report->created_at))}}</td>
                                <td>{{$report->status}}</td>
                                <td>
                                    @if (Auth::user()->role!='PENYIDIK')
                                    <a href="{{ route('pengaduan.chat',$report->id) }}" class="btn btn-rounded btn-dark"><i class="fa  fa-wechat color-dark"></i></a>
                                    <a href="{{ route('pengaduan.detail',$report->id) }}" class="btn btn-rounded btn-dark"><i class="fa fa-pencil color-dark"></i></a>
                                    <a href="" class="btn btn-rounded btn-dark"><i class="fa fa-trash color-dark"></i></a>
                                    @else
                                    <a href="{{ route('pengaduan.chat',$report->id) }}" class="btn btn-rounded btn-dark"><i class="fa  fa-wechat color-dark"></i></a>
                                    @endif
                                </td>
                            </tr>  
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /# card -->
    </div>
</div>
@endsection