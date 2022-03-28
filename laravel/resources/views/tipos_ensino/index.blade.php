@extends('tipos_ensino.layout')
@include('menu')

<style>
    .uper {
        margin-top: 40px;
    }
</style>

<div class="container mb-5">
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if (session()->get('danger'))
        <div class="alert alert-danger">
            {{ session()->get('danger') }}
        </div>
    @endif

    <div style="margin-top: 45px">
        <div class="col">
            <div class="col-md-12">
                <div>
                    <form action="/searchTipo" method="get">
                        <div class="input-group">
                            <input type="search" name="tipo" id="tipo" class="form-control mb-md-2" placeholder="Pesquisar tipo de ensino...">
                            <span class="input-group-prepend pl-1">
                                <button type="submit" class="btn btn-primary mb-md-2"> Search </button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                Tipos de Ensino
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('tipos_ensino.create')}}" class="btn btn-success">Criar</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Tipo</td>
                                    <td colspan="2"></td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($tipos_ensino as $tipo_ensino)
                                <tr>
                                    <td>{{$tipo_ensino->ID}}</td>
                                    <td>{{$tipo_ensino->nome}}</td>
                                    <td><a href="{{ route('tipos_ensino.edit', $tipo_ensino->ID)}}" class="btn btn-warning">Editar</a></td>
                                    <td>
                                        <form action="{{ route('tipos_ensino.destroy', $tipo_ensino->ID)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--@endsection--}}
</div>

