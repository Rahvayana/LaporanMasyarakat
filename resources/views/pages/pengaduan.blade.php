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
                                    @if ($report->status!='RECEIVED')
                                    <a href="{{ route('pengaduan.chat',$report->id) }}" class="btn btn-rounded btn-dark"><i class="fa  fa-wechat color-dark"></i></a>
                                    @endif
                                    <a href="{{ route('pengaduan.detail',$report->id) }}" class="btn btn-rounded btn-dark"><i class="fa fa-pencil color-dark"></i></a>
                                    <a href="#" data-record-id="{{$report->id}}" data-toggle="modal" data-target="#confirm-delete"  class="btn btn-rounded btn-dark"><i class="fa fa-trash color-dark"></i></a>
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
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Hapus User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger btn-ok">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
    $('#confirm-delete').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        var id = $(this).data('recordId');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.post('/pengaduan-delete/' + id).then()
        $modalDiv.addClass('loading');
        setTimeout(function() {
            location.reload();            
        })
    });
    $('#confirm-delete').on('show.bs.modal', function(e) {
        var data = $(e.relatedTarget).data();
        $('.btn-ok', this).data('recordId', data.recordId);
    });
    </script>
@endsection