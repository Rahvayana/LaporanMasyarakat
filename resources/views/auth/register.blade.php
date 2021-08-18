<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>LAPOR KORUPSI SULSEL - Register</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon.png">
    <link href="/assets/css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Daftarkan Akun!</h4>
                                    <form method="POST" action="{{ route('register') }}">@csrf
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Nama/Instansi</strong></label>
                                            <input type="text" class="form-control" placeholder="Nama/Instansi" name="name">
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
                                            <label class="mb-1"><strong>Umur</strong></label>
                                            <input type="text" class="form-control" placeholder="21" value="{{ old('umur') }}"  name="umur">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control"  name="password">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Ulangi Password</strong></label>
                                            <input type="password" class="form-control"  name="password_confirmation">
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Sudah Punya Akun? <a class="text-primary" href="{{ route('login') }}">Masuk</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="/assets/vendor/global/global.min.js"></script>
<script src="/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="/assets/js/custom.min.js"></script>
<script src="/assets/js/deznav-init.js"></script>

</body>
</html>