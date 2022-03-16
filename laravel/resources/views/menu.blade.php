<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Back-Office</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<style>
    div.ex1 {
        width: 15%;
        margin: 10px;
        align: left;
    }
</style>

</head>

<body>
<div class="">
    <div class="ex1">
        <h2>Back-Office</h2>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="/distritos">Gerir Distritos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/municipios">Gerir Municipios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/distritos">Gerir Distritos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/municipios">Gerir Municipios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/distritos">Gerir Distritos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/municipios">Gerir Municipios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/distritos">Gerir Distritos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/municipios">Gerir Municipios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/distritos">Gerir Distritos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/municipios">Gerir Municipios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/distritos">Gerir Distritos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/municipios">Gerir Municipios</a>
            </li>
        </ul>
    </div>
</div>

<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
