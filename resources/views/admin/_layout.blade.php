<!DOCTYPE html>
<html lang="en">
<head>

    <title>@yield('title') - chinaved.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://chinaved.com/admin/plugins/fontawesome-free/css/all.min.css">

<!-- Theme style -->
<link rel="stylesheet" href="https://chinaved.com/admin/css/adminlte.min.css">

</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @yield('content')

    </div>
    @include('admin.delete_all')
    <!-- jQuery -->
<script src="https://chinaved.com/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://chinaved.com/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>
</html>
