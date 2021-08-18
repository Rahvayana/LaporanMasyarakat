@extends('layouts.layout')
@section('title', 'Obrolan Untuk Pengaduan')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Pelapor</th>
                                <th>Terlapor</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$report->name}}</td>
                                <td>{{$report->terlapor}}</td>
                                <td>{{date('d-m-Y',strtotime($report->created_at))}}</td>
                                <td>{{$report->status}}</td>
                                <td><a href="{{ route('pengaduan.detail',$report->id) }}" class="btn btn-rounded btn-dark"><i class="fa fa-eye color-dark"></i></a></td>
                            </tr>  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
    <div class="col-xl-12">
        <div class="card chat dz-chat-history-box">
            <div class="card-body msg_card_body dz-scroll" id="DZ_W_Contacts_Body3">
                @foreach ($chats as $chat)
                    @if ($loop->iteration%2!=0)
                    <div class="d-flex justify-content-start mb-4">
                        <div class="msg_cotainer">
                            {{$chat->body}}
                        </div>
                    </div>
                    @else
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            {{$chat->body}}
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            <div class="card-footer type_msg">
                <form action="{{ route('pengaduan.chatting') }}" method="POST" id="myForm">@csrf
                    <div class="input-group">
                        @if (Auth::id()==$report->user_id)
                        <input type="hidden" name="id_sender" form="myForm" id="id_sender" value="{{Auth::id()}}">
                        <input type="hidden" name="id_receiver" form="myForm" id="id_receiver" value="{{$inspector->id}}">
                        @else
                        <input type="hidden" name="id_sender" form="myForm" id="id_sender" value="{{Auth::id()}}">
                        <input type="hidden" name="id_receiver" form="myForm" id="id_receiver" value="{{$report->user_id}}">
                        @endif
                        <input type="hidden" name="id_report" form="myForm" id="id_penyidik" value="{{$report->id}}">
                        <textarea class="form-control" name="pesan" form="myForm" placeholder="Tulis Pesanmu..."></textarea>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-location-arrow"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection