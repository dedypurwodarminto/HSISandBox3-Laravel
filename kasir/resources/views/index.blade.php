
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Toko Barokah</title>
    <!-- Favicon icon -->
    <link rel="icon" type="/assets/image/png" sizes="16x16" href="/assets/images/favicon.png">
    <link href="/assets/css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center"> <h4>L O G I N</h4></a>
                                <form class="mt-5 mb-5 login-input" method="POST" action="{{ route('login')}}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email" name="email" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                                    </div>
                                    <button type="submit" class="btn login-form__btn submit w-100">Masuk</button>
                                </form>
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
    <script src="/assets/plugins/common/common.min.js"></script>
    <script src="/assets/js/custom.min.js"></script>
    <script src="/assets/js/settings.js"></script>
    <script src="/assets/js/gleek.js"></script>
    <script src="/assets/js/styleSwitcher.js"></script>
    <script src="/assets/js/sweetalert2.all.min.js"></script>

    <script>
    // Check if success message exists in session
    @if (session('sukses'))
        // Display SweetAlert2 alert with success message
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('sukses') }}',
            timer: 1500
        });
    @endif
    </script>

    <script>
    // Check if error message exists in session
    @if (session('error'))
        // Display SweetAlert2 alert with error message
        Swal.fire({
            icon: 'error',
            title: 'Walaahhh...',
            text: '{{ session('error') }}',
        });
    @endif
</script>
</body>
</html>