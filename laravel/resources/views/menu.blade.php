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

</head>

<body>
<div class="row">
    <div class="col-2">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="/users">Gerir Utilizadores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/distritos">Gerir Distritos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/municipios">Gerir Municipios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/informacoes">Gerir Informacoes Municipios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cidades">Gerir Cidades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/codigos_postais">Gerir Códigos Postais</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/instituicoes">Gerir Instituições</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/tipos_ensino">Gerir Tipos de Ensino</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/inst_cursos">Gerir Cursos na Instituição</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/prova_ingresso">Gerir Provas de Ingresso</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/exames">Gerir Exames</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cursos">Gerir Cursos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/areas_estudo">Gerir Áreas de Estudo</a>
                </li>
            </ul>
        <!-- Falta fechar um div -->

</div>

<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
