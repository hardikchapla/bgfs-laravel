<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Black Girl Film School | Authentication</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.svg') }}" type="image/x-icon">
    <!-- bootstrap 5 -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}"> 
</head>

<body>
    <div id="app"> 
        @yield('contents')
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
    <!-- javascript -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <!-- bootstrap 5 -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- main -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
 
</html>
