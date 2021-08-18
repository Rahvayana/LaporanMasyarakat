@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')
<div class="form-head d-flex mb-4 mb-md-5 align-items-start">
    <a href="{{ route('pengaduan.add') }}" class="btn btn-primary ml-auto">+ Tambah Pengaduan</a>
</div>
<div class="row">
    <div class="col-xl-3 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-danger">
            <div class="card-body  p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-archive"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Pengaduan</p>
                        <h3 class="text-white">{{$pengaduan}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-success">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-user"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Pengguna</p>
                        <h3 class="text-white">{{$user}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-info">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-user-1"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Penyidik</p>
                        <h3 class="text-white">{{$penyidik}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-primary">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-user-8"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Admin</p>
                        <h3 class="text-white">{{$admin}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Grafik Pengaduan Setiap Bulan</h4>
            </div>
            <div class="card-body">
                <canvas id="lineChart_1"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="/assets/vendor/chart.js/Chart.bundle.min.js"></script>
<script>
    const lineChart_1 = document.getElementById("lineChart_1").getContext('2d');

    lineChart_1.height = 50;
    
    $( document ).ready(function() {
        $.get("/graph", function(data, status){
            console.log(data)
            new Chart(lineChart_1, {
                type: 'line',
                data: {
                    defaultFontFamily: 'Poppins',
                    labels: ["Jan", "Febr", "Mar", "Apr", "May", "Jun", "Jul", "Agu","Sep", "Okt", "Nov", "Des"],
                    datasets: [
                        {
                            label: "Jumlah Pengaduan",
                            data: data,
                            borderColor: 'rgba(100, 24, 195, 1)',
                            borderWidth: "2",
                            backgroundColor: 'transparent',  
                            pointBackgroundColor: 'rgba(100, 24, 195, 1)'
                        }
                    ]
                },
                options: {
                    legend: false, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true, 
                                max: 10, 
                                min: 0
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                padding: 5
                            }
                        }]
                    }
                }
            });
        });
    });


</script>
@endsection