<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $title }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ url('') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ url('') }}/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('') }}/css/mystyle.css">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center" id="height-login">

            <div class="col-xl-5 col-lg-5 col-md-10">

                <div class="card o-hidden border-0 shadow-lg my-5 pb-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-12">
                                <div class="p-5">
                                    <div class="text-center mb-5">
                                        <h1 class="h3 text-primary font-weight-bold mb-4"><i
                                                class="fas fa-mail-bulk"></i>
                                            Tracking Mail
                                            App</h1>
                                    </div>

                                    <form class="user" method="POST" action="{{ url('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="username"
                                                class="form-control form-control-user @error('username') is-invalid @enderror"
                                                id="username" placeholder="Masukkan username..."
                                                value="{{ old('username') }}">
                                            @error('username')
                                                <div class="ml-3 mt-2 invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="pass"
                                                class="form-control form-control-user @error('pass') is-invalid @enderror"
                                                id="pass" placeholder="Password...">
                                            @error('pass')
                                                <div class="ml-3 mt-2 invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    @include('layouts.flashdata')

    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ url('') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ url('') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('') }}/js/sb-admin-2.min.js"></script>
    <script src="{{ url('') }}/js/sweetalert2@11.js"></script>
    <script src="{{ url('') }}/js/flashdata.js"></script>

</body>

</html>
